<!--begin::Page title-->
<div class="page-title d-flex justify-content-center flex-column me-5">
    <!--begin::Title-->
    <h1 class="d-flex flex-column text-gray-900 fw-bold fs-3 mb-0">
        {{ $pageTitle ?? 'Dashboard' }}
    </h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        @if(isset($breadcrumbs) && is_array($breadcrumbs))
            @foreach($breadcrumbs as $index => $breadcrumb)
                <!--begin::Item-->
                <li class="breadcrumb-item {{ $loop->last ? 'text-gray-900' : 'text-muted' }}">
                    @if(isset($breadcrumb['url']) && !$loop->last)
                        <a href="{{ $breadcrumb['url'] }}" class="text-muted text-hover-primary">
                            {{ $breadcrumb['title'] }}
                        </a>
                    @else
                        {{ $breadcrumb['title'] }}
                    @endif
                </li>
                <!--end::Item-->

                @if(!$loop->last)
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                @endif
            @endforeach
        @else
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-gray-900">Dashboard</li>
            <!--end::Item-->
        @endif
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->
