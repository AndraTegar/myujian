<div class="container main-content mb-5" style="margin-top: 30px;">
    
    <h4 class="mb-3 border-start border-5 border-primary ps-3">Jadwal Ujian Tersedia</h4>
    
    <div class="row mb-5">
        <?php 
        $ada_jadwal = false; 

        if(!empty($data['ujian_tersedia'])) : 
            foreach($data['ujian_tersedia'] as $ujian) : 
                
                // 1. CEK: Apakah ujian ini SUDAH dikerjakan?
                $sudah_dikerjakan = false;
                if(!empty($data['riwayat'])) {
                    foreach($data['riwayat'] as $r) {
                        if($r['id_jadwal'] == $ujian['id']) {
                            $sudah_dikerjakan = true;
                            break;
                        }
                    }
                }

                // 2. FILTER: Jika sudah dikerjakan, SKIP
                if($sudah_dikerjakan) continue;

                $ada_jadwal = true;
                $is_expired = (time() > strtotime($ujian['waktu_selesai']));
        ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100 border-0 hover-card">
                    <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                        <span class="badge bg-primary mb-2"><?= $ujian['kode_mk']; ?></span>
                        <h5 class="card-title fw-bold text-dark"><?= $ujian['nama_mk']; ?></h5>
                        <p class="text-muted small mb-0"><?= $ujian['nama_ujian']; ?></p>
                    </div>
                    <div class="card-body px-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="far fa-clock text-warning me-2"></i>
                            <small>Durasi: <strong><?= $ujian['durasi_menit']; ?> Menit</strong></small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="far fa-calendar-alt text-success me-2"></i>
                            <small>Mulai: <?= date('d M Y H:i', strtotime($ujian['waktu_mulai'])); ?></small>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-hourglass-end text-danger me-2"></i>
                            <small>Selesai: <?= date('d M Y H:i', strtotime($ujian['waktu_selesai'])); ?></small>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pb-4 px-4">
                        <?php if($is_expired) : ?>
                            <button class="btn btn-danger w-100 rounded-pill" disabled>
                                <i class="fas fa-times-circle me-1"></i> Waktu Habis / Expired
                            </button>
                        <?php else : ?>
                            <a href="<?= BASEURL; ?>/ujian/mulai/<?= $ujian['id']; ?>" class="btn btn-primary w-100 rounded-pill">
                                Kerjakan Sekarang <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; endif; ?>

        <?php if(!$ada_jadwal) : ?>
            <div class="col-12">
                <div class="alert alert-info border-0 shadow-sm">
                    <i class="fas fa-info-circle me-2"></i> Tidak ada ujian baru yang perlu dikerjakan saat ini.
                </div>
            </div>
        <?php endif; ?>
    </div>


    <h4 class="mb-3 border-start border-5 border-success ps-3">Riwayat Ujian (Selesai)</h4>
    
    <div class="row">
        <?php if(empty($data['riwayat'])) : ?>
            <div class="col-12">
                <div class="alert alert-secondary border-0 shadow-sm">
                    <i class="fas fa-history me-2"></i> Belum ada riwayat ujian.
                </div>
            </div>
        <?php else : ?>
            
            <?php foreach($data['riwayat'] as $hist) : ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100 border-0" style="opacity: 0.9;"> 
                    <div class="card-header bg-light border-bottom-0 pt-4 px-4">
                        <span class="badge bg-success mb-2"><?= $hist['kode_mk']; ?></span>
                        <h5 class="card-title fw-bold text-dark"><?= $hist['nama_mk']; ?></h5>
                        <p class="text-muted small mb-0"><?= $hist['nama_ujian']; ?></p>
                    </div>
                    
                    <div class="card-body px-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="far fa-clock text-muted me-2"></i>
                            <small class="text-muted">Durasi: <?= $hist['durasi_menit']; ?> Menit</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-double text-success me-2"></i>
                            <small class="text-dark fw-bold">Selesai: <?= date('d M Y H:i', strtotime($hist['tgl_ujian'])); ?></small>
                        </div>
                        
                        <hr>
                        
                        <div class="row text-center">
                            <div class="col-6 border-end">
                                <small class="d-block text-muted">Benar/Salah</small>
                                <span class="fw-bold text-dark"><?= $hist['benar']; ?> / <?= $hist['salah']; ?></span>
                            </div>
                            <div class="col-6">
                                <small class="d-block text-muted">Status</small>
                                <?php if($hist['nilai'] >= 70) : ?>
                                    <span class="badge bg-success">LULUS</span>
                                <?php else : ?>
                                    <span class="badge bg-danger">REMIDI</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light border-top-0 pb-4 px-4">
                        <button class="btn btn-secondary w-100 rounded-pill" disabled>
                            <i class="fas fa-star me-1 text-warning"></i> Nilai Akhir: <strong><?= $hist['nilai']; ?></strong>
                        </button>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>

</div>