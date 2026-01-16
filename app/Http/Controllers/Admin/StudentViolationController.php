<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\StudentViolation;
use App\Models\Violation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StudentViolationController extends Controller
{
    /**
     * Display a listing of student violations
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $violations = StudentViolation::with(['student.classRoom', 'violation', 'creator'])
                ->select('student_violations.*');

            // Apply filters
            if ($request->filled('class_id')) {
                $violations->whereHas('student', function ($q) use ($request) {
                    $q->where('class_id', $request->class_id);
                });
            }

            if ($request->filled('date')) {
                $violations->whereDate('date', $request->date);
            }

            return DataTables::of($violations)
                ->addIndexColumn()
                ->addColumn('student_name', function($violation) {
                    return $violation->student ? $violation->student->name : '-';
                })
                ->addColumn('class_name', function($violation) {
                    return $violation->student && $violation->student->classRoom ? $violation->student->classRoom->name : '-';
                })
                ->addColumn('violation_name', function($violation) {
                    return $violation->violation ? $violation->violation->name : '-';
                })
                ->addColumn('points', function($violation) {
                    return $violation->violation ? $violation->violation->point_value : 0;
                })
                ->addColumn('date_formatted', function($violation) {
                    return $violation->date->format('d/m/Y');
                })
                ->addColumn('action', function($violation) {
                    $showUrl = route('admin.student-violations.show', $violation->id);
                    $editUrl = route('admin.student-violations.edit', $violation->id);
                    $deleteUrl = route('admin.student-violations.destroy', $violation->id);

                    return '<div class="d-flex gap-2">
                        <a href="'.$showUrl.'" class="btn btn-sm btn-light btn-active-light-info">
                            <i class="ki-duotone ki-eye fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        </a>
                        <a href="'.$editUrl.'" class="btn btn-sm btn-light btn-active-light-primary">
                            <i class="ki-duotone ki-pencil fs-5"><span class="path1"></span><span class="path2"></span></i>
                        </a>
                        <form action="'.$deleteUrl.'" method="POST" class="d-inline" onsubmit="return confirm(\'Yakin ingin menghapus?\')">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-sm btn-light btn-active-light-danger">
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        </form>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $classes = ClassRoom::all();
        $students = Student::orderBy('name')->get();

        $pageData = $this->setPageData('Data Pelanggaran Siswa', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Pelanggaran Siswa']
        ]);

        return view('admin.student-violations.index', array_merge(compact('classes', 'students'), $pageData));
    }

    /**
     * Show violation history (read-only)
     */
    public function history(Request $request)
    {
        $query = StudentViolation::with(['student.classRoom', 'violation', 'creator']);

        // Filter by class
        if ($request->filled('class_id')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('class_id', $request->class_id);
            });
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $violations = $query->orderBy('date', 'desc')->paginate(20);
        $classes = ClassRoom::all();
        $violations_type = Violation::orderBy('name')->get();

        $pageData = $this->setPageData('Riwayat Pelanggaran Siswa', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Pelanggaran Siswa', 'url' => route('admin.student-violations.index')],
            ['title' => 'Riwayat']
        ]);

        return view('admin.student-violations.history', array_merge(compact('violations', 'classes', 'violations_type'), $pageData));
    }

    /**
     * Show the form for creating a new student violation
     */
    public function create()
    {
        $students = Student::with('classRoom')->orderBy('name')->get();
        $violations = Violation::orderBy('name')->get();
        $pageData = $this->setPageData('Catat Pelanggaran Siswa', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Pelanggaran Siswa', 'url' => route('admin.student-violations.index')],
            ['title' => 'Catat']
        ]);
        return view('admin.student-violations.create', array_merge(compact('students', 'violations'), $pageData));
    }

    /**
     * Store a newly created student violation in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'violation_id' => 'required|exists:violations,id',
            'date' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            // Get violation point value
            $violation = Violation::findOrFail($validated['violation_id']);

            // Create student violation record
            StudentViolation::create([
                'student_id' => $validated['student_id'],
                'violation_id' => $validated['violation_id'],
                'date' => $validated['date'],
                'point' => $violation->point_value,
                'created_by' => auth()->id(),
            ]);

            // Note: total_points will be updated automatically by model observer

            DB::commit();

            return redirect()->route('admin.student-violations.index')
                ->with('success', 'Pelanggaran siswa berhasil dicatat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display students with fines (points > 0)
     */
    public function fines()
    {
        $students = Student::with('classRoom')
            ->where('total_points', '>', 0)
            ->orderBy('total_points', 'desc')
            ->get();

        $pageData = $this->setPageData('Daftar Siswa Terkena Denda', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Pelanggaran Siswa', 'url' => route('admin.student-violations.index')],
            ['title' => 'Denda']
        ]);

        return view('admin.student-violations.fines', array_merge(compact('students'), $pageData));
    }

    /**
     * Reset student points after fine verification
     */
    public function resetPoints(Request $request, Student $student)
    {
        if ($student->total_points == 0) {
            return back()->with('error', 'Siswa tidak memiliki poin pelanggaran.');
        }

        DB::beginTransaction();
        try {
            $student->resetPoints();

            // Log the reset action (optional: create a reset_logs table)
            // ResetLog::create([...]);

            DB::commit();

            return back()->with('success', "Poin {$student->name} berhasil direset.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified student violation from database
     */
    public function destroy(StudentViolation $studentViolation)
    {
        DB::beginTransaction();
        try {
            $studentViolation->delete();
            // Note: total_points will be updated automatically by model observer

            DB::commit();

            return redirect()->route('admin.student-violations.index')
                ->with('success', 'Data pelanggaran berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
