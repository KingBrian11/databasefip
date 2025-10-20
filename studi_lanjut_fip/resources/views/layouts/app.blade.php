<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Studi Lanjut FIP') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-green: #2ecc71;
            --dark-green: #16a34a;
            --light-bg: #f8f9fa;
            --white: #ffffff;
        }

        body {
            overflow-x: hidden;
            background: var(--light-bg);
            font-family: "Poppins", sans-serif;
            transition: background 0.5s ease;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 230px;
            background: linear-gradient(180deg, var(--primary-green), var(--dark-green));
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.15);
            animation: slideIn 0.7s ease;
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .sidebar h4 {
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .sidebar .nav-link {
            color: #e8f5e9;
            padding: 10px 25px;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff;
            border-left: 3px solid #fff;
            transform: translateX(4px);
        }

        .sidebar hr {
            margin: 20px 0;
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* Topbar */
        .topbar {
            margin-left: 230px;
            height: 65px;
            background: linear-gradient(90deg, #ffffff, #e8f5e9);
            border-bottom: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            animation: fadeDown 0.7s ease;
        }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Content */
        .content {
            margin-left: 230px;
            padding: 25px;
            animation: fadeUp 0.5s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Profile */
        .profile-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid var(--primary-green);
            transition: transform 0.3s ease, box-shadow 0.3s;
        }

        .profile-img:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(46, 204, 113, 0.5);
        }

        /* Notification bell */
        .notif-bell {
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
            color: var(--dark-green);
        }

        .notif-bell:hover {
            transform: rotate(10deg) scale(1.1);
            color: var(--primary-green);
        }

        .notif-bell .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            font-size: 10px;
            border-radius: 50%;
            padding: 3px 6px;
        }

        /* Slide Notification */
        .notif-panel {
            position: fixed;
            top: 0;
            right: 0;
            width: 25%;
            max-width: 380px;
            height: 100%;
            background: #ffffff;
            box-shadow: -2px 0 10px rgba(0,0,0,0.2);
            transform: translateX(100%);
            transition: transform 0.4s ease;
            z-index: 1050;
        }

        .notif-panel.active {
            transform: translateX(0);
        }

        .notif-header {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(90deg, var(--dark-green), var(--primary-green));
            color: #fff;
        }

        .notif-item {
            padding: 12px 18px;
            border-bottom: 1px solid #f1f1f1;
            transition: background 0.3s;
        }

        .notif-item:hover {
            background: rgba(46, 204, 113, 0.1);
        }

        .notif-close {
            cursor: pointer;
            font-size: 22px;
        }

        /* Logout Button */
        .btn-danger {
            background: linear-gradient(90deg, #ff4d6d, #ff758f);
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s;
        }

        .btn-danger:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(255, 117, 143, 0.5);
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar d-flex flex-column">
        <div class="text-center mb-4">
            <h4>FIP UPI</h4>
        </div>

        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
        <a href="{{ route('dosen.index') }}" class="nav-link {{ request()->is('dosen*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Data Dosen FIP
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('tata_usaha.index') }}" class="nav-link {{ request()->is('tata_usaha*') ? 'active' : '' }}">
            <i class="bi bi-person-rolodex"></i></i> Data Staf Tata Usaha
        </a>
    </li>
            <li class="nav-item">
                <a href="{{ route('studi_lanjut.index') }}" class="nav-link {{ request()->is('studi_lanjut*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text me-2"></i> Data Studi Lanjut
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('studi_lanjut.calendar') }}" class="nav-link {{ request()->is('studi_lanjut.calendar*') ? 'active' : '' }}">
                    <i class="bi bi-calendar3 me-2"></i> Kalender
                </a>
            </li>
        </ul>

        <hr class="text-white mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>

    {{-- Topbar --}}
