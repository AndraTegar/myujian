<?php
class Ujian extends Controller {
    
    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index() {
        header('Location: ' . BASEURL); // Balik ke home kalau akses /ujian doang
        exit;
    }

    // Menangani URL: /ujian/konfirmasi/1 (Dimana 1 adalah ID Jadwal)
    public function konfirmasi($id_jadwal) {
        // Cek dulu jadwalnya valid gak
        $jadwal = $this->model('HomeModel')->getJadwalById($id_jadwal);
        if(!$jadwal) {
            header('Location: ' . BASEURL);
            exit;
        }

        // Langsung lempar ke halaman mulai
        $this->mulai($id_jadwal);
    }

    // Tambahkan parameter $no_soal dengan default 1
    public function mulai($id_jadwal, $no_soal = 1) {
        
        // === 1. SATPAM: CEK APAKAH SUDAH SELESAI? ===
        $id_user = $_SESSION['user_id'];
        
        // Panggil fungsi model yang baru kita buat
        $sudah_kerja = $this->model('SoalModel')->cekSudahMengerjakan($id_user, $id_jadwal);

        if ($sudah_kerja > 0) {
            // Jika sudah mengerjakan, tampilkan pesan dan tendang ke Home
            echo "<script>
                    alert('Anda sudah menyelesaikan ujian ini! Tidak bisa masuk kembali.');
                    window.location.href = '" . BASEURL . "/home';
                  </script>";
            exit;
        }
        // ============================================
        // 1. Ambil Info Jadwal
        $jadwal = $this->model('HomeModel')->getJadwalById($id_jadwal);
        
        // 2. Ambil SEMUA Soal (Untuk menghitung total & navigasi)
        // Kita gunakan session agar urutan soal acak tidak berubah-ubah saat klik next
        // 2. Ambil SEMUA Soal (LOGIKA BARU: ACAK PER USER)
        // Kita gunakan session agar urutan soal acak tidak berubah saat refresh/next
        if (!isset($_SESSION['soal_ujian_' . $id_jadwal])) {
            
            // A. Ambil semua ID soal milik jadwal ini
            $semua_id = $this->model('SoalModel')->getAllIdSoal($id_jadwal);
            
            // B. Acak urutan ID-nya menggunakan fungsi PHP
            shuffle($semua_id); 
            // Sekarang $semua_id isinya acak, misal: [5, 2, 10, 1]
            
            // C. Ambil detail soal lengkap berdasarkan urutan ID yang sudah diacak tadi
            $soal_acak = $this->model('SoalModel')->getSoalByUrutan($semua_id);
            
            // D. Simpan hasil acak ke Session
            $_SESSION['soal_ujian_' . $id_jadwal] = $soal_acak;
        }
        $semua_soal = $_SESSION['soal_ujian_' . $id_jadwal];

        // 3. Logika Pagination (Ambil 1 soal saja)
        $total_soal = count($semua_soal);
        $index = $no_soal - 1; // Karena array mulai dari 0

        // Cegah error jika user akses nomor soal yang tidak ada
        if ($index < 0 || $index >= $total_soal) {
             // Redirect paksa ke nomor 1
             header('Location: ' . BASEURL . '/ujian/mulai/' . $id_jadwal . '/1');
             exit;
        }

        // Ambil 1 soal sesuai nomor aktif
        $soal_saat_ini = $semua_soal[$index];

        // 4. Siapkan Data Lengkap untuk View
        $data['judul'] = 'Ujian Berlangsung';
        $data['id_jadwal'] = $id_jadwal;
        $data['nama_ujian'] = $jadwal['nama_ujian']; // Mengatasi error "Undefined array key 'nama_ujian'"
        $data['waktu'] = $jadwal['durasi_menit'];
        
        $data['nomor_soal_aktif'] = $no_soal; // Mengatasi error "nomor_soal_aktif"
        $data['total_soal'] = $total_soal;
        $data['soal_saat_ini'] = $soal_saat_ini; // Mengatasi error "Undefined variable $soal_saat_ini"

        $this->view('ujian/lembar_soal', $data);
        $this->view('anuan/footer');
    }

    // 1. FUNGSI MENYIMPAN JAWABAN SEMENTARA (AJAX)
    public function simpan_jawaban() {
        // Ambil data dari Javascript
        $id_jadwal = $_POST['id_jadwal'];
        $id_soal = $_POST['id_soal'];
        $jawaban = $_POST['jawaban'];

        // Simpan ke SESSION
        // Struktur: $_SESSION['ujian'][id_jadwal][id_soal] = 'A';
        if (!isset($_SESSION['ujian'])) {
            $_SESSION['ujian'] = [];
        }
        if (!isset($_SESSION['ujian'][$id_jadwal])) {
            $_SESSION['ujian'][$id_jadwal] = [];
        }

        $_SESSION['ujian'][$id_jadwal][$id_soal] = $jawaban;
        
        echo "Tersimpan"; // Respon ke JS
    }

