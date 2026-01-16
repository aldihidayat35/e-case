@extends('layouts.public')

@section('title', 'Data Siswa - ' . $student->name)

@section('page-title', 'Data Siswa')

@section('content')


<!--begin::Container-->
<div id="kt_content_container" class="container-xxl">
    <!--begin::Profile Card-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-7">
                <!--begin::Avatar-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <div class="symbol-label fs-2x fw-bold bg-light-primary text-primary">
                            {{ strtoupper(substr($student->name, 0, 2)) }}
                        </div>
                        @if($student->total_points == 0)
                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                        @elseif($student->total_points < 20)
                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-warning rounded-circle border border-4 border-body h-20px w-20px"></div>
                        @else
                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-danger rounded-circle border border-4 border-body h-20px w-20px"></div>
                        @endif
                    </div>
                </div>
                <!--end::Avatar-->

                <!--begin::Info-->
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                    {{ $student->name }}
                                </a>
                                @if($student->total_points == 0)
                                    <i class="ki-duotone ki-verify fs-1 text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                @endif
                            </div>

                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <span class="d-flex align-items-center text-gray-500 me-5 mb-2">
                                    <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    NIS: {{ $student->nis }}
                                </span>
                                <span class="d-flex align-items-center text-gray-500 me-5 mb-2">
                                    <i class="ki-duotone ki-abstract-41 fs-4 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Kelas: {{ $student->classRoom->name }}
                                </span>
                            </div>
                        </div>

                        <div class="d-flex my-4">
                            @if($student->total_points == 0)
                                <div class="border border-success border-3 rounded px-5 py-3 bg-light-success">
                                    <div class="fs-2hx fw-bold text-success">{{ $student->total_points }}</div>
                                    <div class="fw-semibold text-success">Total Poin</div>
                                    <div class="badge badge-success mt-2">
                                        <i class="ki-duotone ki-star fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Siswa Teladan
                                    </div>
                                </div>
                            @elseif($student->total_points < 20)
                                <div class="border border-warning border-3 rounded px-5 py-3 bg-light-warning">
                                    <div class="fs-2hx fw-bold text-warning">{{ $student->total_points }}</div>
                                    <div class="fw-semibold text-warning">Total Poin</div>
                                    <div class="badge badge-warning mt-2">Perlu Perhatian</div>
                                </div>
                            @else
                                <div class="border border-danger border-3 rounded px-5 py-3 bg-light-danger">
                                    <div class="fs-2hx fw-bold text-danger">{{ $student->total_points }}</div>
                                    <div class="fw-semibold text-danger">Total Poin</div>
                                    <div class="badge badge-danger mt-2">Pelanggaran Berat</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap flex-stack">
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <div class="d-flex flex-wrap">
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-notification-status fs-3x text-warning me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                        <div class="fs-2 fw-bold">{{ $student->violations->count() }}</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-500">Total Pelanggaran</div>
                                </div>

                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-award fs-3x text-success me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        <div class="fs-2 fw-bold">{{ $student->rewards->count() }}</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-500">Penghargaan Diterima</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>

            <!--begin::Nav-->
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#kt_tab_pane_violations">
                        <i class="ki-duotone ki-notification-status fs-2 me-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                        Riwayat Pelanggaran
                    </a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_tab_pane_rewards">
                        <i class="ki-duotone ki-award fs-2 me-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        Penghargaan
                    </a>
                </li>
            </ul>
            <!--end::Nav-->
        </div>
    </div>
    <!--end::Profile Card-->

    <!--begin::Tab Content-->
    <div class="tab-content" id="myTabContent">
        <!--begin::Tab Violations-->
        <div class="tab-pane fade show active" id="kt_tab_pane_violations" role="tabpanel">
            <!--begin::Card-->
            <div class="card">
                <div class="card-header border-0 pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800 fs-2">📋 Riwayat Pelanggaran</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Daftar semua pelanggaran yang tercatat</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    @forelse($student->violations as $violation)
                        <div class="d-flex align-items-center border border-dashed border-gray-300 rounded p-5 mb-5">
                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-danger">
                                    <i class="ki-duotone ki-cross-circle fs-2x text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="fw-bold text-gray-900 text-hover-primary fs-5">{{ $violation->violation->name }}</a>
                                <span class="text-muted fw-semibold d-block fs-7">{{ $violation->violation->category }}</span>
                                @if($violation->description)
                                    <span class="text-gray-600 fw-semibold d-block fs-7 mt-1">
                                        <i class="ki-duotone ki-information fs-7 text-primary">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        {{ $violation->description }}
                                    </span>
                                @endif
                            </div>
                            <div class="text-end">
                                <span class="badge badge-light-danger fs-4 fw-bold mb-2">+{{ $violation->point }} poin</span>
                                <div class="text-gray-500 fw-semibold fs-7">
                                    <i class="ki-duotone ki-calendar fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ $violation->date->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-15">
                            <div class="symbol symbol-100px symbol-circle mb-7">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-duotone ki-check-circle fs-3x text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <h3 class="fw-bold text-gray-800 mb-2">Belum Ada Pelanggaran</h3>
                            <div class="text-gray-600 fw-semibold fs-6">Siswa ini memiliki catatan kedisiplinan yang bersih</div>
                        </div>
                    @endforelse
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Tab Violations-->

        <!--begin::Tab Rewards-->
        <div class="tab-pane fade" id="kt_tab_pane_rewards" role="tabpanel">
            <!--begin::Card-->
            <div class="card">
                <div class="card-header border-0 pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800 fs-2">🏆 Penghargaan Diterima</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Daftar semua penghargaan yang diterima</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    @forelse($student->rewards as $reward)
                        <div class="d-flex align-items-center border border-dashed border-gray-300 rounded p-5 mb-5">
                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-duotone ki-award fs-2x text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="fw-bold text-gray-900 text-hover-primary fs-5">{{ $reward->name }}</a>
                                @if($reward->description)
                                    <span class="text-gray-600 fw-semibold d-block fs-7 mt-1">{{ $reward->description }}</span>
                                @endif
                            </div>
                            <div class="text-end">
                                <span class="badge badge-light-success fs-5 fw-bold mb-2">
                                    <i class="ki-duotone ki-medal-star fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                    Reward
                                </span>
                                <div class="text-gray-500 fw-semibold fs-7">
                                    <i class="ki-duotone ki-calendar fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ $reward->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-15">
                            <div class="symbol symbol-100px symbol-circle mb-7">
                                <span class="symbol-label bg-light-warning">
                                    <i class="ki-duotone ki-award fs-3x text-warning">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </div>
                            <h3 class="fw-bold text-gray-800 mb-2">Belum Ada Penghargaan</h3>
                            <div class="text-gray-600 fw-semibold fs-6">Siswa ini belum menerima penghargaan</div>
                        </div>
                    @endforelse
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Tab Rewards-->
    </div>
    <!--end::Tab Content-->
</div>
<!--end::Container-->
@endsection
