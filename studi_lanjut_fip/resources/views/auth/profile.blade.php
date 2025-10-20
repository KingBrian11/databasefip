@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="container">
    <h2 class="mb-4">Profil Saya</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header fw-bold">Edit Profil</div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf

                {{-- Foto Profil --}}
                <div class="mb-3 text-center">
                    <img id="preview" src="{{ $user->profile_photo ?? 'https://via.placeholder.com/120' }}" class="profile-img-lg mb-2" alt="Profile">
                    <div>
                        <label class="form-label btn btn-sm btn-secondary mt-2">
                            Ubah Foto
                            <input type="file" name="profile_photo" class="form-control d-none" onchange="previewImage(event)">
                        </label>
                        @error('profile_photo')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">Email (tidak bisa diubah)</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                </div>

                {{-- Role --}}
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <input type="text" class="form-control" value="{{ $user->role }}" disabled>
                </div>

                {{-- Password Baru --}}
                <div class="mb-3">
                    <label class="form-label">Kata Sandi Baru</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                    @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi kata sandi baru">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

{{-- Preview Foto --}}
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
