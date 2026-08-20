@php
    use Illuminate\Support\Facades\Storage;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS Mobile - Profil Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome / Lucide Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen bg-gray-100 p-0 sm:p-4">

    <!-- Container Utama Mobile -->
    <div class="w-full max-w-[375px] bg-[#F8FAFC] border border-gray-200 shadow-xl sm:rounded-[32px] overflow-hidden flex flex-col min-h-[780px] justify-between relative">
        
        <div>
            <!-- Header -->
            <header class="flex items-center justify-between px-5 py-4 bg-white/50 backdrop-blur-md border-b border-gray-100 sticky top-0 z-10">
                <div class="flex items-center gap-2 text-[#004D40]">
                    <i class="fa-solid fa-store text-lg"></i>
                    <span class="font-extrabold text-base tracking-tight">Q-CIS</span>
                </div>
            </header>

            <main class="px-5 pt-4 pb-24">
                
                <!-- Alert Session Success -->
                @if (session('success'))
                    <div class="mb-4 p-3 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-bold rounded-xl flex items-center gap-2">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Form Profil -->
                <form action="{{ route('profil.gudang.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- User Profile Summary Section -->
                    <div class="flex flex-col items-center text-center mb-6">
                        <!-- Avatar Image dengan Tombol Ganti Kamera -->
                        <div class="relative mb-3">
                            <img id="avatar-preview" 
                                 src="{{ !empty($user->avatar) ? Storage::url('avatars/' . $user->avatar) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=300' }}" 
                                 alt="{{ $user->name ?? 'Budi Santoso' }}" 
                                 class="w-20 h-20 rounded-2xl object-cover shadow-sm border border-gray-100">
                            <button type="button" onclick="openChoiceModal()" class="absolute -bottom-1 -right-1 w-7 h-7 bg-[#004D40] hover:bg-[#00332a] text-white border-2 border-white rounded-full flex items-center justify-center text-[11px] shadow-sm transition active:scale-95">
                                <i class="fa-solid fa-camera"></i>
                            </button>
                        </div>

                        <!-- Input File Tersembunyi -->
                        <input type="file" id="input-avatar" name="avatar" accept="image/*" class="hidden" onchange="handleFileSelect(this)">

                        <!-- Display Nama & Role -->
                        <h2 id="display-name" class="text-base font-extrabold text-gray-800">
                            {{ old('name', $user->name ?? 'Budi Santoso') }}
                        </h2>
                        <p class="text-xs font-semibold text-gray-400 mt-0.5">Senior Inventory Supervisor</p>
                    </div>

                    <!-- PERSONAL INFORMATION SECTION -->
                    <div class="mb-6">
                        <div class="flex items-center gap-2 text-[#004D40] mb-2 px-1">
                            <i class="fa-solid fa-id-card text-xs"></i>
                            <h3 class="text-[11px] font-extrabold uppercase tracking-wider text-[#004D40]">Personal Information</h3>
                        </div>

                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 space-y-3.5">
                            <!-- Full Name Input -->
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Full Name</label>
                                <input type="text" name="name" id="input-name" 
                                    value="{{ old('name', $user->name ?? 'Budi Santoso') }}" 
                                    oninput="updateDisplayName(this.value)"
                                    required
                                    class="w-full bg-gray-50 border border-gray-200 text-xs font-extrabold text-gray-800 px-3 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#004D40]">
                            </div>

                            <!-- Email Address Input -->
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Email Address</label>
                                <input type="email" name="email" 
                                    value="{{ old('email', $user->email ?? 'budi.santoso@qcis-logistics.com') }}" 
                                    required
                                    class="w-full bg-gray-50 border border-gray-200 text-xs font-extrabold text-gray-800 px-3 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#004D40]">
                            </div>

                            <!-- Phone Number Input -->
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Phone Number</label>
                                <input type="text" name="phone" 
                                    value="{{ old('phone', $user->phone ?? '+62 812-3456-7890') }}" 
                                    class="w-full bg-gray-50 border border-gray-200 text-xs font-extrabold text-gray-800 px-3 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#004D40]">
                            </div>
                        </div>

                        <!-- Tombol Simpan Perubahan -->
                        <button type="submit" class="w-full mt-3 bg-[#004D40] hover:bg-[#00332a] text-white py-3 rounded-xl font-extrabold text-xs flex items-center justify-center gap-2 shadow-sm transition active:scale-95">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Simpan Profile</span>
                        </button>
                    </div>
                </form>

                <!-- ACCOUNT SETTINGS SECTION -->
                <div class="mb-6">
                    <div class="flex items-center gap-2 text-[#004D40] mb-2 px-1">
                        <i class="fa-solid fa-gear text-xs"></i>
                        <h3 class="text-[11px] font-extrabold uppercase tracking-wider text-[#004D40]">Account Settings</h3>
                    </div>

                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm divide-y divide-gray-100 overflow-hidden">
                        <!-- Change Password -->
                        <a href="{{ route('password.gudang.change') }}" class="p-3.5 flex items-center justify-between hover:bg-gray-50 transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-rotate text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-extrabold text-gray-800">Change Password</h4>
                                    <p class="text-[10px] font-medium text-gray-400">Update your login security</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
                        </a>

                        <!-- Sign Out -->
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="w-full p-3.5 flex items-center justify-between hover:bg-red-50/50 transition-colors text-left">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-red-100/70 text-red-500 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-right-from-bracket text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-extrabold text-red-500">Sign Out</h4>
                                        <p class="text-[10px] font-medium text-red-400">Terminate your current session</p>
                                    </div>
                                </div>
                                <i class="fa-solid fa-chevron-right text-xs text-red-400"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Footer System Info -->
                <div class="text-center mt-6">
                    <p class="text-[9px] font-extrabold text-gray-300 tracking-wider">V.1.2.0-STABLE | LOGISTICS MANAGEMENT SYSTEM</p>
                </div>
            </main>
        </div>

        <!-- Bottom Navigation Bar -->
        <nav class="absolute bottom-0 left-0 right-0 bg-white border-t border-gray-100 py-2.5 px-3 flex justify-between items-center z-20">
            <a href="{{ route('dashboard.gudang') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-[#004D40]">
                <i class="fa-solid fa-border-all text-sm"></i>
                <span class="text-[9px] font-extrabold">Dashboard</span>
            </a>
            <a href="{{ route('kelola.gudang') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-[#004D40]">
                <i class="fa-solid fa-box-archive text-sm"></i>
                <span class="text-[9px] font-extrabold">Kelola</span>
            </a>
            <a href="{{ route('input.barang') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-[#004D40]">
                <i class="fa-solid fa-square-plus text-sm"></i>
                <span class="text-[9px] font-extrabold">Input</span>
            </a>
            <a href="{{ route('stok.kritis') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-[#004D40]">
                <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                <span class="text-[9px] font-extrabold">Kritis</span>
            </a>
            <a href="{{ route('profil.gudang') }}" class="flex flex-col items-center gap-0.5 bg-emerald-400 text-[#004D40] px-3 py-1.5 rounded-xl font-extrabold shadow-sm">
                <i class="fa-solid fa-user text-xs"></i>
                <span class="text-[9px]">Profile</span>
            </a>
        </nav>

    </div>

    <!-- MODAL PILIHAN SUMBER FOTO -->
    <div id="choice-modal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden flex items-end sm:items-center justify-center">
        <div class="bg-white w-full max-w-[375px] rounded-t-3xl sm:rounded-2xl p-5 space-y-3">
            <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                <h3 class="text-xs font-extrabold text-gray-800">Ubah Foto Profil</h3>
                <button type="button" onclick="closeChoiceModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- Option 1: Kamera Realtime -->
            <button type="button" onclick="startCamera()" class="w-full flex items-center gap-3 p-3 bg-gray-50 hover:bg-emerald-50 text-gray-700 hover:text-[#004D40] rounded-xl transition font-extrabold text-xs border border-gray-200">
                <div class="w-8 h-8 bg-emerald-100 text-[#004D40] rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <div class="text-left">
                    <p class="font-extrabold">Ambil Foto Realtime</p>
                    <p class="text-[10px] text-gray-400 font-medium">Gunakan kamera langsung</p>
                </div>
            </button>

            <!-- Option 2: File / Galeri -->
            <button type="button" onclick="triggerGallery()" class="w-full flex items-center gap-3 p-3 bg-gray-50 hover:bg-emerald-50 text-gray-700 hover:text-[#004D40] rounded-xl transition font-extrabold text-xs border border-gray-200">
                <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-images"></i>
                </div>
                <div class="text-left">
                    <p class="font-extrabold">Pilih Dari Galeri / File</p>
                    <p class="text-[10px] text-gray-400 font-medium">Upload dari penyimpanan perangkat</p>
                </div>
            </button>
        </div>
    </div>

    <!-- MODAL KAMERA STREAMING REALTIME -->
    <div id="camera-modal" class="fixed inset-0 bg-slate-900/80 backdrop-blur-md z-50 hidden flex flex-col items-center justify-center p-4">
        <div class="bg-white w-full max-w-[350px] rounded-2xl p-4 space-y-3 flex flex-col items-center">
            <div class="w-full flex justify-between items-center border-b pb-2">
                <span class="text-xs font-extrabold text-gray-700"><i class="fa-solid fa-camera mr-1"></i> Kamera Realtime</span>
                <button type="button" onclick="stopCamera()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- Preview Streaming Kamera -->
            <div class="w-full h-60 bg-black rounded-xl overflow-hidden relative flex items-center justify-center">
                <video id="webcam-video" autoplay playsinline class="w-full h-full object-cover"></video>
            </div>

            <canvas id="webcam-canvas" class="hidden"></canvas>

            <!-- Tombol Aksi Kamera -->
            <div class="flex gap-2 w-full">
                <button type="button" onclick="stopCamera()" class="flex-1 py-2.5 bg-gray-100 text-gray-600 rounded-xl font-extrabold text-xs">
                    Batal
                </button>
                <button type="button" onclick="takeSnapshot()" class="flex-1 py-2.5 bg-[#004D40] text-white rounded-xl font-extrabold text-xs flex items-center justify-center gap-1.5 shadow-sm">
                    <i class="fa-solid fa-circle-dot"></i> Ambil Foto
                </button>
            </div>
        </div>
    </div>

    <script>
        let stream = null;

        function updateDisplayName(val) {
            document.getElementById('display-name').innerText = val || 'Budi Santoso';
        }

        function openChoiceModal() {
            document.getElementById('choice-modal').classList.remove('hidden');
        }

        function closeChoiceModal() {
            document.getElementById('choice-modal').classList.add('hidden');
        }

        function triggerGallery() {
            closeChoiceModal();
            document.getElementById('input-avatar').click();
        }

        async function startCamera() {
            closeChoiceModal();
            const cameraModal = document.getElementById('camera-modal');
            const video = document.getElementById('webcam-video');

            try {
                stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { facingMode: "user" }, 
                    audio: false 
                });
                video.srcObject = stream;
                cameraModal.classList.remove('hidden');
            } catch (err) {
                alert('Tidak dapat mengakses kamera perangkat.');
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
            const avatarPreview = document.getElementById('avatar-preview');
            const fileInput = document.getElementById('input-avatar');

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            canvas.toBlob((blob) => {
                const file = new File([blob], "camera_snapshot.jpg", { type: "image/jpeg" });
                
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;

                avatarPreview.src = URL.createObjectURL(blob);

                stopCamera();
            }, 'image/jpeg');
        }

        function handleFileSelect(input) {
            const avatarPreview = document.getElementById('avatar-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>
</html>