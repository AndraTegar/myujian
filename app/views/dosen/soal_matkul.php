<div class="container" style="margin-top: 80px;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h6 class="text-muted mb-1">Bank Soal Untuk Ujian:</h6>
            <h2 class="fw-bold text-primary"><?= $data['jadwal']['nama_ujian']; ?></h2>
            <span class="badge bg-white text-primary border border-primary shadow-sm px-3 py-2 rounded-pill">
                <i class="fas fa-book me-1"></i> <?= $data['mk']['nama_mk']; ?>
            </span>
        </div>
        <div>
            <a href="<?= BASEURL; ?>/dosen/atur_jadwal/<?= $data['mk']['id']; ?>" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <a href="<?= BASEURL; ?>/dosen/tambah/<?= $data['jadwal']['id']; ?>" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle me-1"></i> Tambah Soal
            </a>
        </div>
    </div>

    <div class="alert alert-info border-0 shadow-sm d-flex align-items-center mb-4" role="alert">
        <i class="fas fa-info-circle fa-2x me-3 text-info"></i>
        <div>
            <strong>Status Bank Soal:</strong>
            <div class="small">
                Saat ini terdapat <strong><?= count($data['soal']); ?> Butir Soal</strong>. 
                Pastikan kunci jawaban sudah benar sebelum ujian dimulai.
            </div>
        </div>
    </div>

    <div class="row">
        <?php if(empty($data['soal'])) : ?>
            <div class="col-12">
                <div class="text-center py-5 bg-white rounded shadow-sm">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="100" class="mb-3 opacity-50" alt="Empty">
                    <h5 class="text-muted">Belum ada butir soal.</h5>
                    <p class="text-muted small">Silahkan klik tombol "Tambah Soal" berwarna biru di pojok kanan atas.</p>
                </div>
            </div>
        <?php else : ?>
            
            <div class="col-12">
                <?php $no=1; foreach($data['soal'] as $s) : ?>
                <div class="card card-soal border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-primary">
                            <span class="badge bg-primary me-2 rounded-circle" style="width: 25px; height: 25px; display: inline-flex; align-items: center; justify-content: center;"><?= $no++; ?></span>
                            Pertanyaan
                        </span>
    
                        <div>
                            <a href="<?= BASEURL; ?>/dosen/ubah_soal/<?= $s['id']; ?>" class="btn btn-outline-warning btn-sm rounded-pill px-3 me-1">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>

                            <a href="<?= BASEURL; ?>/dosen/hapus/<?= $s['id']; ?>/<?= $data['jadwal']['id']; ?>" 
                                class="btn btn-outline-danger btn-sm rounded-pill px-3" 
                                onclick="return confirm('Yakin ingin menghapus soal nomor <?= $no-1; ?>?')">
                                <i class="fas fa-trash-alt me-1"></i> Hapus
                            </a>
                    </div>
                </div>

                    <div class="card-body">
                        <div class="mb-4 text-dark fs-5 lh-base">
                            <?= htmlspecialchars_decode($s['soal']); ?>
                        </div>

                        <div class="row g-3">
                            <?php 
                                $opsi = ['A', 'B', 'C', 'D', 'E'];
                                $kunci = $s['kunci']; 
                            ?>
                            <?php foreach($opsi as $opt) : ?>
                                <?php 
                                    $isKey = ($kunci == $opt);
                                    $bgClass = $isKey ? 'bg-success text-white shadow' : 'bg-light text-secondary';
                                ?>
                                <div class="col-md-6"> 
                                    <div class="p-3 rounded d-flex align-items-center <?= $bgClass; ?>" style="min-height: 100%;">
                                        <div class="fw-bold me-3 fs-5" style="min-width: 30px;"><?= $opt; ?>.</div>
                                        <div class="flex-grow-1">
                                            <?= $s[strtolower($opt)]; ?>
                                        </div>
                                        <?php if($isKey): ?> <i class="fas fa-check-circle fs-4 ms-2"></i> <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    </div>
</div>
