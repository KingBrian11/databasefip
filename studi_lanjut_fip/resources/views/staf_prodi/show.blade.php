@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">{{ $program_studi }}</h3>
        <a href="{{ route('staf_prodi.create') }}" class="btn btn-primary">+ Tambah Staf</a>
    </div>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($staf as $key => $s)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->nip ?? '-' }}</td>
                    <td>{{ $s->jabatan ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('staf_prodi.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('staf_prodi.destroy', $s->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada staf untuk prodi ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
