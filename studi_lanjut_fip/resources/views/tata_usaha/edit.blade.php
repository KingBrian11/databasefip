@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4 text-center">Edit Data Tata Usaha</h3>

    <div class="card shadow-sm p-4">
        <form action="{{ route('tata_usaha.update', $pegawai->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text"
                       name="nama"
                       id="nama"
                       class="form-control"
                       value="{{ old('nama', $pegawai->nama) }}"
                       required>
            </div>

            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text"
                       name="nip"
                       id="nip"
                       class="form-control"
                       value="{{ old('nip', $pegawai->nip) }}"
                       required>
            </div>

            <div class="mb-3">
                <label for="golongan" class="form-label">Golongan</label>
                <select name="golongan" id="golongan" class="form-select" required>
    <option value="">-- Pilih Golongan --</option>
    <option value="Tidak Ada" {{ old('golongan', $pegawai->golongan) == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>

    <optgroup label="GOLONGAN IV">
        <option value="IV/a - Pembina" {{ old('golongan', $pegawai->golongan) == 'IV/a - Pembina' ? 'selected' : '' }}>IV/a - Pembina</option>
        <option value="IV/b - Pembina Tingkat I" {{ old('golongan', $pegawai->golongan) == 'IV/b - Pembina Tingkat I' ? 'selected' : '' }}>IV/b - Pembina Tingkat I</option>
        <option value="IV/c - Pembina Utama Muda" {{ old('golongan', $pegawai->golongan) == 'IV/c - Pembina Utama Muda' ? 'selected' : '' }}>IV/c - Pembina Utama Muda</option>
        <option value="IV/d - Pembina Utama Madya" {{ old('golongan', $pegawai->golongan) == 'IV/d - Pembina Utama Madya' ? 'selected' : '' }}>IV/d - Pembina Utama Madya</option>
        <option value="IV/e - Pembina Utama" {{ old('golongan', $pegawai->golongan) == 'IV/e - Pembina Utama' ? 'selected' : '' }}>IV/e - Pembina Utama</option>
    </optgroup>

    <optgroup label="GOLONGAN III">
        <option value="III/a - Penata Muda" {{ old('golongan', $pegawai->golongan) == 'III/a - Penata Muda' ? 'selected' : '' }}>III/a - Penata Muda</option>
        <option value="III/b - Penata Muda Tingkat I" {{ old('golongan', $pegawai->golongan) == 'III/b - Penata Muda Tingkat I' ? 'selected' : '' }}>III/b - Penata Muda Tingkat I</option>
        <option value="III/c - Penata" {{ old('golongan', $pegawai->golongan) == 'III/c - Penata' ? 'selected' : '' }}>III/c - Penata</option>
        <option value="III/d - Penata Tingkat I" {{ old('golongan', $pegawai->golongan) == 'III/d - Penata Tingkat I' ? 'selected' : '' }}>III/d - Penata Tingkat I</option>
    </optgroup>

    <optgroup label="GOLONGAN II">
        <option value="II/a - Pengatur Muda" {{ old('golongan', $pegawai->golongan) == 'II/a - Pengatur Muda' ? 'selected' : '' }}>II/a - Pengatur Muda</option>
        <option value="II/b - Pengatur Muda Tingkat I" {{ old('golongan', $pegawai->golongan) == 'II/b - Pengatur Muda Tingkat I' ? 'selected' : '' }}>II/b - Pengatur Muda Tingkat I</option>
        <option value="II/c - Pengatur" {{ old('golongan', $pegawai->golongan) == 'II/c - Pengatur' ? 'selected' : '' }}>II/c - Pengatur</option>
        <option value="II/d - Pengatur Tingkat I" {{ old('golongan', $pegawai->golongan) == 'II/d - Pengatur Tingkat I' ? 'selected' : '' }}>II/d - Pengatur Tingkat I</option>
    </optgroup>

    <optgroup label="GOLONGAN I">
        <option value="I/a - Juru Muda" {{ old('golongan', $pegawai->golongan) == 'I/a - Juru Muda' ? 'selected' : '' }}>I/a - Juru Muda</option>
        <option value="I/b - Juru Muda Tingkat I" {{ old('golongan', $pegawai->golongan) == 'I/b - Juru Muda Tingkat I' ? 'selected' : '' }}>I/b - Juru Muda Tingkat I</option>
        <option value="I/c - Juru" {{ old('golongan', $pegawai->golongan) == 'I/c - Juru' ? 'selected' : '' }}>I/c - Juru</option>
        <option value="I/d - Juru Tingkat I" {{ old('golongan', $pegawai->golongan) == 'I/d - Juru Tingkat I' ? 'selected' : '' }}>I/d - Juru Tingkat I</option>
    </optgroup>
</select>


            </div>

            <!-- optional: Staf / Bagian -->
            <div class="mb-3">
                <label for="staf" class="form-label">Bagian / Staf</label>
                <input type="text"
                       name="staf"
                       id="staf"
                       class="form-control"
                       value="{{ old('staf', $pegawai->staf ?? '') }}"
                       placeholder="Contoh: Akademik, Kepegawaian, Umum">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('tata_usaha.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
