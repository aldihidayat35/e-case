@extends('layouts.app')

@section('title', 'Siswa Berhak Penghargaan')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">Siswa Berhak Penghargaan</h1>
            </div>
            <div>
                <span class="badge badge-success fs-5 me-3">Total: {{ $eligibleStudents->count() }} Siswa</span>
                <a href="{{ route('admin.rewards.create') }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Berikan Penghargaan
                </a>
            </div>
        </div>

        <!--begin::Info Alert-->
        <div class="alert alert-success d-flex align-items-center mb-5">
            <i class="fas fa-trophy fs-2x me-4"></i>
            <div class="d-flex flex-column">
                <h5 class="mb-1">Siswa Berhak Penghargaan</h5>
                <span>Daftar siswa dengan total poin pelanggaran 0 (nol). Mereka berhak mendapatkan penghargaan sebagai siswa teladan yang tidak melakukan pelanggaran.</span>
            </div>
        </div>
        <!--end::Info Alert-->

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" class="form-control form-control-solid w-250px ps-13" placeholder="Cari siswa..." id="searchInput" />
                    </div>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="eligibleTable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-50px">No</th>
                                <th class="min-w-100px">NIS</th>
                                <th class="min-w-200px">Nama Siswa</th>
                                <th class="min-w-100px">Kelas</th>
                                <th class="min-w-100px text-center">Total Poin</th>
                                <th class="min-w-150px">Status</th>
                                <th class="text-end min-w-100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse($eligibleStudents as $index => $student)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $student->nis }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <div class="symbol-label bg-light-success">
                                                <i class="fas fa-user-check fs-2x text-success"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 fw-bold">{{ $student->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $student->classRoom->name }}</td>
                                <td class="text-center">
                                    <span class="badge badge-success fs-4">{{ $student->total_points }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-success">
                                        <i class="fas fa-check-circle me-1"></i>Berhak Penghargaan
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.students.show', $student) }}" class="btn btn-icon btn-light btn-active-light-primary btn-sm me-1" title="Lihat Detail">
                                        <i class="fas fa-eye fs-4"></i>
                                    </a>
                                    <a href="{{ route('admin.rewards.create', ['student_id' => $student->id]) }}" class="btn btn-icon btn-light btn-active-light-success btn-sm" title="Berikan Penghargaan">
                                        <i class="fas fa-trophy fs-4"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-10">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-sad-tear fs-3x text-gray-400 mb-3"></i>
                                        <span class="text-gray-600 fs-5">Tidak ada siswa yang berhak penghargaan</span>
                                        <span class="text-muted fs-7">Semua siswa memiliki catatan pelanggaran</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($eligibleStudents->count() > 0)
                <div class="separator my-5"></div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <i class="fas fa-info-circle me-2"></i>Siswa di atas dapat segera diberikan penghargaan melalui tombol aksi atau menu "Berikan Penghargaan"
                    </div>
                </div>
                @endif
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
</div>
<!--end::Container-->

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('#eligibleTable tbody tr');

        tableRows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection
