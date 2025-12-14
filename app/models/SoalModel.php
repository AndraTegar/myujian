<?php

class SoalModel {
    private $table = 'soal';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // =========================================================================
    // BAGIAN 1: UMUM (MATKUL & JADWAL)
    // =========================================================================

    public function getAllMatkul() {
        $this->db->query('SELECT * FROM matakuliah');
        return $this->db->resultSet();
    }

    public function getMatkulById($id) {
        $this->db->query('SELECT * FROM matakuliah WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getJadwalByMatkul($id_mk) {
        $this->db->query("SELECT * FROM jadwal_ujian WHERE id_mk = :id_mk ORDER BY id DESC");
        $this->db->bind('id_mk', $id_mk);
        return $this->db->resultSet();
    }

    public function getJadwalById($id) {
        $this->db->query("SELECT * FROM jadwal_ujian WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // =========================================================================
    // BAGIAN 2: FITUR DOSEN (KELOLA SOAL & JADWAL)
    // =========================================================================

    // Ambil soal berdasarkan JADWAL (Penting untuk Dosen & Siswa)
    public function getSoalByJadwal($id_jadwal) {
        // Ambil soal secara acak (RAND) agar urutan tiap siswa beda (Opsional)
        // Atau urut id ASC agar dosen mudah mengedit
        $this->db->query("SELECT * FROM soal WHERE id_jadwal = :id_jadwal ORDER BY id ASC");
        $this->db->bind('id_jadwal', $id_jadwal);
        return $this->db->resultSet();
    }

    public function getSoalById($id) {
        $this->db->query("SELECT * FROM soal WHERE id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // Tambah Soal (Dengan id_jadwal)
    public function tambahSoal($data) {
        $query = "INSERT INTO soal (id_mk, id_jadwal, soal, a, b, c, d, e, kunci) 
                  VALUES (:id_mk, :id_jadwal, :soal, :a, :b, :c, :d, :e, :kunci)";
        
        $this->db->query($query);
        $this->db->bind('id_mk', $data['id_mk']);
        $this->db->bind('id_jadwal', $data['id_jadwal']);
        $this->db->bind('soal', $data['soal']);
        $this->db->bind('a', $data['a']);
        $this->db->bind('b', $data['b']);
        $this->db->bind('c', $data['c']);
        $this->db->bind('d', $data['d']);
        $this->db->bind('e', $data['e']);
        $this->db->bind('kunci', $data['kunci']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusSoal($id) {
        $query = "DELETE FROM soal WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateSoal($data) {
        $query = "UPDATE soal SET 
                    soal = :soal,
                    a = :a,
                    b = :b,
                    c = :c,
                    d = :d,
                    e = :e,
                    kunci = :kunci
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('soal', $data['soal']);
        $this->db->bind('a', $data['a']);
        $this->db->bind('b', $data['b']);
        $this->db->bind('c', $data['c']);
        $this->db->bind('d', $data['d']);
        $this->db->bind('e', $data['e']);
        $this->db->bind('kunci', $data['kunci']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // Dosen Melihat Rekap Nilai
    public function getNilaiByMatkul($id_mk) {
        $query = "SELECT r.*, u.nama as nama_siswa, j.nama_ujian 
                  FROM riwayat_ujian r
                  JOIN users u ON r.id_user = u.id
                  JOIN jadwal_ujian j ON r.id_jadwal = j.id
                  WHERE j.id_mk = :id_mk
                  ORDER BY j.id DESC, r.nilai DESC";
        
        $this->db->query($query);
        $this->db->bind('id_mk', $id_mk);
        return $this->db->resultSet();
    }

    // CRUD Jadwal
    public function tambahJadwal($data) {
        $query = "INSERT INTO jadwal_ujian (id_mk, nama_ujian, waktu_mulai, waktu_selesai, durasi_menit)
                  VALUES (:id_mk, :nama_ujian, :waktu_mulai, :waktu_selesai, :durasi_menit)";
        $this->db->query($query);
        $this->db->bind('id_mk', $data['id_mk']);
        $this->db->bind('nama_ujian', $data['nama_ujian']);
        $this->db->bind('waktu_mulai', $data['waktu_mulai']);
        $this->db->bind('waktu_selesai', $data['waktu_selesai']);
        $this->db->bind('durasi_menit', $data['durasi_menit']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusJadwal($id) {
        $this->db->query("DELETE FROM soal WHERE id_jadwal = :id");
        $this->db->bind('id', $id);
        $this->db->execute();

        $this->db->query("DELETE FROM jadwal_ujian WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahJadwal($data) {
        $query = "UPDATE jadwal_ujian SET 
                    nama_ujian = :nama_ujian,
                    waktu_mulai = :waktu_mulai,
                    waktu_selesai = :waktu_selesai,
                    durasi_menit = :durasi_menit
                  WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('nama_ujian', $data['nama_ujian']);
        $this->db->bind('waktu_mulai', $data['waktu_mulai']);
        $this->db->bind('waktu_selesai', $data['waktu_selesai']);
        $this->db->bind('durasi_menit', $data['durasi_menit']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // --- TAMBAHKAN DI DALAM CLASS SOALMODEL ---

    public function hapusMatkul($id) {
        // Query hapus data
        // Pastikan nama tabel BENAR ('matakuliah')
        $query = "DELETE FROM matakuliah WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);
        
        $this->db->execute();
        return $this->db->rowCount();
    }
    // =========================================================================
    // BAGIAN 3: FITUR SISWA (UJIAN & SIMPAN NILAI) - INI YANG KEMARIN HILANG
    // =========================================================================

    // 1. Cek apakah siswa sudah mengerjakan ujian ini?
    public function cekSudahMengerjakan($id_user, $id_jadwal) {
        $this->db->query("SELECT * FROM riwayat_ujian WHERE id_user = :id_user AND id_jadwal = :id_jadwal");
        $this->db->bind('id_user', $id_user);
        $this->db->bind('id_jadwal', $id_jadwal);
        return $this->db->rowCount(); // Mengembalikan 1 jika sudah, 0 jika belum
    }

    // 2. Simpan Nilai Siswa setelah selesai ujian
    public function simpanRiwayat($data) {
        $query = "INSERT INTO riwayat_ujian (id_user, id_jadwal, benar, salah, nilai, tgl_ujian)
                  VALUES (:id_user, :id_jadwal, :benar, :salah, :nilai, NOW())";
        
        $this->db->query($query);
        $this->db->bind('id_user', $data['id_user']);
        $this->db->bind('id_jadwal', $data['id_jadwal']);
        $this->db->bind('benar', $data['benar']);
        $this->db->bind('salah', $data['salah']);
        $this->db->bind('nilai', $data['nilai']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    // 3. Ambil Riwayat Ujian Siswa (Untuk Dashboard Siswa)
    public function getRiwayatByUser($id_user) {
        $query = "SELECT r.*, j.nama_ujian, m.nama_mk, m.kode_mk, j.waktu_mulai, j.durasi_menit
                  FROM riwayat_ujian r
                  JOIN jadwal_ujian j ON r.id_jadwal = j.id
                  JOIN matakuliah m ON j.id_mk = m.id
                  WHERE r.id_user = :id_user
                  ORDER BY r.tgl_ujian DESC";
        
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }

    // 4. Ambil Daftar Ujian yang Tersedia (Belum dikerjakan + Waktunya pas)
    public function getUjianTersedia($id_user) {
        // Logikanya: Ambil semua jadwal, nanti di Controller difilter mana yang sudah dikerjakan
        $query = "SELECT j.*, m.nama_mk, m.kode_mk 
                  FROM jadwal_ujian j
                  JOIN matakuliah m ON j.id_mk = m.id
                  ORDER BY j.waktu_mulai ASC";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    // ... (kode-kode yang sudah ada sebelumnya) ...

    // --- TAMBAHAN KHUSUS UNTUK DASHBOARD ADMIN ---

    public function countMatkul() {
        // Menghitung total baris di tabel mata kuliah
        // Pastikan nama tabelnya sesuai (tbl_matkul atau matkul)
        $this->db->query('SELECT COUNT(*) as total FROM matakuliah');
        $result = $this->db->single();
        return $result['total'];
    }

    public function countJadwalAktif() {
        // Menghitung jadwal yang waktu selesainya LEBIH BESAR dari waktu sekarang (NOW)
        // Artinya ujian belum expired
        $this->db->query("SELECT COUNT(*) as total FROM jadwal_ujian WHERE waktu_selesai > NOW()");
        $result = $this->db->single();
        return $result['total'];
    }

    // --- TAMBAHKAN DI DALAM CLASS SOALMODEL ---

    public function tambahMatkul($data) {
        // Query Insert
        $query = "INSERT INTO matakuliah (kode_mk, nama_mk) VALUES (:kode_mk, :nama_mk)";
        
        $this->db->query($query);
        $this->db->bind('kode_mk', $data['kode_mk']);
        $this->db->bind('nama_mk', $data['nama_mk']);

        $this->db->execute();
        return $this->db->rowCount();
    }
    // --- TAMBAHAN UNTUK FITUR ACAK SOAL ---

    // 1. Ambil Hanya ID Soal Saja (Untuk diacak di Controller)
    public function getAllIdSoal($id_jadwal) {
        $this->db->query("SELECT id FROM soal WHERE id_jadwal = :id");
        $this->db->bind('id', $id_jadwal);
        $result = $this->db->resultSet();
        
        // Hasilnya array of object/assoc, kita ubah jadi array biasa: [1, 5, 2, 8]
        return array_column($result, 'id');
    }

    // 2. Ambil Detail Soal Berdasarkan Urutan ID yang sudah diacak
    public function getSoalByUrutan($array_id) {
        if(empty($array_id)) return [];

        // Ubah array [1, 5, 2] menjadi string "1,5,2"
        $ids = implode(',', $array_id);
        
        // ORDER BY FIELD adalah trik MySQL agar urutan sesuai yang kita kirim
        $query = "SELECT * FROM soal WHERE id IN ($ids) ORDER BY FIELD(id, $ids)";
        
        $this->db->query($query);
        return $this->db->resultSet();
    }
} // <--- Batas Akhir Class