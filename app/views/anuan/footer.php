<footer class="footer mt-auto py-3 bg-white border-top shadow-sm" style="margin-top: 50px;">
        <div class="container text-center">
            <span class="text-muted small">
                &copy; <?= date('Y'); ?> <strong>MyUjian</strong>. All rights reserved.
            </span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Menghilangkan alert otomatis HANYA jika itu pesan flasher
        setTimeout(function() {
            // Kita cari elemen alert yang punya atribut role="alert" DAN class="alert-dismissible"
            // Atau cari elemen pembungkus pesan flash spesifik
            let flashElement = document.querySelector('.row .alert'); 
        
            // Cek apakah elemen ini benar-benar pesan flash (biasanya ada di bagian atas container)
            // Jika elemen ini ada di dalam <form>, JANGAN dihapus.
            if(flashElement && !flashElement.closest('form')) {
                flashElement.classList.remove('show');
                flashElement.classList.add('fade');
                setTimeout(() => flashElement.remove(), 500);
            }
        }, 3000);
    </script>

</body>
</html>