<?php

class Auth extends Controller {
    
    public function index() {
        $this->login();
    }

    public function login() {
        // Jika sudah login, lempar ke dashboard sesuai role
        if(isset($_SESSION['user_id'])) {
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                header('Location: ' . BASEURL . '/admin');
            } else {
                header('Location: ' . BASEURL . '/ujian/mulai');
            }
            exit;
        }

        $data['judul'] = 'Selamat datang di MyUjian';
        $this->view('auth/login', $data);
        $this->view('anuan/footer');
    }

    public function prosesLogin() {
        if(isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model('UserModel')->getUserByUsername($username);

            if($user) {
                // Verifikasi Password Hash
                if(password_verify($password, $user['password'])) {
                    // Set Session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_nama'] = $user['nama'];
                    $_SESSION['user_role'] = $user['role']; 

                    // Cek Role untuk Redirect
                    if($user['role'] == 'admin'){
                        header('Location: ' . BASEURL . '/admin'); // Ke Panel Admin
                    } elseif ($user['role'] == 'dosen') {
                        header('Location: ' . BASEURL . '/dosen');  // Ke Panel Dosen
                    } else {
                        header('Location: ' . BASEURL . '/home'); // Ke Ujian Siswa
                    }
                    exit;
                }
            }
        }
        // Jika gagal login (Username/pass salah)
        header('Location: ' . BASEURL . '/auth/login');
        exit;
    }

    public function register() {
        $data['judul'] = 'Register - MyUjian';
        $this->view('auth/register', $data);
        $this->view('anuan/footer');
    }

    public function prosesRegister() {
        if($this->model('UserModel')->tambahUser($_POST) > 0) {
            // Berhasil register
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        } else {
            // Gagal register
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASEURL . '/auth/login');
        exit;
    }
}