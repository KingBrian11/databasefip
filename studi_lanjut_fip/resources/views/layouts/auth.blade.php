<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name', 'Studi Lanjut FIP') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            height: 100vh;
            overflow: hidden;
            background-color: #f5f5f5;
        }

        .blur-bg {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-size: cover;
            background-position: center;
            filter: blur(10px) brightness(0.7);
            z-index: -1;
            transition: all 0.3s ease;
        }

        .auth-box {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            backdrop-filter: blur(8px);
        }

        .btn-success {
            background: linear-gradient(90deg, #16a34a, #2ecc71);
            border: none;
        }
    </style>
</head>
<body>
    <div id="blurBg" class="blur-bg"></div>

    <div class="d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="auth-box">
            @yield('content')
        </div>
    </div>

    <script>
        // Coba ambil background terakhir
        const lastBg = localStorage.getItem('lastBackground');
        if (lastBg) {
            document.getElementById('blurBg').style.backgroundImage = `url(${lastBg})`;
        } else {
            // fallback jika belum ada
            document.getElementById('blurBg').style.backgroundImage = "url('https://images.unsplash.com/photo-1522075469751-3a6694fb2f61')";
        }
    </script>
</body>
</html>
