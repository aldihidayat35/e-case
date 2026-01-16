<!DOCTYPE html>
<html lang="en">
<head>
    <base href=""/>
    <title>@yield('title', 'Beranda') - {{ $appData->school_name ?? 'E-Case System' }}</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}"/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css"/>

    @stack('styles')

    <style>
        /* Prevent horizontal overflow on public pages */
        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        .container-xxl, .container-fluid {
            max-width: 100%;
            overflow-x: hidden;
        }

        /* Fix row overflow */
        .row {
            margin-left: -12px;
            margin-right: -12px;
        }

        .row > * {
            padding-left: 12px;
            padding-right: 12px;
        }

        /* Ensure cards don't overflow */
        .card {
            max-width: 100%;
            overflow: hidden;
        }

        .card-body {
            overflow-x: auto;
        }

        /* Fix chart overflow */
        canvas {
            max-width: 100% !important;
        }

        /* Ensure tables are responsive */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            width: 100%;
        }

        /* Toolbar responsive */
        .toolbar {
            overflow-x: hidden;
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .row.g-5, .row.g-xl-10 {
                margin-left: -8px;
                margin-right: -8px;
            }

            .row.g-5 > *, .row.g-xl-10 > * {
                padding-left: 8px;
                padding-right: 8px;
            }
        }

        /* Sidebar Styles */
        .sidebar {
            width: 265px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle-btn {
            display: none;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                position: fixed;
                left: -265px;
                top: 0;
                bottom: 0;
                z-index: 1050;
                background: #fff;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
            }

            .sidebar.active {
                left: 0;
            }

            .sidebar-toggle-btn {
                display: block;
            }

            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 1049;
                display: none;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }
    </style>
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Sidebar-->
            <div id="kt_aside" class="aside sidebar bg-white" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                <div class="d-flex flex-column h-100">
                    <!--begin::Brand-->
                    <div class="d-flex align-items-center flex-column py-8 px-5 border-bottom">
                        <a href="{{ route('home') }}" class="d-flex align-items-center flex-column text-decoration-none">
                            @if($appData && $appData->school_logo)
                                <img alt="Logo" src="{{ Storage::url($appData->school_logo) }}" class="h-50px mb-3"/>
                            @else
                                <div class="symbol symbol-50px mb-3">
                                    <div class="symbol-label bg-light-primary">
                                        <i class="fas fa-school fs-2x text-primary"></i>
                                    </div>
                                </div>
                            @endif
                            <span class="text-gray-800 fw-bold fs-5 text-center">{{ $appData->school_name ?? 'E-Case System' }}</span>
                            <span class="text-muted fs-7 text-center mt-1">Sistem Pencatatan Pelanggaran</span>
                        </a>
                    </div>
                    <!--end::Brand-->

                    <!--begin::Aside menu-->
                    <div class="flex-column-fluid">
                        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto">
                            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="kt_aside_menu" data-kt-menu="true">
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                        <span class="menu-icon">
                                            <i class="fas fa-home fs-2"></i>
                                        </span>
                                        <span class="menu-title">Beranda</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('leaderboard') ? 'active' : '' }}" href="{{ route('leaderboard') }}">
                                        <span class="menu-icon">
                                            <i class="fas fa-trophy fs-2"></i>
                                        </span>
                                        <span class="menu-title">Papan Peringkat</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('student.search') ? 'active' : '' }}" href="{{ route('student.search') }}">
                                        <span class="menu-icon">
                                            <i class="fas fa-search fs-2"></i>
                                        </span>
                                        <span class="menu-title">Cari Siswa</span>
                                    </a>
                                </div>
                                <div class="menu-item pt-5">
                                    <div class="menu-content pb-2">
                                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Akun</span>
                                    </div>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="{{ route('login') }}">
                                        <span class="menu-icon">
                                            <i class="fas fa-sign-in-alt fs-2"></i>
                                        </span>
                                        <span class="menu-title">Login Admin</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Aside menu-->
                </div>
            </div>
            <!--end::Sidebar-->

            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header align-items-stretch">
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <!--begin::Mobile toggle-->
                        <div class="d-flex align-items-center d-lg-none ms-n2 me-2">
                            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px sidebar-toggle-btn" id="kt_aside_mobile_toggle">
                                <i class="fas fa-bars fs-1"></i>
                            </div>
                        </div>
                        <!--end::Mobile toggle-->

                        <!--begin::Mobile logo-->
                        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 d-lg-none">
                            <a href="{{ route('home') }}" class="d-flex align-items-center">
                                @if($appData && $appData->school_logo)
                                    <img alt="Logo" src="{{ Storage::url($appData->school_logo) }}" class="h-30px"/>
                                @else
                                    <div class="symbol symbol-30px">
                                        <div class="symbol-label bg-light-primary">
                                            <i class="fas fa-school fs-3 text-primary"></i>
                                        </div>
                                    </div>
                                @endif
                            </a>
                        </div>
                        <!--end::Mobile logo-->

                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-stretch justify-content-end flex-lg-grow-1">
                            <div class="d-flex align-items-center">
                                <span class="d-none d-lg-inline text-gray-800 fw-semibold fs-4">{{ $appData->school_name ?? 'E-Case System' }}</span>
                            </div>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                </div>
                <!--end::Header-->

                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @yield('content')
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
                                    <i class="fas fa-map-marker-alt me-1"></i>{{ $appData->school_address }}
                                </span>
                            @endif
                        </div>
                        @if($appData && ($appData->school_phone || $appData->school_email))
                        <div class="text-gray-900 order-1 order-md-2">
                            @if($appData->school_phone)
                                <span class="text-muted me-3">
                                    <i class="fas fa-phone me-1"></i>{{ $appData->school_phone }}
                                </span>
                            @endif
                            @if($appData->school_email)
                                <span class="text-muted">
                                    <i class="fas fa-envelope me-1"></i>{{ $appData->school_email }}
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
    </div>

    <!--begin::Sidebar Overlay for Mobile-->
    <div class="sidebar-overlay" id="sidebar_overlay"></div>
    <!--end::Sidebar Overlay for Mobile-->

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    
    <script>
    // Sidebar toggle for mobile
    $(document).ready(function() {
        $('#kt_aside_mobile_toggle').on('click', function() {
            $('#kt_aside').toggleClass('active');
            $('#sidebar_overlay').toggleClass('active');
        });

        $('#sidebar_overlay').on('click', function() {
            $('#kt_aside').removeClass('active');
            $('#sidebar_overlay').removeClass('active');
        });
    });
    </script>
    
    @stack('scripts')
</body>
</html>
