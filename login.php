<?php
// 1. MULAI SESSION
session_start();
include 'koneksi.php';

$error_message = '';

// 2. CEK JIKA ADA SUBMIT FORM
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password_form = $_POST['password']; // Password dari form (Teks Biasa)

    // 3. AMBIL DATA DARI tb_users
    $sql = "SELECT * FROM tb_users WHERE username = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // 4. VERIFIKASI PASSWORD (TEKS BIASA)
        // Karena password Anda 'admin123', kita cek langsung
        if ($password_form == $user['password']) {

            // --- LOGIN BERHASIL ---

            // Simpan info login ke session
            $_SESSION['is_logged_in'] = true;
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];

            // 5. ARAHKAN KE HALAMAN ADMIN
            header("Location: admin/datadiri.php");
            exit;
        } else {
            // --- LOGIN GAGAL (Password salah) ---
            $error_message = "Password yang Anda masukkan salah.";
        }
    } else {
        // --- LOGIN GAGAL (Username tidak ditemukan) ---
        $error_message = "Username tidak ditemukan.";
    }

    $stmt->close();
    $koneksi->close();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="ASSET/LOGO/DW_FIX.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel - Tailwind</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* (CSS Anda biarkan sama) */
        .neon-green {
            background-color: #CCFF00;
            color: #000;
        }

        .text-neon-green {
            color: #CCFF00;
        }

        .border-neon-green {
            border-color: #CCFF00;
        }

        .shadow-neon-glow {
            box-shadow: 0 0 25px rgba(204, 255, 0, 0.4), 0 8px 15px rgba(0, 0, 0, 0.6);
        }

        .btn-hover:hover {
            background-color: #DDFF33;
        }

        .btn-active:active {
            transform: translateY(2px);
        }
    </style>
</head>

<body class="bg-white flex justify-center items-center min-h-screen">
    <div id="loginCard"
        class="bg-black border-2 border-neon-green p-10 rounded-xl shadow-neon-glow w-[1000px] max-w-xl text-center 
               transition-all duration-300 hover:shadow-2xl hover:translate-y-[-5px]">

        <div class="flex justify-center items-center h-[100px] mb-4">
            <img src="ASSET/LOGO/DW_FIX.png" alt="Logo DW Fix" class="max-h-full max-w-full object-contain">
        </div>

        <h2 class="text-2xl font-bold text-neon-green py-2 px-4 mb-8 text-center">
            Admin Login Panel
        </h2>

        <form method="POST" action="Login.php" class="text-white">

            <?php if (!empty($error_message)): ?>
                <div class="mb-4 p-3 bg-red-900 border border-red-500 text-red-200 text-sm rounded-md text-left">
                    <strong>Login Gagal:</strong> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <div class="mb-5 text-left">
                <label for="username" class="block mb-2 font-semibold text-gray-300 text-sm">Username</label>
                <input type="text" id="username" name="username" placeholder="Admin" required
                    class="w-full p-3 bg-gray-900 border border-neon-green text-white rounded-md 
                           focus:outline-none focus:ring-2 focus:ring-white focus:border-white transition">
            </div>

            <div class="mb-6 text-left">
                <label for="password" class="block mb-2 font-semibold text-gray-300 text-sm">Password</label>

                <div class="relative">

                    <input type="password" id="password" name="password" placeholder="**********" required
                        class="w-full p-3 pr-12 bg-gray-900 border border-neon-green text-white rounded-md 
                      focus:outline-none focus:ring-2 focus:ring-white focus:border-white transition">

                    <button type="button"
                        onclick="togglePasswordVisibility()"
                        class="absolute inset-y-0 right-0 flex items-center justify-center h-full w-12 text-gray-400 hover:text-white">

                        <svg id="eye-icon" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.01 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.01-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        <svg id="eye-slash-icon" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit"
                class="btn-masuk w-full p-4 neon-green rounded-md text-lg font-bold cursor-pointer 
                       btn-hover btn-active transition-all duration-100 ease-linear inline-block text-center">
                Masuk
            </button>
        </form>

        <a href="index.php" class="block mt-4 text-sm text-gray-400 hover:text-neon-green transition-colors">
            ← Kembali ke Menu Utama
        </a>

        <p class="mt-6 text-xs text-gray-600">
            © Copyright 2025 DanielWirks
        </p>
    </div>
</body>
<script>
    function togglePasswordVisibility() {
        // 1. Temukan elemen input password
        var passwordInput = document.getElementById("password");

        // 2. Ubah tipenya berdasarkan apakah checkbox dicentang
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>

</html>