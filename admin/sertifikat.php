<?php
// 1. MASUKKAN KONEKSI
include '../koneksi.php';

// ------------------------------------------------------------------
// [BAGIAN 1] LOGIKA TAMBAH SERTIFIKAT (METODE PALING STABIL)
// ------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data form
    $judul = $_POST['certificate_title'];
    $deskripsi = $_POST['certificate_description'];

    $gambar_data = NULL;
    $gambar_tipe = NULL;

    // Cek apakah ada file yang diupload
    if (isset($_FILES['certificate_file']) && $_FILES['certificate_file']['error'] == 0 && $_FILES['certificate_file']['size'] > 0) {

        // --- (Semua kode validasi ukuran dan tipe file biarkan SAMA) ---
        $max_file_size = 2097152; // 2MB
        if ($_FILES['certificate_file']['size'] > $max_file_size) {
            echo "Error: Ukuran file terlalu besar. Maksimal 2MB.";
            exit;
        }
        $gambar_tipe = $_FILES['certificate_file']['type'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'];
        if (!in_array($gambar_tipe, $allowed_types)) {
            echo "Error: Tipe file tidak diizinkan (hanya JPG, PNG, WEBP, atau PDF).";
            exit;
        }
        // Baca data biner dari file temporer
        $gambar_data = file_get_contents($_FILES['certificate_file']['tmp_name']);
    }

    // Siapkan query INSERT
    $sql_insert = "INSERT INTO tb_sertifikat (judul_sertifikat, deskripsi_sertifikat, gambar_data, gambar_tipe) 
                   VALUES (?, ?, ?, ?)";

    $stmt_insert = $koneksi->prepare($sql_insert);

    // --- INI ADALAH SOLUSI YANG BENAR DAN STABIL ---

    // 1. Siapkan placeholder NULL untuk data BLOB
    $null = NULL;

    // 2. Bind semua parameter. 'b' untuk BLOB, dan kita bind $null ke sana sebagai placeholder.
    //    Urutan: s(judul), s(deskripsi), b(blob), s(tipe)
    $stmt_insert->bind_param("ssbs", $judul, $deskripsi, $null, $gambar_tipe);

    // 3. Kirim data BLOB (file-nya) secara terpisah ke parameter index 2
    //    (Index 0 = judul, 1 = deskripsi, 2 = gambar_data)
    if ($gambar_data !== NULL) {
        $stmt_insert->send_long_data(2, $gambar_data);
    }

    // 4. Eksekusi
    if ($stmt_insert->execute()) {
        header("Location: sertifikat.php?status=sukses");
        exit;
    } else {
        echo "Error: " . $stmt_insert->error;
    }
    $stmt_insert->close();
    header("Location: sharing.php?status=sukses");
    exit;
}

// ------------------------------------------------------------------
// [BAGIAN 2] LOGIKA AMBIL SEMUA DATA (Biarkan Sama)
// ------------------------------------------------------------------
$sql_select = "SELECT id_sertifikat, judul_sertifikat, deskripsi_sertifikat, gambar_data, gambar_tipe 
               FROM tb_sertifikat 
               ORDER BY waktu_dibuat DESC";

$result_sertifikat = $koneksi->query($sql_select);

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="../ASSET/LOGO/DW_FIX.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sertifikat - Daniel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .fixed-layout-body {
            height: 100vh;
            overflow: hidden;
        }

        /* Style scrollbar (opsional tapi bagus) */
        .overflow-y-auto {
            scrollbar-width: thin;
            scrollbar-color: #4B5563 #111827;
        }

        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: #111827;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background-color: #4B5563;
            border-radius: 20px;
            border: 3px solid #111827;
        }
    </style>
</head>

