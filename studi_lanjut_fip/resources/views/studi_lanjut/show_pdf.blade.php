@extends('layouts.app')

@section('title', 'Detail Studi Lanjut Dosen')

@section('content')
<div class="container my-5" 
     style="max-width: 850px; background: white; color: black; padding: 60px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); font-family: 'Times New Roman', Times, serif;">

    <!-- KOP SURAT -->
    <div class="text-center mb-4">
        <h5 class="fw-bold text-uppercase mb-0">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h5>
        <h5 class="mb-0">UNIVERSITAS PENDIDIKAN INDONESIA</h5>
        <h6 class="mb-1">FAKULTAS ILMU PENDIDIKAN</h6>
        <p class="small mb-0">Jl. Dr. Setiabudi No.229 Bandung 40154</p>
        <hr style="border: 2px solid black; margin-top: 1rem; margin-bottom: 1.5rem;">
    </div>

    <!-- JUDUL SURAT -->
    <div class="text-center mb-4">
        <h5 class="fw-bold text-decoration-underline mb-1">SURAT KETERANGAN STUDI LANJUT DOSEN</h5>
        <p class="mb-0">Nomor: - /FIP-UPI/{{ date('Y') }}</p>
    </div>

    <!-- ISI SURAT -->
    <div class="mt-4" style="text-align: justify; line-height: 1.8;">
        <p>Yang bertanda tangan di bawah ini Dekan Fakultas Ilmu Pendidikan Universitas Pendidikan Indonesia menerangkan bahwa:</p>

        <table style="margin-left: 40px; width: 100%; border-collapse: collapse;">
            <tr><td style="width: 200px;">Nama</td><td>: {{ $item->nama }}</td></tr>
            <tr><td>NIP</td><td>: {{ $item->nip ?? '-' }}</td></tr>
            <tr><td>Golongan</td><td>: {{ $item->golongan ?? '-' }}</td></tr>
            <tr><td>Jenis Studi</td><td>: {{ $item->jenis_studi ?? '-' }}</td></tr>
            <tr><td>Jenjang</td><td>: {{ $item->jenjang ?? '-' }}</td></tr>
            <tr><td>Status Studi</td><td>: {{ $item->status_studi ?? '-' }}</td></tr>
            <tr><td>Program Studi</td><td>: {{ $item->program_studi ?? '-' }}</td></tr>
            <tr><td>Bidang Studi</td><td>: {{ $item->bidang_studi ?? '-' }}</td></tr>
            <tr><td>Tempat Studi</td><td>: {{ $item->tempat_studi ?? '-' }}</td></tr>
            <tr><td>Lokasi</td><td>: {{ $item->lokasi ?? '-' }}</td></tr>
            <tr><td>Periode Studi</td><td>: {{ \Carbon\Carbon::parse($item->periode_awal)->format('d-m-Y') }} s.d. {{ \Carbon\Carbon::parse($item->periode_akhir)->format('d-m-Y') }}</td></tr>
            <tr><td>Sumber Biaya</td><td>: {{ $item->sumber_biaya ?? '-' }}</td></tr>
            <tr><td>Nomor SK Tugas Belajar</td><td>: {{ $item->tugas_belajar_sk_nomor ?? '-' }}</td></tr>
            <tr><td>Nomor SK Izin Belajar</td><td>: {{ $item->izin_belajar_nomor ?? '-' }}</td></tr>
            <tr><td>Progress Studi</td><td>: {{ $item->progress ?? '-' }}</td></tr>
            <tr><td>Progress November 2024</td><td>: {{ $item->progress_november_2024 ?? '-' }}</td></tr>
        </table>

        <p class="mt-3">
            Demikian surat keterangan ini dibuat untuk digunakan sebagaimana mestinya.
        </p>
    </div>

    <!-- TANDA TANGAN -->
    <div class="text-end mt-5 pe-3">
        <p>Bandung, {{ now()->translatedFormat('d F Y') }}</p>
        <p class="mb-0">Mengetahui,</p>
        <p><strong>Dekan Fakultas Ilmu Pendidikan</strong></p>
        <br><br><br>
        <p class="fw-bold text-decoration-underline mb-0">______________________</p>
        <p class="fst-italic small mb-0">NIP. 19XXXXXXXXXX</p>
    </div>

    <!-- TOMBOL AKSI -->
    <div class="text-center mt-5">
        <a href="{{ route('studi_lanjut.index') }}" class="btn btn-secondary px-4 me-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('studi_lanjut.downloadSurat', $item->id) }}" class="btn btn-dark px-4">
            <i class="bi bi-download"></i> Download Surat (PDF)
        </a>
    </div>
</div>
@endsection
