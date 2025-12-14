<?php
// --- TAMBAHKAN 2 BARIS INI PALING ATAS ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// -----------------------------------------

if( !session_id() ) session_start();
// ... kode selanjutnya ...
require_once 'app/config/config.php';
require_once 'app/core/App.php';
require_once 'app/core/Controller.php';
require_once 'app/core/Database.php';

$app = new App();