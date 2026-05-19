<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="fw-bold mb-4">Profil publik</h3>
            <p class="text-muted mb-4">Orang mengunjungi profil Anda akan melihat info berikut</p>

            <form action="<?= base_url('/profile/update') ?>" method="post" enctype="multipart/form-data">

                <div class="mb-4 d-flex align-items-center gap-3">
                    <?php if (!empty($user['avatar']) && $user['avatar'] !== 'default.png'): ?>
                        <img src="<?= base_url('uploads/profile/' . $user['avatar']) ?>"
                            class="rounded-circle object-fit-cover" style="width: 80px; height: 80px;" alt="Avatar">
                    <?php else: ?>
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-secondary text-white fs-3 fw-bold"
                            style="width: 80px; height: 80px;">
                            <?= strtoupper(substr($user['username'], 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <label for="avatar" class="btn btn-light rounded-pill fw-bold border">Ubah foto</label>
                        <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small mb-1">Username (Tidak dapat diubah)</label>
                    <input type="text" class="form-control rounded-4 p-3 bg-light text-muted"
                        value="<?= esc($user['username']) ?>" disabled>
                </div>

                <div class="mb-3">
                    <label for="display_name" class="form-label text-muted small mb-1">Nama Tampilan (Display
                        Name)</label>
                    <input type="text" class="form-control rounded-4 p-3" id="display_name" name="display_name"
                        value="<?= esc($user['display_name'] ?? $user['username']) ?>"
                        placeholder="Masukkan nama tampilan Anda" required>
                </div>

                <div class="mb-4">
                    <label for="bio" class="form-label text-muted small mb-1">Ceritakan tentang diri Anda</label>
                    <textarea class="form-control rounded-4 p-3" id="bio" name="bio" rows="3"
                        placeholder="Tambahkan bio..."><?= esc($user['bio'] ?? '') ?></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="/profile" class="btn btn-light rounded-pill px-4 fw-bold">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    document.getElementById('avatar').addEventListener('change', function (e) {
        if (e.target.files && e.target.files[0]) {
            alert('Foto dipilih: ' + e.target.files[0].name + ' (Klik simpan untuk mengubah)');
        }
    });
</script>
<?= $this->endSection(); ?>