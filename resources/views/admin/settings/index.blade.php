@extends('layouts.app')

@section('title', 'Setting Aplikasi')

@section('content')
    <!--begin::App Content-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">

                <!--begin::Header-->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-5">
                    <div>
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-4 fs-lg-3 my-0">Setting Aplikasi</h1>
                        <span class="text-muted fw-semibold fs-8 fs-lg-7">Kelola informasi dan pengaturan aplikasi sekolah</span>
                    </div>
                </div>
                <!--end::Header-->

                <!--begin::Alert-->
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center p-4 p-lg-5 mb-8 mb-lg-10">
                        <i class="ki-duotone ki-shield-tick fs-2x fs-lg-2hx text-success me-3 me-lg-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-success fs-6 fs-lg-5">Berhasil</h4>
                            <span class="fs-7 fs-lg-6">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                <!--end::Alert-->

                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body p-4 p-lg-10">
                        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!--begin::Section: Pengaturan Aplikasi-->
                            <div class="mb-8 mb-lg-10">
                                <h3 class="fw-bold text-gray-900 mb-4 mb-lg-6 fs-5 fs-lg-3">Pengaturan Aplikasi</h3>

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label required fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">Nama Aplikasi</label>
                                    <div class="col-12 col-lg-9">
                                        <input type="text" name="app_name"
                                            class="form-control form-control-solid @error('app_name') is-invalid @enderror"
                                            value="{{ old('app_name', $appData->app_name) }}" required>
                                        <div class="form-text fs-8 fs-lg-7">Nama aplikasi akan ditampilkan di header dan halaman login</div>
                                        @error('app_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">Favicon</label>
                                    <div class="col-12 col-lg-9">
                                        @if ($appData->favicon)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $appData->favicon) }}"
                                                    alt="Favicon" class="img-thumbnail" style="max-height: 64px;">
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <img src="{{ asset('assets/media/logos/favicon.ico') }}"
                                                    alt="Default Favicon" class="img-thumbnail" style="max-height: 64px;">
                                            </div>
                                        @endif
                                        <input type="file" name="favicon"
                                            class="form-control form-control-solid @error('favicon') is-invalid @enderror"
                                            accept=".ico,.png">
                                        <div class="form-text fs-8 fs-lg-7">Format: ICO atau PNG. Ukuran ideal: 32x32px. Maksimal 1MB</div>
                                        @error('favicon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Section-->

                            <div class="separator separator-dashed my-8 my-lg-10"></div>

                            <!--begin::Section: Informasi Sekolah-->
                            <div class="mb-8 mb-lg-10">
                                <h3 class="fw-bold text-gray-900 mb-4 mb-lg-6 fs-5 fs-lg-3">Informasi Sekolah</h3>

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label required fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">Nama Sekolah</label>
                                    <div class="col-12 col-lg-9">
                                        <input type="text" name="school_name"
                                            class="form-control form-control-solid @error('school_name') is-invalid @enderror"
                                            value="{{ old('school_name', $appData->school_name) }}" required>
                                        @error('school_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">Alamat Sekolah</label>
                                    <div class="col-12 col-lg-9">
                                        <textarea name="school_address" rows="3"
                                            class="form-control form-control-solid @error('school_address') is-invalid @enderror">{{ old('school_address', $appData->school_address) }}</textarea>
                                        @error('school_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">Telepon</label>
                                    <div class="col-12 col-lg-9">
                                        <input type="text" name="school_phone"
                                            class="form-control form-control-solid @error('school_phone') is-invalid @enderror"
                                            value="{{ old('school_phone', $appData->school_phone) }}">
                                        @error('school_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">Email</label>
                                    <div class="col-12 col-lg-9">
                                        <input type="email" name="school_email"
                                            class="form-control form-control-solid @error('school_email') is-invalid @enderror"
                                            value="{{ old('school_email', $appData->school_email) }}">
                                        @error('school_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">NPSN</label>
                                    <div class="col-12 col-lg-9">
                                        <input type="text" name="school_npsn"
                                            class="form-control form-control-solid @error('school_npsn') is-invalid @enderror"
                                            value="{{ old('school_npsn', $appData->school_npsn) }}">
                                        @error('school_npsn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">Akreditasi</label>
                                    <div class="col-12 col-lg-9">
                                        <select name="school_accreditation"
                                            class="form-select form-select-solid @error('school_accreditation') is-invalid @enderror">
                                            <option value="">Pilih Akreditasi</option>
                                            <option value="A" {{ old('school_accreditation', $appData->school_accreditation) == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B" {{ old('school_accreditation', $appData->school_accreditation) == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="C" {{ old('school_accreditation', $appData->school_accreditation) == 'C' ? 'selected' : '' }}>C</option>
                                        </select>
                                        @error('school_accreditation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">Logo Sekolah</label>
                                    <div class="col-12 col-lg-9">
                                        @if ($appData->school_logo)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $appData->school_logo) }}"
                                                    alt="Logo" class="img-thumbnail" style="max-height: 150px;">
                                            </div>
                                        @endif
                                        <input type="file" name="school_logo"
                                            class="form-control form-control-solid @error('school_logo') is-invalid @enderror"
                                            accept="image/*">
                                        <div class="form-text fs-8 fs-lg-7">Format: JPG, PNG, SVG. Maksimal 2MB</div>
                                        @error('school_logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Section-->

                            <div class="separator separator-dashed my-8 my-lg-10"></div>

                            <!--begin::Section: Kepala Sekolah-->
                            <div class="mb-8 mb-lg-10">
                                <h3 class="fw-bold text-gray-900 mb-4 mb-lg-6 fs-5 fs-lg-3">Kepala Sekolah</h3>

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">Nama Kepala Sekolah</label>
                                    <div class="col-12 col-lg-9">
                                        <input type="text" name="headmaster_name"
                                            class="form-control form-control-solid @error('headmaster_name') is-invalid @enderror"
                                            value="{{ old('headmaster_name', $appData->headmaster_name) }}">
                                        @error('headmaster_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">NIP Kepala Sekolah</label>
                                    <div class="col-12 col-lg-9">
                                        <input type="text" name="headmaster_nip"
                                            class="form-control form-control-solid @error('headmaster_nip') is-invalid @enderror"
                                            value="{{ old('headmaster_nip', $appData->headmaster_nip) }}">
                                        @error('headmaster_nip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Section-->

                            <div class="separator separator-dashed my-8 my-lg-10"></div>

                            <!--begin::Section: Visi & Misi-->
                            <div class="mb-8 mb-lg-10">
                                <h3 class="fw-bold text-gray-900 mb-4 mb-lg-6 fs-5 fs-lg-3">Visi & Misi</h3>

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">Visi Sekolah</label>
                                    <div class="col-12 col-lg-9">
                                        <textarea name="school_vision" rows="4"
                                            class="form-control form-control-solid @error('school_vision') is-invalid @enderror">{{ old('school_vision', $appData->school_vision) }}</textarea>
                                        @error('school_vision')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row mb-5 mb-lg-6">
                                    <label class="col-12 col-lg-3 col-form-label fw-semibold fs-7 fs-lg-6 mb-2 mb-lg-0">Misi Sekolah</label>
                                    <div class="col-12 col-lg-9">
                                        <textarea name="school_mission" rows="6"
                                            class="form-control form-control-solid @error('school_mission') is-invalid @enderror">{{ old('school_mission', $appData->school_mission) }}</textarea>
                                        @error('school_mission')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Section-->

                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary w-100 w-md-auto">
                                    <i class="ki-duotone ki-check fs-2"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::App Content-->
@endsection
