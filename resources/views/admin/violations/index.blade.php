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
        <div class="alert alert-success d-flex align-items-center p-5 mb-10">
            <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
            <div class="d-flex flex-column">
                <h4 class="mb-1 text-success">Berhasil</h4>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
            <i class="ki-duotone ki-cross-circle fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
            <div class="d-flex flex-column">
                <h4 class="mb-1 text-danger">Error</h4>
                <span>{{ session('error') }}</span>
            </div>
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
                        <input type="text" id="searchInput" class="form-control form-control-solid w-250px ps-13" placeholder="Cari jenis pelanggaran..." />
                    </div>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table id="violationsTable" class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-50px">No</th>
                                <th class="min-w-200px">Nama Pelanggaran</th>
                                <th class="min-w-100px text-center">Poin</th>
                                <th class="min-w-200px">Keterangan</th>
                                <th class="text-end min-w-150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#violationsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.violations.index') }}"
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return '<div class="badge badge-light-primary fw-bold">' + (meta.row + meta.settings._iDisplayStart + 1) + '</div>';
                }
            },
            {
                data: 'name',
                name: 'name',
                render: function(data) {
                    return '<span class="text-gray-800 fw-bold">' + data + '</span>';
                }
            },
            {
                data: 'point_value',
                name: 'point_value',
                className: 'text-center',
                render: function(data) {
                    return '<span class="badge badge-light-danger fw-bold fs-6">' + data + ' Poin</span>';
                }
            },
            {
                data: 'description',
                name: 'description',
                render: function(data) {
                    return '<span class="text-gray-600">' + (data || '-') + '</span>';
                }
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-end'
            }
        ],
        order: [[1, 'asc']],
        language: {
            processing: "Memuat...",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Tidak ada data jenis pelanggaran",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            search: "Cari:",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        }
    });

    // Custom search
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    // Reinitialize tooltips after table redraw
    table.on('draw', function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
});
</script>
@endpush