<body class="bg-white text-white fixed-layout-body">
    <div class="flex h-full">
        <div class="w-72 bg-black border-r border-gray-800 p-8 flex flex-col h-full">
            <div class="mb-12">
                <div class="flex-shrink-0 w-24 h-24 bg-black rounded-lg overflow-hidden">
                    <img src="../ASSET/LOGO/DW_FIX.png" alt="Logo" class="w-full h-full object-cover">
                </div>
                <h1 class="text-3xl font-bold text-lime-400 mt-8">Daniel</h1>
                <div class="w-full h-px bg-lime-400 mt-2"></div>
            </div>
            <nav class="flex-1 space-y-4">
                <a href="datadiri.php" class="text-gray-400 hover:text-white transition block cursor-pointer">
                    Data Diri
                </a>
                <a href="project.php" class="text-gray-400 hover:text-white transition block cursor-pointer">
                    Projects
                </a>
                <a href="sertifikat.php" class="text-lime-400 font-semibold text-lg block cursor-pointer">
                    Certificates
                </a>
                <a href="sharing.php" class="text-gray-400 hover:text-white transition block cursor-pointer">
                    Sharing
                </a>
            </nav>
            <div class="mt-auto">
                <a href="../index.php" class="text-red-500 hover:text-red-400 transition font-semibold cursor-pointer">
                    Logout
                </a>
                <p class="text-gray-600 text-xs mt-8">© Copyright 2025 DanielWrks</p>
            </div>
        </div>

        <div class="flex-1 h-full overflow-y-auto p-12">
            <div class="max-w-5xl">
                <div class="bg-black rounded-3xl p-12">

                    <div class="mb-8">
                        <h2 class="text-5xl font-bold text-lime-400 mb-2">Certificate</h2>
                        <p class="text-gray-400">Upload sertifikat hasil pencapaianmu!</p>
                    </div>
                    <form action="sertifikat.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-6">
                            <label for="certificate_file"
                                class="block bg-gray-900 text-gray-400 text-sm h-12 border border-gray-700 p-4 rounded-xl 
                                       text-center cursor-pointer hover:bg-gray-800 transition">
                                <span id="file-name-display">Pilih file (JPG, PNG, PDF, WEBP)</span>
                                <input type="file" id="certificate_file" name="certificate_file" accept=".pdf, .jpg, .png, .webp" class="hidden">
                            </label>
                        </div>

                        <div class="mb-6">
                            <input type="text" id="certificate_title" name="certificate_title"
                                placeholder="Judul Sertifikat" required
                                class="w-full bg-gray-900 text-white text-sm h-12 border border-gray-700 p-4 rounded-xl 
                                       focus:outline-none focus:border-lime-400 placeholder-gray-500">
                        </div>

                        <div class="mb-8">
                            <textarea id="certificate_description" name="certificate_description" rows="5"
                                placeholder="Deskripsi Sertifikat......"
                                class="w-full bg-gray-900 text-white border text-sm border-gray-700 p-4 rounded-xl 
                                       focus:outline-none focus:border-lime-400 placeholder-gray-500 resize-none"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-4 bg-lime-400 text-black font-bold text-sm rounded-xl 
                                   hover:bg-lime-500 transition shadow-lg shadow-lime-400/30">
                            Add Certificate!
                        </button>
                    </form>

                    <div class="mt-12 pt-8 border-t border-gray-700">
                        <h3 class="text-3xl font-bold text-white mb-6">Daftar Sertifikat Saya</h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead>
                                    <tr class="text-gray-400 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Gambar/File</th>
                                        <th class="py-3 px-6 text-left">Judul Sertifikat</th>
                                        <th class="py-3 px-6 text-left">Deskripsi Singkat</th>
                                        <th class="py-3 px-6 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-white text-sm font-light divide-y divide-gray-800">

                                    <?php
                                    // Cek apakah ada data
                                    if ($result_sertifikat && $result_sertifikat->num_rows > 0) {
                                        // Loop data
                                        while ($row = $result_sertifikat->fetch_assoc()) {
                                            // Potong deskripsi agar tidak terlalu panjang
                                            $deskripsi_penuh = htmlspecialchars($row['deskripsi_sertifikat']);
                                            $deskripsi_singkat = (strlen($deskripsi_penuh) > 100) ? substr($deskripsi_penuh, 0, 100) . '...' : $deskripsi_penuh;
                                    ?>

                                            <tr class="hover:bg-gray-900 transition">
                                                <td class="py-4 px-6 whitespace-nowrap">
                                                    <div class="flex items-center w-16 h-16 bg-gray-700 rounded-lg overflow-hidden border border-gray-600">

                                                        <?php
                                                        if (!empty($row['gambar_data'])) {
                                                            // Cek jika TIPE file adalah GAMBAR
                                                            if (strpos($row['gambar_tipe'], 'image') !== false) {
                                                        ?>
                                                                <img src="data:<?php echo htmlspecialchars($row['gambar_tipe']); ?>;base64,<?php echo base64_encode($row['gambar_data']); ?>"
                                                                    alt="Sertifikat" class="w-full h-full object-cover">
                                                            <?php
                                                                // Cek jika TIPE file adalah PDF
                                                            } elseif (strpos($row['gambar_tipe'], 'pdf') !== false) {
                                                            ?>
                                                                <div class="w-full h-full flex items-center justify-center text-xs text-red-400 font-bold p-2 text-center">PDF File</div>
                                                            <?php
                                                                // Jika tipe lain (bukan gambar atau pdf)
                                                            } else {
                                                            ?>
                                                                <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">File</div>
                                                            <?php
                                                            }
                                                        } else {
                                                            // Jika tidak ada file sama sekali
                                                            ?>
                                                            <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">No Image</div>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                                <td class="py-4 px-6 font-medium text-lime-400">
                                                    <?php echo htmlspecialchars($row['judul_sertifikat']); ?>
                                                </td>
                                                <td class="py-4 px-6 text-gray-400 max-w-xs truncate" title="<?php echo $deskripsi_penuh; ?>">
                                                    <?php echo $deskripsi_singkat; ?>
                                                </td>
                                                <td class="py-4 px-6 text-center whitespace-nowrap">
                                                    <div class="flex item-center justify-center space-x-2">
                                                        <a href="edit_sertifikat.php?id=<?php echo $row['id_sertifikat']; ?>" class="text-blue-400 hover:text-blue-500 font-bold transition">Edit</a>
                                                        <span class="text-gray-600">|</span>
                                                        <a href="hapus_sertifikat.php?id=<?php echo $row['id_sertifikat']; ?>"
                                                            onclick="return confirm('Yakin ingin menghapus sertifikat ini?');"
                                                            class="text-red-400 hover:text-red-500 font-bold transition">Hapus</a>
                                                    </div>
                                                </td>
                                            </tr>

                                        <?php
                                        } // Tutup while loop
                                    } else {
                                        // Tampilkan ini jika tabel kosong
                                        ?>
                                        <tr class="hover:bg-gray-900 transition">
                                            <td colspan="4" class="py-4 px-6 text-center text-gray-500">
                                                Belum ada sertifikat yang di-upload.
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    // Tutup koneksi
                                    $koneksi->close();
                                    ?>

                                </tbody>
                            </table>
                        </div>
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
            var fileName = this.files[0] ? this.files[0].name : 'Pilih file (JPG, PNG, PDF, WEBP)';
            document.getElementById('file-name-display').textContent = fileName;
        };
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