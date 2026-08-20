<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Q-CIS</title>
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

    <!-- Card Container -->
    <div class="w-full max-w-[360px] bg-[#F8FAFC] border border-gray-200/80 shadow-sm rounded-3xl overflow-hidden flex flex-col min-h-[720px] justify-between p-5">
        
        <div>
            <!-- Header dengan Tombol Back (Kembali ke Profil) -->
            <header class="flex items-center gap-3 pb-3 border-b border-gray-200/60 mb-5">
                <a href="{{ route('profil.gudang') }}" class="text-[#004D40] hover:opacity-80 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <h1 class="text-[17px] font-extrabold text-[#004D40] tracking-tight">Change Password</h1>
            </header>

            <!-- Deskripsi -->
            <p class="text-[12px] text-gray-500 font-medium leading-relaxed mb-4">
                Update your account security by choosing a strong password.
            </p>

            <!-- Alert Notifikasi Error / Success -->
            @if (session('success'))
                <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 text-xs rounded-xl">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Ubah Password -->
            <form action="{{ route('password.gudang.update') }}" method="POST" autocomplete="off" class="flex flex-col gap-4">
                @csrf
                @method('PUT')

                <!-- Input 1: Kata Sandi Saat Ini -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-bold text-gray-700">Kata Sandi Saat Ini</label>
                    <div class="relative flex items-center">
                        <input type="password" id="current_password" name="current_password" placeholder="••••••••" value="" autocomplete="new-password" class="w-full bg-white border border-gray-300 rounded-xl px-3.5 py-2.5 text-[13px] text-gray-800 tracking-widest focus:outline-none focus:border-[#004D40]">
                        <button type="button" onclick="togglePasswordVisibility('current_password', this)" class="absolute right-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <!-- Icon Mata Dicoret (Default saat Password Tersembunyi) -->
                            <svg class="eye-off-icon w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                            <!-- Icon Mata Terbuka (Tampil saat Password Terlihat) -->
                            <svg class="eye-icon w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Input 2: Kata Sandi Baru -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-bold text-gray-700">Kata Sandi Baru</label>
                    <div class="relative flex items-center">
                        <input type="password" id="new_password" name="password" placeholder="••••••••" value="" autocomplete="new-password" class="w-full bg-white border border-gray-300 rounded-xl px-3.5 py-2.5 text-[13px] text-gray-800 tracking-widest focus:outline-none focus:border-[#004D40]">
                        <button type="button" onclick="togglePasswordVisibility('new_password', this)" class="absolute right-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="eye-off-icon w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                            <svg class="eye-icon w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Kotak Info Persyaratan Password -->
                <div class="bg-[#F0F4FF]/70 border border-indigo-100/80 rounded-xl p-3 flex flex-col gap-1.5">
                    <div class="flex items-center gap-2 text-[11px] text-gray-600 font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-500 shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Minimal 8 karakter</span>
                    </div>
                    <div class="flex items-center gap-2 text-[11px] text-gray-600 font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-500 shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Gunakan kombinasi huruf dan angka</span>
                    </div>
                </div>

                <!-- Input 3: Konfirmasi Kata Sandi Baru -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-bold text-gray-700">Konfirmasi Kata Sandi Baru</label>
                    <div class="relative flex items-center">
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" value="" autocomplete="new-password" class="w-full bg-white border border-gray-300 rounded-xl px-3.5 py-2.5 text-[13px] text-gray-800 tracking-widest focus:outline-none focus:border-[#004D40]">
                        <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)" class="absolute right-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="eye-off-icon w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                            <svg class="eye-icon w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex flex-col gap-2.5 mt-3">
                    <button type="submit" class="w-full bg-[#005B41] hover:bg-[#004D40] text-white font-extrabold rounded-xl py-3 text-[11px] uppercase tracking-wider transition-colors shadow-sm">
                        Simpan Kata Sandi
                    </button>
                    
                    <a href="{{ route('profil.gudang') }}" class="w-full bg-white hover:bg-gray-50 text-[#005B41] border border-[#005B41] font-extrabold rounded-xl py-3 text-[11px] uppercase tracking-wider text-center transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Watermark / Icon Shield Gembok -->
        <div class="flex justify-center items-center my-4 opacity-40">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-20 h-20 text-gray-300">
                <path fill-rule="evenodd" d="M12 1.5a.75.75 0 01.75.75v.516a11.968 11.968 0 016.92 5.097.75.75 0 01-.19.988l-.022.016c-.305.205-.623.398-.952.578A10.47 10.47 0 0012 3.125a10.47 10.47 0 00-6.506 2.32c-.33-.18-.647-.373-.952-.578l-.022-.016a.75.75 0 01-.19-.988A11.968 11.968 0 0111.25 2.766V2.25A.75.75 0 0112 1.5z" clip-rule="evenodd" />
                <path d="M12 3.75a9.011 9.011 0 00-6 2.251c0 6.643 3.654 11.928 6 13.999 2.346-2.071 6-7.356 6-13.999a9.011 9.011 0 00-6-2.251z" />
            </svg>
        </div>

    </div>

    <!-- Script JavaScript Toggle Password -->
    <script>
        function togglePasswordVisibility(inputId, button) {
            const input = document.getElementById(inputId);
            const eyeIcon = button.querySelector('.eye-icon');
            const eyeOffIcon = button.querySelector('.eye-off-icon');

            if (input.type === 'password') {
                input.type = 'text';
                eyeOffIcon.classList.add('hidden');
                eyeIcon.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOffIcon.classList.remove('hidden');
                eyeIcon.classList.add('hidden');
            }
        }
    </script>

</body>
</html>