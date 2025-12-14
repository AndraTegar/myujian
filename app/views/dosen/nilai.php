<div class="container" style="margin-top: 80px;">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/dosen" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rekap Nilai</li>
                    </ol>
                </nav>
                <h3 class="fw-bold text-dark mb-0">
                    <span class="text-primary"><?= $data['mk']['kode_mk']; ?></span> - <?= $data['mk']['nama_mk']; ?>
                </h3>
            </div>
            
            <a href="<?= BASEURL; ?>/dosen" class="btn btn-outline-secondary rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary"><i class="fas fa-table me-1"></i> Data Hasil Ujian Mahasiswa</h6>
                    <button onclick="window.print()" class="btn btn-sm btn-primary">
                        <i class="fas fa-print me-1"></i> Cetak Laporan
                    </button>
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Nama Mahasiswa</th>
                                <th width="20%">Nama Ujian</th>
                                <th width="15%">Tanggal Tes</th>
                                <th width="15%" class="text-center">Benar / Salah</th>
                                <th width="10%" class="text-center">Nilai</th>
                                <th width="10%" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($data['nilai_siswa'])) : ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="64" class="mb-3 opacity-50 d-block mx-auto">
                                        Belum ada data nilai untuk mata kuliah ini.
                                    </td>
                                </tr>
                            <?php else : ?>
                                <?php $no = 1; foreach($data['nilai_siswa'] as $n) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= $n['nama_siswa']; ?></div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border"><?= $n['nama_ujian']; ?></span>
                                    </td>
                                    <td class="small text-muted">
                                        <?= date('d/m/Y H:i', strtotime($n['tgl_ujian'])); ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-success fw-bold"><?= $n['benar']; ?></span> / 
                                        <span class="text-danger fw-bold"><?= $n['salah']; ?></span>
                                    </td>
                                    <td class="text-center fw-bold" style="font-size: 1.1rem;">
                                        <?= $n['nilai']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($n['nilai'] >= 70) : ?>
                                            <span class="badge bg-success rounded-pill px-3">LULUS</span>
                                        <?php else : ?>
                                            <span class="badge bg-danger rounded-pill px-3">REMIDI</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>