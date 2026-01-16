@extends('layouts.app')

@section('title', 'Data Penghargaan Siswa')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">Data Penghargaan Siswa</h1>
            </div>
            <div>
                <a href="{{ route('admin.rewards.eligible') }}" class="btn btn-sm btn-light-primary me-2">
                    <i class="ki-duotone ki-user-tick fs-2"></i>
                    Siswa Berhak
                </a>
                <a href="{{ route('admin.rewards.create') }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Berikan Penghargaan
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
                    <div class="d-flex align-items-center position-relative my-1 me-3">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" id="searchInput" class="form-control form-control-solid w-250px ps-13"
                               placeholder="Cari siswa..."/>
                    </div>
                </div>
                <div class="card-toolbar">
                    <select id="classFilter" class="form-select form-select-solid w-150px">
                        <option value="">Semua Kelas</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table id="rewardsTable" class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-50px">No</th>
                                <th class="min-w-150px">Siswa</th>
                                <th class="min-w-100px">Kelas</th>
                                <th class="min-w-100px">Semester</th>
                                <th class="min-w-200px">Keterangan</th>
                                <th class="min-w-100px">Tanggal</th>
                                <th class="text-end min-w-150px">Aksi</th>
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
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#rewardsTable').DataTable({
        processing: true,
        serverSide: true,
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
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'student_name',
                name: 'student.name',
                render: function(data) {
                    return '<span class="text-gray-800 fw-bold">' + data + '</span>';
                }
            },
            {
                data: 'class_name',
                name: 'student.classRoom.name',
                render: function(data) {
                    return '<span class="badge badge-light">' + data + '</span>';
                }
            },
            {
                data: 'semester',
                name: 'semester',
                render: function(data) {
                    return '<span class="badge badge-light-primary">' + data + '</span>';
                }
            },
            {
                data: 'description',
                name: 'description',
                render: function(data) {
                    return data ? (data.length > 50 ? data.substring(0, 50) + '...' : data) : '-';
                }
            },
            {
                data: 'date_formatted',
                name: 'created_at',
                searchable: false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-end'
            }
        ],
        order: [[5, 'desc']],
        language: {
            processing: "Memuat...",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Tidak ada data",
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

    // Class filter
    $('#classFilter').on('change', function() {
        table.ajax.reload();
    });
});
</script>
@endpush
