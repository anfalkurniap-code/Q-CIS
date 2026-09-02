<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Informasi Akun</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  
  <!-- Google Fonts: Plus Jakarta Sans -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
  </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen text-slate-800 flex justify-center">

  <!-- Mobile Container Wrapper -->
  <div class="w-full max-w-md bg-[#F8FAFC] min-h-screen pb-28 relative px-4 pt-4">

    <!-- Form Pembungkus Utama (Membungkus Seluruh Halaman) -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Top Navigation / Back Button -->
      <div class="w-full bg-[#F8FAFC]">
        <!-- 1. Section Top Bar (Tombol Kembali + Garis Bawah) -->
        <div class="px-2 py-3 border-b border-gray-200">
            <a href="/HalamanProfile" class="inline-flex items-center gap-1.5 text-slate-700 hover:text-slate-900 font-bold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 stroke-[2.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        <!-- 2. Section Judul & Deskripsi -->
        <div class="px-2 pt-6 pb-4">
            <h1 class="text-2xl font-bold text-[#0F172A] tracking-tight mb-2">
                Informasi Akun
            </h1>
            <p class="text-sm text-slate-600 leading-relaxed max-w-sm">
                Kelola data pribadi dan preferensi akun Anda untuk kemudahan transaksi.
            </p>
        </div>
      </div>

      <main class="space-y-4">
        
        <!-- Notifikasi Berhasil Disimpan -->
        @if (session('success'))
          <div class="p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-medium flex items-center gap-2.5 shadow-sm">
            <i class="fa-solid fa-circle-check text-base text-emerald-500"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        <!-- Profile Card -->
        <section class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex flex-col items-center text-center">
          <div class="relative mb-4">
            <!-- Container Foto Profil -->
            <div class="w-28 h-28 rounded-full border-4 border-slate-100 overflow-hidden bg-slate-200 flex items-center justify-center">
              <img id="avatar-preview" src="{{ session('user_dummy.avatar', $user->avatar_url ?? 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?q=80&w=300') }}" alt="Avatar" class="w-full h-full object-cover" />
            </div>
            
            <!-- Tombol Edit Pensil Hijau Bulat -->
            <label for="avatar_input" class="absolute bottom-1 right-1 bg-[#10B981] hover:bg-emerald-600 text-white rounded-full w-9 h-9 flex items-center justify-center shadow-md cursor-pointer transition-transform hover:scale-105 active:scale-95">
              <i class="fa-solid fa-pen text-xs"></i>
            </label>
            <input type="file" id="avatar_input" name="avatar" class="hidden" accept="image/*" onchange="previewAvatar(event)" />
          </div>

          <!-- Nama Lengkap Top Card -->
          <h2 class="text-xl font-bold text-[#0F172A] tracking-tight">
            {{ session('user_dummy.name', $user->name ?? 'Budi Santoso') }}
          </h2>
        </section>

        <!-- Statistik Mart -->
        <section class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
          <h3 class="text-[10px] font-bold text-slate-400 tracking-wider uppercase mb-2">Statistik Mart</h3>
          <div class="grid grid-cols-2 gap-3">
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3">
              <span class="text-[11px] text-slate-500 font-medium block">Saldo</span>
              <span class="text-base font-bold text-[#10B981] mt-0.5 block">Rp{{ isset($user->balance) ? number_format($user->balance, 0, ',', '.') : '120k' }}</span>
            </div>
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3">
              <span class="text-[11px] text-slate-500 font-medium block">Poin</span>
              <span class="text-base font-bold text-slate-800 mt-0.5 block">{{ $user->points ?? '840' }}</span>
            </div>
          </div>
        </section>

        <!-- Detail Personal -->
        <section class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
          <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
            <div class="text-[#10B981] text-base flex items-center">
              <i class="fa-solid fa-id-card"></i>
            </div>
            <h3 class="text-sm font-bold text-slate-800">Detail Personal</h3>
          </div>

          <div class="space-y-3 mt-4">
            <!-- Nama Lengkap -->
            <div>
              <label class="block text-[11px] font-medium text-slate-600 mb-1">Nama Lengkap</label>
              <div class="relative">
                <input type="text" name="name" value="{{ session('user_dummy.name', old('name', $user->name ?? 'Budi Santoso')) }}" class="w-full text-xs font-semibold text-slate-700 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 pr-8 focus:outline-none focus:border-emerald-500 transition-colors" required />
                <i class="fa-regular fa-user absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
              </div>
            </div>

            <!-- Email Sekolah -->
            <div>
              <label class="block text-[11px] font-medium text-slate-600 mb-1">Email Sekolah</label>
              <div class="relative">
                <input type="email" name="email" value="{{ session('user_dummy.email', old('email', $user->email ?? 'budi.santoso@smk-qcis.sch.id')) }}" class="w-full text-xs font-semibold text-slate-700 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 pr-8 focus:outline-none focus:border-emerald-500 transition-colors" required />
                <i class="fa-regular fa-envelope absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
              </div>
            </div>

            <!-- Nomor Telepon -->
            <div>
              <label class="block text-[11px] font-medium text-slate-600 mb-1">Nomor Telepon</label>
              <div class="relative">
                <input type="text" name="phone" value="{{ session('user_dummy.phone', old('phone', $user->phone ?? '+62 812-3456-7890')) }}" class="w-full text-xs font-semibold text-slate-700 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 pr-8 focus:outline-none focus:border-emerald-500 transition-colors" />
                <i class="fa-solid fa-phone absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
              </div>
            </div>

            <!-- Kelas Dropdown -->
            <div>
              <label class="block text-[11px] font-medium text-slate-600 mb-1">Kelas</label>
              <div class="relative">
                <select name="class" class="w-full text-xs font-semibold text-slate-700 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 pr-8 appearance-none focus:outline-none focus:border-emerald-500 transition-colors">
                  <option value="X" {{ session('user_dummy.class', old('class', $user->class ?? '')) == 'X' ? 'selected' : '' }}>X</option>
                  <option value="XI" {{ session('user_dummy.class', old('class', $user->class ?? 'XI')) == 'XI' ? 'selected' : '' }}>XI</option>
                  <option value="XII" {{ session('user_dummy.class', old('class', $user->class ?? '')) == 'XII' ? 'selected' : '' }}>XII</option>
                </select>
                <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
              </div>
            </div>

            <!-- Jurusan Dropdown -->
            <div>
              <label class="block text-[11px] font-medium text-slate-600 mb-1">Jurusan</label>
              <div class="relative">
                <select name="major" class="w-full text-xs font-semibold text-slate-700 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 pr-8 appearance-none focus:outline-none focus:border-emerald-500 transition-colors">
                  <option value="Rekayasa Perangkat Lunak" {{ session('user_dummy.major', old('major', $user->major ?? 'Rekayasa Perangkat Lunak')) == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                  <option value="Teknik Komputer dan Jaringan" {{ session('user_dummy.major', old('major', $user->major ?? '')) == 'Teknik Komputer dan Jaringan' ? 'selected' : '' }}>Teknik Komputer dan Jaringan (TKJ)</option>
                  <option value="Desain Komunikasi Visual" {{ session('user_dummy.major', old('major', $user->major ?? '')) == 'Desain Komunikasi Visual' ? 'selected' : '' }}>Desain Komunikasi Visual (DKV)</option>
                  <option value="Akuntansi dan Keuangan Lembaga" {{ session('user_dummy.major', old('major', $user->major ?? '')) == 'Akuntansi dan Keuangan Lembaga' ? 'selected' : '' }}>Akuntansi dan Keuangan Lembaga (AKL)</option>
                  <option value="Manajemen Perkantoran" {{ session('user_dummy.major', old('major', $user->major ?? '')) == 'Manajemen Perkantoran' ? 'selected' : '' }}>Manajemen Perkantoran (MP)</option>
                  <option value="Bisnis Daring dan Pemasaran" {{ session('user_dummy.major', old('major', $user->major ?? '')) == 'Bisnis Daring dan Pemasaran' ? 'selected' : '' }}>Bisnis Daring dan Pemasaran (BDP)</option>
                  <option value="Teknik Kendaraan Ringan" {{ session('user_dummy.major', old('major', $user->major ?? '')) == 'Teknik Kendaraan Ringan' ? 'selected' : '' }}>Teknik Kendaraan Ringan (TKR)</option>
                  <option value="Teknik Sepeda Motor" {{ session('user_dummy.major', old('major', $user->major ?? '')) == 'Teknik Sepeda Motor' ? 'selected' : '' }}>Teknik Sepeda Motor (TSM)</option>
                </select>
                <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
              </div>
            </div>
          </div>
        </section>
        
      <!-- Bottom Sticky Save Button -->
      <div class="fixed bottom-0 left-0 right-0 p-4 bg-white/80 backdrop-blur-md border-t border-slate-100 flex justify-center z-10">
        <div class="w-full max-w-md">
          <button type="submit" class="w-full bg-[#10B981] hover:bg-emerald-600 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-2 transition-all active:scale-[0.99] text-xs">
            <i class="fa-regular fa-floppy-disk text-sm"></i>
            <span>Simpan Perubahan</span>
          </button>
        </div>
      </div>

    </form> <!-- Penutup Form Utama -->

  </div>

  <!-- JavaScript Preview Foto -->
  <script>
    function previewAvatar(event) {
      const reader = new FileReader();
      reader.onload = function() {
        const preview = document.getElementById('avatar-preview');
        if (preview) {
          preview.src = reader.result;
        }
      };
      if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
      }
    }
  </script>

</body>
</html>