<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS SMK MART - Login</title>
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
<body class="flex justify-center items-center min-h-screen p-4">

    <div class="w-full max-w-[360px] flex flex-col items-center">
        
        <!-- Tombol Kembali -->
        <div class="w-full flex justify-start mb-2">
            <a href="{{ url('/') }}" class="w-9 h-9 rounded-full bg-white border border-gray-100 flex items-center justify-center text-[#064E3B] shadow-sm hover:bg-gray-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
        </div>

        <!-- Header Icon & Logo -->
        <div class="w-12 h-12 bg-[#064E3B] rounded-xl flex items-center justify-center text-white mb-3 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </div>

        <!-- Title & Subtitle -->
        <h1 class="text-[18px] font-extrabold text-[#064E3B] text-center tracking-tight mb-2">
            Q-CIS SMK MART
        </h1>
        
        <p class="text-[11px] text-gray-600 text-center leading-relaxed px-2 font-medium mb-4">
            Sistem Informasi Manajemen Kantin Sekolah<br>
            yang Modern dan Terintegrasi
        </p>

        <p class="text-[12px] text-gray-700 text-center leading-relaxed font-semibold mb-5">
            Selamat Datang. Silakan masuk untuk mulai<br>bertransaksi
        </p>

        <!-- Card Form Login -->
        <div class="w-full bg-white border border-gray-100 rounded-2xl p-5 shadow-sm mb-6">
            
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 text-[11px] p-2.5 rounded-xl mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('login.gudang.post') }}" method="POST" class="flex flex-col gap-4">
                @csrf

                <!-- Field Email / Username -->
                <div class="flex flex-col gap-1">
                    <label for="login" class="text-[11px] font-bold text-gray-600">Email atau Username</label>
                    <input type="text" name="login" id="login" value="{{ old('login') }}" placeholder="nama@gmail.com" required
                        class="w-full bg-[#F8FAFC] border border-gray-200 focus:border-[#064E3B] focus:bg-white focus:outline-none rounded-lg py-2 px-3 text-[12px] text-gray-700 placeholder-gray-400">
                </div>

                <!-- Field Password -->
                <div class="flex flex-col gap-1">
                    <label for="password" class="text-[10px] font-bold text-gray-600 uppercase tracking-wider">KATA SANDI</label>
                    <div class="relative flex items-center">
                        <input type="password" name="password" id="password" placeholder="Masukkan Kata Sandi" required
                            class="w-full bg-[#F8FAFC] border border-gray-200 focus:border-[#064E3B] focus:bg-white focus:outline-none rounded-lg py-2 px-3 pr-10 text-[12px] text-gray-700 placeholder-gray-400">
                        
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute right-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg id="eye_icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Lupa Kata Sandi -->
                <div class="flex justify-end -mt-1">
                    <a href="#" class="text-[11px] font-bold text-[#064E3B] hover:underline">
                        Lupa Kata Sandi?
                    </a>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="w-full bg-[#064E3B] hover:bg-[#043A2C] text-white font-bold rounded-lg py-2.5 text-[13px] transition-colors mt-1 flex items-center justify-center gap-2">
                    <span>Masuk ke Aplikasi</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H2.25" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- Footer Text Terhubung ke Route Pendaftaran -->
        <p class="text-[11px] text-gray-600 text-center leading-relaxed">
            Belum punya akses? <a href="{{ route('pendaftaran') }}" class="font-bold text-[#064E3B] hover:underline">Hubungi Admin Sekolah untuk Pendaftaran</a>
        </p>

    </div>

    <!-- Script Toggle Password -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye_icon');

            const eyeClosed = `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />`;
            const eyeOpen = `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = eyeOpen;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = eyeClosed;
            }
        }
    </script>
</body>
</html>