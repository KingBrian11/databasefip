@extends('layouts.app')

@section('title', 'Detail Studi Lanjut Dosen')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-mortarboard-fill me-2"></i> Detail Studi Lanjut Dosen
            </h5>
            <a href="{{ route('studi_lanjut.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-body p-4">
            <div class="row mb-4">
                <!-- Data Dosen -->
                <div class="col-md-6">
                    <h6 class="fw-bold text-primary mb-3">
                        🧑‍🏫 Data Dosen
                    </h6>
                    <table class="table table-borderless align-middle">
                        <tr>
                            <th style="width: 180px;">
                                <i class="bi bi-person-fill text-secondary me-2"></i> Nama
                            </th>
                            <td>{{ $item->nama }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-card-text text-secondary me-2"></i> NIP
                            </th>
                            <td>{{ $item->nip ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-diagram-3 text-secondary me-2"></i> Golongan
                            </th>
                            <td>{{ $item->golongan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-building text-secondary me-2"></i> Staf
                            </th>
                            <td>{{ $item->unit_kerja ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Studi Lanjut -->
                <div class="col-md-6">
                    <h6 class="fw-bold text-primary mb-3">
                        📚 Studi Lanjut
                    </h6>
                    <table class="table table-borderless align-middle">
                        <tr>
                            <th style="width: 180px;">
                                <i class="bi bi-journal-bookmark-fill text-secondary me-2"></i> Jenis Studi
                            </th>
                            <td>{{ $item->jenis_studi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-bar-chart-steps text-secondary me-2"></i> Jenjang
                            </th>
                            <td>{{ $item->jenjang ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-check-circle-fill text-secondary me-2"></i> Status Studi
                            </th>
                            <td>{{ $item->status_studi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-lightbulb-fill text-secondary me-2"></i> Bidang Studi
                            </th>
                            <td>{{ $item->bidang_studi ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <!-- Lokasi & Periode -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-primary mb-3">🏫 Lokasi & Institusi</h6>
                    <table class="table table-borderless align-middle">
                        <tr>
                            <th style="width: 180px;">
                                <i class="bi bi-geo-alt-fill text-secondary me-2"></i> Lokasi
                            </th>
                            <td>{{ $item->lokasi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-bank text-secondary me-2"></i> Tempat Studi
                            </th>
                            <td>{{ $item->tempat_studi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-cash-coin text-secondary me-2"></i> Sumber Biaya
                            </th>
                            <td>{{ $item->sumber_biaya ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h6 class="fw-bold text-primary mb-3">🗓️ Periode Studi</h6>
                    <table class="table table-borderless align-middle">
                        <tr>
                            <th style="width: 180px;">
                                <i class="bi bi-calendar-event text-secondary me-2"></i> Periode Awal
                            </th>
                            <td>
                                {{ $item->periode_awal ? \Carbon\Carbon::parse($item->periode_awal)->format('d M Y') : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-calendar-check text-secondary me-2"></i> Periode Akhir
                            </th>
                            <td>
                                {{ $item->periode_akhir ? \Carbon\Carbon::parse($item->periode_akhir)->format('d M Y') : '-' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <!-- SK dan Progress -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-primary mb-3">📄 Nomor SK</h6>
                    <table class="table table-borderless align-middle">
                        <tr>
                            <th style="width: 180px;">
                                <i class="bi bi-file-earmark-text-fill text-secondary me-2"></i> SK Tugas Belajar
                            </th>
                            <td>{{ $item->tugas_belajar_sk_nomor ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-file-earmark-check-fill text-secondary me-2"></i> SK Izin Belajar
                            </th>
                            <td>{{ $item->izin_belajar_nomor ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h6 class="fw-bold text-primary mb-3">📈 Progress Studi</h6>
                    <table class="table table-borderless align-middle">
                        <tr>
                            <th style="width: 180px;">
                                <i class="bi bi-graph-up-arrow text-secondary me-2"></i> Progress
                            </th>
                            <td>{{ $item->progress ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-clipboard-data text-secondary me-2"></i> Progress November 2024
                            </th>
                            <td>{{ $item->progress_november_2024 ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer text-center bg-light py-3">
            <a href="{{ route('studi_lanjut.edit', $item->id) }}" class="btn btn-warning px-4 me-2">
                <i class="bi bi-pencil-square"></i> Edit Data
            </a>
            <a href="{{ route('studi_lanjut.downloadSurat', $item->id) }}" class="btn btn-dark px-4">
                <i class="bi bi-download"></i> Download Surat
            </a>
        </div>
    </div>
</div>
@endsection
