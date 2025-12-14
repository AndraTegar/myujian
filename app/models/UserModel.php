<?php
class UserModel {
    private $table = 'users'; // Nama tabel database Anda
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // --- FUNGSI BARU YANG WAJIB DITAMBAHKAN AGAR ADMIN TIDAK ERROR ---
    
    public function countDosen() {
        // Menghitung user yang role-nya 'dosen'
        $this->db->query("SELECT COUNT(*) as total FROM " . $this->table . " WHERE role = 'dosen'");
        $result = $this->db->single();
        return $result['total'];
    }

    public function countMahasiswa() {
        // Menghitung user yang role-nya 'mahasiswa'
        $this->db->query("SELECT COUNT(*) as total FROM " . $this->table . " WHERE role = 'mahasiswa'");
        $result = $this->db->single();
        return $result['total'];
    }

    // ------------------------------------------------------------------

    public function tambahUser($data) {
        $query = "INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, :role)";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        // Pastikan ada input role saat tambah user, atau default ke 'mahasiswa'
        $role = isset($data['role']) ? $data['role'] : 'mahasiswa';
        $this->db->bind('role', $role);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getUserByUsername($username) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username=:username');
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    // Ambil 1 data user berdasarkan ID (untuk Edit)
    public function getUserById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
        
    }

    // Update User (Termasuk Ganti Role)
    public function updateUser($data) {
        // Cek apakah password diisi atau kosong
        if (!empty($data['password'])) {
            // Jika password diisi, update passwordnya juga
            $query = "UPDATE " . $this->table . " SET 
                        nama = :nama, 
                        username = :username, 
                        password = :password, 
                        role = :role 
                      WHERE id = :id";
        } else {
            // Jika password kosong, jangan ubah password lama
            $query = "UPDATE " . $this->table . " SET 
                        nama = :nama, 
                        username = :username, 
                        role = :role 
                      WHERE id = :id";
        }

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('role', $data['role']); // <--- INI KUNCINYA
        $this->db->bind('id', $data['id']);

        if (!empty($data['password'])) {
            $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        }

        $this->db->execute();
        return $this->db->rowCount();
    }
    
    // --- TAMBAHAN UNTUK ADMIN ---
    public function getAllUsers() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function hapusUser($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getAllDosen() {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE role = 'dosen' ORDER BY nama ASC");
        return $this->db->resultSet();
    }

    public function getAllMahasiswa() {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE role = 'mahasiswa' ORDER BY nama ASC");
        return $this->db->resultSet();
    }
}