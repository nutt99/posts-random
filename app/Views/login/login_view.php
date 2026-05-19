<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card pin-card-shadow border-0" style="border-radius: 32px;">
                <div class="card-body p-4">
                    
                    <div class="text-center mb-4 mt-2">
                        <!-- <div class="bg-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                            <i class="fab fa-pinterest text-white fs-3"></i>
                        </div> -->
                        <h3 class="fw-bold">Masuk ke Akun</h3>
                        <p class="text-muted small">Temukan kembali ide-ide terbaik Anda</p>
                    </div>
                    
                    <?php if(session()->getFlashdata('pesan')): ?>
                        <div class="alert alert-success border-0 small" style="border-radius: 16px; background-color: #d4edda; color: #155724;">
                            <?= session()->getFlashdata('pesan') ?>
                        </div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger border-0 small" style="border-radius: 16px; background-color: #f8d7da; color: #721c24;">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="/login" method="post">
                        <?= csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold ms-2 small">Username</label>
                            <input type="text" name="username" class="form-control rounded-pill py-2 px-3" placeholder="Masukkan email atau username" required autofocus>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold ms-2 small">Kata Sandi</label>
                            <input type="password" name="password" class="form-control rounded-pill py-2 px-3" placeholder="Masukkan kata sandi" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2 mb-3">Masuk</button>
                    </form>
                    
                    <div class="text-center mt-2 mb-2">
                        <small class="text-muted">Belum punya akun? <a href="/register" class="text-dark fw-bold text-decoration-underline">Daftar sekarang</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>