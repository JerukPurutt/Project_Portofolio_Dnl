<?php
// 1. Masukkan file koneksi
// Path ini mengasumsikan 'koneksi.php' ada di luar folder 'admin'
include '../koneksi.php';

// 2. Cek apakah ID dikirim melalui URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    // 3. Ambil ID dan amankan (ubah menjadi integer)
    $id_sharing = (int)$_GET['id'];

    // 4. Siapkan perintah SQL untuk menghapus data dari 'tb_sharing'
    $sql = "DELETE FROM tb_sharing WHERE id_sharing = ?";
    
    $stmt = $koneksi->prepare($sql);
    
    // 5. Bind ID ke perintah SQL ('i' berarti integer)
    $stmt->bind_param("i", $id_sharing);
    
    // 6. Eksekusi perintah
    if ($stmt->execute()) {
        // Jika berhasil, kembalikan ke halaman sharing.php
        header("Location: sharing.php?status=hapus_sukses");
        exit;
    } else {
        // Jika gagal, tampilkan error
        echo "Error: Gagal menghapus data. " . $koneksi->error;
    }
    
    $stmt->close();
    $koneksi->close();

} else {
    // Jika tidak ada ID di URL, kembalikan ke halaman sharing
    header("Location: sharing.php?status=id_tidak_ditemukan");
    exit;
}
?>