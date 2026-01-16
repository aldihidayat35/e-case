<!--begin::Header-->
<div id="kt_header" style="" class="header  align-items-stretch" >
    <!--begin::Brand-->
    <div class="header-brand">
        <!--begin::Logo-->
         <!--begin::Brand-->
    <div class="aside-logo flex-column-auto px-9 mb-5 pt-10" id="kt_aside_logo">
        @php
            $appData = \App\Models\AppData::getAppData();
        @endphp
        <!--begin::Logo-->
        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center">
            <img alt="Logo" src="{{ $appData->logo_url }}" class="h-45px me-3" />
            <div class="d-flex flex-column">
                <span class="text-white fw-bold fs-3">E-Case</span>
                <span class="text-gray-600 fw-semibold fs-8">{{ $appData->school_name }}</span>
            </div>
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
        <!--end::Logo-->
                    <!--begin::Aside minimize-->
            <div id="kt_aside_toggle"
                class="
                    btn btn-icon w-auto px-0 btn-active-color-primary aside-minimize
                                    "
                data-kt-toggle="true"
                data-kt-toggle-state="active"
                data-kt-toggle-target="body"
                data-kt-toggle-name="aside-minimize"
                >
                <i class="ki-duotone ki-entrance-right fs-1 me-n1 minimize-default"><span class="path1"></span><span class="path2"></span></i>
                <i class="ki-duotone ki-entrance-left fs-1 minimize-active"><span class="path1"></span><span class="path2"></span></i>            </div>
            <!--end::Aside minimize-->
        <!--begin::Aside toggle-->
        <div class="d-flex align-items-center d-lg-none me-n2" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-1"><span class="path1"></span><span class="path2"></span></i>            </div>
        </div>
        <!--end::Aside toggle-->
    </div>
    <!--end::Brand-->
@include('layout/header/__toolbar')
</div>
<!--end::Header-->
