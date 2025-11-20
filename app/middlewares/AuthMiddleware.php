<?php
// app/middlewares/AuthMiddleware.php
class AuthMiddleware
{
    public static function handle()
    {
        if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            // redirect ke /login
            $base = '/login';
            header("Location: $base");
            exit;
        }
    }
}
