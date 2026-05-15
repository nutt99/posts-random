<?= $this->extend('layout/template'); ?>
<?= $this->section('styles'); ?>
<style>
    body {
        background-color: #e9e9e9;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    .btn-interaction {
        background-color: #f1f1f1;
        border: none;
        transition: background-color 0.2s, transform 0.1s;
        color: #111;
    }

    .btn-interaction:hover {
        background-color: #e2e2e2;
    }

    .btn-interaction:active {
        transform: scale(0.92);
    }

    .is-liked i {
        color: #E60023 !important;
    }

    .masonry-grid {
        column-count: 2;
        column-gap: 16px;
    }

    .masonry-grid-full {
        column-count: 4;
        column-gap: 16px;
    }

    .masonry-item {
        break-inside: avoid;
        margin-bottom: 16px;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
    }

    .masonry-item img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 25px;
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

    .komentar-container::-webkit-scrollbar {
        width: 6px;
    }

    .komentar-container::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 10px;
    }

    .left-sticky-container {
        max-height: calc(100vh - 40px);
        overflow-y: auto;
        scrollbar-width: none;
    }

    .left-sticky-container::-webkit-scrollbar {
        display: none;
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
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4 mt-4" style="max-width: 1400px;">

    <div class="mb-3">
        <button class="btn btn-circle" onclick="history.back()"><i class="fas fa-arrow-left fa-lg"></i></button>
    </div>

    <div class="row mb-5">
        <div class="col-lg-6 mb-4 sticky-lg-top left-sticky-container"
            style="top: 20px; z-index: 4; align-self: flex-start;">
            <div class="card pin-card-shadow border-0 p-3" style="border-radius: 32px;">

                <div class="mt-4 px-2 d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2">

                        <button
                            class="btn btn-interaction rounded-pill fw-bold px-3 py-2 d-flex align-items-center <?= $sudahLike ? 'is-liked' : '' ?>"
                            id="likeBtn" data-post="<?= $post['id'] ?>">
                            <i class="fas fa-heart <?= $sudahLike ? 'text-danger' : 'text-secondary' ?> me-2 fs-5"
                                id="likeIcon" style="transition: color 0.3s;"></i>
                            <span id="likeCount"><?= $jumlahLike ?></span>
                        </button>

                        <button
                            class="btn btn-interaction rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 44px; height: 44px;">
                            <i class="fas fa-thumbs-down text-secondary fs-5"></i>
                        </button>
                        <button
                            class="btn btn-interaction rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 44px; height: 44px;"
                            onclick="document.getElementById('inputKomentar').focus();">
                            <i class="fas fa-comment text-secondary fs-5"></i>
                        </button>
                    </div>

                    <button class="btn btn-interaction rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 44px; height: 44px;">
                        <i class="fas fa-share text-secondary fs-5"></i>
                    </button>
                </div>

                <?php
                $fotoUrl = (strpos($post['content_url'], 'http') === 0)
                    ? $post['content_url']
                    : base_url('uploads/photos/' . $post['content_url']);
                ?>
                <img src="<?= $fotoUrl ?>" class="img-fluid mt-3"
                    style="border-radius: 30px; width: 100%; max-height: 65vh; object-fit: cover;" alt="">

                <div class="mt-3 text-muted px-2">
                    <h1 class="fw-bold"><?= esc($post['title']) ?></h1>
                    <p class="mt-3"><?= esc($post['description']) ?></p>
                </div>

                <div class="d-flex align-items-center mt-2 px-2">
                    <img src="<?= base_url('uploads/profile/' . ($post['profile_photo'] ?? 'default.png')) ?>"
                        class="rounded-circle me-2" style="width: 45px; height: 45px; object-fit: cover;">
                    <div>
                        <span class="fw-bold d-block"><?= esc($post['username'] ?? 'User') ?></span>
                        <small class="text-muted">Pembuat Pin</small>
                    </div>
                </div>

                <hr class="mt-4 mb-3">
                <div class="px-2">
                    <h5 class="fw-bold fs-6 mb-3">Komentar</h5>

                    <div id="wadahKomentar" class="komentar-container mb-3"
                        style="max-height: 200px; overflow-y: auto;">
                        <?php if (!empty($komentar)): ?>
                            <?php foreach ($komentar as $k): ?>
                                <div class="d-flex align-items-start mb-2">
                                    <strong class="me-2"><?= esc($k['username']) ?>:</strong>
                                    <span class="text-break"><?= esc($k['comments_text']) ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted small" id="noKomentar">Belum ada komentar. Jadilah yang pertama!</p>
                        <?php endif; ?>
                    </div>

                    <form id="formKomentar" class="d-flex gap-2">
                        <input type="hidden" id="id_post_komentar" value="<?= $post['id'] ?>">
                        <input type="text" id="inputKomentar" class="form-control rounded-pill bg-light border-0"
                            placeholder="Tambahkan komentar..." required>
                        <button type="submit" class="btn btn-danger rounded-pill px-3"><i
                                class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <h5 class="fw-bold mb-4 ps-2">Lebih banyak seperti ini</h5>
            <div class="masonry-grid">
                <?php if (!empty($relatedPosts)): ?>
                    <?php
                    // Langsung looping semua data tanpa array_slice
                    foreach ($relatedPosts as $rp):
                        $urlGambar = (strpos($rp['content_url'], 'http') === 0)
                            ? $rp['content_url']
                            : base_url('uploads/photos/' . $rp['content_url']);
                        ?>
                        <div class="masonry-item">
                            <a href="<?= base_url('post/' . $rp['id']) ?>">
                                <img src="<?= $urlGambar ?>" class="img-fluid border" style="border-radius: 25px">
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Tidak ada postingan terkait lainnya.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>



</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    // --- LOGIKA LIKE MENGGUNAKAN AJAX ---
    const likeBtn = document.getElementById('likeBtn');

    likeBtn.addEventListener('click', function () {
        let id_post = this.getAttribute('data-post');
        let formData = new FormData();
        formData.append('id_post', id_post);

        // Panggil route toggleLike
        fetch('/like/toggle', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    alert(data.message); // Jika belum login
                    window.location.href = '/login';
                } else if (data.status === 'success') {
                    // Update jumlah like
                    document.getElementById('likeCount').innerText = data.total;
                    const likeIcon = document.getElementById('likeIcon');

                    // Ubah tampilan UI tombol
                    if (data.action === 'liked') {
                        likeBtn.classList.add('is-liked');
                        likeIcon.classList.replace('text-secondary', 'text-danger');
                    } else {
                        likeBtn.classList.remove('is-liked');
                        likeIcon.classList.replace('text-danger', 'text-secondary');
                    }
                }
            }).catch(error => console.error('Error:', error));
    });

    // --- LOGIKA KOMENTAR MENGGUNAKAN AJAX ---
    const formKomentar = document.getElementById('formKomentar');

    formKomentar.addEventListener('submit', function (e) {
        e.preventDefault(); // Mencegah halaman refresh

        let id_post = document.getElementById('id_post_komentar').value;
        let isiKomentar = document.getElementById('inputKomentar').value;

        let formData = new FormData();
        formData.append('id_post', id_post);
        formData.append('komentar', isiKomentar);

        fetch('/comment/add', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    alert(data.message);
                    window.location.href = '/login';
                } else if (data.status === 'success') {
                    // Hapus tulisan "Belum ada komentar" jika ada
                    let noKomentar = document.getElementById('noKomentar');
                    if (noKomentar) noKomentar.remove();

                    // Buat elemen komentar baru
                    let komentarBaru = `
                    <div class="d-flex align-items-start mb-2">
                        <strong class="me-2">${data.username}:</strong> 
                        <span>${data.text}</span>
                    </div>
                `;

                    // Tambahkan komentar baru ke paling bawah daftar
                    document.getElementById('wadahKomentar').insertAdjacentHTML('beforeend', komentarBaru);

                    // Scroll otomatis ke komentar paling bawah
                    let wadah = document.getElementById('wadahKomentar');
                    wadah.scrollTop = wadah.scrollHeight;

                    // Kosongkan inputan
                    document.getElementById('inputKomentar').value = '';
                }
            }).catch(error => console.error('Error:', error));
    });
</script>
<?= $this->endSection(); ?>