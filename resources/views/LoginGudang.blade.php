<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS - Login Petugas Gudang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4 text-slate-800">

    <div class="w-full max-w-[400px] bg-[#f8faf9] rounded-2xl shadow-xl overflow-hidden border border-slate-200 relative p-6">

        <!-- Header Navigation & Logo Gudang -->
        <div class="relative flex items-center justify-center mb-6 pt-2">
            <!-- Tombol Kembali ke Tampilan Awal -->
            <a href="{{ url('/') }}" class="absolute left-0 w-10 h-10 rounded-full bg-white border border-slate-200 shadow-sm flex items-center justify-center text-[#034d35] hover:bg-slate-50 transition">
                <i class="fa-solid fa-arrow-left text-base"></i>
            </a>

            <!-- Logo Gudang -->
            <div class="w-16 h-16 bg-[#034d35] rounded-xl flex items-center justify-center text-white shadow-md">
                <i class="fa-solid fa-warehouse text-2xl"></i>
            </div>
        </div>

        <!-- Title Section -->
        <div class="text-center mb-6">
            <h1 class="text-xl font-bold text-[#034d35] tracking-wide mb-1">Q-CIS SMK MART</h1>
            <p class="text-xs font-semibold text-slate-700 mt-2">
                Selamat Datang, Silakan masuk untuk mengelola Gudang
            </p>
        </div>

        <!-- Main Card Form -->
        <div class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-sm mb-6">
            
            <!-- ALERT PESAN ERROR (Jika Login Gagal/Password Salah) -->
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 text-xs rounded-lg flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation text-sm"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 text-xs rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <!-- Input Username / Email -->
                <div class="mb-4">
                    <label class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                        Email atau Username
                    </label>
                    <div class="relative flex items-center">
                        <input type="text" name="login" value="{{ old('login') }}" placeholder="gudang@gmail.com" 
                            class="w-full text-sm px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg pr-10 focus:outline-none focus:ring-2 focus:ring-[#034d35] focus:bg-white text-slate-700 placeholder-slate-400 transition" required>
                        <i class="fa-solid fa-user absolute right-3 text-slate-400 text-base pointer-events-none"></i>
                    </div>
                </div>

                <!-- Input Password -->
                <div class="mb-3">
                    <label class="block text-[11px] font-bold text-slate-600 uppercase tracking-wider mb-1.5">
                        Kata Sandi
                    </label>
                    <div class="relative flex items-center">
                        <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi" 
                            class="w-full text-sm px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg pr-10 focus:outline-none focus:ring-2 focus:ring-[#034d35] focus:bg-white text-slate-700 placeholder-slate-400 transition" required>
                        <button type="button" onclick="togglePassword()" class="absolute right-3 text-slate-400 hover:text-slate-600 focus:outline-none">
                            <i id="toggleIcon" class="fa-regular fa-eye text-base"></i>
                        </button>
                    </div>
                </div>

                <!-- Forgot Password Link -->
                <div class="text-right mb-5">
                    <a href="#" class="text-xs font-semibold text-[#034d35] hover:underline">
                        Lupa Kata Sandi?
                    </a>
                </div>

                <button type="submit" class="w-full bg-[#034d35] hover:bg-[#023a28] text-white font-semibold py-2.5 px-4 rounded-lg flex items-center justify-center gap-2 text-sm shadow-md transition duration-200">
                    <span>Masuk ke Dashboard Gudang</span>
                    <i class="fa-solid fa-right-to-bracket text-base"></i>
                </button>
            </form>
        </div>

        <!-- Bantuan Pendaftaran -->
        <div class="mb-6">
            <p class="text-[11px] text-slate-600 text-center">
                Belum punya akses? <a href="#" class="font-bold text-[#034d35] hover:underline">Hubungi Admin Sekolah untuk Pendaftaran</a>
            </p>
        </div>

        <!-- Footer -->
        <div class="border-t border-slate-200 pt-4 text-center">
            <div class="flex items-center justify-center gap-1.5 text-slate-400 text-xs font-bold tracking-widest uppercase mb-1">
                <i class="fa-solid fa-barcode text-sm"></i>
                <span>Q-CIS v2.4.0-STABLE</span>
            </div>
            <p class="text-[10px] text-slate-400">
                &copy; 2024 INDUSTRIAL DYNAMICS SOLUTIONS
            </p>
        </div>

    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>