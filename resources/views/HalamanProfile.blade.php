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
                <!-- Logo Shopping Bag Lingkaran Putih Sesuai Gambar -->
                <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center border border-slate-100 shadow-sm">
                    <i class="fa-solid fa-bag-shopping text-[#0d624a] text-sm"></i>
                </div>
                <span class="font-bold text-emerald-600 text-lg tracking-tight">Q-CIS SMK Mart</span>
            </div>
            
            <div class="flex items-center gap-3">
                <!-- Lonceng Notifikasi dengan Badge Merah -->
                <button class="relative p-1 text-emerald-600">
                    <i class="fa-regular fa-bell text-xl"></i>
                    <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                </button>
                <!-- Avatar Header Kanan -->
                <img id="header-avatar" src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&q=80&w=300" 
                     alt="Header Avatar" 
                     class="w-9 h-9 rounded-full object-cover border border-gray-200">
            </div>
        </div>

        <div class="p-4 space-y-5">

            <!-- Card Profil Utama -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col items-center text-center">
                <div class="relative mb-3">
                    <img id="main-avatar" src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&q=80&w=300" 
                         alt="Budi Santoso" 
                         class="w-28 h-28 rounded-full object-cover border-4 border-slate-50 shadow-inner">
                    
                    <!-- Tombol Edit Pensil Hijau -->
                    <button id="edit-btn" onclick="toggleEditNama()" title="Ubah Nama & Foto" class="absolute bottom-0 right-1 bg-emerald-500 hover:bg-emerald-600 text-white p-2.5 rounded-full shadow-md transition-transform active:scale-95 flex items-center justify-center">
                        <i id="edit-icon" class="fa-solid fa-pen text-xs"></i>
                    </button>

                    <!-- Input Tersembunyi untuk Upload Foto Profil -->
                    <input type="file" id="image-upload" accept="image/*" class="hidden" onchange="previewImage(event)">
                </div>

                <!-- Input Nama / Teks Nama (Dibuat Editable) -->
                <div class="w-full flex justify-center items-center">
                    <h2 id="nama-user" class="text-xl font-bold text-slate-800 outline-none rounded-lg px-2 py-0.5 border border-transparent transition-all">Budi Santoso</h2>
                </div>

            </div>

            <p class="text-xs font-semibold text-slate-400 tracking-wider px-1">Pengaturan Akun</p>

            <!-- Group 1: IDENTITAS & KEAMANAN -->
            <div class="space-y-2">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-1">Identitas & Keamanan</p>
                <div class="bg-white rounded-2xl border border-slate-100 divide-y divide-slate-50 shadow-sm overflow-hidden">
                    
                    <!-- Informasi Akun -->
                    <a href="#" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <i class="fa-regular fa-user text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-800">Informasi Akun</h3>
                                <p class="text-xs text-slate-400">Update profil dan data diri</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-xs text-slate-300"></i>
                    </a>

                    <!-- Pengaturan Keamanan -->
                    <a href="#" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
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
                    <a href="#" class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
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
            <a href="{{ url('/loginKasir') }}"  
                class="w-full bg-red-100/80 hover:bg-red-200/80 text-red-500 font-bold p-3.5 rounded-2xl flex items-center justify-center gap-2 text-sm transition-colors active:scale-98">
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

            <a href="#" class="flex flex-col items-center text-slate-400 gap-1 hover:text-emerald-600">
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

    <!-- Script JavaScript untuk Fungsi Edit Inline -->
    <script>
        function toggleEditNama() {
            const namaEl = document.getElementById('nama-user');
            const editBtn = document.getElementById('edit-btn');
            const editIcon = document.getElementById('edit-icon');

            if (namaEl.contentEditable === "true") {
                // Selesai Mode Edit (Simpan Nama)
                namaEl.contentEditable = "false";
                
                // Hapus Style Highlight
                namaEl.classList.remove('bg-emerald-50', 'border-emerald-400', 'ring-2', 'ring-emerald-200');
                namaEl.classList.add('border-transparent');
                
                // Ubah Icon Kembali ke Pensil
                editIcon.className = "fa-solid fa-pen text-xs";
                editBtn.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                editBtn.classList.add('bg-emerald-500', 'hover:bg-emerald-600');

                // Tampilkan Notifikasi Toast
                showToast();

            } else {
                // Masuk Mode Edit Nama
                namaEl.contentEditable = "true";
                namaEl.focus();

                // Pilih Semua Teks Biar Gampang Diubah
                const range = document.createRange();
                range.selectNodeContents(namaEl);
                const sel = window.getSelection();
                sel.removeAllRanges();
                sel.addRange(range);

                // Tambahkan Style Highlight Edit
                namaEl.classList.remove('border-transparent');
                namaEl.classList.add('bg-emerald-50', 'border-emerald-400', 'ring-2', 'ring-emerald-200');

                // Ubah Icon Jadi Centang (Check)
                editIcon.className = "fa-solid fa-check text-xs";
                editBtn.classList.remove('bg-emerald-500', 'hover:bg-emerald-600');
                editBtn.classList.add('bg-blue-500', 'hover:bg-blue-600');

                // Opsional: Buka File Picker jika ingin mengganti Foto Profil juga
                // document.getElementById('image-upload').click();
            }
        }

        // Tekan Enter untuk Simpan Nama
        document.getElementById('nama-user').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Mencegah pindah baris
                toggleEditNama();
            }
        });

        // Fungsi Pratinjau Foto Profil Jika Di-upload
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('main-avatar').src = reader.result;
                document.getElementById('header-avatar').src = reader.result;
            }
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
                showToast();
            }
        }

        // Fungsi Menampilkan Notifikasi Berhasil
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