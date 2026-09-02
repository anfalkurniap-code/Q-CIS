<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Q-CIS SMK Mart - Profil</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      background-color: #f8fafc;
    }
  </style>
</head>

<body class="bg-slate-50 min-h-screen pb-24">

  <!-- Container Utama Mobile View -->
  <div class="max-w-md mx-auto min-h-screen bg-slate-50 relative border-x border-gray-100 shadow-sm">

    <!-- Notifikasi Toast Berhasil Simpan -->
    <div id="toast-success" class="fixed top-5 left-1/2 -translate-x-1/2 z-50 bg-slate-800 text-white text-xs font-semibold px-4 py-2.5 rounded-full shadow-lg flex items-center gap-2 transition-all duration-300 opacity-0 pointer-events-none">
      <i class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
      <span>Profil berhasil diperbarui!</span>
    </div>

    <!-- Top Header Bar -->
    <div class="p-4 bg-white flex items-center justify-between sticky top-0 z-10">
      <div class="flex items-center gap-2.5">
        <!-- Logo Shopping Bag Lingkaran Putih -->
        <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center border border-slate-100 shadow-sm">
          <i class="fa-solid fa-bag-shopping text-[#0d624a] text-sm"></i>
        </div>
        <span class="font-bold text-emerald-600 text-lg tracking-tight">Q-CIS SMK Mart</span>
      </div>

      <div class="flex items-center gap-3">
    
        <!-- Avatar Header Kanan (Otomatis Sync dari Session) -->
        <img id="header-avatar" src="{{ session('user_dummy.avatar', 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&q=80&w=300') }}" alt="Header Avatar" class="w-9 h-9 rounded-full object-cover border border-gray-200">
      </div>
    </div>

    <div class="p-4 space-y-5">

      <!-- Card Profil Utama -->
      <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col items-center text-center">
        <div class="relative mb-3">
          <!-- Avatar Utama (Otomatis Sync dari Session) -->
          <img id="main-avatar" src="{{ session('user_dummy.avatar', 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&q=80&w=300') }}" alt="Avatar User" class="w-28 h-28 rounded-full object-cover border-4 border-slate-50 shadow-inner">

          <!-- Input Tersembunyi untuk Upload Foto Profil -->
          <input type="file" id="image-upload" accept="image/*" class="hidden" onchange="previewImage(event)">
        </div>

        <!-- Input Nama / Teks Nama (Mengambil dari Session Terbaru) -->
        <div class="w-full flex flex-col justify-center items-center">
          <h2 id="nama-user" class="text-xl font-bold text-slate-800 outline-none rounded-lg px-2 py-0.5 border border-transparent transition-all">
            {{ session('user_dummy.name', 'Budi Santoso') }}
          </h2>
          
          <!-- Info Sub-Profil Tambahan (Email, No HP, Kelas, Jurusan) -->
          <p id="email-user" class="text-xs text-slate-400 mt-0.5">
            {{ session('user_dummy.email', 'budi.santoso@smk-qcis.sch.id') }}
          </p>

          <p class="text-[11px] text-slate-400 font-medium mt-0.5">
            {{ session('user_dummy.phone', '+62 812-3456-7890') }}
          </p>

          <div class="flex items-center gap-2 mt-2">
            <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-0.5 rounded-md border border-emerald-100">
              Kelas {{ session('user_dummy.class', 'XI') }}
            </span>
            <span class="bg-slate-100 text-slate-600 text-[10px] font-medium px-2 py-0.5 rounded-md">
              {{ session('user_dummy.major', 'Rekayasa Perangkat Lunak') }}
            </span>
          </div>
        </div>

      </div>

      <p class="text-xs font-semibold text-slate-400 tracking-wider px-1">Pengaturan Akun</p>

      <!-- Group 1: IDENTITAS & KEAMANAN -->
      <div class="space-y-2">
        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-1">Identitas & Keamanan</p>
        <div class="bg-white rounded-2xl border border-slate-100 divide-y divide-slate-50 shadow-sm overflow-hidden">

          <!-- Informasi Akun -->
          <a href="{{ url('/HalamanInformasiAkun') }}" class="flex items-center justify-between p-4 bg-white hover:bg-slate-50 transition-colors border-b border-gray-100">
            <div class="flex items-center gap-3.5">
              <div class="w-11 h-11 rounded-full bg-[#DCFCE7] flex items-center justify-center text-[#16A34A] shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                  <circle cx="12" cy="7" r="4" />
                </svg>
              </div>
              <div class="flex flex-col">
                <span class="font-bold text-slate-800 text-sm">Informasi Akun</span>
                <span class="text-xs text-slate-400">Update profil dan data diri</span>
              </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m9 18 6-6-6-6" />
            </svg>
          </a>

          <!-- Pengaturan Keamanan -->
          <a href="{{ url('/HalamanKeamananAkun') }}" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
            <div class="flex items-center gap-3.5">
              <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                <i class="fa-solid fa-lock text-base"></i>
              </div>
              <div>
                <h3 class="text-sm font-bold text-slate-800">Pengaturan Keamanan</h3>
                <p class="text-xs text-slate-400">Password, PIN & 2FA</p>
              </div>
            </div>
            <i class="fa-solid fa-chevron-right text-xs text-slate-300"></i>
          </a>

        </div>
      </div>

      <!-- Group 2: PUSAT BANTUAN -->
      <div class="space-y-2">
        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-1">Pusat Bantuan</p>
        <div class="bg-white rounded-2xl border border-slate-100 divide-y divide-slate-50 shadow-sm overflow-hidden">

          <!-- Bantuan & FAQ -->
          <a href="{{ url('/BantuanKasir') }}" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
            <div class="flex items-center gap-3.5">
              <div class="w-10 h-10 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center">
                <i class="fa-regular fa-circle-question text-lg"></i>
              </div>
              <div>
                <h3 class="text-sm font-bold text-slate-800">Bantuan & FAQ</h3>
                <p class="text-xs text-slate-400">Panduan penggunaan aplikasi</p>
              </div>
            </div>
            <i class="fa-solid fa-chevron-right text-xs text-slate-300"></i>
          </a>

          <!-- Tentang Aplikasi -->
          <a href="#" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
            <div class="flex items-center gap-3.5">
              <div class="w-10 h-10 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center">
                <i class="fa-solid fa-circle-info text-lg"></i>
              </div>
              <div>
                <h3 class="text-sm font-bold text-slate-800">Tentang Aplikasi</h3>
                <p class="text-xs text-slate-400">Versi, lisensi & syarat</p>
              </div>
            </div>
            <i class="fa-solid fa-chevron-right text-xs text-slate-300"></i>
          </a>

        </div>
      </div>

      <!-- Tombol Keluar Sesi -->
      <a href="{{ url('/loginKasir') }}" class="w-full bg-red-100/80 hover:bg-red-200/80 text-red-500 font-bold p-3.5 rounded-2xl flex items-center justify-center gap-2 text-sm transition-colors active:scale-98">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        Keluar Sesi
      </a>

    </div>

    <!-- Bottom Navigation Bar -->
    <div class="fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white border-t border-slate-100 px-6 py-2.5 flex justify-between items-center z-20">

      <a href="{{ url('/HalamanDepanKasir') }}" class="flex flex-col items-center text-slate-400 gap-1 hover:text-emerald-600">
        <i class="fa-solid fa-house text-lg"></i>
        <span class="text-[10px] font-semibold">Home</span>
      </a>

      <a href="{{ url('/HalamanShop') }}" class="flex flex-col items-center text-slate-400 gap-1 hover:text-emerald-600">
        <i class="fa-solid fa-bag-shopping text-lg"></i>
        <span class="text-[10px] font-semibold">Shop</span>
      </a>

      <a href="{{ url('/Riwayattransaksi') }}" class="flex flex-col items-center text-slate-400 gap-1 hover:text-emerald-600">
        <i class="fa-solid fa-receipt text-lg"></i>
        <span class="text-[10px] font-semibold">Trans</span>
      </a>

      <!-- Menu Profile Aktif (Kotak Hijau) -->
      <a href="#" class="flex flex-col items-center text-emerald-600 gap-0.5">
        <div class="bg-emerald-600 text-white px-4 py-1.5 rounded-xl flex items-center justify-center shadow-sm">
          <i class="fa-solid fa-user text-sm"></i>
        </div>
        <span class="text-[10px] font-bold text-emerald-600">Profile</span>
      </a>

    </div>

  </div>

  <!-- Script JavaScript (Sudah Bersih dari localStorage) -->
  <script>
    function toggleEditNama() {
      const namaEl = document.getElementById('nama-user');
      const editBtn = document.getElementById('edit-btn');
      const editIcon = document.getElementById('edit-icon');

      if (namaEl.contentEditable === "true") {
        namaEl.contentEditable = "false";

        namaEl.classList.remove('bg-emerald-50', 'border-emerald-400', 'ring-2', 'ring-emerald-200');
        namaEl.classList.add('border-transparent');

        editIcon.className = "fa-solid fa-pen text-xs";
        editBtn.classList.remove('bg-blue-500', 'hover:bg-blue-600');
        editBtn.classList.add('bg-emerald-500', 'hover:bg-emerald-600');

        showToast();
      } else {
        namaEl.contentEditable = "true";
        namaEl.focus();

        const range = document.createRange();
        range.selectNodeContents(namaEl);
        const sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);

        namaEl.classList.remove('border-transparent');
        namaEl.classList.add('bg-emerald-50', 'border-emerald-400', 'ring-2', 'ring-emerald-200');

        editIcon.className = "fa-solid fa-check text-xs";
        editBtn.classList.remove('bg-emerald-500', 'hover:bg-emerald-600');
        editBtn.classList.add('bg-blue-500', 'hover:bg-blue-600');
      }
    }

    document.getElementById('nama-user').addEventListener('keydown', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        toggleEditNama();
      }
    });

    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function() {
        document.getElementById('main-avatar').src = reader.result;
        document.getElementById('header-avatar').src = reader.result;
      }
      if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
        showToast();
      }
    }

    function showToast() {
      const toast = document.getElementById('toast-success');
      toast.classList.remove('opacity-0', 'pointer-events-none');
      toast.classList.add('opacity-100');

      setTimeout(() => {
        toast.classList.remove('opacity-100');
        toast.classList.add('opacity-0', 'pointer-events-none');
      }, 2500);
    }
  </script>

</body>

</html>