<?php
// Aktifkan error saat development
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/core/App.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Model.php';

// Jalankan aplikasi
$app = new App();
