@extends('layouts.public')

@section('title', 'Papan Peringkat Siswa')

@section('page-title', 'Papan Peringkat Siswa')

@section('content')


<!--begin::Container-->
<div id="kt_content_container" class="container-xxl">
    <!--begin::Info Alert-->
    <div class="alert alert-info d-flex align-items-center mb-5">
        <i class="ki-duotone ki-information-5 fs-2x text-info me-4">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <div class="d-flex flex-column">
            <h5 class="mb-1 text-info">Informasi Peringkat</h5>
            <span>Siswa dengan poin 0 adalah Siswa Teladan. Semakin rendah poin, semakin baik kedisiplinan siswa.</span>
        </div>
    </div>
    <!--end::Info Alert-->

    <!--begin::Leaderboard Card-->
    <div class="card mb-5">
        <div class="card-header border-0 pt-7">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800 fs-2">Papan Peringkat Kedisiplinan Siswa</span>
                <span class="text-gray-500 mt-1 fw-semibold fs-6">Data diurutkan dari poin terendah ke tertinggi</span>
            </h3>
        </div>
        <div class="card-body pt-2">
            <div class="table-responsive">
                <table id="kt_leaderboard_table" class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-3">
                    <thead>
                        <tr class="fw-bold text-gray-800 bg-light">
                            <th class="text-center min-w-80px">Peringkat</th>
                            <th class="min-w-100px">NIS</th>
                            <th class="min-w-200px">Nama Siswa</th>
                            <th class="min-w-100px">Kelas</th>
                            <th class="text-center min-w-100px">Total Poin</th>
                            <th class="text-center min-w-150px">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $index => $student)
                        <tr>
                            <td class="text-center">
                                @if($index == 0)
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="ki-duotone ki-award fs-2x text-warning me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        <span class="badge badge-warning fs-5">1</span>
                                    </div>
                                @elseif($index == 1)
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="ki-duotone ki-award fs-2x text-muted me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        <span class="badge badge-light-primary fs-5">2</span>
                                    </div>
                                @elseif($index == 2)
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="ki-duotone ki-award fs-2x text-danger me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        <span class="badge badge-light-danger fs-5">3</span>
                                    </div>
                                @else
                                    <span class="badge badge-light fs-4">{{ $index + 1 }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-gray-800 fw-semibold">{{ $student->nis }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-circle symbol-35px me-3 {{ $student->total_points == 0 ? 'bg-light-success' : 'bg-light-primary' }}">
                                        <i class="ki-duotone {{ $student->total_points == 0 ? 'ki-check-circle' : 'ki-profile-user' }} fs-3 {{ $student->total_points == 0 ? 'text-success' : 'text-primary' }}">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            @if($student->total_points == 0)
                                            <span class="path3"></span>
                                            @endif
                                        </i>
                                    </div>
                                    <span class="text-gray-800 fw-bold">{{ $student->name }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-light-primary">{{ $student->classRoom->name }}</span>
                            </td>
                            <td class="text-center">
                                @if($student->total_points == 0)
                                    <span class="badge badge-success fs-4">{{ $student->total_points }}</span>
                                @elseif($student->total_points <= 19)
                                    <span class="badge badge-warning fs-4">{{ $student->total_points }}</span>
                                @else
                                    <span class="badge badge-danger fs-4">{{ $student->total_points }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($student->total_points == 0)
                                    <span class="badge badge-success fs-6">
                                        <i class="ki-duotone ki-check-circle me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Siswa Teladan
                                    </span>
                                @elseif($student->total_points <= 19)
                                    <span class="badge badge-warning fs-6">
                                        <i class="ki-duotone ki-information-5 me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        Perlu Perhatian
                                    </span>
                                @else
                                    <span class="badge badge-danger fs-6">
                                        <i class="ki-duotone ki-cross-circle me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Pelanggaran Berat
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Leaderboard Card-->

    <!--begin::Legend & Statistics-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Legend Card-->
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header border-0 pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">📌 Keterangan Status</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-7">Kategori berdasarkan total poin pelanggaran</span>
                    </h3>
                </div>
                <div class="card-body pt-5">
                    <div class="mb-7">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-duotone ki-check-circle fs-2x text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="badge badge-success me-2">0 Poin</span>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-gray-800 fs-5">Siswa Teladan</span>
                                    <span class="text-muted fs-7">Tidak ada pelanggaran yang tercatat</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="separator separator-dashed mb-7"></div>

                    <div class="mb-7">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-light-warning">
                                    <i class="ki-duotone ki-information-5 fs-2x text-warning">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="badge badge-warning me-2">1-19 Poin</span>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-gray-800 fs-5">Perlu Perhatian</span>
                                    <span class="text-muted fs-7">Pelanggaran ringan yang perlu diperhatikan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="separator separator-dashed mb-7"></div>

                    <div>
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-light-danger">
                                    <i class="ki-duotone ki-cross-circle fs-2x text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="badge badge-danger me-2">≥20 Poin</span>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-gray-800 fs-5">Pelanggaran Berat</span>
                                    <span class="text-muted fs-7">Memerlukan pembinaan khusus</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Legend Card-->

        <!--begin::Statistics Card-->
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header border-0 pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">📊 Statistik Siswa</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-7">Distribusi siswa berdasarkan kategori</span>
                    </h3>
                </div>
                <div class="card-body pt-5">
                    <!--begin::Stat Item-->
                    <div class="d-flex flex-stack mb-7">
                        <div class="d-flex align-items-center flex-grow-1">
                            <div class="symbol symbol-50px me-4">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-duotone ki-people fs-2x text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold fs-5 d-block">Siswa Teladan</span>
                                <span class="text-muted fw-semibold fs-7">0 Poin</span>
                            </div>
                        </div>
                        <span class="fw-bolder text-gray-700 fs-2">{{ \App\Models\Student::where('total_points', 0)->count() }}</span>
                    </div>
                    <!--end::Stat Item-->

                    <div class="separator separator-dashed mb-7"></div>

                    <!--begin::Stat Item-->
                    <div class="d-flex flex-stack mb-7">
                        <div class="d-flex align-items-center flex-grow-1">
                            <div class="symbol symbol-50px me-4">
                                <span class="symbol-label bg-light-warning">
                                    <i class="ki-duotone ki-people fs-2x text-warning">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold fs-5 d-block">Perlu Perhatian</span>
                                <span class="text-muted fw-semibold fs-7">1-19 Poin</span>
                            </div>
                        </div>
                        <span class="fw-bolder text-gray-700 fs-2">{{ \App\Models\Student::whereBetween('total_points', [1, 19])->count() }}</span>
                    </div>
                    <!--end::Stat Item-->

                    <div class="separator separator-dashed mb-7"></div>

                    <!--begin::Stat Item-->
                    <div class="d-flex flex-stack">
                        <div class="d-flex align-items-center flex-grow-1">
                            <div class="symbol symbol-50px me-4">
                                <span class="symbol-label bg-light-danger">
                                    <i class="ki-duotone ki-people fs-2x text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold fs-5 d-block">Pelanggaran Berat</span>
                                <span class="text-muted fw-semibold fs-7">≥20 Poin</span>
                            </div>
                        </div>
                        <span class="fw-bolder text-gray-700 fs-2">{{ \App\Models\Student::where('total_points', '>=', 20)->count() }}</span>
                    </div>
                    <!--end::Stat Item-->
                </div>
            </div>
        </div>
        <!--end::Statistics Card-->
    </div>
    <!--end::Legend & Statistics-->
</div>
<!--end::Container-->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#kt_leaderboard_table').DataTable({
        responsive: true,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
        order: [[4, 'asc']], // Order by Total Poin ascending
        language: {
            processing: "Sedang memproses...",
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ siswa",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 siswa",
            infoFiltered: "(disaring dari _MAX_ total siswa)",
            infoPostFix: "",
            loadingRecords: "Memuat...",
            zeroRecords: "Tidak ada data siswa yang ditemukan",
            emptyTable: "Tidak ada data siswa",
            paginate: {
                first: "Pertama",
                previous: "Sebelumnya",
                next: "Selanjutnya",
                last: "Terakhir"
            },
            aria: {
                sortAscending: ": aktifkan untuk mengurutkan kolom secara ascending",
                sortDescending: ": aktifkan untuk mengurutkan kolom secara descending"
            }
        },
        columnDefs: [
            {
                targets: 0,
                orderable: false
            },
            {
                targets: [4, 5],
                className: 'text-center'
            }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    });
});
</script>
@endpush
