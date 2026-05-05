<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Pinterest Clone' ?></title>
    
    <!-- CSS Global (Bootstrap & FontAwesome) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="/style/grid.css" type="text/css">
    
    <!-- Tempat untuk menyisipkan CSS khusus per halaman (opsional) -->
    <?= $this->renderSection('styles') ?>
</head>
<body style="background-color: #ffffff;">

    <!-- Memanggil komponen Navbar -->
    <?= $this->include('layout/navbar') ?>

    <!-- Tempat di mana konten halaman utama akan disisipkan -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- JS Global -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/jquery/jquery.min.js"></script>
    
    <!-- Tempat untuk menyisipkan JS khusus per halaman (opsional) -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>