<?php
// 1. MASUKKAN KONEKSI
include '../koneksi.php';

// ------------------------------------------------------------------
// [LANGKAH 3] PROSES UPDATE (JIKA FORM DI-SUBMIT VIA POST)
// ------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil semua data dari form
    $id_sertifikat = (int)$_POST['id_sertifikat'];
    $judul = $_POST['certificate_title'];
    $deskripsi = $_POST['certificate_description'];

    // Cek apakah ada file BARU yang di-upload
    if (isset($_FILES['certificate_file']) && $_FILES['certificate_file']['error'] == 0 && $_FILES['certificate_file']['size'] > 0) {
        
        // --- ADA FILE BARU ---
        
        // Validasi (ukuran, tipe)
        $max_file_size = 2097152; // 2MB
        if ($_FILES['certificate_file']['size'] > $max_file_size) {
            echo "Error: Ukuran file baru terlalu besar. Maksimal 2MB.";
            exit;
        }
        $gambar_tipe = $_FILES['certificate_file']['type'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'];
        if (!in_array($gambar_tipe, $allowed_types)) {
            echo "Error: Tipe file baru tidak diizinkan.";
            exit;
        }

        // Baca data biner file
        $gambar_data = file_get_contents($_FILES['certificate_file']['tmp_name']);
        
        // Siapkan query UPDATE DENGAN GAMBAR BARU
        $sql_update = "UPDATE tb_sertifikat SET 
                        judul_sertifikat = ?, deskripsi_sertifikat = ?, 
                        gambar_data = ?, gambar_tipe = ?
                       WHERE id_sertifikat = ?";
        
        $stmt_update = $koneksi->prepare($sql_update);
        // Tipe: s(judul), s(desk), b(blob), s(tipe), i(id)
        $stmt_update->bind_param("ssbsi", $judul, $deskripsi, $null, $id_sertifikat); // $null placeholder
        // Kirim data BLOB
        $stmt_update->send_long_data(2, $gambar_data); // Kirim file ke param index 2
        // Update tipe file secara terpisah (karena bind_param tidak bisa handle 2 BLOB/string dinamis)
        // Cara amannya adalah jalankan query kedua untuk tipe, atau...
        // Kita perbaiki: bind_param tidak suka $gambar_tipe setelah $null.
        // Mari kita gunakan bind_param yang lebih stabil
        $stmt_update->close(); // Tutup statement lama

        $stmt_update = $koneksi->prepare($sql_update); // Siapkan lagi
        $stmt_update->bind_param("ssbsi", $judul, $deskripsi, $gambar_data, $gambar_tipe, $id_sertifikat);


    } else {
        // --- TIDAK ADA FILE BARU ---
        // Hanya update teks, jangan sentuh kolom gambar
        
        $sql_update = "UPDATE tb_sertifikat SET 
                        judul_sertifikat = ?, deskripsi_sertifikat = ?
                       WHERE id_sertifikat = ?";
        
        $stmt_update = $koneksi->prepare($sql_update);
        // Tipe: s(judul), s(desk), i(id)
        $stmt_update->bind_param("ssi", $judul, $deskripsi, $id_sertifikat);
    }

    // Eksekusi query (baik yang dengan/tanpa gambar)
    if ($stmt_update->execute()) {
        header("Location: sertifikat.php?status=sukses");
        exit;
    } else {
        echo "Error: Gagal mengupdate data. " . $stmt_update->error;
    }
    $stmt_update->close();
}


// ------------------------------------------------------------------
// [LANGKAH 1] PROSES AMBIL DATA (SAAT HALAMAN DIBUKA VIA GET)
// ------------------------------------------------------------------

// Cek apakah ID ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Error: ID Sertifikat tidak ditemukan.";
    exit;
}

$id_sertifikat = (int)$_GET['id'];

// Ambil data spesifik dari database
$sql_select = "SELECT * FROM tb_sertifikat WHERE id_sertifikat = ?";
$stmt_select = $koneksi->prepare($sql_select);
$stmt_select->bind_param("i", $id_sertifikat);
$stmt_select->execute();
$result = $stmt_select->get_result();
$sertifikat = $result->fetch_assoc();

