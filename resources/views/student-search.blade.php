@extends('layouts.public')

@section('title', 'Cari Data Siswa')

@section('page-title', 'Cari Data Siswa')

@section('content')


<!--begin::Container-->
<div id="kt_content_container" class="container-xxl">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <!--begin::Card-->
            <div class="card">
                <div class="card-body p-lg-17">
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            <span class="symbol-label bg-light-primary">
                                <i class="ki-duotone ki-magnifier fs-3x text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                        </div>
                        <h1 class="text-gray-900 mb-3 fw-bold">Pencarian Data Siswa</h1>
                        <p class="text-gray-600 fs-5 fw-semibold">
                            Masukkan Nomor Induk Siswa (NIS) untuk melihat data kedisiplinan secara lengkap
                        </p>
                    </div>
                    <!--end::Heading-->

                    <!--begin::Alert-->
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
                    <!--end::Alert-->

                    <!--begin::Form-->
                    <form method="POST" action="{{ route('student.search.post') }}" class="form">
                        @csrf
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <label class="form-label fs-5 fw-bold mb-3">
                                <i class="ki-duotone ki-badge fs-2 text-primary me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                Nomor Induk Siswa (NIS)
                            </label>
                            <input type="text"
                                   class="form-control form-control-lg form-control-solid @error('nis') is-invalid @enderror"
                                   name="nis"
                                   placeholder="Contoh: 2024001"
                                   value="{{ old('nis') }}"
                                   required
                                   autofocus />
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Masukkan NIS siswa yang terdaftar di sistem</div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="d-flex flex-center">
                            <button type="reset" class="btn btn-light me-3">
                                <i class="ki-duotone ki-arrows-circle fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ki-duotone ki-magnifier fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Cari Data Siswa
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->

                    <!--begin::Info-->
                    <div class="separator separator-dashed my-10"></div>
                    <div class="text-center">
                        <div class="row g-5">
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ki-duotone ki-shield-tick fs-3x text-success mb-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <h5 class="fw-bold text-gray-900 mb-2">Aman & Privat</h5>
                                    <p class="text-gray-600 fs-7 mb-0">Data siswa terlindungi dengan baik</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ki-duotone ki-time fs-3x text-primary mb-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <h5 class="fw-bold text-gray-900 mb-2">Real-Time</h5>
                                    <p class="text-gray-600 fs-7 mb-0">Data selalu terupdate otomatis</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ki-duotone ki-information-5 fs-3x text-warning mb-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <h5 class="fw-bold text-gray-900 mb-2">Transparan</h5>
                                    <p class="text-gray-600 fs-7 mb-0">Informasi lengkap dan jelas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Info-->
                </div>
            </div>
            <!--end::Card-->

            <!--begin::Help Card-->
            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="fw-bold text-gray-900 mb-5">
                        <i class="ki-duotone ki-question-2 fs-2 text-primary me-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        Bantuan
                    </h4>
                    <div class="accordion accordion-icon-toggle" id="kt_accordion_help">
                        <!--begin::Item-->
                        <div class="mb-5">
                            <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse" data-bs-target="#kt_accordion_help_item_1">
                                <span class="accordion-icon">
                                    <i class="ki-duotone ki-arrow-right fs-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <h3 class="fs-6 fw-bold mb-0 ms-4">Apa itu NIS?</h3>
                            </div>
                            <div id="kt_accordion_help_item_1" class="fs-7 collapse show" data-bs-parent="#kt_accordion_help">
                                <div class="text-gray-600 ms-10">NIS adalah Nomor Induk Siswa yang merupakan identitas unik setiap siswa di sekolah. Anda bisa mendapatkan NIS dari kartu pelajar atau menghubungi pihak sekolah.</div>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="mb-5">
                            <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_help_item_2">
                                <span class="accordion-icon">
                                    <i class="ki-duotone ki-arrow-right fs-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <h3 class="fs-6 fw-bold mb-0 ms-4">Informasi apa yang ditampilkan?</h3>
                            </div>
                            <div id="kt_accordion_help_item_2" class="collapse fs-7" data-bs-parent="#kt_accordion_help">
                                <div class="text-gray-600 ms-10">Sistem akan menampilkan profil siswa, total poin pelanggaran, riwayat pelanggaran, dan reward yang diterima.</div>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="mb-5">
                            <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_help_item_3">
                                <span class="accordion-icon">
                                    <i class="ki-duotone ki-arrow-right fs-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <h3 class="fs-6 fw-bold mb-0 ms-4">Apakah data saya aman?</h3>
                            </div>
                            <div id="kt_accordion_help_item_3" class="collapse fs-7" data-bs-parent="#kt_accordion_help">
                                <div class="text-gray-600 ms-10">Ya, sistem kami menjaga kerahasiaan data siswa. Hanya orang yang mengetahui NIS yang dapat mengakses informasi tersebut.</div>
                            </div>
                        </div>
                        <!--end::Item-->
                    </div>
                </div>
            </div>
            <!--end::Help Card-->
        </div>
    </div>
</div>
<!--end::Container-->
@endsection
