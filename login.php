<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel - Tailwind</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menggunakan kode warna khusus #CCFF00 */
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

        /* Utility Tambahan untuk efek hover tombol */
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
            <img src="ASSET\LOGO\DW_FIX.png" alt="Logo DW Fix" class="max-h-full max-w-full object-contain">
        </div>

        <h2 class="text-2xl font-bold text-neon-green py-2 px-4  mb-8 text-center">
            Admin Login Panel
        </h2>

        <form id="loginForm" class="text-white">
            <div class="mb-5 text-left">
                <label for="username" class="block mb-2 font-semibold text-gray-300 text-sm">Username</label>
                <input type="text" id="username" name="username" placeholder="Admin" required
                    class="w-full p-3 bg-gray-900 border border-neon-green text-white rounded-md 
                              focus:outline-none focus:ring-2 focus:ring-white focus:border-white transition">
            </div>

            <div class="mb-6 text-left">
                <label for="password" class="block mb-2 font-semibold text-gray-300 text-sm">Password</label>
                <input type="password" id="password" name="password" placeholder="**********" required
                    class="w-full p-3 bg-gray-900 border border-neon-green text-white rounded-md 
                              focus:outline-none focus:ring-2 focus:ring-white focus:border-white transition">
            </div>

            <a href="/admin/datadiri.php" id="loginLink"
                class="btn-masuk w-full p-4 neon-green rounded-md text-lg font-bold cursor-pointer 
          btn-hover btn-active transition-all duration-100 ease-linear inline-block text-center">
                Masuk
            </a>
        </form>

        <a href="index.php" class="block mt-4 text-sm text-gray-400 hover:text-neon-green transition-colors">
            ← Kembali ke Menu Utama
        </a>

        <p class="mt-6 text-xs text-gray-600">
            © Copyright 2025 DanielWirks
        </p>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const button = document.getElementById('loginButton');

            // --- Efek Interaktif (JS) ---
            const originalText = 'Masuk';

            // Nonaktifkan tombol dan ubah tampilan
            button.innerText = 'Memproses...';
            button.classList.remove('neon-green', 'btn-hover');
            button.classList.add('bg-gray-700', 'cursor-not-allowed');
            button.disabled = true;

            // Simulasi proses login
            setTimeout(() => {
                // Setelah selesai, kembalikan tampilan tombol
                button.disabled = false;
                button.innerText = originalText;
                button.classList.remove('bg-gray-700', 'cursor-not-allowed');
                button.classList.add('neon-green', 'btn-hover');

                // Tampilkan pesan sederhana
                if (username === 'Admin' && password === '******') {
                    alert('Login Berhasil! Selamat datang, Admin.');
                    // Di sini seharusnya navigasi ke halaman dashboard
                } else {
                    alert('Login Gagal. Username atau Password salah!');
                }
            }, 1500);
        });
    </script>
</body>

</html>