<!DOCTYPE html>
<html>
<head>
    <title><?= $data['judul']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Tambah Soal Baru</h4>
            </div>
            <div class="card-body">
                <form action="<?= BASEURL; ?>/admin/simpan" method="POST">
                    <div class="mb-3">
                        <label>Pertanyaan</label>
                        <textarea name="pertanyaan" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Opsi A</label>
                            <input type="text" name="opsi_a" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Opsi B</label>
                            <input type="text" name="opsi_b" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Opsi C</label>
                            <input type="text" name="opsi_c" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Opsi D</label>
                            <input type="text" name="opsi_d" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label>Kunci Jawaban</label>
                        <select name="kunci" class="form-select" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Soal</button>
                    <a href="<?= BASEURL; ?>/admin" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>