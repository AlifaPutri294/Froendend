<?php
include 'koneksi.php'; // Menyambungkan ke database Anda

// Pastikan request datang menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Ambil data dari form dan parameter URL secara aman
    $id_user = isset($_GET['user_id']) ? mysqli_real_escape_string($koneksi, $_GET['user_id']) : 1;
    $kurir = isset($_POST['kurir']) ? mysqli_real_escape_string($koneksi, $_POST['kurir']) : '';
    $pembayaran = isset($_POST['pembayaran']) ? mysqli_real_escape_string($koneksi, $_POST['pembayaran']) : '';
    $total_harga = isset($_POST['total_harga']) ? intval($_POST['total_harga']) : 0;
    
    // Tentukan nama ekspedisi berdasarkan pilihan kurir
    $ekspedisi = "JNE";
    if ($kurir === 'jnt_ez') {
        $ekspedisi = "J&T Express";
    } elseif ($kurir === 'gosend_instant') {
        $ekspedisi = "GoSend";
    }

    // Default status pesanan awal setelah dibayar adalah 'Menunggu' atau 'Dikemas'
    $status_pesanan = "Dikemas"; 
    $no_resi = ""; // Kosongkan dulu karena belum dikirim oleh kurir

    // Query untuk menyimpan data ke tabel pesanan
    $query = "INSERT INTO pesanan (user_id, total_harga, status_pesanan, no_resi, ekspedisi) 
              VALUES ('$id_user', '$total_harga', '$status_pesanan', '$no_resi', '$ekspedisi')";

    if (mysqli_query($koneksi, $query)) {
        // Mengembalikan respon sukses ke JavaScript berupa JSON
        echo json_encode(['status' => 'success', 'message' => 'Pesanan berhasil disimpan']);
    } else {
        // Mengembalikan respon error jika query gagal
        echo json_encode(['status' => 'error', 'message' => mysqli_error($koneksi)]);
    }
}
?>