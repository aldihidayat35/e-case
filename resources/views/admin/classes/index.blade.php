@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-5">
            <div>
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-4 fs-lg-3 my-0">Data Kelas</h1>
            </div>
            <div>
                <a href="{{ route('admin.classes.create') }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    <span class="d-none d-sm-inline">Tambah Kelas</span>
                    <span class="d-inline d-sm-none">Tambah</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center p-4 p-lg-5 mb-8 mb-lg-10">
                <i class="ki-duotone ki-shield-tick fs-2x fs-lg-2hx text-success me-3 me-lg-4"><span class="path1"></span><span class="path2"></span></i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-success fs-6 fs-lg-5">Berhasil</h4>
                    <span class="fs-7 fs-lg-6">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center p-4 p-lg-5 mb-8 mb-lg-10">
                <i class="ki-duotone ki-shield-cross fs-2x fs-lg-2hx text-danger me-3 me-lg-4"><span class="path1"></span><span class="path2"></span></i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-danger fs-6 fs-lg-5">Error</h4>
                    <span class="fs-7 fs-lg-6">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!--begin::Card-->
        <div class="card">
            <div class="card-header border-0 pt-5 pt-lg-6">
                <div class="card-title w-100">
                    <div class="d-flex align-items-center position-relative flex-grow-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" id="searchInput" class="form-control form-control-solid w-100 w-md-250px ps-13"
                               placeholder="Cari kelas..."/>
                    </div>
                </div>
            </div>
            <div class="card-body py-4 px-3 px-lg-7">
                <div class="table-responsive">
                    <table id="classesTable" class="table align-middle table-row-dashed fs-7 fs-lg-6 gy-4 gy-lg-5">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-8 fs-lg-7 text-uppercase gs-0">
                                <th class="ps-2">#</th>
                                <th>Nama Kelas</th>
                                <th class="text-center">Jumlah Siswa</th>
                                <th class="text-end pe-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end::Card-->

    </div>
</div>
<!--end::Content-->
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<style>
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
    var table = $('#classesTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('admin.classes.index') }}",
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
                data: 'name',
                name: 'name',
                responsivePriority: 1,
                render: function(data) {
                    return '<span class="text-gray-800 fw-bold">' + data + '</span>';
                }
            },
            {
                data: 'students_count',
                name: 'students_count',
                responsivePriority: 2,
                render: function(data) {
                    return '<span class="badge badge-light-primary">' + data + ' siswa</span>';
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
        order: [[1, 'asc']],
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

    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });
});
</script>
@endpush
