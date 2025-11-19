<?php
// 1. MASUKKAN KONEKSI
include '../koneksi.php';

// ------------------------------------------------------------------
// [LANGKAH 3] PROSES UPDATE JIKA FORM DISUBMIT (METHOD POST)
// ------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil semua data dari form, TERMASUK ID
    $id_project = (int)$_POST['id_project']; // Ambil ID dari hidden input
    $judul_project = $_POST['project_title'];
    $durasi_pengerjaan = $_POST['project_duration'];
    $tanggal_pengerjaan = $_POST['project_date'];
    $tipe_pengerjaan = $_POST['project_team'];
    $link_project = $_POST['project_link'];
    $deskripsi_project = $_POST['project_description'];
    $keywords = $_POST['project_keyword'];

    // Cek apakah ada file BARU yang di-upload
    if (isset($_FILES['project_file']) && $_FILES['project_file']['error'] == 0 && $_FILES['project_file']['size'] > 0) {

        // --- Ada file baru, proses seperti di project.php ---

        // Cek ukuran file (Maks 1MB)
        $max_file_size = 1048576; // 1MB
        if ($_FILES['project_file']['size'] > $max_file_size) {
            echo "Error: Ukuran file baru terlalu besar. Maksimal 1MB.";
            exit;
        }

        // Cek tipe file
        $gambar_tipe = $_FILES['project_file']['type'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($gambar_tipe, $allowed_types)) {
            echo "Error: Tipe file baru tidak diizinkan (hanya JPG, PNG, WEBP).";
            exit;
        }

        // Baca data biner (binary) dari file temporer
        $gambar_data = file_get_contents($_FILES['project_file']['tmp_name']);

        // Buat query UPDATE DENGAN GAMBAR BARU
        $sql_update = "UPDATE tb_projects SET 
                        judul_project = ?, gambar_data = ?, gambar_tipe = ?, 
                        durasi_pengerjaan = ?, tanggal_pengerjaan = ?, tipe_pengerjaan = ?, 
                        link_project = ?, deskripsi_project = ?, keywords = ?
                       WHERE id_project = ?";

        $stmt = $koneksi->prepare($sql_update);
        // Tipe: s(judul), b(data), s(tipe), s(durasi), s(tgl), s(tipe), s(link), s(desk), s(key), i(id)
        $stmt->bind_param(
            "sbsssssssi",
            $judul_project,
            $gambar_data,
            $gambar_tipe,
            $durasi_pengerjaan,
            $tanggal_pengerjaan,
            $tipe_pengerjaan,
            $link_project,
            $deskripsi_project,
            $keywords,
            $id_project
        );
        // Kirim data BLOB
        $stmt->send_long_data(1, $gambar_data);
    } else {
        // --- Tidak ada file baru, jangan update gambar ---

        // Buat query UPDATE TANPA GAMBAR
        $sql_update = "UPDATE tb_projects SET 
                        judul_project = ?, durasi_pengerjaan = ?, tanggal_pengerjaan = ?, 
                        tipe_pengerjaan = ?, link_project = ?, deskripsi_project = ?, 
                        keywords = ?
                       WHERE id_project = ?";

        $stmt = $koneksi->prepare($sql_update);
        // Tipe: s, s, s, s, s, s, s, i (tanpa data gambar)
        $stmt->bind_param(
            "sssssssi",
            $judul_project,
            $durasi_pengerjaan,
            $tanggal_pengerjaan,
            $tipe_pengerjaan,
            $link_project,
            $deskripsi_project,
            $keywords,
            $id_project
        );
    }

    // Eksekusi query (baik yang dengan gambar atau tanpa gambar)
    if ($stmt->execute()) {
        // Jika berhasil, kembali ke halaman project.php
        header("Location: project.php?status=sukses");
        exit;
    } else {
        echo "Error: Gagal mengupdate data. " . $koneksi->error;
    }
    $stmt->close();
    
}
// ------------------------------------------------------------------
// [LANGKAH 1] PROSES AMBIL DATA (JIKA HALAMAN DIBUKA - METHOD GET)
// ------------------------------------------------------------------

// Cek apakah ID ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Error: ID Project tidak ditemukan.";
    exit;
}

$id_project = (int)$_GET['id'];

// Ambil data project yang spesifik dari database
$sql_select = "SELECT * FROM tb_projects WHERE id_project = ?";
$stmt_select = $koneksi->prepare($sql_select);
$stmt_select->bind_param("i", $id_project);
$stmt_select->execute();
$result = $stmt_select->get_result();
$project = $result->fetch_assoc();

// Cek apakah project dengan ID itu ada
if (!$project) {
    echo "Error: Data project tidak ditemukan.";
    $stmt_select->close();
    $koneksi->close();
    exit;
}

