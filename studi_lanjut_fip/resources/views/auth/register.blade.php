<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | FIP</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: url('/img/bg.jpg') no-repeat center center/cover;
            backdrop-filter: blur(0px);
            height: 100vh;
            margin: 0;
        }

        /* Blur background saat popup aktif */
        .blurred {
            filter: blur(8px);
            pointer-events: none;
            user-select: none;
        }

        /* Popup */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 400px;
            padding: 30px;
            z-index: 1000;
            animation: popIn 0.3s ease;
        }

        @keyframes popIn {
            from { opacity: 0; transform: translate(-50%, -40%) scale(0.9); }
            to { opacity: 1; transform: translate(-50%, -50%) scale(1); }
        }

        .popup h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .popup form {
            display: flex;
            flex-direction: column;
        }

        .popup input, .popup select {
            margin-bottom: 15px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        .popup button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.2s;
        }

        .popup button:hover {
            background-color: #0056d2;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 22px;
            color: #999;
            cursor: pointer;
            transition: 0.2s;
        }
        .close-btn:hover {
            color: #333;
        }

        .popup p {
            text-align: center;
            font-size: 14px;
        }

        .popup a {
            color: #007bff;
            text-decoration: none;
        }
        .popup a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div id="main-content" class="blurred"></div>

    <div class="popup" id="registerPopup">
        <span class="close-btn" onclick="window.location.href='/'">&times;</span>
        <h2>Daftar Akun</h2>
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

            <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
        </form>
    </div>
</body>
</html>
