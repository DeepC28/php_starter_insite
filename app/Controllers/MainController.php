<?php

require_once __DIR__ . '/BaseController.php';

class MainController extends BaseController
{
    public function index()
    {
        $this->render('main/index', ['title' => 'หน้าหลัก']);
    }

    public function about()
    {
        $this->render('main/about', ['title' => 'เกี่ยวกับเรา']);
    }

    public function contact()
    {
        $this->render('main/contact', ['title' => 'ติดต่อเรา']);
    }

    public function services()
    {
        $this->render('main/services', ['title' => 'บริการ']);
    }

    public function greet($name = 'Valentine')
    {
        $this->render('main/greet', ['title' => 'ทักทาย', 'name' => $name]);
    }

    public function profile()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_PATH . '/login');
            exit;
        }

        require_once __DIR__ . '/../models/User.php';

        $username = $_SESSION['user']['username'] ?? $_SESSION['user'];
        $userModel = new User();
        $user = $userModel->findByUsername($username);

        // ดึงข้อมูลแจ้งเตือนจาก session แล้วลบออก
        $success = $_SESSION['success'] ?? null;
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['success'], $_SESSION['error']);

        $this->render('main/profile', [
            'title' => 'โปรไฟล์ผู้ใช้งาน',
            'user' => $user,
            'success' => $success,
            'error' => $error,
        ]);
    }


    public function updateProfile()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_PATH . '/login');
            exit;
        }

        require_once __DIR__ . '/../models/User.php';

        $username = $_SESSION['user']['username'] ?? $_SESSION['user'];
        $userModel = new User();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => trim($_POST['first_name'] ?? ''),
                'last_name' => trim($_POST['last_name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'address' => trim($_POST['address'] ?? ''),
            ];

            if (empty($data['first_name']) || empty($data['last_name']) || empty($data['email'])) {
                $_SESSION['error'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
                header('Location: ' . BASE_PATH . '/profile');
                exit;
            }

            $updated = $userModel->updateProfile($username, $data);

            if ($updated) {
                $_SESSION['success'] = 'อัปเดตข้อมูลเรียบร้อยแล้ว';

                // อัปเดตข้อมูลใน session user
                $user = $userModel->findByUsername($username);
                $_SESSION['user'] = $user;

                header('Location: ' . BASE_PATH . '/profile');
                exit;
            } else {
                $_SESSION['error'] = 'ไม่สามารถอัปเดตข้อมูลได้ กรุณาลองใหม่';
                header('Location: ' . BASE_PATH . '/profile');
                exit;
            }
        } else {
            header('Location: ' . BASE_PATH . '/profile');
            exit;
        }
    }
}
