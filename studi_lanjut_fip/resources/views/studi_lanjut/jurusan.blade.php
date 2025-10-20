@extends('layouts.app')

@section('title', 'Data Dosen FIP per Jurusan')

@section('content')
<style>
body {
    background-color: #f8faf9;
    font-family: "Inter", sans-serif;
}

h4 {
    color: #16a34a;
    font-weight: 700;
}

.card-jurusan {
    border: none;
    border-radius: 15px;
    box-shadow: 0 3px 6px rgba(0, 128, 0, 0.15);
    transition: all 0.25s ease;
    background: linear-gradient(135deg, #ffffff, #f1fff5);
}
.card-jurusan:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 12px rgba(0, 128, 0, 0.25);
}
.card-jurusan .icon {
    font-size: 2.5rem;
    color: #16a34a;
}
.card-jurusan h5 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
}
.card-jurusan p {
    color: #666;
    font-size: 0.9rem;
}

a.card-link {
    text-decoration: none;
}

@media (max-width: 768px) {
    .card-jurusan {
        margin-bottom: 1rem;
    }
}
</style>

<div class="container-fluid">
    <h4 class="mb-4">
        <i class="bi bi-building"></i> Data Dosen FIP Berdasarkan Jurusan / Program Studi
    </h4>

    <div class="row g-4">
        @php
            $jurusan = [
                ['nama' => 'Administrasi Pendidikan', 'slug' => 'administrasi-pendidikan', 'ikon' => 'bi bi-mortarboard'],
                ['nama' => 'Bimbingan dan Konseling', 'slug' => 'bimbingan-dan-konseling', 'ikon' => 'bi bi-people'],
                ['nama' => 'Pendidikan Khusus', 'slug' => 'pendidikan-khusus', 'ikon' => 'bi bi-universal-access'],
                ['nama' => 'Pendidikan Masyarakat', 'slug' => 'pendidikan-masyarakat', 'ikon' => 'bi bi-people-fill'],
                ['nama' => 'Psikologi', 'slug' => 'psikologi', 'ikon' => 'bi bi-brain'],
                ['nama' => 'Perpustakaan dan Sains Informasi', 'slug' => 'perpustakaan-dan-sains-informasi', 'ikon' => 'bi bi-journal-bookmark'],
                ['nama' => 'Teknologi Pendidikan', 'slug' => 'teknologi-pendidikan', 'ikon' => 'bi bi-laptop'],
                ['nama' => 'Manajemen Pendidikan (opsional)', 'slug' => 'manajemen-pendidikan', 'ikon' => 'bi bi-person-lines-fill'],
            ];
        @endphp

        @foreach($jurusan as $j)
        <div class="col-md-3 col-sm-6">
            <a href="{{ route('studi_lanjut.jurusan', $j['slug']) }}" class="card-link">
                <div class="card card-jurusan text-center p-4 h-100">
                    <div class="icon mb-3">
                        <i class="{{ $j['ikon'] }}"></i>
                    </div>
                    <h5>{{ $j['nama'] }}</h5>
                    <p>Lihat data dosen jurusan ini</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
