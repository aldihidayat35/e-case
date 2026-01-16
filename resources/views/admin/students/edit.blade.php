@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="mb-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">Edit Siswa</h1>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Siswa</h3>
            </div>
            <form action="{{ route('admin.students.update', $student) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <div class="mb-10">
                        <label class="required form-label">NIS</label>
                        <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror"
                               placeholder="Nomor Induk Siswa" value="{{ old('nis', $student->nis) }}" required/>
                        @error('nis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-10">
                        <label class="required form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               placeholder="Nama lengkap siswa" value="{{ old('name', $student->name) }}" required/>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-10">
                        <label class="required form-label">Kelas</label>
                        <select name="class_id" class="form-select @error('class_id') is-invalid @enderror" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info">
                        <strong>Info:</strong> Total poin tidak dapat diubah manual. Poin akan otomatis bertambah saat pelanggaran dicatat.
                        <br><strong>Total Poin Saat Ini:</strong> {{ $student->total_points }}
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end py-6">
                    <a href="{{ route('admin.students.index') }}" class="btn btn-light me-3">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
