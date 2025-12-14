<div class="container" style="margin-top: 80px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h6 class="text-muted mb-1">Manajemen Waktu:</h6>
            <h2 class="fw-bold text-warning">Edit Jadwal Ujian</h2>
            <span class="badge bg-light text-primary border border-primary px-3 py-2 rounded-pill">
                <i class="fas fa-book me-1"></i> Mata Kuliah: <?= $data['mk']['nama_mk']; ?>
            </span>
        </div>
        <div>
            <a href="<?= BASEURL; ?>/dosen/atur_jadwal/<?= $data['mk']['id']; ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Batal
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-5 border-start border-4 border-warning">
                
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="m-0 fw-bold text-dark">
                        <i class="far fa-edit me-2 text-warning"></i>Form Perubahan Data
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="<?= BASEURL; ?>/dosen/proses_ubah_jadwal" method="POST">
                        
                        <input type="hidden" name="id" value="<?= $data['jadwal']['id']; ?>">
                        <input type="hidden" name="id_mk" value="<?= $data['mk']['id']; ?>">

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Ujian / Topik</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-heading text-secondary"></i></span>
                                <input type="text" name="nama_ujian" class="form-control" 
                                       value="<?= $data['jadwal']['nama_ujian']; ?>" required>
                            </div>
                        </div>

                        <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center mb-4">
                            <i class="fas fa-exclamation-triangle fa-2x me-3 text-warning"></i>
                            <small class="text-muted">
                                <strong>Perhatian:</strong> Mengubah waktu ujian saat ujian sedang berlangsung dapat menyebabkan error pada sesi mahasiswa yang sedang mengerjakan.
                            </small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-success">
                                    <i class="far fa-calendar-check me-1"></i> Waktu Dibuka
                                </label>
                                <input type="datetime-local" name="waktu_mulai" class="form-control border-success" 
                                       value="<?= date('Y-m-d\TH:i', strtotime($data['jadwal']['waktu_mulai'])); ?>" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-danger">
                                    <i class="far fa-calendar-times me-1"></i> Waktu Ditutup
                                </label>
                                <input type="datetime-local" name="waktu_selesai" class="form-control border-danger" 
                                       value="<?= date('Y-m-d\TH:i', strtotime($data['jadwal']['waktu_selesai'])); ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Durasi Pengerjaan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-hourglass-half text-warning"></i></span>
                                <input type="number" name="durasi_menit" class="form-control" 
                                       value="<?= $data['jadwal']['durasi_menit']; ?>" required>
                                <span class="input-group-text fw-bold">Menit</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= BASEURL; ?>/dosen/atur_jadwal/<?= $data['mk']['id']; ?>" class="btn btn-light px-4">Batal</a>
                            <button type="submit" class="btn btn-warning px-5 fw-bold shadow-sm">
                                <i class="fas fa-save me-1"></i> Update Jadwal
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>