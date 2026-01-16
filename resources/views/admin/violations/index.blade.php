@extends('layouts.app')

@section('title', 'Data Jenis Pelanggaran')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">Data Jenis Pelanggaran</h1>
            </div>
            <div>
                <a href="{{ route('admin.violations.create') }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Tambah Jenis Pelanggaran
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" class="form-control form-control-solid w-250px ps-13" placeholder="Cari jenis pelanggaran..." id="searchInput" />
                    </div>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="violationsTable">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-50px ps-4">No</th>
                                <th class="min-w-200px">Nama Pelanggaran</th>
                                <th class="min-w-100px text-center">Poin</th>
                                <th class="min-w-200px">Keterangan</th>
                                <th class="text-end min-w-150px pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse($violations as $index => $violation)
                            <tr>
                                <td class="ps-4">
                                    <div class="badge badge-light-primary fw-bold">{{ $violations->firstItem() + $index }}</div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-800 fw-bold mb-1">{{ $violation->name }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light-danger fw-bold fs-6">{{ $violation->point_value }} Poin</span>
                                </td>
                                <td>
                                    <span class="text-gray-600">{{ $violation->description ?? '-' }}</span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.violations.edit', $violation) }}" class="btn btn-icon btn-light-primary btn-sm me-2" data-bs-toggle="tooltip" title="Edit">
                                        <i class="ki-duotone ki-pencil fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <form action="{{ route('admin.violations.destroy', $violation) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-light-danger btn-sm" data-bs-toggle="tooltip" title="Hapus" onclick="return confirm('Yakin ingin menghapus jenis pelanggaran ini?\n\nNama: {{ $violation->name }}\nPoin: {{ $violation->point_value }}')">
                                            <i class="ki-duotone ki-trash fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-10">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-inbox fs-3x text-gray-400 mb-3"></i>
                                        <span class="text-gray-600 fs-5">Belum ada data jenis pelanggaran</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($violations->hasPages())
                <div class="d-flex justify-content-between align-items-center flex-wrap pt-5">
                    <div class="text-gray-600">
                        Menampilkan {{ $violations->firstItem() }} - {{ $violations->lastItem() }} dari {{ $violations->total() }} data
                    </div>
                    <div>
                        {{ $violations->links() }}
                    </div>
                </div>
                @endif
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

    </div>
</div>

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('#violationsTable tbody tr');
        let visibleCount = 0;

        tableRows.forEach(row => {
            // Skip empty state row
            if (row.cells.length === 1 && row.cells[0].colSpan > 1) {
                return;
            }
            
            let text = row.textContent.toLowerCase();
            if (text.includes(searchValue)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Show/hide pagination based on search
        const paginationDiv = document.querySelector('.d-flex.justify-content-between.align-items-center.flex-wrap.pt-5');
        if (paginationDiv) {
            paginationDiv.style.display = searchValue ? 'none' : '';
        }
    });
</script>
@endpush
@endsection
