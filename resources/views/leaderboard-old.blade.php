@extends('layouts.public')

@section('title', 'Papan Peringkat Siswa')

@section('content')
<!--begin::Hero-->
<div class="bg-primary py-10 mb-10">
    <div class="container">
        <div class="text-center">
            <h1 class="text-white fw-bold mb-3">Papan Peringkat Siswa</h1>
            <p class="text-white opacity-75 fs-5">Daftar siswa berdasarkan total poin pelanggaran (terendah ke tertinggi)</p>
        </div>
    </div>
</div>
<!--end::Hero-->

<!--begin::Container-->
<div class="container mb-10">

    <!--begin::Filter-->
    <div class="card mb-5">
        <div class="card-body">
            <form method="GET" action="{{ route('leaderboard') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Filter Kelas</label>
                    <select name="class_id" class="form-select form-select-solid">
                        <option value="">Semua Kelas</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Cari Siswa</label>
                    <input type="text" name="search" class="form-control form-control-solid"
                           placeholder="Nama atau NIS" value="{{ request('search') }}" />
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                    <a href="{{ route('leaderboard') }}" class="btn btn-light">
                        <i class="fas fa-redo me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>
    <!--end::Filter-->

    <!--begin::Info Alert-->
    <div class="alert alert-info d-flex align-items-center mb-5">
        <i class="fas fa-info-circle fs-2x me-4"></i>
        <div class="d-flex flex-column">
            <h5 class="mb-1">Informasi Peringkat</h5>
            <span>Siswa dengan poin 0 adalah Siswa Teladan. Semakin rendah poin, semakin baik kedisiplinan siswa.</span>
        </div>
    </div>
    <!--end::Info Alert-->

    <!--begin::Leaderboard Card-->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-300 gy-5 gs-7 mb-0">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                            <th class="min-w-80px ps-5">Peringkat</th>
                            <th class="min-w-100px">NIS</th>
                            <th class="min-w-200px">Nama Siswa</th>
                            <th class="min-w-100px">Kelas</th>
                            <th class="min-w-100px text-center">Total Poin</th>
                            <th class="min-w-150px">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $index => $student)
                        <tr>
                            <td class="ps-5">
                                @php
                                    $rank = ($students->currentPage() - 1) * $students->perPage() + $index + 1;
                                @endphp

                                @if($rank == 1)
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-trophy fs-2x text-warning me-3"></i>
                                        <span class="badge badge-warning fs-3">{{ $rank }}</span>
                                    </div>
                                @elseif($rank == 2)
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-medal fs-2x text-muted me-3"></i>
                                        <span class="badge badge-light-primary fs-3">{{ $rank }}</span>
                                    </div>
                                @elseif($rank == 3)
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-award fs-2x text-danger me-3"></i>
                                        <span class="badge badge-light-danger fs-3">{{ $rank }}</span>
                                    </div>
                                @else
                                    <span class="badge badge-light fs-4">{{ $rank }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-gray-800 fw-semibold">{{ $student->nis }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($student->total_points == 0)
                                        <div class="symbol symbol-circle symbol-40px me-3 bg-light-success">
                                            <i class="fas fa-user-check fs-2x text-success"></i>
                                        </div>
                                    @else
                                        <div class="symbol symbol-circle symbol-40px me-3 bg-light-primary">
                                            <i class="fas fa-user fs-2x text-primary"></i>
                                        </div>
                                    @endif
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-800 fw-bold fs-5">{{ $student->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-light-primary fs-6">{{ $student->classRoom->name }}</span>
                            </td>
                            <td class="text-center">
                                @if($student->total_points == 0)
                                    <span class="badge badge-success fs-3">{{ $student->total_points }}</span>
                                @elseif($student->total_points <= 19)
                                    <span class="badge badge-warning fs-3">{{ $student->total_points }}</span>
                                @else
                                    <span class="badge badge-danger fs-3">{{ $student->total_points }}</span>
                                @endif
                            </td>
                            <td>
                                @if($student->total_points == 0)
                                    <span class="badge badge-success">
                                        <i class="fas fa-star me-1"></i>Siswa Teladan
                                    </span>
                                @elseif($student->total_points <= 19)
                                    <span class="badge badge-warning">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Perlu Perhatian
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-exclamation-circle me-1"></i>Pelanggaran Berat
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-10">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-inbox fs-3x text-gray-400 mb-3"></i>
                                    <span class="text-gray-600 fs-5">Tidak ada data siswa</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($students->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="text-gray-600">
                    Menampilkan {{ $students->firstItem() }} - {{ $students->lastItem() }} dari {{ $students->total() }} siswa
                </div>
                <div>
                    {{ $students->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--end::Leaderboard Card-->

    <!--begin::Legend-->
    <div class="card mt-5">
        <div class="card-body">
            <h4 class="mb-5">Keterangan Status</h4>
            <div class="row g-5">
                <div class="col-md-4">
                    <div class="d-flex align-items-center">
                        <span class="badge badge-success me-3">0 Poin</span>
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-gray-800">Siswa Teladan</span>
                            <span class="text-muted fs-7">Tidak ada pelanggaran</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center">
                        <span class="badge badge-warning me-3">1-19 Poin</span>
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-gray-800">Perlu Perhatian</span>
                            <span class="text-muted fs-7">Pelanggaran ringan</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center">
                        <span class="badge badge-danger me-3">≥20 Poin</span>
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-gray-800">Pelanggaran Berat</span>
                            <span class="text-muted fs-7">Perlu pembinaan khusus</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Legend-->

    <!--begin::Statistics-->
    @if($students->count() > 0)
    <div class="row g-5 g-xl-8 mt-5">
        <div class="col-xl-4">
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #50CD89">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">
                            {{ \App\Models\Student::where('total_points', 0)->count() }}
                        </span>
                        <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Siswa Teladan (0 Poin)</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #FFC700">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">
                            {{ \App\Models\Student::whereBetween('total_points', [1, 19])->count() }}
                        </span>
                        <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Perlu Perhatian (1-19)</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #F1416C">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">
                            {{ \App\Models\Student::where('total_points', '>=', 20)->count() }}
                        </span>
                        <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Pelanggaran Berat (≥20)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!--end::Statistics-->

</div>
<!--end::Container-->
@endsection
