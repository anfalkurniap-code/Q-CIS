<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ringkasan Pesanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

  <div class="w-full max-w-sm bg-white rounded-2xl p-6 border-2 border-dashed border-gray-300 shadow-sm text-gray-700">
    <!-- Judul -->
    <h2 class="text-xl font-extrabold text-[#0F172A] mb-5">Ringkasan Pesanan</h2>

    <!-- Daftar Produk -->
    <div class="space-y-4 text-sm">
      <div class="flex justify-between items-start gap-2">
        <span class="text-gray-600 leading-snug">Buku Tulis Sidu 58 Lembar (5x)</span>
        <span class="font-bold text-[#0F172A] whitespace-nowrap">Rp 22.500</span>
      </div>

      <div class="flex justify-between items-start gap-2">
        <span class="text-gray-600 leading-snug">Pulpen Standard AE7 Hitam (3x)</span>
        <span class="font-bold text-[#0F172A] whitespace-nowrap">Rp 6.000</span>
      </div>

      <div class="flex justify-between items-start gap-2">
        <span class="text-gray-600 leading-snug">Seragam Sekolah Pramuka L (1x)</span>
        <span class="font-bold text-[#0F172A] whitespace-nowrap">Rp 110.000</span>
      </div>

      <div class="flex justify-between items-start gap-2">
        <span class="text-gray-600 leading-snug">Roti Coklat Sari Roti (1x)</span>
        <span class="font-bold text-[#0F172A] whitespace-nowrap">Rp 7.000</span>
      </div>
    </div>

    <hr class="my-5 border-gray-200">

    <!-- Rincian Biaya -->
    <div class="space-y-2.5 text-sm">
      <div class="flex justify-between items-center">
        <span class="text-gray-600">Subtotal</span>
        <span class="font-medium text-[#0F172A]">Rp 145.500</span>
      </div>

      <div class="flex justify-between items-center">
        <span class="text-gray-600">Diskon (10%)</span>
        <span class="font-medium text-red-600">-Rp 14.550</span>
      </div>

      <div class="flex justify-between items-center">
        <span class="text-gray-600">Pajak (11%)</span>
        <span class="font-medium text-[#0F172A]">Rp 14.405</span>
      </div>
    </div>

    <hr class="my-5 border-gray-200">

    <!-- Total Akhir -->
    <div class="flex justify-between items-center mb-5">
      <span class="font-bold text-[#0F172A] text-lg">Total Akhir</span>
      <span class="font-extrabold text-[#007A37] text-2xl">Rp 145.355</span>
    </div>

    <hr class="my-5 border-gray-200">

    <!-- Detail Transaksi -->
    <div class="space-y-2 text-xs">
      <div class="flex justify-between items-center">
        <span class="text-gray-500">ID Transaksi</span>
        <span class="font-semibold text-gray-700">TRX-98237492</span>
      </div>

      <div class="flex justify-between items-center">
        <span class="text-gray-500">Waktu Transaksi</span>
        <span class="font-semibold text-gray-700">24 Mei 2024, 14:20 WIB</span>
      </div>
    </div>
  </div>

</body>
</html>