<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jajan Bareng</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body class="bg-white font-sans">
    <!-- Navbar -->
    <nav class="bg-blue-100 py-4 sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-4 lg:px-8 flex flex-col md:flex-row items-center justify-between">
            <!-- Left side - Logo and tagline -->
            <div class="flex flex-col md:flex-row md:items-center mb-4 md:mb-0">
                <!-- Brand and tagline -->
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 text-center md:text-left tracking-tight">JAJAN BARENG</h1>
                    <p class="text-sm text-gray-700 text-center md:text-left">Mau mamam apa hari ini?</p>
                </div>
            </div>

            <!-- Right side - Auth buttons -->
            <div class="flex space-x-4">
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-full transition duration-300 shadow-md">
                    MASUK
                </a>
                <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-blue-800 font-medium py-2 px-6 rounded-full border border-blue-800 transition duration-300 shadow-md">
                    DAFTAR
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Welcome Section (100vh) -->
    <section class="min-h-screen flex items-center justify-center py-12 md:py-0 bg-gradient-to-b from-white to-blue-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Left: Welcome Text -->
                <div class="w-full md:w-1/2 mb-12 md:mb-0 text-center md:text-left">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                        SELAMAT DATANG DI<br>JAJAN BARENG
                    </h2>
                    <p class="text-lg md:text-xl text-gray-700 mb-8 leading-relaxed">
                        Bantu sekbid, Bantu events,<br>Danus tanpa ribet
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center md:justify-start">
                        <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-8 rounded-full transition duration-300 text-lg shadow-lg transform hover:scale-105">
                            Mulai Sekarang
                        </a>
                        <a href="#features" class="bg-transparent text-blue-600 border border-blue-500 hover:bg-blue-50 font-medium py-3 px-8 rounded-full transition duration-300 text-lg">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <!-- Right: Bear Mascot -->
                <div class="w-full md:w-1/2 flex justify-center md:justify-end">
                    <img src="{{ asset('logo.png') }}" alt="Jajan Bareng Mascot" class="w-64 md:w-80 lg:w-96 h-auto animate-bounce-slow transform hover:scale-105 transition duration-500">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Kenapa Memilih Jajan Bareng?</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">Platform yang memudahkan fundraising dan distribusi makanan untuk kegiatan sekolah dan kampus</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-blue-50 rounded-xl p-8 shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white text-2xl mb-6 mx-auto">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 text-center">Danus Mudah</h3>
                    <p class="text-gray-700 text-center">Kumpulkan dana untuk acara dan kegiatan kampus dengan cara yang lebih efisien dan tanpa ribet.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-blue-50 rounded-xl p-8 shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white text-2xl mb-6 mx-auto">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 text-center">Pesanan Terpusat</h3>
                    <p class="text-gray-700 text-center">Kelola semua pesanan makanan dalam satu platform, mempermudah pembagian dan pengiriman ke lokasi.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-blue-50 rounded-xl p-8 shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white text-2xl mb-6 mx-auto">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 text-center">Pantau Progres</h3>
                    <p class="text-gray-700 text-center">Dapatkan laporan real-time tentang jumlah dana yang terkumpul dan status distribusi makanan.</p>
                </div>
            </div>

            <div class="text-center mt-16">
                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-8 rounded-full transition duration-300 text-lg shadow-lg inline-block">
                    Gabung Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section (Optional) -->
    <section class="py-16 md:py-24 bg-blue-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Yang Mereka Katakan</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">Pengalaman pengguna Jajan Bareng dari berbagai kampus</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-xl p-8 shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-200 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                            <span class="text-blue-700 font-bold text-xl">A</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Andi Pratama</h4>
                            <p class="text-sm text-gray-600">Ketua BEM Universitas XYZ</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Jajan Bareng sangat membantu kami dalam mengumpulkan dana untuk acara tahunan kampus. Prosesnya jauh lebih efisien!"</p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-xl p-8 shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-200 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                            <span class="text-blue-700 font-bold text-xl">B</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Budi Santoso</h4>
                            <p class="text-sm text-gray-600">Sekbid Dana OSIS SMAN 5</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Berkat Jajan Bareng, distribusi makanan untuk acara besar sekolah jadi lebih terorganisir dan transparan."</p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-xl p-8 shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-200 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                            <span class="text-blue-700 font-bold text-xl">C</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Citra Dewi</h4>
                            <p class="text-sm text-gray-600">Koordinator Acara Fakultas Ekonomi</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Platform yang sangat membantu untuk kegiatan fundraising mahasiswa. Tidak perlu repot mengelola pesanan secara manual lagi."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-200 py-12">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col md:flex-row justify-between items-center md:items-start">
                <!-- Brand -->
                <div class="mb-8 md:mb-0 text-center md:text-left">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">JAJAN BARENG</h3>
                    <p class="text-gray-700 mb-4">Platform jajan dan fundraising<br>untuk kegiatan kampus</p>
                    <p class="text-gray-700">© JAJANBARENG {{\Carbon\Carbon::now()->format('Y')}}</p>
                </div>

                <!-- Links -->
                <div class="grid grid-cols-2 gap-8 md:gap-16">
                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">Layanan</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-700 hover:text-blue-700">Cara Kerja</a></li>
                            <li><a href="#" class="text-gray-700 hover:text-blue-700">Fitur</a></li>
                            <li><a href="#" class="text-gray-700 hover:text-blue-700">Harga</a></li>
                            <li><a href="#" class="text-gray-700 hover:text-blue-700">FAQ</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">Perusahaan</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-700 hover:text-blue-700">Tentang Kami</a></li>
                            <li><a href="#" class="text-gray-700 hover:text-blue-700">Kontak</a></li>
                            <li><a href="#" class="text-gray-700 hover:text-blue-700">Karir</a></li>
                            <li><a href="#" class="text-gray-700 hover:text-blue-700">Blog</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s ease-in-out infinite;
        }
    </style>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>