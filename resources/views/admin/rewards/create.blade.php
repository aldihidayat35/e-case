@extends('layouts.app')

@section('title', 'Berikan Penghargaan')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="mb-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">Berikan Penghargaan</h1>
        </div>

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header">
                <h3 class="card-title">Form Pemberian Penghargaan</h3>
            </div>
            <!--end::Card header-->

            <!--begin::Form-->
            <form action="{{ route('admin.rewards.store') }}" method="POST">
                @csrf

                <!--begin::Card body-->
                <div class="card-body">

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!--begin::Input group - Student-->
                    <div class="mb-10">
                        <label class="form-label required">Siswa</label>
                        <select name="student_id" id="studentSelect" class="form-select form-select-solid @error('student_id') is-invalid @enderror" required>
                            <option value="">Pilih Siswa</option>
                            @foreach($eligibleStudents as $student)
                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} ({{ $student->nis }}) - {{ $student->classRoom->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Hanya siswa dengan poin 0 (tidak ada pelanggaran) yang dapat diberikan penghargaan</div>
                    </div>
                    <!--end::Input group-->

                    @if($eligibleStudents->count() == 0)
                    <div class="alert alert-warning d-flex align-items-center mb-10">
                        <i class="fas fa-exclamation-triangle fs-2x me-4"></i>
                        <div class="d-flex flex-column">
                            <h5 class="mb-1">Tidak Ada Siswa yang Memenuhi Syarat</h5>
                            <span>Saat ini belum ada siswa dengan poin 0. Lihat <a href="{{ route('admin.rewards.eligible') }}">daftar siswa berhak</a> untuk informasi lebih lanjut.</span>
                        </div>
                    </div>
                    @endif

                    <!--begin::Input group - Semester-->
                    <div class="mb-10">
                        <label class="form-label required">Semester</label>
                        <input type="text" name="semester" class="form-control form-control-solid @error('semester') is-invalid @enderror"
                               placeholder="Contoh: Ganjil 2025/2026" value="{{ old('semester') }}" required />
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Semester periode penghargaan diberikan</div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group - Description-->
                    <div class="mb-10">
                        <label class="form-label">Keterangan</label>
                        <textarea name="description" class="form-control form-control-solid @error('description') is-invalid @enderror"
                                  rows="4" placeholder="Contoh: Siswa Teladan dengan prestasi akademik dan kedisiplinan terbaik">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Deskripsi atau alasan pemberian penghargaan (opsional)</div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Info Alert-->
                    <div class="alert alert-success d-flex align-items-center">
                        <i class="fas fa-trophy fs-2x me-4"></i>
                        <div class="d-flex flex-column">
                            <h5 class="mb-1">Kriteria Penghargaan</h5>
                            <span>Penghargaan diberikan kepada siswa yang memiliki total poin pelanggaran 0 (nol). Ini menunjukkan bahwa siswa tersebut tidak melakukan pelanggaran selama periode yang ditentukan.</span>
                        </div>
                    </div>
                    <!--end::Info Alert-->

                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer d-flex justify-content-end py-6">
                    <a href="{{ route('admin.rewards.index') }}" class="btn btn-light btn-active-light-primary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary" {{ $eligibleStudents->count() == 0 ? 'disabled' : '' }}>
                        <i class="fas fa-save me-2"></i>Berikan Penghargaan
                    </button>
                </div>
                <!--end::Card footer-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
</div>
@endsection
