<?php
include 'koneksi.php';

// 1. QUERY PROJECTS
$sql_projects = "SELECT id_project, judul_project, deskripsi_project, tanggal_pengerjaan, gambar_tipe 
                 FROM tb_projects 
                 ORDER BY tanggal_pengerjaan DESC";
$result_projects = $koneksi->query($sql_projects);
$project_count = $result_projects->num_rows; // Menghitung jumlah project

// 2. QUERY SERTIFIKAT
$sql_sertif = "SELECT id_sertifikat, judul_sertifikat, deskripsi_sertifikat, gambar_data, gambar_tipe, waktu_dibuat 
               FROM tb_sertifikat 
               ORDER BY waktu_dibuat DESC";
$result_sertifikat = $koneksi->query($sql_sertif);
$sertifikat_count = $result_sertifikat->num_rows; // Menghitung jumlah sertifikat

// 3. QUERY SHARING
$sql_sharing = "SELECT id_sharing, judul_experience, link_optional, deskripsi, gambar_data, gambar_tipe, waktu_dibuat 
                FROM tb_sharing 
                ORDER BY waktu_dibuat DESC";
$result_sharing = $koneksi->query($sql_sharing);
$sharing_count = $result_sharing->num_rows; // Menghitung jumlah sharing
?>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="ASSET/LOGO/DW_FIX.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daniel's Portfolio</title>
    <link rel="stylesheet" href="style.css">
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
    </style>
</head>

