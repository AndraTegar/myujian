<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<div class="container" style="margin-top: 80px;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h6 class="text-muted mb-1">Formulir Input:</h6>
            <h2 class="fw-bold text-primary">Buat Soal Baru</h2>
            <span class="badge bg-light text-primary border border-primary px-3 py-2 rounded-pill">
                <i class="fas fa-file-alt me-1"></i> Ujian: <?= $data['jadwal']['nama_ujian']; ?>
            </span>
        </div>
        <div>
            <a href="<?= BASEURL; ?>/dosen/atur_soal/<?= $data['jadwal']['id']; ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Batal & Kembali
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-5">
        <div class="card-header bg-white py-3 border-bottom">
            <i class="fas fa-book me-1 text-muted"></i> 
            Mata Kuliah: <strong><?= $data['mk']['nama_mk']; ?></strong>
        </div>

        <div class="card-body p-4">
            <form action="<?= BASEURL; ?>/dosen/simpan" method="post">
                
                <input type="hidden" name="id_mk" value="<?= $data['mk']['id']; ?>">
                <input type="hidden" name="id_jadwal" value="<?= $data['jadwal']['id']; ?>">

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Isi Pertanyaan</label>
                    <textarea name="soal" id="editor-soal" class="form-control" rows="3" required></textarea>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <div class="flex-grow-1 border-top"></div>
                    <span class="px-3 text-muted small fw-bold text-uppercase">Pilihan Jawaban</span>
                    <div class="flex-grow-1 border-top"></div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text fw-bold bg-light text-primary" style="width: 40px;">A</span>
                            <input type="text" name="a" class="form-control" placeholder="Masukan jawaban opsi A..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text fw-bold bg-light text-primary" style="width: 40px;">B</span>
                            <input type="text" name="b" class="form-control" placeholder="Masukan jawaban opsi B..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text fw-bold bg-light text-primary" style="width: 40px;">C</span>
                            <input type="text" name="c" class="form-control" placeholder="Masukan jawaban opsi C..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text fw-bold bg-light text-primary" style="width: 40px;">D</span>
                            <input type="text" name="d" class="form-control" placeholder="Masukan jawaban opsi D..." required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text fw-bold bg-light text-primary" style="width: 40px;">E</span>
                            <input type="text" name="e" class="form-control" placeholder="Masukan jawaban opsi E..." required>
                        </div>
                    </div>
                </div>

                <div class="alert alert-warning mt-4 d-flex align-items-center border-0 shadow-sm" role="alert">
                    <div class="me-3">
                        <i class="fas fa-key fa-2x text-warning"></i>
                    </div>
                    <div class="flex-grow-1">
                        <label class="form-label fw-bold mb-1 text-dark">Kunci Jawaban Benar:</label>
                        <select name="kunci" class="form-select border-warning fw-bold text-dark" style="max-width: 200px;" required>
                            <option value="" selected disabled>-- Pilih Kunci --</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 border-top pt-3">
                    <a href="<?= BASEURL; ?>/dosen/atur_soal/<?= $data['jadwal']['id']; ?>" class="btn btn-light px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                        <i class="fas fa-save me-1"></i> Simpan Soal
                    </button>
                </div>
            
            </form> 
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('editor-soal');
</script>