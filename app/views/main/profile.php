<h1 class="text-2xl font-semibold mb-4"><?= htmlspecialchars($title ?? 'โปรไฟล์ผู้ใช้งาน') ?></h1>

<div class="bg-white p-6 rounded shadow max-w-full w-full">
    <form method="POST" action="<?= BASE_PATH ?>/profile/update" id="profileForm">
        <div class="mb-4">
            <label class="block font-medium mb-1" for="username">ชื่อผู้ใช้</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" readonly
                class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 cursor-not-allowed">
            <small class="text-gray-500">ชื่อผู้ใช้ไม่สามารถแก้ไขได้</small>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1" for="first_name">ชื่อ</label>
            <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>"
                class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1" for="last_name">นามสกุล</label>
            <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>"
                class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1" for="email">อีเมล</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>"
                class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1" for="phone">เบอร์โทรศัพท์</label>
            <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1" for="address">ที่อยู่</label>
            <textarea id="address" name="address" rows="3"
                class="w-full border border-gray-300 rounded px-3 py-2"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
        </div>

        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">บันทึกการแก้ไข</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    <?php if (!empty($success)): ?>
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ',
            text: <?= json_encode($success) ?>,
            timer: 2500,
            timerProgressBar: true,
            showConfirmButton: false
        });
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        Swal.fire({
            icon: 'error',
            title: 'ผิดพลาด',
            text: <?= json_encode($error) ?>,
            showConfirmButton: true
        });
    <?php endif; ?>
});
</script>
