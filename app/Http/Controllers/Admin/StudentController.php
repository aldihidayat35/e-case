<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of students
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $students = Student::with('classRoom')->select('students.*');

            return DataTables::of($students)
                ->addIndexColumn()
                ->addColumn('class_name', function($student) {
                    return $student->classRoom ? $student->classRoom->name : '-';
                })
                ->addColumn('action', function($student) {
                    $editUrl = route('admin.students.edit', $student->id);
                    $deleteUrl = route('admin.students.destroy', $student->id);

                    return '<div class="d-flex gap-2">
                        <a href="'.$editUrl.'" class="btn btn-sm btn-light btn-active-light-primary">
                            <i class="ki-duotone ki-pencil fs-5"><span class="path1"></span><span class="path2"></span></i>Edit
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

        $classes = ClassRoom::all();

        $pageData = $this->setPageData('Data Siswa', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Siswa']
        ]);

        return view('admin.students.index', array_merge(compact('classes'), $pageData));
    }

    /**
     * Show the form for creating a new student
     */
    public function create()
    {
        $classes = ClassRoom::all();
        $pageData = $this->setPageData('Tambah Siswa', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Siswa', 'url' => route('admin.students.index')],
            ['title' => 'Tambah']
        ]);
        return view('admin.students.create', array_merge(compact('classes'), $pageData));
    }

    /**
     * Store a newly created student in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|unique:students,nis|max:255',
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
        ]);

        Student::create($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified student
     */
    public function show(Student $student)
    {
        $student->load(['classRoom', 'violations.violation', 'rewards']);
        $pageData = $this->setPageData('Detail Siswa - ' . $student->name, [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Siswa', 'url' => route('admin.students.index')],
            ['title' => 'Detail']
        ]);
        return view('admin.students.show', array_merge(compact('student'), $pageData));
    }

    /**
     * Show the form for editing the specified student
     */
    public function edit(Student $student)
    {
        $classes = ClassRoom::all();
        $pageData = $this->setPageData('Edit Siswa', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Siswa', 'url' => route('admin.students.index')],
            ['title' => 'Edit']
        ]);
        return view('admin.students.edit', array_merge(compact('student', 'classes'), $pageData));
    }

    /**
     * Update the specified student in database
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:255|unique:students,nis,' . $student->id,
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified student from database
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Siswa berhasil dihapus.');
    }
}
