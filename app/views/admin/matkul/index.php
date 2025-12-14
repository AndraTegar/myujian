<div class="container" style="margin-top: 80px;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-info"><i class="fas fa-book me-2"></i>Mata Kuliah</h3>
        <a href="<?= BASEURL; ?>/admin/tambah_matkul" class="btn btn-info text-white shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Matkul
        </a>
    </div>

    <div class="row">
        <?php if(empty($data['matkul'])) : ?>
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">Belum ada mata kuliah.</h5>
            </div>
        <?php else : ?>
            <?php foreach($data['matkul'] as $mk) : ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0 hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fw-bold text-dark"><?= $mk['nama_mk']; ?></h5>
                            <span class="badge bg-primary align-self-start"><?= $mk['kode_mk']; ?></span>
                        </div>
                        <p class="text-muted small mb-3">ID MK: <?= $mk['id']; ?></p>
                        
                        <div class="d-grid gap-2">
                             <a href="<?= BASEURL; ?>/admin/hapus_matkul/<?= $mk['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus mata kuliah ini?')">
                                <i class="fas fa-trash me-1"></i> Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<style>
    .hover-card:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important; transition: all 0.2s; }
</style>