// Tutup statement select, tapi biarkan koneksi terbuka untuk form
$stmt_select->close();
// $koneksi->close(); // Jangan ditutup dulu, form masih perlu

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="../ASSET/LOGO/DW_FIX.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - Daniel</title>
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

        /* Style untuk scrollbar (Opsional) */
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
                <a href="datadiri.php" class="text-gray-400 hover:text-white transition block cursor-pointer">Data Diri</a>
                <a href="project.php" class="text-lime-400 font-semibold text-lg block cursor-pointer">Projects</a>
                <a href="sertifikat.php" class="text-gray-400 hover:text-white transition block cursor-pointer">Certificates</a>
                <a href="sharing.php" class="text-gray-400 hover:text-white transition block cursor-pointer">Sharing</a>
            </nav>
            <div class="mt-auto">
                <a href="../index.php" class="text-red-500 hover:text-red-400 transition font-semibold cursor-pointer">Logout</a>
                <p class="text-gray-600 text-xs mt-8">© Copyright 2025 DanielWrks</p>
            </div>
        </div>

        <div class="flex-1 h-full overflow-y-auto p-12">
            <div class="max-w-5xl mx-auto">
                <div class="bg-black rounded-3xl p-12">

                    <div class="mb-8">
                        <h2 class="text-5xl font-bold text-lime-400 mb-2">Edit Project</h2>
                        <p class="text-gray-400">Perbarui detail untuk project:
                            <strong><?php echo htmlspecialchars($project['judul_project']); ?></strong>
                        </p>
                    </div>

                    <form action="edit_project.php" method="POST" enctype="multipart/form-data" class="mb-12 border-b border-gray-700 pb-10">

                        <input type="hidden" name="id_project" value="<?php echo $project['id_project']; ?>">

                        <div class="mb-4">
                            <label class="text-gray-400 text-sm">Gambar Saat Ini:</label>
                            <?php if (!empty($project['gambar_data'])) { ?>
                                <img src="data:<?php echo htmlspecialchars($project['gambar_tipe']); ?>;base64,<?php echo base64_encode($project['gambar_data']); ?>"
                                    alt="Gambar Saat Ini" class="w-32 h-32 object-cover rounded-lg mt-2 border border-gray-700">
                            <?php } else { ?>
                                <p class="text-gray-500 text-sm mt-2">Tidak ada gambar.</p>
                            <?php } ?>
                        </div>

                        <div class="mb-6">
                            <label for="project_file" class="block bg-gray-900 text-gray-400 text-sm border border-gray-700 p-4 h-12 rounded-xl text-center cursor-pointer hover:bg-gray-800 transition">
                                <span id="file-name-display">Pilih file BARU (Biarkan kosong jika tidak ganti)</span>
                                <input type="file" id="project_file" name="project_file" accept=".jpg, .jpeg, .png, .webp" class="hidden">
                            </label>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <input type="text" name="project_title" placeholder="Judul project" required
                                value="<?php echo htmlspecialchars($project['judul_project']); ?>"
                                class="w-full bg-gray-900 text-white text-sm border border-gray-700 p-4 h-12 rounded-xl focus:outline-none focus:border-lime-400 placeholder-gray-500">

                            <input type="text" name="project_duration" placeholder="Durasi pengerjaan" required
                                value="<?php echo htmlspecialchars($project['durasi_pengerjaan']); ?>"
                                class="w-full bg-gray-900 text-white text-sm border border-gray-700 p-4 h-12 rounded-xl focus:outline-none focus:border-lime-400 placeholder-gray-500">
                        </div>

                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <input type="date" name="project_date" placeholder="hari/bulan/tahun" required
                                value="<?php echo htmlspecialchars($project['tanggal_pengerjaan']); ?>"
                                class="w-full bg-gray-900 text-white text-sm border border-gray-700 p-4 h-12 rounded-xl focus:outline-none focus:border-lime-400 placeholder-gray-500">

                            <select name="project_team" required class="w-full bg-gray-900 text-white text-sm border border-gray-700 p-4 h-12 rounded-xl focus:outline-none focus:border-lime-400 placeholder-gray-500 appearance-none">
                                <option value="" disabled>Pilih Team/Mandiri</option>
                                <option value="Team" <?php if ($project['tipe_pengerjaan'] == 'Team') echo 'selected'; ?>>Team</option>
                                <option value="Mandiri" <?php if ($project['tipe_pengerjaan'] == 'Mandiri') echo 'selected'; ?>>Mandiri</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <input type="url" name="project_link" placeholder="Link (Optional)"
                                value="<?php echo htmlspecialchars($project['link_project']); ?>"
                                class="w-full bg-gray-900 text-white text-sm border border-gray-700 p-3 h-12 rounded-xl focus:outline-none focus:border-lime-400 placeholder-gray-500">
                        </div>

                        <div class="mb-6">
                            <textarea name="project_description" rows="5" placeholder="Deskripsi Project......"
                                class="w-full bg-gray-900 text-white text-sm border border-gray-700 p-4 rounded-xl focus:outline-none focus:border-lime-400 placeholder-gray-500 resize-none"><?php echo htmlspecialchars($project['deskripsi_project']); ?></textarea>
                        </div>

                        <div class="mb-8">
                            <textarea name="project_keyword" rows="3" placeholder="Keyword.... ex : Mainan, dll"
                                class="w-full bg-gray-900 text-white text-sm border border-gray-700 p-4 h-[80px] rounded-xl focus:outline-none focus:border-lime-400 placeholder-gray-500 resize-none"><?php echo htmlspecialchars($project['keywords']); ?></textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-4 bg-lime-400 text-black font-bold text-sm rounded-xl hover:bg-lime-500 transition shadow-lg shadow-lime-400/30">
                            Update Project!
                        </button>
                    </form>

                    <div class="text-center">
                        <a href="project.php" class="text-gray-400 hover:text-white transition">← Kembali ke Daftar Project</a>
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
        // Skrip untuk menampilkan nama file (sama seperti sebelumnya)
        document.getElementById('project_file').onchange = function() {
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
// Tutup koneksi setelah semua HTML selesai
$koneksi->close();
?>