<body class="dark-bg text-white" id="home">
    <!-- Navigation -->
    <nav class="bg-black border-b border-gray-800 px-6  fixed w-full top-0 left-0 z-10">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="#home">
                <img src="ASSET/LOGO/DW_FIX.png" alt="FR1 Index Logo" class="h-20 w-auto">
            </a>
            <div class="flex gap-6 text-sm">
                <a href="#home" class="hover:text-yellow-400 transition">Home</a>
                <a href="biodata.php" class="hover:text-yellow-400 transition">Biodata</a>
                <a href="biodata.php#pendidikan" class="hover:text-yellow-400 transition">Pendidikan</a>
                <a href="#contact" class="hover:text-yellow-400 transition">Contact</a>
            </div>
        </div>
    </nav>
    <div class="max-w-7xl mx-auto px-6 pt-20 pb-20" style="padding-top: 180px;">
        <div class="neon-green rounded-3xl mb-8 flex items-center justify-between" data-aos="fade-down">
            <div class="text-black max-w-xl ml-8">
                <h2 class="text-5xl font-extrabold mb-4 leading-tight">
                    Hi, Welcome<br>to My Portfolio!
                </h2>
                <p class="text-sm mb-6 leading-relaxed">
                    Selamat datang di ruang kreatif tempat ide bertemu teknologi! Saya percaya bahwa setiap proyek adalah kesempatan untuk menciptakan sesuatu yang bermakna. Di sini, Anda akan menemukan berbagai karya yang mencerminkan perjalanan dan keahlian saya.
                </p>
                <button class="bg-black text-white px-6 py-2 rounded-full text-sm font-semibold hover:bg-gray-800 transition">
                    Lihat Portfolio
                </button>
            </div>
            <div class="flex-shrink-0 self-end">
                <img src="ASSET/LOGO/PIXEL_IEL_PNG.webp" alt="Daniel"
                    class="w-[250px] h-auto object-contain">
            </div>

        </div>
    </div>
    <!-- About Me Section -->
    <div class="text-center mb-8">
        <h3 class="text-3xl font-bold mb-2">Want To Know More <span class="text-yellow-400">About Me?</span></h3>
        <p class="text-gray-400 text-sm">Scroll Down to Explore!</p>
    </div>
    <!-- Profile Card -->
    <div class="card-dark rounded-3xl p-8 mb-8 flex gap-8 items-start" id="about" data-aos="fade-up">
        <div class="flex-shrink-0">
            <div class="w-48 h-48 rounded-full overflow-hidden border-4 neon-green">
                <img src="ASSET\LOGO\PASFOTO_PNG.webp" alt="Daniel Profile" class="w-full h-full object-cover">
            </div>
        </div>
        <div class="flex-1">
            <h4 class="text-3xl font-bold mb-2">Hi, I'm Daniel</h4>
            <p class="text-yellow-400 text-sm mb-4">Just an teenage student</p>
            <p class="text-gray-300 text-sm leading-relaxed mb-6">
                Hi! I'm Daniel, a student at SMKN 2 Surabaya (the best school in the area!).
                I'm a tech enthusiast passionate about robotics, IoT, and software development.
                Always eager to learn and explore innovative solutions. When I'm not coding,
                you'll find me brainstorming the next big idea or working on a new project!
            </p>
            <div class="flex gap-4">
                <button class="neon-green text-black px-6 py-2 rounded-full text-sm font-semibold hover:opacity-90 transition">
                    Contact Me
                </button>
                <button class="border border-white text-white px-6 py-2 rounded-full text-sm font-semibold hover:bg-white hover:text-black transition">
                    My Social
                </button>
            </div>
        </div>
    </div>
    <!-- Stats Cards -->
    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="card-dark rounded-2xl p-6 border border-yellow-400" data-aos="fade-right">
            <h5 class="text-yellow-400 font-semibold mb-2">Projects</h5>
            <p class="text-gray-400 text-sm mb-4">Things I have done</p>
            <p class="text-5xl font-bold"><?php echo $project_count; ?></p>
        </div>
        <div class="card-dark rounded-2xl p-6 border border-yellow-400" data-aos="fade-up">
            <h5 class="text-yellow-400 font-semibold mb-2">Certificates</h5>
            <p class="text-gray-400 text-sm mb-4">Achievement things</p>
            <p class="text-5xl font-bold"><?php echo $sertifikat_count; ?></p>
        </div>
        <div class="card-dark rounded-2xl p-6 border border-yellow-400" data-aos="fade-left">
            <h5 class="text-yellow-400 font-semibold mb-2">Experiences</h5>
            <p class="text-gray-400 text-sm mb-4">Professional journey</p>
            <p class="text-5xl font-bold"><?php echo $sharing_count; ?></p>
        </div>
    </div>
    <!-- Portfolio Showcase -->
    <div class="mb-8" id="project">
        <section class="py-10 bg-[#0b0b0b] text-white">
            <h3 class="text-4xl font-bold text-center mb-6">Portofolio Showcase</h3>
            <div class="flex justify-center gap-4 mb-8">
                <button onclick="showSection('projects')" id="btnProjects"
                    class="active-btn px-6 py-2 rounded-full text-sm font-semibold transition">
                    Projects
                </button>
                <button onclick="showSection('sertificates')" id="btnSertificate"
                    class="inactive-btn px-6 py-2 rounded-full text-sm font-semibold transition">
                    Sertificate
                </button>
                <button onclick="showSection('sharing')" id="btnSharing"
                    class="inactive-btn px-6 py-2 rounded-full text-sm font-semibold transition">
                    Sharing Experiences
                </button>
            </div>
            <!-- Projects Section -->
            <div id="projects" class="grid grid-cols-3 gap-6" data-aos="flip-up">

                <?php
                // Cek apakah ada data project yang ditemukan
                if ($result_projects && $result_projects->num_rows > 0) {

                    // Loop (ulangi) untuk setiap baris data project
                    while ($row = $result_projects->fetch_assoc()) {

                        // Ambil data dan amankan untuk ditampilkan
                        $id = $row['id_project'];
                        $judul = htmlspecialchars($row['judul_project']);
                        $tanggal = date('d M Y', strtotime($row['tanggal_pengerjaan'])); // Format tanggal

                        // Potong deskripsi agar tidak terlalu panjang (misal 15 kata)
                        $deskripsi_full = htmlspecialchars($row['deskripsi_project']);
                        $words = explode(' ', $deskripsi_full);
                        $deskripsi_singkat = implode(' ', array_slice($words, 0, 15)) . '...';
                ?>

                        <div class="card-dark rounded-2xl overflow-hidden">
                            <div class="p-6">
                                <h4 class="text-xl font-bold mb-2"><?php echo $judul; ?></h4>
                                <p class="text-gray-400 text-xs mb-4"><?php echo $deskripsi_singkat; ?></p>

                                <?php if (!empty($row['gambar_tipe'])) { ?>
                                    <img src="view_image.php?type=project&id=<?php echo $id; ?>"
                                        loading="lazy"
                                        alt="<?php echo $judul; ?>"
                                        class="rounded-lg mb-4 w-full h-[256px] object-cover">

                                <?php } else { ?>
                                    <div class="rounded-lg mb-4 w-full h-[256px] bg-gray-700 flex items-center justify-center">
                                        <span class="text-gray-400 text-sm">No Image</span>
                                    </div>
                                <?php } ?>

                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-400">Published: <?php echo $tanggal; ?></span>

                                    <a href="detailproject.php?id=<?php echo $id; ?>"
                                        class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">
                                        View Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php
                    } // Tutup while loop
                } else {
                    // Tampilkan pesan jika tidak ada project sama sekali
                    echo '<p class="text-gray-400 col-span-3 text-center">Belum ada project yang ditambahkan.</p>';
                }
                // (Jangan tutup koneksi dulu jika Anda akan memakainya lagi untuk sertifikat/sharing)
                // $koneksi->close();
                ?>

            </div>
            <!-- Sharing Section -->
            <div id="sharing" class="grid grid-cols-3 gap-6 hidden" data-aos="flip-up">

                <?php
                // Cek apakah ada data sharing
                if ($result_sharing && $result_sharing->num_rows > 0) {

                    // Loop untuk setiap data sharing
                    while ($row_share = $result_sharing->fetch_assoc()) {
                        $sh_judul = htmlspecialchars($row_share['judul_experience']);

                        // Potong deskripsi
                        $sh_deskripsi_full = htmlspecialchars($row_share['deskripsi']);
                        $sh_deskripsi = (strlen($sh_deskripsi_full) > 70) ? substr($sh_deskripsi_full, 0, 70) . '...' : $sh_deskripsi_full;

                        $sh_tanggal = date('d M Y', strtotime($row_share['waktu_dibuat']));
                        $sh_link = htmlspecialchars($row_share['link_optional']);
                ?>

                        <div class="card-dark rounded-2xl overflow-hidden">
                            <div class="p-6">
                                <h4 class="text-xl font-bold mb-2"><?php echo $sh_judul; ?></h4>
                                <p class="text-gray-400 text-xs mb-4"><?php echo $sh_deskripsi; ?></p>

                                <?php
                                // Cek jika ada file dan tipenya adalah gambar
                                if (!empty($row_share['gambar_data']) && strpos($row_share['gambar_tipe'], 'image') !== false) {
                                ?>
                                    <img src="view_image.php?type=sharing&id=<?php echo $row_share['id_sharing']; ?>"
                                        loading="lazy"
                                        alt="<?php echo $sh_judul; ?>"
                                        class="rounded-lg mb-4 w-full h-[256px] object-cover">
                                <?php
                                } else {
                                    // Tampilkan placeholder jika PDF atau kosong
                                ?>
                                    <div class="rounded-lg mb-4 w-full h-[256px] bg-gray-700 flex items-center justify-center">
                                        <span class="text-gray-400 text-sm">
                                            <?php
                                            echo (strpos($row_share['gambar_tipe'], 'pdf') !== false) ? 'PDF File' : 'No Image';
                                            ?>
                                        </span>
                                    </div>
                                <?php } ?>

                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-400">Published: <?php echo $sh_tanggal; ?></span>

                                    <?php
                                    // Tampilkan tombol HANYA jika link_optional diisi
                                    if (!empty($sh_link)) {
                                    ?>
                                        <a href="detailsharing.php?id=<?php echo $row_share['id_sharing']; ?>"
                                            class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">
                                            View Detail
                                        </a>
                                    <?php
                                    } // Anda bisa tambahkan 'else' di sini jika ingin menampilkan sesuatu saat link kosong
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php
                    } // Tutup while loop
                } else {
                    // Tampilkan pesan jika tidak ada data
                    echo '<p class="text-gray-400 col-span-3 text-center">Belum ada sharing yang ditambahkan.</p>';
                }

                // Tutup koneksi setelah semua loop selesai
                $koneksi->close();
                ?>

            </div>
            <!-- Sertificate Section -->
            <div id="sertificates" class="grid grid-cols-3 gap-6 hidden" data-aos="flip-up">
                <?php
                // Cek apakah ada data sertifikat
                if ($result_sertifikat && $result_sertifikat->num_rows > 0) {

                    // Loop untuk setiap sertifikat
                    while ($row_sertif = $result_sertifikat->fetch_assoc()) {
                        $s_judul = htmlspecialchars($row_sertif['judul_sertifikat']);
                        // Potong deskripsi
                        $s_deskripsi = htmlspecialchars(substr($row_sertif['deskripsi_sertifikat'], 0, 70)) . '...';
                        $dataType = $row_sertif['gambar_tipe'];
                        $dataContent = !empty($row_sertif['gambar_data']) ? base64_encode($row_sertif['gambar_data']) : '';
                ?>
                        <div class="card-dark rounded-2xl overflow-hidden">
                            <div class="p-6">
                                <h4 class="text-xl font-bold mb-2"><?php echo $s_judul; ?></h4>
                                <p class="text-gray-400 text-xs mb-4"><?php echo $s_deskripsi; ?></p>

                                <?php
                                // Cek jika ada file dan tipenya adalah gambar
                                if (!empty($row_sertif['gambar_data']) && strpos($row_sertif['gambar_tipe'], 'image') !== false) {
                                ?>
                                    <img src="view_image.php?type=sertifikat&id=<?php echo $row_sertif['id_sertifikat']; ?>"
                                        loading="lazy"
                                        alt="<?php echo $s_judul; ?>"
                                        class="rounded-lg mb-4 w-full h-[256px] object-cover">
                                <?php
                                } else {
                                    // Tampilkan placeholder jika PDF atau kosong
                                ?>
                                    <div class="rounded-lg mb-4 w-full h-[256px] bg-gray-700 flex items-center justify-center">
                                        <span class="text-gray-400 text-sm">
                                            <?php
                                            // Tampilkan 'PDF File' jika itu PDF, jika tidak 'No Image'
                                            echo (strpos($row_sertif['gambar_tipe'], 'pdf') !== false) ? 'PDF File' : 'No Image';
                                            ?>
                                        </span>
                                    </div>
                                <?php } ?>

                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-400">Sertifikat</span>
                                    <button type="button"
                                        onclick="openCertificatePopup('<?php echo $dataType; ?>', '<?php echo $dataContent; ?>')"
                                        class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold cursor-pointer">
                                        View
                                    </button>
                                </div>
                            </div>
                        </div>
                <?php
                    } // Tutup while loop
                } else {
                    // Tampilkan pesan jika tidak ada sertifikat
                    echo '<p class="text-gray-400 col-span-3 text-center">Belum ada sertifikat yang ditambahkan.</p>';
                }
                // JANGAN tutup koneksi di sini, biarkan loop 'sharing' berjalan
                ?>

            </div>
        </section>
        <!-- Popup Overlay -->
        <div id="popupOverlay" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
            <div class="bg-[#111] p-6 rounded-2xl w-[80%] max-w-3xl relative">
                <button onclick="closePopup()" class="absolute top-3 right-4 text-gray-400 hover:text-white text-xl">&times;</button>
                <div id="popupContent" class="text-center"></div>
            </div>
        </div>
        <!-- Contact Section -->
        <div class="grid grid-cols-2 gap-6 mb-8" id="contact">
            <!-- Let's Connect -->
            <div class="card-dark rounded-2xl p-8" data-aos="fade-up-right">
                <h3 class="text-3xl font-bold mb-6">Let's Connect!</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Your Name:</label>
                        <input type="text" placeholder="Enter your name" class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Your Email:</label>
                        <input type="email" placeholder="Enter your email" class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Your Message:</label>
                        <textarea rows="4" placeholder="Write your message" class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-yellow-400"></textarea>
                    </div>
                    <button type="submit" class="w-full neon-green text-black py-3 rounded-lg font-semibold hover:opacity-90 transition">
                        Send Message Now!
                    </button>
                </form>
                <div class="mt-6">
                    <h4 class="text-xl font-bold mb-3">Hit Me Up!</h4>
                    <div class="flex gap-4 text-sm">
                        <a href="rafiakbar.@gmail.com" class="flex items-center gap-2 text-gray-400 hover:text-white transition">
                            <span>📧</span> Email
                        </a>
                        <a href="@rafiakbar" class="flex items-center gap-2 text-gray-400 hover:text-white transition">
                            <span>📸</span> Instagram
                        </a>
                        <a href="rafi_akbar_pp" class="flex items-center gap-2 text-gray-400 hover:text-white transition">
                            <span>💼</span> LinkedIn
                        </a>
                    </div>
                </div>
            </div>

            <!-- Write a Comment -->
            <div class="card-dark rounded-2xl p-8" data-aos="fade-up-left">
                <h3 class="text-3xl font-bold mb-6">Write a Comment</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Your Name:</label>
                        <input type="text" placeholder="Enter your name" class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-yellow-400">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">Comment:</label>
                        <textarea rows="8" placeholder="Write your comment or feedback here..." class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-yellow-400"></textarea>
                    </div>
                    <button type="submit" class="w-full neon-green text-black py-3 rounded-lg font-semibold hover:opacity-90 transition">
                        Send Comment
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
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
    <div id="certificatePopup" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center p-4 z-50 hidden">

        <div class="bg-black rounded-lg shadow-xl max-w-3xl w-full max-h-[90vh] flex flex-col border border-[#CCFF00]">

            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-xl font-bold text-black">Certificate Preview</h3>
                <button onclick="closeCertificatePopup()" class="text-red text-3xl font-bold hover:text-red-500 border-1">&times;</button>
            </div>

            <div id="certificateContent" class="p-4 overflow-y-auto">
            </div>
        </div>
    </div>
