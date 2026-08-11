<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS Mobile - Profil Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome / Lucide Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen bg-gray-100 p-0 sm:p-4">

    <!-- Container Utama Mobile -->
    <div class="w-full max-w-[375px] bg-[#F8FAFC] border border-gray-200 shadow-xl sm:rounded-[32px] overflow-hidden flex flex-col min-h-[780px] justify-between relative">
        
        <div>
            <!-- Header (Icon Lonceng Dihilangkan) -->
            <header class="flex items-center justify-between px-5 py-4 bg-white/50 backdrop-blur-md border-b border-gray-100 sticky top-0 z-10">
                <div class="flex items-center gap-2 text-[#004D40]">
                    <i class="fa-solid fa-store text-lg"></i>
                    <span class="font-extrabold text-base tracking-tight">Q-CIS</span>
                </div>
            </header>

            <main class="px-5 pt-4 pb-24">
                <!-- User Profile Summary Section -->
                <div class="flex flex-col items-center text-center mb-6">
                    <!-- Avatar Image with Verified Badge -->
                    <div class="relative mb-3">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=300" alt="Budi Santoso" class="w-20 h-20 rounded-2xl object-cover shadow-sm border border-gray-100">
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-[#004D40] border-2 border-white rounded-full flex items-center justify-center text-white text-[10px]">
                            <i class="fa-solid fa-shield-check"></i>
                        </div>
                    </div>

                    <!-- Name & Role -->
                    <h2 class="text-base font-extrabold text-gray-800">Budi Santoso</h2>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5">Senior Inventory Supervisor</p>
                    
                    <!-- ID Badge -->
                    <span class="inline-block mt-2 px-3 py-1 bg-emerald-400 text-[#004D40] text-[10px] font-extrabold rounded-full tracking-wider uppercase shadow-sm">
                        ID: QC-2024-0812
                    </span>
                </div>

                <!-- PERSONAL INFORMATION SECTION -->
                <div class="mb-6">
                    <div class="flex items-center gap-2 text-[#004D40] mb-2 px-1">
                        <i class="fa-solid fa-[#004D40] fa-[#004D40] text-xs"></i>
                        <i class="fa-solid fa-id-card text-xs"></i>
                        <h3 class="text-[11px] font-extrabold uppercase tracking-wider text-[#004D40]">Personal Information</h3>
                    </div>

                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 space-y-3.5">
                        <!-- Full Name -->
                        <div>
                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Full Name</span>
                            <span class="text-xs font-extrabold text-gray-800">Budi Santoso</span>
                        </div>
                        <hr class="border-gray-100">

                        <!-- Email Address -->
                        <div>
                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Email Address</span>
                            <span class="text-xs font-extrabold text-gray-800">budi.santoso@qcis-logistics.com</span>
                        </div>
                        <hr class="border-gray-100">

                        <!-- Phone Number -->
                        <div>
                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Phone Number</span>
                            <span class="text-xs font-extrabold text-gray-800">+62 812-3456-7890</span>
                        </div>
                    </div>
                </div>

                <!-- ACCOUNT SETTINGS SECTION -->
                <div class="mb-6">
                    <div class="flex items-center gap-2 text-[#004D40] mb-2 px-1">
                        <i class="fa-solid fa-gear text-xs"></i>
                        <h3 class="text-[11px] font-extrabold uppercase tracking-wider text-[#004D40]">Account Settings</h3>
                    </div>

                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm divide-y divide-gray-100 overflow-hidden">
                        <!-- Change Password -->
                        <a href="{{ route('password.gudang.change') }}" class="p-3.5 flex items-center justify-between hover:bg-gray-50 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-[#004D40]"></i>
                                    <i class="fa-solid fa-rotate text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-extrabold text-gray-800">Change Password</h4>
                                    <p class="text-[10px] font-medium text-gray-400">Update your login security</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
                        </a>

                        <!-- Sign Out -->
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="w-full p-3.5 flex items-center justify-between hover:bg-red-50/50 transition-colors text-left">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-red-100/70 text-red-500 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-right-from-bracket text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-extrabold text-red-500">Sign Out</h4>
                                        <p class="text-[10px] font-medium text-red-400">Terminate your current session</p>
                                    </div>
                                </div>
                                <i class="fa-solid fa-chevron-right text-xs text-red-400"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Footer System Info -->
                <div class="text-center mt-6">
                    <p class="text-[9px] font-extrabold text-gray-300 tracking-wider">V.1.2.0-STABLE | LOGISTICS MANAGEMENT SYSTEM</p>
                </div>
            </main>
        </div>

        <!-- Bottom Navigation Bar (Semua Route Terhubung) -->
        <nav class="absolute bottom-0 left-0 right-0 bg-white border-t border-gray-100 py-2.5 px-3 flex justify-between items-center z-20">
            <a href="{{ route('dashboard.gudang') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-[#004D40]">
                <i class="fa-solid fa-border-all text-sm"></i>
                <span class="text-[9px] font-extrabold">Dashboard</span>
            </a>
            <a href="{{ route('kelola.gudang') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-[#004D40]">
                <i class="fa-solid fa-box-archive text-sm"></i>
                <span class="text-[9px] font-extrabold">Kelola</span>
            </a>
            <a href="{{ route('input.barang') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-[#004D40]">
                <i class="fa-solid fa-square-plus text-sm"></i>
                <span class="text-[9px] font-extrabold">Input</span>
            </a>
            <a href="{{ route('stok.kritis') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-[#004D40]">
                <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                <span class="text-[9px] font-extrabold">Kritis</span>
            </a>
            <a href="{{ route('profil.gudang') }}" class="flex flex-col items-center gap-0.5 bg-emerald-400 text-[#004D40] px-3 py-1.5 rounded-xl font-extrabold shadow-sm">
                <i class="fa-solid fa-user text-xs"></i>
                <span class="text-[9px]">Profile</span>
            </a>
        </nav>

    </div>

</body>
</html>