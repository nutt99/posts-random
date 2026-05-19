<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="/style/grid.css" type="text/css"> -->

<style>
    .search-wrapper:hover {
        background-color: #e2e2e2 !important;
    }

    .form-control:focus {
        box-shadow: none;
    }

    .sidebar-link {
        text-decoration: none;
        color: #333;
        padding: 10px 15px;
        border-radius: 8px;
        display: block;
        transition: background 0.2s;
    }

    .sidebar-link:hover {
        background-color: #f0f0f0;
    }
</style>
<!-- </head>

<body> -->

<nav class="navbar navbar-light bg-white border-bottom py-2 sticky-top">
    <div class="container-fluid d-flex align-items-center">

        <button class="btn btn-light rounded-circle me-2 d-flex justify-content-center align-items-center" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" style="width: 45px; height: 45px;">
            <i class="fas fa-bars fa-lg"></i>
        </button>
        <!-- <a class="navbar-brand text-danger" href="#">
                <i class="fab fa-pinterest fa-2x"></i>
            </a> -->

        <form action="/search" method="get" class="d-flex flex-grow-1 mx-2 mx-md-4">
            <div class="search-wrapper d-flex align-items-center bg-light px-3 py-3 w-100" style="border-radius: 10px;">
                <i class="fas fa-search text-muted me-2"></i>
                <input type="text" name="q" class="form-control bg-light border-0 rounded-end-pill py-2"
                    placeholder="Cari pin..." value="<?= isset($_GET['q']) ? esc($_GET['q']) : '' ?>"
                    style="box-shadow: none;">
            </div>
        </form>

        <div class="d-flex align-items-center gap-3">
            <!-- <a href="#" class="text-dark"><i class="fas fa-bell fa-lg"></i></a>
                <a href="#" class="text-dark"><i class="fas fa-comment-dots fa-lg"></i></a> -->
            <div class="d-flex align-items-center gap-3">
                <?php if (session()->get('isLogin')): ?>

                    <a href="/profile" class="text-decoration-none" title="Lihat Profil">
                        <?php
                        $avatar = session()->get('avatar');
                        $username = session()->get('username') ?? 'U';
                        $inisial = strtoupper(substr($username, 0, 1));
                        ?>

                        <?php if (!empty($avatar) && $avatar !== 'default.png'): ?>
                            <img src="<?= base_url('uploads/profile/' . $avatar) ?>"
                                class="rounded-circle object-fit-cover shadow-sm border" style="width: 40px; height: 40px;"
                                alt="Profil">
                        <?php else: ?>
                            <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center fw-bold shadow-sm"
                                style="width: 40px; height: 40px;">
                                <?= $inisial ?>
                            </div>
                        <?php endif; ?>
                    </a>

                <?php else: ?>
                    <a href="/login" class="btn btn-danger rounded-pill fw-bold px-4">Masuk</a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">Menu Utama</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="d-flex flex-column gap-2">
        <a href="/" class="sidebar-link"><i class="fas fa-home fa-fw me-2"></i> Beranda</a>
        <a href="/createpost" class="sidebar-link"><i class="fas fa-plus fa-fw me-2"></i> Buat Pin</a>

        <hr>

        <?php if (session()->get('isLogin')): ?>
            <a href="/profile" class="sidebar-link"><i class="fas fa-user fa-fw me-2"></i> Profil
                (<?= session()->get('username'); ?>)</a>
            <a href="/logout" class="sidebar-link text-danger"><i class="fas fa-sign-out-alt fa-fw me-2"></i> Keluar</a>
        <?php else: ?>
            <a href="/login" class="sidebar-link"><i class="fas fa-sign-in-alt fa-fw me-2"></i> Masuk</a>
            <a href="/register" class="sidebar-link"><i class="fas fa-user-plus fa-fw me-2"></i> Daftar</a>
        <?php endif; ?>
    </div>
</div>
<!-- 
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/jquery/jquery.min.js"></script>
</body>

</html> -->