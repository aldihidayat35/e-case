@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="mb-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">Tambah Kelas</h1>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Kelas</h3>
            </div>
            <form action="{{ route('admin.classes.store') }}" method="POST">
                @csrf
                <div class="card-body">

                    <div class="mb-10">
                        <label class="required form-label">Nama Kelas</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               placeholder="Contoh: X TO1" value="{{ old('name') }}" required/>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Masukkan nama kelas sesuai format: X TO1, XI TPM, XII TKJ, dll.</div>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end py-6">
                    <a href="{{ route('admin.classes.index') }}" class="btn btn-light me-3">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
