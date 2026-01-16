@extends('layouts.app')

@section('title', 'Detail Penghargaan')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="mb-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">Detail Penghargaan</h1>
        </div>

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card body-->
            <div class="card-body">

                <!--begin::Header-->
                <div class="d-flex flex-column align-items-center mb-10">
                    <div class="symbol symbol-150px symbol-circle mb-5">
                        <div class="symbol-label bg-light-success">
                            <i class="fas fa-trophy fs-3x text-success"></i>
                        </div>
                    </div>
                    <h1 class="fw-bold text-gray-800 mb-2">Sertifikat Penghargaan</h1>
                    <span class="badge badge-success fs-5">{{ $reward->semester }}</span>
                </div>
                <!--end::Header-->

                <!--begin::Details-->
                <div class="separator mb-6"></div>

                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Nama Siswa</label>
                    <div class="col-lg-8">
                        <span class="fw-bold fs-4 text-gray-800">{{ $reward->student->name }}</span>
                    </div>
                </div>

                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">NIS</label>
                    <div class="col-lg-8">
                        <span class="fw-semibold text-gray-800">{{ $reward->student->nis }}</span>
                    </div>
                </div>

                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Kelas</label>
                    <div class="col-lg-8">
                        <span class="fw-semibold text-gray-800">{{ $reward->student->classRoom->name }}</span>
                    </div>
                </div>

                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Semester</label>
                    <div class="col-lg-8">
                        <span class="badge badge-light-primary fs-5">{{ $reward->semester }}</span>
                    </div>
                </div>

                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Total Poin Pelanggaran</label>
                    <div class="col-lg-8">
                        <span class="badge badge-success fs-5">{{ $reward->student->total_points }} Poin</span>
                    </div>
                </div>

                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Keterangan</label>
                    <div class="col-lg-8">
                        <span class="fw-semibold text-gray-800">
                            {{ $reward->description ?? 'Siswa teladan dengan prestasi kedisiplinan terbaik' }}
                        </span>
                    </div>
                </div>

                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted">Tanggal Diberikan</label>
                    <div class="col-lg-8">
                        <span class="fw-semibold text-gray-800">
                            {{ \Carbon\Carbon::parse($reward->created_at)->format('d F Y') }}
                        </span>
                    </div>
                </div>

                <div class="separator mb-6"></div>

                <!--begin::Success Message-->
                <div class="alert alert-success d-flex align-items-center">
                    <i class="fas fa-check-circle fs-2x me-4"></i>
                    <div class="d-flex flex-column">
                        <h5 class="mb-1">Siswa Teladan</h5>
                        <span>Siswa ini telah menunjukkan kedisiplinan dan prestasi yang luar biasa dengan tidak melakukan pelanggaran selama periode {{ $reward->semester }}. Patut diberikan apresiasi!</span>
                    </div>
                </div>
                <!--end::Success Message-->

                <!--begin::Statistics-->
                <div class="row g-5 g-xl-8 mt-5">
                    <div class="col-xl-4">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #50CD89">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $reward->student->violations->count() }}</span>
                                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Total Riwayat Pelanggaran</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #7239EA">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $reward->student->rewards->count() }}</span>
                                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Total Penghargaan Diterima</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #FFC700">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $reward->student->total_points }}</span>
                                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Poin Saat Ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Statistics-->

                <!--end::Details-->
            </div>
            <!--end::Card body-->

            <!--begin::Card footer-->
            <div class="card-footer d-flex justify-content-between py-6">
                <a href="{{ route('admin.rewards.index') }}" class="btn btn-light btn-active-light-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <div>
                    <button type="button" class="btn btn-light-primary me-2" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Cetak Sertifikat
                    </button>
                    <a href="{{ route('admin.students.show', $reward->student) }}" class="btn btn-primary">
                        <i class="fas fa-user me-2"></i>Lihat Profil Siswa
                    </a>
                </div>
            </div>
            <!--end::Card footer-->
        </div>
        <!--end::Card-->
    </div>
</div>
<!--end::Container-->

@push('styles')
<style>
    @media print {
        .toolbar, .card-footer, .breadcrumb, .no-print {
            display: none !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>
@endpush
@endsection
