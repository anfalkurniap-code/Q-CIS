<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Kepala Toko - Q-CIS SMK MART</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @php use Illuminate\Support\Facades\Storage; @endphp
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
        <div class="px-4 pb-20 space-y-3 overflow-y-auto flex-1">
            
            <!-- Flash Alert Messages -->
            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-semibold rounded-xl p-3 flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-rose-100 border border-rose-300 text-rose-800 text-xs font-semibold rounded-xl p-3 flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0 text-rose-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-xl p-3 space-y-1">
                    <p class="font-bold">Terjadi kesalahan:</p>
                    <ul class="list-disc list-inside space-y-0.5 text-[11px]">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Profile Card -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex flex-col items-center text-center">
                @php
                    $avatarUrl = null;
                    $userAvatar = $user->avatar ?? $user->profile_pic ?? null;
                    if (!empty($userAvatar)) {
                        $avatarUrl = Storage::url($userAvatar);
                    }
                    $nameDisplay = $user->name ?? $user->username ?? 'Kepala Toko';
                    $initials = strtoupper(substr($nameDisplay, 0, 2));
                @endphp

                @if($avatarUrl)
                    <div class="w-20 h-20 rounded-full overflow-hidden mb-3 shadow-md border-2 border-[#064e3b]">
                        <img src="{{ $avatarUrl }}" alt="{{ $nameDisplay }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-20 h-20 rounded-full bg-[#064e3b] text-white flex items-center justify-center text-2xl font-bold mb-3 shadow-md">
                        {{ $initials }}
                    </div>
                @endif

                <h2 class="text-base font-bold text-slate-900">{{ $nameDisplay }}</h2>
                <p class="text-xs text-slate-400">{{ $user->email ?? 'kepalatoko@smkmart.sch.id' }}</p>
                <span class="mt-2 px-3 py-1 bg-emerald-100 text-[#064e3b] text-[10px] font-bold rounded-full">
                    Kepala Toko / Manager
                </span>
            </div>

            <!-- Menu Profil -->
            <div class="bg-white rounded-2xl p-2 shadow-sm border border-slate-100 divide-y divide-slate-100">
                <!-- Tombol Edit Profil (Membuka Modal) -->
                <button type="button" onclick="openModal('modalEditProfile')" class="w-full flex items-center justify-between p-3 hover:bg-slate-50 rounded-xl transition text-left">
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
                </button>

                <!-- Tombol Ubah Kata Sandi (Membuka Modal) -->
                <button type="button" onclick="openModal('modalChangePassword')" class="w-full flex items-center justify-between p-3 hover:bg-slate-50 rounded-xl transition text-left">
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
                </button>
            </div>

            <!-- Tombol Keluar / Logout (POST Request ke Route Logout -> Redirect Login Kepala Toko) -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full py-3 bg-rose-50 text-rose-600 font-bold text-xs rounded-xl border border-rose-100 hover:bg-rose-100 transition shadow-sm flex items-center justify-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Keluar Akun</span>
                </button>
            </form>

        </div>

        <!-- Bottom Navbar -->
        <div class="absolute bottom-0 inset-x-0 bg-white border-t border-slate-100 px-3 py-2 flex items-center justify-around z-20">
            <!-- 1. Dashboard -->
            <a href="{{ route('dashboard.kepalatoko') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Dashboard</span>
            </a>

            <!-- 2. Stok Barang -->
            <a href="{{ route('stok.kepalatoko') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Stok Barang</span>
            </a>

            <!-- 3. Reports -->
            <a href="{{ route('report.kepalatoko') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Reports</span>
            </a>

            <!-- 4. Profile (Aktif) -->
            <a href="{{ route('profile.kepalatoko.index') }}" class="flex flex-col items-center gap-0.5 text-[#064e3b]">
                <div class="px-3 py-1 rounded-xl bg-[#064e3b] text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold">Profile</span>
            </a>
        </div>

    </div>

    <!-- MODAL 1: EDIT PROFIL & FOTO PROFIL -->
    <div id="modalEditProfile" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <div class="bg-white w-full max-w-xs rounded-2xl p-4 shadow-2xl border border-slate-100 relative">
            <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                <h3 class="text-sm font-bold text-slate-900">Edit Profil</h3>
                <button type="button" onclick="closeModal('modalEditProfile')" class="text-slate-400 hover:text-slate-600 p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form action="{{ route('profile.kepalatoko.updateProfile') }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-xs">
                @csrf

                <!-- Nama Pengguna -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama / Username</label>
                    <input type="text" name="name" value="{{ old('name', $user->name ?? $user->username ?? '') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-xs text-slate-800 focus:outline-none focus:border-[#064e3b]">
                </div>

                <!-- Foto Profil Avatar -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Foto Profil (Avatar)</label>
                    <input type="file" name="avatar" accept="image/jpeg,image/png,image/jpg" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2 text-xs text-slate-600 focus:outline-none focus:border-[#064e3b]">
                    <p class="text-[10px] text-slate-400 mt-1">Format: JPG, JPEG, PNG (Maks 2MB).</p>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#064e3b] hover:bg-[#04382a] text-white font-bold py-2.5 rounded-xl transition shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 2: UBAH KATA SANDI -->
    <div id="modalChangePassword" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <div class="bg-white w-full max-w-xs rounded-2xl p-4 shadow-2xl border border-slate-100 relative">
            <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                <h3 class="text-sm font-bold text-slate-900">Ubah Kata Sandi</h3>
                <button type="button" onclick="closeModal('modalChangePassword')" class="text-slate-400 hover:text-slate-600 p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form action="{{ route('profile.kepalatoko.updatePassword') }}" method="POST" class="space-y-3 text-xs">
                @csrf

                <!-- Kata Sandi Saat Ini -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" required placeholder="Masukkan kata sandi lama" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-xs text-slate-800 focus:outline-none focus:border-[#064e3b]">
                </div>

                <!-- Kata Sandi Baru -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Kata Sandi Baru</label>
                    <input type="password" name="password" required placeholder="Minimal 6 karakter" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-xs text-slate-800 focus:outline-none focus:border-[#064e3b]">
                </div>

                <!-- Konfirmasi Kata Sandi Baru -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi baru" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-xs text-slate-800 focus:outline-none focus:border-[#064e3b]">
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#064e3b] hover:bg-[#04382a] text-white font-bold py-2.5 rounded-xl transition shadow-sm">
                        Ubah Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script JavaScript Modal Toggle -->
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        // Auto Open Modal if error validation exists
        @if($errors->has('current_password') || $errors->has('password'))
            openModal('modalChangePassword');
        @elseif($errors->has('avatar') || $errors->has('name'))
            openModal('modalEditProfile');
        @endif
    </script>
</body>
</html>