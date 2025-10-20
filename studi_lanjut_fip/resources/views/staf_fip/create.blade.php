@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-3">Tambah Jabatan Baru</h3>

    <form action="{{ route('staf_fip.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Jabatan</label>
            <input type="text" name="jabatan" class="form-control" required>
        </div>

        <h5 class="mt-4 mb-2">Daftar Staf</h5>
        <div id="staf-list">
            <div class="input-group mb-2">
                <input type="text" name="nama[]" class="form-control" placeholder="Nama staf">
                <button type="button" class="btn btn-outline-secondary" onclick="addInput()">+</button>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
        <a href="{{ route('staf_fip.index') }}" class="btn btn-secondary mt-3">Kembali</a>
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
