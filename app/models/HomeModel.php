<?php
class HomeModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Mengambil ujian yang sedang aktif & belum kadaluarsa
    // Mengambil SEMUA ujian yang statusnya aktif (termasuk yang sudah expired)
    public function getJadwalAktif() {
        // HAPUS atau KOMENTARI baris: AND j.waktu_selesai >= NOW()
        
        $query = "SELECT j.*, mk.nama_mk, mk.kode_mk 
                  FROM jadwal_ujian j
                  JOIN matakuliah mk ON j.id_mk = mk.id
                  WHERE j.status = 'aktif' 
                  ORDER BY j.waktu_mulai DESC"; 
                  // Saya ubah ke DESC agar ujian terbaru ada di urutan pertama
        
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getRiwayatUser($id_user) {
        // Tambahkan j.durasi_menit, j.waktu_mulai, j.waktu_selesai, mk.kode_mk
        $query = "SELECT r.*, 
                         j.nama_ujian, j.durasi_menit, j.waktu_mulai, j.waktu_selesai, 
                         mk.nama_mk, mk.kode_mk
                  FROM riwayat_ujian r
                  JOIN jadwal_ujian j ON r.id_jadwal = j.id
                  JOIN matakuliah mk ON j.id_mk = mk.id
                  WHERE r.id_user = :id_user
                  ORDER BY r.tgl_ujian DESC";
        
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }

    // Tambahkan di app/models/HomeModel.php
    public function getJadwalById($id) {
        $query = "SELECT j.*, mk.nama_mk 
                  FROM jadwal_ujian j
                  JOIN matakuliah mk ON j.id_mk = mk.id
                  WHERE j.id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}