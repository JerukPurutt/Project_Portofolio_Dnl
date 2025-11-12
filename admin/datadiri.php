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
    </style>
</head>

<body class="bg-white text-white">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-72 bg-black border-r border-gray-800 p-8 flex flex-col">
            <div class="mb-12">
                <div class="flex-shrink-0 w-24 h-24 bg-black rounded-lg overflow-hidden">
                    <img src="../ASSET/LOGO/DW_FIX.png" alt="Screenshot Proyek" class="w-full h-full object-cover">
                </div>
                <h1 class="text-3xl font-bold text-lime-400 mt-8">Daniel</h1>
                <div class="w-full h-px bg-lime-400 mt-2"></div>
            </div>
            <nav class="flex-1 space-y-4">
                <a href="datadiri.php"
                    class="text-lime-400 font-semibold text-lg block cursor-pointer">
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
                    class="text-gray-400 hover:text-white transition block cursor-pointer">
                    Sharing
                </a>
            </nav>

            <div class="mt-auto">
                <button class="text-red-500 hover:text-red-400 transition font-semibold">Logout</button>
                <p class="text-gray-600 text-xs mt-8">© Copyright 2025 DanielWrks</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-12">
            <div class="max-w-5xl">
                <div class="bg-black rounded-3xl p-12">
                    <div class="mb-8">
                        <h2 class="text-5xl font-bold text-lime-400 mb-2">Data Diri</h2>
                        <p class="text-gray-400">Lengkapi Biodatamu, agar orang jadi lebih mengenal dirimu!</p>
                    </div>

                    <div class="bg-white rounded-xl overflow-hidden">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-lime-400">
                                    <th class="text-left px-6 py-4 text-black font-bold">Field</th>
                                    <th class="text-left px-6 py-4 text-black font-bold">Isi</th>
                                    <th class="text-left px-6 py-4 text-black font-bold">Action</th>
                                </tr>
                            </thead>
                            <tbody id="dataTable">
                                <tr class="border-b border-gray-200">
                                    <td class="px-6 py-4 text-black font-medium">Nama</td>
                                    <td class="px-6 py-4 text-black" id="nama-value">M. Daniel Ramadhani</td>
                                    <td class="px-6 py-4">
                                        <button onclick="showEditModal('nama')" class="text-blue-600 hover:text-blue-800 mr-4 font-semibold">Edit</button>
                                        <button onclick="showDeleteModal('nama')" class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-200">
                                    <td class="px-6 py-4 text-black font-medium">Email</td>
                                    <td class="px-6 py-4 text-black" id="email-value">danielrama1710@gmail.com</td>
                                    <td class="px-6 py-4">
                                        <button onclick="showEditModal('email')" class="text-blue-600 hover:text-blue-800 mr-4 font-semibold">Edit</button>
                                        <button onclick="showDeleteModal('email')" class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-black font-medium">Telepon</td>
                                    <td class="px-6 py-4 text-black" id="telepon-value">085232741259</td>
                                    <td class="px-6 py-4">
                                        <button onclick="showEditModal('telepon')" class="text-blue-600 hover:text-blue-800 mr-4 font-semibold">Edit</button>
                                        <button onclick="showDeleteModal('telepon')" class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-black">Edit <span id="editFieldLabel"></span></h3>
                <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <p class="text-gray-600 mb-6">
                Apakah Anda yakin ingin mengedit data <span id="editFieldText"></span>?
            </p>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <span id="editInputLabel"></span> Baru
                </label>
                <input
                    type="text"
                    id="editInput"
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-lime-400 focus:outline-none text-black"
                    placeholder="Masukkan data baru" />
            </div>

            <div class="flex gap-3">
                <button
                    onclick="closeEditModal()"
                    class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Batal
                </button>
                <button
                    onclick="confirmEdit()"
                    class="flex-1 px-6 py-3 bg-lime-400 text-black rounded-lg font-semibold hover:bg-lime-500 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-black">Hapus <span id="deleteFieldLabel"></span></h3>
                <button onclick="closeDeleteModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <p class="text-red-800 font-semibold">Peringatan!</p>
                <p class="text-red-700 text-sm mt-1">Data yang dihapus tidak dapat dikembalikan.</p>
            </div>

            <p class="text-gray-600 mb-6">
                Apakah Anda yakin ingin menghapus data <span id="deleteFieldText"></span>?
                Data akan dikosongkan dari sistem.
            </p>

            <div class="flex gap-3">
                <button
                    onclick="closeDeleteModal()"
                    class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Batal
                </button>
                <button
                    onclick="confirmDelete()"
                    class="flex-1 px-6 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentField = '';

        const fieldLabels = {
            'nama': 'Nama',
            'email': 'Email',
            'telepon': 'Telepon'
        };

        function showEditModal(field) {
            currentField = field;
            const modal = document.getElementById('editModal');
            const currentValue = document.getElementById(field + '-value').textContent;

            document.getElementById('editFieldLabel').textContent = fieldLabels[field];
            document.getElementById('editFieldText').textContent = fieldLabels[field].toLowerCase();
            document.getElementById('editInputLabel').textContent = fieldLabels[field];
            document.getElementById('editInput').value = currentValue;

            modal.classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            currentField = '';
        }

        function confirmEdit() {
            const newValue = document.getElementById('editInput').value.trim();

            if (newValue) {
                document.getElementById(currentField + '-value').textContent = newValue;
                closeEditModal();
            } else {
                alert('Data tidak boleh kosong!');
            }
        }

        function showDeleteModal(field) {
            currentField = field;
            const modal = document.getElementById('deleteModal');

            document.getElementById('deleteFieldLabel').textContent = fieldLabels[field];
            document.getElementById('deleteFieldText').textContent = fieldLabels[field].toLowerCase();

            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            currentField = '';
        }

        function confirmDelete() {
            document.getElementById(currentField + '-value').textContent = '';
            closeDeleteModal();
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
                closeDeleteModal();
            }
        });
    </script>
</body>

</html>