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
                    <h1 class="text-2xl font-bold text-gray-900 text-center md:text-left tracking-tight">JAJAN BARENG
                    </h1>
                    <p class="text-sm text-gray-700 text-center md:text-left">Mau mamam apa hari ini?</p>
                </div>
            </div>

            <!-- Right side - Auth buttons -->
            <div class="flex space-x-4">
                <a href="{{ route('login') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-full transition duration-300 shadow-md">
                    MASUK
                </a>
                <a href="{{ route('register') }}"
                    class="bg-white hover:bg-gray-100 text-blue-800 font-medium py-2 px-6 rounded-full border border-blue-800 transition duration-300 shadow-md">
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
                    <h2 class="text-7xl md:text-8xl font-bold text-red-500 mb-4">404</h2>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                        Halaman Tidak Ditemukan
                    </h2>
                    <p class="text-lg md:text-xl text-gray-700 mb-8 leading-relaxed">
                        Maaf, halaman yang Anda cari tidak tersedia.<br>
                        Silakan kembali ke halaman utama.
                    </p>
                    <a href="/" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-8 rounded-full transition duration-300 shadow-md inline-flex items-center">
                        <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                    </a>
                </div>

                <!-- Right: Bear Mascot -->
                <div class="w-full md:w-1/2 flex justify-center md:justify-end">
                    <img src="{{ asset('logo.png') }}" alt="Jajan Bareng Mascot"
                        class="w-64 md:w-80 lg:w-96 h-auto animate-bounce-slow transform hover:scale-105 transition duration-500">
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
                    <p class="text-gray-700">© JAJANBARENG {{ \Carbon\Carbon::now()->format('Y') }}</p>
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
