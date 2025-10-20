@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 p-4 mx-auto" style="max-width: 600px; border-radius: 20px;">
        <h4 class="fw-bold text-center mb-4">Edit Data Dosen</h4>

        <form action="{{ route('dosen.update', $dosen->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Dosen</label>
                <input type="text" name="nama" class="form-control" value="{{ $dosen->nama }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">NIP</label>
                <input type="text" name="nip" class="form-control" value="{{ $dosen->nip }}" required>
            </div>

            <div class="mb-3">
    <label for="golongan" class="form-label fw-semibold">Golongan / Pangkat</label>
    <select name="golongan" id="golongan" class="form-select" required>
        <option value="">-- Pilih Golongan --</option>
        <option value="Tidak Ada" {{ old('golongan', $dosen->golongan) == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>

        <optgroup label="GOLONGAN IV">
            <option value="IV/a - Pembina" {{ old('golongan', $dosen->golongan) == 'IV/a - Pembina' ? 'selected' : '' }}>IV/a - Pembina</option>
            <option value="IV/b - Pembina Tingkat I" {{ old('golongan', $dosen->golongan) == 'IV/b - Pembina Tingkat I' ? 'selected' : '' }}>IV/b - Pembina Tingkat I</option>
            <option value="IV/c - Pembina Utama Muda" {{ old('golongan', $dosen->golongan) == 'IV/c - Pembina Utama Muda' ? 'selected' : '' }}>IV/c - Pembina Utama Muda</option>
            <option value="IV/d - Pembina Utama Madya" {{ old('golongan', $dosen->golongan) == 'IV/d - Pembina Utama Madya' ? 'selected' : '' }}>IV/d - Pembina Utama Madya</option>
            <option value="IV/e - Pembina Utama" {{ old('golongan', $dosen->golongan) == 'IV/e - Pembina Utama' ? 'selected' : '' }}>IV/e - Pembina Utama</option>
        </optgroup>

        <optgroup label="GOLONGAN III">
            <option value="III/a - Penata Muda" {{ old('golongan', $dosen->golongan) == 'III/a - Penata Muda' ? 'selected' : '' }}>III/a - Penata Muda</option>
            <option value="III/b - Penata Muda Tingkat I" {{ old('golongan', $dosen->golongan) == 'III/b - Penata Muda Tingkat I' ? 'selected' : '' }}>III/b - Penata Muda Tingkat I</option>
            <option value="III/c - Penata" {{ old('golongan', $dosen->golongan) == 'III/c - Penata' ? 'selected' : '' }}>III/c - Penata</option>
            <option value="III/d - Penata Tingkat I" {{ old('golongan', $dosen->golongan) == 'III/d - Penata Tingkat I' ? 'selected' : '' }}>III/d - Penata Tingkat I</option>
        </optgroup>

        <optgroup label="GOLONGAN II">
            <option value="II/a - Pengatur Muda" {{ old('golongan', $dosen->golongan) == 'II/a - Pengatur Muda' ? 'selected' : '' }}>II/a - Pengatur Muda</option>
            <option value="II/b - Pengatur Muda Tingkat I" {{ old('golongan', $dosen->golongan) == 'II/b - Pengatur Muda Tingkat I' ? 'selected' : '' }}>II/b - Pengatur Muda Tingkat I</option>
            <option value="II/c - Pengatur" {{ old('golongan', $dosen->golongan) == 'II/c - Pengatur' ? 'selected' : '' }}>II/c - Pengatur</option>
            <option value="II/d - Pengatur Tingkat I" {{ old('golongan', $dosen->golongan) == 'II/d - Pengatur Tingkat I' ? 'selected' : '' }}>II/d - Pengatur Tingkat I</option>
        </optgroup>

        <optgroup label="GOLONGAN I">
            <option value="I/a - Juru Muda" {{ old('golongan', $dosen->golongan) == 'I/a - Juru Muda' ? 'selected' : '' }}>I/a - Juru Muda</option>
            <option value="I/b - Juru Muda Tingkat I" {{ old('golongan', $dosen->golongan) == 'I/b - Juru Muda Tingkat I' ? 'selected' : '' }}>I/b - Juru Muda Tingkat I</option>
            <option value="I/c - Juru" {{ old('golongan', $dosen->golongan) == 'I/c - Juru' ? 'selected' : '' }}>I/c - Juru</option>
            <option value="I/d - Juru Tingkat I" {{ old('golongan', $dosen->golongan) == 'I/d - Juru Tingkat I' ? 'selected' : '' }}>I/d - Juru Tingkat I</option>
        </optgroup>
    </select>
</div>

            

            <div class="mb-3">
                <label class="form-label fw-semibold">Jurusan</label>
                <select name="jurusan" class="form-select" required>
                    @foreach ($jurusan as $j)
                        <option value="{{ $j }}" {{ $dosen->jurusan == $j ? 'selected' : '' }}>
                            {{ $j }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
    <label for="jabatan" class="form-label">Jabatan Fungsional</label>
    <select name="jabatan" id="jabatan" class="form-select" required>
        <option value="">-- Pilih Jabatan --</option>
        <option value="Tidak Ada" {{ old('jabatan', $dosen->jabatan ?? '') == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
        <option value="Asisten Ahli" {{ old('jabatan', $dosen->jabatan ?? '') == 'Asisten Ahli' ? 'selected' : '' }}>Asisten Ahli</option>
        <option value="Lektor" {{ old('jabatan', $dosen->jabatan ?? '') == 'Lektor' ? 'selected' : '' }}>Lektor</option>
        <option value="Lektor Kepala" {{ old('jabatan', $dosen->jabatan ?? '') == 'Lektor Kepala' ? 'selected' : '' }}>Lektor Kepala</option>
        <option value="Guru Besar" {{ old('jabatan', $dosen->jabatan ?? '') == 'Guru Besar' ? 'selected' : '' }}>Guru Besar</option>
    </select>
</div>


            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('dosen.show', $dosen->jurusan) }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
