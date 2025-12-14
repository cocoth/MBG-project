<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MBG - Makan Bergizi Gratis | E-Voting Menu Makanan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/95 backdrop-blur-sm shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">M</span>
                    </div>
                    <span class="text-2xl font-bold gradient-text">MBG</span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-gray-700 hover:text-purple-600 transition">Beranda</a>
                    <a href="#fitur" class="text-gray-700 hover:text-purple-600 transition">Fitur</a>
                    <a href="#cara-kerja" class="text-gray-700 hover:text-purple-600 transition">Cara Kerja</a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}"
                           class="px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('auth.signin') }}" class="text-gray-700 hover:text-purple-600 transition">Masuk</a>
                        <a href="{{ route('auth.signup') }}" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="pt-24 pb-16 gradient-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Pilih Menu Favorit untuk
                        <span class="text-yellow-300">Makan Bergizi Gratis</span>
                    </h1>
                    <p class="text-xl mb-8 text-purple-100">
                        Voting menu makanan gratis sekarang lebih mudah! Partisipasi Anda menentukan menu hari esok.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        @guest
                            <a href="{{ route('auth.signup') }}" class="px-8 py-4 bg-white text-purple-600 rounded-lg font-semibold hover:shadow-2xl transition text-center">
                                Mulai Voting Sekarang
                            </a>
                            <a href="#fitur" class="px-8 py-4 border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition text-center">
                                Pelajari Lebih Lanjut
                            </a>
                        @else
                            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.votes') }}"
                               class="px-8 py-4 bg-white text-purple-600 rounded-lg font-semibold hover:shadow-2xl transition text-center">
                                Lihat Menu Voting
                            </a>
                        @endguest
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 transform hover:scale-105 transition">
                        <div class="aspect-square bg-gradient-to-br from-purple-100 to-indigo-100 rounded-xl mb-4 flex items-center justify-center">
                            <svg class="w-48 h-48 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 text-center">Vote Mudah & Cepat</h3>
                        <p class="text-gray-600 text-center mt-2">Pilih menu favorit dengan satu klik</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold gradient-text">{{ \App\Models\User::where('role', 'user')->count() }}+</div>
                    <div class="text-gray-600 mt-2">Pengguna Aktif</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold gradient-text">{{ \App\Models\Vote::count() }}+</div>
                    <div class="text-gray-600 mt-2">Total Vote</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold gradient-text">{{ \App\Models\Menu::count() }}+</div>
                    <div class="text-gray-600 mt-2">Menu Tersedia</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold gradient-text">{{ \App\Models\Menu::ongoing()->count() }}</div>
                    <div class="text-gray-600 mt-2">Voting Aktif</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600">Sistem voting yang modern dan user-friendly</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Real-time Voting</h3>
                    <p class="text-gray-600">Lihat hasil voting secara real-time dan pantau popularitas setiap menu</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Foto Menu</h3>
                    <p class="text-gray-600">Lihat foto menu sebelum voting untuk membantu keputusan Anda</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-pink-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Vote Berulang</h3>
                    <p class="text-gray-600">Anda bisa vote berkali-kali sampai batas waktu voting berakhir</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">History Lengkap</h3>
                    <p class="text-gray-600">Lacak riwayat voting Anda dan lihat menu yang pernah Anda pilih</p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-yellow-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Aman & Terpercaya</h3>
                    <p class="text-gray-600">Sistem keamanan terjamin dengan autentikasi user yang kuat</p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition">
                    <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Proses Cepat</h3>
                    <p class="text-gray-600">Interface yang simpel membuat proses voting jadi lebih cepat</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="cara-kerja" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Cara Kerja</h2>
                <p class="text-xl text-gray-600">Mudah dan sederhana dalam 3 langkah</p>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-3xl font-bold">1</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Daftar / Login</h3>
                    <p class="text-gray-600">Buat akun baru atau login dengan akun yang sudah ada</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-3xl font-bold">2</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Pilih Menu</h3>
                    <p class="text-gray-600">Lihat foto dan deskripsi menu, lalu pilih favorit Anda</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-3xl font-bold">3</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Vote!</h3>
                    <p class="text-gray-600">Klik tombol vote dan Anda bisa vote berkali-kali</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Siap Memilih Menu Favorit Anda?
            </h2>
            <p class="text-xl text-purple-100 mb-8">
                Bergabunglah dengan ribuan pengguna lainnya dan tentukan menu makan gratis hari esok!
            </p>
            @guest
                <a href="{{ route('auth.signup') }}" class="inline-block px-10 py-4 bg-white text-purple-600 rounded-lg font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition">
                    Daftar Gratis Sekarang
                </a>
            @else
                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.votes') }}"
                   class="inline-block px-10 py-4 bg-white text-purple-600 rounded-lg font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition">
                    Mulai Voting
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">M</span>
                        </div>
                        <span class="text-2xl font-bold">MBG</span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Platform e-voting untuk menentukan menu Makan Bergizi Gratis.
                        Partisipasi Anda sangat berarti!
                    </p>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="#fitur" class="text-gray-400 hover:text-white transition">Fitur</a></li>
                        <li><a href="#cara-kerja" class="text-gray-400 hover:text-white transition">Cara Kerja</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Bantuan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Kontak</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} MBG - Makan Bergizi Gratis. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
