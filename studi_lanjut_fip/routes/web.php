<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudiLanjutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TataUsahaController;
use App\Http\Controllers\StafProdiController;
use App\Http\Controllers\StafFipController;

Route::get('/search-dosen', [DosenController::class, 'search'])->name('search-dosen');
Route::get('/search-tata-usaha', [TataUsahaController::class, 'search']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/staf-fip', [StafFipController::class, 'index'])->name('staf_fip.index');
Route::get('/staf-fip/create', [StafFipController::class, 'create'])->name('staf_fip.create');
Route::post('/staf-fip', [StafFipController::class, 'store'])->name('staf_fip.store');
Route::get('/staf-fip/{id}', [StafFipController::class, 'show'])->name('staf_fip.show');
Route::get('/staf-fip/{id}/edit', [StafFipController::class, 'edit'])->name('staf_fip.edit');
Route::put('/staf-fip/{id}', [StafFipController::class, 'update'])->name('staf_fip.update');
Route::delete('/staf-fip/{id}', [StafFipController::class, 'destroy'])->name('staf_fip.destroy');

Route::get('/staf-prodi', [StafProdiController::class, 'index'])->name('staf_prodi.index');
Route::get('/staf-prodi/create', [StafProdiController::class, 'create'])->name('staf_prodi.create');
Route::post('/staf-prodi', [StafProdiController::class, 'store'])->name('staf_prodi.store');
Route::get('/staf-prodi/{id}/edit', [StafProdiController::class, 'edit'])->name('staf_prodi.edit');
Route::put('/staf-prodi/{id}', [StafProdiController::class, 'update'])->name('staf_prodi.update');
Route::delete('/staf-prodi/{id}', [StafProdiController::class, 'destroy'])->name('staf_prodi.destroy');
Route::get('/staf-prodi/{program_studi}', [StafProdiController::class, 'show'])->name('staf_prodi.show');

Route::get('/tata_usaha', [TataUsahaController::class, 'index'])->name('tata_usaha.index');
Route::get('/tata_usaha/create', [TataUsahaController::class, 'create'])->name('tata_usaha.create');
Route::post('/tata_usaha', [TataUsahaController::class, 'store'])->name('tata_usaha.store');
Route::get('/tata_usaha/{id}/edit', [TataUsahaController::class, 'edit'])->name('tata_usaha.edit');
Route::put('/tata_usaha/{id}', [TataUsahaController::class, 'update'])->name('tata_usaha.update');
Route::delete('/tata_usaha/{id}', [TataUsahaController::class, 'destroy'])->name('tata_usaha.destroy');

Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy'); // 🟢 tambahkan ini!
Route::get('/dosen/{jurusan}', [DosenController::class, 'show'])->name('dosen.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});



// Semua route yang butuh login masuk ke middleware auth
Route::middleware(['auth'])->group(function() {

    // Dashboard route menggunakan controller yang mengirim data ke view
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Studi Lanjut
    Route::get('/studi_lanjut', [StudiLanjutController::class, 'index'])->name('studi_lanjut.index');

    // Profil & Pengaturan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/updatePassword', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');
    Route::post('/settings/updateRole/{user}', [SettingsController::class, 'updateRole'])->name('settings.updateRole');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Login & Register route tanpa middleware auth
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Route untuk download file Studi Lanjut
Route::get('studi_lanjut/{id}/download/{type}', [StudiLanjutController::class, 'download'])
    ->name('studi_lanjut.download');

// Redirect halaman utama ke halaman studi lanjut
Route::get('/', function () {
    return redirect('/studi_lanjut');
});

// Resource route untuk Studi Lanjut
Route::resource('studi_lanjut', StudiLanjutController::class);

Route::get('/studi-lanjut/calendar', [StudiLanjutController::class, 'calendar'])->name('studi_lanjut.calendar');

Route::get('/studi-lanjut/{id}/download-surat', [App\Http\Controllers\StudiLanjutController::class, 'downloadSurat'])
    ->name('studi_lanjut.downloadSurat');

    Route::get('/studi-lanjut/jurusan', function () {
    return view('studi_lanjut.jurusan');
})->name('studi_lanjut.jurusan.index');

Route::get('/studi-lanjut/jurusan/{slug}', [App\Http\Controllers\StudiLanjutController::class, 'byJurusan'])
    ->name('studi_lanjut.jurusan');