<div class="topbar d-flex justify-content-between align-items-center px-3 py-2 border-bottom bg-white shadow-sm">
    <!-- Kiri: Role + Title -->
    <div class="d-flex align-items-center gap-2">
        <span class="fw-bold text-uppercase fs-5 text-primary">
            {{ auth()->check() ? auth()->user()->role : 'Guest' }}
        </span>
        <span class="text-muted">— @yield('title', 'Dashboard')</span>
    </div>

    <!-- Kanan: Profil & Notifikasi -->
    <div class="d-flex align-items-center gap-3">

        <!-- 👤 Profil (kiri akun) -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none"
               id="profileDropdown" data-bs-toggle="dropdown">
                <img src="{{ auth()->check() && auth()->user()->profile_photo
                            ? asset(auth()->user()->profile_photo)
                            : 'https://via.placeholder.com/32?text=👤' }}"
                     class="rounded-circle border me-2"
                     width="32" height="32"
                     alt="Profile"
                     style="transition: none;">
                <strong>{{ auth()->check() ? auth()->user()->name : 'Guest' }}  <i class="bi bi-caret-down-fill"></i></strong>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                @auth
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Profil</a></li>
                    <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="bi bi-gear me-2"></i> Pengaturan</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                @endauth
                @guest
                    <li><a href="{{ route('login') }}" class="dropdown-item text-success"><i class="bi bi-box-arrow-in-right me-2"></i> Login</a></li>
                @endguest
            </ul>
        </div>



            {{-- Lonceng di kanan --}}
            <div class="notif-bell" id="notifBell">
                <i class="bi bi-bell fs-5"></i>
                @if(isset($notifications) && count($notifications) > 0)
                    <span class="badge">{{ count($notifications) }}</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Konten --}}
    <div class="content">
        @yield('content')
    </div>

    {{-- Slide Notifikasi --}}
    <div class="notif-panel" id="notifPanel">
        <div class="notif-header">
            Notifikasi
            <span class="notif-close" id="notifClose">&times;</span>
        </div>
        @if(isset($notifications) && count($notifications) > 0)
            @foreach($notifications as $notif)
                <div class="notif-item">
                    <i class="bi bi-info-circle text-success"></i> {{ $notif }}
                </div>
            @endforeach
        @else
            <div class="p-3 text-muted">Tidak ada notifikasi</div>
        @endif
    </div>

<!-- POPUP LOGIN / REGISTER -->
@guest
<div id="authPopup" class="popup-overlay">
    
    <!-- LOGIN -->
    <div class="popup-card" id="loginCard">
        

        <button class="close-btn" id="closePopup">&times;</button>
        <h4 class="text-center mb-4"><i class="bi bi-person-circle me-2"></i>Login Akun</h4>

        <!-- Alert global -->
        <div id="alertContainer">
            @if ($errors->any())
                <div class="global-alert alert alert-danger d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="global-alert alert alert-danger d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div class="global-alert alert alert-success d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="bi bi-envelope-at me-2 text-success"></i>Email
                </label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="bi bi-lock-fill me-2 text-success"></i>Password
                </label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Ingat Saya</label>
                </div>
                <a href="#" class="text-success small">Lupa Password?</a>
            </div>

            <button type="submit" class="btn btn-success w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </button>
        </form>

        <div class="text-center mt-3">
            <small>Belum punya akun?
                <a href="#" id="showRegister" class="text-success fw-semibold">Daftar</a>
            </small>
        </div>
    </div>

    <!-- REGISTER -->
    <div class="popup-card d-none" id="registerCard">
        

        <button class="close-btn" id="closeRegister">&times;</button>
        <h4 class="text-center mb-4"><i class="bi bi-pencil-square me-2"></i>Daftar Akun</h4>

        <!-- Alert global -->
        <div id="alertContainerReg">
            @if ($errors->any())
                <div class="global-alert alert alert-danger d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="global-alert alert alert-danger d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div class="global-alert alert alert-success d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="bi bi-person-fill me-2 text-success"></i>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="bi bi-envelope-at me-2 text-success"></i>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="bi bi-lock-fill me-2 text-success"></i>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Buat password" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="bi bi-lock me-2 text-success"></i>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="bi bi-shield-lock me-2 text-success"></i>Kode Unik FIP</label>
                <input type="text" name="unique_code" class="form-control" placeholder="Masukkan kode unik FIP" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold"><i class="bi bi-person-badge me-2 text-success"></i>Role</label>
                <select name="role" class="form-select" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="pegawai">Pegawai</option>
                    <option value="dosen">Dosen</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100">
                <i class="bi bi-person-plus me-2"></i>Daftar
            </button>
        </form>

        <div class="text-center mt-3">
            <small>Sudah punya akun?
                <a href="#" id="showLogin" class="text-success fw-semibold">Masuk</a>
            </small>
        </div>
    </div>
