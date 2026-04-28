<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color: #ffffff; /* Pinterest dominan putih untuk halaman profil */
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        /* --- STYLING FOTO PROFIL --- */
        .profile-avatar {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* --- STYLING TOMBOL --- */
        .btn-profile-action {
            background-color: #e9e9e9;
            color: #111;
            border: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 24px; /* Bentuk kapsul */
            transition: background-color 0.2s;
        }

        .btn-profile-action:hover {
            background-color: #d1d1d1;
        }

        /* --- STYLING TAB NAVIGASI --- */
        .profile-tabs {
            margin-top: 30px;
            margin-bottom: 20px;
        }
        
        .tab-item {
            text-decoration: none;
            color: #111;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .tab-item:hover {
            background-color: #e9e9e9;
        }

        .tab-item.active {
            border-bottom: 3px solid #111;
            border-radius: 0; /* Menghilangkan radius agar garis bawahnya rata */
        }

        /* --- STYLING MASONRY GRID --- */
        .masonry-grid-full {
            column-count: 5; /* Default 5 kolom untuk profil */
            column-gap: 16px;
            padding: 0 20px;
        }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 16px;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        .masonry-item img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 16px;
            transition: filter 0.2s;
        }

        .masonry-item:hover img {
            filter: brightness(0.85); /* Gambar sedikit gelap saat di-hover */
        }

        /* Responsif untuk Grid Masonry */
        @media (max-width: 1200px) { .masonry-grid-full { column-count: 4; } }
        @media (max-width: 992px) { .masonry-grid-full { column-count: 3; } }
        @media (max-width: 768px) { .masonry-grid-full { column-count: 2; } }
        @media (max-width: 576px) { .masonry-grid-full { column-count: 2; padding: 0 10px; } }
    </style>
</head>

<body>

    <div class="container-fluid mt-5 mb-5">
        
        <div class="d-flex flex-column align-items-center text-center">
            
            <img src="https://picsum.photos/200/200" alt="Foto Profil" class="profile-avatar mb-3">
            
            <h1 class="fw-bold mb-1">Nama Pengguna</h1>
            <p class="text-muted mb-2">@username_kamu</p>
            
            <p class="mb-2" style="max-width: 400px;">
                Mendesain UI/UX, menulis kode, dan suka mencari inspirasi gambar anime & ilustrasi. 🎨✨
            </p>

            <!-- optional, tambahkan kalau sempat aja -->
            <!-- <div class="mb-4 fw-bold">
                <span class="me-3">1.2k <span class="text-muted fw-normal">Pengikut</span></span>
                <span>45 <span class="text-muted fw-normal">Mengikuti</span></span>
            </div> -->

            <div class="d-flex gap-2">
                <button class="btn btn-profile-action">Bagikan</button>
                <button class="btn btn-profile-action">Edit Profil</button>
            </div>

        </div>

        <div class="profile-tabs d-flex justify-content-center gap-4">
            <a href="#" class="tab-item">Dibuat</a>
            <a href="#" class="tab-item active">Disimpan</a>
        </div>

        <div class="masonry-grid-full mt-4">
            
            <?php for($i=1; $i<=15; $i++): ?>
            <div class="masonry-item">
                <img src="https://picsum.photos/400/<?= rand(400, 700) ?>" alt="Pin Tersimpan">
            </div>
            <?php endfor; ?>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>