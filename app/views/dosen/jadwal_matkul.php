<div class="container" style="margin-top: 80px;">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h6 class="text-muted mb-1">Mata Kuliah:</h6>
                <h2 class="fw-bold"><?= $data['mk']['nama_mk']; ?></h2>
                <span class="mk-badge"><i class="fas fa-book me-1"></i> ID MK: <?= $data['mk']['id']; ?></span>
            </div>
            <div>
                <a href="<?= BASEURL; ?>/dosen" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <a href="<?= BASEURL; ?>/dosen/tambah_jadwal/<?= $data['mk']['id']; ?>" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus me-1"></i> Jadwal Baru
                </a>
            </div>
        </div>

        <div class="d-flex align-items-center mb-3">
            <div class="border-start border-4 border-primary ps-2">
                <h5 class="m-0 fw-bold">Daftar Jadwal Ujian</h5>
            </div>
        </div>

        <div class="alert alert-info d-flex align-items-center mt-3 shadow-sm border-0 bg-white border-start border-info border-4">
            <i class="fas fa-info-circle fa-2x text-info me-3"></i>
            <div>
                <strong>Informasi Sistem:</strong>
                <p class="mb-0 small text-muted">Mahasiswa hanya dapat melihat dan mengerjakan ujian jika status jadwal adalah <strong>"Sedang Aktif"</strong>. Pastikan Anda telah mengklik tombol <strong>"Kelola Soal"</strong> untuk memasukkan butir pertanyaan.</p>
            </div>
        </div>
        
        <div class="row">
            <?php if(empty($data['jadwal'])) : ?>
                <div class="col-12">
                    <div class="alert alert-light text-center shadow-sm py-5 border-0">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-50" alt="Empty">
                        <p class="h5 text-muted">Belum ada jadwal ujian.</p>
                        <p class="text-muted small">Silahkan buat jadwal baru untuk mata kuliah ini.</p>
                    </div>
                </div>
            <?php else : ?>
                <?php foreach($data['jadwal'] as $j) : ?>
                    <?php 
                        // Logic Status PHP (Tetap dipertahankan)
                        $sekarang = time();
                        $mulai = strtotime($j['waktu_mulai']);
                        $selesai = strtotime($j['waktu_selesai']);
                        
                        if($sekarang < $mulai) {
                            $statusBadge = '<span class="badge bg-warning text-dark status-badge"><i class="fas fa-clock me-1"></i>Belum Mulai</span>';
                            $cardBorder = 'border-warning';
                        } elseif($sekarang > $selesai) {
                            $statusBadge = '<span class="badge bg-secondary status-badge"><i class="fas fa-history me-1"></i>Selesai</span>';
                            $cardBorder = 'border-secondary';
                        } else {
                            $statusBadge = '<span class="badge bg-success status-badge"><i class="fas fa-check-circle me-1"></i>Sedang Aktif</span>';
                            $cardBorder = 'border-success'; // Hijau jika aktif
                        }
                    ?>

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card card-ujian shadow-sm h-100 <?= ($sekarang >= $mulai && $sekarang <= $selesai) ? 'border border-2 border-success' : ''; ?>">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title fw-bold text-primary m-0"><?= $j['nama_ujian']; ?></h5>
                                    <?= $statusBadge; ?>
                                </div>

                                <div class="mb-3 text-secondary small">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="far fa-calendar-alt me-2 text-primary" style="width: 20px;"></i>
                                        <div>
                                            <strong>Mulai:</strong><br>
                                            <?= date('d M Y, H:i', strtotime($j['waktu_mulai'])); ?>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="far fa-calendar-check me-2 text-danger" style="width: 20px;"></i>
                                        <div>
                                            <strong>Selesai:</strong><br>
                                            <?= date('d M Y, H:i', strtotime($j['waktu_selesai'])); ?>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-hourglass-half me-2 text-warning" style="width: 20px;"></i>
                                        <span>Durasi: <strong><?= $j['durasi_menit']; ?> Menit</strong></span>
                                    </div>
                                </div>

                                <hr class="mt-auto opacity-25">

                                <div class="d-grid gap-2">
                                    <a href="<?= BASEURL; ?>/dosen/atur_soal/<?= $j['id']; ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-file-alt me-1"></i> Kelola Soal
                                    </a>
                                    <div class="d-flex gap-2">
                                        <a href="<?= BASEURL; ?>/dosen/ubah_jadwal/<?= $j['id']; ?>/<?= $data['mk']['id']; ?>" class="btn btn-outline-warning btn-sm flex-fill">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="<?= BASEURL; ?>/dosen/hapus_jadwal/<?= $j['id']; ?>/<?= $data['mk']['id']; ?>" class="btn btn-outline-danger btn-sm flex-fill" onclick="return confirm('Yakin ingin menghapus jadwal ini? Data soal mungkin ikut terhapus.')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>