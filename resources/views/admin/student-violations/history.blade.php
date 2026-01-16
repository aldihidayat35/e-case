@extends('layouts.app')

@section('title', 'Riwayat Pelanggaran Siswa')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">Riwayat Pelanggaran Siswa</h1>
            </div>
            <div>
                <button type="button" class="btn btn-sm btn-light-primary" onclick="window.print()">
                    <i class="ki-duotone ki-printer fs-2"></i>
                    Cetak
                </button>
            </div>
        </div>

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h3>Filter Riwayat</h3>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-light-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Cetak
                    </button>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">

                <!--begin::Filter Form-->
                <form method="GET" action="{{ route('admin.violations.history') }}" class="mb-5">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Kelas</label>
                            <select name="class_id" class="form-select form-select-solid">
                                <option value="">Semua Kelas</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control form-control-solid" value="{{ request('start_date') }}" />
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" class="form-control form-control-solid" value="{{ request('end_date') }}" />
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jenis Pelanggaran</label>
                            <select name="violation_id" class="form-select form-select-solid">
                                <option value="">Semua Jenis</option>
                                @foreach($violations_type as $violation)
                                    <option value="{{ $violation->id }}" {{ request('violation_id') == $violation->id ? 'selected' : '' }}>
                                        {{ $violation->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <a href="{{ route('admin.violations.history') }}" class="btn btn-light">
                                <i class="fas fa-redo me-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
                <!--end::Filter Form-->

                <!--begin::Statistics-->
                @if($violations->count() > 0)
                <div class="row g-5 g-xl-8 mb-5">
                    <div class="col-xl-3">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #F1416C">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $violations->count() }}</span>
                                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Total Pelanggaran</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #7239EA">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $violations->sum('point') }}</span>
                                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Total Poin</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #FFC700">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $violations->unique('student_id')->count() }}</span>
                                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Siswa Terlibat</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #50CD89">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $violations->unique('violation_id')->count() }}</span>
                                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Jenis Pelanggaran</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!--end::Statistics-->

                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-50px">No</th>
                                <th class="min-w-100px">Tanggal</th>
                                <th class="min-w-150px">Siswa</th>
                                <th class="min-w-100px">Kelas</th>
                                <th class="min-w-200px">Jenis Pelanggaran</th>
                                <th class="min-w-80px text-center">Poin</th>
                                <th class="min-w-150px">Dicatat Oleh</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse($violations as $index => $violation)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="text-gray-800">{{ \Carbon\Carbon::parse($violation->date)->format('d/m/Y') }}</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-800 fw-bold">{{ $violation->student->name }}</span>
                                        <span class="text-muted fs-7">NIS: {{ $violation->student->nis }}</span>
                                    </div>
                                </td>
                                <td>{{ $violation->student->classRoom->name }}</td>
                                <td>
                                    <span class="badge badge-light-danger">{{ $violation->violation->name }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-danger fs-5">{{ $violation->point }}</span>
                                </td>
                                <td>{{ $violation->creator->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-10">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-inbox fs-3x text-gray-400 mb-3"></i>
                                        <span class="text-gray-600 fs-5">Tidak ada riwayat pelanggaran</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
</div>
<!--end::Container-->

@push('styles')
<style>
    @media print {
        .toolbar, .card-toolbar, .breadcrumb, form, .no-print {
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
