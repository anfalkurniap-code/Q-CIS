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
            <p class="text-[12px] text-gray-500 font-medium leading-relaxed mb-5">
                Update your account security by choosing a strong password.
            </p>

            <!-- Form Ubah Password -->
            <form action="#" method="POST" class="flex flex-col gap-4">
                @csrf

                <!-- Input 1: Kata Sandi Saat Ini -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-bold text-gray-700">Kata Sandi Saat Ini</label>
                    <div class="relative flex items-center">
                        <input type="password" id="current_password" name="current_password" placeholder="••••••••" value="••••••••" class="w-full bg-white border border-gray-300 rounded-xl px-3.5 py-2.5 text-[13px] text-gray-800 tracking-widest focus:outline-none focus:border-[#004D40]">
                        <button type="button" class="absolute right-3 text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
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
                        <input type="password" id="new_password" name="password" placeholder="••••••••" value="••••••••" class="w-full bg-white border border-gray-300 rounded-xl px-3.5 py-2.5 text-[13px] text-gray-800 tracking-widest focus:outline-none focus:border-[#004D40]">
                        <button type="button" class="absolute right-3 text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
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
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" value="••••••••" class="w-full bg-white border border-gray-300 rounded-xl px-3.5 py-2.5 text-[13px] text-gray-800 tracking-widest focus:outline-none focus:border-[#004D40]">
                        <button type="button" class="absolute right-3 text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
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

        <!-- Watermark / Icon Shield Gembok di Bawah -->
        <div class="flex justify-center items-center my-4 opacity-40">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-20 h-20 text-gray-300">
                <path fill-rule="evenodd" d="M12 1.5a.75.75 0 01.75.75v.516a11.968 11.968 0 016.92 5.097.75.75 0 01-.19.988l-.022.016c-.305.205-.623.398-.952.578A10.47 10.47 0 0012 3.125a10.47 10.47 0 00-6.506 2.32c-.33-.18-.647-.373-.952-.578l-.022-.016a.75.75 0 01-.19-.988A11.968 11.968 0 0111.25 2.766V2.25A.75.75 0 0112 1.5z" clip-rule="evenodd" />
                <path d="M12 3.75a9.011 9.011 0 00-6 2.251c0 6.643 3.654 11.928 6 13.999 2.346-2.071 6-7.356 6-13.999a9.011 9.011 0 00-6-2.251z" />
            </svg>
        </div>

    </div>

</body>
</html>