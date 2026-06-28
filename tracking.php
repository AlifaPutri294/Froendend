<?php
include 'koneksi.php';

// Mengambil id_user dari URL (contoh akses: tracking.php?id_user=1)
// Jika id_user tidak ada di URL, kita beri nilai default 1 untuk testing
$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : 1;

// Logika ketika pembeli menekan tombol "Pesanan Sudah Diterima"
if (isset($_POST['konfirmasi_selesai'])) {
    $id_pesanan = mysqli_real_escape_string($koneksi, $_POST['id_pesanan']);
    
    // Update status_pesanan menjadi 'diterima' sesuai dengan isi struktur ENUM database Anda
    $query_selesai = "UPDATE pesanan SET status_pesanan = 'diterima' WHERE id_pesanan = '$id_pesanan' AND user_id = '$id_user'";
    mysqli_query($koneksi, $query_selesai);
    
    // Refresh halaman agar status langsung berubah
    header("Location: tracking.php?id_user=" . $id_user);
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Tokoku</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: #f5f7fb; color: #2a3547; }
        :root {
            --primary: #5D87FF; --dark: #1e2a3a; --border-light: #eef2f6; --text-muted: #5a6a85;
            --badge-waiting: #FFAE1F; --badge-process: #49BEFF; --badge-shipped: #5D87FF; --badge-success: #13DEB9; --badge-danger: #FA896B;
        }
        .navbar { background-color: var(--dark); padding: 12px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .container { max-width: 1000px; margin: 0 auto; padding: 0 24px; }
        .nav-wrapper { display: flex; align-items: center; justify-content: space-between; }
        .logo-text { font-weight: 700; font-size: 24px; color: white; text-decoration: none;}
        
        .title-section { margin: 32px 0 20px; font-size: 1.5rem; font-weight: 700; }
        
        /* Card Transaksi */
        .order-card { background: white; border-radius: 16px; padding: 20px; margin-bottom: 20px; border: 1px solid var(--border-light); box-shadow: 0 4px 12px rgba(0,0,0,0.02); }
        .order-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-light); padding-bottom: 12px; margin-bottom: 16px; flex-wrap: wrap; gap: 10px; }
        .order-date { font-size: 13px; color: var(--text-muted); }
        
        /* Badge Status */
        .status-badge { padding: 6px 12px; border-radius: 30px; font-size: 12px; font-weight: 600; color: white; text-transform: uppercase; }
        .status-menunggu { background-color: var(--badge-waiting); color: #1e2a3a; }
        .status-dikemas { background-color: var(--badge-process); color: #1e2a3a; }
        .status-dikirim { background-color: var(--badge-shipped); }
        .status-diterima { background-color: var(--badge-success); }
        .status-batal { background-color: var(--badge-danger); }

        /* Detail Tracking Manual */
        .tracking-box { background: #f8fafc; border-radius: 12px; padding: 16px; margin-top: 16px; border: 1px dashed #cbd5e1; }
        .tracking-box h4 { font-size: 14px; margin-bottom: 8px; color: var(--dark); }
        .resi-wrapper { display: flex; align-items: center; gap: 10px; margin-top: 6px; margin-bottom: 12px; flex-wrap: wrap; }
        .resi-text { font-family: monospace; font-size: 15px; font-weight: bold; background: white; padding: 4px 8px; border-radius: 6px; border: 1px solid #e2e8f0; }
        .btn-copy { background: none; border: none; color: var(--primary); cursor: pointer; font-size: 14px; font-weight: 500; }
        
        /* Tombol Aksi */
        .btn-lacak { display: inline-flex; align-items: center; gap: 6px; background-color: var(--primary); color: white; text-decoration: none; padding: 6px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; transition: 0.2s; }
        .btn-lacak:hover { background-color: #4570e6; }

        .btn-selesai { background-color: #13DEB9; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.2s; margin-top: 16px; width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-selesai:hover { background-color: #0bb89a; }
        .no-order { text-align: center; padding: 60px 20px; background: white; border-radius: 16px; margin-top: 20px;}
    </style>
</head>
<body>

<div class="navbar">
    <div class="container">
        <div class="nav-wrapper">
            <a href="user.php" class="logo-text"><i class="fas fa-store"></i> Tokoku</a>
            <span style="color: white; font-size: 14px;"><i class="far fa-user"></i> ID User Terpilih: <strong><?php echo htmlspecialchars($id_user); ?></strong></span>
        </div>
    </div>
</div>

<div class="container">
    <div style="margin-top: 20px;">
        <a href="user.php" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; background-color: white; color: var(--dark); padding: 10px 18px; border-radius: 30px; font-size: 14px; font-weight: 600; border: 1px solid var(--border-light); box-shadow: 0 2px 6px rgba(0,0,0,0.02); transition: all 0.2s;" onmouseover="this.style.borderColor='var(--primary)'; this.style.color='var(--primary)';" onmouseout="this.style.borderColor='var(--border-light)'; this.style.color='var(--dark)';">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>

    <h2 class="title-section" style="margin-top: 20px;">📦 Riwayat Pesanan & Tracking</h2>

    <?php
    // Query mengambil data pesanan berdasarkan id_user dari URL
    $query = "SELECT * FROM pesanan WHERE user_id = '$id_user' ORDER BY id_pesanan DESC";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $status = $row['status_pesanan']; // Mengambil nilai enum ('menunggu','batal','dikemas','diterima')
            
            // Penentuan class warna badge berdasarkan isi database Anda
            $badge_class = "status-menunggu";
            if ($status == 'dikemas') $badge_class = "status-dikemas";
            if ($status == 'diterima') $badge_class = "status-diterima";
            if ($status == 'batal') $badge_class = "status-batal";
    ?>
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <span style="font-weight: 600;">ID Pesanan: #<?php echo $row['id_pesanan']; ?></span>
                        <div class="order-date">Total Belanja: Rp<?php echo number_format($row['total_harga'], 0, ',', '.'); ?></div>
                    </div>
                    <span class="status-badge <?php echo $badge_class; ?>"><?php echo htmlspecialchars($status); ?></span>
                </div>

                <div class="tracking-box">
                    <h4><i class="fas fa-truck"></i> Informasi Pengiriman</h4>
                    <?php if (!empty($row['no_resi'])): ?>
                        <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 6px;">Kurir Ekspedisi: <strong class="text-uppercase text-primary"><?php echo htmlspecialchars($row['ekspedisi']); ?></strong></p>
                        
                        <div class="resi-wrapper">
                            <span>No. Resi:</span>
                            <span class="resi-text" id="resi-<?php echo $row['id_pesanan']; ?>"><?php echo htmlspecialchars($row['no_resi']); ?></span>
                            <button class="btn-copy" onclick="copyResi('resi-<?php echo $row['id_pesanan']; ?>')"><i class="far fa-copy"></i> Salin</button>
                            
                            <a href="https://cekresi.com/?noresi=<?php echo urlencode($row['no_resi']); ?>" target="_blank" class="btn-lacak">
                                <i class="fas fa-search-location"></i> Lacak Paket via Web
                            </a>
                        </div>
                        <p style="font-size: 11px; color: #64748b;">*Anda bisa klik tombol <strong>Lacak Paket via Web</strong> atau menyalin resi untuk melacak perjalanan barang.</p>
                    <?php else: ?>
                        <?php if ($status == 'batal'): ?>
                            <p style="font-size: 13px; color: #ef4444; font-style: italic;"><i class="fas fa-times-circle"></i> Pesanan ini telah dibatalkan.</p>
                        <?php else: ?>
                            <p style="font-size: 13px; color: var(--text-muted); font-style: italic;">Resi belum tersedia. Penjual sedang memproses pesanan Anda.</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <?php if (!empty($row['no_resi']) && $status != 'diterima' && $status != 'batal'): ?>
                    <form method="POST" action="">
                        <input type="hidden" name="id_pesanan" value="<?php echo $row['id_pesanan']; ?>">
                        <button type="submit" name="konfirmasi_selesai" class="btn-selesai" onclick="return confirm('Apakah Anda yakin pesanan ini sudah diterima dengan baik?')">
                            <i class="fas fa-check-circle"></i> Pesanan Sudah Diterima
                        </button>
                    </form>
                <?php endif; ?>
            </div>
    <?php 
        } 
    } else { 
    ?>
        <div class="no-order">
            <i class="fas fa-shopping-bag" style="font-size: 48px; color: #94a3b8; margin-bottom: 12px;"></i>
            <h3>Belum ada pesanan</h3>
            <p style="color: var(--text-muted);">User dengan ID <?php echo htmlspecialchars($id_user); ?> belum melakukan checkout barang apapun.</p>
        </div>
    <?php } ?>
</div>

<script>
function copyResi(idElement) {
    var copyText = document.getElementById(idElement).innerText;
    navigator.clipboard.writeText(copyText).then(function() {
        alert("Nomor resi berhasil disalin: " + copyText);
    }, function() {
        alert("Gagal menyalin resi.");
    });
}
</script>
</body>
</html>