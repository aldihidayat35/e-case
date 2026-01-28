@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <!--begin::Page heading-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-7">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Dashboard Admin</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">Home</li>
                <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                <li class="breadcrumb-item text-muted">Dashboard</li>
            </ul>
        </div>
        <!--end::Page heading-->

        <!--begin::Row statistik-->
        <div class="row g-3 g-lg-5 g-xl-8 mb-5 mb-xl-8">
            <!--begin::Col - Total Siswa-->
            <div class="col-6 col-md-6 col-xl-3">
                <div class="card card-xl-stretch statistics-card mb-xl-8" style="background: linear-gradient(135deg, #F1416C 0%, #D81B60 100%);">
                    <div class="card-body p-3 p-md-4 p-lg-6">
                        <i class="ki-outline ki-people fs-2x fs-lg-3x text-white opacity-50 mb-4 mb-lg-7"></i>
                        <div class="text-white fw-bold fs-3 fs-lg-2 mb-1 mb-lg-2 mt-3 mt-lg-5">{{ $totalStudents }}</div>
                        <div class="fw-semibold text-white opacity-75 fs-7 fs-lg-6">Total Siswa</div>
                        <div class="text-white opacity-50 fs-8 fs-lg-7 mt-1 d-none d-md-block">Terdaftar dalam sistem</div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col - Total Kelas-->
            <div class="col-6 col-md-6 col-xl-3">
                <div class="card card-xl-stretch statistics-card mb-xl-8" style="background: linear-gradient(135deg, #00A3FF 0%, #0078D4 100%);">
                    <div class="card-body p-3 p-md-4 p-lg-6">
                        <i class="ki-outline ki-book-open fs-2x fs-lg-3x text-white opacity-50 mb-4 mb-lg-7"></i>
                        <div class="text-white fw-bold fs-3 fs-lg-2 mb-1 mb-lg-2 mt-3 mt-lg-5">{{ $totalClasses }}</div>
                        <div class="fw-semibold text-white opacity-75 fs-7 fs-lg-6">Total Kelas</div>
                        <div class="text-white opacity-50 fs-8 fs-lg-7 mt-1 d-none d-md-block">Kelas aktif</div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col - Pelanggaran Hari Ini-->
            <div class="col-6 col-md-6 col-xl-3">
                <div class="card card-xl-stretch statistics-card mb-xl-8" style="background: linear-gradient(135deg, #FFC700 0%, #FFB302 100%);">
                    <div class="card-body p-3 p-md-4 p-lg-6">
                        <i class="ki-outline ki-information fs-2x fs-lg-3x text-white opacity-50 mb-4 mb-lg-7"></i>
                        <div class="text-white fw-bold fs-3 fs-lg-2 mb-1 mb-lg-2 mt-3 mt-lg-5">{{ $todayViolations }}</div>
                        <div class="fw-semibold text-white opacity-75 fs-7 fs-lg-6">Pelanggaran Hari Ini</div>
                        <div class="text-white opacity-50 fs-8 fs-lg-7 mt-1 d-none d-md-block">{{ now()->format('d M Y') }}</div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col - Poin Tertinggi-->
            <div class="col-6 col-md-6 col-xl-3">
                <div class="card card-xl-stretch statistics-card mb-xl-8" style="background: linear-gradient(135deg, #7239EA 0%, #5014D0 100%);">
                    <div class="card-body p-3 p-md-4 p-lg-6">
                        <i class="ki-outline ki-abstract-26 fs-2x fs-lg-3x text-white opacity-50 mb-4 mb-lg-7"></i>
                        <div class="text-white fw-bold fs-3 fs-lg-2 mb-1 mb-lg-2 mt-3 mt-lg-5">
                            @if($highestPointsStudent)
                                {{ $highestPointsStudent->total_points }}
                            @else
                                0
                            @endif
                        </div>
                        <div class="fw-semibold text-white opacity-75 fs-7 fs-lg-6">Poin Tertinggi</div>
                        <div class="text-white opacity-50 fs-8 fs-lg-7 mt-1 d-none d-md-block">
                            @if($highestPointsStudent)
                                {{ Str::limit($highestPointsStudent->name, 20) }}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-3 g-lg-5 gy-5 g-xl-8 mb-5 mb-xl-8">
            <!--begin::Col - Chart-->
            <div class="col-12 col-xl-6 mb-5 mb-xl-8">
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header pt-4 pt-md-5 pt-lg-7 pb-3 flex-column flex-md-row">
                        <h3 class="card-title align-items-start flex-column mb-3 mb-md-0">
                            <span class="card-label fw-bold text-gray-800 fs-5 fs-lg-3">Grafik Pelanggaran</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-8 fs-lg-7">Visualisasi data pelanggaran siswa</span>
                        </h3>
                        <div class="card-toolbar w-100 w-md-auto">
                            <select id="chartMode" class="form-select form-select-solid form-select-sm w-100">
                                <option value="weekly">Mingguan</option>
                                <option value="monthly">Bulanan</option>
                                <option value="yearly">Tahunan</option>
                            </select>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-4 pt-lg-5">
                        <div id="kt_violations_chart" style="height: 250px; max-height: 350px;"></div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col - Statistik Poin Siswa-->
            <div class="col-12 col-xl-6 mb-5 mb-xl-8">
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header pt-4 pt-md-5 pt-lg-7 pb-3">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800 fs-5 fs-lg-3">Statistik Poin Siswa</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-8 fs-lg-7">Distribusi siswa berdasarkan poin</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-4 pt-lg-5">
                        <div id="kt_points_chart" style="height: 180px; max-height: 200px;"></div>
                        <!--begin::Legend-->
                        <div class="d-flex flex-wrap justify-content-center pt-4 pt-lg-5 gap-2 gap-lg-3">
                            <div class="d-flex align-items-center me-3 me-lg-6 mb-2">
                                <span class="bullet bullet-dot bg-success h-8px w-8px h-lg-10px w-lg-10px me-2"></span>
                                <span class="fw-semibold fs-8 fs-lg-7 text-gray-600">0-50 ({{ $pointsStats['safe'] }})</span>
                            </div>
                            <div class="d-flex align-items-center me-3 me-lg-6 mb-2">
                                <span class="bullet bullet-dot bg-warning h-8px w-8px h-lg-10px w-lg-10px me-2"></span>
                                <span class="fw-semibold fs-8 fs-lg-7 text-gray-600">50-100 ({{ $pointsStats['warning'] }})</span>
                            </div>
                            <div class="d-flex align-items-center me-3 me-lg-6 mb-2">
                                <span class="bullet bullet-dot bg-info h-8px w-8px h-lg-10px w-lg-10px me-2"></span>
                                <span class="fw-semibold fs-8 fs-lg-7 text-gray-600">100-150 ({{ $pointsStats['danger'] }})</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="bullet bullet-dot bg-danger h-8px w-8px h-lg-10px w-lg-10px me-2"></span>
                                <span class="fw-semibold fs-8 fs-lg-7 text-gray-600">&gt;150 ({{ $pointsStats['critical'] }})</span>
                            </div>
                        </div>
                        <!--end::Legend-->
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row - Recent Violations-->
        <div class="row g-3 g-lg-5 gy-5 g-xl-8">
            <!--begin::Col-->
            <div class="col-12">
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header pt-4 pt-md-5 pt-lg-7 pb-3 flex-column flex-md-row">
                        <h3 class="card-title align-items-start flex-column mb-3 mb-md-0">
                            <span class="card-label fw-bold text-gray-800 fs-5 fs-lg-3">Pelanggaran Terbaru</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-8 fs-lg-7 d-none d-md-block">10 Pelanggaran terakhir yang tercatat</span>
                        </h3>
                        <div class="card-toolbar w-100 w-md-auto">
                            <a href="{{ route('admin.student-violations.index') }}" class="btn btn-sm btn-light-primary w-100 w-md-auto">
                                <i class="ki-outline ki-eye fs-4 me-1"></i><span class="d-none d-md-inline">Lihat Semua</span><span class="d-inline d-md-none">Semua</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-3 pt-md-4 pt-lg-5 px-3 px-md-4 px-lg-7">
                        @forelse($recentViolations as $violation)
                        <!--begin::Timeline item-->
                        <div class="d-flex align-items-start mb-5 mb-md-6 mb-lg-8">
                            <!--begin::Bullet-->
                            <span class="bullet bullet-vertical h-25px h-md-30px h-lg-40px bg-danger me-2 me-md-3 me-lg-5"></span>
                            <!--end::Bullet-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center flex-wrap mb-1 mb-lg-2 gap-2">
                                    <a href="{{ route('admin.students.show', $violation->student) }}" class="text-gray-800 text-hover-primary fw-bold fs-7 fs-lg-5">
                                        {{ Str::limit($violation->student->name, 25) }}
                                    </a>
                                    <span class="badge badge-light-danger fs-9 fs-lg-8 fw-bold">+{{ $violation->point }}</span>
                                </div>
                                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-1">
                                    <span class="text-gray-800 fw-semibold fs-8 fs-md-7 fs-lg-6">{{ Str::limit($violation->violation->name, 30) }}</span>
                                    <span class="text-gray-500 fw-semibold fs-9 fs-md-8 fs-lg-7 d-none d-md-inline">• {{ $violation->student->classRoom->name }}</span>
                                </div>
                                <span class="text-gray-500 fw-semibold fs-8 fs-lg-7 d-block mt-1">
                                    <i class="ki-outline ki-time fs-8 fs-lg-7 me-1"></i>{{ $violation->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Timeline item-->
                        @empty
                        <div class="text-center py-15">
                            <i class="ki-outline ki-shield-tick fs-5x text-success mb-5"></i>
                            <div class="text-gray-800 fw-bold fs-5 mb-2">Tidak Ada Pelanggaran</div>
                            <div class="text-gray-600 fw-semibold fs-6">Belum ada pelanggaran yang tercatat</div>
                        </div>
                        @endforelse
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

    </div>
</div>
<!--end::Content-->
@endsection

@push('scripts')
<script>
    "use strict";

    var KTViolationsChart = function () {
        var chart;
        var element = document.getElementById("kt_violations_chart");

        var init = function() {
            if (!element) {
                console.log("Chart element not found");
                return;
            }

            loadChartData('weekly');
        }

        var loadChartData = function(mode) {
            fetch("{{ route('admin.dashboard.violations-chart') }}?mode=" + mode)
                .then(response => response.json())
                .then(data => {
                    console.log("Chart data:", data);

                    if (!chart) {
                        var options = {
                            series: [{
                                name: 'Pelanggaran',
                                data: data.data
                            }],
                            chart: {
                                fontFamily: 'inherit',
                                type: 'area',
                                height: 350,
                                toolbar: {
                                    show: false
                                },
                                zoom: {
                                    enabled: false
                                }
                            },
                            plotOptions: {},
                            legend: {
                                show: false
                            },
                            dataLabels: {
                                enabled: false
                            },
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.4,
                                    opacityTo: 0.05,
                                    stops: [15, 100, 100, 100]
                                }
                            },
                            stroke: {
                                curve: 'smooth',
                                show: true,
                                width: 3,
                                colors: ['#F1416C']
                            },
                            xaxis: {
                                categories: data.categories,
                                axisBorder: {
                                    show: false,
                                },
                                axisTicks: {
                                    show: false
                                },
                                tickAmount: 6,
                                labels: {
                                    rotate: 0,
                                    rotateAlways: false,
                                    style: {
                                        colors: '#A1A5B7',
                                        fontSize: '12px'
                                    }
                                },
                                crosshairs: {
                                    position: 'front',
                                    stroke: {
                                        color: '#F1416C',
                                        width: 1,
                                        dashArray: 3
                                    }
                                },
                                tooltip: {
                                    enabled: true,
                                    formatter: undefined,
                                    offsetY: 0,
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            },
                            yaxis: {
                                tickAmount: 4,
                                labels: {
                                    style: {
                                        colors: '#A1A5B7',
                                        fontSize: '12px'
                                    },
                                    formatter: function (val) {
                                        return Math.floor(val)
                                    }
                                }
                            },
                            states: {
                                normal: {
                                    filter: {
                                        type: 'none',
                                        value: 0
                                    }
                                },
                                hover: {
                                    filter: {
                                        type: 'none',
                                        value: 0
                                    }
                                },
                                active: {
                                    allowMultipleDataPointsSelection: false,
                                    filter: {
                                        type: 'none',
                                        value: 0
                                    }
                                }
                            },
                            tooltip: {
                                style: {
                                    fontSize: '12px'
                                },
                                y: {
                                    formatter: function (val) {
                                        return val + " pelanggaran"
                                    }
                                }
                            },
                            colors: ['#F1416C'],
                            grid: {
                                borderColor: '#F1F1F2',
                                strokeDashArray: 4,
                                padding: {
                                    top: 0,
                                    right: 0,
                                    bottom: 0,
                                    left: 0
                                },
                                yaxis: {
                                    lines: {
                                        show: true
                                    }
                                }
                            },
                            markers: {
                                strokeColors: '#F1416C',
                                strokeWidth: 3
                            }
                        };

                        chart = new ApexCharts(element, options);
                        chart.render();
                    } else {
                        chart.updateOptions({
                            xaxis: {
                                categories: data.categories
                            }
                        });
                        chart.updateSeries([{
                            name: 'Pelanggaran',
                            data: data.data
                        }]);
                    }
                })
                .catch(error => {
                    console.error('Error loading chart data:', error);
                });
        }

        // Public methods
        return {
            init: function () {
                init();
            },
            loadChart: function(mode) {
                loadChartData(mode);
            }
        }
    }();

    // Points Pie Chart
    var KTPointsChart = function () {
        var chart;
        var element = document.getElementById("kt_points_chart");

        var init = function() {
            if (!element) {
                console.log("Points chart element not found");
                return;
            }

            var options = {
                series: [{{ $pointsStats['safe'] }}, {{ $pointsStats['warning'] }}, {{ $pointsStats['danger'] }}, {{ $pointsStats['critical'] }}],
                chart: {
                    fontFamily: 'inherit',
                    type: 'donut',
                    height: 300,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Total',
                                    fontSize: '14px',
                                    fontWeight: 600,
                                    color: '#181C32',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0) + ' Siswa'
                                    }
                                },
                                value: {
                                    show: true,
                                    fontSize: '20px',
                                    fontWeight: 700,
                                    color: '#181C32',
                                    offsetY: 5
                                }
                            }
                        }
                    }
                },
                colors: ['#50CD89', '#FFC700', '#7239EA', '#F1416C'],
                stroke: {
                    width: 0
                },
                labels: ['0-50 Poin', '50-100 Poin', '100-150 Poin', '>150 Poin'],
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return val + " siswa"
                        }
                    }
                }
            };

            chart = new ApexCharts(element, options);
            chart.render();
        }

        // Public methods
        return {
            init: function () {
                init();
            }
        }
    }();

    // On document ready
    if (typeof KTUtil !== 'undefined') {
        KTUtil.onDOMContentLoaded(function () {
            KTViolationsChart.init();
            KTPointsChart.init();

            // Handle mode change
            var chartModeSelect = document.getElementById('chartMode');
            if (chartModeSelect) {
                chartModeSelect.addEventListener('change', function() {
                    KTViolationsChart.loadChart(this.value);
                });
            }
        });
    } else {
        document.addEventListener('DOMContentLoaded', function() {
            KTViolationsChart.init();
            KTPointsChart.init();

            // Handle mode change
            var chartModeSelect = document.getElementById('chartMode');
            if (chartModeSelect) {
                chartModeSelect.addEventListener('change', function() {
                    KTViolationsChart.loadChart(this.value);
                });
            }
        });
    }
</script>
@endpush
