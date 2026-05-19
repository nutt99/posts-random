<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<style>
    body {
        background-color: #ffffff;
        /* Beranda Pinterest identik dengan latar putih */
    }

    .masonry-grid-full {
        column-count: 5;
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
        display: block;
        border-radius: 16px;
        transition: filter 0.2s;
    }

    .masonry-item:hover img {
        filter: brightness(0.85);
        /* Efek gelap sedikit saat di-hover */
    }

    /* Responsif untuk berbagai ukuran layar */
    @media (max-width: 1200px) {
        .masonry-grid-full {
            column-count: 4;
        }
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
            column-gap: 10px;
        }
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid px-4 mt-4" style="max-width: 1600px;">

    <?php if (isset($keyword) && $keyword != ''): ?>
        <div class="mb-4 text-center">
            <h4 class="fw-bold">Hasil pencarian untuk "<?= esc($keyword) ?>"</h4>
            <p class="text-muted mb-0">Ditemukan <?= count($posts) ?> Pin</p>
        </div>
    <?php endif; ?>

    <div class="masonry-grid-full" id="masonry-container">
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $p):
                // Deteksi URL gambar (Internet atau Lokal)
                $urlGambar = (strpos($p['content_url'], 'http') === 0)
                    ? $p['content_url']
                    : base_url('uploads/photos/' . $p['content_url']);
                ?>
                <div class="masonry-item">
                    <a href="<?= base_url('post/' . $p['id']) ?>">
                        <img src="<?= $urlGambar ?>" class="img-fluid border" alt="<?= esc($p['title']) ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div id="loading-spinner" class="text-center py-4" style="display: none;">
        <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Memuat...</span>
        </div>
    </div>

    <?php if (empty($posts)): ?>
        <div class="text-center w-100 py-5 mt-5">
            <h4 class="fw-bold mb-3">Tidak ada Pin yang ditemukan</h4>
            <p class="text-muted">Coba gunakan kata kunci lain (contoh: "Makanan", "Otomotif", atau "Desain").</p>
            <a href="/" class="btn btn-danger rounded-pill fw-bold mt-2 px-4 py-2">Kembali ke Beranda</a>
        </div>
    <?php endif; ?>

</div>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    let currentPage = 1;
    let isLoading = false;
    let hasMoreData = true;

    window.addEventListener('scroll', () => {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 300) {
            if (!isLoading && hasMoreData) {
                loadMorePosts();
            }
        }
    });

    function loadMorePosts() {
        isLoading = true;
        document.getElementById('loading-spinner').style.display = 'block';

        currentPage++;

        const urlParams = new URLSearchParams(window.location.search);
        const keyword = urlParams.get('q') || '';

        const fetchUrl = `/load-more?page=${currentPage}&q=${encodeURIComponent(keyword)}`;

        fetch(fetchUrl)
            .then(response => {
                if (!response.ok) throw new Error('Jaringan bermasalah');
                return response.json();
            })
            .then(data => {
                document.getElementById('loading-spinner').style.display = 'none';

                if (data.html !== '') {
                    document.getElementById('masonry-container').insertAdjacentHTML('beforeend', data.html);
                }

                if (!data.hasMore) {
                    hasMoreData = false;
                }

                isLoading = false;
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
                isLoading = false;
                document.getElementById('loading-spinner').style.display = 'none';
            });
    }
</script>
<?= $this->endSection(); ?>