@extends('layouts.public')

@section('title', $appData->school_name . ' - Beranda')

@section('content')
<!--begin::Container-->
<div id="kt_content_container" class="container-xxl">

    <!--begin::Welcome Header-->
    <div class="card bg-primary mb-5 mb-xl-10">
        <div class="card-body py-6 py-lg-10">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8">
                    <h1 class="text-white fw-bold fs-3 fs-lg-2x mb-2 mb-lg-3">Selamat Datang di {{ $appData->app_name ?? 'E-Case' }}</h1>
                    <p class="text-white opacity-75 fs-6 fs-lg-5 mb-0">Sistem manajemen pelanggaran dan penghargaan siswa {{ $appData->school_name }}</p>
                </div>
                <div class="col-lg-4 text-end d-none d-lg-block">
                    <i class="ki-duotone ki-security-user text-white fs-5x opacity-50">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
        </div>
    </div>
    <!--end::Welcome Header-->

    <!--begin::Statistics Cards-->
    <div class="row g-3 g-lg-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-6 col-lg-6 col-xl-3">
            <div class="card card-flush shadow-sm h-100">
                <div class="card-body text-center py-5 py-lg-8">
                    <div class="mb-3 mb-lg-5">
                        <i class="ki-duotone ki-people fs-2x fs-lg-3x text-success">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </div>
                    <div class="fs-2 fs-lg-2hx fw-bold text-gray-900 mb-1 mb-lg-2">{{ $totalStudents }}</div>
                    <div class="text-gray-600 fw-semibold fs-7 fs-lg-5">Total Siswa</div>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-6 col-lg-6 col-xl-3">
            <div class="card card-flush shadow-sm h-100">
                <div class="card-body text-center py-5 py-lg-8">
                    <div class="mb-3 mb-lg-5">
                        <i class="ki-duotone ki-notification-status fs-2x fs-lg-3x text-warning">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </div>
                    <div class="fs-2 fs-lg-2hx fw-bold text-gray-900 mb-1 mb-lg-2">{{ $totalViolations }}</div>
                    <div class="text-gray-600 fw-semibold fs-7 fs-lg-5">Total Pelanggaran</div>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-6 col-lg-6 col-xl-3">
            <div class="card card-flush shadow-sm h-100">
                <div class="card-body text-center py-5 py-lg-8">
                    <div class="mb-3 mb-lg-5">
                        <i class="ki-duotone ki-award fs-2x fs-lg-3x text-primary">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <div class="fs-2 fs-lg-2hx fw-bold text-gray-900 mb-1 mb-lg-2">{{ $totalRewards }}</div>
                    <div class="text-gray-600 fw-semibold fs-7 fs-lg-5">Reward Diberikan</div>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-6 col-lg-6 col-xl-3">
            <div class="card card-flush shadow-sm h-100">
                <div class="card-body text-center py-5 py-lg-8">
                    <div class="mb-3 mb-lg-5">
                        <i class="ki-duotone ki-element-11 fs-2x fs-lg-3x text-danger">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </div>
                    <div class="fs-2 fs-lg-2hx fw-bold text-gray-900 mb-1 mb-lg-2">{{ $totalClasses }}</div>
                    <div class="text-gray-600 fw-semibold fs-7 fs-lg-5">Total Kelas</div>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Statistics Cards-->

    <!--begin::Row Charts-->
    <div class="row g-3 g-lg-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col - Monthly Chart-->
        <div class="col-12 col-xl-8">
            <div class="card card-flush h-100">
                <div class="card-header pt-5 pt-lg-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800 fs-6 fs-lg-4">📊 Grafik Pelanggaran Bulanan</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-7 fs-lg-6">Trend pelanggaran 6 bulan terakhir</span>
                    </h3>
                </div>
                <div class="card-body pt-4 pt-lg-6">
                    <canvas id="monthlyChart" style="height: 250px; max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col - Student Status-->
        <div class="col-12 col-xl-4">
            <div class="card card-flush h-100">
                <div class="card-header pt-5 pt-lg-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800 fs-6 fs-lg-4">📈 Status Siswa</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-7 fs-lg-6">Berdasarkan poin pelanggaran</span>
                    </h3>
                </div>
                <div class="card-body d-flex flex-column justify-content-center py-4 py-lg-6">
                    <div class="mb-5 mb-lg-7">
                        <div class="d-flex align-items-center mb-2 mb-lg-3">
                            <div class="bullet bullet-dot bg-success me-2 me-lg-3" style="width: 10px; height: 10px;"></div>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold fs-6 fs-lg-5">Baik (0 poin)</span>
                            </div>
                            <span class="fw-bolder text-gray-700 fs-4 fs-lg-2">{{ $goodStudents }}</span>
                        </div>
                        <div class="separator separator-dashed"></div>
                    </div>

                    <div class="mb-5 mb-lg-7">
                        <div class="d-flex align-items-center mb-2 mb-lg-3">
                            <div class="bullet bullet-dot bg-warning me-2 me-lg-3" style="width: 10px; height: 10px;"></div>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold fs-6 fs-lg-5">Peringatan (1-19)</span>
                            </div>
                            <span class="fw-bolder text-gray-700 fs-4 fs-lg-2">{{ $warningStudents }}</span>
                        </div>
                        <div class="separator separator-dashed"></div>
                    </div>

                    <div>
                        <div class="d-flex align-items-center">
                            <div class="bullet bullet-dot bg-danger me-2 me-lg-3" style="width: 10px; height: 10px;"></div>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold fs-6 fs-lg-5">Bahaya (≥20)</span>
                            </div>
                            <span class="fw-bolder text-gray-700 fs-4 fs-lg-2">{{ $dangerStudents }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row Charts-->

    <!--begin::Row Charts 2-->
    <div class="row g-3 g-lg-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col - Top Violations-->
        <div class="col-12 col-xl-6">
            <div class="card card-flush h-100">
                <div class="card-header pt-5 pt-lg-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800 fs-6 fs-lg-4">🔝 Top Jenis Pelanggaran</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-7 fs-lg-6">Pelanggaran yang paling sering terjadi</span>
                    </h3>
                </div>
                <div class="card-body pt-4 pt-lg-6">
                    <canvas id="topViolationsChart" style="height: 250px; max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col - Class Violations-->
        <div class="col-12 col-xl-6">
            <div class="card card-flush h-100">
                <div class="card-header pt-5 pt-lg-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800 fs-6 fs-lg-4">📚 Pelanggaran per Kelas</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-7 fs-lg-6">Distribusi pelanggaran tiap kelas</span>
                    </h3>
                </div>
                <div class="card-body pt-4 pt-lg-6">
                    <canvas id="classChart" style="height: 250px; max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row Charts 2-->

    <!--begin::Row-->
    <div class="row g-3 g-lg-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-12 col-xl-6">
            <!--begin::Card-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-5 pt-lg-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800 fs-6 fs-lg-4">🏆 Top 10 Siswa Terdisiplin</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-7 fs-lg-6">Siswa dengan poin pelanggaran terendah</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-4 pt-lg-6">
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle gs-0 gy-2 gy-lg-3 my-0">
                            <thead>
                                <tr class="fs-8 fs-lg-7 fw-bold text-gray-500 border-bottom-0">
                                    <th class="p-0 pb-2 pb-lg-3 text-start">#</th>
                                    <th class="p-0 pb-2 pb-lg-3 text-start d-none d-md-table-cell">NIS</th>
                                    <th class="p-0 pb-2 pb-lg-3 text-start">NAMA</th>
                                    <th class="p-0 pb-2 pb-lg-3 text-start">KELAS</th>
                                    <th class="p-0 pb-2 pb-lg-3 text-end">POIN</th>
                                </tr>
                            </thead>
                           <tbody>
@forelse($topStudents as $index => $student)
<tr>
    <td class="text-start">
        <span class="badge badge-light-primary fs-8 fs-lg-7 fw-bold">{{ $index + 1 }}</span>
    </td>
    <td class="text-start d-none d-md-table-cell">
        <span class="text-gray-800 fw-bold fs-7 fs-lg-6">{{ $student->nis }}</span>
    </td>
    <td class="text-start">
        <span class="text-gray-800 fw-bold d-block fs-7 fs-lg-6">{{ $student->name }}</span>
    </td>
    <td class="text-start">
        <span class="badge badge-light fs-8 fs-lg-7">{{ $student->classRoom->name }}</span>
    </td>
    <td class="text-end">
        @if($student->total_points == 0)
            <span class="badge badge-success">0</span>
        @elseif($student->total_points < 20)
            <span class="badge badge-warning">{{ $student->total_points }}</span>
        @else
            <span class="badge badge-danger">{{ $student->total_points }}</span>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center py-10">
        <span class="text-gray-500">Belum ada data siswa</span>
    </td>
</tr>
@endforelse
</tbody>

                        </table>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-12 col-xl-6 mb-5 mb-xl-10">
            <!--begin::Card-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-5 pt-lg-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800 fs-6 fs-lg-4">📋 Pelanggaran Terbaru</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-7 fs-lg-6">5 Pelanggaran terakhir yang tercatat</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-4 py-lg-6">
                    @forelse($recentViolations as $violation)
                    <div class="d-flex flex-column flex-md-row flex-md-stack">
                        <div class="d-flex align-items-center me-3 mb-2 mb-md-0">
                            <div class="flex-grow-1">
                                <a href="#" class="text-gray-800 text-hover-primary fs-7 fs-lg-6 fw-bold">{{ $violation->student->name }}</a>
                                <span class="text-gray-500 fw-semibold d-block fs-8 fs-lg-7">
                                    {{ $violation->violation->name }} - {{ $violation->classRoom->name ?? $violation->student->classRoom->name }}
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge badge-light-danger fw-bold me-2 fs-8 fs-lg-7">+{{ $violation->point }} poin</span>
                            <span class="text-gray-500 fw-semibold fs-8 fs-lg-7">{{ $violation->date->format('d M Y') }}</span>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <div class="separator separator-dashed my-3 my-lg-4"></div>
                    @endif
                    @empty
                    <div class="text-center py-8 py-lg-10">
                        <span class="text-gray-500 fs-7 fs-lg-6">Belum ada pelanggaran tercatat</span>
                    </div>
                    @endforelse
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Info Section-->
    <div class="row g-3 g-lg-5 g-xl-10 mt-3 mt-lg-5 mb-5 mb-xl-10">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-5 p-lg-10 p-xl-17">
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-8 mb-lg-0">
                            <h3 class="fw-bold text-gray-900 mb-4 mb-lg-5 fs-5 fs-lg-3">📌 Tentang Sistem {{ $appData->app_name ?? 'E-Case' }}</h3>
                            <p class="text-gray-700 fs-7 fs-lg-5 mb-4">
                                <strong>{{ $appData->app_name ?? 'E-Case' }} (Electronic Case Management System)</strong> adalah platform berbasis web yang dirancang khusus untuk mencatat dan memantau pelanggaran serta penghargaan siswa secara transparan, objektif, dan efisien.
                            </p>
                            <div class="mb-4">
                                <h5 class="fw-bold text-gray-800 mb-3 fs-6 fs-lg-5">🎯 Tujuan Sistem:</h5>
                                <ul class="text-gray-600 fs-7 fs-lg-6 ps-4">
                                    <li class="mb-2">Meningkatkan kedisiplinan dan karakter siswa</li>
                                    <li class="mb-2">Memberikan transparansi kepada orang tua</li>
                                    <li class="mb-2">Mengurangi pencatatan manual yang rawan kesalahan</li>
                                    <li class="mb-2">Memberikan motivasi positif melalui sistem reward</li>
                                    <li class="mb-2">Memudahkan monitoring dan evaluasi</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <h3 class="fw-bold text-gray-900 mb-4 mb-lg-5 fs-5 fs-lg-3">🏫 Informasi Sekolah</h3>
                            <div class="d-flex align-items-center mb-4">
                                <div class="symbol symbol-45px symbol-lg-60px me-3 me-lg-5">
                                    <img src="{{ $appData->logo_url }}" alt="{{ $appData->school_name }}" />
                                </div>
                                <div>
                                    <h4 class="fw-bold text-gray-900 mb-1 fs-6 fs-lg-4">{{ $appData->school_name }}</h4>
                                    @if($appData->school_accreditation)
                                        <span class="badge badge-light-success fs-8 fs-lg-7">Akreditasi {{ $appData->school_accreditation }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="text-gray-600 fs-7 fs-lg-6">
                                @if($appData->school_address)
                                    <div class="d-flex align-items-start mb-3">
                                        <i class="ki-duotone ki-geolocation fs-4 fs-lg-2 text-primary me-2 me-lg-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span>{{ $appData->school_address }}</span>
                                    </div>
                                @endif

                                @if($appData->school_phone)
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="ki-duotone ki-phone fs-4 fs-lg-2 text-primary me-2 me-lg-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span>{{ $appData->school_phone }}</span>
                                    </div>
                                @endif

                                @if($appData->school_email)
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="ki-duotone ki-sms fs-4 fs-lg-2 text-primary me-2 me-lg-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span>{{ $appData->school_email }}</span>
                                    </div>
                                @endif

                                @if($appData->school_npsn)
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-shield-tick fs-4 fs-lg-2 text-primary me-2 me-lg-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span>NPSN: {{ $appData->school_npsn }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($appData->school_vision || $appData->school_mission)
                        <div class="col-12 mt-8 mt-lg-10">
                            <div class="separator separator-dashed mb-8 mb-lg-10"></div>
                            <div class="row g-3 g-lg-5">
                                @if($appData->school_vision)
                                <div class="col-12 col-lg-6">
                                    <div class="card h-100 border-primary border-dashed">
                                        <div class="card-header bg-light-primary py-4 py-lg-5">
                                            <h3 class="card-title fw-bold text-primary mb-0 fs-6 fs-lg-4">
                                                <i class="ki-duotone ki-eye text-primary me-2 fs-4 fs-lg-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                                Visi
                                            </h3>
                                        </div>
                                        <div class="card-body p-4 p-lg-6">
                                            <p class="text-gray-700 fs-7 fs-lg-6 mb-0 lh-lg">{{ $appData->school_vision }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if($appData->school_mission)
                                <div class="col-12 col-lg-6">
                                    <div class="card h-100 border-success border-dashed">
                                        <div class="card-header bg-light-success py-4 py-lg-5">
                                            <h3 class="card-title fw-bold text-success mb-0 fs-6 fs-lg-4">
                                                <i class="ki-duotone ki-rocket text-success me-2 fs-4 fs-lg-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                Misi
                                            </h3>
                                        </div>
                                        <div class="card-body p-4 p-lg-6">
                                            <p class="text-gray-700 fs-7 fs-lg-6 mb-0 lh-lg">{{ $appData->school_mission }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Info Section-->

    <!--begin::Features Section-->
    <div class="row g-3 g-lg-5 g-xl-10 mb-5 mb-xl-10">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0 pt-5 pt-lg-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800 fs-4 fs-lg-2">✨ Fitur Unggulan Sistem {{ $appData->app_name ?? 'E-Case' }}</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-7 fs-lg-6">Berbagai kemudahan untuk mengelola kedisiplinan siswa</span>
                    </h3>
                </div>
                <div class="card-body pt-4 pt-lg-5">
                    <div class="row g-4 g-lg-5">
                        <!--begin::Feature Item-->
                        <div class="col-6 col-md-4">
                            <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start text-center text-md-start mb-2">
                                <div class="symbol symbol-40px symbol-lg-50px me-0 me-md-4 mb-2 mb-md-0">
                                    <span class="symbol-label bg-light-primary">
                                        <i class="ki-duotone ki-note-2 fs-3 fs-lg-2x text-primary">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold text-gray-900 mb-1 mb-lg-2 fs-7 fs-lg-5">Pencatatan Digital</h4>
                                    <p class="text-gray-600 fs-8 fs-lg-7 mb-0 d-none d-md-block">
                                        Mencatat semua pelanggaran dan reward secara digital dengan timestamp otomatis dan akurat.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--end::Feature Item-->

                        <!--begin::Feature Item-->
                        <div class="col-6 col-md-4">
                            <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start text-center text-md-start mb-2">
                                <div class="symbol symbol-40px symbol-lg-50px me-0 me-md-4 mb-2 mb-md-0">
                                    <span class="symbol-label bg-light-success">
                                        <i class="ki-duotone ki-chart-simple fs-3 fs-lg-2x text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold text-gray-900 mb-1 mb-lg-2 fs-7 fs-lg-5">Sistem Poin</h4>
                                    <p class="text-gray-600 fs-8 fs-lg-7 mb-0 d-none d-md-block">
                                        Perhitungan poin pelanggaran otomatis dengan kategori Baik, Peringatan, dan Bahaya.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--end::Feature Item-->

                        <!--begin::Feature Item-->
                        <div class="col-6 col-md-4">
                            <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start text-center text-md-start mb-2">
                                <div class="symbol symbol-40px symbol-lg-50px me-0 me-md-4 mb-2 mb-md-0">
                                    <span class="symbol-label bg-light-warning">
                                        <i class="ki-duotone ki-award fs-3 fs-lg-2x text-warning">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold text-gray-900 mb-1 mb-lg-2 fs-7 fs-lg-5">Reward System</h4>
                                    <p class="text-gray-600 fs-8 fs-lg-7 mb-0 d-none d-md-block">
                                        Memberikan penghargaan kepada siswa berprestasi untuk memotivasi perilaku positif.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--end::Feature Item-->

                        <!--begin::Feature Item-->
                        <div class="col-6 col-md-4">
                            <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start text-center text-md-start mb-2">
                                <div class="symbol symbol-40px symbol-lg-50px me-0 me-md-4 mb-2 mb-md-0">
                                    <span class="symbol-label bg-light-danger">
                                        <i class="ki-duotone ki-graph-up fs-3 fs-lg-2x text-danger">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                        </i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold text-gray-900 mb-1 mb-lg-2 fs-7 fs-lg-5">Laporan & Statistik</h4>
                                    <p class="text-gray-600 fs-8 fs-lg-7 mb-0 d-none d-md-block">
                                        Dashboard lengkap dengan grafik dan statistik untuk monitoring dan evaluasi.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--end::Feature Item-->

                        <!--begin::Feature Item-->
                        <div class="col-6 col-md-4">
                            <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start text-center text-md-start mb-2">
                                <div class="symbol symbol-40px symbol-lg-50px me-0 me-md-4 mb-2 mb-md-0">
                                    <span class="symbol-label bg-light-info">
                                        <i class="ki-duotone ki-search-list fs-3 fs-lg-2x text-info">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold text-gray-900 mb-1 mb-lg-2 fs-7 fs-lg-5">Filter & Pencarian</h4>
                                    <p class="text-gray-600 fs-8 fs-lg-7 mb-0 d-none d-md-block">
                                        Kemudahan mencari dan memfilter data siswa, pelanggaran berdasarkan kelas dan tanggal.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--end::Feature Item-->

                        <!--begin::Feature Item-->
                        <div class="col-6 col-md-4">
                            <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start text-center text-md-start mb-2">
                                <div class="symbol symbol-40px symbol-lg-50px me-0 me-md-4 mb-2 mb-md-0">
                                    <span class="symbol-label bg-light-dark">
                                        <i class="ki-duotone ki-shield-tick fs-3 fs-lg-2x text-dark">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold text-gray-900 mb-1 mb-lg-2 fs-7 fs-lg-5">Keamanan Data</h4>
                                    <p class="text-gray-600 fs-8 fs-lg-7 mb-0 d-none d-md-block">
                                        Sistem login dengan role management untuk menjaga keamanan dan privasi data siswa.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--end::Feature Item-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Features Section-->
</div>
<!--end::Container-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Violations Chart
    const monthlyCtx = document.getElementById('monthlyChart');
    if (monthlyCtx) {
        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlyData['labels']) !!},
                datasets: [{
                    label: 'Jumlah Pelanggaran',
                    data: {!! json_encode($monthlyData['data']) !!},
                    borderColor: '#009ef7',
                    backgroundColor: 'rgba(0, 158, 247, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#009ef7',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        backgroundColor: '#1e1e2d',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#009ef7',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Total: ' + context.parsed.y + ' pelanggaran';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // Top Violations Chart
    const topViolationsCtx = document.getElementById('topViolationsChart');
    if (topViolationsCtx) {
        new Chart(topViolationsCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($topViolations->pluck('name')) !!},
                datasets: [{
                    data: {!! json_encode($topViolations->pluck('student_violations_count')) !!},
                    backgroundColor: [
                        '#009ef7',
                        '#50cd89',
                        '#ffc700',
                        '#f1416c',
                        '#7239ea'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e1e2d',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#009ef7',
                        borderWidth: 1,
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.parsed || 0;
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = ((value / total) * 100).toFixed(1);
                                return label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

    // Class Violations Chart
    const classCtx = document.getElementById('classChart');
    if (classCtx) {
        new Chart(classCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($classData['labels']) !!},
                datasets: [{
                    label: 'Jumlah Pelanggaran',
                    data: {!! json_encode($classData['data']) !!},
                    backgroundColor: 'rgba(0, 158, 247, 0.8)',
                    borderColor: '#009ef7',
                    borderWidth: 2,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1e1e2d',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#009ef7',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Total: ' + context.parsed.y + ' pelanggaran';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush
