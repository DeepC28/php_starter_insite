<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'My Project') ?></title>

    <!-- Font and Icon -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        prompt: ['Prompt', 'sans-serif'],
                    }
                }
            }
        };
    </script>

    <!-- AlpineJS & SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Global Styles -->
    <style>
        body {
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="flex h-screen" x-data="{ sidebarOpen: false }">

        <!-- Sidebar for Desktop -->
        <aside class="w-64 bg-white border-r shadow-sm hidden md:block">
            <div class="p-6 text-xl font-semibold border-b text-gray-800">
                <?= htmlspecialchars($title ?? 'My Project') ?>
            </div>
            <?php include __DIR__ . '/../components/navbar.php'; ?>
        </aside>

        <!-- Sidebar for Mobile -->
        <aside
            class="fixed inset-y-0 left-0 w-64 bg-white border-r shadow-lg z-30 transform transition-transform duration-300 ease-in-out md:hidden"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            x-cloak>
            <div class="p-6 text-xl font-semibold border-b text-gray-800 relative">
                <?= htmlspecialchars($title ?? 'My Project') ?>
                <button @click="sidebarOpen = false"
                    class="absolute top-2 right-2 text-gray-500 hover:text-black">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <?php include __DIR__ . '/../components/navbar.php'; ?>
        </aside>

        <div class="fixed inset-0 bg-black bg-opacity-40 z-20 transition-opacity duration-300 ease-in-out md:hidden"
            :class="sidebarOpen ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'"
            @click="sidebarOpen = false"
            x-cloak>
        </div>

        <div class="flex flex-col flex-1 w-full">

            <!-- Header -->
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 border-b">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true"
                        class="md:hidden text-gray-600 hover:text-black focus:outline-none mr-4"
                        aria-label="เปิดเมนู">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <span class="text-base sm:text-lg font-medium">ยินดีต้อนรับ</span>
                </div>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open"
                        class="flex items-center gap-3 focus:outline-none"
                        aria-haspopup="true" :aria-expanded="open.toString()">
                        <div class="flex flex-col items-end leading-tight">
                            <span class="font-semibold text-base">
                                <?php if (!empty($_SESSION['user']['username'])): ?>
                                    <?= htmlspecialchars($_SESSION['user']['username']) ?>
                                <?php else: ?>
                                    Guest
                                <?php endif; ?>

                            </span>
                            <span class="text-gray-500 text-sm -mt-1">ระดับผู้ใช้</span>
                        </div>
                        <i class="bi bi-person-circle text-3xl text-gray-600"></i>
                    </button>
                    <div x-show="open" x-transition
                        class="absolute right-0 mt-2 w-40 bg-white border rounded-md shadow-lg z-50"
                        style="display: none;" role="menu">
                        <a href="/php_project_site/profile"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                            role="menuitem">โปรไฟล์</a>
                        <a href="/php_project_site/logout"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                            role="menuitem">ออกจากระบบ</a>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <?php include $GLOBALS['__VIEW_PATH__']; ?>
            </main>

            <!-- Footer -->
            <footer class="text-center text-sm text-gray-500 py-4 border-t">
                &copy; <?= date('Y') ?> <?= htmlspecialchars($title ?? 'My Project') ?>
            </footer>
        </div>
    </div>
</body>

</html>