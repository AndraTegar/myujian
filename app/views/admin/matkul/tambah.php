<div class="container" style="margin-top: 80px;">
    
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow border-0 border-top border-info border-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-info">
                        <i class="fas fa-book-medical me-2"></i>Tambah Mata Kuliah
                    </h5>
                </div>
                <div class="card-body p-4">
                    
                    <form action="<?= BASEURL; ?>/admin/simpan_matkul" method="POST">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kode Mata Kuliah</label>
                            <input type="text" name="kode_mk" class="form-control font-monospace" 
                                   placeholder="Contoh: TI-101" required autofocus>
                            <div class="form-text">Kode unik untuk identifikasi mata kuliah.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Mata Kuliah</label>
                            <input type="text" name="nama_mk" class="form-control" 
                                   placeholder="Contoh: Algoritma Pemrograman" required>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= BASEURL; ?>/admin/matkul" class="btn btn-light me-md-2">Batal</a>
                            <button type="submit" class="btn btn-info text-white fw-bold shadow-sm">
                                <i class="fas fa-save me-1"></i> Simpan Matkul
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>