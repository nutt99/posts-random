<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerbang Masuk</title>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Lora:ital,wght@0,400;1,400&display=swap"
        rel="stylesheet">

    <link href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css" />
    <style>
    /* Mengatur agar konten berada tepat di tengah layar */
    body {
        /* Gambar latar pemandangan fantasi gelap agar glassmorphism menonjol */
        /* background: url('https://images.unsplash.com/photo-1518709268805-4e9042af9f23?q=80&w=1920&auto=format&fit=crop') no-repeat center center fixed; */
        background-size: cover;
        font-family: 'Lora', serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        background-color: gray;
    }

    h3 {
        font-family: 'Cinzel', serif;
        color: #fff;
        letter-spacing: 2px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
    }

    /* Modifikasi sedikit pada glass-card agar teks lebih kontras */
    .glass-card {
        background: rgba(18, 38, 41, 0.5);
        /* Warna dasar dipergelap sedikit */
        border-radius: 16px;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(212, 175, 55, 0.3);
        /* Border diberi aksen emas tipis */
        width: 100%;
        max-width: 420px;
        color: #f8f9fa;
    }

    /* Styling input field agar menyatu dengan tema */
    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.2);
        border-color: #d4af37;
        /* Outline emas saat diklik */
        color: #fff;
        box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    /* Styling tombol bergaya logam mulia */
    .btn-custom {
        background: linear-gradient(135deg, #d4af37 0%, #aa7c11 100%);
        border: none;
        color: #1a1a1a;
        font-weight: bold;
        font-family: 'Cinzel', serif;
        letter-spacing: 1px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
        color: #000;
    }
    </style>
</head>

<body>

    <div class="glass-card p-5 mx-3">
        <div class="text-center mb-4">
            <!-- <i class="fas fa-chess-rook fa-3x mb-3" style="color: #d4af37;"></i> -->
            <!-- <h3>Gerbang Masuk</h3> -->
            <p class="text-white-50">Silahkan Masuk terlebih dahulu</p>
        </div>

        <form action="<?= base_url('auth/proses_login') ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label"><i class="fas fa-user me-2"></i>Nama Pengguna</label>
                <input type="text" class="form-control rounded-pill px-4 py-2" id="username" name="username"
                    placeholder="Masukkan nama..." required>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label"><i class="fas fa-key me-2"></i>Kata Sandi</label>
                <input type="password" class="form-control rounded-pill px-4 py-2" id="password" name="password"
                    placeholder="Masukkan sandi..." required>
            </div>

            <!-- <div class="d-flex justify-content-between align-items-center mb-4 small">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label text-white-50" for="remember">Ingat Saya</label>
                </div>
                <a href="#" class="text-decoration-none" style="color: #d4af37;">Lupa Sandi?</a>
            </div> -->

            <button type="submit" class="btn btn-custom w-100 rounded-pill py-2 mt-2">MASUK</button>
            <div class="container d-flex justify-content-center">
                <a class="text-center text-decoration-none text-white" href="#">Belum punya akun? Registrasi dahulu</a>
            </div>
        </form>
    </div>

</body>

</html>