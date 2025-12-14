<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body { background-color: #f8f9fa; }
        .card-menu { transition: transform 0.2s; }
        .card-menu:hover { transform: translateY(-5px); }
        /* --- TAMBAHKAN CSS INI --- */
    
        /* 1. Pastikan HTML dan Body mengambil tinggi penuh layar */
        html, body {
            height: 100%;
        }

        /* 2. Ubah Body menjadi Flex Container vertikal */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Viewport Height 100% */
            background-color: #f8f9fa; /* Warna background abu-abu muda */
        }

        /* 3. Efek Hover untuk Kartu (Opsional, dari kode sebelumnya) */
        .card-menu { transition: transform 0.2s; }
        .card-menu:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= BASEURL; ?>/admin">
                <i class="fas fa-cogs me-2"></i>MyUjian - Admin
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL; ?>/admin">Dashboard</a>
                    </li>

                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <span class="me-2 d-none d-lg-inline text-white small fw-bold">Administrator</span>
                            <div class="bg-white text-dark rounded-circle d-flex justify-content-center align-items-center fw-bold" style="width: 35px; height: 35px;">
                                A
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item text-danger" href="<?= BASEURL; ?>/auth/logout" onclick="return confirm('Keluar dari Admin?')">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>