</div>
@endguest



<style>
/* Ukuran login (kecil, pas) */
.global-alert {
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: left;
    font-weight: 500;
}

/* Supaya alert tidak mepet atas card */
.popup-card {
    position: relative;
    padding-top: 20px;
}

/* Biar alert muncul lembut */
.global-alert {
    animation: fadeInDown 0.3s ease;
}

@keyframes fadeInDown {
    from { transform: translateY(-10px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* Overlay popup */
.popup-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    backdrop-filter: blur(8px);
    background-color: rgba(0, 0, 0, 0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2000;
    animation: fadeIn 0.4s ease;
}

/* Card login & register – ukuran sama */
.popup-card {
    width: 550px;
    max-width: 95%;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    padding: 40px 45px;
    position: relative;
    animation: slideUp 0.4s ease;
}

/* Ruang untuk pesan error */
.alert-space {
    min-height: 45px;
    margin-bottom: 10px;
}

/* Form grid register – dua kolom di layar besar */
@media (min-width: 768px) {
    #registerCard form {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px 20px;
    }

    #registerCard form button,
    #registerCard .text-center.mt-3 {
        grid-column: span 2;
    }
}

/* Tombol close popup */
.close-btn {
    position: absolute;
    top: 12px; right: 15px;
    background: none;
    border: none;
    font-size: 24px;
    color: #555;
    transition: color 0.2s;
}
.close-btn:hover { color: #16a34a; }

@keyframes fadeIn { from {opacity:0;} to {opacity:1;} }
@keyframes slideUp { from {transform:translateY(25px);opacity:0;} to {transform:translateY(0);opacity:1;} }

</style>
<script>
// Popup buka/tutup
document.addEventListener('DOMContentLoaded', function () {
    const loginBtn = document.getElementById('showLoginPopup');
    const popup = document.getElementById('authPopup');
    const closePopup = document.getElementById('closePopup');

    if (loginBtn && popup) {
        loginBtn.addEventListener('click', function (e) {
            e.preventDefault();
            popup.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    }

    if (closePopup) {
        closePopup.addEventListener('click', function () {
            popup.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }
});
</script>

<script>
// Logika error dan tampilan form
document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('authPopup');
    const loginCard = document.getElementById('loginCard');
    const registerCard = document.getElementById('registerCard');

    @if ($errors->any())
        const hasRegisterError = {{ session('form_error') === 'register' ? 'true' : 'false' }};
        const hasLoginError = {{ session('form_error') === 'login' ? 'true' : 'false' }};

        if (popup) popup.style.display = 'flex';

        if (hasRegisterError) {
            if (registerCard && loginCard) {
                loginCard.classList.add('d-none');
                registerCard.classList.remove('d-none');
            }
        } else if (hasLoginError) {
            if (registerCard && loginCard) {
                registerCard.classList.add('d-none');
                loginCard.classList.remove('d-none');
            }
        }
    @endif
});
</script>

<script>
// Logika switch login/register
const popup = document.getElementById("authPopup");
const loginCard = document.getElementById("loginCard");
const registerCard = document.getElementById("registerCard");
const showRegister = document.getElementById("showRegister");
const showLogin = document.getElementById("showLogin");
const closePopup = document.getElementById("closePopup");
const closeRegister = document.getElementById("closeRegister");

// Tampil popup saat halaman dibuka
window.addEventListener("load", () => popup.style.display = "flex");

if (closePopup) closePopup.addEventListener("click", () => popup.style.display = "none");
if (closeRegister) closeRegister.addEventListener("click", () => popup.style.display = "none");

if (showRegister) {
    showRegister.addEventListener("click", e => {
        e.preventDefault();
        loginCard.classList.add("d-none");
        registerCard.classList.remove("d-none");
    });
}

if (showLogin) {
    showLogin.addEventListener("click", e => {
        e.preventDefault();
        registerCard.classList.add("d-none");
        loginCard.classList.remove("d-none");
    });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Notifikasi (opsional)
const bell = document.getElementById('notifBell');
const panel = document.getElementById('notifPanel');
const closeBtn = document.getElementById('notifClose');

if (bell && panel && closeBtn) {
    bell.addEventListener('click', () => panel.classList.add('active'));
    closeBtn.addEventListener('click', () => panel.classList.remove('active'));
}
</script>


    
</body>
</html>
