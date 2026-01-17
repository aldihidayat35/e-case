<!--begin::User-->
<div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
    <!--begin::Symbol-->
    <div class="symbol symbol-50px">
        @php
            $appData = \App\Models\AppData::getAppData();
        @endphp
        @if($appData->school_logo)
            {{-- <img src="{{ $appData->logo_url }}" alt="Logo" class="symbol-label"/> --}}
              <div class="symbol-label fs-2 fw-semibold text-white bg-primary">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        @else
            <div class="symbol-label fs-2 fw-semibold text-white bg-primary">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        @endif
    </div>


    <!--end::Symbol-->
    <!--begin::Wrapper-->
    <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
        <!--begin::Section-->
        <div class="d-flex">
            <!--begin::Info-->
            <div class="flex-grow-1 me-2">
                <!--begin::Username-->
                <a href="#" class="text-white text-hover-primary fs-6 fw-bold">{{ auth()->user()->name }}</a>
                <!--end::Username-->
                <!--begin::Description-->
                <span class="text-gray-600 fw-semibold d-block fs-8 mb-1">
                    {{ ucfirst(auth()->user()->role) }}
                </span>
                <!--end::Description-->
                <!--begin::Label-->
                <div class="d-flex align-items-center text-success fs-9">
                    <span class="bullet bullet-dot bg-success me-1"></span>online
                </div>
                <!--end::Label-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Section-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::User-->
