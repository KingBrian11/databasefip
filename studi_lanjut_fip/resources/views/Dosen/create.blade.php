@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 p-4 mx-auto" style="max-width: 600px; border-radius: 20px;">
        <h4 class="fw-bold text-center mb-4">Tambah Data Dosen</h4>

        <form action="{{ route('dosen.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Dosen</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">NIP</label>
                <input type="text" name="nip" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Golongan</label>
                <input type="text" name="golongan" class="form-control" placeholder="Contoh: IV/c, III/b" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Jurusan</label>
                <select name="jurusan" class="form-select" required>
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach ($jurusan as $j)
                        <option value="{{ $j }}">{{ $j }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
    <label for="jabatan" class="form-label">Jabatan Fungsional</label>
    <select name="jabatan" id="jabatan" class="form-select" required>
        <option value="">-- Pilih Jabatan --</option>
        <option value="Asisten Ahli" {{ old('jabatan', $dosen->jabatan ?? '') == 'Asisten Ahli' ? 'selected' : '' }}>Asisten Ahli</option>
        <option value="Lektor" {{ old('jabatan', $dosen->jabatan ?? '') == 'Lektor' ? 'selected' : '' }}>Lektor</option>
        <option value="Lektor Kepala" {{ old('jabatan', $dosen->jabatan ?? '') == 'Lektor Kepala' ? 'selected' : '' }}>Lektor Kepala</option>
        <option value="Guru Besar" {{ old('jabatan', $dosen->jabatan ?? '') == 'Guru Besar' ? 'selected' : '' }}>Guru Besar</option>
    </select>
</div>


            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
