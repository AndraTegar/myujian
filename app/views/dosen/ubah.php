<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<div class="container" style="margin-top: 80px;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h6 class="text-muted mb-1">Formulir Edit:</h6>
            <h2 class="fw-bold text-warning">Edit Soal</h2>
            <span class="badge bg-light text-primary border border-primary px-3 py-2 rounded-pill">
                <i class="fas fa-file-alt me-1"></i> Ujian: <?= $data['jadwal']['nama_ujian']; ?>
            </span>
        </div>
        <div>
            <a href="<?= BASEURL; ?>/dosen/atur_soal/<?= $data['jadwal']['id']; ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Batal
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-5 border-start border-4 border-warning">
        <div class="card-body p-4">
            
            <form action="<?= BASEURL; ?>/dosen/proses_ubah_soal" method="post">
                
                <input type="hidden" name="id_soal" value="<?= $data['soal']['id']; ?>">
                <input type="hidden" name="id_jadwal" value="<?= $data['jadwal']['id']; ?>">

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Isi Pertanyaan</label>
                    <textarea name="soal" id="editor-soal" class="form-control" rows="3" required><?= $data['soal']['soal']; ?></textarea>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <div class="flex-grow-1 border-top"></div>
                    <span class="px-3 text-muted small fw-bold text-uppercase">Pilihan Jawaban</span>
                    <div class="flex-grow-1 border-top"></div>
                </div>

                <div class="row g-3">
                    <?php 
                        $opsi = ['a', 'b', 'c', 'd', 'e']; 
                        foreach($opsi as $o) : 
                    ?>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text fw-bold bg-light text-primary" style="width: 40px;"><?= strtoupper($o); ?></span>
                            <input type="text" name="<?= $o; ?>" class="form-control" value="<?= $data['soal'][$o]; ?>" required>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="card bg-warning bg-opacity-10 border border-warning mt-4 shadow-sm">
                    <div class="card-body py-3"> <div class="d-flex align-items-center"> <div class="me-3">
                        <i class="fas fa-key fa-2x text-warning"></i>
                    </div>
                    <div class="flex-grow-1">
                        <label class="form-label fw-bold mb-1 text-dark">Kunci Jawaban Benar:</label>
                        <select name="kunci" class="form-select border-warning fw-bold text-dark" style="max-width: 200px;" required>
                            <?php 
                                $pilihan = ['A', 'B', 'C', 'D', 'E'];
                                foreach($pilihan as $p) :
                            ?>
                                <option value="<?= $p; ?>" <?= ($data['soal']['kunci'] == $p) ? 'selected' : ''; ?>>
                                    <?= $p; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 border-top pt-3">
                    <a href="<?= BASEURL; ?>/dosen/atur_soal/<?= $data['jadwal']['id']; ?>" class="btn btn-light px-4">Batal</a>
                    <button type="submit" class="btn btn-warning px-5 fw-bold shadow-sm text-dark">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            
            </form> 
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('editor-soal');
</script>