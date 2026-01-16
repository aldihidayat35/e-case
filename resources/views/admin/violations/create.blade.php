@extends('layouts.app')

@section('title', 'Tambah Jenis Pelanggaran')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="mb-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">Tambah Jenis Pelanggaran</h1>
        </div>

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header">
                <h3 class="card-title">Form Tambah Jenis Pelanggaran</h3>
            </div>
            <!--end::Card header-->

            <!--begin::Form-->
            <form action="{{ route('admin.violations.store') }}" method="POST">
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

                    <!--begin::Input group - Name-->
                    <div class="mb-10">
                        <label class="form-label required">Nama Pelanggaran</label>
                        <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror"
                               placeholder="Contoh: Terlambat Masuk Sekolah" value="{{ old('name') }}" required />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Masukkan nama jenis pelanggaran yang jelas dan spesifik</div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group - Point Value-->
                    <div class="mb-10">
                        <label class="form-label required">Poin Pelanggaran</label>
                        <input type="number" name="point_value" class="form-control form-control-solid @error('point_value') is-invalid @enderror"
                               placeholder="Contoh: 5" value="{{ old('point_value') }}" min="1" max="100" required />
                        @error('point_value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Nilai poin yang akan ditambahkan ke total poin siswa (1-100)</div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group - Description-->
                    <div class="mb-10">
                        <label class="form-label">Keterangan</label>
                        <textarea name="description" class="form-control form-control-solid @error('description') is-invalid @enderror"
                                  rows="4" placeholder="Masukkan keterangan tambahan tentang jenis pelanggaran ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Deskripsi detail tentang pelanggaran (opsional)</div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Info Alert-->
                    <div class="alert alert-info d-flex align-items-center">
                        <i class="fas fa-info-circle fs-2x me-4"></i>
                        <div class="d-flex flex-column">
                            <h5 class="mb-1">Informasi Penting</h5>
                            <span>Setelah jenis pelanggaran ditambahkan, akan tersedia di form pencatatan pelanggaran siswa. Poin akan otomatis ditambahkan ke total poin siswa ketika pelanggaran dicatat.</span>
                        </div>
                    </div>
                    <!--end::Info Alert-->

                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer d-flex justify-content-end py-6">
                    <a href="{{ route('admin.violations.index') }}" class="btn btn-light btn-active-light-primary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan
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
