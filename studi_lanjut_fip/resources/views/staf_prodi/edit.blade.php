@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold text-center mb-4">Edit Data Staf Prodi</h3>

    <form action="{{ route('staf_prodi.update', $staf->id) }}" method="POST" class="mx-auto" style="max-width: 600px;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <input type="text" name="program_studi" class="form-control" value="{{ $staf->program_studi }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Staf</label>
            <input type="text" name="nama" class="form-control" value="{{ $staf->nama }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" value="{{ $staf->nip }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ $staf->jabatan }}">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('staf_prodi.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
