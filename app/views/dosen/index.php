<div class="container flex-grow-1" style="margin-top: 80px;">
    <header class="guru-header">
        <div class="container">
            <div class="row align-items-center pb-5">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-1">Selamat Datang, Bapak/Ibu Dosen!</h2>
                    <p class="mb-0 opacity-75">Kelola ujian dan pantau nilai mahasiswa dengan mudah di sini.</p>
                </div>
                <div class="col-md-4 text-md-end d-none d-md-block">
                   <i class="fas fa-shapes fa-5x opacity-25"></i>
                </div>
            </div>
        </div>
    </header>

    <div class="container" style="margin-top: -2rem;">
        
        <div class="row mb-5">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="stat-card h-100 py-2 border-left-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">Mata Kuliah Diampu</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">
                                    <?= isset($data['mk']) ? count($data['mk']) : 0; ?> Matkul
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-book stat-icon"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="stat-card h-100 py-2" style="border-left-color: #1cc88a;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">Status Sistem</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">Siap Digunakan</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-server stat-icon text-success opacity-25"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="stat-card h-100 py-2" style="border-left-color: #f6c23e;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-warning text-uppercase mb-1">Hari Ini</div>
                                <div class="h5 mb-0 fw-bold text-gray-800"><?= date('d M Y'); ?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-calendar stat-icon text-warning opacity-25"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-gray-800 border-start border-5 border-primary ps-3 mb-0">Daftar Mata Kuliah</h4>
        </div>

        <div class="row">
            <?php if (empty($data['mk'])) : ?>
                <div class="col-12 text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="150" class="mb-3 opacity-50">
                    <h5 class="text-muted">Belum ada mata kuliah yang ditugaskan.</h5>
                </div>
            <?php else : ?>
                
                <?php foreach($data['mk'] as $mk) : ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    
                    <div class="card shadow-sm h-100 border-0 hover-card">
                        
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                            <span class="badge bg-primary mb-2"><?= $mk['kode_mk']; ?></span>
                            <h5 class="card-title fw-bold text-dark"><?= $mk['nama_mk']; ?></h5>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-user-tie me-1"></i> Pengajar: Anda
                            </p>
                        </div>
                        
                        <div class="card-body px-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-book-open text-warning me-2"></i>
                                <small>Bank Soal: <strong>Kelola Disini</strong></small>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="far fa-calendar-alt text-success me-2"></i>
                                <small>Jadwal Ujian: <strong>Atur Waktu</strong></small>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-chart-line text-danger me-2"></i>
                                <small>Rekap Nilai: <strong>Pantau Hasil</strong></small>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-top-0 pb-4 px-4">
                            
                            <div class="row g-2 mb-2">
                                <div class="d-grid">
                                    <a href="<?= BASEURL; ?>/dosen/atur_jadwal/<?= $mk['id']; ?>" class="btn btn-success w-100 rounded-pill fw-bold" style="font-size: 0.85rem;">
                                        <i class="far fa-calendar-alt me-1"></i> Lihat Jadwal
                                    </a>
                                </div>
                            </div>

                            <div class="d-grid">
                                <a href="<?= BASEURL; ?>/dosen/nilai/<?= $mk['id']; ?>" class="btn btn-outline-secondary rounded-pill fw-bold">
                                    <i class="fas fa-chart-bar me-1"></i> Lihat Nilai
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>

    </div>
</div>