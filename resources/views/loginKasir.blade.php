<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Q-CIS SMK Mart</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-blue-50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white rounded-3xl shadow-xl w-full max-w-md overflow-hidden relative">
        
        <a href="{{ url('/TampilanAwalLogin') }}" class="absolute top-4 left-4 bg-white text-emerald-800 rounded-full w-8 h-8 flex items-center justify-center shadow-md hover:bg-gray-100 transition">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <div class="bg-emerald-800 text-white text-center pt-10 pb-8 px-6 flex flex-col items-center">
            <div class="bg-white text-emerald-800 rounded-full w-16 h-16 flex items-center justify-center shadow-inner mb-4 text-2xl">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <h1 class="text-2xl font-bold tracking-wide">Q-CIS SMK Mart</h1>
            <p class="text-xs text-emerald-100 mt-2 max-w-xs leading-relaxed">
                Sistem Informasi Manajemen Kantin Sekolah yang Modern dan Terintegrasi.
            </p>
        </div>

        <div class="p-6 md:p-8">
            <h2 class="text-xl font-bold text-slate-800">Selamat Datang</h2>
            <p class="text-sm text-gray-500 mt-1 mb-6">Silakan masuk untuk mulai bertransaksi</p>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
                 <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Email atau Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fa-regular fa-user"></i>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@gmail.com" required autofocus
                            class="w-full pl-10 pr-4 py-2.5 border @if($errors->any()) border-red-500 focus:ring-red-500 @else border-gray-300 focus:ring-emerald-700 @endif rounded-xl focus:outline-none focus:ring-2 text-sm placeholder-gray-400 transition" />
                    </div>
                    @error('email')
                        <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                 <div>
                    <div class="flex justify-between items-center mb-1">
                        <label for="password" class="text-sm font-semibold text-slate-700">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-emerald-700 hover:underline">
                                Lupa Kata Sandi?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi" required
                            class="w-full pl-10 pr-10 py-2.5 border @if($errors->any()) border-red-500 focus:ring-red-500 @else border-gray-300 focus:ring-emerald-700 @endif rounded-xl focus:outline-none focus:ring-2 text-sm placeholder-gray-400 transition" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 cursor-pointer hover:text-gray-600" onclick="togglePasswordVisibility()">
                            <i id="togglePasswordIcon" class="fa-regular fa-eye-slash"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-emerald-800 text-white py-3 rounded-full font-semibold text-sm hover:bg-emerald-900 transition shadow-md mt-2">
                    Masuk ke Aplikasi
                </button>
            </form>

            <div class="text-center mt-8 text-xs">
                <p class="text-gray-500 font-medium">Belum punya akses?</p>
                <a href="#" class="text-emerald-700 font-bold hover:underline block mt-0.5">
                    Hubungi Admin Sekolah untuk Pendaftaran
                </a>
            </div>
        </div>

    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>