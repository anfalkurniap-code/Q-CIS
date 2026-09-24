<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas Gudang - Q-CIS SMK Mart</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen p-4">

    <!-- Container Frame Card -->
    <div class="bg-white rounded-[28px] shadow-2xl w-full max-w-sm overflow-hidden relative border border-slate-100 flex flex-col">
        
        <!-- Header Banner (Hijau Tua) -->
        <div class="bg-[#046e4e] text-white text-center pt-8 pb-7 px-6 flex flex-col items-center relative">
            
            <!-- Tombol Kembali Top Left -->
            <a href="{{ route('tampilan.awal') }}" class="absolute top-4 left-4 bg-white text-[#046e4e] w-8 h-8 rounded-full flex items-center justify-center shadow-md hover:bg-slate-100 transition z-10" title="Kembali">
                <svg class="w-4 h-4 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
            </a>

            <!-- Logo Icon (Shopping Bag / Lock in White Circle) -->
            <div class="bg-white text-[#046e4e] rounded-full w-14 h-14 flex items-center justify-center shadow-md mb-3 text-2xl">
                <svg class="w-7 h-7 fill-[#046e4e]" viewBox="0 0 24 24">
                    <path d="M19 6h-2c0-2.21-1.79-4-4-4S9 3.79 9 6H7c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-6-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2zm0 10c-1.66 0-3-1.34-3-3h2c0 .55.45 1 1 1s1-.45 1-1h2c0 1.66-1.34 3-3 3z"/>
                </svg>
            </div>

            <!-- Title & Subtitle Header -->
            <h1 class="text-xl font-bold tracking-wide">Q–CIS SMK Mart</h1>
            <p class="text-[11px] text-emerald-100 mt-1 max-w-[240px] leading-relaxed font-normal">
                Sistem Informasi Manajemen Kantin Sekolah yang Modern dan Terintegrasi.
            </p>
        </div>

        <!-- Body Form Login (Putih) -->
        <div class="p-6 pt-5">
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Selamat Datang</h2>
            <p class="text-xs text-slate-400 mt-0.5 mb-5 font-medium">Silakan masuk untuk mulai bertransaksi</p>

            <!-- Notification Flash Alert -->
            @if (session('error'))
                <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-xl font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('login.gudang.post') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Field Username / Email -->
                <div>
                    <label for="login" class="block text-xs font-bold text-slate-800 mb-1.5">Email atau Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                            </svg>
                        </span>
                        <input type="text" id="login" name="login" value="{{ old('login') }}" placeholder="Username atau Email" required autofocus
                            class="w-full pl-10 pr-4 py-2.5 bg-white border border-[#046e4e] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#046e4e]/20 text-xs text-slate-800 placeholder-slate-400 font-medium transition" />
                    </div>
                    @error('login')
                        <span class="text-[11px] text-rose-500 mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field Password -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password" class="text-xs font-bold text-slate-800">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[11px] font-semibold text-[#046e4e] hover:underline">
                                Lupa Kata Sandi?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                        </span>
                        <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi" required
                            class="w-full pl-10 pr-10 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-[#046e4e] focus:ring-2 focus:ring-[#046e4e]/20 text-xs text-slate-800 placeholder-slate-400 font-medium transition" />
                        
                        <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="togglePasswordVisibility()">
                            <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-[#046e4e] hover:bg-[#03543f] text-white py-3 rounded-full font-bold text-xs shadow-md transition-all active:scale-[0.99] mt-2">
                    Masuk ke Aplikasi
                </button>
            </form>

            <!-- Footer Access Link -->
            <div class="text-center mt-6 text-xs">
                <p class="text-slate-500 font-medium">Belum punya akses?</p>
                <a href="{{ route('pendaftaran') }}" class="text-[#046e4e] font-bold hover:underline block mt-0.5">
                    Hubungi Admin Sekolah untuk Pendaftaran
                </a>
            </div>
        </div>

    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />`;
            }
        }
    </script>
</body>
</html>