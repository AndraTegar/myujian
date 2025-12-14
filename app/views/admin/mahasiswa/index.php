<div class="container" style="margin-top: 80px;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-success"><i class="fas fa-user-graduate me-2"></i>Manajemen Mahasiswa</h3>
        <a href="<?= BASEURL; ?>/admin/tambah_user" class="btn btn-success shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Mahasiswa
        </a>
    </div>

    <div class="card border-0 shadow-sm border-top border-success border-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Username / NIM</th>
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['mahasiswa'])) : ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-info-circle fa-2x mb-3 d-block"></i>
                                    Belum ada data mahasiswa.
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php $no=1; foreach($data['mahasiswa'] as $m) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                
                                <td class="fw-bold"><?= $m['nama']; ?></td>
                                
                                <td class="font-monospace"><?= $m['username']; ?></td>
                                
                                <td><span class="badge bg-secondary"><?= $m['role']; ?></span></td>

                                <td class="text-center">
                                    <a href="<?= BASEURL; ?>/admin/edit_user/<?= $m['id']; ?>" class="btn btn-outline-warning btn-sm me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= BASEURL; ?>/admin/hapus_user/<?= $m['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus mahasiswa atas nama <?= $m['nama']; ?>?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
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