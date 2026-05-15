<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<style>
    body {
        background-color: #f0f0f0;
    }

    .create-card {
        background-color: white;
        border-radius: 32px;
        box-shadow: 0 1px 20px 0 rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .upload-area {
        border: 2px dashed #dadada;
        border-radius: 20px;
        background-color: #efefef;
        height: 450px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s;
        position: relative;
    }

    .upload-area:hover {
        background-color: #e2e2e2;
    }

    .upload-area img#preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
        display: none;
    }

    .input-custom {
        border: none;
        border-bottom: 2px solid #efefef;
        border-radius: 0;
        padding: 10px 0;
        font-size: 1.2rem;
    }

    .input-custom:focus {
        box-shadow: none;
        border-bottom-color: #007bff;
    }

    .title-input {
        font-size: 2.5rem;
        font-weight: bold;
    }

    #fileInput {
        display: none;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="create-card p-4 p-md-5">
                
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger rounded-4 mb-4">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="/createpost" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold text-secondary">Buat Pin Baru</h4>
                        <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">Simpan</button>
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-4">
                            <div class="upload-area" id="dropZone" onclick="document.getElementById('fileInput').click()">
                                <div id="uploadPlaceholder" class="text-center p-3">
                                    <div class="mb-3">
                                        <i class="fas fa-arrow-circle-up fa-3x text-secondary"></i>
                                    </div>
                                    <p class="mb-0 fw-bold">Klik untuk mengunggah</p>
                                    <small class="text-muted">Gunakan file JPG, PNG, atau WEBP kualitas tinggi kurang dari 20MB</small>
                                </div>
                                <img id="preview" src="#" alt="Pratinjau Gambar">
                                <input type="file" name="foto" id="fileInput" accept="image/*" required onchange="previewImage(this)">
                            </div>
                        </div>

                        <div class="col-md-7 ps-md-5">
                            <div class="mb-5">
                                <input type="text" name="judul" class="form-control input-custom title-input" placeholder="Tambahkan judul Anda" value="<?= old('judul') ?>" required>
                            </div>

                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <span class="fw-bold"><?= substr(session()->get('username') ?? 'U', 0, 1) ?></span>
                                </div>
                                <span class="fw-bold"><?= session()->get('username') ?? 'User' ?></span>
                            </div>

                            <div class="mb-3">
                                <textarea name="deskripsi" class="form-control input-custom" rows="3" placeholder="Beritahu semua orang tentang Pin Anda"><?= old('deskripsi') ?></textarea>
                            </div>
                            
                            <p class="text-muted small mt-5">
                                <i class="fas fa-info-circle me-1"></i> Tips: Gunakan kata kunci yang relevan agar orang lain mudah menemukan karya Anda.
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const placeholder = document.getElementById('uploadPlaceholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    const dropZone = document.getElementById('dropZone');

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.style.backgroundColor = '#e2e2e2';
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.style.backgroundColor = '#efefef';
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.style.backgroundColor = '#efefef';
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            document.getElementById('fileInput').files = files;
            previewImage(document.getElementById('fileInput'));
        }
    });
</script>
<?= $this->endSection(); ?>