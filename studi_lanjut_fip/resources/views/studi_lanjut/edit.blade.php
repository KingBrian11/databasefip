@extends('layouts.app')

@section('title', 'Edit Data Studi Lanjut')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold">Edit Data Studi Lanjut</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-body p-4">
            <form action="{{ route('studi_lanjut.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" name="nama" class="form-control"
                        value="{{ old('nama', $item->nama) }}" required>
                </div>

                <!-- NIP & Golongan -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">NIP</label>
                        <input type="text" name="nip" class="form-control"
                            value="{{ old('nip', $item->nip) }}" placeholder="Masukkan NIP Pegawai">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Golongan</label>
                        <input type="text" name="golongan" class="form-control"
                            value="{{ old('golongan', $item->golongan) }}" placeholder="Masukkan Golongan">
                    </div>
                </div>

                <!-- Unit Kerja & Bidang Studi -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Unit Kerja</label>
                        <input type="text" name="unit_kerja" class="form-control"
                            value="{{ old('unit_kerja', $item->unit_kerja) }}" placeholder="Masukkan Unit Kerja">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Bidang Studi</label>
                        <input type="text" name="bidang_studi" class="form-control"
                            value="{{ old('bidang_studi', $item->bidang_studi) }}" placeholder="Masukkan Bidang Studi">
                    </div>
                </div>

                <!-- Jenis Studi -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Jenis Studi</label>
                    <input type="text" name="jenis_studi" class="form-control"
                        value="{{ old('jenis_studi', $item->jenis_studi) }}" placeholder="Contoh: Izin Belajar / Tugas Belajar">
                </div>

                <!-- Jenjang -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Jenjang</label>
                    <select name="jenjang" class="form-select">
                        <option value="">-- Pilih Jenjang --</option>
                        <option value="S1" {{ old('jenjang', $item->jenjang) == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ old('jenjang', $item->jenjang) == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ old('jenjang', $item->jenjang) == 'S3' ? 'selected' : '' }}>S3</option>
                    </select>
                </div>

                <!-- Status Studi -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Status Studi</label>
                    <select name="status_studi" class="form-select">
                        <option value="">-- Pilih Status --</option>
                        <option value="Aktif" {{ old('status_studi', $item->status_studi) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Lulus" {{ old('status_studi', $item->status_studi) == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                        <option value="Cuti" {{ old('status_studi', $item->status_studi) == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                    </select>
                </div>

                <!-- Lokasi -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Lokasi</label>
                    <select name="lokasi" class="form-select">
                        <option value="">-- Pilih Lokasi --</option>
                        <option value="Dalam Negeri" {{ old('lokasi', $item->lokasi) == 'Dalam Negeri' ? 'selected' : '' }}>Dalam Negeri</option>
                        <option value="Luar Negeri" {{ old('lokasi', $item->lokasi) == 'Luar Negeri' ? 'selected' : '' }}>Luar Negeri</option>
                    </select>
                </div>

                <!-- Tempat Studi -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Tempat Studi</label>
                    <input type="text" name="tempat_studi" class="form-control"
                        value="{{ old('tempat_studi', $item->tempat_studi) }}">
                </div>

                <!-- Periode -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Periode Awal</label>
                        <input type="date" name="periode_awal" class="form-control"
                            value="{{ old('periode_awal', $item->periode_awal) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Periode Akhir</label>
                        <input type="date" name="periode_akhir" class="form-control"
                            value="{{ old('periode_akhir', $item->periode_akhir) }}">
                    </div>
                </div>

                <!-- SK Tugas Belajar -->
                <h5 class="mt-3 fw-semibold">Tugas Belajar</h5>
                <div class="row align-items-end">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Upload SK (PDF/JPG/PNG)</label>
                        <input type="file" name="tugas_belajar_sk" class="form-control">
                        @if($item->tugas_belajar_sk_path)
                            <small class="text-success d-block mt-1">File sudah ada: 
                                <a href="{{ Storage::url($item->tugas_belajar_sk_path) }}" target="_blank">Lihat File</a>
                            </small>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor SK</label>
                        <input type="text" name="tugas_belajar_sk_nomor" class="form-control"
                            value="{{ old('tugas_belajar_sk_nomor', $item->tugas_belajar_sk_nomor) }}">
                    </div>
                </div>

                <!-- SK Izin Belajar -->
                <h5 class="mt-3 fw-semibold">Izin Belajar</h5>
                <div class="row align-items-end">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Upload SK (PDF/JPG/PNG)</label>
                        <input type="file" name="izin_belajar" class="form-control">
                        @if($item->izin_belajar_path)
                            <small class="text-success d-block mt-1">File sudah ada: 
                                <a href="{{ Storage::url($item->izin_belajar_path) }}" target="_blank">Lihat File</a>
                            </small>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor SK</label>
                        <input type="text" name="izin_belajar_nomor" class="form-control"
                            value="{{ old('izin_belajar_nomor', $item->izin_belajar_nomor) }}">
                    </div>
                </div>

                <!-- Sumber Biaya -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Sumber Biaya</label>
                    <input type="text" name="sumber_biaya" class="form-control"
                        value="{{ old('sumber_biaya', $item->sumber_biaya) }}">
                </div>

                <!-- Progress -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Progress</label>
                    <input type="text" name="progress" class="form-control"
                        value="{{ old('progress', $item->progress) }}">
                </div>

                <!-- Progress November -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Progress November 2024</label>
                    <input type="text" name="progress_november_2024" class="form-control"
                        value="{{ old('progress_november_2024', $item->progress_november_2024) }}">
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('studi_lanjut.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
