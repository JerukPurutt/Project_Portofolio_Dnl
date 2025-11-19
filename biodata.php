<?php
// 1. MASUKKAN KONEKSI
include 'koneksi.php';
$biodata_id = 1; // Kita asumsikan data biodata selalu ada di ID 1

// ------------------------------------------------------------------
// [BAGIAN 1] LOGIKA UNTUK DOWNLOAD CV
// ------------------------------------------------------------------
if (isset($_GET['download_cv'])) {
    // Ambil file CV dari database
    $sql_cv = "SELECT cv_file_data, cv_file_tipe FROM tb_biodata WHERE id = ?";
    $stmt_cv = $koneksi->prepare($sql_cv);
    $stmt_cv->bind_param("i", $biodata_id);
    $stmt_cv->execute();
    $result_cv = $stmt_cv->get_result();
    $cv = $result_cv->fetch_assoc();

    if ($cv && !empty($cv['cv_file_data'])) {
        // Kirim header ke browser agar file ter-download
        header("Content-Type: " . $cv['cv_file_tipe']); // (e.g., 'application/pdf')
        header("Content-Disposition: inline; filename=\"CV_Daniel_Ramadhani.pdf\"");
        header("Content-Length: " . strlen($cv['cv_file_data']));

        // Keluarkan data file
        echo $cv['cv_file_data'];

        $stmt_cv->close();
        $koneksi->close();
        exit; // Hentikan eksekusi skrip
    } else {
        // Jika file tidak ada, matikan skrip
        die("File CV tidak ditemukan di database.");
    }
}

// ------------------------------------------------------------------
// [BAGIAN 2] LOGIKA AMBIL DATA BIODATA UNTUK TAMPILAN
// ------------------------------------------------------------------
$biodata_id = 1; // Asumsikan data biodata Anda ada di ID 1
// 2. AMBIL DATA DARI tb_biodata
$sql = "SELECT * FROM tb_biodata WHERE id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $biodata_id);
$stmt->execute();
$result = $stmt->get_result();
$bio = $result->fetch_assoc();

if (!$bio) {
    die("Data biodata tidak ditemukan.");
}
// Tutup statement select setelah datanya diambil
$stmt->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="ASSET/LOGO/DW_FIX.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Biodata - <?php echo htmlspecialchars($bio['nama_lengkap']); ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }
         html {
            scroll-behavior: smooth;
        }
        .neon-green {
            background-color: #CCFF00;
        }

        .dark-bg {
            background-color: #0a0a0a;
        }

        .card-dark {
            background-color: #1a1a1a;
        }

        /* Tambahan untuk shadow neon */
        .shadow-neon {
            box-shadow: 0 0 15px #b5ff00;
        }
    </style>
</head>

