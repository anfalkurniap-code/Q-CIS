<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Ops - Staff Management</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen p-0 sm:p-4">

    <!-- Container Aplikasi Mobile -->
    <div class="w-full max-w-sm bg-[#F8F9FD] min-h-screen flex flex-col justify-between shadow-xl relative pb-20">
        
        <!-- Header -->
        <div>
            <div class="flex justify-between items-center px-5 py-4 border-b border-gray-100 bg-white">
                <div class="flex items-center gap-3">
                    <i data-lucide="menu" class="w-5 h-5 text-[#0F4C3A]"></i>
                    <h1 class="text-lg font-bold text-[#0F4C3A]">Store Ops</h1>
                </div>
                <i data-lucide="bell" class="w-5 h-5 text-[#0F4C3A]"></i>
            </div>

            <!-- Main Content -->
            <div class="p-5 space-y-4">
                <!-- Title & Action -->
                <div>
                    <h2 class="text-2xl font-bold text-[#0F4C3A]">Staff Management</h2>
                    <p class="text-xs text-gray-500 mt-1">Monitor real-time status and manage schedules for Branch #402.</p>
                    <button class="mt-3 bg-[#0F4C3A] text-white text-xs font-semibold px-4 py-2.5 rounded-lg flex items-center gap-2 hover:bg-emerald-900 transition">
                        <i data-lucide="calendar" class="w-4 h-4"></i> Shift Schedule
                    </button>
                </div>

                <!-- Stats Cards -->
                <div class="space-y-3">
                    <!-- Clocked In -->
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                        <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">CLOCKED IN</span>
                        <div class="flex items-baseline gap-2 mt-1">
                            <span class="text-2xl font-bold text-[#0F4C3A]">12</span>
                            <span class="text-xs font-medium text-emerald-600">Active Now</span>
                        </div>
                    </div>

                    <!-- On Break -->
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                        <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">ON BREAK</span>
                        <div class="flex items-baseline gap-2 mt-1">
                            <span class="text-2xl font-bold text-[#0F4C3A]">3</span>
                            <span class="text-xs font-medium text-gray-500">expected back: 15m</span>
                        </div>
                    </div>

                    <!-- Open Shifts -->
                    <div class="bg-white p-4 rounded-xl border-l-4 border-l-rose-500 border-y border-r border-gray-100 shadow-sm">
                        <span class="text-[10px] font-bold tracking-wider text-gray-400 uppercase">OPEN SHIFTS</span>
                        <div class="flex items-baseline gap-2 mt-1">
                            <span class="text-2xl font-bold text-rose-700">2</span>
                            <span class="text-xs font-medium text-rose-600">Urgent Coverage</span>
                        </div>
                    </div>
                </div>

                <!-- Staff List -->
                <div class="space-y-2.5 pt-2">
                    <?php
                    $staffs = [
                        ['name' => 'Jordan Smith', 'role' => 'Lead Cashier', 'status' => 'CLOCKED IN', 'img' => 'https://i.pravatar.cc/100?img=11'],
                        ['name' => 'Maria Rodriguez', 'role' => 'Stock Clerk', 'status' => 'ON BREAK', 'img' => 'https://i.pravatar.cc/100?img=5'],
                        ['name' => 'Liam Chen', 'role' => 'Sales Associate', 'status' => 'OFF DUTY', 'img' => 'https://i.pravatar.cc/100?img=3'],
                        ['name' => 'Sarah Baker', 'role' => 'Inventory Specialist', 'status' => 'CLOCKED IN', 'img' => 'https://i.pravatar.cc/100?img=9'],
                        ['name' => 'David Wright', 'role' => 'Floor Manager', 'status' => 'CLOCKED IN', 'img' => 'https://i.pravatar.cc/100?img=12'],
                        ['name' => 'Aisha Lawson', 'role' => 'Customer Service', 'status' => 'OFF DUTY', 'img' => 'https://i.pravatar.cc/100?img=24'],
                    ];

                    foreach ($staffs as $staff):
                        // Style badge berdasarkan status
                        $badgeBg = 'bg-gray-100 text-gray-500';
                        if ($staff['status'] === 'CLOCKED IN') $badgeBg = 'bg-emerald-100 text-emerald-700';
                        if ($staff['status'] === 'ON BREAK') $badgeBg = 'bg-emerald-800 text-white';
                        if ($staff['status'] === 'OFF DUTY') $badgeBg = 'bg-indigo-50 text-indigo-400';
                    ?>
                        <div class="bg-white p-3 rounded-xl border border-gray-100 flex items-center justify-between shadow-sm">
                            <div class="flex items-center gap-3">
                                <img src="<?= $staff['img'] ?>" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                                <div>
                                    <h3 class="text-xs font-bold text-gray-800"><?= $staff['name'] ?></h3>
                                    <p class="text-[11px] text-gray-400"><?= $staff['role'] ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[9px] font-bold px-2 py-0.5 rounded-full <?= $badgeBg ?>"><?= $staff['status'] ?></span>
                                <i data-lucide="more-vertical" class="w-4 h-4 text-gray-400 cursor-pointer"></i>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Recent Activity Section -->
                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm mt-4">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-[11px] font-bold text-gray-700 tracking-wider">RECENT ACTIVITY</span>
                        <a href="#" class="text-[11px] font-semibold text-emerald-700 hover:underline">View All</a>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-start gap-3 pb-3 border-b border-gray-50">
                            <div class="p-2 bg-emerald-800 text-white rounded-lg">
                                <i data-lucide="log-in" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-800">Jordan Smith clocked in for Morning Shift.</p>
                                <span class="text-[10px] text-gray-400">08:08 AM Today</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 pb-3 border-b border-gray-50">
                            <div class="p-2 bg-emerald-800 text-white rounded-lg">
                                <i data-lucide="coffee" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-800">Maria Rodriguez started break.</p>
                                <span class="text-[10px] text-gray-400">10:15 AM Today</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-emerald-200 text-emerald-800 rounded-lg">
                                <i data-lucide="clipboard-check" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-800">David Wright completed Inventory Check-in.</p>
                                <span class="text-[10px] text-gray-400">08:45 AM Today</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sign Out Banner -->
                <div class="bg-rose-50 border border-rose-100 rounded-xl p-3 flex items-center justify-between mt-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-rose-100 rounded-lg text-rose-500">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-rose-600">Sign Out</h4>
                            <p class="text-[10px] text-rose-400">Terminate your current session</p>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-rose-400"></i>
                </div>
            </div>
        </div>

        <!-- Floating Action Button -->
        <button class="fixed bottom-16 right-[calc(50%-170px)] sm:absolute sm:bottom-16 sm:right-5 bg-[#0F4C3A] text-white p-3 rounded-full shadow-lg hover:scale-105 transition">
            <i data-lucide="user-plus" class="w-5 h-5"></i>
        </button>

        <!-- Bottom Navigation Bar -->
        <div class="bg-white border-t border-gray-100 px-6 py-2 flex justify-between items-center absolute bottom-0 left-0 right-0">
            <a href="#" class="flex flex-col items-center gap-0.5 text-gray-400 hover:text-emerald-800">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span class="text-[9px] font-medium">Home</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-0.5 text-gray-400 hover:text-emerald-800">
                <i data-lucide="box" class="w-4 h-4"></i>
                <span class="text-[9px] font-medium">Stock</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-0.5 text-gray-400 hover:text-emerald-800">
                <i data-lucide="file-text" class="w-4 h-4"></i>
                <span class="text-[9px] font-medium">Orders</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-0.5 text-white bg-[#0F4C3A] px-3 py-1 rounded-xl">
                <i data-lucide="users" class="w-4 h-4"></i>
                <span class="text-[9px] font-medium">Staff</span>
            </a>
        </div>

    </div>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>