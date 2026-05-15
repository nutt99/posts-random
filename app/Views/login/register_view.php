<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card pin-card-shadow border-0" style="border-radius: 32px;">
                <div class="card-body p-4">
                    
                    <div class="text-center mb-4 mt-2">
                        <div class="bg-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <i class="fab fa-pinterest text-white fs-3"></i>
                        </div>
                        <h3 class="fw-bold">Selamat Datang</h3>
                        <p class="text-muted small">Temukan ide-ide baru untuk dicoba</p>
                    </div>
                    
                    <?php if(session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger" style="border-radius: 16px;">
                            <ul class="mb-0 ps-3">
                            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                                <li><small><?= $error ?></small></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="/register" method="post">
                        <div class="mb-3">
                            <label class="form-label fw-bold ms-2 small">Username</label>
                            <input type="text" name="username" class="form-control rounded-pill py-2 px-3" value="<?= old('username') ?>" placeholder="Pilih username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold ms-2 small">Email</label>
                            <input type="email" name="email" class="form-control rounded-pill py-2 px-3" value="<?= old('email') ?>" placeholder="Email Anda" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold ms-2 small">Kata Sandi</label>
                            <input type="password" name="password" class="form-control rounded-pill py-2 px-3" placeholder="Buat kata sandi" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold ms-2 small">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirm" class="form-control rounded-pill py-2 px-3" placeholder="Ulangi kata sandi" required>
                        </div>
                        
                        <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 mb-3">Lanjutkan</button>
                    </form>
                    
                    <div class="text-center mt-2 mb-2">
                        <small class="text-muted">Sudah menjadi anggota? <a href="/login" class="text-dark fw-bold text-decoration-underline">Masuk di sini</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>