<body class="dark-bg text-white"id="home">

    <nav class="bg-black border-b border-gray-800 px-6 fixed w-full top-0 left-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php#home"> <img src="ASSET/LOGO/DW_FIX.png" alt="FR1 Index Logo" class="h-20 w-auto">
            </a>
            <div class="flex gap-6 text-sm">
                <a href="index.php#home" class="hover:text-yellow-400 transition">Home</a>
                <a href="biodata.php#home" class="hover:text-yellow-400 transition">Biodata</a>
                <a href="biodata.php#pendidikan" class="hover:text-yellow-400 transition">Pendidikan</a>
                <a href="index.php#contact" class="hover:text-yellow-400 transition">Contact</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 pt-20 pb-10 z-10">
        <div class="bg-[#b5ff00] rounded-3xl p-8 flex items-center gap-10 shadow-neon">

            <div class="relative w-56 h-56 flex-shrink-0">
                <?php
                // Cek apakah ada foto di database
                if (!empty($bio['foto_profil_data'])) {
                ?>
                    <img src="data:<?php echo $bio['foto_profil_tipe']; ?>;base64,<?php echo base64_encode($bio['foto_profil_data']); ?>" alt="Daniel"
                         class="rounded-full relative z-10 border-4 border-[#b5ff00] object-cover w-full h-full" />
                <?php
                } else {
                ?>
                    <img src="ASSET/LOGO/PASFOTO_PNG.webp" alt="Daniel"
                         class="rounded-full relative z-10 border-4 border-[#b5ff00] object-cover w-full h-full" />
                <?php
                }
                ?>
            </div>

            <div class="flex-1 bg-[#0b0b0b] text-white p-8 rounded-3xl">
                <h2 class="text-4xl font-bold mb-3 text-[#b5ff00]">Hi, i'm Daniel</h2>

                <p class="text-sm text-gray-300 mb-6 leading-relaxed">
                    <?php echo nl2br(htmlspecialchars($bio['deskripsi_hero'])); ?>
                </p>

                <div class="text-sm mb-6 space-y-1">
                    <p><span class="font-semibold">Nama :</span> <?php echo htmlspecialchars($bio['nama_lengkap']); ?></p>
                    <p><span class="font-semibold">Email :</span> <?php echo htmlspecialchars($bio['email']); ?></p>
                    <p><span class="font-semibold">No. Telp :</span> <?php echo htmlspecialchars($bio['telepon']); ?></p>
                </div>
                <div class="flex gap-4">
                    <a href="biodata.php?download_cv=true" target="_blank" rel="noopener noreferrer" class="bg-[#b5ff00] text-black px-6 py-2 rounded-full text-sm font-semibold hover:bg-lime-300 transition">Personal CV</a>
                    <a href="index.php#projects" class="bg-white text-black px-6 py-2 rounded-full text-sm font-semibold hover:bg-gray-200 transition">My Projects →</a>
                </div>
            </div>
        </div>
    </div>
    <section class="max-w-5xl mx-auto mt-12 px-6 mb-16" id="pendidikan">
        <h3 class="text-3xl font-bold text-center mb-8">Riwayat Pendidikan</h3>
        <div class="space-y-6">
            <div class="bg-[#0b0b0b] text-[#b5ff00] rounded-xl p-4 border-2 border-[#b5ff00] shadow-[0_0_15px_#b5ff00] transition duration-300 hover:shadow-[0_0_25px_#b5ff00]">
                <h4 class="font-bold text-lg">SD Negeri Jimbaran Kulon</h4>
                <p class="text-sm">2011 - 2017</p>
                <p class="text-sm text-white">
                    Nilai Akhir: <span class="font-semibold text-[#b5ff00]">95.2</span>
                </p>
            </div>
            <div class="bg-[#b5ff00] text-black rounded-xl p-4 shadow-neon">
                <h4 class="font-bold text-lg">SMP Negeri 2 Wonoayu</h4>
                <p class="text-sm">2017 - 2020</p>
                <p class="text-sm">Nilai Akhir: <span class="font-semibold">87.5</span></p>
            </div>
            <div class="bg-[#0b0b0b] text-[#b5ff00] rounded-xl p-4 border-2 border-[#b5ff00] shadow-[0_0_15px_#b5ff00] transition duration-300 hover:shadow-[0_0_25px_#b5ff00]">
                <h4 class="font-bold text-lg">SMA Al-Islam Krian</h4>
                <p class="text-sm">2020 - 2023</p>
                <p class="text-sm text-white">Nilai Akhir: <span class="font-semibold">89.5</span></p>
            </div>
            <div class="bg-[#b5ff00] text-black rounded-xl p-4 shadow-neon">
                <h4 class="font-bold text-lg">Universitas Pembangunan Nasional ‘Veteran’ Jawa Timur</h4>
                <p class="text-sm">2023 - Sekarang</p>
                <p class="text-sm">IPK Sementara: <span class="font-semibold">3.61</span></p>
            </div>
        </div>
    </section>

    <footer class="bg-black border-t text-center border-gray-800 px-6 py-6">
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
// Tutup koneksi di sini (di akhir file)
$koneksi->close();
?>