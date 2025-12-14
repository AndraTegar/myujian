<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Agar Footer selalu di bawah */
        html, body { height: 100%; }
        body { 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
            background-color: #f8f9fa; /* bg-light */
            padding-top: 80px; /* Jarak untuk Navbar Fixed */
        }
        
        /* Efek Hover pada Card Ujian */
        .hover-card { transition: transform 0.2s; }
        .hover-card:hover { transform: translateY(-5px); }
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

    <nav class="navbar navbar-expand navbar-dark bg-primary mb-4 shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= BASEURL; ?>/mahasiswa">
                <i class="fas fa-graduation-cap"></i> MyUjian
            </a>
            
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <span class="me-2 d-none d-lg-inline text-white small fw-bold">
                            <?= $data['user']; ?>
                        </span>
                        <img class="img-profile rounded-circle border border-white" 
                             src="https://ui-avatars.com/api/?name=<?= $data['user']; ?>&background=fff&color=0d6efd" 
                             width="32" height="32">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in">
                        <li>
                            <a class="dropdown-item" href="<?= BASEURL; ?>/auth/logout" onclick="return confirm('Yakin ingin keluar?')">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>