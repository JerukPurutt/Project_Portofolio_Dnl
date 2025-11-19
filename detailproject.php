<?php
// 1. MASUKKAN KONEKSI
include 'koneksi.php';

// 2. AMBIL ID DARI URL
// Cek apakah ID ada dan valid (berupa angka)
if (!isset($_GET['id']) || !(int)$_GET['id']) {
    die("Error: ID Project tidak valid atau tidak ditemukan.");
}
$id_project = (int)$_GET['id'];

// 3. AMBIL DATA SPESIFIK DARI DATABASE
// Gunakan prepared statement untuk keamanan
$sql = "SELECT * FROM tb_projects WHERE id_project = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id_project);
$stmt->execute();
$result = $stmt->get_result();

// 4. CEK APAKAH DATA DITEMUKAN
if ($result->num_rows == 0) {
    die("Error: Project dengan ID " . $id_project . " tidak ditemukan.");
}

// 5. SIMPAN DATA KE VARIABEL
// Kita hanya mengambil 1 baris data
$project = $result->fetch_assoc();

// Data sudah diambil, kita bisa tutup statement
$stmt->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="ASSET/LOGO/DW_FIX.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($project['judul_project']); ?> - Daniel Wika</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'lime-custom': '#CCFF00',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-white">
    <nav class="bg-black border-b border-gray-800 px-6 fixed w-full top-0 left-0 z-10">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php#home"> <img src="ASSET/LOGO/DW_FIX.png" alt="FR1 Index Logo" class="h-20 w-auto">
            </a>
            <div class="flex gap-6 text-sm text-white">
                <a href="index.php#home" class="hover:text-yellow-400 transition">Home</a>
                <a href="index.php#about" class="hover:text-yellow-400 transition">About</a>
                <a href="biodata.php#pendidikan" class="hover:text-yellow-400 transition">Pendidikan</a>
                <a href="index.php#contact" class="hover:text-yellow-400 transition">Contact</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-5 pt-28 pb-10">
        <div class="relative bg-black rounded-3xl p-10 grid md:grid-cols-2 gap-16 items-center">

            <div class="absolute top-4 left-6 z-20 text-sm px-5 ">
                <a href="index.php" class="text-gray-300 hover:underline">← Back</a>
                <span class="text-gray-500"> / Project > <?php echo htmlspecialchars($project['judul_project']); ?></span>
            </div>

            <div class="bg-white rounded-2xl p-8 flex justify-center items-center relative">
                <?php if (!empty($project['gambar_data'])) { ?>
                    <img src="data:<?php echo htmlspecialchars($project['gambar_tipe']); ?>;base64,<?php echo base64_encode($project['gambar_data']); ?>"
                        alt="<?php echo htmlspecialchars($project['judul_project']); ?>"
                        class="max-w-full h-auto rounded-xl">
                <?php } else { ?>
                    <div class="max-w-full h-auto rounded-xl bg-gray-200 aspect-square flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                <?php } ?>
            </div>

            <div>
                <h1 class="text-lime-custom text-5xl font-bold mb-6"><?php echo htmlspecialchars($project['judul_project']); ?></h1>

                <p class="text-white leading-relaxed mb-8">
                    <?php echo nl2br(htmlspecialchars($project['deskripsi_project'])); ?>
                </p>

                <div class="flex gap-5 mb-8">
                    <div class="bg-lime-custom text-gray-900 font-bold px-8 py-4 rounded-xl">
                        <?php echo htmlspecialchars($project['durasi_pengerjaan']); ?><br>Durasi Pengerjaan
                    </div>
                </div>

                <div class="text-white space-y-2">
                    <p><strong>Link :</strong>
                        <a href="<?php echo htmlspecialchars($project['link_project']); ?>" target="_blank" class="text-sm text-blue-400 hover:text-blue-300 underline mb-1 block truncate">
                            <?php echo htmlspecialchars($project['link_project']); ?>
                        </a>
                    </p>

                    <p><strong>Tanggal Pengerjaan:</strong> <?php echo date('d F Y', strtotime($project['tanggal_pengerjaan'])); ?></p>

                    <p><strong>Pengerjaan:</strong> <?php echo htmlspecialchars($project['tipe_pengerjaan']); ?></p>
                </div>
            </div>
        </div>

        <div class="bg-black rounded-3xl p-8 mt-8">
            <h2 class="text-lime-custom text-2xl font-bold mb-3">Keyword:</h2>

            <div class="text-white flex flex-wrap gap-2">
                <?php
                // Pecah string keywords berdasarkan koma
                $keywords = explode(',', $project['keywords']);

                if (count($keywords) > 0 && !empty(trim($project['keywords']))) {
                    foreach ($keywords as $keyword) {
                        // Tampilkan setiap keyword sebagai tag
                        echo '<span class="bg-gray-700 px-3 py-1 rounded-full text-sm">' . htmlspecialchars(trim($keyword)) . '</span>';
                    }
                } else {
                    echo '<p class="text-gray-400 text-sm">Tidak ada keyword untuk project ini.</p>';
                }
                ?>
            </div>
        </div>
    </div>
    <footer class="bg-black border-t text-center border-gray-800 px-6 py-6 fixed w-full bottom-0 left-0 z-10">
        <div class="max-w-7xl mx-auto flex justify-between items-center gap-4 text-sm text-gray-400">
            <div>
                <img src="ASSET/LOGO/DW_FIX.png" alt="Logo" class="h-[80px] w-auto">
            </div>
            <div class="flex gap-6">
                <a href="index.php" class="hover:text-white transition">Home</a>
                <a href="biodata.php" class="hover:text-white transition">Biodata</a>
                <a href="biodata.php#pendidikan" class="hover:text-white transition">Pendidikan</a>
                <a href="Login.php" class="hover:text-white transition">Admin</a>
            </div>
            <p>© Copyright 2025 Daniel Wrks</p>
        </div>
    </footer>
</body>

</html>
<?php
// 6. TUTUP KONEKSI
$koneksi->close();
?>