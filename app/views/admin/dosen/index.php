<div class="container" style="margin-top: 80px;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary"><i class="fas fa-chalkboard-teacher me-2"></i>Manajemen Dosen</h3>
        <a href="<?= BASEURL; ?>/admin/tambah_user" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Dosen
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>Nama Lengkap</th>
                        <th>Username / NIP</th>
                        <th class="text-center">Role</th>
                        <th class="text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['dosen'])) : ?>
                        <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada data dosen.</td></tr>
                    <?php else : ?>
                        <?php $no=1; foreach($data['dosen'] as $d) : ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="fw-bold"><?= $d['nama']; ?></td>
                            <td><?= $d['username']; ?></td>
                            <td class="text-center"><span class="badge bg-info text-dark">Dosen</span></td>
                            <td class="text-center">
                                <a href="<?= BASEURL; ?>/admin/edit_user/<?= $d['id']; ?>" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?= BASEURL; ?>/admin/hapus_user/<?= $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus dosen ini?')">
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