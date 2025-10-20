@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')
<div class="container">
    <h2 class="mb-4">Pengaturan Akun</h2>

    {{-- Ubah Password --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Ubah Password</div>
        <div class="card-body">
            @if(session('success_password'))
                <div class="alert alert-success">{{ session('success_password') }}</div>
            @endif

            <form method="POST" action="{{ route('settings.updatePassword') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Password Lama</label>
                    <input type="password" name="current_password" class="form-control" required>
                    @error('current_password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Password</button>
            </form>
        </div>
    </div>

    {{-- Manajemen Pengguna (Role & Akses) --}}
    @if(auth()->user()->role === 'admin') {{-- Hanya admin bisa lihat --}}
    <div class="card">
        <div class="card-header fw-bold">Manajemen Pengguna</div>
        <div class="card-body">
            @if(session('success_role'))
                <div class="alert alert-success">{{ session('success_role') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\User::all() as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <form method="POST" action="{{ route('settings.updateRole', $user->id) }}" class="d-inline">
                                @csrf
                                <select name="role" class="form-select form-select-sm d-inline w-auto">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
