@extends('layouts.app')
@section('title', 'Data Studi Lanjut / Input Data')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold">Tambah Data Studi Lanjut</h2>

    @if($errors->any())
      <div class="alert alert-danger">
          <ul class="mb-0">
          @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
          </ul>
      </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-body p-4">
            <form action="{{ route('studi_lanjut.store') }}" method="POST">
                @csrf

                <!-- 🔹 Pilih Pegawai -->
                <div class="mb-3 position-relative">
                    <label class="form-label fw-bold">Nama Pegawai</label>
                    <div class="input-group">
                        <select id="kategori" class="form-select" style="max-width: 150px;">
                            <option value="dosen">Dosen</option>
                            <option value="tata_usaha">Tata Usaha</option>
                        </select>
                        <input type="text" id="nama_pegawai" name="nama" class="form-control" placeholder="Ketik nama..." autocomplete="off" required>
                    </div>
                    <div id="listPegawai" class="list-group position-absolute w-100 shadow-sm" 
                         style="z-index: 1050; max-height: 250px; overflow-y: auto;"></div>
                </div>

                <!-- NIP -->
                <div class="mb-3">
                    <label class="form-label fw-bold">NIP</label>
                    <input type="text" id="nip" name="nip" class="form-control" readonly>
                </div>

                <!-- Golongan -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Golongan</label>
                    <input type="text" id="golongan" name="golongan" class="form-control" readonly>
                </div>

                <!-- Unit Kerja / Staf -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Unit Kerja / Staf</label>
                    <input type="text" id="unit_kerja" name="unit_kerja" class="form-control" readonly>
                </div>

                <!-- Jenis Studi -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Jenis Studi</label>
                    <input type="text" name="jenis_studi" class="form-control" value="{{ old('jenis_studi') }}" placeholder="Contoh: Izin Belajar / Tugas Belajar">
                </div>

                <!-- Jenjang -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Jenjang</label>
                    <select name="jenjang" class="form-select">
                        <option value="">-- Pilih Jenjang --</option>
                        <option value="S1" {{ old('jenjang') == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ old('jenjang') == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ old('jenjang') == 'S3' ? 'selected' : '' }}>S3</option>
                    </select>
                </div>

                <!-- Status Studi -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Status Studi</label>
                    <select name="status_studi" class="form-select">
                        <option value="">-- Pilih Status --</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Lulus">Lulus</option>
                        <option value="Cuti">Cuti</option>
                    </select>
                </div>

                <!-- Lokasi -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Lokasi</label>
                    <select name="lokasi" class="form-select">
                        <option value="">-- Pilih Lokasi --</option>
                        <option value="Dalam Negeri">Dalam Negeri</option>
                        <option value="Luar Negeri">Luar Negeri</option>
                    </select>
                </div>

                <!-- Tempat Studi -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Tempat Studi</label>
                    <input type="text" name="tempat_studi" class="form-control" value="{{ old('tempat_studi') }}">
                </div>

                <!-- Bidang Studi -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Bidang Studi</label>
                    <input type="text" name="bidang_studi" id="bidang_studi" class="form-control" placeholder="Contoh: Pendidikan Matematika, Teknik Mesin, dll">
                </div>

                <!-- Periode -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Periode Awal</label>
                        <input type="date" name="periode_awal" class="form-control" value="{{ old('periode_awal') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Periode Akhir</label>
                        <input type="date" name="periode_akhir" class="form-control" value="{{ old('periode_akhir') }}">
                    </div>
                </div>

                <!-- Tugas Belajar -->
                <h5 class="mt-3 fw-semibold">Tugas Belajar</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Ada SK?</label>
                        <select name="tugas_belajar_sk_exist" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="1">Ada</option>
                            <option value="0">Tidak Ada</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor SK</label>
                        <input type="text" name="tugas_belajar_sk_nomor" class="form-control" value="{{ old('tugas_belajar_sk_nomor') }}">
                    </div>
                </div>

                <!-- Izin Belajar -->
                <h5 class="mt-3 fw-semibold">Izin Belajar</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Ada SK?</label>
                        <select name="izin_belajar_exist" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="1">Ada</option>
                            <option value="0">Tidak Ada</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nomor SK</label>
                        <input type="text" name="izin_belajar_nomor" class="form-control" value="{{ old('izin_belajar_nomor') }}">
                    </div>
                </div>

                <!-- Sumber Biaya -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Sumber Biaya</label>
                    <input type="text" name="sumber_biaya" class="form-control" value="{{ old('sumber_biaya') }}">
                </div>

                <!-- Progress -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Progress</label>
                    <input type="text" name="progress" class="form-control" value="{{ old('progress') }}">
                </div>

                <!-- Progress November -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Progress November 2024</label>
                    <input type="text" name="progress_november_2024" class="form-control" value="{{ old('progress_november_2024') }}">
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('studi_lanjut.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="bi bi-save"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- 🔍 Script Pencarian Ganda --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaInput = document.getElementById('nama_pegawai');
    const kategoriSelect = document.getElementById('kategori');
    const list = document.getElementById('listPegawai');

    let lastKategori = kategoriSelect.value; // simpan kategori terakhir

    // 🔄 Reset jika kategori diubah
    kategoriSelect.addEventListener('change', () => {
        namaInput.value = "";
        document.getElementById('nip').value = "";
        document.getElementById('golongan').value = "";
        document.getElementById('unit_kerja').value = "";
        list.innerHTML = "";
        lastKategori = kategoriSelect.value;
    });

    // 🔍 Event input untuk pencarian
    namaInput.addEventListener('input', async function(e) {
        const query = e.target.value.trim();
        const kategori = kategoriSelect.value;
        list.innerHTML = '';

        if (query.length < 2) return; // minimal 2 huruf baru cari

        // 🔗 Endpoint berdasarkan kategori
        const endpoint = kategori === 'dosen'
            ? `/search-dosen?query=${encodeURIComponent(query)}`
            : `/search-tata-usaha?query=${encodeURIComponent(query)}`;

        try {
            const response = await fetch(endpoint);
            if (!response.ok) throw new Error(`HTTP ${response.status}`);

            const data = await response.json();

            if (data.length === 0) {
                list.innerHTML = `<div class="list-group-item text-muted">Data ${kategori.replace('_',' ')} tidak ditemukan</div>`;
                return;
            }

            data.forEach(item => {
                const option = document.createElement('div');
                option.className = 'list-group-item list-group-item-action';
                option.textContent = `${item.nama} (${item.nip || '-'})`;

                option.onclick = () => {
                    namaInput.value = item.nama;
                    document.getElementById('nip').value = item.nip || '';
                    document.getElementById('golongan').value = item.golongan || '';
                    document.getElementById('unit_kerja').value = item.staf || item.jurusan || '';
                    list.innerHTML = '';
                };

                list.appendChild(option);
            });
        } catch (err) {
            console.error("Terjadi kesalahan saat fetch:", err);
        }
    });
});
</script>

@endsection
