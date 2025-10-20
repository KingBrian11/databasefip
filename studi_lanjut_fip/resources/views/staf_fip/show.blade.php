@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-3">{{ $jabatan->jabatan }}</h2>
    <ul class="list-group shadow">
        @foreach ($jabatan->anggota as $staf)
            <li class="list-group-item">{{ $loop->iteration }}. {{ $staf->nama }}</li>
        @endforeach
    </ul>

    <a href="{{ route('staf_fip.index') }}" class="btn btn-secondary mt-4">← Kembali</a>
</div>
@endsection
