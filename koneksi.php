<?php
$host = "localhost";
$user = "root";     // Sesuaikan dengan username phpmyadmin kamu
$pass = "";         // Sesuaikan dengan password phpmyadmin kamu
$db   = "toko_anyar";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>