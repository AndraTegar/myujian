<?php 
// 1. DEFINISI VARIABEL (Agar tidak error undefined)
$soal = $data['soal_saat_ini']; 
$id_jadwal = $data['id_jadwal'];
$no_now = $data['nomor_soal_aktif'];
$total = $data['total_soal'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/ujian.css"> 
    
    <style>
        /* CSS Tambahan Kecil jika file ujian.css belum sempurna */
        body { background-color: #f8f9fa; }
        .exam-header { background: #0d6efd; color: white; padding: 15px 0; margin-bottom: 20px; }
        .question-content { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); min-height: 400px; }
        .nav-panel { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .q-box { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border: 1px solid #ddd; border-radius: 5px; cursor: pointer; }
        .q-box.current { background-color: #ffc107; color: black; font-weight: bold; border-color: #ffc107; }
        .question-number-box { display: flex; flex-wrap: wrap; gap: 10px; }
    </style>
</head>

<body>

<header class="exam-header sticky-top">
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h4 class="mb-0 text-truncate">Ujian: <?= $data['nama_ujian']; ?></h4>
            </div>
            <div class="col-md-3 text-center">
                <div class="d-flex align-items-center justify-content-center bg-white text-dark rounded px-3 py-1">
                    <i class="fas fa-clock me-2 text-warning"></i>
                    <span class="fw-bold fs-5" id="timer_display">Sisa Waktu</span> 
                </div>
            </div>
            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-warning fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#modalSelesai">
                    <i class="fas fa-check-circle me-1"></i> Selesai Ujian
                </button>
            </div>
        </div>
    </div>
</header>

<main class="container-fluid px-4 pb-5">
    <div class="row">
        
        <div class="col-lg-8 mb-4">
            <div class="question-content">
                
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <h5 class="mb-0">Soal No. <span class="badge bg-primary fs-5"><?= $no_now; ?></span></h5>
                    <span class="badge bg-secondary">Pilihan Ganda</span>
                </div>

                <div class="question-text mb-4 fs-5">
                    <?= $soal['soal']; ?>
                </div>
                
                <div class="list-group option-list mb-5">
                    <?php 
                    $opsi = ['A', 'B', 'C', 'D', 'E']; // Sesuaikan jika sampai E
                    foreach ($opsi as $opt): 
                        // Ambil teks opsi dari database (kolom: opsi_a, opsi_b, dst)
                        // strtolower agar jadi 'opsi_a'
                        $teks_opsi = $soal['' . strtolower($opt)];
                        
                        // Cek apakah ini jawaban yang disimpan di session? (Logic Session Check bisa ditambahkan nanti)
                        $isActive = ''; 
                    ?>
                    
                    <label class="list-group-item list-group-item-action d-flex align-items-center p-3" style="cursor: pointer;">
                        <input class="form-check-input me-3" type="radio" name="jawaban" value="<?= $opt; ?>" 
                            onclick="simpanJawabanJS(<?= $soal['id']; ?>, '<?= $opt; ?>')"
                            <?= (isset($_SESSION['ujian'][$id_jadwal][$soal['id']]) && $_SESSION['ujian'][$id_jadwal][$soal['id']] == $opt) ? 'checked' : ''; ?> 
                            style="transform: scale(1.3);">
                        <span class="fw-bold me-3"><?= $opt; ?>.</span>
                        <span><?= $teks_opsi; ?></span>
                    </label>

                    <?php endforeach; ?>
                </div>

                <div class="d-flex justify-content-between">
                    
                    <?php if($no_now > 1): ?>
                        <a href="<?= BASEURL; ?>/ujian/mulai/<?= $id_jadwal; ?>/<?= $no_now - 1; ?>" class="btn btn-secondary btn-lg px-4">
                            <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                        </a>
                    <?php else: ?>
                        <button class="btn btn-secondary btn-lg px-4" disabled>Sebelumnya</button>
                    <?php endif; ?>

                    <?php if($no_now < $total): ?>
                        <a href="<?= BASEURL; ?>/ujian/mulai/<?= $id_jadwal; ?>/<?= $no_now + 1; ?>" class="btn btn-primary btn-lg px-4">
                            Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    <?php else: ?>
                        <button class="btn btn-success btn-lg px-4" data-bs-toggle="modal" data-bs-target="#modalSelesai">
                            Selesai <i class="fas fa-check ms-2"></i>
                        </button>
                    <?php endif; ?>

                </div>

            </div>
        </div>

        <div class="col-lg-4">
            <div class="nav-panel">
                <h5 class="mb-3 text-primary"><i class="fas fa-th me-2"></i>Nomor Soal</h5>
                <hr>
                <div class="question-number-box">
                    <?php for ($i = 1; $i <= $total; $i++): 
                        $cssClass = ($i == $no_now) ? 'current' : '';
                    ?>
                    
                    <a href="<?= BASEURL; ?>/ujian/mulai/<?= $id_jadwal; ?>/<?= $i; ?>" class="text-decoration-none">
                        <div class="q-box <?= $cssClass; ?> text-dark">
                            <?= $i; ?>
                        </div>
                    </a>

                    <?php endfor; ?>
                </div>
                
                <div class="mt-4 pt-3 border-top">
                    <small class="text-muted d-block mb-1"><span class="badge bg-warning text-dark">Kuning</span> : Sedang dikerjakan</small>
                    <small class="text-muted d-block"><span class="badge border text-dark">Putih</span> : Belum dibuka</small>
                </div>
            </div>
        </div>

    </div>
</main>

<div class="modal fade" id="modalSelesai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Selesai</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <p class="mb-0 fs-5">Apakah Anda yakin ingin mengakhiri ujian ini?</p>
                <small class="text-muted">Jawaban tidak dapat diubah setelah dikirim.</small>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <form action="<?= BASEURL; ?>/ujian/submit" method="POST">
                    <input type="hidden" name="id_jadwal" value="<?= $id_jadwal; ?>">
                    <button type="submit" class="btn btn-danger px-4">Ya, Selesaikan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // 1. Ambil Data dari PHP ke Javascript
    // Kita butuh ID Jadwal (agar timer tidak bentrok antar mapel) dan Durasi
    var idJadwal = "<?= $id_jadwal; ?>";
    var durasiMenit = <?= $data['waktu']; ?>; 
    
    // Kunci Penyimpanan di Browser (Unik per jadwal)
    var storageKey = "ujian_deadline_" + idJadwal;

    // 2. Cek apakah sudah ada waktu tersimpan?
    var deadline = localStorage.getItem(storageKey);

    // Jika belum ada (baru mulai ujian), set waktu baru
    if (!deadline) {
        var now = new Date().getTime();
        // Hitung waktu selesai: Sekarang + (Menit * 60 * 1000ms)
        deadline = now + (durasiMenit * 60 * 1000);
        // Simpan ke browser
        localStorage.setItem(storageKey, deadline);
    }

    // 3. Jalankan Hitung Mundur setiap 1 detik
    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = deadline - now;

        // Hitung Jam, Menit, Detik
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Format angka biar ada nol di depan (misal: 09:05:01)
        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        // Tampilkan ke layar (Elemen dengan ID timer_display)
        var displayElement = document.getElementById("timer_display");
        if (displayElement) {
            displayElement.innerHTML = hours + ":" + minutes + ":" + seconds;
            
            // Efek Merah jika waktu kurang dari 5 menit
            if (distance < (5 * 60 * 1000)) {
                displayElement.classList.add('text-danger');
                displayElement.classList.remove('text-dark');
            }
        }

        // 4. Jika Waktu Habis
        if (distance < 0) {
            clearInterval(x);
            if (displayElement) displayElement.innerHTML = "WAKTU HABIS";
            
            // Hapus storage agar kalau ujian lagi nanti, waktunya reset
            localStorage.removeItem(storageKey);

            // Paksa Submit Form
            alert("Waktu Habis! Jawaban Anda akan dikirim otomatis.");
            
            // Kita cari formnya lalu submit manual
            // Pastikan form di HTML Anda punya action ke /ujian/submit
            var form = document.querySelector('form[action*="/ujian/submit"]');
            if(form) {
                form.submit();
            } else {
                // Fallback jika form tidak ketemu (Redirect manual)
                window.location.href = "<?= BASEURL; ?>/ujian/submit";
            }
        }
    }, 1000);

    // Fitur Tambahan: Bersihkan timer saat tombol "Selesai" diklik manual
    // Agar saat ujian mapel lain, storage tidak penuh
    var btnSelesai = document.querySelector('button[type="submit"]'); // Tombol di modal
    if(btnSelesai) {
        btnSelesai.addEventListener('click', function() {
            localStorage.removeItem(storageKey);
        });
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <script>
    function simpanJawabanJS(id_soal, jawaban) {
        var id_jadwal = "<?= $id_jadwal; ?>";
        var base_url = "<?= BASEURL; ?>";

        $.ajax({
            url: base_url + '/ujian/simpan_jawaban',
            type: 'POST',
            data: {
                id_jadwal: id_jadwal,
                id_soal: id_soal,
                jawaban: jawaban
            },
            success: function(response) {
                console.log("Jawaban " + jawaban + " untuk soal " + id_soal + " tersimpan.");
            },
            error: function() {
                alert("Gagal menyimpan jawaban. Periksa koneksi internet.");
            }
        });
    }
</script>