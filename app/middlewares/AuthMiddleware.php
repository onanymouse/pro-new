<?php

class AuthMiddleware
{
    public static function handle()
    {
        // Cek session user
        if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            // Kalau belum login, redirect ke login
            header('Location: /login');
            exit;
        }

        // Bisa ditambahkan pengecekan role jika ingin role-based akses di middleware
        // Contoh:
        // if ($_SESSION['user']['role'] !== 'admin') {
        //     header('HTTP/1.1 403 Forbidden');
        //     echo "Access denied";
        //     exit;
        // }
    }
}