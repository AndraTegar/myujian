<?php
class Home extends Controller {
    public function __construct() {
        // Cek Login
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Home - MyUjian';
        $data['user'] = $_SESSION['user_nama'];
        
        // Load Model
        $model = $this->model('HomeModel');
        
        // Ambil Data
        $data['ujian_tersedia'] = $model->getJadwalAktif();
        $data['riwayat'] = $model->getRiwayatUser($_SESSION['user_id']);

        $this->view('home/header', $data);
        $this->view('home/index', $data);
        $this->view('anuan/footer');
    }
}