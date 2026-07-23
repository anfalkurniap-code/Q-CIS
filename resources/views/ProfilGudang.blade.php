<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Q-CIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen p-2 sm:p-4">

    <div class="w-full max-w-[360px] bg-[#F8FAFC] border border-gray-200/80 shadow-sm rounded-3xl overflow-hidden flex flex-col justify-between min-h-[720px]">
        
        <!-- Main Content Area -->
        <div class="p-5 flex flex-col gap-5">
            
            <!-- Header (Icon Lonceng Sudah Dihilangkan) -->
            <header class="flex justify-between items-center pb-3 border-b border-gray-200/60">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-[#004D40] rounded-lg flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </div>
                    <span class="text-base font-extrabold text-[#004D40] tracking-tight">Q-CIS</span>
                </div>
            </header>

            <!-- User Photo & Profile Title -->
            <div class="flex flex-col items-center text-center mt-1">
                <div class="relative w-20 h-20 rounded-2xl overflow-hidden border-2 border-[#004D40] shadow-sm mb-3">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=200&h=200" alt="Budi Santoso" class="w-full h-full object-cover">
                    <!-- Badge Icon Kanan Bawah Foto -->
                    <div class="absolute bottom-1 right-1 bg-[#004D40] text-white p-1 rounded-md border border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751A11.959 11.959 0 0112 2.715z" />
                        </svg>
                    </div>
                </div>

                <h1 class="text-[16px] font-bold text-gray-800">
                    {{ auth()->user()->name ?? 'Budi Santoso' }}
                </h1>
                <p class="text-[12px] text-gray-500 font-medium">
                    Senior Inventory Supervisor
                </p>

                <!-- ID Badge -->
                <div class="mt-2 bg-[#00FFAB] text-[#004D40] text-[10px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                    ID: QC-2024-0812
                </div>
            </div>

            <!-- Section 1: Personal Information -->
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-1.5 text-[#004D40]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <span class="text-[11px] font-bold uppercase tracking-wider">PERSONAL INFORMATION</span>
                </div>

                <div class="bg-white border border-gray-200/70 rounded-2xl p-4 flex flex-col gap-3 shadow-sm">
                    <!-- FULL NAME -->
                    <div class="border-b border-gray-100 pb-2">
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block mb-0.5">FULL NAME</span>
                        <span class="text-[13px] font-bold text-gray-800 block">
                            {{ auth()->user()->name ?? 'Budi Santoso' }}
                        </span>
                    </div>

                    <!-- EMAIL ADDRESS -->
                    <div class="border-b border-gray-100 pb-2">
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block mb-0.5">EMAIL ADDRESS</span>
                        <span class="text-[12px] font-bold text-gray-800 block break-all">
                            {{ auth()->user()->email ?? 'budi.santoso@qcis-logistics.com' }}
                        </span>
                    </div>

                    <!-- PHONE NUMBER -->
                    <div>
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block mb-0.5">PHONE NUMBER</span>
                        <span class="text-[12px] font-bold text-gray-800 block">+62 812-3456-7890</span>
                    </div>
                </div>
            </div>

            <!-- Section 2: Account Settings -->
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-1.5 text-[#004D40]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.991l1.004.827c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.992l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-[11px] font-bold uppercase tracking-wider">ACCOUNT SETTINGS</span>
                </div>

                <div class="bg-white border border-gray-200/70 rounded-2xl overflow-hidden shadow-sm flex flex-col divide-y divide-gray-100">
                    <!-- Change Password -->
                    <a href="#" class="p-3.5 flex items-center justify-between hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-[12px] font-bold text-gray-800">Change Password</h4>
                                <p class="text-[10px] text-gray-400 font-medium">Update your login security</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>

                    <!-- Sign Out Form -->
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="w-full p-3.5 flex items-center justify-between hover:bg-red-50/50 transition-colors text-left">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-red-50 text-red-500 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H2.25" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-[12px] font-bold text-red-600">Sign Out</h4>
                                    <p class="text-[10px] text-red-400/80 font-medium">Terminate your current session</p>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Footer Small Info -->
            <p class="text-[9px] font-bold text-gray-400 text-center tracking-wider mt-2">
                V1.2.0-STABLE | LOGISTICS MANAGEMENT SYSTEM
            </p>
        </div>

        <!-- Navigation Bar Bawah (Bottom Nav Bar) -->
        <div class="bg-white border-t border-gray-200/80 px-3 py-2 flex justify-between items-center text-[10px] font-bold">
            <!-- Dashboard -->
            <a href="{{ route('dashboard.gudang') }}" class="flex flex-col items-center gap-0.5 text-gray-500 hover:text-gray-800 px-2 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Kelola -->
            <a href="#" class="flex flex-col items-center gap-0.5 text-gray-500 hover:text-gray-800 px-2 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>
                <span>Kelola</span>
            </a>

            <!-- Input -->
            <a href="#" class="flex flex-col items-center gap-0.5 text-gray-500 hover:text-gray-800 px-2 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Input</span>
            </a>

            <!-- Kritis -->
            <a href="#" class="flex flex-col items-center gap-0.5 text-gray-500 hover:text-gray-800 px-2 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
                <span>Kritis</span>
            </a>

            <!-- Profile Active Tag -->
            <a href="{{ route('profil.gudang') }}" class="flex flex-col items-center gap-0.5 text-[#000] bg-[#00FFAB] px-3 py-1.5 rounded-xl transition-all shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                <span>Profile</span>
            </a>
        </div>

    </div>

</body>
</html>