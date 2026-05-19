<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<style>
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        background-color: #efefef;
    }

    .btn-profile-action {
        background-color: #efefef;
        border: none;
        font-weight: bold;
        border-radius: 20px;
        padding: 8px 16px;
    }

    .btn-profile-action:hover {
        background-color: #e2e2e2;
    }

    /* Tab Styling */
    .profile-tabs {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .tab-link {
        text-decoration: none;
        color: #111;
        font-weight: bold;
        padding-bottom: 5px;
        border-bottom: 3px solid transparent;
    }

    .tab-link.active {
        border-bottom-color: #111;
    }

    /* Masonry Grid */
    .masonry-grid {
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
        transition: filter 0.3s;
    }

    .masonry-item:hover img {
        filter: brightness(0.8);
    }

    @media (max-width: 1200px) {
        .masonry-grid {
            column-count: 4;
        }
    }

    @media (max-width: 992px) {
        .masonry-grid {
            column-count: 3;
        }
    }

    @media (max-width: 768px) {
        .masonry-grid {
            column-count: 2;
        }
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container py-5">
    <div class="text-center">
        <div class="mb-3">
            <?php if (!empty($user['avatar']) && $user['avatar'] !== 'default.png'): ?>
                <img src="<?= base_url('uploads/profile/' . $user['avatar']) ?>" class="profile-avatar shadow-sm"
                    alt="Foto Profil">
            <?php else: ?>
                <div
                    class="profile-avatar d-inline-flex align-items-center justify-content-center fs-1 fw-bold text-secondary mx-auto">
                    <?= strtoupper(substr($user['username'], 0, 1)) ?>
                </div>
            <?php endif; ?>
        </div>

        <h1 class="fw-bold mb-0"><?= esc($user['display_name']) ?></h1>
        <p class="text-muted mb-2">@<?= esc($user['username']) ?></p>
        <p class="text-muted"><?= esc($user['email']) ?></p>

        <div class="d-flex justify-content-center gap-2 mt-3">
            <!-- <button class="btn btn-profile-action">Bagikan</button> -->
            <?php if (isset($isOwnProfile) && $isOwnProfile): ?>
                <a href="<?= base_url('/profile/edit') ?>"
                    class="btn btn-profile-action text-decoration-none text-dark">Edit profil</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="profile-tabs">
        <a href="#" class="tab-link active" onclick="switchTab('dibuat', event)">Dibuat</a>
        <?php if (isset($isOwnProfile) && $isOwnProfile): ?>
            <a href="#" class="tab-link" onclick="switchTab('disimpan', event)">Disimpan</a>
        <?php endif; ?>

    </div>

    <div class="masonry-grid mt-4">
        <div id="tab-dibuat">
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $p): ?>
                    <div class="masonry-item">

                        <a href="/post/<?= $p['id'] ?>">
                            <?php
                            $fotoUrl = (strpos($p['content_url'], 'http') === 0)
                                ? $p['content_url']
                                : base_url('uploads/photos/' . $p['content_url']);
                            ?>
                            <img src="<?= $fotoUrl ?>">
                        </a>
                        <?php if (isset($isOwnProfile) && $isOwnProfile): ?>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <a href="<?= base_url('post/edit/' . $p['id']) ?>"
                                    class="btn btn-sm btn-secondary rounded-pill px-3">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                                <a href="<?= base_url('post/delete/' . $p['id']) ?>" class="btn btn-sm btn-danger rounded-pill px-3"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus Pin ini secara permanen?')">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center w-100 py-5">
                    <p class="text-muted">Belum ada Pin yang dibuat. <a href="/createpost" class="text-danger fw-bold">Buat
                            satu
                            sekarang!</a></p>
                </div>
            <?php endif; ?>
        </div>
        <div id="tab-disimpan" style="display: none">
            <?php if (!empty($savedPosts)): ?>
                <?php foreach ($savedPosts as $p): ?>
                    <div class="masonry-item">
                        <a href="/post/<?= $p['id'] ?>">
                            <?php $fotoUrl = (strpos($p['content_url'], 'http') === 0) ? $p['content_url'] : base_url('uploads/photos/' . $p['content_url']); ?>
                            <img src="<?= $fotoUrl ?>" alt="Foto Disimpan">
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center w-100 py-5">
                    <p class="text-muted">Belum ada Pin yang disimpan. Ayo cari inspirasi!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    function switchTab(tabName, event) {
        event.preventDefault();

        document.querySelectorAll('.tab-link').forEach(tab => tab.classList.remove('active'));
        event.target.classList.add('active');

        document.getElementById('tab-dibuat').style.display = 'none';
        document.getElementById('tab-disimpan').style.display = 'none';

        if (tabName === 'dibuat') {
            document.getElementById('tab-dibuat').style.display = 'block';
        } else {
            document.getElementById('tab-disimpan').style.display = 'block';
        }
    }
</script>
<?= $this->endSection(); ?>