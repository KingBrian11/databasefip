@extends('layouts.app')

@section('title', 'Data Staf Prodi')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold text-center mb-4">Daftar Program Studi FIP</h3>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('staf_prodi.create') }}" class="btn btn-success">+ Tambah Staf Prodi</a>
    </div>

    <div class="row">
        @forelse ($programStudi as $prodi)
            <div class="col-md-6 col-lg-4 mb-3">
                <a href="{{ route('staf_prodi.show', $prodi->program_studi) }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $prodi->program_studi }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-center">Belum ada data staf prodi.</p>
        @endforelse
    </div>
</div>
@endsection
