<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClassController extends Controller
{
    /**
     * Display a listing of classes
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $classes = ClassRoom::withCount('students')->select('classes.*');

            return DataTables::of($classes)
                ->addIndexColumn()
                ->addColumn('action', function($class) {
                    $editUrl = route('admin.classes.edit', $class->id);
                    $deleteUrl = route('admin.classes.destroy', $class->id);

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

        $pageData = $this->setPageData('Data Kelas', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Kelas']
        ]);
        return view('admin.classes.index', $pageData);
    }

    /**
     * Show the form for creating a new class
     */
    public function create()
    {
        $pageData = $this->setPageData('Tambah Kelas', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Kelas', 'url' => route('admin.classes.index')],
            ['title' => 'Tambah']
        ]);
        return view('admin.classes.create', $pageData);
    }

    /**
     * Store a newly created class in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:classes,name',
        ]);

        ClassRoom::create($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified class
     */
    public function edit(ClassRoom $class)
    {
        $pageData = $this->setPageData('Edit Kelas', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Kelas', 'url' => route('admin.classes.index')],
            ['title' => 'Edit']
        ]);
        return view('admin.classes.edit', array_merge(compact('class'), $pageData));
    }

    /**
     * Update the specified class in database
     */
    public function update(Request $request, ClassRoom $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:classes,name,' . $class->id,
        ]);

        $class->update($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified class from database
     */
    public function destroy(ClassRoom $class)
    {
        // Check if class has students
        if ($class->students()->count() > 0) {
            return redirect()->route('admin.classes.index')
                ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki siswa.');
        }

        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}
