<?php
class Admin extends Controller {
    
    public function __construct() {
        // Cek Login & Role Admin
        if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Dashboard Administrator';
        
        // Data Statistik untuk Dashboard
        $data['total_dosen'] = $this->model('UserModel')->countDosen();
        $data['total_siswa'] = $this->model('UserModel')->countMahasiswa();
        $data['total_mk']    = $this->model('SoalModel')->countMatkul();
        $data['total_ujian'] = $this->model('SoalModel')->countJadwalAktif();
        
        $this->view('admin/header', $data);
        $this->view('admin/index', $data);
        $this->view('anuan/footer');
    }

    // --- MANAJEMEN DOSEN ---
    public function dosen() {
        $data['judul'] = 'Kelola Data Dosen';
        $data['dosen'] = $this->model('UserModel')->getAllDosen(); 
        
        $this->view('admin/header', $data);
        $this->view('admin/dosen/index', $data);
        $this->view('anuan/footer');
    }

    // --- MANAJEMEN MAHASISWA ---
    public function mahasiswa() {
        $data['judul'] = 'Kelola Data Mahasiswa';
        $data['mahasiswa'] = $this->model('UserModel')->getAllMahasiswa();
        
        $this->view('admin/header', $data);
        $this->view('admin/mahasiswa/index', $data);
        $this->view('anuan/footer');
    }

    // --- FITUR KELOLA USER (GENERIC) ---

    // 1. Tampilkan Form Tambah
    public function tambah_user() {
        $data['judul'] = 'Tambah Pengguna Baru';
        $data['is_edit'] = false; // Penanda ini mode tambah
        
        $this->view('admin/header', $data);
        $this->view('admin/form_user', $data);
        $this->view('anuan/footer');
    }

    // 2. Tampilkan Form Edit
    public function edit_user($id = null) { // Tambahkan = null untuk jaga-jaga
        
        // 1. CEK APAKAH ID DITERIMA CONTROLLER
        if ($id == null) {
            echo "<h1>ERROR: ID Kosong!</h1>";
            echo "Controller tidak menerima angka ID dari URL.";
            die();
        }

        $data['judul'] = 'Edit Pengguna';
        $data['is_edit'] = true; 
        
        // 2. CEK APAKAH MODEL MENEMUKAN DATA
        $data['user'] = $this->model('UserModel')->getUserById($id);

        if ($data['user'] == false) {
            echo "<h1>ERROR: Data Tidak Ditemukan!</h1>";
            echo "ID yang dicari: <strong>" . $id . "</strong><br>";
            echo "Tapi di tabel 'users', ID tersebut TIDAK ADA.";
            die();
        }

        // Jika lolos kedua cek di atas, baru tampilkan View
        $this->view('admin/header', $data);
        $this->view('admin/form_user', $data);
        $this->view('anuan/footer');
    }

    // 3. Proses Simpan (Bisa Tambah atau Update)
    public function simpan_user() {
        // Cek apakah ini Update (ada ID) atau Insert (tidak ada ID)
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Proses Update
            if ($this->model('UserModel')->updateUser($_POST) > 0) {
                // Redirect sesuai role agar kembali ke halaman yang tepat
                $role = $_POST['role'];
                header('Location: ' . BASEURL . '/admin/' . ($role == 'dosen' ? 'dosen' : 'mahasiswa'));
                exit;
            }
        } else {
            // Proses Tambah Baru
            if ($this->model('UserModel')->tambahUser($_POST) > 0) {
                $role = $_POST['role'];
                header('Location: ' . BASEURL . '/admin/' . ($role == 'dosen' ? 'dosen' : 'mahasiswa'));
                exit;
            }
        }
        
        // Default redirect jika gagal
        header('Location: ' . BASEURL . '/admin');
        exit;
    }

    public function hapus_user($id) {
        // Panggil Model hapusUser
        if ($this->model('UserModel')->hapusUser($id) > 0) {
            // Jika berhasil, kembali ke halaman sebelumnya (Smart Redirect)
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            // Jika gagal
            header('Location: ' . BASEURL . '/admin');
            exit;
        }
    }
    // --- MANAJEMEN MATKUL ---
    public function matkul() {
        $data['judul'] = 'Kelola Mata Kuliah';
        $data['matkul'] = $this->model('SoalModel')->getAllMatkul();
        
        $this->view('admin/header', $data);
        $this->view('admin/matkul/index', $data);
        $this->view('anuan/footer');
    }
    // --- MANAJEMEN MATA KULIAH ---

    // 1. Tampilkan Form Tambah
    public function tambah_matkul() {
        $data['judul'] = 'Tambah Mata Kuliah';
        
        $this->view('admin/header', $data);
        $this->view('admin/matkul/tambah', $data);
        $this->view('anuan/footer');
    }

    // 2. Proses Simpan ke Database
    public function simpan_matkul() {
        if($this->model('SoalModel')->tambahMatkul($_POST) > 0) {
            // Berhasil, kembali ke list matkul
            header('Location: ' . BASEURL . '/admin/matkul');
            exit;
        } else {
            // Gagal (opsional: bisa tambah flash message)
            header('Location: ' . BASEURL . '/admin/matkul');
            exit;
        }
    }

    public function hapus_matkul($id) {
        // Panggil Model hapusMatkul
        if ($this->model('SoalModel')->hapusMatkul($id) > 0) {
            // Berhasil: Kembali ke halaman list mata kuliah
            header('Location: ' . BASEURL . '/admin/matkul');
            exit;
        } else {
            // Gagal: Tetap kembali (opsional: bisa tambah flash message)
            header('Location: ' . BASEURL . '/admin/matkul');
            exit;
        }
    }
}