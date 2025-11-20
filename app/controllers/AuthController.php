<?php

class AuthController extends Controller
{
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if(isset($_SESSION['user'])) {
            header('Location: /dashboard');
            exit;
        }

        $this->view('auth/login');
    }

    public function authenticate()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Contoh query user (sesuaikan dengan model User)
        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: /dashboard');
            exit;
        } else {
            $_SESSION['error'] = "Email atau password salah!";
            header('Location: /login');
            exit;
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
