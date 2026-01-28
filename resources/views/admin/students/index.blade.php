@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 gap-md-3 mb-4 mb-md-5">
            <div>
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 fs-md-3 fs-lg-2 my-0">Data Siswa</h1>
            </div>
            <div class="w-100 w-md-auto">
                <a href="{{ route('admin.students.create') }}" class="btn btn-sm fw-bold btn-primary w-100 w-md-auto">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    <span class="d-none d-sm-inline">Tambah Siswa</span>
                    <span class="d-inline d-sm-none">Tambah</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center p-3 p-md-4 p-lg-5 mb-5 mb-lg-8 mb-xl-10">
                <i class="ki-duotone ki-shield-tick fs-2x fs-md-2hx fs-lg-2hx text-success me-2 me-md-3 me-lg-4"><span class="path1"></span><span class="path2"></span></i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-success fs-7 fs-md-6 fs-lg-5">Berhasil</h4>
                    <span class="fs-8 fs-md-7 fs-lg-6">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-header border-0 pt-4 pt-md-5 pt-lg-6 pb-0">
                <div class="card-title w-100">
                    <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 gap-md-3 w-100 search-wrapper">
                        <div class="d-flex align-items-center position-relative flex-grow-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4 ms-md-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" id="searchInput" class="form-control form-control-solid w-100 ps-12 ps-md-13"
                                   placeholder="Cari NIS atau Nama"/>
                        </div>
                        <select id="classFilter" class="form-select form-select-solid w-100 w-md-auto">
                            <option value="">Semua Kelas</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body py-3 py-md-4 px-2 px-md-3 px-lg-7">
                <div class="table-responsive">
                    <table id="studentsTable" class="table align-middle table-row-dashed fs-8 fs-md-7 fs-lg-6 gy-3 gy-md-4 gy-lg-5">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-8 fs-lg-7 text-uppercase gs-0">
                                <th class="ps-2">#</th>
                                <th class="d-none d-md-table-cell">NIS</th>
                                <th>Nama</th>
                                <th class="d-none d-lg-table-cell">Kelas</th>
                                <th class="text-center">Poin</th>
                                <th class="text-end pe-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<style>
    /* Make child row details more readable */
    table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control:before,
    table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control:before {
        background-color: #009ef7;
    }
    table.dataTable > tbody > tr.child ul.dtr-details {
        width: 100%;
    }
    table.dataTable > tbody > tr.child ul.dtr-details > li {
        border-bottom: 1px solid #eee;
        padding: 0.5em 0;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#studentsTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "{{ route('admin.students.index') }}",
            data: function(d) {
                d.class_id = $('#classFilter').val();
            }
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                responsivePriority: 1,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'nis',
                name: 'nis',
                responsivePriority: 3,
                render: function(data) {
                    return '<span class="text-gray-800 fw-bold">' + data + '</span>';
                }
            },
            {
                data: 'name',
                name: 'name',
                responsivePriority: 1,
                render: function(data, type, row) {
                    return '<span class="text-gray-800 fw-bold">' + data + '</span>';
                }
            },
            {
                data: 'class_name',
                name: 'classRoom.name',
                responsivePriority: 4,
                render: function(data) {
                    return '<span class="badge badge-light">' + data + '</span>';
                }
            },
            {
                data: 'total_points',
                name: 'total_points',
                responsivePriority: 2,
                render: function(data) {
                    if (data == 0) {
                        return '<span class="badge badge-success">' + data + '</span>';
                    } else if (data < 20) {
                        return '<span class="badge badge-warning">' + data + '</span>';
                    } else {
                        return '<span class="badge badge-danger">' + data + '</span>';
                    }
                }
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                responsivePriority: 1,
                className: 'text-end'
            }
        ],
        order: [[2, 'asc']],
        language: {
            processing: "Memuat...",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Tidak ada data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(dari _MAX_ total)",
            search: "Cari:",
            paginate: {
                first: "«",
                last: "»",
                next: "›",
                previous: "‹"
            }
        }
    });

    // Custom search
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Class filter
    $('#classFilter').on('change', function() {
        table.ajax.reload();
    });
});
</script>
@endpush
