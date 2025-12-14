<?php
class Dosen extends Controller {
    
    public function __construct() {
        if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'dosen') {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Dashboard Dosen';
        $data['mk'] = $this->model('SoalModel')->getAllMatkul();
        $data['nama_dosen'] = $_SESSION['user_nama'];
        $this->view('dosen/header', $data);
        $this->view('dosen/index', $data);
        $this->view('anuan/footer');
    }

    // --- ALUR JADWAL & SOAL ---

    // 1. Masuk ke Halaman Daftar Jadwal
    public function atur_jadwal($id_mk) {
        $mk = $this->model('SoalModel')->getMatkulById($id_mk);
        $data['judul'] = 'Atur Jadwal - ' . $mk['nama_mk'];
        $data['mk'] = $mk;
        $data['jadwal'] = $this->model('SoalModel')->getJadwalByMatkul($id_mk);
        $this->view('dosen/header', $data);
        $this->view('dosen/jadwal_matkul', $data);
        $this->view('anuan/footer');
    }

    // 2. Masuk ke Halaman Daftar Soal (KHUSUS JADWAL INI)
    public function atur_soal($id_jadwal) {
        $jadwal = $this->model('SoalModel')->getJadwalById($id_jadwal);
        $mk = $this->model('SoalModel')->getMatkulById($jadwal['id_mk']);

        $data['judul'] = 'Bank Soal: ' . $jadwal['nama_ujian'];
        $data['jadwal'] = $jadwal; 
        $data['mk'] = $mk;
        // Panggil soal berdasarkan JADWAL
        $data['soal'] = $this->model('SoalModel')->getSoalByJadwal($id_jadwal);
        
        $this->view('dosen/header', $data);
        $this->view('dosen/soal_matkul', $data);
        $this->view('anuan/footer');
    }

    // 3. Form Tambah Soal
    public function tambah($id_jadwal) {
        $jadwal = $this->model('SoalModel')->getJadwalById($id_jadwal);
        $mk = $this->model('SoalModel')->getMatkulById($jadwal['id_mk']);
        
        $data['judul'] = 'Tambah Soal - ' . $jadwal['nama_ujian'];
        $data['jadwal'] = $jadwal;
        $data['mk'] = $mk; 
        $this->view('dosen/header', $data);
        $this->view('dosen/tambah', $data);
        $this->view('anuan/footer');
    }

    // 4. Proses Simpan Soal
    public function simpan() {
        $id_jadwal = $_POST['id_jadwal']; 
        
        if($this->model('SoalModel')->tambahSoal($_POST) > 0) {
            // REDIRECT KEMBALI KE HALAMAN SOAL JADWAL (Agar rapi)
            header('Location: ' . BASEURL . '/dosen/atur_soal/' . $id_jadwal);
            exit;
        } else {
             // Jika gagal pun tetap kembali ke sana
             header('Location: ' . BASEURL . '/dosen/atur_soal/' . $id_jadwal);
             exit;
        }
    }

    // 5. Hapus Soal
    public function hapus($id, $id_jadwal) {
        if($this->model('SoalModel')->hapusSoal($id) > 0) {
            header('Location: ' . BASEURL . '/dosen/atur_soal/' . $id_jadwal);
            exit;
        }
    }

    // --- ALUR NILAI ---
    public function nilai($id_mk) {
        $data['judul'] = 'Rekap Nilai';
        $data['mk'] = $this->model('SoalModel')->getMatkulById($id_mk);
        // Fungsi ini sekarang sudah ada di Model (Point 1)
        $data['nilai_siswa'] = $this->model('SoalModel')->getNilaiByMatkul($id_mk);
        $data['nama_dosen'] = $_SESSION['user_nama'];
        $this->view('dosen/header', $data);
        $this->view('dosen/nilai', $data);
        $this->view('anuan/footer');
    }

    // --- SISA CRUD JADWAL ---
    public function tambah_jadwal($id_mk) {
        $mk = $this->model('SoalModel')->getMatkulById($id_mk);
        $data['judul'] = 'Buat Jadwal Baru';
        $data['mk'] = $mk;
        $this->view('dosen/header', $data);
        $this->view('dosen/tambah_jadwal', $data);
        $this->view('anuan/footer');
    }

    public function simpan_jadwal() {
        $id_mk = $_POST['id_mk'];
        $this->model('SoalModel')->tambahJadwal($_POST);
        header('Location: ' . BASEURL . '/dosen/atur_jadwal/' . $id_mk);
    }

    public function hapus_jadwal($id, $id_mk) {
        $this->model('SoalModel')->hapusJadwal($id);
        header('Location: ' . BASEURL . '/dosen/atur_jadwal/' . $id_mk);
    }

    public function ubah_jadwal($id, $id_mk) {
        $data['judul'] = 'Edit Jadwal';
        $data['mk'] = $this->model('SoalModel')->getMatkulById($id_mk);
        $data['jadwal'] = $this->model('SoalModel')->getJadwalById($id);
        $this->view('dosen/header', $data);
        $this->view('dosen/ubah_jadwal', $data);
        $this->view('anuan/footer');
    }

    public function proses_ubah_jadwal() {
        $id_mk = $_POST['id_mk'];
        $this->model('SoalModel')->ubahJadwal($_POST);
        header('Location: ' . BASEURL . '/dosen/atur_jadwal/' . $id_mk);
    }

    // 1. Tampilkan Form Edit
    public function ubah_soal($id_soal) {
        // Ambil data soal berdasarkan ID
        $soal = $this->model('SoalModel')->getSoalById($id_soal);
        
        // Ambil data Jadwal & MK untuk Header (Navigasi)
        $jadwal = $this->model('SoalModel')->getJadwalById($soal['id_jadwal']);
        $mk = $this->model('SoalModel')->getMatkulById($jadwal['id_mk']);

        $data['judul'] = 'Edit Soal - ' . $jadwal['nama_ujian'];
        $data['soal'] = $soal;
        $data['jadwal'] = $jadwal;
        $data['mk'] = $mk;

        $this->view('dosen/header', $data);
        $this->view('dosen/ubah', $data);
        $this->view('anuan/footer');
    }

    // 2. Proses Simpan Perubahan
    public function proses_ubah_soal() {
        // Panggil model untuk update
        if($this->model('SoalModel')->updateSoal($_POST) > 0) {
            // Redirect kembali ke daftar soal
            header('Location: ' . BASEURL . '/dosen/atur_soal/' . $_POST['id_jadwal']);
            exit;
        } else {
            // Jika tidak ada perubahan atau gagal, tetap kembali
            header('Location: ' . BASEURL . '/dosen/atur_soal/' . $_POST['id_jadwal']);
            exit;
        }
    }
}