<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Violation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ViolationController extends Controller
{
    /**
     * Display a listing of violations
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $violations = Violation::select('violations.*');

            return DataTables::of($violations)
                ->addIndexColumn()
                ->addColumn('action', function($violation) {
                    $editUrl = route('admin.violations.edit', $violation->id);
                    $deleteUrl = route('admin.violations.destroy', $violation->id);

                    return '<div class="d-flex gap-2 justify-content-end">
                        <a href="'.$editUrl.'" class="btn btn-icon btn-light-primary btn-sm" data-bs-toggle="tooltip" title="Edit">
                            <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span class="path2"></span></i>
                        </a>
                        <form action="'.$deleteUrl.'" method="POST" class="d-inline">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-icon btn-light-danger btn-sm" data-bs-toggle="tooltip" title="Hapus" onclick="return confirm(\'Yakin ingin menghapus jenis pelanggaran ini?\')">
                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        </form>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pageData = $this->setPageData('Data Jenis Pelanggaran', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Jenis Pelanggaran']
        ]);
        return view('admin.violations.index', $pageData);
    }

    /**
     * Show the form for creating a new violation
     */
    public function create()
    {
        $pageData = $this->setPageData('Tambah Jenis Pelanggaran', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Jenis Pelanggaran', 'url' => route('admin.violations.index')],
            ['title' => 'Tambah']
        ]);
        return view('admin.violations.create', $pageData);
    }

    /**
     * Store a newly created violation in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'point_value' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        Violation::create($validated);

        return redirect()->route('admin.violations.index')
            ->with('success', 'Jenis pelanggaran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified violation
     */
    public function edit(Violation $violation)
    {
        $pageData = $this->setPageData('Edit Jenis Pelanggaran', [
            ['title' => 'Home', 'url' => route('admin.dashboard')],
            ['title' => 'Jenis Pelanggaran', 'url' => route('admin.violations.index')],
            ['title' => 'Edit']
        ]);
        return view('admin.violations.edit', array_merge(compact('violation'), $pageData));
    }

    /**
     * Update the specified violation in database
     */
    public function update(Request $request, Violation $violation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'point_value' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $violation->update($validated);

        return redirect()->route('admin.violations.index')
            ->with('success', 'Jenis pelanggaran berhasil diperbarui.');
    }

    /**
     * Remove the specified violation from database
     */
    public function destroy(Violation $violation)
    {
        // Check if violation has been used
        if ($violation->studentViolations()->count() > 0) {
            return redirect()->route('admin.violations.index')
                ->with('error', 'Jenis pelanggaran tidak dapat dihapus karena sudah digunakan dalam pencatatan.');
        }

        $violation->delete();

        return redirect()->route('admin.violations.index')
            ->with('success', 'Jenis pelanggaran berhasil dihapus.');
    }
}
