<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MBG - Makan Bersama Gratis | E-Voting Menu Makanan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-50">
    <!-- Header Top Bar -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-between items-center text-sm">
                <div class="hidden md:flex flex-wrap gap-6">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        +62 812 3456 7890
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        info@mbg-voting.com
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Sen - Jum: 9:00 - 17:00
                    </span>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}"
                           class="px-4 py-1 bg-white text-purple-600 rounded hover:bg-purple-50 transition font-medium flex items-center">
                            Dashboard
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('auth.signin') }}"
                           class="px-4 py-1 bg-white text-purple-600 rounded hover:bg-purple-50 transition font-medium">
                            Masuk
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sticky top-0 bg-white shadow-md z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-2xl">M</span>
                    </div>
                    <div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">MBG</span>
                        <p class="text-xs text-gray-600">
                            Makan
                            <span class="text-red-400">
                                Bersama
                            </span>
                            Gratis
                        </p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-gray-700 hover:text-purple-600 transition font-semibold">Beranda</a>
                    <a href="#tentang" class="text-gray-700 hover:text-purple-600 transition font-semibold">Tentang</a>
                    <a href="#fitur" class="text-gray-700 hover:text-purple-600 transition font-semibold">Fitur</a>
                    <a href="#statistik" class="text-gray-700 hover:text-purple-600 transition font-semibold">Statistik</a>
                    <a href="#cara-kerja" class="text-gray-700 hover:text-purple-600 transition font-semibold">Cara Kerja</a>
                </div>

                <!-- CTA Button -->
                <div class="hidden md:block">
                    @guest
                        <a href="{{ route('auth.signup') }}"
                           class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:shadow-lg transition flex items-center">
                            Mulai Voting
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @else
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.view-votes') : route('user.menus') }}"
                           class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                            Lihat Menu
                        </a>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-700" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden pb-4">
                <a href="#beranda" class="block py-2 text-gray-700 hover:text-purple-600 transition">Beranda</a>
                <a href="#tentang" class="block py-2 text-gray-700 hover:text-purple-600 transition">Tentang</a>
                <a href="#fitur" class="block py-2 text-gray-700 hover:text-purple-600 transition">Fitur</a>
                <a href="#statistik" class="block py-2 text-gray-700 hover:text-purple-600 transition">Statistik</a>
                <a href="#cara-kerja" class="block py-2 text-gray-700 hover:text-purple-600 transition">Cara Kerja</a>
                @guest
                    <a href="{{ route('auth.signup') }}" class="block mt-4 px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg text-center font-semibold">
                        Mulai Voting
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Hero Banner Section -->
    <section id="beranda" class="relative bg-gradient-to-br from-purple-600 via-indigo-600 to-purple-700 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute transform rotate-45 -top-20 -right-20 w-96 h-96 bg-white rounded-full"></div>
            <div class="absolute transform -rotate-45 -bottom-20 -left-20 w-96 h-96 bg-white rounded-full"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Hero Text -->
                <div class="text-center md:text-left">
                    <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold mb-6">
                        🎉 Platform E-Voting Menu Terpercaya
                    </span>
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                        Suara Anda, Menu Kami
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 text-purple-100">
                        Berpartisipasi dalam menentukan menu Makan <span class="text-red-400">Bersama</span>. Voting mudah, cepat, dan transparan!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        @guest
                            <a href="{{ route('auth.signup') }}"
                               class="px-8 py-4 bg-white text-purple-600 rounded-xl font-bold hover:shadow-2xl hover:scale-105 transition text-center">
                                Mulai Voting Sekarang
                            </a>
                            <a href="#tentang"
                               class="px-8 py-4 border-2 border-white text-white rounded-xl font-bold hover:bg-white hover:text-purple-600 transition text-center">
                                Pelajari Lebih Lanjut
                            </a>
                        @else
                            <a href="{{ auth()->user()->isAdmin() ? route('admin.view-votes') : route('user.menus') }}"
                               class="px-8 py-4 bg-white text-purple-600 rounded-xl font-bold hover:shadow-2xl hover:scale-105 transition text-center">
                                Lihat Menu Voting
                            </a>
                        @endguest
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="relative">
                    <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 shadow-2xl">
                        <div class="bg-white rounded-2xl p-6 mb-4">
                            <div class="aspect-video bg-gradient-to-br from-purple-100 to-indigo-100 rounded-xl flex items-center justify-center mb-4">
                                <svg class="w-32 h-32 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 text-center">Vote Mudah & Transparan</h3>
                            <p class="text-gray-600 text-center mt-2">Pilih menu favorit dengan sekali klik</p>
                        </div>
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
                                <p class="text-3xl font-bold">{{ \App\Models\User::where('role', 'user')->count() }}+</p>
                                <p class="text-sm text-purple-100">Voters</p>
                            </div>
                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
                                <p class="text-3xl font-bold">{{ \App\Models\Menu::count() }}+</p>
                                <p class="text-sm text-purple-100">Menu</p>
                            </div>
                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
                                <p class="text-3xl font-bold">100%</p>
                                <p class="text-sm text-purple-100">Gratis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
                <!-- Image -->
                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <div class="aspect-square bg-gradient-to-br from-purple-100 to-indigo-100 flex items-center justify-center">
                            <svg class="w-64 h-64 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <!-- Experience Badge -->
                    <div class="absolute -bottom-6 -right-6 bg-gradient-to-br from-purple-600 to-indigo-600 text-white rounded-3xl p-8 shadow-2xl">
                        <p class="text-5xl font-bold">2025</p>
                        <p class="text-lg mt-2">Platform<br>Terpercaya</p>
                    </div>
                </div>

                <!-- Content -->
                <div>
                    <span class="text-purple-600 font-bold text-lg">Tentang Kami</span>
                    <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-6">Suara Rakyat untuk Menu Bersama</h2>
                    <p class="text-gray-600 mb-4">
                        MBG E-Voting adalah platform digital yang memungkinkan masyarakat berpartisipasi dalam menentukan menu makanan <span class="text-red-400">Bersama</span> gratis.
                        Kami percaya bahwa setiap suara berharga dan berhak didengar.
                    </p>
                    <p class="text-gray-600 mb-6">
                        Dengan sistem voting yang transparan dan mudah digunakan, kami memastikan bahwa menu yang tersedia sesuai dengan keinginan dan kebutuhan masyarakat.
                    </p>
                    <a href="#fitur" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                        Pelajari Lebih Lanjut
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Untuk Semua</h4>
                    <p class="text-gray-600">Platform terbuka untuk seluruh masyarakat</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition border border-gray-100">
                    <div class="w-16 h-16 bg-indigo-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Aman & Terpercaya</h4>
                    <p class="text-gray-600">Sistem keamanan data terjamin</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Cepat & Mudah</h4>
                    <p class="text-gray-600">Proses voting hanya dalam hitungan detik</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition border border-gray-100">
                    <div class="w-16 h-16 bg-indigo-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Transparan</h4>
                    <p class="text-gray-600">Hasil voting dapat dilihat secara real-time</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="text-purple-600 font-bold text-lg">Fitur Unggulan</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-4">Kenapa Memilih MBG E-Voting?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Platform voting terlengkap dengan berbagai fitur yang memudahkan Anda dalam berpartisipasi
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <span class="text-purple-600 font-bold text-sm uppercase tracking-wide">Voting</span>
                    <h3 class="text-2xl font-bold text-gray-900 mt-2 mb-4">Sistem Voting Fleksibel</h3>
                    <p class="text-gray-600 mb-4">
                        Ubah pilihan kapan saja selama periode voting berlangsung tanpa ada batasan
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600">Vote untuk menu favorit</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600">Ganti pilihan kapan saja</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600">Riwayat voting tersimpan</span>
                        </li>
                    </ul>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <span class="text-indigo-600 font-bold text-sm uppercase tracking-wide">Real-Time</span>
                    <h3 class="text-2xl font-bold text-gray-900 mt-2 mb-4">Hasil Transparan</h3>
                    <p class="text-gray-600 mb-4">
                        Pantau hasil voting secara langsung dengan visualisasi data yang jelas dan mudah dipahami
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600">Update hasil real-time</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600">Grafik visualisasi</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600">Statistik lengkap</span>
                        </li>
                    </ul>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-pink-600 font-bold text-sm uppercase tracking-wide">Riwayat</span>
                    <h3 class="text-2xl font-bold text-gray-900 mt-2 mb-4">Histori Lengkap</h3>
                    <p class="text-gray-600 mb-4">
                        Akses riwayat voting Anda kapan saja dengan sistem pencatatan yang terorganisir
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600">Lihat semua voting</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600">Filter berdasarkan tanggal</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600">Data tersimpan permanen</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section id="statistik" class="py-20 relative bg-gradient-to-br from-purple-600 via-indigo-600 to-purple-700 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Left Side - Stats Info -->
                <div>
                    <span class="text-purple-200 font-bold text-lg">Statistik Platform</span>
                    <h2 class="text-4xl font-bold mt-2 mb-6">Angka dan Fakta MBG E-Voting</h2>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-4xl font-bold">{{ \App\Models\User::where('role', 'user')->count() }}+</p>
                                    <p class="text-purple-200">Total Pengguna</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-4xl font-bold">{{ \App\Models\Menu::count() }}+</p>
                                    <p class="text-purple-200">Menu Tersedia</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-4xl font-bold">{{ \App\Models\Vote::where('is_current', true)->count() }}+</p>
                                    <p class="text-purple-200">Total Voting</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-4xl font-bold">24/7</p>
                                    <p class="text-purple-200">Akses Kapan Saja</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - How We Help -->
                <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8">
                    <h3 class="text-3xl font-bold mb-6">Bagaimana Kami Membantu</h3>

                    <div class="space-y-4">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 flex items-start gap-4">
                            <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Partisipasi Masyarakat</h4>
                                <p class="text-purple-100">Memberikan platform bagi masyarakat untuk bersuara dan menentukan pilihan menu makanan bergizi</p>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 flex items-start gap-4">
                            <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Transparansi Penuh</h4>
                                <p class="text-purple-100">Sistem voting yang transparan dengan hasil yang dapat diakses dan dipantau secara real-time oleh semua pihak</p>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 flex items-start gap-4">
                            <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Proses Cepat & Mudah</h4>
                                <p class="text-purple-100">Interface yang user-friendly memudahkan siapa saja untuk berpartisipasi tanpa kesulitan teknis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="cara-kerja" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="text-purple-600 font-bold text-lg">Cara Kerja</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-4">Mulai Voting Dalam 3 Langkah Mudah</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Proses voting yang sederhana dan cepat, siapa pun bisa melakukannya
                </p>
            </div>

            <!-- Steps -->
            <div class="grid md:grid-cols-3 gap-8 relative">
                <!-- Connection Line -->
                <div class="hidden md:block absolute top-16 left-0 right-0 h-1 bg-gradient-to-r from-purple-600 via-indigo-600 to-purple-600 transform -translate-y-1/2" style="top: 4rem; left: 16.666%; right: 16.666%;"></div>

                <!-- Step 1 -->
                <div class="relative">
                    <div class="bg-gradient-to-br from-purple-600 to-indigo-600 text-white rounded-3xl p-8 text-center shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <span class="text-3xl font-bold text-purple-600">1</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Daftar Akun</h3>
                        <p class="text-purple-100">
                            Buat akun gratis dengan mengisi data diri sederhana. Proses registrasi hanya memakan waktu kurang dari 2 menit
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative">
                    <div class="bg-gradient-to-br from-indigo-600 to-purple-600 text-white rounded-3xl p-8 text-center shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <span class="text-3xl font-bold text-indigo-600">2</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Pilih Menu</h3>
                        <p class="text-purple-100">
                            Telusuri berbagai pilihan menu makanan bersama yang tersedia dan pilih menu favorit Anda
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative">
                    <div class="bg-gradient-to-br from-purple-600 to-pink-600 text-white rounded-3xl p-8 text-center shadow-xl hover:shadow-2xl transition transform hover:-translate-y-2">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <span class="text-3xl font-bold text-purple-600">3</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Vote & Selesai</h3>
                        <p class="text-purple-100">
                            Klik tombol vote dan suara Anda akan langsung tercatat. Anda bisa melihat hasil voting secara real-time
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-16">
                @guest
                    <a href="{{ route('auth.signup') }}"
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-bold text-lg hover:shadow-2xl hover:scale-105 transition">
                        Mulai Voting Sekarang
                        <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                @else
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.view-votes') : route('user.menus') }}"
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-bold text-lg hover:shadow-2xl hover:scale-105 transition">
                        Lihat Menu Voting
                        <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- Brand -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-2xl">M</span>
                        </div>
                        <div>
                            <span class="text-2xl font-bold">MBG</span>
                            <p class="text-sm text-gray-400">Makan Bersama Gratis</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Platform E-Voting untuk menentukan menu Makan Bersama Gratis.
                        Suara Anda, Menu Kami.
                    </p>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Navigasi</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="#tentang" class="text-gray-400 hover:text-white transition">Tentang</a></li>
                        <li><a href="#fitur" class="text-gray-400 hover:text-white transition">Fitur</a></li>
                        <li><a href="#cara-kerja" class="text-gray-400 hover:text-white transition">Cara Kerja</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Kontak</h4>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-400">info@mbg-voting.com</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-400">+62 812 3456 7890</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    © 2025 MBG E-Voting. All rights reserved.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a>
                    <span class="text-gray-600">|</span>
                    <a href="#" class="text-gray-400 hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobileMenu');
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                }
            });
        });
    </script>
</body>

</html>
