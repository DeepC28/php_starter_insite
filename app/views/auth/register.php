<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>เข้าร่วมระบบ</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            background: #fff;
            padding: 2em;
            width: 100%;
            max-width: 420px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.15);
        }

        h2 {
            margin-top: 0;
            text-align: center;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #28a745;
            border: none;
            color: white;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="register-container">
        <h2>เข้าร่วมระบบ</h2>

        <form method="POST">
            <label>ชื่อผู้ใช้:</label>
            <input type="text" name="username" required>

            <label>อีเมล:</label>
            <input type="email" name="email" required>

            <label>รหัสผ่าน:</label>
            <input type="password" name="password" required>

            <label>ยืนยันรหัสผ่าน:</label>
            <input type="password" name="confirm_password" required>

            <input type="submit" value="สร้างบัญชี">
        </form>
    </div>

    <?php if (!empty($errorMessage)): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: <?= json_encode($errorMessage) ?>,
                confirmButtonText: 'ตกลง'
            });
        </script>
    <?php endif; ?>

    <?php if (!empty($successMessage)): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: <?= json_encode($successMessage) ?>,
                confirmButtonText: 'ตกลง'
            }).then(() => {
                window.location.href = '<?= BASE_PATH ?>/login';
            });
        </script>
    <?php endif; ?>

</body>

</html>
