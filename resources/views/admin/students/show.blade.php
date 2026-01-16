@extends('layouts.app')

@section('title', 'Detail Siswa - ' . $student->name)

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">Detail Siswa</h1>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-primary">Edit Data</a>
                <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-light">Kembali</a>
            </div>
        </div>

        <div class="card mb-5">
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
                                    <span class="text-gray-900 fs-2 fw-bold me-1">{{ $student->name }}</span>
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
                                    <span class="badge badge-light-success fs-3 fw-bold px-5 py-3">
                                        {{ $student->total_points }} Poin
                                    </span>
                                @elseif($student->total_points < 20)
                                    <span class="badge badge-light-warning fs-3 fw-bold px-5 py-3">
                                        {{ $student->total_points }} Poin
                                    </span>
                                @else
                                    <span class="badge badge-light-danger fs-3 fw-bold px-5 py-3">
                                        {{ $student->total_points }} Poin
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex flex-wrap flex-stack">
                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <div class="d-flex flex-wrap">
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="fs-2 fw-bold">{{ $student->violations->count() }}</div>
                                        <div class="fw-semibold fs-6 text-gray-500">Total Pelanggaran</div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="fs-2 fw-bold">{{ $student->rewards->count() }}</div>
                                        <div class="fw-semibold fs-6 text-gray-500">Penghargaan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5 g-xl-10">
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Riwayat Pelanggaran</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6">
                        @forelse($student->violations as $violation)
                        <div class="d-flex flex-stack">
                            <div class="d-flex align-items-center me-3">
                                <div class="flex-grow-1">
                                    <span class="text-gray-800 fw-bold fs-6 d-block">{{ $violation->violation->name }}</span>
                                    <span class="text-gray-500 fw-semibold d-block fs-7">
                                        {{ $violation->date->format('d M Y') }} - Dicatat oleh {{ $violation->creator->name }}
                                    </span>
                                </div>
                            </div>
                            <span class="badge badge-light-danger fw-bold">+{{ $violation->point }}</span>
                        </div>
                        @if(!$loop->last)
                            <div class="separator separator-dashed my-4"></div>
                        @endif
                        @empty
                        <div class="text-center py-10">
                            <i class="ki-duotone ki-check-circle fs-3x text-success mb-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div class="text-gray-600 fs-5">Tidak ada pelanggaran</div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Penghargaan</span>
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
                            <div class="text-gray-500 fs-6">Belum ada penghargaan</div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