</body>
<script>
    function openCertificatePopup(dataType, dataContent) {
        const popup = document.getElementById('certificatePopup');
        const contentArea = document.getElementById('certificateContent');

        // Bersihkan konten sebelumnya
        contentArea.innerHTML = '';

        // Jika tidak ada data, tampilkan pesan
        if (!dataType || !dataContent) {
            contentArea.innerHTML = '<p class="text-black">Tidak ada preview yang tersedia untuk item ini.</p>';
            popup.classList.remove('hidden');
            return;
        }

        if (dataType.includes('image')) {
            // Jika file adalah GAMBAR, buat tag <img>
            const img = document.createElement('img');
            img.src = `data:${dataType};base64,${dataContent}`;
            img.className = 'w-full h-auto rounded';
            contentArea.appendChild(img);

        } else if (dataType.includes('pdf')) {
            // Jika file adalah PDF, buat tag <object>
            const pdfObject = document.createElement('object');
            pdfObject.data = `data:application/pdf;base64,${dataContent}`;
            pdfObject.type = 'application/pdf';
            pdfObject.width = '100%';
            pdfObject.height = '70vh'; // Atur tinggi agar pas di modal

            // Pesan fallback jika browser tidak bisa menampilkan PDF
            pdfObject.innerHTML = '<p class="text-black">Browser Anda tidak mendukung preview PDF. Silakan download file.</p>';
            contentArea.appendChild(pdfObject);

        } else {
            // Jika tipe file lain
            contentArea.innerHTML = '<p class="text-black">Tipe file ini tidak dapat ditampilkan.</p>';
        }

        // Tampilkan popup-nya
        popup.classList.remove('hidden');
    }

    function closeCertificatePopup() {
        const popup = document.getElementById('certificatePopup');
        const contentArea = document.getElementById('certificateContent');

        // Sembunyikan popup
        popup.classList.add('hidden');

        // Kosongkan konten untuk menghemat memori
        contentArea.innerHTML = '';
    }

    function showSection(section) {
        const buttons = ['btnProjects', 'btnSertificate', 'btnSharing'];
        const sections = ['projects', 'sertificates', 'sharing'];

        // Reset semua tombol jadi nonaktif
        buttons.forEach(id => {
            const btn = document.getElementById(id);
            if (btn) {
                btn.classList.remove('active-btn');
                btn.classList.add('inactive-btn');
            }
        });

        // Sembunyikan semua section
        sections.forEach(sec => {
            document.getElementById(sec)?.classList.add('hidden');
        });

        // Tampilkan section yang dipilih
        document.getElementById(section)?.classList.remove('hidden');

        // Tandai tombol aktif
        let activeBtn = '';
        if (section === 'projects') activeBtn = 'btnProjects';
        else if (section === 'sertificates') activeBtn = 'btnSertificate';
        else if (section === 'sharing') activeBtn = 'btnSharing';

        const btnActive = document.getElementById(activeBtn);
        if (btnActive) {
            btnActive.classList.remove('inactive-btn');
            btnActive.classList.add('active-btn');
        }
        // Trigger AOS refresh saat ganti tab agar animasi jalan di konten baru
        setTimeout(() => {
            AOS.refresh();
        }, 100);
    }

    // Tambahkan gaya awal supaya jelas perbedaan tombol aktif / tidak
    document.addEventListener('DOMContentLoaded', () => {
        const style = document.createElement('style');
        style.innerHTML = `
      .active-btn {
        background-color: #CCFF00; /* neon green */
        color: black;
      }
      .inactive-btn {
        background-color: #1f2937; /* bg-gray-800 */
        color: white;
      }
      .inactive-btn:hover {
        background-color: #374151; /* hover:bg-gray-700 */
      }
    `;
        document.head.appendChild(style);
    });
    function openPopup(type) {
        const popup = document.getElementById('popupOverlay');
        const content = document.getElementById('popupContent');

        if (type === 'sertifikat') {
            content.innerHTML = `
        <img src='ASSET/SERTIFIKAT/SERTIFIKAT_1.jpg' class='rounded-xl mx-auto w-[80%]'>
        `;
        } else if (type === 'detail1') {
            content.innerHTML = `
        <h2 class='text-2xl font-bold mb-3'>Hand Sanitizer Project</h2>
        <img src='ASSET/PROJECT/PROJECT_2.jpg' class='rounded-xl mb-4 mx-auto'>
        <p class='text-gray-300 text-sm leading-relaxed'>
            Proyek ini merupakan sistem otomatisasi dispenser hand sanitizer berbasis ESP32 dengan sensor infra merah.
        </p>
        `;
        } else if (type === 'detail2') {
            content.innerHTML = `
        <h2 class='text-2xl font-bold mb-3'>Mesin Pelet Project</h2>
        <img src='ASSET/PROJECT/PROJECT_1.jpg' class='rounded-xl mb-4 mx-auto'>
        <p class='text-gray-300 text-sm leading-relaxed'>
            Mesin pembuat pelet otomatis dengan sensor suhu dan tampilan LCD.
        </p>
        `;
        } else if (type === 'detail3') {
            content.innerHTML = `
        <h2 class='text-2xl font-bold mb-3'>Mograph Tips Sharing</h2>
        <img src='ASSET/PROJECT/PROJECT_3.jpg' class='rounded-xl mb-4 mx-auto'>
        <p class='text-gray-300 text-sm leading-relaxed'>
            Berbagi pengalaman dan tips dalam dunia motion graphic modern.
        </p>
        `;
        }

        popup.classList.remove('hidden');
        popup.classList.add('flex');
    }

    function closePopup() {
        document.getElementById('popupOverlay').classList.add('hidden');
    }
</script>
</html>