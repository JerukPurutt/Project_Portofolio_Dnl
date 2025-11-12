<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daniel's Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
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

<body class="dark-bg text-white">
    <!-- Navigation -->
    <nav class="bg-black border-b border-gray-800 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">FR1 INDEX - PROJECTS</h1>
            <div class="flex gap-6 text-sm">
                <a href="#" class="hover:text-yellow-400 transition">Home</a>
                <a href="#" class="hover:text-yellow-400 transition">About</a>
                <a href="biodata.php" class="hover:text-yellow-400 transition">Pendidikan</a>
                <a href="#" class="hover:text-yellow-400 transition">Contact</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Hero Section -->
        <div class="neon-green rounded-3xl p-8 mb-8 flex items-center justify-between">
            <!-- Teks Kiri -->
            <div class="text-black max-w-xl">
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

            <!-- Gambar Kanan -->
            <div class="flex-shrink-0">
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
    <div class="card-dark rounded-3xl p-8 mb-8 flex gap-8 items-start">
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
        <div class="card-dark rounded-2xl p-6 border border-yellow-400">
            <h5 class="text-yellow-400 font-semibold mb-2">Projects</h5>
            <p class="text-gray-400 text-sm mb-4">Things I have done</p>
            <p class="text-5xl font-bold">5</p>
        </div>
        <div class="card-dark rounded-2xl p-6 border border-yellow-400">
            <h5 class="text-yellow-400 font-semibold mb-2">Certificates</h5>
            <p class="text-gray-400 text-sm mb-4">Achievement things</p>
            <p class="text-5xl font-bold">5</p>
        </div>
        <div class="card-dark rounded-2xl p-6 border border-yellow-400">
            <h5 class="text-yellow-400 font-semibold mb-2">Experiences</h5>
            <p class="text-gray-400 text-sm mb-4">Professional journey</p>
            <p class="text-5xl font-bold">5</p>
        </div>
    </div>

    <!-- Portfolio Showcase -->
    <div class="mb-8">
        <section class="py-10 bg-[#0b0b0b] text-white">
            <h3 class="text-4xl font-bold text-center mb-6">Portofolio Showcase</h3>
            <!-- Filter Buttons -->
            <div class="flex justify-center gap-4 mb-8">
                <button onclick="showSection('projects')" id="btnProjects"
                    class="neon-green text-black px-6 py-2 rounded-full text-sm font-semibold">
                    Projects
                </button>
                <button onclick="showSection('sertificates')" id="btnSertificate"
                    class="bg-gray-800 text-white px-6 py-2 rounded-full text-sm font-semibold hover:bg-gray-700 transition">
                    Sertificate
                </button>
                <button onclick="showSection('sharing')" id="btnSharing"
                    class="bg-gray-800 text-white px-6 py-2 rounded-full text-sm font-semibold hover:bg-gray-700 transition">
                    Sharing Experiences
                </button>
            </div>

            <!-- Projects Section -->
            <div id="projects" class="grid grid-cols-3 gap-6">
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Hand Sanitizer</h4>
                        <p class="text-gray-400 text-xs mb-4">Automatic Hand Sanitizer Dispenser with ESP32</p>
                        <img src="ASSET/PROJECT/PROJECT_1.jpg" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 22 Oct 2024</span>
                            <button onclick="openPopup('detail1')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Mesin Pelet</h4>
                        <p class="text-gray-400 text-xs mb-4">Mesin pembuat pelet otomatis dengan kontrol suhu</p>
                        <img src="ASSET/PROJECT/PROJECT_2.jpg" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 24 Oct 2024</span>
                            <button onclick="openPopup('detail2')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Hand Sanitizer</h4>
                        <p class="text-gray-400 text-xs mb-4">Automatic Hand Sanitizer Dispenser with ESP32</p>
                        <img src="ASSET/PROJECT/PROJECT_3.jpg" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 22 Oct 2024</span>
                            <button onclick="openPopup('detail1')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Mesin Pelet</h4>
                        <p class="text-gray-400 text-xs mb-4">Mesin pembuat pelet otomatis dengan kontrol suhu</p>
                        <img src="ASSET/PROJECT/PROJECT_4.jpg" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 24 Oct 2024</span>
                            <button onclick="openPopup('detail2')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Mesin Pelet</h4>
                        <p class="text-gray-400 text-xs mb-4">Mesin pembuat pelet otomatis dengan kontrol suhu</p>
                        <img src="ASSET/PROJECT/PROJECT_5.png" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 24 Oct 2024</span>
                            <button onclick="openPopup('detail2')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sharing Section -->
            <div id="sharing" class="grid grid-cols-3 gap-6 hidden">
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Mograph Tips</h4>
                        <p class="text-gray-400 text-xs mb-4">Membahas teknik motion graphic profesional</p>
                        <img src="ASSET/SHARING/SHARING_1.webp" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 10 Nov 2024</span>
                            <button onclick="openPopup('detail3')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Mograph Tips</h4>
                        <p class="text-gray-400 text-xs mb-4">Membahas teknik motion graphic profesional</p>
                        <img src="ASSET/SHARING/SHARING_2.jpg" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 10 Nov 2024</span>
                            <button onclick="openPopup('detail3')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Mograph Tips</h4>
                        <p class="text-gray-400 text-xs mb-4">Membahas teknik motion graphic profesional</p>
                        <img src="ASSET/SHARING/SHARING_3.webp" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 10 Nov 2024</span>
                            <button onclick="openPopup('detail3')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Mograph Tips</h4>
                        <p class="text-gray-400 text-xs mb-4">Membahas teknik motion graphic profesional</p>
                        <img src="ASSET/SHARING/SHARING_4.png" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 10 Nov 2024</span>
                            <button onclick="openPopup('detail3')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Mograph Tips</h4>
                        <p class="text-gray-400 text-xs mb-4">Membahas teknik motion graphic profesional</p>
                        <img src="ASSET/SHARING/SHARING_5.png" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 10 Nov 2024</span>
                            <button onclick="openPopup('detail3')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sertificate Section -->
            <div id="sertificates" class="grid grid-cols-3 gap-6">
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Sertif</h4>
                        <p class="text-gray-400 text-xs mb-4">Mesin pembuat pelet otomatis dengan kontrol suhu</p>
                        <img src="ASSET/SERTIF/SERTIF.jpg" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 24 Oct 2024</span>
                            <button onclick="openPopup('detail2')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Mesin Pelet</h4>
                        <p class="text-gray-400 text-xs mb-4">Mesin pembuat pelet otomatis dengan kontrol suhu</p>
                        <img src="ASSET/SERTIF/SERTIF_2.jpg" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 24 Oct 2024</span>
                            <button onclick="openPopup('detail2')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Mesin Pelet</h4>
                        <p class="text-gray-400 text-xs mb-4">Mesin pembuat pelet otomatis dengan kontrol suhu</p>
                        <img src="ASSET/SERTIF/SERTIF_3.jpg" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 24 Oct 2024</span>
                            <button onclick="openPopup('detail2')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Mesin Pelet</h4>
                        <p class="text-gray-400 text-xs mb-4">Mesin pembuat pelet otomatis dengan kontrol suhu</p>
                        <img src="ASSET/SERTIF/SERTIF_4.jpg" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 24 Oct 2024</span>
                            <button onclick="openPopup('detail2')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
                <div class="card-dark rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2">Mesin Pelet</h4>
                        <p class="text-gray-400 text-xs mb-4">Mesin pembuat pelet otomatis dengan kontrol suhu</p>
                        <img src="ASSET/SERTIF/SERTIF_5.jpg" class="rounded-lg mb-4 w-full h-[256px] object-cover">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Published: 24 Oct 2024</span>
                            <button onclick="openPopup('detail2')" class="neon-green text-black px-4 py-1 rounded-full text-xs font-semibold">View Detail</button>
                        </div>
                    </div>
                </div>
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
        <div class="grid grid-cols-2 gap-6 mb-8">
            <!-- Let's Connect -->
            <div class="card-dark rounded-2xl p-8">
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
                        <a href="#" class="flex items-center gap-2 text-gray-400 hover:text-white transition">
                            <span>📧</span> Email
                        </a>
                        <a href="#" class="flex items-center gap-2 text-gray-400 hover:text-white transition">
                            <span>📸</span> Instagram
                        </a>
                        <a href="#" class="flex items-center gap-2 text-gray-400 hover:text-white transition">
                            <span>💼</span> LinkedIn
                        </a>
                    </div>
                </div>
            </div>

            <!-- Write a Comment -->
            <div class="card-dark rounded-2xl p-8">
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
    <footer class="bg-black border-t border-gray-800 px-6 py-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-sm text-gray-400">
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition">Home</a>
                <a href="#" class="hover:text-white transition">About</a>
                <a href="login.php" class="hover:text-white transition">Admin</a>
                <a href="#" class="hover:text-white transition">Tupen</a>
            </div>
            <p>Designed and built with ❤️ FR1</p>
        </div>
    </footer>
