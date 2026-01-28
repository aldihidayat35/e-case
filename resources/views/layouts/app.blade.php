<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: MetronicProduct Version: 8.3.1
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
    <!--begin::Head-->
    <head>
        <base href=""/>
        <title>@yield('title', $appData->app_name ?? config('app.name', 'E-Case'))</title>
        <meta charset="utf-8"/>
        <meta name="description" content="@yield('description', ($appData->app_name ?? 'E-Case') . ' Management System')"/>
        <meta name="keywords" content="@yield('keywords', 'e-case, student management, violation management')"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="@yield('title', $appData->app_name ?? config('app.name', 'E-Case'))" />
        <meta property="og:url" content="{{ url()->current() }}"/>
        <meta property="og:site_name" content="{{ $appData->app_name ?? config('app.name', 'E-Case') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="canonical" href="{{ url()->current() }}"/>
        <link rel="shortcut icon" href="{{ $appData->favicon ? asset('storage/' . $appData->favicon) : asset('assets/media/logos/favicon.ico') }}"/>

        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
        <!--end::Fonts-->

        <!--begin::Vendor Stylesheets(used for this page only)-->
        @stack('vendor-styles')
        <!--end::Vendor Stylesheets-->

        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <!--end::Global Stylesheets Bundle-->

        <!--begin::Responsive Styles-->
        @vite(['resources/css/responsive.css'])
        <!--end::Responsive Styles-->

        <!--begin::Custom Styles-->
        @stack('styles')
        <!--end::Custom Styles-->

        <script>
            // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
            if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
            }
        </script>
    </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body id="kt_body" data-kt-app-page-loading-enabled="false" data-kt-app-page-loading="off" class="aside-enabled">
        @include('partials/theme-mode/_init')
        @include('partials/_loader')

        <!--begin::Main-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="page d-flex flex-row flex-column-fluid">
                @include('layout/aside/_base')

                <!--begin::Wrapper-->
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    @include('layout/header/_base')

                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Post-->
                        <div class="post d-flex flex-column-fluid" id="kt_post">
                            @yield('content')
                        </div>
                        <!--end::Post-->
                    </div>
                    <!--end::Content-->

                    @include('layout/_footer')
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Root-->

        @include('partials/_scrolltop')

        <!--begin::Modals-->
        @stack('modals')
        <!--end::Modals-->

        <!--begin::Javascript-->
        <script>
            var hostUrl = "{{ asset('assets/') }}/";
        </script>

        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
        <!--end::Global Javascript Bundle-->

        <!--begin::Vendors Javascript(used for this page only)-->
        @stack('vendor-scripts')
        <!--end::Vendors Javascript-->

        <!--begin::Custom Javascript(used for this page only)-->
        @stack('scripts')

        <script>
            // Handle horizontal scroll indicator for tables
            document.addEventListener('DOMContentLoaded', function() {
                const tableContainers = document.querySelectorAll('.table-responsive');
                
                tableContainers.forEach(function(container) {
                    // Check initial scroll state
                    checkScrollState(container);
                    
                    // Listen for scroll events
                    container.addEventListener('scroll', function() {
                        checkScrollState(container);
                    });
                    
                    // Listen for window resize
                    window.addEventListener('resize', function() {
                        checkScrollState(container);
                    });
                });
                
                function checkScrollState(container) {
                    const maxScrollLeft = container.scrollWidth - container.clientWidth;
                    
                    if (container.scrollLeft >= maxScrollLeft - 5) {
                        container.classList.add('scrolled-right');
                    } else {
                        container.classList.remove('scrolled-right');
                    }
                    
                    // Also check if there's no horizontal scroll needed
                    if (maxScrollLeft <= 0) {
                        container.classList.add('scrolled-right');
                    }
                }
            });
        </script>
        <!--end::Custom Javascript-->
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>
