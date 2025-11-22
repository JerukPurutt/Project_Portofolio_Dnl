<?php
// view_image.php
include 'koneksi.php';

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = intval($_GET['id']); // Pastikan ID angka untuk keamanan

    if ($type == 'project') {
        $stmt = $koneksi->prepare("SELECT gambar_data, gambar_tipe FROM tb_projects WHERE id_project = ?");
    } elseif ($type == 'sertifikat') {
        $stmt = $koneksi->prepare("SELECT gambar_data, gambar_tipe FROM tb_sertifikat WHERE id_sertifikat = ?");
    } elseif ($type == 'sharing') {
        $stmt = $koneksi->prepare("SELECT gambar_data, gambar_tipe FROM tb_sharing WHERE id_sharing = ?");
    } else {
        exit;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($gambar_data, $gambar_tipe);
        $stmt->fetch();

        // Mengirim header agar browser tahu ini adalah gambar
        header("Content-type: " . $gambar_tipe);
        
        // Aktifkan Cache Browser (PENTING untuk performa)
        // Gambar akan disimpan di cache browser selama 30 hari
        $seconds_to_cache = 3600 * 24 * 30;
        $ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
        header("Expires: $ts");
        header("Pragma: cache");
        header("Cache-Control: max-age=$seconds_to_cache");

        echo $gambar_data;
    }
    $stmt->close();
}
$koneksi->close();
?>