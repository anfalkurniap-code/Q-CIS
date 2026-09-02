<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS Mobile - Input Barang</title>
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
        <div class="overflow-y-auto pb-24">

            <!-- Header Navbar -->
            <header class="bg-white px-5 py-4 flex items-center justify-between border-b border-slate-100 sticky top-0 z-20 shadow-sm">
                <div class="flex items-center gap-2">
                    <div class="text-[#024d35] text-xl">
                        <i class="fa-solid fa-warehouse"></i>
                    </div>
                    <span class="text-xl font-extrabold text-[#024d35] tracking-tight">Q-CIS</span>
                </div>
            </header>

            <!-- Main Content Container -->
            <main class="p-5 space-y-4">

                <!-- Title & Subtitle -->
                <div>
                    <h1 class="text-xl font-black text-slate-800 tracking-tight">Input Barang</h1>
                    <p class="text-xs font-medium text-slate-500 mt-0.5">Catat barang masuk baru ke dalam inventaris gudang.</p>
                </div>

                <!-- Alert Sukses -->
                @if(session('success'))
                    <div class="p-3 bg-emerald-100 border border-emerald-400 text-emerald-700 text-xs rounded-xl font-medium flex items-center gap-2">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Alert Error Validasi -->
                @if ($errors->any())
                    <div class="p-3 bg-red-100 border border-red-400 text-red-700 text-xs rounded-xl font-medium">
                        <p class="font-bold flex items-center gap-1.5 mb-1">
                            <i class="fa-solid fa-triangle-exclamation"></i> Gagal menyimpan data:
                        </p>
                        <ul class="list-disc pl-4 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Input -->
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <!-- Barcode Produk -->
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-500 tracking-wider uppercase block mb-1">BARCODE PRODUK</label>
                        <div class="relative flex items-center">
                            <input 
                                type="text" 
                                name="barcode"
                                id="barcode"
                                value="{{ old('barcode') }}"
                                placeholder="Scan atau ketik barcode..." 
                                class="w-full bg-white border border-[#028b5e] text-xs font-mono-custom text-slate-800 pl-3.5 pr-10 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#024d35]"
                            />
                            <button type="button" class="absolute right-3 text-[#028b5e] hover:text-[#024d35]">
                                <i class="fa-solid fa-barcode text-lg"></i>
                            </button>
                        </div>
                        @error('barcode') <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p> @enderror
                    </div>

                    <!-- Nama Barang -->
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-500 tracking-wider uppercase block mb-1">NAMA BARANG</label>
                        <input 
                            type="text" 
                            name="product_name"
                            value="{{ old('product_name') }}"
                            required
                            placeholder="Contoh: Pallet Kayu Standard" 
                            class="w-full bg-white border border-slate-200 text-xs font-medium text-slate-800 px-3.5 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#024d35] placeholder:text-slate-400"
                        />
                        @error('product_name') <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p> @enderror
                    </div>

                    <!-- KATEGORI BARANG -->
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-500 tracking-wider uppercase block mb-1">KATEGORI BARANG</label>
                        <div class="relative">
                            <select name="category_id" required class="w-full bg-white border border-slate-200 text-xs font-medium text-slate-700 px-3.5 py-3 rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-[#024d35]">
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Pilih Kategori</option>
                                @foreach($categories ?? [] as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name ?? $category->nama_kategori ?? $category->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        </div>
                        @error('category_id') <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p> @enderror
                    </div>

                    <!-- TANGGAL KADALUARSA -->
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-500 tracking-wider uppercase block mb-1">TANGGAL KADALUARSA</label>
                        <div class="relative flex items-center">
                            <input 
                                type="date" 
                                name="expired_date"
                                value="{{ old('expired_date') }}"
                                required
                                class="w-full bg-white border border-slate-200 text-xs font-medium text-slate-800 px-3.5 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#024d35]"
                            />
                        </div>
                        @error('expired_date') <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p> @enderror
                    </div>

                    <!-- Jumlah (QTY) -->
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-500 tracking-wider uppercase block mb-1">JUMLAH STOCK (QTY)</label>
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="decrementQty()" class="w-10 h-10 bg-slate-200/80 hover:bg-slate-300 text-slate-700 rounded-xl flex items-center justify-center font-bold text-lg transition active:scale-95">
                                <i class="fa-solid fa-minus text-xs"></i>
                            </button>
                            <input 
                                type="number" 
                                name="stock"
                                id="qtyInput"
                                value="{{ old('stock', 1) }}" 
                                min="1"
                                required
                                class="flex-1 bg-white border border-slate-200 text-center font-bold text-slate-800 text-base py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#024d35]"
                            />
                            <button type="button" onclick="incrementQty()" class="w-10 h-10 bg-[#024d35] hover:bg-[#013827] text-white rounded-xl flex items-center justify-center font-bold text-lg transition active:scale-95">
                                <i class="fa-solid fa-plus text-xs"></i>
                            </button>
                        </div>
                        @error('stock') <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p> @enderror
                    </div>

                    <!-- Supplier -->
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-500 tracking-wider uppercase block mb-1">SUPPLIER</label>
                        <div class="relative">
                            <select name="supplier_id" class="w-full bg-white border border-[#028b5e] text-xs font-medium text-slate-700 px-3.5 py-3 rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-[#024d35]">
                                <option value="" disabled {{ old('supplier_id') ? '' : 'selected' }}>Pilih Supplier</option>
                                @foreach($suppliers ?? [] as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name ?? $supplier->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        </div>
                        @error('supplier_id') <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p> @enderror
                    </div>

                    <!-- Harga Beli & Harga Jual Grid -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-[10px] font-extrabold text-slate-500 tracking-wider uppercase block mb-1">HARGA BELI</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-3 text-xs font-bold text-slate-400">Rp</span>
                                <input 
                                    type="number" 
                                    name="purchase_price"
                                    value="{{ old('purchase_price', 0) }}"
                                    placeholder="0" 
                                    class="w-full bg-white border border-slate-200 text-xs font-bold text-slate-800 pl-9 pr-3 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#024d35]"
                                />
                            </div>
                            @error('purchase_price') <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="text-[10px] font-extrabold text-slate-500 tracking-wider uppercase block mb-1">HARGA JUAL</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-3 text-xs font-bold text-slate-400">Rp</span>
                                <input 
                                    type="number" 
                                    name="selling_price"
                                    value="{{ old('selling_price', 0) }}"
                                    required
                                    placeholder="0" 
                                    class="w-full bg-white border border-slate-200 text-xs font-bold text-slate-800 pl-9 pr-3 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#024d35]"
                                />
                            </div>
                            @error('selling_price') <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Bukti Nota / Resi -->
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-500 tracking-wider uppercase block mb-1">BUKTI NOTA / RESI</label>
                        
                        <div onclick="openChoiceModal()" class="w-full border-2 border-dashed border-slate-200 bg-[#f1f5f9]/60 hover:bg-[#e2e8f0]/60 rounded-2xl p-4 flex flex-col items-center justify-center cursor-pointer transition min-h-[120px] relative overflow-hidden">
                            
                            <div id="default-ui" class="flex flex-col items-center justify-center">
                                <i class="fa-solid fa-camera-retro text-2xl text-slate-400 mb-1.5"></i>
                                <span class="text-xs font-semibold text-slate-500">Ketuk untuk Ambil / Pilih Foto</span>
                            </div>

                            <img id="image-preview" src="#" alt="Preview Foto" class="hidden w-full h-36 object-cover rounded-xl shadow-sm">
                        </div>

                        <input type="file" id="input-galeri" name="receipt_image" accept="image/*" class="hidden" onchange="handleFileSelect(this)">

                        @error('receipt_image') <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tombol Simpan Data -->
                    <div class="pt-2">
                        <button type="submit" class="w-full bg-[#024d35] hover:bg-[#013827] text-white py-3.5 rounded-xl font-bold text-xs flex items-center justify-center gap-2 shadow-md transition active:scale-95">
                            <i class="fa-solid fa-box-archive text-sm"></i>
                            <span>Simpan Data</span>
                        </button>
                    </div>

                </form>

            </main>
        </div>

        <!-- Bottom Navigation Bar -->
        <nav class="absolute bottom-0 left-0 right-0 bg-white border-t border-slate-200 px-3 py-2 flex items-center justify-around z-30">
            <a href="{{ Route::has('dashboard') ? route('dashboard') : (Route::has('dashboard.gudang') ? route('dashboard.gudang') : '#') }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-solid fa-border-all text-base mb-0.5"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ Route::has('products.index') ? route('products.index') : (Route::has('kelola.gudang') ? route('kelola.gudang') : '#') }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-solid fa-box-archive text-base mb-0.5"></i>
                <span>Kelola</span>
            </a>

            <a href="{{ Route::has('products.create') ? route('products.create') : (Route::has('input.barang') ? route('input.barang') : '#') }}" class="flex flex-col items-center justify-center bg-[#00f0aa] text-[#024d35] px-4 py-1.5 rounded-xl font-bold text-[10px]">
                <i class="fa-regular fa-square-plus text-base mb-0.5"></i>
                <span>Input</span>
            </a>

            <a href="{{ Route::has('stok.kritis') ? route('stok.kritis') : (Route::has('products.kritis') ? route('products.kritis') : '#') }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition relative">
                <div class="relative">
                    <i class="fa-solid fa-triangle-exclamation text-base mb-0.5"></i>
                    @if(isset($stokKritisCount) && $stokKritisCount > 0)
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    @endif
                </div>
                <span>Kritis</span>
            </a>

            <a href="{{ Route::has('profile') ? route('profile') : (Route::has('profil.gudang') ? route('profil.gudang') : '#') }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-regular fa-user text-base mb-0.5"></i>
                <span>Profile</span>
            </a>
        </nav>

    </div>

    <!-- MODAL PILIHAN SUMBER FOTO -->
    <div id="choice-modal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden flex items-end sm:items-center justify-center">
        <div class="bg-white w-full max-w-[420px] rounded-t-3xl sm:rounded-2xl p-5 space-y-3">
            <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                <h3 class="text-sm font-extrabold text-slate-800">Pilih Sumber Foto</h3>
                <button type="button" onclick="closeChoiceModal()" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <button type="button" onclick="startCamera()" class="w-full flex items-center gap-3.5 p-3.5 bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-[#024d35] rounded-xl transition font-bold text-xs border border-slate-200/80">
                <div class="w-9 h-9 bg-emerald-100 text-[#024d35] rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-camera text-base"></i>
                </div>
                <div class="text-left">
                    <p class="font-bold">Ambil Foto Realtime</p>
                    <p class="text-[10px] text-slate-400 font-normal">Buka kamera webcam / HP</p>
                </div>
            </button>

            <button type="button" onclick="triggerGallery()" class="w-full flex items-center gap-3.5 p-3.5 bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-[#024d35] rounded-xl transition font-bold text-xs border border-slate-200/80">
                <div class="w-9 h-9 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-images text-base"></i>
                </div>
                <div class="text-left">
                    <p class="font-bold">Pilih Dari Galeri / File</p>
                    <p class="text-[10px] text-slate-400 font-normal">Pilih foto dari penyimpanan perangkat</p>
                </div>
            </button>
        </div>
    </div>

    <!-- MODAL KAMERA STREAMING REALTIME -->
    <div id="camera-modal" class="fixed inset-0 bg-slate-900/80 backdrop-blur-md z-50 hidden flex flex-col items-center justify-center p-4">
        <div class="bg-white w-full max-w-[400px] rounded-2xl p-4 space-y-4 flex flex-col items-center">
            <div class="w-full flex justify-between items-center border-b pb-2">
                <span class="text-xs font-bold text-slate-700"><i class="fa-solid fa-camera mr-1"></i> Kamera Realtime</span>
                <button type="button" onclick="stopCamera()" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <div class="w-full h-64 bg-black rounded-xl overflow-hidden relative flex items-center justify-center">
                <video id="webcam-video" autoplay playsinline class="w-full h-full object-cover"></video>
            </div>

            <canvas id="webcam-canvas" class="hidden"></canvas>

            <div class="flex gap-2 w-full">
                <button type="button" onclick="stopCamera()" class="flex-1 py-3 bg-slate-100 text-slate-600 rounded-xl font-bold text-xs">
                    Batal
                </button>
                <button type="button" onclick="takeSnapshot()" class="flex-1 py-3 bg-[#024d35] text-white rounded-xl font-bold text-xs flex items-center justify-center gap-1.5 shadow-md">
                    <i class="fa-solid fa-circle-dot"></i> Ambil Foto
                </button>
            </div>
        </div>
    </div>

    <script>
        let stream = null;

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

        function openChoiceModal() {
            document.getElementById('choice-modal').classList.remove('hidden');
        }

        function closeChoiceModal() {
            document.getElementById('choice-modal').classList.add('hidden');
        }

        function triggerGallery() {
            closeChoiceModal();
            document.getElementById('input-galeri').click();
        }

        async function startCamera() {
            closeChoiceModal();
            const cameraModal = document.getElementById('camera-modal');
            const video = document.getElementById('webcam-video');

            try {
                stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { facingMode: "environment" }, 
                    audio: false 
                });
                video.srcObject = stream;
                cameraModal.classList.remove('hidden');
            } catch (err) {
                alert('Akses kamera ditolak atau tidak ditemukan pada perangkat ini.');
                console.error(err);
            }
        }

        function stopCamera() {
            const cameraModal = document.getElementById('camera-modal');
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            cameraModal.classList.add('hidden');
        }

        function takeSnapshot() {
            const video = document.getElementById('webcam-video');
            const canvas = document.getElementById('webcam-canvas');
            const imagePreview = document.getElementById('image-preview');
            const defaultUI = document.getElementById('default-ui');
            const fileInput = document.getElementById('input-galeri');

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            canvas.toBlob((blob) => {
                const file = new File([blob], "bukti_nota.jpg", { type: "image/jpeg" });
                
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;

                imagePreview.src = URL.createObjectURL(blob);
                imagePreview.classList.remove('hidden');
                defaultUI.classList.add('hidden');

                stopCamera();
            }, 'image/jpeg');
        }

        function handleFileSelect(input) {
            const defaultUI = document.getElementById('default-ui');
            const imagePreview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    defaultUI.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>
</html>