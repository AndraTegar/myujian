<!DOCTYPE html>
<html>
<head>
    <title><?= $data['judul']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="card shadow">
            <div class="card-header bg-warning">
                <h4>Edit Soal</h4>
            </div>
            <div class="card-body">
                <form action="<?= BASEURL; ?>/admin/prosesUbah" method="POST">
                    <input type="hidden" name="id" value="<?= $data['soal']['id']; ?>">
                    
                    <div class="mb-3">
                        <label>Pertanyaan</label>
                        <textarea name="pertanyaan" class="form-control" rows="3" required><?= $data['soal']['pertanyaan']; ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Opsi A</label>
                            <input type="text" name="opsi_a" class="form-control" value="<?= $data['soal']['opsi_a']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Opsi B</label>
                            <input type="text" name="opsi_b" class="form-control" value="<?= $data['soal']['opsi_b']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Opsi C</label>
                            <input type="text" name="opsi_c" class="form-control" value="<?= $data['soal']['opsi_c']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Opsi D</label>
                            <input type="text" name="opsi_d" class="form-control" value="<?= $data['soal']['opsi_d']; ?>" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label>Kunci Jawaban</label>
                        <select name="kunci" class="form-select" required>
                            <option value="A" <?= ($data['soal']['kunci'] == 'A') ? 'selected' : ''; ?>>A</option>
                            <option value="B" <?= ($data['soal']['kunci'] == 'B') ? 'selected' : ''; ?>>B</option>
                            <option value="C" <?= ($data['soal']['kunci'] == 'C') ? 'selected' : ''; ?>>C</option>
                            <option value="D" <?= ($data['soal']['kunci'] == 'D') ? 'selected' : ''; ?>>D</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Soal</button>
                    <a href="<?= BASEURL; ?>/admin" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>