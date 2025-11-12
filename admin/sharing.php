<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Data Diri - Daniel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        /* * 1. Tambahkan kelas 'h-screen overflow-hidden' pada body
         * untuk mengatur tinggi penuh layar dan mencegah scroll global.
         */
        body.fixed-layout {
            height: 100vh;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-white text-white fixed-layout">
    <div class="flex h-full"> <div class="w-72 bg-black border-r border-gray-800 p-8 flex flex-col h-full">
            <div class="mb-12">
                <div class="flex-shrink-0 w-24 h-24 bg-black rounded-lg overflow-hidden">
                    <img src="../ASSET/LOGO/DW_FIX.png" alt="Screenshot Proyek" class="w-full h-full object-cover">
                </div>
                <h1 class="text-3xl font-bold text-lime-400 mt-8">Daniel</h1>
                <div class="w-full h-px bg-lime-400 mt-2"></div>
            </div>
            <nav class="flex-1 space-y-4">
                <a href="datadiri.php"
                    class="text-gray-400 hover:text-white transition block cursor-pointer">
                    Data Diri
                </a>

                <a href="project.php"
                    class="text-gray-400 hover:text-white transition block cursor-pointer">
                    Projects
                </a>

                <a href="sertifikat.php"
                    class="text-gray-400 hover:text-white transition block cursor-pointer">
                    Certificates
                </a>

                <a href="sharing.php"
                    class="text-lime-400 font-semibold text-lg block cursor-pointer">
                    Sharing
                </a>
            </nav>

            <div class="mt-auto">
                <button class="text-red-500 hover:text-red-400 transition font-semibold">Logout</button>
                <p class="text-gray-600 text-xs mt-8">© Copyright 2025 DanielWrks</p>
            </div>
        </div>
        
        <div class="flex-1 h-full overflow-y-auto p-12">
            <div class="max-w-5xl">
                <div class="bg-black rounded-3xl p-12">
                    <div class="mb-8">
                        <h2 class="text-5xl font-bold text-lime-400 mb-2">Sharing</h2>
                        <p class="text-gray-400">Share semua pengalaman hasil belajar</p>
                    </div>
                    
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="mb-6">
                            <label for="sharing_file"
                                class="block bg-gray-900 text-gray-400 text-sm h-12 border border-gray-700 p-4 rounded-xl 
                                            text-center cursor-pointer hover:bg-gray-800 transition">
                                Pilih file - Tidak ada file yang dipilih
                                <input type="file" id="sharing_file" name="sharing_file" accept=".pdf, .jpg, .png" class="hidden">
                            </label>
                        </div>
                        <div class="mb-6">
                            <input type="text" id="sharing_title" name="sharing_title"
                                placeholder="Judul experience"
                                class="w-full bg-gray-900 text-white text-sm h-12 border border-gray-700 p-4 rounded-xl 
                                            focus:outline-none focus:border-lime-400 placeholder-gray-500">
                        </div>
                        <div class="mb-6">
                            <input type="url" id="sharing_link" name="sharing_link"
                                placeholder="Link (Optional)"
                                class="w-full bg-gray-900 text-white text-sm h-12 border border-gray-700 p-4 rounded-xl 
                                            focus:outline-none focus:border-lime-400 placeholder-gray-500">
                        </div>
                        <div class="mb-8">
                            <textarea id="sharing_description" name="sharing_description" rows="5"
                                placeholder="Deskripsi......"
                                class="w-full bg-gray-900 text-white border border-gray-700 p-4 rounded-xl 
                                             focus:outline-none focus:border-lime-400 placeholder-gray-500 resize-none">
                            </textarea>
                        </div>
                        <button type="submit"
                            class="w-full py-4 bg-lime-400 text-black text-sm h-12 font-bold rounded-xl 
                                           hover:bg-lime-500 transition shadow-lg shadow-lime-400/30">
                            Share Experience!
                        </button>
                    </form>
                    
                    <div class="mt-12 pt-8 border-t border-gray-700">
                        <h3 class="text-3xl font-bold text-white mb-6">List Sharing Pengalaman</h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead>
                                    <tr class="text-gray-400 uppercase text-xs leading-normal">
                                        <th class="py-3 px-6 text-left">File</th>
                                        <th class="py-3 px-6 text-left">Judul</th>
                                        <th class="py-3 px-6 text-left">Link</th>
                                        <th class="py-3 px-left">Deskripsi Singkat</th>
                                        <th class="py-3 px-6 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-white text-sm font-light divide-y divide-gray-800">

                                    <tr class="hover:bg-gray-900 transition">
                                        <td class="flex-shrink-0 w-20 h-20 bg-gray-700 rounded-lg overflow-hidden border border-gray-600">
                                            <img src="../ASSET/PROJECT/PROJECT_3.jpg" alt="Screenshot Proyek" class="w-full h-full object-cover">
                                        </td>
                                        <td class="py-4 px-6 font-medium text-lime-400">
                                            Pengalaman Magang di Startup X
                                        </td>
                                        <td class="py-4 px-6">
                                            <a href="#" class="text-blue-400 hover:underline">Lihat Proyek</a>
                                        </td>
                                        <td class="py-4 text-gray-400 max-w-xs text-xs">
                                            Ringkasan 3 bulan pengalaman sebagai Backend Developer, fokus pada optimasi database dan API.
                                        </td>
                                        <td class="py-4 px-6 text-center whitespace-nowrap">
                                            <div class="flex item-center justify-center space-x-2 text-xs">
                                                <button class="text-blue-400 hover:text-blue-500 font-bold transition">Edit</button>
                                                <span class="text-gray-600">|</span>
                                                <button class="text-red-400 hover:text-red-500 font-bold transition">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>