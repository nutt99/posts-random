<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4 fw-bold">Edit Pin</h3>

                    <form action="<?= base_url('post/update/' . $post['id']) ?>" method="post"
                        enctype="multipart/form-data">

                        <div class="mb-4 text-center">
                            <p class="text-muted mb-2">Gambar Saat Ini:</p>
                            <?php
                            $fotoUrl = (strpos($post['content_url'], 'http') === 0)
                                ? $post['content_url']
                                : base_url('uploads/photos/' . $post['content_url']);
                            ?>
                            <img src="<?= $fotoUrl ?>">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Ganti Gambar (Opsional)</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Judul</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="<?= esc($post['title']) ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="4"
                                required><?= esc($post['description']) ?></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary text-white rounded-pill py-2 fw-bold">Simpan
                                Perubahan</button>
                            <a href="<?= base_url('/profile') ?>"
                                class="btn btn-light rounded-pill py-2 fw-bold">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>