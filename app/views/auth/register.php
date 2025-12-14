<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/login.css">

    <style>
        /* --- CSS WAJIB UNTUK STICKY FOOTER --- */
        html, body {
            height: 100%;
        }
        body {
            display: flex;       /* Mengaktifkan Flexbox */
            flex-direction: column; /* Menyusun elemen dari atas ke bawah */
            min-height: 100vh;   /* Tinggi minimal 100% layar */
            background-color: #f8f9fa; /* Opsional: warna background */
        }
        
        /* Agar konten tengah (Register) mengambil sisa ruang */
        main {
            flex: 1; 
            display: flex;
            align-items: center; /* Menengahkan vertikal */
        }
    </style>
</head>
<body>

<main>
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      
      <div class="col-md-9 col-lg-6 col-xl-5 text-center mb-4 mb-lg-0">
        <img src="<?= BASEURL; ?>/public/img/register.png"
          class="img-fluid" alt="Ilustrasi Register">
      </div>
      
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        
        <div class="d-flex align-items-center mb-4 justify-content-center justify-content-lg-start">
            <i class="fas fa-user-plus fa-2x me-3 text-primary"></i>
            <h1 class="fw-bold mb-0">Register</h1>
        </div>

        <form action="<?= BASEURL; ?>/auth/prosesRegister" method="POST">

          <div class="mb-4">
            <label class="form-label fw-bold">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control form-control-lg"
              placeholder="Masukkan nama lengkap Anda" required />
          </div>

          <div class="mb-4">
            <label class="form-label fw-bold">Username</label>
            <input type="text" name="username" class="form-control form-control-lg"
              placeholder="Masukkan username Anda" required />
          </div>

          <div class="mb-4">
            <label class="form-label fw-bold">Password</label>
            <input type="password" name="password" class="form-control form-control-lg"
              placeholder="Masukkan password" required />
          </div>

          <div class="text-center text-lg-start pt-2">
            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">REGISTER</button>
            
            <p class="small fw-bold mt-2 pt-1 mb-0 text-center">Sudah punya akun? 
                <a href="<?= BASEURL; ?>/auth/login" class="link-danger">Login Sekarang</a>
            </p>
          </div>

        </form>
      </div>
    </div>
  </div>
</main>