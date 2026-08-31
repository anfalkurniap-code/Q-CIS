<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS SMK Mart - Profil Kepala Toko</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f7f6; display: flex; justify-content: center; padding: 10px; }
        .app-container { width: 100%; max-width: 400px; background: #fff; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); overflow: hidden; display: flex; flex-direction: column; min-height: 90vh; }
        
        .header { display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; border-bottom: 1px solid #eee; }
        .brand { display: flex; align-items: center; gap: 8px; font-weight: bold; color: #10b981; font-size: 18px; }
        .profile-small { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; }

        .content { padding: 20px; flex: 1; }
        .profile-card { background: #fff; border-radius: 16px; padding: 20px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: 1px solid #f0f0f0; margin-bottom: 20px; position: relative; }
        .avatar-wrapper { position: relative; width: 100px; height: 100px; margin: 0 auto 12px; }
        .avatar-wrapper img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 3px solid #10b981; }
        .edit-btn { position: absolute; bottom: 0; right: 0; background: #10b981; color: white; border: none; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 2px solid white; }
        
        .user-name { font-size: 18px; font-weight: bold; color: #1f2937; margin-top: 5px; }

        .section-title { font-size: 13px; font-weight: bold; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; margin: 15px 0 10px; }
        
        .form-group { margin-bottom: 12px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px; text-align: left; }
        .form-control { width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; outline: none; }
        .form-control:focus { border-color: #10b981; }

        .btn-submit { width: 100%; background: #10b981; color: white; border: none; padding: 12px; border-radius: 10px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        .btn-logout { width: 100%; background: #fee2e2; color: #dc2626; border: none; padding: 12px; border-radius: 10px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 15px; }

        .bottom-nav { display: flex; justify-content: space-around; padding: 10px 0; border-top: 1px solid #eee; background: #fff; }
        .nav-item { display: flex; flex-direction: column; align-items: center; font-size: 11px; color: #6b7280; text-decoration: none; }
        .nav-item.active { color: #10b981; font-weight: bold; }
        .nav-item i { font-size: 18px; margin-bottom: 2px; }

        /* Modal Styles */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: flex-end; z-index: 1000; }
        .modal-content { background: white; width: 100%; max-width: 400px; border-radius: 20px 20px 0 0; padding: 20px; text-align: center; }
        .modal-btn { width: 100%; padding: 12px; margin: 8px 0; border: none; border-radius: 10px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; font-size: 14px; }
        .btn-camera { background: #3b82f6; color: white; }
        .btn-gallery { background: #f3f4f6; color: #1f2937; }
        .btn-cancel { background: #ef4444; color: white; }

        /* Live Camera Preview Modal */
        .camera-view { display: none; width: 100%; max-width: 320px; height: 240px; border-radius: 12px; object-fit: cover; margin: 10px auto; background: #000; }

        .alert { padding: 10px; border-radius: 8px; font-size: 13px; margin-bottom: 10px; text-align: center; }
        .alert-success { background: #d1fae5; color: #065f46; }
    </style>
</head>
<body>

<div class="app-container">
    <!-- Header -->
    <div class="header">
        <div class="brand"><i class="fa-solid fa-graduation-cap"></i> Q-CIS SMK Mart</div>
        <div style="display: flex; gap: 12px; align-items: center;">
            <i class="fa-regular fa-bell" style="color: #059669;"></i>
            <img src="{{ !empty($user->profile_pic) ? asset('storage/' . $user->profile_pic) : 'https://via.placeholder.com/150' }}" class="profile-small" alt="Thumb">
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" id="profileForm">
            @csrf

            <div class="profile-card">
                <div class="avatar-wrapper">
                    <img id="profilePreview" src="{{ !empty($user->profile_pic) ? asset('storage/' . $user->profile_pic) : 'https://via.placeholder.com/150' }}" alt="Profile">
                    <button type="button" class="edit-btn" onclick="openPhotoModal()">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                </div>
                <!-- NISN telah dihapus -->
                <div class="user-name" id="displayName">{{ $user->username ?? 'Budi Santoso' }}</div>
            </div>

            <!-- Input foto Base64 tersembunyi -->
            <input type="hidden" name="cropped_image_data" id="croppedImageData">

            <div class="section-title">Ubah Identitas & Keamanan</div>
            
            <div class="form-group">
                <label>Nama Kepala Toko</label>
                <input type="text" name="username" class="form-control" value="{{ old('username', $user->username ?? 'Budi Santoso') }}" required>
            </div>

            <div class="form-group">
                <label>Password Baru (Kosongkan jika tidak diganti)</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••">
            </div>

            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar Sesi
            </button>
        </form>
    </div>

    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <a href="#" class="nav-item"><i class="fa-solid fa-house"></i>Home</a>
        <a href="#" class="nav-item"><i class="fa-solid fa-bag-shopping"></i>Shop</a>
        <a href="#" class="nav-item"><i class="fa-solid fa-receipt"></i>Trans</a>
        <a href="#" class="nav-item active"><i class="fa-solid fa-user"></i>Profile</a>
    </div>
</div>

<!-- Modal Pilihan Foto -->
<div class="modal" id="photoModal">
    <div class="modal-content">
        <h4 style="margin-bottom: 10px;">Pilih Sumber Foto</h4>

        <!-- Tampilan Video Live Streaming Kamera -->
        <video id="webcam" class="camera-view" autoplay playsinline></video>

        <button class="modal-btn btn-camera" type="button" id="btnCamera" onclick="startCamera()">
            <i class="fa-solid fa-camera"></i> Gunakan Kamera
        </button>
        <button class="modal-btn btn-camera" type="button" id="btnSnap" style="display:none;" onclick="takeSnapshot()">
            <i class="fa-solid fa-circle-dot"></i> Ambil Foto
        </button>
        <button class="modal-btn btn-gallery" type="button" onclick="triggerGallery()">
            <i class="fa-solid fa-image"></i> Pilih dari Galeri
        </button>
        <button class="modal-btn btn-cancel" type="button" onclick="closePhotoModal()">Batal</button>
    </div>
</div>

<!-- Input File Tersembunyi -->
<input type="file" id="cameraInputFallback" accept="image/*" capture="user" style="display:none" onchange="handleFileSelect(event)">
<input type="file" id="galleryInput" accept="image/*" style="display:none" onchange="handleFileSelect(event)">
<canvas id="canvas" style="display:none;"></canvas>

<script>
    let stream = null;

    function openPhotoModal() {
        document.getElementById('photoModal').style.display = 'flex';
    }

    function closePhotoModal() {
        stopCamera();
        document.getElementById('photoModal').style.display = 'none';
    }

    // Mengaktifkan Kamera Live
    async function startCamera() {
        const video = document.getElementById('webcam');
        try {
            stream = await navigator.mediaDevices.getUserMedia({ 
                video: { facingMode: "user", width: { ideal: 640 }, height: { ideal: 640 } }, 
                audio: false 
            });
            video.srcObject = stream;
            video.style.display = 'block';
            document.getElementById('btnCamera').style.display = 'none';
            document.getElementById('btnSnap').style.display = 'flex';
        } catch (err) {
            // Jika browser memblokir akses video streamer, fallback ke kamera native hp
            document.getElementById('cameraInputFallback').click();
            closePhotoModal();
        }
    }

    // Mengambil snapshot dari Kamera Live
    function takeSnapshot() {
        const video = document.getElementById('webcam');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d');

        canvas.width = video.videoWidth || 300;
        canvas.height = video.videoHeight || 300;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const dataUrl = canvas.toDataURL('image/png');
        document.getElementById('profilePreview').src = dataUrl;
        document.getElementById('croppedImageData').value = dataUrl;

        closePhotoModal();
    }

    // Menghentikan Stream Kamera
    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            stream = null;
        }
        document.getElementById('webcam').style.display = 'none';
        document.getElementById('btnCamera').style.display = 'flex';
        document.getElementById('btnSnap').style.display = 'none';
    }

    function triggerGallery() {
        closePhotoModal();
        document.getElementById('galleryInput').click();
    }

    function handleFileSelect(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview').src = e.target.result;
                document.getElementById('croppedImageData').value = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>

</body>
</html>