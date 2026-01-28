<!DOCTYPE html>
<html lang="en">
<head>
    <base href=""/>
    <title>@yield('title', 'Beranda') - {{ $appData->school_name ?? 'E-Case System' }}</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ $appData->favicon ? asset('storage/' . $appData->favicon) : asset('assets/media/logos/favicon.ico') }}"/>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->

    <!--begin::DataTables-->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css"/>
    <!--end::DataTables-->

    @stack('styles')

    <style>
        /* Prevent horizontal overflow */
        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        /* Ensure tables are responsive */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            width: 100%;
        }

        /* Fix chart overflow */
        canvas {
            max-width: 100% !important;
        }

        /* Responsive menu and layout adjustments */
        @media (max-width: 991.98px) {
            .aside {
                max-width: 250px;
            }

            .aside .menu-title {
                font-size: 0.9rem;
            }

            .aside-user-info {
                max-width: 150px;
                overflow: hidden;
            }
        }

        @media (max-width: 767.98px) {
            .aside .menu-item .menu-link {
                padding: 0.5rem 0.75rem;
            }

            .aside .menu-icon {
                margin-right: 0.5rem;
            }
        }

        @media (max-width: 575.98px) {
            .aside-user-info {
                max-width: 120px;
            }

            .aside-user-info .fs-6 {
                font-size: 0.875rem !important;
            }

            .footer .text-muted {
                font-size: 0.75rem;
            }
        }

        .public-mobile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            border-bottom: 1px solid #e5e5e5;
            background-color: #fff;
            gap: 12px;
        }

        @media (min-width: 992px) {
            .public-mobile-header {
                display: none;
            }
        }

        @media (max-width: 991.98px) {
            .page {
                flex-direction: column;
            }

            #kt_aside {
                position: fixed;
                z-index: 105;
            }
        }
    </style>
</head>

<body id="kt_body" data-kt-app-page-loading-enabled="false" data-kt-app-page-loading="off" class="aside-enabled">
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            <div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: false, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                <!--begin::Aside Toolbar-->
                <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
                    <!--begin::Aside user-->
                    <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
                        <div class="symbol symbol-50px">
                            @if($appData && $appData->school_logo)
                                <img src="{{ Storage::url($appData->school_logo) }}" alt="Logo"/>
                            @else
                                <div class="symbol-label bg-light-primary">
                                    <i class="fas fa-school fs-2x text-primary"></i>
                                </div>
                            @endif
                        </div>
                        <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
                            <div class="d-flex">
                                <div class="flex-grow-1 me-2">
                                    <a href="{{ route('home') }}" class="text-gray-900 text-hover-primary fs-6 fw-bold">{{ $appData->school_name ?? 'E-Case System' }}</a>
                                    <span class="text-muted d-block fw-semibold fs-7">Portal Publik</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Aside user-->
                </div>
                <!--end::Aside Toolbar-->

                <!--begin::Aside menu-->
                <div class="aside-menu flex-column-fluid">
                    <div class="hover-scroll-overlay-y mx-3 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_toolbar" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
                        <!--begin::Menu-->
                        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="kt_aside_menu" data-kt-menu="true">
                            <!--begin:Menu item - Beranda-->
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-home-2 fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Beranda</span>
                                </a>
                            </div>
                            <!--end:Menu item-->

                            <!--begin:Menu item - Papan Peringkat-->
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('leaderboard') ? 'active' : '' }}" href="{{ route('leaderboard') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-award fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Papan Peringkat</span>
                                </a>
                            </div>
                            <!--end:Menu item-->

                            <!--begin:Menu item - Cari Siswa-->
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('student.search') ? 'active' : '' }}" href="{{ route('student.search') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-magnifier fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Cari Siswa</span>
                                </a>
                            </div>
                            <!--end:Menu item-->

                            <!--begin:Menu section-->
                            <div class="menu-item pt-5">
                                <div class="menu-content">
                                    <span class="menu-heading fw-bold text-uppercase fs-7">Akun</span>
                                </div>
                            </div>
                            <!--end:Menu section-->

                            <!--begin:Menu item - Login-->
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('login') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-entrance-right fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Login Admin</span>
                                </a>
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>
                </div>
                <!--end::Aside menu-->
            </div>
            <!--end::Aside-->

            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">


                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        @yield('content')
                    </div>
                    <!--end::Post-->


                </div>
                <!--end::Content-->

                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-gray-900 order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">{{ date('Y') }}©</span>
                            <a href="{{ route('home') }}" class="text-gray-800 text-hover-primary">{{ $appData->school_name ?? 'E-Case System' }}</a>
                            @if($appData && $appData->school_address)
                                <span class="text-muted d-block d-md-inline-block ms-md-2 mt-2 mt-md-0">
                                    <i class="ki-duotone ki-geolocation fs-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ $appData->school_address }}
                                </span>
                            @endif
                        </div>
                        @if($appData && ($appData->school_phone || $appData->school_email))
                        <div class="text-gray-900 order-1 order-md-2">
                            @if($appData->school_phone)
                                <span class="text-muted me-3">
                                    <i class="ki-duotone ki-phone fs-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ $appData->school_phone }}
                                </span>
                            @endif
                            @if($appData->school_email)
                                <span class="text-muted">
                                    <i class="ki-duotone ki-sms fs-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ $appData->school_email }}
                                </span>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->

    <!--begin::Javascript-->
    <script>var hostUrl = "{{ asset('assets/') }}/";</script>

    <!--begin::Global Javascript Bundle-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->

    <!--begin::DataTables-->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <!--end::DataTables-->

    @stack('scripts')
</body>
</html>
