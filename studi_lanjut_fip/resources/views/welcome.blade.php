<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FIP Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    * {
      font-family: 'Poppins', sans-serif;
      box-sizing: border-box;
    }
    body {
      margin: 0;
      background: url('/img/bg.jpg') no-repeat center center/cover;
      height: 100vh;
      overflow: hidden;
    }

    /* Navbar */
    nav {
      position: absolute;
      top: 20px;
      right: 40px;
      display: flex;
      gap: 10px;
    }
    nav button {
      background: white;
      border: none;
      padding: 10px 18px;
      border-radius: 20px;
      cursor: pointer;
      transition: 0.3s;
      font-weight: 500;
    }
    nav button:hover {
      background: #007bff;
      color: white;
    }

    /* Overlay blur */
    .overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      backdrop-filter: blur(8px);
      background: rgba(0,0,0,0.3);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 999;
      animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
      from {opacity: 0;} to {opacity: 1;}
    }

    /* Popup form */
    .popup {
      background: white;
      border-radius: 15px;
      padding: 30px;
      width: 380px;
      position: relative;
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
      animation: slideUp 0.3s ease;
    }
    @keyframes slideUp {
      from {transform: translateY(20px); opacity: 0;}
      to {transform: translateY(0); opacity: 1;}
    }

    .popup h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .popup input, .popup select {
      width: 100%;
      margin-bottom: 12px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .popup button {
      width: 100%;
      background: #007bff;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 15px;
    }

    .popup button:hover {
      background: #0056d2;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 22px;
      color: #999;
      cursor: pointer;
    }

    .switch {
      text-align: center;
      margin-top: 10px;
    }

    .switch a {
      color: #007bff;
      text-decoration: none;
    }
    .switch a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav>
    <button onclick="openPopup('login')"><i class="bi bi-box-arrow-in-right"></i> Login</button>
    <button onclick="openPopup('register')"><i class="bi bi-person-plus"></i> Register</button>
  </nav>

  <!-- Overlay Background -->
  <div class="overlay" id="overlay" onclick="closePopup(event)">
    <!-- Login Popup -->
    <div class="popup" id="loginPopup" onclick="event.stopPropagation()">
      <span class="close-btn" onclick="closePopup()">&times;</span>
      <h2>Masuk Akun</h2>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
      </form>
      <div class="switch">
        <p>Belum punya akun? <a href="#" onclick="switchPopup('register')">Daftar</a></p>
      </div>
    </div>

    <!-- Register Popup -->
    <div class="popup" id="registerPopup" onclick="event.stopPropagation()" style="display:none;">
      <span class="close-btn" onclick="closePopup()">&times;</span>
      <h2>Daftar Akun Baru</h2>
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
        <input type="text" name="unique_code" placeholder="Kode Unik" required>
        <select name="role" required>
          <option value="">Pilih Role</option>
          <option value="admin">Admin</option>
          <option value="pegawai">Pegawai</option>
        </select>
        <button type="submit">Register</button>
      </form>
      <div class="switch">
        <p>Sudah punya akun? <a href="#" onclick="switchPopup('login')">Login</a></p>
      </div>
    </div>
  </div>

  <script>
    const overlay = document.getElementById('overlay');
    const loginPopup = document.getElementById('loginPopup');
    const registerPopup = document.getElementById('registerPopup');

    function openPopup(type) {
      overlay.style.display = 'flex';
      if (type === 'login') {
        loginPopup.style.display = 'block';
        registerPopup.style.display = 'none';
      } else {
        loginPopup.style.display = 'none';
        registerPopup.style.display = 'block';
      }
    }

    function closePopup(e) {
      overlay.style.display = 'none';
    }

    function switchPopup(to) {
      if (to === 'register') {
        loginPopup.style.display = 'none';
        registerPopup.style.display = 'block';
      } else {
        loginPopup.style.display = 'block';
        registerPopup.style.display = 'none';
      }
    }
  </script>

</body>
</html>
