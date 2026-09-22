<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ringkasan Pesanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4">

  <div class="w-full max-w-sm bg-white rounded-2xl p-6 border-2 border-dashed border-gray-300 shadow-sm text-gray-700">
    
    <!-- Tombol Kembali -->
    <div class="mb-4">
      <a href="{{ Route::has('riwayat.transaksi') ? route('riwayat.transaksi') : url('/Riwayattransaksi') }}" class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold flex items-center gap-1">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Riwayat
      </a>
    </div>

    <!-- Judul -->
    <h2 class="text-xl font-extrabold text-[#0F172A] mb-5">Ringkasan Pesanan</h2>

    <!-- Daftar Produk (Dinamis dari Database) -->
    <div class="space-y-4 text-sm">
      @foreach($transaksi->details as $detail)
      <div class="flex justify-between items-start gap-2">
        <span class="text-gray-600 leading-snug">{{ $detail->product_name }} ({{ $detail->quantity ?? $detail->qty ?? 1 }}x)</span>
        <span class="font-bold text-[#0F172A] whitespace-nowrap">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
      </div>
      @endforeach
    </div>

    <hr class="my-5 border-gray-200">

    <!-- Rincian Biaya -->
    <div class="space-y-2.5 text-sm">
      <div class="flex justify-between items-center">
        <span class="text-gray-600">Subtotal</span>
        <span class="font-medium text-[#0F172A]">Rp {{ number_format($transaksi->subtotal ?? $transaksi->total_price, 0, ',', '.') }}</span>
      </div>

      @if(!empty($transaksi->diskon))
      <div class="flex justify-between items-center">
        <span class="text-gray-600">Diskon</span>
        <span class="font-medium text-red-600">-Rp {{ number_format($transaksi->diskon, 0, ',', '.') }}</span>
      </div>
      @endif

      @if(!empty($transaksi->pajak))
      <div class="flex justify-between items-center">
        <span class="text-gray-600">Pajak</span>
        <span class="font-medium text-[#0F172A]">Rp {{ number_format($transaksi->pajak, 0, ',', '.') }}</span>
      </div>
      @endif
    </div>

    <hr class="my-5 border-gray-200">

    <!-- Total Akhir -->
    <div class="flex justify-between items-center mb-5">
      <span class="font-bold text-[#0F172A] text-lg">Total Akhir</span>
      <span class="font-extrabold text-[#007A37] text-2xl">Rp {{ number_format($transaksi->total_price, 0, ',', '.') }}</span>
    </div>

    <hr class="my-5 border-gray-200">

    <!-- Detail Transaksi -->
    <div class="space-y-2 text-xs">
      <div class="flex justify-between items-center">
        <span class="text-gray-500">ID Transaksi</span>
        <span class="font-semibold text-gray-700">{{ $transaksi->invoice_number ?? $transaksi->code ?? ('TRX-'.$transaksi->id) }}</span>
      </div>

      <div class="flex justify-between items-center">
        <span class="text-gray-500">Waktu Transaksi</span>
        <span class="font-semibold text-gray-700">
          @if(!empty($transaksi->created_at))
            {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }} WIB
          @else
            {{ $transaksi->waktu ?? '-' }}
          @endif
        </span>
      </div>
    </div>
  </div>

</body>
</html>