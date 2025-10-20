@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4 text-center">Tambah Data Tata Usaha</h3>

    <div class="card shadow-sm p-4">
        <form action="{{ route('tata_usaha.store') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="mb-3">
                <label for="nama" class="form-label fw-bold">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" 
                       value="{{ old('nama') }}" required placeholder="Masukkan nama">
                @error('nama') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>

            {{-- NIP --}}
            <div class="mb-3">
                <label for="nip" class="form-label fw-bold">NIP</label>
                <input type="text" name="nip" id="nip" class="form-control" 
                       value="{{ old('nip') }}" required placeholder="Masukkan NIP">
                @error('nip') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>

            {{-- Golongan --}}
            <div class="mb-3">
                <label for="golongan" class="form-label fw-bold">Golongan</label>
                <select name="golongan" id="golongan" class="form-select" required>
    <option value="">-- Pilih Golongan --</option>
    <option value="Tidak Ada" {{ old('golongan', $pegawai->golongan ?? '') == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>

    <optgroup label="GOLONGAN IV">
        @foreach ([
            'IV/a' => 'Pembina',
            'IV/b' => 'Pembina Tingkat I',
            'IV/c' => 'Pembina Utama Muda',
            'IV/d' => 'Pembina Utama Madya',
            'IV/e' => 'Pembina Utama'
        ] as $val => $label)
            <option value="{{ $val }}" {{ old('golongan', $pegawai->golongan ?? '') == $val ? 'selected' : '' }}>
                {{ $val }} - {{ $label }}
            </option>
        @endforeach
    </optgroup>

    <optgroup label="GOLONGAN III">
        @foreach ([
            'III/a' => 'Penata Muda',
            'III/b' => 'Penata Muda Tingkat I',
            'III/c' => 'Penata',
            'III/d' => 'Penata Tingkat I'
        ] as $val => $label)
            <option value="{{ $val }}" {{ old('golongan', $pegawai->golongan ?? '') == $val ? 'selected' : '' }}>
                {{ $val }} - {{ $label }}
            </option>
        @endforeach
    </optgroup>

    <optgroup label="GOLONGAN II">
        @foreach ([
            'II/a' => 'Pengatur Muda',
            'II/b' => 'Pengatur Muda Tingkat I',
            'II/c' => 'Pengatur',
            'II/d' => 'Pengatur Tingkat I'
        ] as $val => $label)
            <option value="{{ $val }}" {{ old('golongan', $pegawai->golongan ?? '') == $val ? 'selected' : '' }}>
                {{ $val }} - {{ $label }}
            </option>
        @endforeach
    </optgroup>

    <optgroup label="GOLONGAN I">
        @foreach ([
            'I/a' => 'Juru Muda',
            'I/b' => 'Juru Muda Tingkat I',
            'I/c' => 'Juru',
            'I/d' => 'Juru Tingkat I'
        ] as $val => $label)
            <option value="{{ $val }}" {{ old('golongan', $pegawai->golongan ?? '') == $val ? 'selected' : '' }}>
                {{ $val }} - {{ $label }}
            </option>
        @endforeach
    </optgroup>
</select>

                @error('golongan') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>

            {{-- Bagian / Staf --}}
            <div class="mb-3">
                <label for="staf" class="form-label fw-bold">Bagian / Staf</label>
                <input type="text" name="staf" id="staf" class="form-control"
                       value="{{ old('staf') }}" placeholder="Contoh: Akademik / Kepegawaian / Umum">
                @error('staf') 
                    <div class="text-danger small">{{ $message }}</div> 
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('tata_usaha.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
