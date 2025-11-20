<?php
// public/index.php
declare(strict_types=1);
session_start();

// show errors saat development
ini_set('display_errors', '1');
error_reporting(E_ALL);

// composer autoload (opsional)
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

// core bootstrap
require_once __DIR__ . '/../app/core/App.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Model.php';
require_once __DIR__ . '/../app/core/View.php';

// jalankan aplikasi
$app = new App();
