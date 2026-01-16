<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RewardController extends Controller
{
    /**
     * Display a listing of rewards
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rewards = Reward::with(['student.classRoom'])->select('rewards.*');

            return DataTables::of($rewards)
                ->addIndexColumn()
                ->addColumn('student_name', function($reward) {
                    return $reward->student ? $reward->student->name : '-';
                })
                ->addColumn('class_name', function($reward) {
                    return $reward->student && $reward->student->classRoom ? $reward->student->classRoom->name : '-';
                })
                ->addColumn('semester', function($reward) {
                    return $reward->semester ?? '-';
                })
                ->addColumn('description', function($reward) {
                    return $reward->description ?? '-';
                })
                ->addColumn('date_formatted', function($reward) {
                    return $reward->created_at->format('d/m/Y');
                })
                ->addColumn('action', function($reward) {
                    $showUrl = route('admin.rewards.show', $reward->id);
                    $deleteUrl = route('admin.rewards.destroy', $reward->id);

                    return '<div class="d-flex gap-2">
                        <a href="'.$showUrl.'" class="btn btn-sm btn-light btn-active-light-info">
                            <i class="ki-duotone ki-eye fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>Lihat
                        </a>
                        <form action="'.$deleteUrl.'" method="POST" class="d-inline" onsubmit="return confirm(\'Yakin ingin menghapus?\')">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-sm btn-light btn-active-light-danger">
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>Hapus
                            </button>
                        </form>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $classes = \App\Models\ClassRoom::all();

        $pageData = $this->setPageData('Data Penghargaan Siswa', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Penghargaan']
        ]);

        return view('admin.rewards.index', array_merge(compact('classes'), $pageData));
    }

    /**
     * Show students eligible for reward (0 points)
     */
    public function eligible()
    {
        $eligibleStudents = Student::with('classRoom')
            ->where('total_points', 0)
            ->orderBy('name')
            ->get();

        $pageData = $this->setPageData('Siswa Berhak Penghargaan', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Penghargaan', 'url' => route('admin.rewards.index')],
            ['title' => 'Siswa Berhak']
        ]);

        return view('admin.rewards.eligible', array_merge(compact('eligibleStudents'), $pageData));
    }

    /**
     * Show the form for creating a new reward
     */
    public function create()
    {
        // Only show students with 0 points
        $eligibleStudents = Student::with('classRoom')
            ->where('total_points', 0)
            ->orderBy('name')
            ->get();

        $pageData = $this->setPageData('Berikan Penghargaan', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Penghargaan', 'url' => route('admin.rewards.index')],
            ['title' => 'Berikan']
        ]);

        return view('admin.rewards.create', array_merge(compact('eligibleStudents'), $pageData));
    }

    /**
     * Store a newly created reward in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'semester' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Verify student has 0 points
        $student = Student::findOrFail($validated['student_id']);
        if ($student->total_points > 0) {
            return back()->with('error', 'Siswa tidak memenuhi syarat (poin harus 0).');
        }

        // Check if already received reward for this semester
        $existingReward = Reward::where('student_id', $validated['student_id'])
            ->where('semester', $validated['semester'])
            ->first();

        if ($existingReward) {
            return back()->with('error', 'Siswa sudah menerima reward untuk semester ini.');
        }

        Reward::create($validated);

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Reward berhasil diberikan kepada siswa.');
    }

    /**
     * Display the specified reward
     */
    public function show(Reward $reward)
    {
        $reward->load(['student.classRoom', 'student.violations', 'student.rewards']);
        $pageData = $this->setPageData('Detail Penghargaan', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Penghargaan', 'url' => route('admin.rewards.index')],
            ['title' => 'Detail']
        ]);
        return view('admin.rewards.show', array_merge(compact('reward'), $pageData));
    }

    /**
     * Show the form for editing the specified reward
     */
    public function edit(Reward $reward)
    {
        return view('admin.rewards.edit', compact('reward'));
    }

    /**
     * Update the specified reward in database
     */
    public function update(Request $request, Reward $reward)
    {
        $validated = $request->validate([
            'semester' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $reward->update($validated);

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Data reward berhasil diperbarui.');
    }

    /**
     * Remove the specified reward from database
     */
    public function destroy(Reward $reward)
    {
        $reward->delete();

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Reward berhasil dihapus.');
    }
}
