<?php
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public function __construct()
    {
        if (!defined('BASE_PATH')) {
            define('BASE_PATH', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));
        }
        session_start();
    }

    public function login()
    {
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASE_PATH . '/');
            exit;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->verifyPassword($username, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: ' . BASE_PATH . '/');
                exit;
            } else {
                $error = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
            }
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_PATH . '/login');
        exit;
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = trim($_POST['first_name'] ?? '');
            $last_name = trim($_POST['last_name'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if ($password !== $confirm_password) {
                $error = 'รหัสผ่านไม่ตรงกัน';
                require __DIR__ . '/../views/auth/register.php';
                return;
            }

            $userModel = new User();
            $existing = $userModel->findByUsernameOrEmail($username, $email);
            if ($existing) {
                $error = 'ชื่อผู้ใช้หรืออีเมลถูกใช้แล้ว';
                require __DIR__ . '/../views/auth/register.php';
                return;
            }

            $userModel->create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'username' => $username,
                'email' => $email,
                'password' => $password,
            ]);

            $_SESSION['user'] = $userModel->findByUsername($username);
            header('Location: ' . BASE_PATH . '/');
            exit;
        }

        require __DIR__ . '/../views/auth/register.php';
    }
}
