@extends('layouts.public')

@section('title', 'Papan Peringkat Siswa')

@section('page-title', 'Papan Peringkat Siswa')

@section('content')


<!--begin::Container-->
<div id="kt_content_container" class="container-xxl">
    <!--begin::Info Alert-->
    <div class="alert alert-info d-flex align-items-center p-3 p-md-4 p-lg-5 mb-4 mb-md-5">
        <i class="ki-duotone ki-information-5 fs-2x fs-md-2hx fs-lg-2x text-info me-2 me-md-3 me-lg-4">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <div class="d-flex flex-column">
            <h5 class="mb-1 text-info fs-7 fs-md-6 fs-lg-5">Informasi Peringkat</h5>
            <span class="fs-8 fs-md-7 fs-lg-6">Siswa dengan poin 0 adalah Siswa Teladan. Semakin rendah poin, semakin baik kedisiplinan siswa.</span>
        </div>
    </div>
    <!--end::Info Alert-->

    <!--begin::Leaderboard Card-->
    <div class="card mb-4 mb-md-5">
        <div class="card-header border-0 pt-4 pt-md-5 pt-lg-7 pb-0">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800 fs-4 fs-md-3 fs-lg-2">Papan Peringkat Kedisiplinan Siswa</span>
                <span class="text-gray-500 mt-1 fw-semibold fs-8 fs-md-7 fs-lg-6">Data diurutkan dari poin terendah ke tertinggi</span>
            </h3>
        </div>
        <div class="card-body pt-2 px-2 px-md-3 px-lg-7">
            <div class="table-responsive">
                <table id="kt_leaderboard_table" class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-2 gy-md-2 gy-lg-3 fs-8 fs-md-7 fs-lg-6">
                    <thead>
                        <tr class="fw-bold text-gray-800 bg-light fs-9 fs-md-8 fs-lg-7 text-uppercase">
                            <th class="text-center ps-2 w-50px w-md-60px">#</th>
                            <th class="d-none d-md-table-cell w-80px w-md-100px">NIS</th>
                            <th>Nama Siswa</th>
                            <th class="w-80px w-md-100px">Kelas</th>
                            <th class="text-center w-60px w-md-80px">Poin</th>
                            <th class="text-center d-none d-lg-table-cell w-120px w-lg-150px">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $index => $student)
                        <tr>
                            <td class="text-center ps-2">
                                @if($index == 0)
                                    <span class="badge badge-warning fs-8 fs-md-7 fs-lg-6">🥇 1</span>
                                @elseif($index == 1)
                                    <span class="badge badge-light-primary fs-8 fs-md-7 fs-lg-6">🥈 2</span>
                                @elseif($index == 2)
                                    <span class="badge badge-light-danger fs-8 fs-md-7 fs-lg-6">🥉 3</span>
                                @else
                                    <span class="badge badge-light fs-8 fs-md-7 fs-lg-7">{{ $index + 1 }}</span>
                                @endif
                            </td>
                            <td class="d-none d-md-table-cell">
                                <span class="text-gray-800 fw-semibold fs-8 fs-md-7 fs-lg-6">{{ $student->nis }}</span>
                            </td>
                            <td>
                                <span class="text-gray-800 fw-bold fs-8 fs-md-7 fs-lg-6">{{ Str::limit($student->name, 30) }}</span>
                                <span class="d-block d-md-none text-muted fs-9 fw-semibold">{{ $student->nis }}</span>
                            </td>
                            <td>
                                <span class="badge badge-light-primary fs-9 fs-md-8 fs-lg-7">{{ $student->classRoom->name }}</span>
                            </td>
                            <td class="text-center">
                                @if($student->total_points == 0)
                                    <span class="badge badge-success fs-8 fs-md-7 fs-lg-6">{{ $student->total_points }}</span>
                                @elseif($student->total_points <= 19)
                                    <span class="badge badge-warning fs-8 fs-md-7 fs-lg-6">{{ $student->total_points }}</span>
                                @else
                                    <span class="badge badge-danger fs-8 fs-md-7 fs-lg-6">{{ $student->total_points }}</span>
                                @endif
                            </td>
                            <td class="text-center d-none d-lg-table-cell">
                                @if($student->total_points == 0)
                                    <span class="badge badge-success fs-8 fs-lg-7">Siswa Teladan</span>
                                @elseif($student->total_points <= 19)
                                    <span class="badge badge-warning fs-8 fs-lg-7">Perlu Perhatian</span>
                                @else
                                    <span class="badge badge-danger fs-8 fs-lg-7">Pelanggaran Berat</span>
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
    <div class="row g-3 g-md-4 g-lg-5 g-xl-10 mb-4 mb-md-5 mb-xl-10">
        <!--begin::Legend Card-->
        <div class="col-12 col-xl-6">
            <div class="card h-100">
                <div class="card-header border-0 pt-4 pt-md-5 pt-lg-7 pb-0">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800 fs-5 fs-md-4 fs-lg-4">📌 Keterangan Status</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-9 fs-md-8 fs-lg-7">Kategori berdasarkan total poin pelanggaran</span>
                    </h3>
                </div>
                <div class="card-body pt-3 pt-md-4 pt-lg-5 px-3 px-md-4 px-lg-7">
                    <div class="mb-4 mb-md-5 mb-lg-7">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-30px symbol-md-35px symbol-lg-45px me-2 me-md-3 me-lg-4">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-duotone ki-check-circle fs-3 fs-lg-2x text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="badge badge-success me-2 fs-8 fs-lg-7">0 Poin</span>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-gray-800 fs-6 fs-lg-5">Siswa Teladan</span>
                                    <span class="text-muted fs-8 fs-lg-7">Tidak ada pelanggaran yang tercatat</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="separator separator-dashed mb-5 mb-lg-7"></div>

                    <div class="mb-5 mb-lg-7">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-35px symbol-lg-45px me-3 me-lg-4">
                                <span class="symbol-label bg-light-warning">
                                    <i class="ki-duotone ki-information-5 fs-3 fs-lg-2x text-warning">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="badge badge-warning me-2 fs-8 fs-lg-7">1-19 Poin</span>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-gray-800 fs-6 fs-lg-5">Perlu Perhatian</span>
                                    <span class="text-muted fs-8 fs-lg-7">Pelanggaran ringan yang perlu diperhatikan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="separator separator-dashed mb-5 mb-lg-7"></div>

                    <div>
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-35px symbol-lg-45px me-3 me-lg-4">
                                <span class="symbol-label bg-light-danger">
                                    <i class="ki-duotone ki-cross-circle fs-3 fs-lg-2x text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="badge badge-danger me-2 fs-8 fs-lg-7">≥20 Poin</span>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-gray-800 fs-6 fs-lg-5">Pelanggaran Berat</span>
                                    <span class="text-muted fs-8 fs-lg-7">Memerlukan pembinaan khusus</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Legend Card-->

        <!--begin::Statistics Card-->
        <div class="col-12 col-xl-6">
            <div class="card h-100">
                <div class="card-header border-0 pt-4 pt-md-5 pt-lg-7 pb-0">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800 fs-5 fs-md-4 fs-lg-4">📊 Statistik Siswa</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-9 fs-md-8 fs-lg-7">Distribusi siswa berdasarkan kategori</span>
                    </h3>
                </div>
                <div class="card-body pt-4 pt-lg-5">
                    <!--begin::Stat Item-->
                    <div class="d-flex flex-stack mb-5 mb-lg-7">
                        <div class="d-flex align-items-center flex-grow-1">
                            <div class="symbol symbol-40px symbol-lg-50px me-3 me-lg-4">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-duotone ki-people fs-3 fs-lg-2x text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold fs-6 fs-lg-5 d-block">Siswa Teladan</span>
                                <span class="text-muted fw-semibold fs-8 fs-lg-7">0 Poin</span>
                            </div>
                        </div>
                        <span class="fw-bolder text-gray-700 fs-3 fs-lg-2">{{ \App\Models\Student::where('total_points', 0)->count() }}</span>
                    </div>
                    <!--end::Stat Item-->

                    <div class="separator separator-dashed mb-5 mb-lg-7"></div>

                    <!--begin::Stat Item-->
                    <div class="d-flex flex-stack mb-5 mb-lg-7">
                        <div class="d-flex align-items-center flex-grow-1">
                            <div class="symbol symbol-40px symbol-lg-50px me-3 me-lg-4">
                                <span class="symbol-label bg-light-warning">
                                    <i class="ki-duotone ki-people fs-3 fs-lg-2x text-warning">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold fs-6 fs-lg-5 d-block">Perlu Perhatian</span>
                                <span class="text-muted fw-semibold fs-8 fs-lg-7">1-19 Poin</span>
                            </div>
                        </div>
                        <span class="fw-bolder text-gray-700 fs-3 fs-lg-2">{{ \App\Models\Student::whereBetween('total_points', [1, 19])->count() }}</span>
                    </div>
                    <!--end::Stat Item-->

                    <div class="separator separator-dashed mb-5 mb-lg-7"></div>

                    <!--begin::Stat Item-->
                    <div class="d-flex flex-stack">
                        <div class="d-flex align-items-center flex-grow-1">
                            <div class="symbol symbol-40px symbol-lg-50px me-3 me-lg-4">
                                <span class="symbol-label bg-light-danger">
                                    <i class="ki-duotone ki-people fs-3 fs-lg-2x text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold fs-6 fs-lg-5 d-block">Pelanggaran Berat</span>
                                <span class="text-muted fw-semibold fs-8 fs-lg-7">≥20 Poin</span>
                            </div>
                        </div>
                        <span class="fw-bolder text-gray-700 fs-3 fs-lg-2">{{ \App\Models\Student::where('total_points', '>=', 20)->count() }}</span>
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
