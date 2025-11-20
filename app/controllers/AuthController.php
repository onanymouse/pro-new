<?php
// app/controllers/AuthController.php
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller
{
    public function login()
    {
        // jika sudah login redirect dashboard
        if (isset($_SESSION['user'])) {
            header('Location: /dashboard');
            exit;
        }
        // view login (login.php akan include layout auth)
        $this->view('auth/login');
    }

    public function authenticate()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // set trimmed minimal user session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'role' => $user['role'],
                'email' => $user['email']
            ];
            header('Location: /dashboard');
            exit;
        }

        $_SESSION['error'] = 'Email atau password salah';
        header('Location: /login');
        exit;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
