@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-center m-0">{{ $jurusan }}</h3>
        <a href="{{ route('dosen.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Tambah Dosen
        </a>
    </div>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Golongan</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dosen as $key => $d)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->nip }}</td>
                    <td>{{ $d->golongan }}</td>
                    <td>{{ $d->jurusan }}</td>
                    <td class="text-center">
                        <a href="{{ route('dosen.edit', $d->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('dosen.destroy', $d->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data dosen di jurusan ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
