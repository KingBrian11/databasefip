@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Daftar Jabatan Staf FIP</h3>
        <a href="{{ route('staf_fip.create') }}" class="btn btn-success">+ Tambah Jabatan</a>
    </div>

    <div class="list-group shadow">
        @foreach ($jabatan as $item)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('staf_fip.show', $item->id) }}" class="text-decoration-none text-dark">
                    {{ $item->jabatan }}
                </a>
                <div>
                    <a href="{{ route('staf_fip.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('staf_fip.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus jabatan ini?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
