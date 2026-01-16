@extends('layouts.app')

@section('title', 'Daftar Siswa Terkena Denda')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="mb-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">Daftar Siswa Terkena Denda</h1>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!--begin::Info Alert-->
        <div class="alert alert-info d-flex align-items-center mb-5">
            <i class="fas fa-info-circle fs-2x me-4"></i>
            <div class="d-flex flex-column">
                <h5 class="mb-1">Informasi Denda</h5>
                <span>Siswa dengan total poin > 0 termasuk dalam daftar denda. Reset poin akan menghapus seluruh poin siswa menjadi 0 (biasanya dilakukan setiap semester baru).</span>
            </div>
        </div>
        <!--end::Info Alert-->

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <i class="fas fa-search fs-3"></i>
                        </span>
                        <input type="text" class="form-control form-control-solid w-250px ps-15" placeholder="Cari siswa..." id="searchInput" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end">
                        <span class="badge badge-danger fs-5 me-3">Total Siswa Denda: {{ $students->count() }}</span>
                    </div>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="finesTable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-50px">No</th>
                                <th class="min-w-100px">NIS</th>
                                <th class="min-w-200px">Nama Siswa</th>
                                <th class="min-w-100px">Kelas</th>
                                <th class="min-w-100px text-center">Total Poin</th>
                                <th class="min-w-100px text-center">Status</th>
                                <th class="text-end min-w-100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse($students as $index => $student)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $student->nis }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-800 fw-bold">{{ $student->name }}</span>
                                        <span class="text-muted fs-7">
                                            {{ $student->violations->count() }} pelanggaran
                                        </span>
                                    </div>
                                </td>
                                <td>{{ $student->classRoom->name }}</td>
                                <td class="text-center">
                                    @if($student->total_points >= 50)
                                        <span class="badge badge-danger fs-4">{{ $student->total_points }}</span>
                                    @elseif($student->total_points >= 20)
                                        <span class="badge badge-warning fs-4">{{ $student->total_points }}</span>
                                    @else
                                        <span class="badge badge-info fs-4">{{ $student->total_points }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($student->total_points >= 50)
                                        <span class="badge badge-danger">Berat</span>
                                    @elseif($student->total_points >= 20)
                                        <span class="badge badge-warning">Sedang</span>
                                    @else
                                        <span class="badge badge-info">Ringan</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.students.show', $student) }}" class="btn btn-icon btn-light btn-active-light-primary btn-sm me-1" title="Lihat Detail">
                                        <i class="fas fa-eye fs-4"></i>
                                    </a>
                                    <form action="{{ route('admin.fines.reset', $student) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin mereset poin siswa {{ $student->name }}? Total poin akan menjadi 0.');">
                                        @csrf
                                        <button type="submit" class="btn btn-icon btn-light btn-active-light-success btn-sm" title="Reset Poin">
                                            <i class="fas fa-redo fs-4"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-10">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-smile fs-3x text-success mb-3"></i>
                                        <span class="text-gray-600 fs-5">Tidak ada siswa yang terkena denda</span>
                                        <span class="text-muted fs-7">Semua siswa memiliki poin 0</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($students->count() > 0)
                <div class="separator my-5"></div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-danger" onclick="resetAllPoints()">
                        <i class="fas fa-redo me-2"></i>Reset Semua Poin
                    </button>
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
        let tableRows = document.querySelectorAll('#finesTable tbody tr');

        tableRows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

    // Reset all points
    function resetAllPoints() {
        if (confirm('Apakah Anda yakin ingin mereset poin SEMUA siswa? Tindakan ini tidak dapat dibatalkan!')) {
            // You can implement this by creating a route for reset all
            alert('Fitur reset semua akan segera tersedia. Saat ini, reset dilakukan per siswa.');
        }
    }
</script>
@endpush
@endsection
