<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Kepala Toko - Q-CIS SMK MART</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex justify-center items-center p-0 md:p-4">

    <!-- Container Frame HP -->
    <div class="w-full max-w-sm bg-[#f8faf9] min-h-screen md:min-h-[750px] md:max-h-[850px] md:rounded-3xl shadow-xl border border-slate-200 relative flex flex-col justify-between overflow-hidden">
        
        <!-- Header Top -->
        <div class="p-4 space-y-3">
            <div class="flex items-center gap-2 text-[#064e3b] font-bold text-sm">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Q-CIS SMK MART</span>
            </div>

            <div>
                <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">Profil Kepala Toko</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola akun dan informasi profil Anda.</p>
            </div>
        </div>

        <!-- Scrollable Body Content -->
        <div class="px-4 pb-20 space-y-4 overflow-y-auto flex-1">
            
            <!-- Profile Card -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-full bg-[#064e3b] text-white flex items-center justify-center text-2xl font-bold mb-3 shadow-md">
                    KT
                </div>
                <h2 class="text-base font-bold text-slate-900">Kepala Toko</h2>
                <p class="text-xs text-slate-400">kepalatoko@smkmart.sch.id</p>
                <span class="mt-2 px-3 py-1 bg-emerald-100 text-[#064e3b] text-[10px] font-bold rounded-full">
                    Kepala Toko / Manager
                </span>
            </div>

            <!-- Menu Profil -->
            <div class="bg-white rounded-2xl p-2 shadow-sm border border-slate-100 divide-y divide-slate-100">
                <a href="{{ url('/HalamanInformasiAkun') }}" class="flex items-center justify-between p-3 hover:bg-slate-50 rounded-xl transition">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-slate-100 rounded-lg text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-700">Edit Profil</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ url('/HalamanKeamananAkun') }}" class="flex items-center justify-between p-3 hover:bg-slate-50 rounded-xl transition">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-slate-100 rounded-lg text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-700">Ubah Kata Sandi</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Tombol Keluar / Logout (Terhubung ke Route Logout Laravel) -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full py-3 bg-rose-50 text-rose-600 font-bold text-xs rounded-xl border border-rose-100 hover:bg-rose-100 transition">
                    Keluar Akun
                </button>
            </form>

        </div>

        <!-- Bottom Navbar (Terhubung ke Route Terkait) -->
        <div class="absolute bottom-0 inset-x-0 bg-white border-t border-slate-100 px-6 py-2 flex items-center justify-around z-20">
            
            <!-- 1. Dashboard Kepala Toko -->
            <a href="{{ route('dashboard.kepalatoko') }}" class="flex flex-col items-center gap-1 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Dashboard</span>
            </a>

            <!-- 2. Reports Kepala Toko -->
            <a href="{{ route('report.kepalatoko') }}" class="flex flex-col items-center gap-1 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Reports</span>
            </a>

            <!-- 3. Profile Kepala Toko (Aktif) -->
            <a href="{{ route('profile.kepalatoko.index') }}" class="flex flex-col items-center gap-1 text-[#064e3b]">
                <div class="px-4 py-1.5 rounded-xl bg-[#064e3b] text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold">Profile</span>
            </a>

        </div>

    </div>

</body>
</html>