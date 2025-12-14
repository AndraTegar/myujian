<div class="container" style="margin-top: 80px;">
    
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0 fw-bold">
                        <?= $data['is_edit'] ? 'Edit Data Pengguna' : 'Tambah Pengguna Baru'; ?>
                    </h5>
                </div>
                <div class="card-body p-4">
                    
                    <form action="<?= BASEURL; ?>/admin/simpan_user" method="POST">
                        
                        <?php if($data['is_edit']): ?>
                            <input type="hidden" name="id" value="<?= $data['user']['id']; ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" 
                                   value="<?= $data['is_edit'] ? $data['user']['nama'] : ''; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Username / NIP / NIM</label>
                            <input type="text" name="username" class="form-control" 
                                   value="<?= $data['is_edit'] ? $data['user']['username'] : ''; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" 
                                   placeholder="<?= $data['is_edit'] ? '(Biarkan kosong jika tidak ingin mengubah)' : 'Masukan password...'; ?>" 
                                   <?= $data['is_edit'] ? '' : 'required'; ?>>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Role (Hak Akses)</label>
                            <select name="role" class="form-select bg-light border-primary" required>
                                <option value="" disabled selected>-- Pilih Role --</option>
                                
                                <option value="dosen" 
                                    <?= ($data['is_edit'] && $data['user']['role'] == 'dosen') ? 'selected' : ''; ?>>
                                    Dosen
                                </option>
                                
                                <option value="mahasiswa" 
                                    <?= ($data['is_edit'] && $data['user']['role'] == 'mahasiswa') ? 'selected' : ''; ?>>
                                    Mahasiswa
                                </option>
                                
                                <option value="admin" 
                                    <?= ($data['is_edit'] && $data['user']['role'] == 'admin') ? 'selected' : ''; ?>>
                                    Administrator
                                </option>
                            </select>
                            <div class="form-text">Pilih peran pengguna ini dalam sistem.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold">Simpan Data</button>
                            <a href="<?= BASEURL; ?>/admin" class="btn btn-outline-secondary">Batal</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>