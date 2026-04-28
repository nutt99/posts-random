<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="/style/grid.css" type="text/css">

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
</head>

<body>

    <nav class="navbar navbar-light bg-white border-bottom py-2">
        <div class="container-fluid d-flex align-items-center">

            <button class="btn btn-light rounded-circle me-2 d-flex justify-content-center align-items-center"
                type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
                style="width: 45px; height: 45px;">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <!-- <a class="navbar-brand text-danger" href="#">
                <i class="fab fa-pinterest fa-2x"></i>
            </a> -->

            <form class="d-flex flex-grow-1 mx-2 mx-md-4">
                <div class="search-wrapper d-flex align-items-center bg-light px-3 py-3 w-100"
                    style="border-radius: 10px;">
                    <i class="fas fa-search text-muted me-2"></i>
                    <input class="form-control bg-transparent border-0 p-0" type="search" placeholder="Cari"
                        aria-label="Cari">
                </div>
            </form>

            <div class="d-flex align-items-center gap-3">
                <!-- <a href="#" class="text-dark"><i class="fas fa-bell fa-lg"></i></a>
                <a href="#" class="text-dark"><i class="fas fa-comment-dots fa-lg"></i></a> -->
                <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center"
                    style="width: 40px; height: 40px; cursor: pointer;">
                    C
                </div>
            </div>

        </div>
    </nav>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Menu Utama</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column gap-2">
                <a href="#" class="sidebar-link"><i class="fas fa-home fa-fw me-2"></i> Beranda</a>
                <a href="#" class="sidebar-link"><i class="fas fa-compass fa-fw me-2"></i> Jelajahi</a>
                <a href="#" class="sidebar-link"><i class="fas fa-plus fa-fw me-2"></i> Buat Pin</a>
                <hr>
                <a href="#" class="sidebar-link"><i class="fas fa-cog fa-fw me-2"></i> Pengaturan</a>
            </div>
        </div>
    </div>

    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/jquery/jquery.min.js"></script>
</body>

</html>