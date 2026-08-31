<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran</title>
  <!-- Tailwind CSS CDN & Lucide Icons -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen py-6">

  <!-- Container Utama (Desain Tipe Mobile/Card) -->
  <div class="w-full max-w-sm bg-slate-50 border border-gray-200 rounded-3xl shadow-lg overflow-hidden font-sans pb-8">
    
    <!-- Header -->
    <div class="bg-white px-5 py-4 border-b border-gray-200 flex items-center space-x-3">
      <button class="text-emerald-800 hover:opacity-80">
        <i data-lucide="arrow-left" class="w-6 h-6"></i>
      </button>
      <h1 class="text-xl font-bold text-emerald-800">Pendaftaran</h1>
    </div>

    <div class="px-5 mt-6 flex flex-col items-center">
      
      <!-- Icon Utama -->
      <div class="w-20 h-20 bg-emerald-600 rounded-full flex items-center justify-center shadow-md mb-4">
        <i data-lucide="shopping-bag" class="w-10 h-10 text-white"></i>
      </div>

      <!-- Deskripsi Status -->
      <h2 class="text-sm font-bold text-slate-700 text-center mb-1">Akses Terbatas Administrator</h2>
      <p class="text-xs text-gray-600 text-center leading-relaxed px-2 mb-6">
        Pendaftaran akun Q-CIS SMK Mart sepenuhnya dikelola oleh administrator sekolah untuk memastikan validitas data siswa dan staf.
      </p>

      <!-- Card Lokasi Kantor -->
      <div class="w-full bg-white rounded-2xl p-4 shadow-sm border border-gray-100 mb-6">
        <div class="flex items-start space-x-2 mb-2">
          <i data-lucide="map-pin" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
          <div>
            <h3 class="text-base font-bold text-slate-800">Lokasi Kantor</h3>
            <p class="text-xs font-semibold text-slate-700 mt-1">Gedung Pusat Administrasi</p>
            <p class="text-xs text-slate-600">Lantai 1, Ruang Tata Usaha (TU)<br>SMK Pusat Keunggulan Nusantara</p>
          </div>
        </div>
        <!-- Peta/Gambar -->
        <div class="mt-3 overflow-hidden rounded-xl border border-gray-200">
          <img src="https://via.placeholder.com/400x200?text=Peta+Lokasi" alt="Peta Lokasi" class="w-full h-28 object-cover">
        </div>
      </div>

      <!-- Jalur Komunikasi -->
      <h3 class="text-base font-bold text-slate-800 text-center mb-4">Pilih Jalur Komunikasi</h3>

      <!-- Opsi WhatsApp -->
      <a href="https://wa.me/" target="_blank" class="w-full bg-slate-50 hover:bg-emerald-50 border border-gray-200 hover:border-emerald-300 rounded-2xl p-3.5 mb-3 flex items-center space-x-3 transition-colors">
        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
          <i data-lucide="message-square" class="w-5 h-5 text-emerald-600"></i>
        </div>
        <div>
          <h4 class="text-xs font-bold text-slate-800">Chat WhatsApp</h4>
          <p class="text-[11px] text-slate-500">Respon cepat (Jam Kerja)</p>
        </div>
      </a>

      <!-- Opsi Email -->
      <a href="mailto:admin.mart@smk.sch.id" class="w-full bg-slate-50 hover:bg-emerald-50 border border-gray-200 hover:border-emerald-300 rounded-2xl p-3.5 mb-6 flex items-center space-x-3 transition-colors">
        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
          <i data-lucide="mail" class="w-5 h-5 text-emerald-600"></i>
        </div>
        <div>
          <h4 class="text-xs font-bold text-slate-800">Kirim Email</h4>
          <p class="text-[11px] text-slate-500">admin.mart@smk.sch.id</p>
        </div>
      </a>

      <!-- Footer Jam Kerja -->
      <p class="text-[10px] text-slate-500 font-medium text-center">
        Waktu Pelayanan: Senin - Jumat, 08.00 - 16.00 WIB
      </p>

    </div>
  </div>

  <!-- Script untuk Render Ikon -->
  <script>
    lucide.createIcons();
  </script>
</body>
</html>