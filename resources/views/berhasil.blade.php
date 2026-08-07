<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="w-full max-w-md bg-white min-h-screen flex flex-col justify-between p-5 shadow-2xl rounded-3xl border border-gray-200">
        
        <div>
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-emerald-700 font-bold text-lg">Q-CIS SMK Mart</h1>
                <span class="text-xs text-gray-500">Bantuan</span>
            </div>

            <div class="bg-gradient-to-b from-emerald-50 to-white p-6 rounded-2xl border border-emerald-100 text-center mb-4">
                <div class="w-16 h-16 bg-emerald-600 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-3 shadow-md">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Pembayaran Berhasil</h2>
                <p class="text-xs text-gray-400 mt-1">Transaksi Anda telah diproses dengan sukses</p>

                <div class="mt-4 pt-3 border-t border-dashed border-emerald-200">
                    <p class="text-[10px] text-gray-400 uppercase font-semibold">Total Pembayaran</p>
                    <p class="text-2xl font-black text-emerald-800 mt-0.5">Rp 12.500</p>
                </div>
            </div>

            <div class="bg-gray-50/60 p-4 rounded-2xl border border-gray-100 text-xs">
                <h3 class="font-bold text-gray-800 mb-3 text-sm">Ringkasan Pesanan</h3>

                <div class="space-y-2.5 mb-4">
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Susu Ultramilk Strawberry 250ml (1x)</span>
                        <span class="font-semibold text-gray-800">Rp 6.000</span>
                    </div>
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Roti Tawar Sari Roti (1x)</span>
                        <span class="font-semibold text-gray-800">Rp 6.500</span>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-3 space-y-1.5 text-gray-500">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>Rp 12.500</span>
                    </div>
                    <div class="flex justify-between text-red-500">
                        <span>Diskon</span>
                        <span>-Rp 0</span>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-3 mt-3 flex justify-between font-bold text-sm text-gray-800">
                    <span>Total Akhir</span>
                    <span class="text-emerald-700">Rp 12.500</span>
                </div>

                <div class="border-t border-gray-200 pt-3 mt-3 space-y-1 text-[11px] text-gray-400">
                    <div class="flex justify-between">
                        <span>ID Transaksi</span>
                        <span class="font-mono text-gray-600">{{ session('trx_id', 'TRX-000000') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Waktu Transaksi</span>
                        <span class="text-gray-600">{{ session('waktu', '-') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 mb-2">
    <a href="{{ url('/HalamanShop') }}" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-4 rounded-xl block text-center shadow-lg shadow-emerald-600/20 transition">
        Selesai
    </a>
</div>
            </a>
        </div>

    </div>

</body>
</html>