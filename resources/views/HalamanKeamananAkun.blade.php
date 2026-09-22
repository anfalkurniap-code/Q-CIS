<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keamanan Akun</title>
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Font Awesome Icons CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-[#F8FAFC] text-gray-800 flex justify-center py-6 px-4">

  <div class="w-full max-w-md space-y-4">

    <!-- Top Navigation Header -->
    <div class="flex items-center justify-between py-2">
      <div class="flex items-center space-x-3">
        <a href="javascript:history.back()" class="text-emerald-800 hover:text-emerald-900">
          <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <a href="{{ url('/HalamanProfile') }}">
         <h1 class="text-lg font-bold text-emerald-900 hover:underline cursor-pointer">Keamanan</h1>
        </a>
      </div>
      <div class="w-9 h-9 bg-emerald-100/60 rounded-xl flex items-center justify-center text-emerald-800">
        <i class="fa-solid fa-shield-halved text-lg"></i>
      </div>
    </div>

    <!-- Title Section -->
    <div class="pt-2">
      <h2 class="text-xl font-bold text-gray-900">Keamanan Akun</h2>
      <p class="text-xs text-gray-500 mt-1">Kelola kata sandi dan sesi login akun Anda.</p>
    </div>

    <!-- Notifikasi Alert Sukses & Error -->
    @if (session('success'))
      <div class="p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl flex items-center space-x-2.5 shadow-sm">
        <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0"></i>
        <span class="font-semibold">{{ session('success') }}</span>
      </div>
    @endif

    @if ($errors->any())
      <div class="p-3.5 bg-red-50 border border-red-200 text-red-700 text-xs rounded-xl space-y-1 shadow-sm">
        <div class="flex items-center space-x-2 font-semibold">
          <i class="fa-solid fa-circle-exclamation text-red-500 text-base shrink-0"></i>
          <span>Gagal memperbarui kata sandi:</span>
        </div>
        <ul class="list-disc list-inside text-gray-600 pl-6 space-y-0.5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Card 1: Form Ubah Kata Sandi -->
    <form action="{{ route('keamanan.update') }}" method="POST" class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 space-y-4">
      @csrf
      @method('PUT')
      
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-700">
          <i class="fa-solid fa-rotate-left text-lg"></i>
        </div>
        <h3 class="font-semibold text-gray-800">Ubah Kata Sandi</h3>
      </div>

      <!-- Input Fields -->
      <div class="space-y-3">
        <!-- Kata Sandi Saat Ini -->
        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-1">Kata Sandi Saat Ini</label>
          <div class="relative">
            <input type="password" id="current_password" name="current_password" placeholder="••••••••" class="w-full bg-slate-50 border @error('current_password') border-red-400 focus:border-red-500 @else border-gray-200 focus:border-emerald-600 @enderror rounded-lg px-3 py-2 pr-10 text-sm text-gray-700 focus:outline-none placeholder-gray-400" required>
            <button type="button" onclick="togglePassword('current_password', this)" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 cursor-pointer">
              <i class="fa-regular fa-eye"></i>
            </button>
          </div>
          @error('current_password')
            <p class="text-[11px] text-red-500 mt-1 font-medium">{{ $message }}</p>
          @enderror
        </div>

        <!-- Kata Sandi Baru -->
        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-1">Kata Sandi Baru</label>
          <div class="relative">
            <input type="password" id="password" name="password" placeholder="••••••••" class="w-full bg-slate-50 border @error('password') border-red-400 focus:border-red-500 @else border-gray-200 focus:border-emerald-600 @enderror rounded-lg px-3 py-2 pr-10 text-sm text-gray-700 focus:outline-none placeholder-gray-400" required>
            <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 cursor-pointer">
              <i class="fa-regular fa-eye"></i>
            </button>
          </div>
          @error('password')
            <p class="text-[11px] text-red-500 mt-1 font-medium">{{ $message }}</p>
          @enderror
        </div>

        <!-- Konfirmasi Kata Sandi -->
        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-1">Konfirmasi Kata Sandi</label>
          <div class="relative">
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" class="w-full bg-slate-50 border @error('password_confirmation') border-red-400 focus:border-red-500 @else border-gray-200 focus:border-emerald-600 @enderror rounded-lg px-3 py-2 pr-10 text-sm text-gray-700 focus:outline-none placeholder-gray-400" required>
            <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 cursor-pointer">
              <i class="fa-regular fa-eye"></i>
            </button>
          </div>
          @error('password_confirmation')
            <p class="text-[11px] text-red-500 mt-1 font-medium">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <!-- Tips Box -->
      <div class="bg-slate-50 border-l-4 border-emerald-600 rounded-r-lg p-3 text-xs text-gray-600">
        <span class="font-semibold text-emerald-800">Tips:</span> Gunakan minimal 8 karakter dengan kombinasi angka & simbol.
      </div>

      <!-- Submit Button -->
      <button type="submit" class="w-full bg-[#14532d] hover:bg-[#0f3d21] text-white font-medium py-3 px-4 rounded-xl flex items-center justify-center space-x-2 transition duration-200 shadow-sm cursor-pointer">
        <i class="fa-regular fa-id-card text-sm"></i>
        <span class="text-sm">Simpan Kata Sandi Baru</span>
      </button>
    </form>

    <!-- Card 2: Sesi Aktif -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 space-y-4">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
          <i class="fa-solid fa-display text-lg"></i>
        </div>
        <h3 class="font-semibold text-gray-800">Sesi Aktif</h3>
      </div>

      <!-- Device 1 -->
      <div class="flex items-center justify-between pt-1">
        <div class="flex items-center space-x-3">
          <i class="fa-solid fa-desktop text-gray-500 text-lg"></i>
          <div>
            <p class="text-xs font-semibold text-gray-800">Chrome on MacOS</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wide">JAKARTA • SESI INI</p>
          </div>
        </div>
      </div>

      <!-- Device 2 -->
      <div class="flex items-center justify-between pt-1">
        <div class="flex items-center space-x-3">
          <i class="fa-solid fa-mobile-screen-button text-gray-500 text-lg"></i>
          <div>
            <p class="text-xs font-semibold text-gray-800">iPhone 13 - App</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wide">JAKARTA • 2 JAM LALU</p>
          </div>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="inline">
          @csrf
          <button type="submit" class="text-red-500 hover:text-red-700 cursor-pointer" title="Keluar sesi">
            <i class="fa-solid fa-right-from-bracket"></i>
          </button>
        </form>
      </div>

      <!-- Logout All Button -->
      <div class="pt-2 text-center">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="text-xs font-semibold text-red-600 hover:text-red-700 inline-flex items-center gap-1.5 cursor-pointer">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            Keluar dari Semua Perangkat
          </button>
        </form>
      </div>
    </div>

  </div>
  <script>
  function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');

    if (input.type === "password") {
      input.type = "text";
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = "password";
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  }
</script>
</body>
</html>