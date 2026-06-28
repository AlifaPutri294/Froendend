<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Profil - Tokoku</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif; kecilin ukuran foto 
            background-color: #f5f5f5;
        }
        .header {
            background: white;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .profile-img-container {
            text-align: center;
            margin: 20px 0;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #ee4d2d;
            object-fit: cover;
        }
        .edit-photo {
            color: #ee4d2d;
            font-size: 14px;
            margin-top: 8px;
        }
        .form-section {
            background: white;
            margin: 15px;
            border-radius: 12px;
            padding: 15px 20px;
        }
        .form-label {
            font-weight: 500;
            color: #555;
        }
        .value {
            color: #333;
            font-weight: 500;
        }
        .arrow {
            color: #999;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header d-flex align-items-center">
        <i class="fas fa-arrow-left fa-lg me-3" onclick="window.location.href='user.html'" style="cursor:pointer;"></i>
        <h5 class="mb-0 fw-semibold">Ubah Profil</h5>
    </div>

    <div class="profile-img-container">
        <img src="assets/images/profile/user-1.jpg" class="" alt="Foto Profil">
        <div class="edit-photo">
            <i class="fas fa-camera"></i> Ubah Foto
        </div>
    </div>

    <div class="form-section">
        <div class="d-flex justify-content-between py-3 border-bottom">
            <div class="form-label">alipa</div>
            
        </div>
        <div class="d-flex justify-content-between py-3 border-bottom">
            <div class="form-label">a</div>
         
        </div>
    </div>

    <div class="form-section">
        <div class="d-flex justify-content-between py-3 border-bottom">
            <div class="form-label">Jenis Kelamin</div>
            <div class="value text-danger">Atur Sekarang <span class="arrow">›</span></div>
        </div>
        <div class="d-flex justify-content-between py-3 border-bottom">
            <div class="form-label">Tanggal Lahir</div>
            <div class="value">**/ ** /2004 <span class="arrow">›</span></div>
        </div>
    </div>

    <div class="form-section">
        <div class="d-flex justify-content-between py-3 border-bottom">
            <div class="form-label">No. Handphone</div>
            <div class="value">*********** <span class="arrow">›</span></div>
        </div>
        <div class="d-flex justify-content-between py-3 border-bottom">
            <div class="form-label">Email</div>
            <div class="value">alipa@gmail.com <span class="text-danger">Verifikasi</span> <span class="arrow">›</span></div>
        </div>
    </div>

    <div style="height: 80px;"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Bisa ditambahkan fungsi edit nanti
    console.log("Halaman Ubah Profil siap");
</script>
</body>
</html>