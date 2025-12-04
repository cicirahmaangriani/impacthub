<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImpactHub - Platform Kegiatan Sosial, Event & Bootcamp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-br from-blue-600 to-purple-600 w-12 h-12 rounded-lg flex items-center justify-center">
                        <i class="fas fa-heart text-white text-2xl"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">ImpactHub</span>
                        <p class="text-xs text-gray-500">Wujudkan Dampak Positif</p>
                    </div>
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <a href="#beranda" class="text-gray-700 hover:text-blue-600 transition font-medium">Beranda</a>
                    <a href="#kegiatan" class="text-gray-700 hover:text-blue-600 transition font-medium">Kegiatan</a>
                    <a href="#tentang" class="text-gray-700 hover:text-blue-600 transition font-medium">Tentang</a>
                    <a href="#kontak" class="text-gray-700 hover:text-blue-600 transition font-medium">Kontak</a>
                </div>
                
                <div class="flex space-x-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2.5 rounded-lg hover:shadow-lg transition font-medium">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="border-2 border-blue-600 text-blue-600 px-6 py-2.5 rounded-lg hover:bg-blue-50 transition font-medium">
                                <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2.5 rounded-lg hover:shadow-lg transition font-medium">
                                    <i class="fas fa-user-plus mr-2"></i>Daftar
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">Tentang ImpactHub</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        ImpactHub adalah platform berbasis web yang berfungsi sebagai sistem informasi untuk pendataan, pengelolaan, dan penyimpanan data kegiatan sosial, event, course, serta bootcamp.
                    </p>
                    <p class="text-lg text-gray-600 mb-6">
                        Platform ini dirancang untuk memudahkan penyelenggara dalam mengatur kegiatan, mencatat peserta, mengelola jadwal, serta menyediakan akses informasi yang terintegrasi bagi semua pihak yang terlibat.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-check text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Platform Terpadu</h4>
                                <p class="text-gray-600">Satu platform untuk semua jenis kegiatan</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-purple-100 w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-check text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Mudah Digunakan</h4>
                                <p class="text-gray-600">Interface intuitif untuk semua kalangan</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-pink-100 w-12 h-12 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-check text-pink-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Aman & Terpercaya</h4>
                                <p class="text-gray-600">Data Anda terlindungi dengan baik</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-2xl">
                        <i class="fas fa-users text-4xl mb-3"></i>
                        <div class="text-3xl font-bold mb-1">5000+</div>
                        <div class="text-blue-100">Peserta Aktif</div>
                    </div>
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-6 rounded-2xl">
                        <i class="fas fa-calendar-check text-4xl mb-3"></i>
                        <div class="text-3xl font-bold mb-1">100+</div>
                        <div class="text-purple-100">Event Sukses</div>
                    </div>
                    <div class="bg-gradient-to-br from-pink-500 to-pink-600 text-white p-6 rounded-2xl">
                        <i class="fas fa-building text-4xl mb-3"></i>
                        <div class="text-3xl font-bold mb-1">50+</div>
                        <div class="text-pink-100">Penyelenggara</div>
                    </div>
                    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-2xl">
                        <i class="fas fa-star text-4xl mb-3"></i>
                        <div class="text-3xl font-bold mb-1">4.8/5</div>
                        <div class="text-green-100">Rating User</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Organizer Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="bg-gradient-to-br from-blue-600 via-purple-600 to-pink-500 rounded-3xl p-12 text-white text-center">
                <h2 class="text-4xl font-bold mb-4">Ingin Menjadi Penyelenggara?</h2>
                <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
                    Daftarkan organisasi Anda dan mulai mengadakan event, bootcamp, atau kegiatan sosial dengan mudah
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition shadow-xl">
                        Daftar Sebagai Penyelenggara
                    </a>
                    <a href="#" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white/10 transition">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
                <div class="mt-8 flex items-center justify-center space-x-8 text-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2 text-yellow-300"></i>
                        Komisi Hanya 10%
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2 text-yellow-300"></i>
                        Dashboard Lengkap
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2 text-yellow-300"></i>
                        Support 24/7
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="kontak" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Siap Memulai Perjalanan Anda?</h2>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan peserta yang telah merasakan manfaat dari kegiatan-kegiatan inspiratif di ImpactHub
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-10 py-4 rounded-lg text-lg font-semibold hover:shadow-2xl transition">
                    Daftar Sekarang Gratis
                </a>
                <a href="mailto:info@impacthub.com" class="border-2 border-gray-300 text-gray-700 px-10 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-gradient-to-br from-blue-600 to-purple-600 w-10 h-10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-heart text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-white">ImpactHub</span>
                    </div>
                    <p class="text-gray-400 mb-4">Platform terpadu untuk kegiatan sosial, event, dan bootcamp yang mengembangkan potensi Anda.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-2xl hover:text-blue-400 transition"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-2xl hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-2xl hover:text-pink-400 transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-2xl hover:text-blue-400 transition"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-4">Menu</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="hover:text-blue-400 transition">Beranda</a></li>
                        <li><a href="#kegiatan" class="hover:text-blue-400 transition">Kegiatan</a></li>
                        <li><a href="#tentang" class="hover:text-blue-400 transition">Tentang Kami</a></li>
                        <li><a href="#kontak" class="hover:text-blue-400 transition">Kontak</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Blog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-4">Kategori</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-blue-400 transition">Kegiatan Sosial</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Event & Seminar</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Bootcamp</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Workshop</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Volunteer</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-4">Kontak</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-envelope mr-3 mt-1 text-blue-400"></i>
                            <span>info@impacthub.com</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone mr-3 mt-1 text-blue-400"></i>
                            <span>(021) 1234-5678</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mr-3 mt-1 text-blue-400"></i>
                            <span>Jakarta, Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p>&copy; 2025 ImpactHub. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-blue-400 transition">Privacy Policy</a>
                    <a href="#" class="hover:text-blue-400 transition">Terms of Service</a>
                    <a href="#" class="hover:text-blue-400 transition">FAQ</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollTop" class="fixed bottom-8 right-8 bg-gradient-to-r from-blue-600 to-purple-600 text-white w-12 h-12 rounded-full shadow-lg hover:shadow-2xl transition opacity-0 pointer-events-none">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Scroll to top button
        const scrollTopBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                scrollTopBtn.classList.add('opacity-0', 'pointer-events-none');
            }
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-pink-500 text-white overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="container mx-auto px-6 py-24 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                        <span class="text-sm font-semibold">✨ Platform Terpercaya untuk Kegiatan Positif</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Wujudkan <span class="text-yellow-300">Dampak Positif</span> Bersama ImpactHub
                    </h1>
                    <p class="text-xl mb-8 text-blue-100">
                        Platform terpadu untuk kegiatan sosial, event inspiratif, dan bootcamp yang mengembangkan potensi Anda.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition shadow-xl">
                            Mulai Sekarang <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <a href="#kegiatan" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white/10 transition">
                            Lihat Kegiatan
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 mt-12">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-yellow-300">100+</div>
                            <div class="text-sm text-blue-100">Event Terlaksana</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-yellow-300">5000+</div>
                            <div class="text-sm text-blue-100">Peserta Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-yellow-300">50+</div>
                            <div class="text-sm text-blue-100">Penyelenggara</div>
                        </div>
                    </div>
                </div>
                
                <div class="hidden md:block">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-yellow-300 to-pink-300 rounded-3xl transform rotate-6"></div>
                        <div class="relative bg-white rounded-3xl p-8 shadow-2xl transform hover:scale-105 transition duration-300">
                            <div class="space-y-6">
                                <div class="flex items-center space-x-4 bg-blue-50 p-4 rounded-xl">
                                    <div class="bg-blue-600 w-14 h-14 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-hands-helping text-white text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-800">Kegiatan Sosial</div>
                                        <div class="text-sm text-gray-600">Berkontribusi untuk masyarakat</div>
                                    </div>
                                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                                </div>
                                
                                <div class="flex items-center space-x-4 bg-purple-50 p-4 rounded-xl">
                                    <div class="bg-purple-600 w-14 h-14 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-alt text-white text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-800">Event & Seminar</div>
                                        <div class="text-sm text-gray-600">Kembangkan wawasan Anda</div>
                                    </div>
                                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                                </div>
                                
                                <div class="flex items-center space-x-4 bg-pink-50 p-4 rounded-xl">
                                    <div class="bg-pink-600 w-14 h-14 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-laptop-code text-white text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-800">Bootcamp</div>
                                        <div class="text-sm text-gray-600">Tingkatkan skill Anda</div>
                                    </div>
                                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Wave Decoration -->
        <div class="absolute bottom-0 w-full">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#F9FAFB"/>
            </svg>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="kegiatan" class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Jenis Kegiatan</h2>
                <p class="text-xl text-gray-600">Temukan kegiatan yang sesuai dengan minat dan tujuan Anda</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Kegiatan Sosial -->
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-8 text-white relative">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                        <i class="fas fa-hands-helping text-5xl mb-4 relative z-10"></i>
                        <h3 class="text-2xl font-bold mb-2 relative z-10">Kegiatan Sosial</h3>
                        <p class="text-blue-100 relative z-10">Volunteer & aksi sosial</p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-blue-600 mr-3"></i>
                                Bakti Sosial
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-blue-600 mr-3"></i>
                                Donor Darah
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-blue-600 mr-3"></i>
                                Penggalangan Dana
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-blue-600 mr-3"></i>
                                Relawan Lingkungan
                            </li>
                        </ul>
                        <a href="#" class="block w-full text-center bg-blue-50 text-blue-600 py-3 rounded-lg font-semibold hover:bg-blue-100 transition">
                            Lihat Kegiatan <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Event & Seminar -->
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-8 text-white relative">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                        <i class="fas fa-calendar-alt text-5xl mb-4 relative z-10"></i>
                        <h3 class="text-2xl font-bold mb-2 relative z-10">Event & Seminar</h3>
                        <p class="text-purple-100 relative z-10">Workshop & konferensi</p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-purple-600 mr-3"></i>
                                Seminar Nasional
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-purple-600 mr-3"></i>
                                Workshop Skill
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-purple-600 mr-3"></i>
                                Talkshow
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-purple-600 mr-3"></i>
                                Networking Event
                            </li>
                        </ul>
                        <a href="#" class="block w-full text-center bg-purple-50 text-purple-600 py-3 rounded-lg font-semibold hover:bg-purple-100 transition">
                            Lihat Event <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Bootcamp -->
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden">
                    <div class="bg-gradient-to-br from-pink-500 to-pink-600 p-8 text-white relative">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                        <i class="fas fa-laptop-code text-5xl mb-4 relative z-10"></i>
                        <h3 class="text-2xl font-bold mb-2 relative z-10">Bootcamp</h3>
                        <p class="text-pink-100 relative z-10">Pelatihan intensif</p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-pink-600 mr-3"></i>
                                Teknologi & IT
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-pink-600 mr-3"></i>
                                Digital Marketing
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-pink-600 mr-3"></i>
                                Kewirausahaan
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-pink-600 mr-3"></i>
                                Design & Multimedia
                            </li>
                        </ul>
                        <a href="#" class="block w-full text-center bg-pink-50 text-pink-600 py-3 rounded-lg font-semibold hover:bg-pink-100 transition">
                            Lihat Bootcamp <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600">Kemudahan yang kami tawarkan untuk Anda</p>
            </div>
            
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center p-6 hover:bg-gray-50 rounded-xl transition">
                    <div class="bg-gradient-to-br from-blue-100 to-blue-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-mouse-pointer text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Pendaftaran Mudah</h3>
                    <p class="text-gray-600">Daftar kegiatan hanya dengan beberapa klik</p>
                </div>

                <div class="text-center p-6 hover:bg-gray-50 rounded-xl transition">
                    <div class="bg-gradient-to-br from-purple-100 to-purple-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-credit-card text-purple-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Pembayaran Aman</h3>
                    <p class="text-gray-600">Transaksi aman melalui payment gateway</p>
                </div>

                <div class="text-center p-6 hover:bg-gray-50 rounded-xl transition">
                    <div class="bg-gradient-to-br from-green-100 to-green-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bell text-green-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Notifikasi Real-time</h3>
                    <p class="text-gray-600">Dapatkan pengingat jadwal kegiatan</p>
                </div>

                <div class="text-center p-6 hover:bg-gray-50 rounded-xl transition">
                    <div class="bg-gradient-to-br from-yellow-100 to-yellow-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-certificate text-yellow-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Sertifikat Digital</h3>
                    <p class="text-gray-600">Dapatkan sertifikat setelah kegiatan</p>
                </div>

                <div class="text-center p-6 hover:bg-gray-50 rounded-xl transition">
                    <div class="bg-gradient-to-br from-red-100 to-red-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-filter text-red-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Filter Kategori</h3>
                    <p class="text-gray-600">Temukan kegiatan sesuai minat</p>
                </div>

                <div class="text-center p-6 hover:bg-gray-50 rounded-xl transition">
                    <div class="bg-gradient-to-br from-indigo-100 to-indigo-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-indigo-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Sistem Poin</h3>
                    <p class="text-gray-600">Kumpulkan poin untuk reward menarik</p>
                </div>

                <div class="text-center p-6 hover:bg-gray-50 rounded-xl transition">
                    <div class="bg-gradient-to-br from-pink-100 to-pink-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-pink-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Forum Komunitas</h3>
                    <p class="text-gray-600">Berinteraksi dengan peserta lain</p>
                </div>

                <div class="text-center p-6 hover:bg-gray-50 rounded-xl transition">
                    <div class="bg-gradient-to-br from-teal-100 to-teal-200 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-teal-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Customer Support</h3>
                    <p class="text-gray-600">Bantuan cepat melalui chat helpdesk</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Cara Kerja</h2>
                <p class="text-xl text-gray-600">Mulai perjalanan Anda hanya dalam 4 langkah mudah</p>
            </div>
            
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Daftar Akun</h3>
                    <p class="text-gray-600">Buat akun gratis dalam hitungan detik</p>
                </div>

                <div class="text-center">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Pilih Kegiatan</h3>
                    <p class="text-gray-600">Jelajahi berbagai kegiatan menarik</p>
                </div>

                <div class="text-center">
                    <div class="bg-gradient-to-br from-pink-500 to-pink-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Daftar & Bayar</h3>
                    <p class="text-gray-600">Proses pendaftaran dan pembayaran cepat</p>
                </div>

                <div class="text-center">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold">
                        4
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Ikuti Kegiatan</h3>
                    <p class="text-gray-600">Berpartisipasi dan dapatkan sertifikat</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Testimoni Peserta</h2>
                <p class="text-xl text-gray-600">Apa kata mereka tentang ImpactHub</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <img src="https://ui-avatars.com/api/?name=Sarah+Putri&background=4F46E5&color=fff" alt="Sarah" class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-800">Sarah Putri</h4>
                            <p class="text-sm text-gray-600">Mahasiswa UI</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 italic">"Platform yang sangat memudahkan untuk mencari dan mendaftar bootcamp teknologi. Sertifikat digitalnya juga sangat membantu!"</p>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Rizki&background=7C3AED&color=fff" alt="Ahmad" class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-800">Ahmad Rizki</h4>
                            <p class="text-sm text-gray-600">Fresh Graduate</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 italic">"Sangat terbantu dengan sistem notifikasi yang mengingatkan jadwal event. Tidak pernah ketinggalan acara lagi!"</p>
                </div>

                <div class="bg-gradient-to-br from-pink-50 to-red-50 p-8 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-6">
                        <img src="https://ui-avatars.com/api/?name=Dina+Wulandari&background=EC4899&color=fff" alt="Dina" class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-800">Dina Wulandari</h4>
                            <p class="text-sm text-gray-600">Komunitas Volunteer</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 italic">"Sebagai penyelenggara, ImpactHub sangat memudahkan dalam mengelola peserta dan jadwal kegiatan sosial kami."</p>
                </div>
            </div>
        </div>