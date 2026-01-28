@extends('layouts.public')

@section('title', 'Cari Data Siswa')

@section('page-title', 'Cari Data Siswa')

@section('content')


<!--begin::Container-->
<div id="kt_content_container" class="container-xxl">
    <div class="row">
        <div class="col-12 col-lg-10 col-xl-8 offset-lg-1 offset-xl-2">
            <!--begin::Card-->
            <div class="card">
                <div class="card-body p-4 p-md-6 p-lg-10 p-xl-17">
                    <!--begin::Heading-->
                    <div class="text-center mb-6 mb-md-8 mb-lg-13">
                        <div class="symbol symbol-50px symbol-md-70px symbol-lg-100px symbol-circle mb-4 mb-md-5 mb-lg-7">
                            <span class="symbol-label bg-light-primary">
                                <i class="ki-duotone ki-magnifier fs-2x fs-md-2hx fs-lg-3x text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                        </div>
                        <h1 class="text-gray-900 mb-2 mb-md-3 fw-bold fs-2 fs-md-1 fs-lg-1">Pencarian Data Siswa</h1>
                        <p class="text-gray-600 fs-7 fs-md-6 fs-lg-5 fw-semibold px-2">
                            Masukkan Nomor Induk Siswa (NIS) untuk melihat data kedisiplinan secara lengkap
                        </p>
                    </div>
                    <!--end::Heading-->

                    <!--begin::Alert-->
                    @if(session('error'))
                        <div class="alert alert-danger d-flex align-items-center p-3 p-md-4 p-lg-5 mb-6 mb-md-8 mb-lg-10">
                            <i class="ki-duotone ki-shield-cross fs-2x fs-md-2hx fs-lg-2hx text-danger me-2 me-md-3 me-lg-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger fs-7 fs-md-6 fs-lg-5">Data Tidak Ditemukan</h4>
                                <span class="fs-8 fs-md-7 fs-lg-6">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif
                    <!--end::Alert-->

                    <!--begin::Form-->
                    <form method="POST" action="{{ route('student.search.post') }}" class="form">
                        @csrf
                        <!--begin::Input group-->
                        <div class="mb-6 mb-md-8 mb-lg-10">
                            <label class="form-label fs-7 fs-md-6 fs-lg-5 fw-bold mb-2 mb-lg-3">
                                <i class="ki-duotone ki-badge fs-3 fs-md-2x fs-lg-2 text-primary me-1 me-md-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                <span class="d-none d-sm-inline">Nomor Induk Siswa (NIS)</span>
                                <span class="d-inline d-sm-none">NIS</span>
                            </label>
                            <input type="text"
                                   class="form-control form-control-lg form-control-solid fs-7 fs-md-6 fs-lg-5 @error('nis') is-invalid @enderror"
                                   name="nis"
                                   placeholder="Contoh: 2024001"
                                   value="{{ old('nis') }}"
                                   required
                                   autofocus />
                            @error('nis')
                                <div class="invalid-feedback fs-8 fs-md-7">{{ $message }}</div>
                            @enderror
                            <div class="form-text fs-8 fs-md-7">Masukkan NIS siswa yang terdaftar di sistem</div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="d-flex flex-column flex-sm-row flex-center gap-2 gap-md-3">
                            <button type="reset" class="btn btn-light w-100 w-sm-auto fs-7 fs-md-6">
                                <i class="ki-duotone ki-arrows-circle fs-3 fs-md-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-primary w-100 w-sm-auto fs-7 fs-md-6">
                                <i class="ki-duotone ki-magnifier fs-3 fs-md-2">
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
                    <div class="separator separator-dashed my-6 my-md-8 my-lg-10"></div>
                    <div class="text-center">
                        <div class="row g-3 g-md-4 g-lg-5">
                            <div class="col-4">
                                <div class="d-flex flex-column align-items-center px-1">
                                    <i class="ki-duotone ki-shield-tick fs-2x fs-md-2hx fs-lg-3x text-success mb-2 mb-md-2 mb-lg-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <h5 class="fw-bold text-gray-900 mb-1 mb-lg-2 fs-8 fs-md-7 fs-lg-5">Aman</h5>
                                    <p class="text-gray-600 fs-9 fs-md-8 fs-lg-7 mb-0 d-none d-md-block">Data terlindungi</p>
                                </div>
                            </div>
                            <div class="col-4 col-md-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ki-duotone ki-time fs-2x fs-lg-3x text-primary mb-2 mb-lg-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <h5 class="fw-bold text-gray-900 mb-1 mb-lg-2 fs-7 fs-lg-5">Real-Time</h5>
                                    <p class="text-gray-600 fs-8 fs-lg-7 mb-0 d-none d-sm-block">Data selalu terupdate otomatis</p>
                                </div>
                            </div>
                            <div class="col-4 col-md-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="ki-duotone ki-information-5 fs-2x fs-lg-3x text-warning mb-2 mb-lg-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <h5 class="fw-bold text-gray-900 mb-1 mb-lg-2 fs-7 fs-lg-5">Transparan</h5>
                                    <p class="text-gray-600 fs-8 fs-lg-7 mb-0 d-none d-sm-block">Informasi lengkap dan jelas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Info-->
                </div>
            </div>
            <!--end::Card-->

            <!--begin::Help Card-->
            <div class="card mt-4 mt-md-5">
                <div class="card-body p-3 p-md-4 p-lg-7">
                    <h4 class="fw-bold text-gray-900 mb-3 mb-md-4 mb-lg-5 fs-6 fs-md-5 fs-lg-4">
                        <i class="ki-duotone ki-question-2 fs-3 fs-lg-2 text-primary me-2">
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
