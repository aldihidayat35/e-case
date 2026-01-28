@extends('layouts.app')

@section('title', 'Data Penghargaan Siswa')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-5">
            <div>
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-4 fs-lg-3 my-0">Data Penghargaan Siswa</h1>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button onclick="printRewards()" class="btn btn-sm fw-bold btn-light-success">
                    <i class="ki-duotone ki-printer fs-2"></i>
                    <span class="d-none d-sm-inline">Cetak</span>
                </button>
                <a href="{{ route('admin.rewards.eligible') }}" class="btn btn-sm btn-light-primary">
                    <i class="ki-duotone ki-user-tick fs-2"></i>
                    <span class="d-none d-sm-inline">Berhak</span>
                </a>
                <a href="{{ route('admin.rewards.create') }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    <span class="d-none d-sm-inline">Berikan Reward</span>
                    <span class="d-inline d-sm-none">Baru</span>
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
            <div class="card-header border-0 pt-5 pt-lg-6">
                <div class="card-title w-100">
                    <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-3 w-100">
                        <div class="d-flex align-items-center position-relative flex-grow-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" id="searchInput" class="form-control form-control-solid w-100 ps-13"
                                   placeholder="Cari siswa..."/>
                        </div>
                        <select id="classFilter" class="form-select form-select-solid w-auto">
                            <option value="">Semua Kelas</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0 px-3 px-lg-7">
                <div class="table-responsive">
                    <table id="rewardsTable" class="table align-middle table-row-dashed fs-7 fs-lg-6 gy-4 gy-lg-5">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-8 fs-lg-7 text-uppercase gs-0">
                                <th class="ps-2">#</th>
                                <th>Siswa</th>
                                <th class="d-none d-lg-table-cell">Kelas</th>
                                <th class="d-none d-md-table-cell">Semester</th>
                                <th class="d-none d-xl-table-cell">Keterangan</th>
                                <th class="d-none d-md-table-cell">Tanggal</th>
                                <th class="text-end pe-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
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
    var table = $('#rewardsTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "{{ route('admin.rewards.index') }}",
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
                data: 'student_name',
                name: 'student.name',
                responsivePriority: 1,
                render: function(data) {
                    return '<span class="text-gray-800 fw-bold">' + data + '</span>';
                }
            },
            {
                data: 'class_name',
                name: 'student.classRoom.name',
                responsivePriority: 4,
                render: function(data) {
                    return '<span class="badge badge-light">' + data + '</span>';
                }
            },
            {
                data: 'semester',
                name: 'semester',
                responsivePriority: 3,
                render: function(data) {
                    return '<span class="badge badge-light-primary">' + data + '</span>';
                }
            },
            {
                data: 'description',
                name: 'description',
                responsivePriority: 5,
                render: function(data) {
                    return data ? (data.length > 50 ? data.substring(0, 50) + '...' : data) : '-';
                }
            },
            {
                data: 'date_formatted',
                name: 'created_at',
                searchable: false,
                responsivePriority: 4
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
        order: [[5, 'desc']],
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

// Print function
function printRewards() {
    var printWindow = window.open('', '_blank');
    var printContent = `
        <html>
        <head>
            <title>Data Penghargaan Siswa - {{ $appData->school_name ?? 'E-Case' }}</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; margin-bottom: 30px; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; font-weight: bold; }
                .text-center { text-align: center; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>{{ $appData->school_name ?? 'Sekolah' }}</h1>
                <h2>Data Penghargaan Siswa</h2>
                <p>Dicetak pada: ` + new Date().toLocaleDateString('id-ID') + `</p>
            </div>
            <table id="printTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jenis Penghargaan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </body>
        </html>
    `;
    
    printWindow.document.write(printContent);
    
    // Get data from current table
    var tableData = table.rows().data();
    var tbody = '';
    tableData.each(function(value, index) {
        tbody += '<tr>';
        tbody += '<td class="text-center">' + (index + 1) + '</td>';
        tbody += '<td>' + value.nis + '</td>';
        tbody += '<td>' + value.student_name + '</td>';
        tbody += '<td>' + value.class_name + '</td>';
        tbody += '<td>' + value.achievement_type + '</td>';
        tbody += '<td>' + value.date_formatted + '</td>';
        tbody += '</tr>';
    });
    
    printWindow.document.getElementById('printTable').getElementsByTagName('tbody')[0].innerHTML = tbody;
    printWindow.document.close();
    printWindow.print();
}
</script>
@endpush
