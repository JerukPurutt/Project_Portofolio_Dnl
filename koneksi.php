<?php
$servername = "localhost";
$username = "root";
$password = ""; // Kosongkan jika tidak ada password (default XAMPP)
$database = "portofolio_dnl";


// Membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}

// Mengatur 'character set' ke utf8mb4 (disarankan untuk dukungan emoji, dll.)
$koneksi->set_charset("utf8mb4");
?>