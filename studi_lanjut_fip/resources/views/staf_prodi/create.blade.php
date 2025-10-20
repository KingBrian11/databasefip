@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold text-center mb-4">Tambah Staf Prodi</h3>

    <form action="{{ route('staf_prodi.store') }}" method="POST" class="mx-auto" style="max-width: 600px;">
        @csrf

        <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <input type="text" name="program_studi" class="form-control" placeholder="Nama Program Studi" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Staf</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama lengkap staf" required>
        </div>

        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" placeholder="Isi jika ada">
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" placeholder="Misal: Staf TU, Asisten Prodi, dll">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('staf_prodi.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
