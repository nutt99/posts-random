<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #111;
        }

        /* --- STYLING AREA UPLOAD (KIRI) --- */
        .upload-box {
            background-color: #e9e9e9;
            border-radius: 32px;
            height: 480px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            cursor: pointer;
            transition: background-color 0.2s;
            position: relative;
        }

        .upload-box:hover {
            background-color: #e0e0e0;
        }

        .upload-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #111;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        /* Teks petunjuk di bagian bawah kotak abu-abu */
        .upload-hint-bottom {
            position: absolute;
            bottom: 30px;
            text-align: center;
            font-size: 0.8rem;
            color: #767676;
            padding: 0 20px;
        }

        /* File input disembunyikan menutupi kotak */
        .file-input-hidden {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .btn-light-custom {
            background-color: #efefef;
            font-weight: 600;
            color: #111;
            border: none;
        }
        .btn-light-custom:hover { background-color: #e2e2e2; }

        /* --- STYLING FORM INPUT PINTEREST (KANAN) --- */
        .pinterest-input-group {
            background-color: #e9e9e9;
            border-radius: 16px;
            padding: 8px 16px 4px 16px;
            margin-bottom: 24px;
            transition: box-shadow 0.2s;
        }

        /* Efek fokus saat diklik (outline biru muda) */
        .pinterest-input-group:focus-within {
            box-shadow: 0 0 0 4px rgba(0, 132, 255, 0.2);
            background-color: #ffffff;
            border: 1px solid #0084ff;
        }

        .pinterest-input-group label {
            font-size: 0.75rem;
            color: #555;
            margin-bottom: 2px;
            display: block;
        }

        .pinterest-input-group input,
        .pinterest-input-group textarea,
        .pinterest-input-group select {
            background: transparent;
            border: none;
            width: 100%;
            padding: 0;
            outline: none;
            box-shadow: none;
            color: #111;
            font-size: 1rem;
            margin-bottom: 8px;
        }

        /* Khusus input Judul agar teksnya lebih besar */
        .input-title {
            font-size: 1.25rem !important;
            font-weight: 600;
        }

        .pinterest-input-group input::placeholder,
        .pinterest-input-group textarea::placeholder {
            color: #767676;
            font-weight: normal;
        }
    </style>
</head>

<body>

    <div class="container mt-4 mb-5" style="max-width: 1100px;">
        
        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
            <h4 class="fw-bold m-0">Buat Pin</h4>
            <button class="btn btn-danger rounded-pill px-4 py-2 fw-bold" style="background-color: #E60023; border: none;">Simpan</button>
        </div>

        <div class="row g-5">
            
            <div class="col-lg-5">
                <div class="upload-box">
                    <input type="file" class="file-input-hidden" accept="image/*,video/mp4">
                    
                    <div class="upload-icon-wrapper">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <p class="text-center fw-bold px-4" style="font-size: 1.1rem;">
                        Pilih file atau seret dan jatuhkan di sini
                    </p>
                    
                    <div class="upload-hint-bottom">
                        Sebaiknya gunakan file .jpg berkualitas tinggi kurang dari 20 MB atau file .mp4 berukuran kurang dari 200 MB.
                    </div>
                </div>

                <button class="btn btn-light-custom w-100 rounded-pill py-3 mt-3">
                    Simpan dari URL
                </button>
            </div>

            <div class="col-lg-7">
                <form action="#" method="POST">
                    
                    <div class="pinterest-input-group">
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" name="judul" class="input-title" placeholder="Tambahkan judul">
                    </div>

                    <div class="pinterest-input-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Tambahkan deskripsi terperinci"></textarea>
                    </div>

                    <div class="pinterest-input-group">
                        <label for="tautan">Tautan</label>
                        <input type="url" id="tautan" name="tautan" placeholder="Tambahkan tautan">
                    </div>

                    <div class="pinterest-input-group">
                        <label for="papan">Papan</label>
                        <select id="papan" name="papan">
                            <option value="" disabled selected>Pilih papan</option>
                            <option value="1">Referensi UI/UX</option>
                            <option value="2">Ilustrasi Anime</option>
                            <option value="3">Game Assets</option>
                        </select>
                    </div>

                    <div class="pinterest-input-group">
                        <label for="tag">Topik yang diberi tag (0)</label>
                        <input type="text" id="tag" name="tag" placeholder="Cari tag">
                    </div>

                </form>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>