    // 2. FUNGSI SUBMIT (HITUNG NILAI AKHIR)
    public function submit() {
        $id_jadwal = $_POST['id_jadwal'];
        
        // Ambil semua soal asli dari database untuk melihat Kunci Jawaban
        // Kita ambil dari session soal yang sudah di-generate di method 'mulai'
        if(!isset($_SESSION['soal_ujian_' . $id_jadwal])) {
            // Jika session hilang, ambil ulang dari DB (safety)
            $jadwal = $this->model('HomeModel')->getJadwalById($id_jadwal);
            $semua_soal = $this->model('SoalModel')->getSoalByJadwal($id_jadwal);
        } else {
            $semua_soal = $_SESSION['soal_ujian_' . $id_jadwal];
        }

        // Ambil Jawaban Siswa dari Session (Hasil Langkah 1)
        $jawaban_siswa = isset($_SESSION['ujian'][$id_jadwal]) ? $_SESSION['ujian'][$id_jadwal] : [];

        $benar = 0;
        $salah = 0;
        $kosong = 0;

        foreach ($semua_soal as $s) {
            $id_soal = $s['id'];
            $kunci = strtoupper($s['kunci']); // Kunci dari DB
            
            // Cek apakah siswa menjawab soal ini?
            if (isset($jawaban_siswa[$id_soal])) {
                $jawaban_pilih = strtoupper($jawaban_siswa[$id_soal]);
                
                if ($jawaban_pilih == $kunci) {
                    $benar++;
                } else {
                    $salah++;
                }
            } else {
                $kosong++;
                $salah++; // Tidak dijawab dianggap salah
            }
        }

        // Hitung Nilai (Skala 100)
        $total_soal = count($semua_soal);
        $score = ($benar / $total_soal) * 100;

        // Siapkan Data untuk Disimpan ke Database
        $data_simpan = [
            'id_user' => $_SESSION['user_id'],
            'id_jadwal' => $id_jadwal,
            'nilai' => $score,
            'benar' => $benar,
            'salah' => $salah
        ];

        // Simpan ke Database
        if ($this->model('SoalModel')->simpanRiwayat($data_simpan) > 0) {
            // Hapus Session Ujian agar bersih
            unset($_SESSION['ujian'][$id_jadwal]);
            unset($_SESSION['soal_ujian_' . $id_jadwal]);
            
            // Redirect ke Halaman Hasil
            // Pastikan Anda punya view/method untuk menampilkan hasil, atau kembali ke home
            header('Location: ' . BASEURL . '/home'); 
        } else {
            echo "Gagal menyimpan riwayat.";
        }
    }

    public function nilai() {
        // 1. Ambil ID Jadwal dari Hidden Input Form
        $id_jadwal = $_POST['id_jadwal'];
        
        // Ambil info jadwal lagi untuk tau ID Matkulnya
        $jadwal = $this->model('HomeModel')->getJadwalById($id_jadwal);
        
        // 2. Ambil Jawaban User
        $jawabanUser = isset($_POST['jawaban']) ? $_POST['jawaban'] : [];
        
        // 3. Ambil Kunci Jawaban (Hanya soal matkul ini)
        $soalDb = $this->model('SoalModel')->getSoalByMatkul($jadwal['id_mk']);
        
        $benar = 0;
        $totalSoal = count($soalDb);

        foreach($soalDb as $s) {
            $id = $s['id'];
            if(isset($jawabanUser[$id]) && $jawabanUser[$id] == $s['kunci']) {
                $benar++;
            }
        }
        
        $salah = $totalSoal - $benar;
        $skor = ($totalSoal > 0) ? ($benar / $totalSoal) * 100 : 0;

        // 4. SIMPAN KE DATABASE RIWAYAT (PENTING!)
        $dataSimpan = [
            'id_user' => $_SESSION['user_id'],
            'id_jadwal' => $id_jadwal,
            'nilai' => $skor,
            'benar' => $benar,
            'salah' => $salah
        ];
        
        $this->model('SoalModel')->simpanRiwayat($dataSimpan);

        // 5. Tampilkan Hasil
        $data['judul'] = 'Hasil Ujian';
        $data['benar'] = $benar;
        $data['total'] = $totalSoal;
        $data['skor'] = $skor;
        
        $this->view('ujian/hasil', $data);
        $this->view('anuan/footer');
    }
}