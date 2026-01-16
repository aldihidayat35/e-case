@extends('layouts.auth')

@section('title', 'Login Admin')

@section('content')
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-center flex-column-fluid">
        <div class="d-flex flex-column flex-center text-center p-10">
            <!--begin::Wrapper-->
            <div class="card card-flush w-lg-650px py-5">
                <div class="card-body py-15 py-lg-20">
                    <!--begin::Logo & Title-->
                    <div class="mb-7">
                        <a href="{{ route('home') }}" class="mb-7 d-block">
                            <img alt="{{ $appData->school_name }}" src="{{ $appData->logo_url }}" class="h-60px"/>
                        </a>
                        <h1 class="text-gray-900 fw-bolder mb-3">{{ $appData->school_name }}</h1>
                        <div class="text-gray-500 fw-semibold fs-6">Sistem Poin Pelanggaran & Penghargaan Siswa</div>
                        <div class="separator separator-dashed my-7"></div>
                        <h2 class="text-gray-900 fw-bold mb-3">Login Admin</h2>
                        <div class="text-gray-500 fw-semibold fs-6 mb-7">
                            Masukkan kredensial Anda untuk mengakses panel admin
                        </div>
                    </div>
                    <!--end::Logo & Title-->

                    @if ($errors->any())
                        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                            <i class="ki-duotone ki-shield-cross fs-2hx text-danger me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger">Error</h4>
                                @foreach ($errors->all() as $error)
                                    <span>{{ $error }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                            <i class="ki-duotone ki-shield-cross fs-2hx text-danger me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div class="d-flex flex-column">
                                <span>{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <!--begin::Form-->
                    <form class="form w-100" method="POST" action="{{ route('login.post') }}">
                        @csrf

                        <!--begin::Input group-->
                        <div class="fv-row mb-8">
                            <input type="email" placeholder="Email" name="email" autocomplete="off"
                                   class="form-control bg-transparent @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required autofocus/>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <input type="password" placeholder="Password" name="password" autocomplete="off"
                                   class="form-control bg-transparent @error('password') is-invalid @enderror" required/>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-10">
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="remember" value="1"/>
                                    <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">
                                        Ingat Saya
                                    </span>
                                </label>
                            </div>
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">
                                    <i class="ki-duotone ki-entrance-right fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Login
                                </span>
                            </button>
                        </div>
                        <!--end::Submit button-->

                        <!--begin::Sign up-->
                        <div class="text-gray-500 text-center fw-semibold fs-6">
                            Bukan Admin?
                            <a href="{{ route('home') }}" class="link-primary fw-bold">
                                Kembali ke Beranda
                            </a>
                        </div>
                        <!--end::Sign up-->
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Wrapper-->
        </div>
    </div>
</div>

<style>
    body {
        background-image: url('{{ asset('assets/media/auth/bg4.jpg') }}');
        background-size: cover;
        background-position: center;
    }
</style>
@endsection
