<div style="margin-top: 80px;">
    
    <header class="bg-dark text-white py-5 mb-4 shadow-sm" style="background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="fw-bold mb-1">Administrator Panel</h1>
                    <p class="mb-0 opacity-75">Pusat kontrol data master, pengguna, dan konfigurasi sistem.</p>
                </div>
                <div class="col-md-4 text-end d-none d-md-block">
                    <i class="fas fa-cogs fa-4x opacity-25"></i>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        
        <div class="row mb-5">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 py-2 border-start border-4 border-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Dosen</div>
                                <div class="h3 mb-0 fw-bold text-dark"><?= $data['total_dosen']; ?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-chalkboard-teacher fa-2x text-gray-300 opacity-25"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 py-2 border-start border-4 border-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">Total Mahasiswa</div>
                                <div class="h3 mb-0 fw-bold text-dark"><?= $data['total_siswa']; ?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300 opacity-25"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 py-2 border-start border-4 border-info">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-info text-uppercase mb-1">Mata Kuliah</div>
                                <div class="h3 mb-0 fw-bold text-dark"><?= $data['total_mk']; ?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-book fa-2x text-gray-300 opacity-25"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 py-2 border-start border-4 border-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-warning text-uppercase mb-1">Ujian Aktif</div>
                                <div class="h3 mb-0 fw-bold text-dark"><?= $data['total_ujian']; ?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-clock fa-2x text-gray-300 opacity-25"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="fw-bold text-secondary mb-3 ms-1">Menu Manajemen Master</h5>
        <div class="row">
            
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0 card-menu hover-card">
                    <div class="card-body text-center p-4">
                        <div class="bg-light rounded-circle d-inline-flex p-3 mb-3 text-primary">
                            <i class="fas fa-user-tie fa-2x"></i>
                        </div>
                        <h5 class="fw-bold">Data Dosen</h5>
                        <p class="text-muted small">Tambah, edit, hapus akun dosen dan reset password.</p>
                        <a href="<?= BASEURL; ?>/admin/dosen" class="btn btn-outline-primary rounded-pill btn-sm px-4 stretched-link">Kelola</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0 card-menu hover-card">
                    <div class="card-body text-center p-4">
                        <div class="bg-light rounded-circle d-inline-flex p-3 mb-3 text-success">
                            <i class="fas fa-user-graduate fa-2x"></i>
                        </div>
                        <h5 class="fw-bold">Data Mahasiswa</h5>
                        <p class="text-muted small">Import data mahasiswa, atur kelas, dan semester.</p>
                        <a href="<?= BASEURL; ?>/admin/mahasiswa" class="btn btn-outline-success rounded-pill btn-sm px-4 stretched-link">Kelola</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0 card-menu hover-card">
                    <div class="card-body text-center p-4">
                        <div class="bg-light rounded-circle d-inline-flex p-3 mb-3 text-info">
                            <i class="fas fa-book-open fa-2x"></i>
                        </div>
                        <h5 class="fw-bold">Mata Kuliah</h5>
                        <p class="text-muted small">List mata kuliah dan relasi dengan dosen pengampu.</p>
                        <a href="<?= BASEURL; ?>/admin/matkul" class="btn btn-outline-info rounded-pill btn-sm px-4 stretched-link">Kelola</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .hover-card { transition: transform 0.2s, box-shadow 0.2s; }
    .hover-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
</style>