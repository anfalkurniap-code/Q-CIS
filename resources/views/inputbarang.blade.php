<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS Mobile - Input Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen">

    <div class="w-full max-w-[400px] bg-[#f8fafc] min-h-screen flex flex-col justify-between shadow-2xl relative">
        
        <div class="p-5 pb-24">
            
            <!-- Header TopBar -->
            <div class="flex justify-between items-center mb-5 pt-2">
                <div class="flex items-center gap-2 text-[#064e3b] font-extrabold text-lg tracking-tight">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span>Q-CIS</span>
                </div>
                <button class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
            </div>

            <!-- Page Title -->
            <div class="mb-5">
                <h1 class="text-xl font-bold text-gray-900 leading-tight">Input Barang</h1>
                <p class="text-xs text-gray-500 mt-1">Catat barang masuk baru ke dalam inventaris gudang.</p>
            </div>

            <!-- Alert Sukses -->
            @if(session('success'))
                <div class="mb-4 p-3 bg-emerald-100 border border-emerald-400 text-emerald-700 text-xs rounded-lg font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Alert Error Validasi -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 text-xs rounded-lg font-medium">
                    <p class="font-bold">Gagal menyimpan data:</p>
                    <ul class="list-disc pl-4 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Nama Barang -->
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 tracking-wider uppercase mb-1">Nama Barang</label>
                    <input type="text" name="product_name" value="{{ old('product_name') }}" placeholder="Contoh: Pallet Kayu Standard" class="w-full bg-white border border-gray-200 rounded-lg py-2.5 px-3 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-emerald-600" required>
                    @error('product_name') <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p> @enderror
                </div>

                <!-- Jumlah (QTY / Stock) -->
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 tracking-wider uppercase mb-1">Jumlah Stock</label>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="decrementQty()" class="w-10 h-10 bg-blue-100/70 text-blue-600 rounded-lg font-bold text-lg flex items-center justify-center hover:bg-blue-200 transition">-</button>
                        <input type="number" id="qtyInput" name="current_stock" value="{{ old('current_stock', 1) }}" min="1" class="w-full h-10 bg-white border border-gray-200 rounded-lg text-center font-bold text-gray-800 text-sm focus:outline-none focus:border-emerald-600" required>
                        <button type="button" onclick="incrementQty()" class="w-10 h-10 bg-[#064e3b] text-white rounded-lg font-bold text-lg flex items-center justify-center hover:bg-[#043a2c] transition">+</button>
                    </div>
                    @error('current_stock') <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p> @enderror
                </div>

                <!-- Harga Barang -->
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 tracking-wider uppercase mb-1">Harga Barang (Price)</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-xs text-gray-500 font-medium">Rp</span>
                        <input type="number" name="selling_price" value="{{ old('selling_price', 0) }}" class="w-full bg-white border border-gray-200 rounded-lg py-2.5 pl-9 pr-3 text-sm text-gray-800 focus:outline-none focus:border-emerald-600" required>
                    </div>
                    @error('selling_price') <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p> @enderror
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="w-full bg-[#064e3b] text-white font-bold py-3.5 px-4 rounded-xl flex items-center justify-center gap-2 hover:bg-[#043a2c] transition shadow-md mt-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    <span>Simpan Data</span>
                </button>

            </form>
        </div>

    </div>

    <script>
        function incrementQty() {
            const qtyInput = document.getElementById('qtyInput');
            qtyInput.value = parseInt(qtyInput.value || 0) + 1;
        }

        function decrementQty() {
            const qtyInput = document.getElementById('qtyInput');
            if (parseInt(qtyInput.value) > 1) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
            }
        }
    </script>
</body>
</html>