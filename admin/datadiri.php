<?php
// 1. MULAI SESSION
session_start();

// 2. "PENJAGA"
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: ../Login.php?status=ilegal");
    exit;
}

// 3. JIKA LOLOS, LANJUTKAN...
$admin_id = $_SESSION['user_id']; 
include '../koneksi.php';
$biodata_id = 1;

// ------------------------------------------------------------------
// [BAGIAN 1] LOGIKA UPDATE DATA
// ------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- A. UPDATE DATA TEKS ---
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $deskripsi_hero = $_POST['deskripsi_hero'];
   
    
    $sql_update = "UPDATE tb_biodata SET nama_lengkap = ?, email = ?, telepon = ?, deskripsi_hero = ? WHERE id = ?";
    $stmt = $koneksi->prepare($sql_update);
    $stmt->bind_param("ssssi", $nama_lengkap, $email, $telepon, $deskripsi_hero, $biodata_id);
    
    if (!$stmt->execute()) {
        header("Location: datadiri.php?status=error&msg=Gagal update data teks");
        exit;
    }
    $stmt->close();

    // --- B. UPDATE FOTO PROFIL ---
    if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == 0 && $_FILES['foto_profil']['size'] > 0) {
        $max_file_size = 2097152; // 2MB
        if ($_FILES['foto_profil']['size'] > $max_file_size) {
            header("Location: datadiri.php?status=error&msg=Ukuran foto terlalu besar"); exit;
        }
        
        $gambar_tipe = $_FILES['foto_profil']['type'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
        
        if (in_array($gambar_tipe, $allowed_types)) {
            $gambar_data = file_get_contents($_FILES['foto_profil']['tmp_name']);
            $sql_foto = "UPDATE tb_biodata SET foto_profil_data = ?, foto_profil_tipe = ? WHERE id = ?";
            $stmt_foto = $koneksi->prepare($sql_foto);
            $null = NULL;
            $stmt_foto->bind_param("bsi", $null, $gambar_tipe, $biodata_id);
            $stmt_foto->send_long_data(0, $gambar_data);
            $stmt_foto->execute();
            $stmt_foto->close();
        } else {
            header("Location: datadiri.php?status=error&msg=Format foto tidak didukung"); exit;
        }
    }
    
    // --- C. UPDATE FILE CV ---
    if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] == 0 && $_FILES['cv_file']['size'] > 0) {
        $cv_tipe = $_FILES['cv_file']['type'];
        if ($cv_tipe == 'application/pdf') {
            $cv_data = file_get_contents($_FILES['cv_file']['tmp_name']);
            $sql_cv = "UPDATE tb_biodata SET cv_file_data = ?, cv_file_tipe = ? WHERE id = ?";
            $stmt_cv = $koneksi->prepare($sql_cv);
            $null = NULL;
            $stmt_cv->bind_param("bsi", $null, $cv_tipe, $biodata_id);
            $stmt_cv->send_long_data(0, $cv_data);
            $stmt_cv->execute();
            $stmt_cv->close();
        } else {
             header("Location: datadiri.php?status=error&msg=Format CV harus PDF"); exit;
        }
    }

    // Jika semua berhasil
    header("Location: datadiri.php?status=sukses");
    exit;
}

// ------------------------------------------------------------------
// [BAGIAN 2] LOGIKA AMBIL DATA
// ------------------------------------------------------------------
$sql_select = "SELECT * FROM tb_biodata WHERE id = ?";
$stmt_select = $koneksi->prepare($sql_select);
$stmt_select->bind_param("i", $biodata_id);
$stmt_select->execute();
$result = $stmt_select->get_result();
$biodata = $result->fetch_assoc();

