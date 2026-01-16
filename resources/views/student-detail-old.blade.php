@extends('layouts.public')

@section('title', 'Data Siswa - ' . $student->name)

@section('content')
<!--begin::Toolbar-->
<div class="toolbar py-5 py-lg-15" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <div class="page-title d-flex flex-column me-3">
            <h1 class="d-flex text-white fw-bold my-1 fs-3">
                Data Siswa
            </h1>
        </div>
    </div>
</div>
<!--end::Toolbar-->

<!--begin::Container-->
<div id="kt_content_container" class="container-xxl">
    <!--begin::Profile Card-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <div class="symbol-label fs-2 fw-semibold text-primary bg-light-primary">
                            {{ substr($student->name, 0, 1) }}
                        </div>
                    </div>
                </div>

                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                    {{ $student->name }}
                                </a>
                            </div>

                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <span class="d-flex align-items-center text-gray-500 me-5 mb-2">
                                    <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    NIS: {{ $student->nis }}
                                </span>
                                <span class="d-flex align-items-center text-gray-500 me-5 mb-2">
                                    <i class="ki-duotone ki-geolocation fs-4 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ $student->classRoom->name }}
                                </span>
                            </div>
                        </div>

                        <div class="d-flex my-4">
                            @if($student->total_points == 0)
                                <span class="badge badge-light-success fs-3 fw-bold">
                                    ⭐ 0 Poin - Siswa Teladan
                                </span>
                            @elseif($student->total_points < 20)
                                <span class="badge badge-light-warning fs-3 fw-bold">
                                    {{ $student->total_points }} Poin
                                </span>
                            @else
                                <span class="badge badge-light-danger fs-3 fw-bold">
                                    {{ $student->total_points }} Poin
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex flex-wrap flex-stack">
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <div class="d-flex flex-wrap">
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold" data-kt-countup="true">{{ $student->violations->count() }}</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-500">Total Pelanggaran</div>
                                </div>

                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold" data-kt-countup="true">{{ $student->rewards->count() }}</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-500">Penghargaan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Profile Card-->

    <!--begin::Row-->
    <div class="row g-5 g-xl-10">
        <!--begin::Col - Violations-->
        <div class="col-xl-6">
            <div class="card card-flush h-xl-100">
                <div class="card-header pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">📋 Riwayat Pelanggaran</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Daftar pelanggaran yang tercatat</span>
                    </h3>
                </div>
                <div class="card-body pt-6">
                    @forelse($student->violations as $violation)
                    <div class="d-flex flex-stack">
                        <div class="d-flex align-items-center me-3">
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold fs-6 d-block">{{ $violation->violation->name }}</span>
                                <span class="text-gray-500 fw-semibold d-block fs-7">
                                    {{ $violation->date->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                        <span class="badge badge-light-danger fw-bold">+{{ $violation->point }} poin</span>
                    </div>
                    @if(!$loop->last)
                        <div class="separator separator-dashed my-4"></div>
                    @endif
                    @empty
                    <div class="text-center py-10">
                        <div class="text-gray-600 fs-5 mb-5">
                            <i class="ki-duotone ki-check-circle fs-3x text-success mb-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div>Tidak ada pelanggaran</div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!--end::Col-->

        <!--begin::Col - Rewards-->
        <div class="col-xl-6">
            <div class="card card-flush h-xl-100">
                <div class="card-header pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">🏆 Penghargaan</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Daftar penghargaan yang diterima</span>
                    </h3>
                </div>
                <div class="card-body pt-6">
                    @forelse($student->rewards as $reward)
                    <div class="d-flex flex-stack">
                        <div class="d-flex align-items-center me-3">
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold fs-6 d-block">Siswa Teladan</span>
                                <span class="text-gray-500 fw-semibold d-block fs-7">
                                    Semester: {{ $reward->semester }}
                                </span>
                                @if($reward->description)
                                <span class="text-gray-600 fw-normal d-block fs-8 mt-1">
                                    {{ $reward->description }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <span class="badge badge-light-success fw-bold">
                            <i class="ki-duotone ki-medal-star fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                    </div>
                    @if(!$loop->last)
                        <div class="separator separator-dashed my-4"></div>
                    @endif
                    @empty
                    <div class="text-center py-10">
                        <div class="text-gray-500 fs-6">
                            Belum ada penghargaan
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <div class="text-center mt-10">
        <a href="{{ route('student.search') }}" class="btn btn-light-primary">
            ← Cari Siswa Lain
        </a>
    </div>
</div>
<!--end::Container-->
@endsection