</body>
<script>
    function filterProjects(category) {
        const projects = document.querySelectorAll('.project-item');
        const buttons = ['btnAll', 'btnUIUX', 'btnMobile'];

        // Reset button styles
        buttons.forEach(id => {
            document.getElementById(id).classList.remove('neon-green', 'text-black');
            document.getElementById(id).classList.add('bg-gray-800', 'text-white');
        });

        // Highlight active button
        if (category === 'all') {
            document.getElementById('btnAll').classList.add('neon-green', 'text-black');
            document.getElementById('btnAll').classList.remove('bg-gray-800', 'text-white');
        } else if (category === 'uiux') {
            document.getElementById('btnUIUX').classList.add('neon-green', 'text-black');
            document.getElementById('btnUIUX').classList.remove('bg-gray-800', 'text-white');
        } else if (category === 'mobile') {
            document.getElementById('btnMobile').classList.add('neon-green', 'text-black');
            document.getElementById('btnMobile').classList.remove('bg-gray-800', 'text-white');
        }

        // Show/Hide projects
        projects.forEach(project => {
            if (category === 'all' || project.dataset.category === category) {
                project.style.display = 'block';
            } else {
                project.style.display = 'none';
            }
        });
    }

    function showSection(section) {
        document.getElementById('projects').classList.add('hidden');
        document.getElementById('sharing').classList.add('hidden');
        document.getElementById('sertificates').classList.add('hidden');
        document.getElementById(section).classList.remove('hidden');
    }

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