if (!$biodata) {
    $koneksi->query("INSERT INTO tb_biodata (id, nama_lengkap) VALUES (1, 'Masukkan Nama Anda')");
    $result = $koneksi->query("SELECT * FROM tb_biodata WHERE id = 1");
    $biodata = $result->fetch_assoc();
}
$stmt_select->close();
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="../ASSET/LOGO/DW_FIX.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Data Diri - Daniel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        body.fixed-layout { height: 100vh; overflow: hidden; }
        .overflow-y-auto { scrollbar-width: thin; scrollbar-color: #4B5563 #111827; }
        .overflow-y-auto::-webkit-scrollbar { width: 8px; }
        .overflow-y-auto::-webkit-scrollbar-track { background: #111827; }
        .overflow-y-auto::-webkit-scrollbar-thumb { background-color: #4B5563; border-radius: 20px; border: 3px solid #111827; }
    </style>
</head>

<body class="bg-white text-white fixed-layout"> 
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
                <a href="datadiri.php" class="text-lime-400 font-semibold text-lg block cursor-pointer">Data Diri</a>
                <a href="project.php" class="text-gray-400 hover:text-white transition block cursor-pointer">Projects</a>
                <a href="sertifikat.php" class="text-gray-400 hover:text-white transition block cursor-pointer">Certificates</a>
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
                        <h2 class="text-5xl font-bold text-lime-400 mb-2">Data Diri</h2>
                        <p class="text-gray-400">Perbarui data yang akan tampil di halaman utama dan biodata.</p>
                    </div>

                    <form action="datadiri.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="nama_lengkap" class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" required
                                       value="<?php echo htmlspecialchars($biodata['nama_lengkap'] ?? ''); ?>"
                                       class="w-full bg-gray-900 text-white text-sm border border-gray-700 p-3 h-12 rounded-xl focus:outline-none focus:border-lime-400 placeholder-gray-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                                <input type="email" name="email" id="email" required
                                       value="<?php echo htmlspecialchars($biodata['email'] ?? ''); ?>"
                                       class="w-full bg-gray-900 text-white text-sm border border-gray-700 p-3 h-12 rounded-xl focus:outline-none focus:border-lime-400 placeholder-gray-500">
                            </div>
                            <div>
                                <label for="telepon" class="block text-sm font-medium text-gray-300 mb-2">Telepon</label>
                                <input type="text" name="telepon" id="telepon"
                                       value="<?php echo htmlspecialchars($biodata['telepon'] ?? ''); ?>"
                                       class="w-full bg-gray-900 text-white text-sm border border-gray-700 p-3 h-12 rounded-xl focus:outline-none focus:border-lime-400 placeholder-gray-500">
                            </div>
                        </div>

                        <div>
                            <label for="deskripsi_hero" class="block text-sm font-medium text-gray-300 mb-2">Deskripsi Hero (di Halaman Biodata)</label>
                            <textarea name="deskripsi_hero" id="deskripsi_hero" rows="3" placeholder="My name is Daniel, I'm..."
                                      class="w-full bg-gray-900 text-white text-sm border border-gray-700 p-4 rounded-xl focus:outline-none focus:border-lime-400 placeholder-gray-500 resize-none"><?php echo htmlspecialchars($biodata['deskripsi_hero'] ?? ''); ?></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-700">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Foto Profil (Pas Foto)</label>
                                <?php if (!empty($biodata['foto_profil_data'])) { ?>
                                    <img src="data:<?php echo $biodata['foto_profil_tipe']; ?>;base64,<?php echo base64_encode($biodata['foto_profil_data']); ?>" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover mb-3 border-2 border-lime-400">
                                <?php } ?>
                                <label for="foto_profil" class="block bg-gray-900 text-gray-400 text-sm h-12 border border-gray-700 p-3 rounded-xl text-center cursor-pointer hover:bg-gray-800 transition">
                                    <span id="foto-name-display">Ganti Foto Profil (JPG, PNG, WEBP)</span>
                                    <input type="file" id="foto_profil" name="foto_profil" accept=".jpg, .jpeg, .png, .webp" class="hidden">
                                </label>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">File CV (PDF)</label>
                                <?php if (!empty($biodata['cv_file_data'])) { ?>
                                    <div class="mb-3 text-sm text-lime-400">CV saat ini: <strong>File PDF tersimpan.</strong></div>
                                <?php } ?>
                                <label for="cv_file" class="block bg-gray-900 text-gray-400 text-sm h-12 border border-gray-700 p-3 rounded-xl text-center cursor-pointer hover:bg-gray-800 transition">
                                    <span id="cv-name-display">Ganti File CV (Hanya PDF)</span>
                                    <input type="file" id="cv_file" name="cv_file" accept=".pdf" class="hidden">
                                </label>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-700">
                            <button type="submit"
                                class="w-full py-4 bg-lime-400 text-black font-bold text-sm rounded-xl 
                                       hover:bg-lime-500 transition shadow-lg shadow-lime-400/30">
                                Simpan Perubahan Data Diri
                            </button>
                        </div>

                    </form>
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
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <?php else: ?>
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <?php endif; ?>
            </div>
            
            <div class="ml-3 text-sm font-normal">
                <?php 
                    if ($_GET['status'] == 'sukses') echo "Data berhasil diperbarui!";
                    else echo htmlspecialchars($_GET['msg'] ?? 'Terjadi kesalahan.');
                ?>
            </div>
            
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-transparent text-white rounded-lg p-1.5 hover:bg-white hover:text-gray-900 inline-flex h-8 w-8" onclick="closeToast()">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    <?php endif; ?>

    <script>
        // --- SCRIPT UPLOAD FILE ---
        document.getElementById('foto_profil').onchange = function() {
            var fileName = this.files[0] ? this.files[0].name : 'Ganti Foto Profil (JPG, PNG, WEBP)';
            document.getElementById('foto-name-display').textContent = fileName;
        };
        document.getElementById('cv_file').onchange = function() {
            var fileName = this.files[0] ? this.files[0].name : 'Ganti File CV (Hanya PDF)';
            document.getElementById('cv-name-display').textContent = fileName;
        };

        // --- SCRIPT TOAST NOTIFICATION ---
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