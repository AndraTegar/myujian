<div class="container" style="margin-top: 80px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h6 class="text-muted mb-1">Manajemen Waktu:</h6>
            <h2 class="fw-bold text-primary">Buat Jadwal Ujian Baru</h2>
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
            <div class="card border-0 shadow-sm mb-5">
                
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="m-0 fw-bold text-primary"><i class="far fa-calendar-plus me-2"></i>Form Pengaturan Jadwal</h5>
                </div>

                <div class="card-body p-4">
                    <form action="<?= BASEURL; ?>/dosen/simpan_jadwal" method="POST">
                        
                        <input type="hidden" name="id_mk" value="<?= $data['mk']['id']; ?>">

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Ujian / Topik</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-heading text-secondary"></i></span>
                                <input type="text" name="nama_ujian" class="form-control" placeholder="Contoh: UAS Semester Ganjil 2024" required autofocus>
                            </div>
                        </div>

                        <div class="alert alert-info border-0 shadow-sm d-flex align-items-center mb-4">
                            <i class="fas fa-info-circle fa-2x me-3 text-info"></i>
                            <small class="text-muted">
                                Mahasiswa hanya dapat mengerjakan soal dalam rentang waktu <strong>Mulai</strong> sampai <strong>Selesai</strong>. Pastikan durasi pengerjaan logis.
                            </small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-success">
                                    <i class="far fa-calendar-check me-1"></i> Waktu Dibuka (Mulai)
                                </label>
                                <input type="datetime-local" name="waktu_mulai" class="form-control border-success" required>
                                <div class="form-text">Kapan mahasiswa mulai boleh masuk.</div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-danger">
                                    <i class="far fa-calendar-times me-1"></i> Waktu Ditutup (Selesai)
                                </label>
                                <input type="datetime-local" name="waktu_selesai" class="form-control border-danger" required>
                                <div class="form-text">Batas akhir akses ujian.</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Durasi Pengerjaan (Timer)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-hourglass-half text-warning"></i></span>
                                <input type="number" name="durasi_menit" class="form-control" placeholder="Contoh: 90" min="1" required>
                                <span class="input-group-text fw-bold">Menit</span>
                            </div>
                            <div class="form-text">Waktu hitung mundur saat mahasiswa mengerjakan soal.</div>
                        </div>

                        <hr class="my-4">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= BASEURL; ?>/dosen/atur_jadwal/<?= $data['mk']['id']; ?>" class="btn btn-light px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                                <i class="fas fa-save me-1"></i> Simpan Jadwal
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>