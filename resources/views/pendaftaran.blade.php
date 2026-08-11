<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - Q-CIS SMK Mart</title>
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
<body class="flex justify-center items-center min-h-screen p-4">

    <div class="w-full max-w-[360px] bg-[#F8FAFC] min-h-[640px] flex flex-col items-center pb-8 border border-gray-100 rounded-3xl shadow-sm overflow-hidden">
        
        <!-- Header Top Bar -->
        <div class="w-full bg-white px-4 py-3.5 flex items-center border-b border-gray-100 mb-6">
            <a href="javascript:history.back()" class="text-[#064E3B] hover:opacity-80 transition-opacity">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h1 class="text-[17px] font-bold text-[#064E3B] ml-4">Pendaftaran</h1>
        </div>

        <div class="px-5 w-full flex flex-col items-center">
            <!-- Icon Home/Kantin -->
            <div class="w-14 h-14 bg-[#064E3B] rounded-full flex items-center justify-center text-white mb-3 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </div>

            <!-- Subtitle -->
            <p class="text-[11px] font-bold text-[#064E3B] tracking-tight mb-1 text-center">
                Akses Terbatas Administrator
            </p>

            <!-- Deskripsi -->
            <p class="text-[11px] text-gray-600 text-center leading-relaxed font-medium mb-8 px-2">
                Pendaftaran akun Q-CIS SMK Mart sepenuhnya dikelola oleh administrator sekolah untuk memastikan validitas data siswa dan staf.
            </p>

            <!-- Judul Jalur Komunikasi -->
            <h2 class="text-[15px] font-bold text-[#064E3B] mb-4 text-center">
                Pilih Jalur Komunikasi
            </h2>

            <!-- Card WhatsApp (Diperbarui dengan API WhatsApp & Pesan Otomatis) -->
            <a href="https://api.whatsapp.com/send?phone=628888490847&text=Halo%20Admin,%20saya%20ingin%20mengajukan%20pendaftaran%20akun%20Q-CIS%20SMK%20Mart" target="_blank" class="w-full bg-white border border-gray-100 rounded-2xl p-3.5 mb-3 shadow-sm flex items-center gap-3.5 hover:bg-gray-50 transition-colors">
                <div class="w-10 h-10 rounded-full bg-[#DCFCE7] flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#10B981" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a.596.596 0 01-.743-.65 4.31 4.31 0 01.88-1.883C4.195 16.92 3 14.582 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-[12px] font-bold text-gray-800 leading-tight">Chat WhatsApp</span>
                    <span class="text-[10px] text-gray-500 mt-0.5 font-medium">Respon cepat (Jam Kerja)</span>
                </div>
            </a>

            <!-- Card Email -->
            <a href="mailto:admin.mart@smk.sch.id" class="w-full bg-white border border-gray-100 rounded-2xl p-3.5 mb-8 shadow-sm flex items-center gap-3.5 hover:bg-gray-50 transition-colors">
                <div class="w-10 h-10 rounded-full bg-[#DCFCE7] flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#10B981" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-[12px] font-bold text-gray-800 leading-tight">Kirim Email</span>
                    <span class="text-[10px] text-gray-500 mt-0.5 font-medium">admin.mart@smk.sch.id</span>
                </div>
            </a>

            <!-- Footer Note -->
            <p class="text-[9.5px] text-gray-500 text-center font-medium">
                Waktu Pelayanan: Senin - Jumat, 08.00 - 15.00 WIB
            </p>
        </div>

    </div>

</body>
</html>