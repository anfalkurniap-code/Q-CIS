<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Q-CIS SMK MART</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <!-- Container Utama -->
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative flex flex-col justify-between min-h-[600px]">
        
        <div>
            <!-- Tombol Kembali (Harus di paling atas, di luar form) -->
            <a href="{{ url('/') }}" class="w-9 h-9 border border-emerald-500 rounded-lg flex items-center justify-center text-emerald-600 hover:bg-emerald-50 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>

            <!-- Header Branding -->
            <div class="text-center mt-4 mb-6">
                <div class="flex items-center justify-center gap-2 text-emerald-800 mb-2">
                    <svg class="w-7 h-7 fill-emerald-800" viewBox="0 0 24 24">
                        <path d="M19 6h-2c0-2.21-1.79-4-4-4S9 3.79 9 6H7c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-6-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2zm0 10c-1.66 0-3-1.34-3-3h2c0 .55.45 1 1 1s1-.45 1-1h2c0 1.66-1.34 3-3 3z"/>
                    </svg>
                    <h1 class="text-xl font-bold tracking-tight">Q-CIS SMK MART</h1>
                </div>
                <p class="text-xs text-slate-500 font-medium">Selamat Datang.</p>
                <p class="text-xs text-slate-500 font-medium">Silakan masuk untuk mulai bertransaksi</p>
            </div>

            <!-- Form Card Internal -->
            <div x-data="{ showPassword: false }" class="bg-white border border-slate-200/80 rounded-xl p-5 shadow-xs">
                <form action="{{ url('/LoginKepalaToko') }}" method="POST">
                    @csrf

                    <!-- Email / Username -->
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Email atau Username</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400 font-medium text-sm">@</span>
                            <input type="text" name="login" value="{{ old('login') }}" placeholder="nama@gmail.com" required
                                class="w-full pl-8 pr-3 py-2 bg-slate-50/50 border border-slate-200 rounded-lg text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition">
                        </div>
                        @error('login')
                            <span class="text-[10px] text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Kata Sandi -->
                    <div class="mb-5">
                        <div class="flex justify-between items-center mb-1.5">
                            <label class="text-[11px] font-bold tracking-wider uppercase text-slate-600">KATA SANDI</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-emerald-700 hover:underline">Lupa Kata Sandi?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            
                            <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Masukkan Kata Sandi" required
                                class="w-full pl-9 pr-9 py-2 bg-slate-50/50 border border-slate-200 rounded-lg text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition">
                            
                            <!-- Toggle Password Eye -->
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600">
                                <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="showPassword" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.959 8.959 0 013.682-.783c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Tombol Masuk -->
                    <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-900 text-white font-medium py-2.5 px-4 rounded-lg text-xs flex items-center justify-center gap-2 shadow-sm transition cursor-pointer">
                        <span>Masuk ke Aplikasi</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer Card -->
        <div class="mt-6 text-center">
            <p class="text-xs text-slate-600">
                Belum punya akses? 
                <a href="{{ route('pendaftaran') }}" class="font-bold text-emerald-800 hover:underline">Hubungi Admin Sekolah untuk Pendaftaran</a>
            </p>

            <div class="flex items-center justify-center gap-4 mt-4 text-[10px] text-slate-400">
                <div class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>ENTERPRISE SECURE</span>
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4"/>
                    </svg>
                    <span>SMK INTEGRATED</span>
                </div>
            </div>
        </div>

    </div>
</body>
</html>