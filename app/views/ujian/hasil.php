<!DOCTYPE html>
<html>
<head>
    <title><?= $data['judul']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 text-center">
        <div class="card shadow w-50 mx-auto border-0">
            <div class="card-header bg-primary text-white">
                <h4>Hasil Ujian</h4>
            </div>
            <div class="card-body py-5">
                <h5 class="card-title text-muted mb-4">Nilai Akhir Anda</h5>
                
                <h1 class="display-1 fw-bold <?= ($data['skor'] >= 70) ? 'text-success' : 'text-danger'; ?>">
                    <?= number_format($data['skor'], 0); ?>
                </h1>
                
                <hr class="my-4 w-50 mx-auto">
                
                <div class="row justify-content-center">
                    <div class="col-4">
                        <h5 class="text-success"><?= $data['benar']; ?></h5>
                        <small class="text-muted">Benar</small>
                    </div>
                    <div class="col-4">
                        <h5 class="text-danger"><?= $data['total'] - $data['benar']; ?></h5>
                        <small class="text-muted">Salah</small>
                    </div>
                </div>

                <div class="mt-5">
                    <a href="<?= BASEURL; ?>/home" class="btn btn-primary btn-lg px-5">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>