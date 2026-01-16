@extends('layouts.public')

@section('title', 'Cari Data Siswa')

@section('content')
<!--begin::Toolbar-->
<div class="toolbar py-5 py-lg-15" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <div class="page-title d-flex flex-column me-3">
            <h1 class="d-flex text-white fw-bold my-1 fs-3">
                Cari Data Siswa
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                <li class="breadcrumb-item text-white opacity-75">
                    Untuk Orang Tua - Pantau Kedisiplinan Anak Anda
                </li>
            </ul>
        </div>
    </div>
</div>
<!--end::Toolbar-->

<!--begin::Container-->
<div id="kt_content_container" class="container-xxl">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <!--begin::Card-->
            <div class="card">
                <div class="card-body p-lg-17">
                    <div class="text-center mb-10">
                        <h1 class="text-gray-900 mb-3">🔍 Pencarian Siswa</h1>
                        <p class="text-gray-600 fs-5">
                            Masukkan Nomor Induk Siswa (NIS) untuk melihat data kedisiplinan
                        </p>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                            <i class="ki-duotone ki-shield-cross fs-2hx text-danger me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger">Data Tidak Ditemukan</h4>
                                <span>{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('student.search.post') }}">
                        @csrf
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bold text-gray-900">Nomor Induk Siswa (NIS)</label>
                            <input type="text" name="nis" class="form-control form-control-lg form-control-solid @error('nis') is-invalid @enderror"
                                   placeholder="Masukkan NIS siswa" value="{{ old('nis') }}" required autofocus/>
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg btn-primary">
                                <i class="ki-duotone ki-magnifier fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Cari Data Siswa
                            </button>
                        </div>
                    </form>

                    <div class="separator my-10"></div>

                    <div class="text-center">
                        <h3 class="fw-bold text-gray-900 mb-5">ℹ️ Informasi</h3>
                        <p class="text-gray-600">
                            Fitur ini memungkinkan orang tua untuk memantau kedisiplinan anak secara real-time.
                            Data yang ditampilkan meliputi total poin pelanggaran, riwayat pelanggaran, dan
                            penghargaan yang diterima (jika ada).
                        </p>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>
</div>
<!--end::Container-->
@endsection
