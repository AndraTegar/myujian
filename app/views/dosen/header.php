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
        .navbar-brand { font-weight: bold; font-size: 1.2rem; }
        .card-ujian { transition: transform 0.2s; border: none; border-radius: 10px; }
        .card-ujian:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
        .mk-badge { background-color: #e7f1ff; color: #0d6efd; font-weight: bold; padding: 5px 10px; border-radius: 5px; }
        .status-badge { font-size: 0.8rem; }
        /* --- TAMBAHKAN CSS INI --- */
    
        /* 1. Pastikan HTML dan Body mengambil tinggi penuh layar */
        html, body {
            height: 100%;
            margin: 0;
        }

        /* 2. Ubah Body menjadi Flex Container vertikal */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Viewport Height 100% */
            background-color: #f8f9fa; /* Warna background abu-abu muda */
        }

        .main-content {
            flex: 1; /* PERINTAH PENTING: Ambil semua sisa ruang kosong */
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand navbar-dark bg-primary mb-4 shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-graduation-cap"></i> MyUjian - Dosen</a>
            
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <span class="me-2 d-none d-lg-inline text-white small fw-bold"><?= $_SESSION['user_nama']; ?></span>
                        <img class="img-profile rounded-circle border border-white" src="https://ui-avatars.com/api/?name=<?= $_SESSION['user_nama']; ?>&background=fff&color=0d6efd" width="32" height="32">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in">
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/auth/logout" onclick="return confirm('Yakin ingin keluar?')">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout
                        </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>