// Cek apakah data ditemukan
if (!$sertifikat) {
    echo "Error: Data sertifikat tidak ditemukan.";
    $stmt_select->close();
    $koneksi->close();
    exit;
}

$stmt_select->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="../ASSET/LOGO/DW_FIX.png"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sertifikat - Daniel</title> <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .fixed-layout-body { height: 100vh; overflow: hidden; }
        /* Style scrollbar */
        .overflow-y-auto { scrollbar-width: thin; scrollbar-color: #4B5563 #111827; }
        .overflow-y-auto::-webkit-scrollbar { width: 8px; }
        .overflow-y-auto::-webkit-scrollbar-track { background: #111827; }
        .overflow-y-auto::-webkit-scrollbar-thumb { background-color: #4B5563; border-radius: 20px; border: 3px solid #111827; }
    </style>
</head>

<body class="bg-white text-white fixed-layout-body"> <div class="flex h-full"> 
        
        <div class="w-72 bg-black border-r border-gray-800 p-8 flex flex-col h-full"> 
            <div class="mb-12">
                <div class="flex-shrink-0 w-24 h-24 bg-black rounded-lg overflow-hidden">
                    <img src="../ASSET/LOGO/DW_FIX.png" alt="Logo" class="w-full h-full object-cover">
                </div>
                <h1 class="text-3xl font-bold text-lime-400 mt-8">Daniel</h1>
                <div class="w-full h-px bg-lime-400 mt-2"></div>
            </div>
            <nav class="flex-1 space-y-4">
                <a href="datadiri.php" class="text-gray-400 hover:text-white transition block cursor-pointer">Data Diri</a>
                <a href="project.php" class="text-gray-400 hover:text-white transition block cursor-pointer">Projects</a>
                <a href="sertifikat.php" class="text-lime-400 font-semibold text-lg block cursor-pointer">Certificates</a>
                <a href="sharing.php" class="text-gray-400 hover:text-white transition block cursor-pointer">Sharing</a>
            </nav>
            <div class="mt-auto">
                <a href="../index.php" class="text-red-500 hover:text-red-400 transition font-semibold cursor-pointer">Logout</a>
                <p class="text-gray-600 text-xs mt-8">© Copyright 2025 DanielWrks</p>
            </div>
        </div>
        
        <div class="flex-1 h-full overflow-y-auto p-12"> 
            <div class="max-w-5xl">
                <div class="bg-black rounded-3xl p-12">

                    <div class="mb-8">
                        <h2 class="text-5xl font-bold text-lime-400 mb-2">Edit Certificate</h2>
                        <p class="text-gray-400">Perbarui data sertifikat: 
                            <strong><?php echo htmlspecialchars($sertifikat['judul_sertifikat']); ?></strong>
                        </p>
                    </div>
                    
                    <form action="edit_sertifikat.php" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id_sertifikat" value="<?php echo $sertifikat['id_sertifikat']; ?>">

                        <div class="mb-4">
                            <label class="text-gray-400 text-sm">File Saat Ini:</label>
                            <div class="mt-2 flex items-center w-24 h-24 bg-gray-700 rounded-lg overflow-hidden border border-gray-600">
                                <?php
                                if (!empty($sertifikat['gambar_data'])) {
                                    if (strpos($sertifikat['gambar_tipe'], 'image') !== false) {
                                ?>
                                        <img src="data:<?php echo htmlspecialchars($sertifikat['gambar_tipe']); ?>;base64,<?php echo base64_encode($sertifikat['gambar_data']); ?>" 
                                             alt="Sertifikat" class="w-full h-full object-cover">
                                <?php
                                    } elseif (strpos($sertifikat['gambar_tipe'], 'pdf') !== false) {
                                ?>
                                        <div class="w-full h-full flex items-center justify-center text-xs text-red-400 font-bold p-2 text-center">PDF File</div>
                                <?php
                                    } else {
                                        echo '<div class="w-full h-full flex items-center justify-center text-xs text-gray-400">File</div>';
                                    }
                                } else {
                                    echo '<div class="w-full h-full flex items-center justify-center text-xs text-gray-400">No File</div>';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="certificate_file"
                                class="block bg-gray-900 text-gray-400 text-sm h-12 border border-gray-700 p-4 rounded-xl 
                                       text-center cursor-pointer hover:bg-gray-800 transition">
                                <span id="file-name-display">Pilih file BARU (Biarkan kosong jika tidak ganti)</span>
                                <input type="file" id="certificate_file" name="certificate_file" accept=".pdf, .jpg, .png" class="hidden">
                            </label>
                        </div>

                        <div class="mb-6">
                            <input type="text" id="certificate_title" name="certificate_title"
                                placeholder="Judul Sertifikat" required
                                value="<?php echo htmlspecialchars($sertifikat['judul_sertifikat']); ?>"
                                class="w-full bg-gray-900 text-white text-sm h-12 border border-gray-700 p-4 rounded-xl 
                                       focus:outline-none focus:border-lime-400 placeholder-gray-500">
                        </div>

                        <div class="mb-8">
                            <textarea id="certificate_description" name="certificate_description" rows="5"
                                placeholder="Deskripsi Sertifikat......"
                                class="w-full bg-gray-900 text-white border text-sm border-gray-700 p-4 rounded-xl 
                                       focus:outline-none focus:border-lime-400 placeholder-gray-500 resize-none"><?php echo htmlspecialchars($sertifikat['deskripsi_sertifikat']); ?></textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-4 bg-lime-400 text-black font-bold text-sm rounded-xl 
                                   hover:bg-lime-500 transition shadow-lg shadow-lime-400/30">
                            Update Certificate!
                        </button>
                    </form>
                    
                    <div class="text-center mt-8">
                        <a href="sertifikat.php" class="text-gray-400 hover:text-white transition">← Kembali ke Daftar Sertifikat</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($_GET['status'])): ?>
        <div id="toast-notification"
            class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 space-x-4 text-white rounded-lg shadow-2xl transition-all duration-500 transform translate-x-full opacity-0 <?php echo ($_GET['status'] == 'sukses') ? 'bg-green-600' : 'bg-red-600'; ?>"
            role="alert">

            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg bg-black bg-opacity-30">
                <?php if ($_GET['status'] == 'sukses'): ?>
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                <?php else: ?>
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                <?php endif; ?>
            </div>

            <div class="ml-3 text-sm font-normal">
                <?php
                if ($_GET['status'] == 'sukses') echo "Data berhasil diperbarui!";
                else echo htmlspecialchars($_GET['msg'] ?? 'Berhasil Dihapus.');
                ?>
            </div>

            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-transparent text-white rounded-lg p-1.5 hover:bg-white hover:text-gray-900 inline-flex h-8 w-8" onclick="closeToast()">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    <?php endif; ?>
    <script>
    // Skrip kecil untuk menampilkan nama file di tombol upload
    document.getElementById('certificate_file').onchange = function() {
        var fileName = this.files[0] ? this.files[0].name : 'Pilih file BARU (Biarkan kosong jika tidak ganti)';
        document.getElementById('file-name-display').textContent = fileName;
    };
     //NOTIFICATION
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast-notification');
            if (toast) {
                // 1. Tampilkan toast (masuk dari kanan)
                // Hapus class hidden/translate agar muncul
                setTimeout(() => {
                    toast.classList.remove('translate-x-full', 'opacity-0');
                }, 100); // Delay sedikit agar transisi CSS jalan

                // 2. Set timer 3 detik untuk menghilang
                setTimeout(() => {
                    closeToast();
                }, 3000);

                // 3. Bersihkan URL agar toast tidak muncul saat refresh
                if (window.history.replaceState) {
                    const url = new URL(window.location);
                    url.searchParams.delete('status');
                    url.searchParams.delete('msg');
                    window.history.replaceState(null, '', url);
                }
            }
        });

        function closeToast() {
            const toast = document.getElementById('toast-notification');
            if (toast) {
                // Efek keluar ke kanan
                toast.classList.add('translate-x-full', 'opacity-0');
                // Hapus elemen dari DOM setelah animasi selesai
                setTimeout(() => {
                    toast.remove();
                }, 500);
            }
        }
    </script>
</body>
</html>
<?php
// Tutup koneksi di akhir
$koneksi->close();
?>