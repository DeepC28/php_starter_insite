<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <title>เข้าสู่ระบบ</title>
    <style>
        html, body {
            margin: 0; padding: 0; height: 100%;
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }
        .login-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 2em;
            width: 400px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 6px;
            box-sizing: border-box;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="login-container">
        <h2>เข้าสู่ระบบ</h2>
        <form method="POST">
            <label>ชื่อผู้ใช้:</label>
            <input type="text" name="username" required />
            <label>รหัสผ่าน:</label>
            <input type="password" name="password" required />
            <input type="submit" value="เข้าสู่ระบบ" />
        </form>
    </div>

    <?php if (!empty($error)): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: <?= json_encode($error) ?>,
            confirmButtonText: 'ตกลง',
            allowOutsideClick: false,
            allowEscapeKey: false
        });
    </script>
    <?php endif; ?>

</body>

</html>
