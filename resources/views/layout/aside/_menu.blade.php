<!--begin::Aside Menu-->
<div class="hover-scroll-overlay-y mx-3 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
    data-kt-scroll-height="auto"
    data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
    data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
    <!--begin::Menu-->
    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
        id="kt_aside_menu" data-kt-menu="true">

        <!--begin:Menu item - Dashboard-->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <span class="menu-icon">
                    <i class="ki-duotone ki-element-11 fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </div>
        <!--end:Menu item-->

        <!--begin:Menu section-->
        <div class="menu-item pt-5">
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">Manajemen Data</span>
            </div>
        </div>
        <!--end:Menu section-->

        <!--begin:Menu item - Kelas-->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('admin.classes.*') ? 'active' : '' }}"
                href="{{ route('admin.classes.index') }}">
                <span class="menu-icon">
                    <i class="ki-duotone ki-home-2 fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </span>
                <span class="menu-title">Kelas</span>
            </a>
        </div>
        <!--end:Menu item-->

        <!--begin:Menu item - Siswa-->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}"
                href="{{ route('admin.students.index') }}">
                <span class="menu-icon">
                    <i class="ki-duotone ki-user fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </span>
                <span class="menu-title">Siswa</span>
            </a>
        </div>
        <!--end:Menu item-->

        <!--begin:Menu item - Jenis Pelanggaran-->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('admin.violations.*') && !request()->routeIs('admin.violations.history') ? 'active' : '' }}"
                href="{{ route('admin.violations.index') }}">
                <span class="menu-icon">
                    <i class="ki-duotone ki-abstract-39 fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </span>
                <span class="menu-title">Jenis Pelanggaran</span>
            </a>
        </div>
        <!--end:Menu item-->

        <!--begin:Menu section-->
        <div class="menu-item pt-5">
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">Pelanggaran Siswa</span>
            </div>
        </div>
        <!--end:Menu section-->

        <!--begin:Menu item - Pelanggaran Siswa-->
        <div data-kt-menu-trigger="click"
            class="menu-item menu-accordion {{ request()->routeIs('admin.student-violations.*') || request()->routeIs('admin.fines.*') || request()->routeIs('admin.violations.history') ? 'show' : '' }}">
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="ki-duotone ki-file-deleted fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </span>
                <span class="menu-title">Pelanggaran Siswa</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.student-violations.index') || request()->routeIs('admin.student-violations.create') || request()->routeIs('admin.student-violations.edit') ? 'active' : '' }}"
                        href="{{ route('admin.student-violations.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Catatan Pelanggaran</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.fines.*') ? 'active' : '' }}"
                        href="{{ route('admin.fines.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Daftar Denda</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.violations.history') ? 'active' : '' }}"
                        href="{{ route('admin.violations.history') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Riwayat</span>
                    </a>
                </div>
            </div>
        </div>
        <!--end:Menu item-->

        <!--begin:Menu section-->
        <div class="menu-item pt-5">
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">Penghargaan</span>
            </div>
        </div>
        <!--end:Menu section-->

        <!--begin:Menu item - Penghargaan-->
        <div data-kt-menu-trigger="click"
            class="menu-item menu-accordion {{ request()->routeIs('admin.rewards.*') ? 'show' : '' }}">
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="ki-duotone ki-award fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </span>
                <span class="menu-title">Penghargaan</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.rewards.index') || request()->routeIs('admin.rewards.show') ? 'active' : '' }}"
                        href="{{ route('admin.rewards.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Data Penghargaan</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.rewards.eligible') ? 'active' : '' }}"
                        href="{{ route('admin.rewards.eligible') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Siswa Berhak</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.rewards.create') ? 'active' : '' }}"
                        href="{{ route('admin.rewards.create') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Berikan Penghargaan</span>
                    </a>
                </div>
            </div>
        </div>
        <!--end:Menu item-->

        <!--begin:Menu section-->
        <div class="menu-item pt-5">
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">Pengaturan</span>
            </div>
        </div>
        <!--end:Menu section-->

        <!--begin:Menu item - Setting App-->
        <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"
                href="{{ route('admin.settings.index') }}">
                <span class="menu-icon">
                    <i class="ki-duotone ki-setting-2 fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </span>
                <span class="menu-title">Setting Aplikasi</span>
            </a>
        </div>
        <!--end:Menu item-->

        <!--begin:Menu item - Logout-->
        <div class="menu-item pt-5">
            <div class="menu-content">
                <span class="menu-heading fw-bold text-uppercase fs-7">Akun</span>
            </div>
        </div>
        <div class="menu-item">
            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                @csrf
                <a class="menu-link" href="#"
                    onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-exit-right fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Logout</span>
                </a>
            </form>
        </div>
        <!--end:Menu item-->
    </div>
    <!--end::Menu-->
</div>
<!--end::Aside Menu-->
