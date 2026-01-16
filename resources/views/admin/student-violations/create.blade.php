@extends('layouts.app')

@section('title', 'Catat Pelanggaran Siswa')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="mb-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">Catat Pelanggaran Siswa</h1>
        </div>

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header">
                <h3 class="card-title">Form Pencatatan Pelanggaran</h3>
            </div>
            <!--end::Card header-->

            <!--begin::Form-->
            <form action="{{ route('admin.student-violations.store') }}" method="POST" id="violationForm">
                @csrf

                <!--begin::Card body-->
                <div class="card-body">

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!--begin::Input group - Student-->
                    <div class="mb-10">
                        <label class="form-label required">Siswa</label>
                        <select name="student_id" id="studentSelect" class="form-select form-select-solid @error('student_id') is-invalid @enderror" required>
                            <option value="">Pilih Siswa</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" data-points="{{ $student->total_points }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} ({{ $student->nis }}) - {{ $student->classRoom->name }} - Total Poin: {{ $student->total_points }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Pilih siswa yang melakukan pelanggaran</div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group - Violation-->
                    <div class="mb-10">
                        <label class="form-label required">Jenis Pelanggaran</label>
                        <select name="violation_id" id="violationSelect" class="form-select form-select-solid @error('violation_id') is-invalid @enderror" required>
                            <option value="">Pilih Jenis Pelanggaran</option>
                            @foreach($violations as $violation)
                                <option value="{{ $violation->id }}" data-points="{{ $violation->point_value }}" {{ old('violation_id') == $violation->id ? 'selected' : '' }}>
                                    {{ $violation->name }} ({{ $violation->point_value }} Poin)
                                </option>
                            @endforeach
                        </select>
                        @error('violation_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Pilih jenis pelanggaran yang dilakukan</div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group - Date-->
                    <div class="mb-10">
                        <label class="form-label required">Tanggal Pelanggaran</label>
                        <input type="date" name="date" class="form-control form-control-solid @error('date') is-invalid @enderror"
                               value="{{ old('date', date('Y-m-d')) }}" required />
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Tanggal terjadinya pelanggaran</div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Point Preview-->
                    <div class="alert alert-primary d-flex align-items-center" id="pointPreview" style="display: none !important;">
                        <i class="fas fa-info-circle fs-2x me-4"></i>
                        <div class="d-flex flex-column">
                            <h5 class="mb-1">Informasi Poin</h5>
                            <span id="pointInfo"></span>
                        </div>
                    </div>
                    <!--end::Point Preview-->

                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer d-flex justify-content-end py-6">
                    <a href="{{ route('admin.student-violations.index') }}" class="btn btn-light btn-active-light-primary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Catat Pelanggaran
                    </button>
                </div>
                <!--end::Card footer-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
</div>
<!--end::Container-->

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const studentSelect = document.getElementById('studentSelect');
        const violationSelect = document.getElementById('violationSelect');
        const pointPreview = document.getElementById('pointPreview');
        const pointInfo = document.getElementById('pointInfo');

        function updatePointPreview() {
            const studentOption = studentSelect.options[studentSelect.selectedIndex];
            const violationOption = violationSelect.options[violationSelect.selectedIndex];

            if (studentSelect.value && violationSelect.value) {
                const currentPoints = parseInt(studentOption.dataset.points) || 0;
                const addPoints = parseInt(violationOption.dataset.points) || 0;
                const newPoints = currentPoints + addPoints;

                pointInfo.innerHTML = `Poin saat ini: <strong>${currentPoints}</strong> | Poin ditambahkan: <strong class="text-danger">+${addPoints}</strong> | Total baru: <strong class="text-danger">${newPoints}</strong>`;
                pointPreview.style.display = 'flex';
            } else {
                pointPreview.style.display = 'none';
            }
        }

        studentSelect.addEventListener('change', updatePointPreview);
        violationSelect.addEventListener('change', updatePointPreview);

        // Initial update
        updatePointPreview();
    });
</script>
@endpush
@endsection
