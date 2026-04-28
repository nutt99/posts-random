<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pin Detail Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
    body {
        background-color: #e9e9e9;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    .btn-interaction {
        background-color: #f1f1f1;
        /* Warna abu-abu muda */
        border: none;
        transition: background-color 0.2s, transform 0.1s;
        color: #111;
    }

    .btn-interaction:hover {
        background-color: #e2e2e2;
    }

    .btn-interaction:active {
        transform: scale(0.92);
        /* Efek mengecil sedikit saat diklik */
    }

    /* Class tambahan saat statusnya sudah di-like */
    .is-liked i {
        color: #E60023 !important;
        /* Warna merah khas Pinterest */
    }

    /* --- STYLING UNTUK MASONRY GRID (KOLOM KANAN ATAS) --- */
    .masonry-grid {
        column-count: 2;
        column-gap: 16px;
    }

    /* --- STYLING UNTUK MASONRY GRID (FULL BAWAH) --- */
    .masonry-grid-full {
        column-count: 4;
        column-gap: 16px;
    }

    .masonry-item {
        break-inside: avoid;
        margin-bottom: 16px;
        border-radius: 16px;
        /* Disamakan dengan PHP-mu di bawah pakai 25px juga boleh */
        overflow: hidden;
        position: relative;
    }

    .masonry-item img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 25px;
        /* Mengikuti style-mu */
    }

    .btn-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background-color: transparent;
        transition: background-color 0.2s;
    }

    .btn-circle:hover {
        background-color: rgba(0, 0, 0, 0.06);
    }

    .pin-card-shadow {
        box-shadow: 0 1px 20px 0 rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 992px) {
        .masonry-grid-full {
            column-count: 3;
        }
    }

    @media (max-width: 768px) {
        .masonry-grid-full {
            column-count: 2;
        }
    }

    @media (max-width: 576px) {
        .masonry-grid-full {
            column-count: 2;
        }
    }
    </style>
</head>

<body>

    <div class="container-fluid px-4 mt-4" style="max-width: 1400px;">

        <div class="mb-3">
            <button class="btn btn-circle"><i class="fas fa-arrow-left fa-lg"></i></button>
        </div>

        <div class="row mb-5">

            <div class="col-lg-6 mb-4 sticky-top " style="top: 20px; z-index: 4; align-self: flex-start;">
                <div class="card pin-card-shadow border-0 p-3" style="border-radius: 32px;">
                    <div class="mt-4 px-2 d-flex justify-content-between align-items-center">

                        <div class="d-flex gap-2">

                            <button class="btn btn-interaction rounded-pill fw-bold px-3 py-2 d-flex align-items-center"
                                id="likeBtn" onclick="toggleLike()">
                                <i class="fas fa-heart text-secondary me-2 fs-5" id="likeIcon"
                                    style="transition: color 0.3s;"></i>
                                <span id="likeCount">424</span>
                            </button>

                            <button
                                class="btn btn-interaction rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 44px; height: 44px;">
                                <i class="fas fa-thumbs-down text-secondary fs-5"></i>
                            </button>

                            <button
                                class="btn btn-interaction rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 44px; height: 44px;">
                                <i class="fas fa-comment text-secondary fs-5"></i>
                            </button>

                        </div>

                        <button
                            class="btn btn-interaction rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 44px; height: 44px;">
                            <i class="fas fa-share text-secondary fs-5"></i>
                        </button>

                    </div>
                    <img src="https://picsum.photos/600/800" class="img-fluid w-100" style="border-radius: 24px;"
                        alt="Gambar Utama">
                    <div class="mt-3 text-center text-muted">
                        Ini adalah area postingan utama.
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="masonry-grid">
                    <?php for($i=1; $i<=10; $i++): ?>
                    <div class="masonry-item">
                        <img src="https://picsum.photos/400/<?= rand(300, 600) ?>" class="img-fluid border"
                            style="border-radius: 25px">
                    </div>
                    <?php endfor; ?>
                    <div class="masonry-item"><img src="https://picsum.photos/400/500" alt="Related"></div>
                    <div class="masonry-item"><img src="https://picsum.photos/400/300" alt="Related"></div>
                    <div class="masonry-item"><img src="https://picsum.photos/400/400" alt="Related"></div>
                </div>
            </div>

        </div>

        <h5 class="text-center fw-bold mb-4">Lebih banyak seperti ini</h5>
        <div class="masonry-grid-full">

            <?php for($i=1; $i<=10; $i++): ?>
            <div class="masonry-item">
                <img src="https://picsum.photos/400/<?= rand(300, 600) ?>" class="img-fluid border"
                    style="border-radius: 25px">
            </div>
            <?php endfor; ?>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function toggleLike() {
        const likeBtn = document.getElementById('likeBtn');
        const likeIcon = document.getElementById('likeIcon');
        const likeCount = document.getElementById('likeCount');

        let currentLikes = parseInt(likeCount.innerText);

        // Jika tombol sudah punya class 'is-liked' (berarti mau di-unlike)
        if (likeBtn.classList.contains('is-liked')) {
            likeBtn.classList.remove('is-liked');
            likeIcon.classList.replace('text-danger', 'text-secondary');
            likeCount.innerText = currentLikes - 1;
        }
        // Jika belum dilike
        else {
            likeBtn.classList.add('is-liked');
            likeIcon.classList.replace('text-secondary', 'text-danger');
            likeCount.innerText = currentLikes + 1;
        }
    }
    </script>
</body>

</html>