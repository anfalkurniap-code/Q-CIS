<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS Mobile - Kelola Gudang</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Roboto+Mono:wght@700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono-custom { font-family: 'Roboto Mono', monospace; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-200 min-h-screen flex items-center justify-center p-0 sm:p-4">

    <!-- Container Tampilan Mobile -->
    <div class="w-full max-w-[420px] bg-[#f8fafb] min-h-screen sm:min-h-[840px] shadow-2xl relative flex flex-col justify-between overflow-hidden sm:rounded-3xl border border-slate-200">

        <!-- CONTENT SECTION -->
        <div class="overflow-y-auto pb-28">

            <!-- Header Navbar -->
            <header class="bg-white px-5 py-4 flex items-center justify-between border-b border-slate-100 sticky top-0 z-20 shadow-sm">
                <div class="flex items-center gap-2">
                    <div class="text-[#024d35] text-xl">
                        <i class="fa-solid fa-warehouse"></i>
                    </div>
                    <span class="text-xl font-extrabold text-[#024d35] tracking-tight">Q-CIS</span>
                </div>
                <!-- Tombol Histori / Riwayat -->
                <a href="{{ Route::has('Riwayatgudang') ? route('Riwayatgudang') : url('/Riwayatgudang') }}" class="flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-[#024d35] bg-slate-100 hover:bg-slate-200/80 px-3 py-1.5 rounded-full transition">
                    <i class="fa-solid fa-clock-rotate-left text-sm text-[#024d35]"></i>
                    <span>Riwayat</span>
                </a>
            </header>

            <!-- Main Content Container -->
            <main class="p-4 space-y-4">

                <!-- Alert Session Success -->
                @if(session('success'))
                    <div class="bg-emerald-100 border border-emerald-400 text-emerald-800 text-xs px-3 py-2 rounded-xl flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-600"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Summary Cards -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white p-3.5 rounded-2xl border border-slate-200/80 shadow-sm">
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-wider block mb-1">TOTAL SKU</span>
                        <span class="text-2xl font-black text-slate-800">{{ $totalSku ?? $products->count() }}</span>
                    </div>
                    <a href="{{ Route::has('stok.kritis') ? route('stok.kritis') : '#' }}" class="bg-red-50 p-3.5 rounded-2xl border border-red-100 shadow-sm block hover:bg-red-100/50 transition">
                        <span class="text-[9px] font-black text-red-500 uppercase tracking-wider block mb-1">STOK KRITIS</span>
                        <div class="flex items-center gap-1.5 text-red-600 font-black text-xl">
                            <i class="fa-solid fa-triangle-exclamation text-base"></i>
                            <span>{{ $stokKritisCount ?? $products->where('stock', '<=', 10)->count() }}</span>
                        </div>
                    </a>
                </div>

                <!-- Input Pencarian -->
                <div class="relative flex items-center">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 text-slate-400 text-xs"></i>
                    <input 
                        type="text" 
                        id="searchInput"
                        placeholder="Cari ID, Nama, atau Kategori..." 
                        class="w-full bg-white border border-slate-200 text-xs font-medium text-slate-800 pl-9 pr-10 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#024d35]"
                    />
                    <button type="button" class="absolute right-3 text-slate-400 hover:text-slate-600">
                        <i class="fa-solid fa-barcode text-base text-[#024d35]"></i>
                    </button>
                </div>

                <!-- Product Cards List -->
                <div class="space-y-3" id="productList">
                    @forelse($products as $product)
                        <div class="product-item bg-white rounded-2xl p-4 border {{ $product->stock <= 10 ? 'border-red-200' : 'border-slate-200/80' }} shadow-sm relative space-y-3">
                            
                            <!-- Header Card: ID, Kategori, & Nama Produk -->
                            <div class="space-y-1">
                                <div class="flex items-center justify-between">
                                    <span class="text-[9px] font-extrabold text-[#028b5e] uppercase tracking-wider font-mono-custom">
                                        ID-PROD#{{ $product->id }}
                                    </span>
                                    <!-- BADGE KATEGORI (Disesuaikan untuk berbagai nama kolom) -->
                                    <span class="bg-emerald-50 text-[#024d35] text-[9px] font-bold px-2 py-0.5 rounded-md border border-emerald-100 uppercase">
                                        <i class="fa-solid fa-tag text-[8px] mr-0.5"></i>
                                        {{ $product->category->name ?? $product->category_name ?? $product->kategori ?? $product->category ?? 'Tanpa Kategori' }}
                                    </span>
                                </div>
                                <h3 class="product-name text-sm font-extrabold text-slate-800 leading-tight">
                                    {{ $product->product_name ?? $product->name }}
                                </h3>
                            </div>

                            <!-- Detail Harga (Beli & Jual) serta Stok -->
                            <div class="grid grid-cols-3 gap-2 text-xs pt-2 border-t border-slate-100">
                                <!-- Harga Beli (Disesuaikan untuk berbagai nama kolom database) -->
                                <div>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase block">Harga Beli</span>
                                    <span class="font-bold text-slate-500">
                                        Rp {{ number_format($product->purchase_price ?? $product->harga_beli ?? $product->harga_modal ?? $product->cost_price ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                                <!-- Harga Jual -->
                                <div>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase block">Harga Jual</span>
                                    <span class="font-extrabold text-slate-800">
                                        Rp {{ number_format($product->selling_price ?? $product->price ?? $product->harga_jual ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                                <!-- Stok -->
                                <div class="text-right">
                                    <span class="text-[9px] font-bold text-slate-400 uppercase block">Stok</span>
                                    <span class="font-black {{ $product->stock <= 10 ? 'text-red-500' : 'text-emerald-700' }} text-sm">
                                        {{ $product->stock }} <span class="text-[10px] font-normal text-slate-500">Pcs</span>
                                    </span>
                                </div>
                            </div>

                            <!-- TANGGAL KADALUARSA -->
                            <div class="flex items-center justify-between text-[11px] bg-slate-50 px-3 py-2 rounded-xl border border-slate-100">
                                <div class="flex items-center gap-1.5 text-slate-500 font-semibold">
                                    <i class="fa-regular fa-calendar-xmark text-red-500 text-xs"></i>
                                    <span>Expired:</span>
                                </div>
                                <span class="font-bold text-slate-800">
                                    @if(!empty($product->expired_date))
                                        {{ \Carbon\Carbon::parse($product->expired_date)->format('d M Y') }}
                                    @elseif(!empty($product->tgl_kadaluarsa))
                                        {{ \Carbon\Carbon::parse($product->tgl_kadaluarsa)->format('d M Y') }}
                                    @else
                                        <span class="text-slate-400 font-normal italic">Tidak Ada</span>
                                    @endif
                                </span>
                            </div>

                            <!-- Footer Card: Badge Status & Action Buttons -->
                            <div class="flex items-center justify-between pt-1">
                                <div class="flex items-center gap-1.5">
                                    @if($product->stock <= 10)
                                        <span class="bg-red-100 text-red-600 text-[9px] font-black px-2 py-0.5 rounded-md uppercase">KRITIS</span>
                                    @endif
                                    <span class="text-[10px] font-bold text-slate-400 flex items-center gap-1">
                                        <i class="fa-solid fa-location-dot"></i> Gudang Utama
                                    </span>
                                </div>
                                
                                <!-- Action Buttons (Update & Delete) -->
                                <div class="flex items-center gap-1.5">
                                    <!-- Tombol Update -->
                                    <button type="button" 
                                        onclick="openUpdateModal('{{ $product->id }}', '{{ addslashes($product->product_name ?? $product->name) }}', '{{ $product->selling_price ?? $product->price ?? $product->harga_jual ?? 0 }}')" 
                                        class="bg-[#024d35] hover:bg-[#013827] text-white px-2.5 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider flex items-center gap-1 transition shadow-sm">
                                        <i class="fa-solid fa-pen-to-square text-[10px]"></i> Update
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <button type="button"
                                        onclick="openDeleteModal('{{ $product->id }}', '{{ addslashes($product->product_name ?? $product->name) }}')"
                                        class="bg-red-100 hover:bg-red-200 text-red-600 px-2.5 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider flex items-center gap-1 transition shadow-sm">
                                        <i class="fa-solid fa-trash-can text-[10px]"></i> Hapus
                                    </button>
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-10 bg-white rounded-2xl border border-dashed border-slate-300">
                            <i class="fa-solid fa-box-open text-3xl text-slate-300 mb-2"></i>
                            <p class="text-xs font-bold text-slate-500">Belum ada barang di inventaris.</p>
                        </div>
                    @endforelse
                </div>

            </main>
        </div>

        <!-- Floating Add Button -->
        <a href="{{ Route::has('products.create') ? route('products.create') : '#' }}" class="fixed sm:absolute bottom-20 right-5 w-12 h-12 bg-[#00f0aa] text-[#024d35] rounded-full flex items-center justify-center shadow-lg hover:scale-105 active:scale-95 transition z-50">
            <i class="fa-solid fa-plus text-xl"></i>
        </a>

        <!-- Bottom Navigation Bar -->
        <nav class="fixed sm:absolute bottom-0 left-0 right-0 bg-white border-t border-slate-200 px-3 py-2 flex items-center justify-around z-40">
            <!-- 1. Dashboard -->
            <a href="{{ Route::has('dashboard.gudang') ? route('dashboard.gudang') : '#' }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-solid fa-border-all text-base mb-0.5"></i>
                <span>Dashboard</span>
            </a>

            <!-- 2. Kelola (Aktif) -->
            <a href="{{ Route::has('kelola.gudang') ? route('kelola.gudang') : '#' }}" class="flex flex-col items-center justify-center bg-[#00f0aa] text-[#024d35] px-4 py-1.5 rounded-xl font-bold text-[10px]">
                <i class="fa-solid fa-box-archive text-base mb-0.5"></i>
                <span>Kelola</span>
            </a>

            <!-- 3. Input Barang -->
            <a href="{{ Route::has('products.create') ? route('products.create') : '#' }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-regular fa-square-plus text-base mb-0.5"></i>
                <span>Input</span>
            </a>

            <!-- 4. Stok Kritis -->
            <a href="{{ Route::has('stok.kritis') ? route('stok.kritis') : '#' }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-solid fa-triangle-exclamation text-base mb-0.5"></i>
                <span>Kritis</span>
            </a>

            <!-- 5. Profile Gudang -->
            <a href="{{ Route::has('profil.gudang') ? route('profil.gudang') : '#' }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-regular fa-user text-base mb-0.5"></i>
                <span>Profile</span>
            </a>
        </nav>

    </div>

    <!-- MODAL POPUP UPDATE HARGA BARANG -->
    <div id="updateModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl w-full max-w-sm p-5 shadow-2xl relative animate-in fade-in zoom-in duration-150">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-slate-100">
                <h3 class="text-sm font-extrabold text-[#024d35]">Update Harga Jual</h3>
                <button type="button" onclick="closeUpdateModal()" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form id="updatePriceForm" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Nama Produk</label>
                    <input type="text" id="modalProductName" class="w-full bg-slate-100 border border-slate-200 text-xs font-bold text-slate-700 py-2.5 px-3 rounded-xl cursor-not-allowed" readonly>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Harga Jual Baru (Rp)</label>
                    <input type="number" name="price" id="modalPrice" min="0" required class="w-full border border-slate-300 focus:border-[#024d35] focus:ring-1 focus:ring-[#024d35] text-xs font-bold text-slate-800 py-2.5 px-3 rounded-xl outline-none" placeholder="Masukkan harga baru">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeUpdateModal()" class="px-3.5 py-2 text-xs font-bold text-slate-500 hover:bg-slate-100 rounded-xl transition">Batal</button>
                    <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-[#024d35] hover:bg-[#013827] rounded-xl transition shadow-sm">Simpan Harga</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL POPUP KONFIRMASI HAPUS BARANG -->
    <div id="deleteModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl w-full max-w-sm p-5 shadow-2xl relative text-center space-y-4">
            <div class="w-12 h-12 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto text-xl">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            
            <div>
                <h3 class="text-sm font-extrabold text-slate-800">Hapus Produk Ini?</h3>
                <p class="text-xs text-slate-500 mt-1">
                    Apakah Anda yakin ingin menghapus produk <span id="deleteProductName" class="font-bold text-slate-700"></span>? Data yang dihapus tidak bisa dikembalikan.
                </p>
            </div>

            <form id="deleteForm" action="" method="POST" class="flex justify-center gap-2 pt-2">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="w-1/2 py-2 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition">Batal</button>
                <button type="submit" class="w-1/2 py-2 text-xs font-bold text-white bg-red-600 hover:bg-red-700 rounded-xl transition shadow-sm">Hapus</button>
            </form>
        </div>
    </div>

    <!-- JavaScript Live Search & Modal Control -->
    <script>
        // Live Search
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let items = document.querySelectorAll('#productList .product-item');

            items.forEach(item => {
                let text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? 'block' : 'none';
            });
        });

        // Modal Update Handler
        function openUpdateModal(id, name, currentPrice) {
            const modal = document.getElementById('updateModal');
            const form = document.getElementById('updatePriceForm');
            const nameInput = document.getElementById('modalProductName');
            const priceInput = document.getElementById('modalPrice');

            form.action = "{{ url('/products') }}/" + id + "/update-price";
            nameInput.value = name;
            priceInput.value = currentPrice;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeUpdateModal() {
            const modal = document.getElementById('updateModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Modal Delete Handler
        function openDeleteModal(id, name) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const nameText = document.getElementById('deleteProductName');

            form.action = "{{ url('/products') }}/" + id;
            nameText.textContent = '"' + name + '"';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>
</html>