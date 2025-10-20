<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dosen; // ✅ pakai model Dosen
use App\Models\TataUsaha; // ✅ pakai model TataUsaha
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Config;

class RegisterController extends Controller
{
    // Tampilkan form register
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        // Validasi input dasar
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'unique_code' => 'required|string',
            'role' => 'required|in:admin,pegawai,dosen',
        ]);

        // 🔐 Cek kode unik
        $codes = Config::get('fipcodes.codes', []);
        if (!in_array($validated['unique_code'], $codes)) {
            throw ValidationException::withMessages([
                'unique_code' => 'Kode unik salah. Hanya orang FIP yang tahu kode ini.'
            ]);
        }

        // 🧹 Bersihkan nama input dari gelar akademik
        $namaInput = strtolower($validated['name']);
        $namaInput = preg_replace([
            '/prof\.?/i', '/dr\.?/i', '/ma/i', '/m\.pd/i', '/s\.pd/i', '/,/', '/\./'
        ], '', $namaInput);
        $namaInput = trim(preg_replace('/\s+/', ' ', $namaInput));

        // 🔎 Cek apakah nama terdaftar
        $isValid = false;

        if ($validated['role'] === 'dosen') {
            $isValid = Dosen::whereRaw('LOWER(REPLACE(nama, ".", "")) LIKE ?', ["%$namaInput%"])->exists();
        } elseif ($validated['role'] === 'pegawai') {
            $isValid = TataUsaha::whereRaw('LOWER(REPLACE(nama, ".", "")) LIKE ?', ["%$namaInput%"])->exists();
        } else {
            $isValid = true;
        }

        if (!$isValid) {
            throw ValidationException::withMessages([
                'name' => 'Nama tidak ditemukan dalam data resmi FIP. Pastikan penulisan benar.'
            ]);
        }

        // 🧩 Buat user baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        // 🔑 Login otomatis
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
