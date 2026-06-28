<?php
include 'koneksi.php';

// Memastikan data dikirim melalui metode POST dan parameter user_id ada di URL
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['user_id'])) {
    
    // Mengambil data dari form POST dan URL GET
    $id_pesanan = $_POST['id_pesanan'];
    $user_id    = $_GET['user_id'];

    // Query untuk mengubah status pesanan menjadi 'Selesai'
    // Menggunakan kolom 'id_pesanan' (sesuaikan jika nama primary key tabel pesananmu berbeda)
    $query = "UPDATE pesanan SET status_pesanan = 'Selesai' WHERE id_pesanan = '$id_pesanan'";
    $update = mysqli_query($koneksi, $query);

    if ($update) {
        // Jika berhasil, munculkan alert lalu kembalikan ke halaman pesanan_saya.php membawa user_id-nya
        echo "<script>
                alert('Terima kasih! Pesanan telah selesai.');
                window.location.href = 'pesanan_saya.php?user_id=" . $user_id . "';
              </script>";
    } else {
        // Jika gagal query
        echo "<script>
                alert('Gagal mengonfirmasi pesanan. Silakan coba lagi.');
                window.location.href = 'pesanan_saya.php?user_id=" . $user_id . "';
              </script>";
    }
} else {
    // Jika file ini diakses langsung tanpa kirim data (iseng dibuka lewat URL), tendang balik ke halaman utama
    header("Location: user.php");
    exit;
}
?>