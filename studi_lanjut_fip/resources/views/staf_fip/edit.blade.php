@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-3">Edit Jabatan: {{ $jabatan->jabatan }}</h3>

    <form action="{{ route('staf_fip.update', $jabatan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ $jabatan->jabatan }}" required>
        </div>

        <h5 class="mt-4 mb-2">Daftar Staf</h5>
        <div id="staf-list">
            @foreach ($jabatan->anggota as $staf)
            <div class="input-group mb-2">
                <input type="text" name="nama[]" class="form-control" value="{{ $staf->nama }}" placeholder="Nama staf">
                <button type="button" class="btn btn-outline-danger" onclick="this.parentNode.remove()">-</button>
            </div>
            @endforeach
            <div class="input-group mb-2">
                <input type="text" name="nama[]" class="form-control" placeholder="Tambah staf baru">
                <button type="button" class="btn btn-outline-secondary" onclick="addInput()">+</button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
        <a href="{{ route('staf_fip.show', $jabatan->id) }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>

<script>
function addInput() {
    const container = document.getElementById('staf-list');
    const newInput = document.createElement('div');
    newInput.classList.add('input-group', 'mb-2');
    newInput.innerHTML = `
        <input type="text" name="nama[]" class="form-control" placeholder="Nama staf">
        <button type="button" class="btn btn-outline-danger" onclick="this.parentNode.remove()">-</button>
    `;
    container.appendChild(newInput);
}
</script>
@endsection
