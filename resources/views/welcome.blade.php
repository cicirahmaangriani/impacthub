<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImpactHub - Platform Kegiatan Sosial & Bootcamp Terpercaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'deep-navy': '#01162b',
                        'ocean-blue': '#00385a',
                        'arctic-mist': '#6a90b4',
                        'soft-gray': '#94a2bf',
                        'snow-veil': '#d2dbcb',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f5f7f2 0%, #e8ede3 25%, #d2dbcb 50%, #c5d0bf 100%);
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .glass-morphism {
            background: rgba(1, 22, 43, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(1, 22, 43, 0.08);
        }
        
        .glass-card {
            background: #00385a;
            border: 1px solid rgba(106, 144, 180, 0.2);
            box-shadow: 0 8px 32px rgba(1, 22, 43, 0.3);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #01162b 0%, #00385a 50%, #6a90b4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .btn-primary {
            background: #00385a;
            box-shadow: 0 10px 30px rgba(1, 22, 43, 0.25);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(1, 22, 43, 0.35);
        }
        
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(1, 22, 43, 0.3);
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(106, 144, 180, 0.15) 0%, transparent 70%);
        }
        
        .shape-1 {
            width: 500px;
            height: 500px;
            top: -250px;
            right: -250px;
            animation: float 20s ease-in-out infinite;
        }
        
        .shape-2 {
            width: 400px;
            height: 400px;
            bottom: -200px;
            left: -200px;
            animation: float 15s ease-in-out infinite reverse;
        }
        
        .shape-3 {
            width: 300px;
            height: 300px;
            top: 50%;
            left: 50%;
            animation: float 25s ease-in-out infinite;
            animation-delay: 2s;
        }
    </style>
</head>
<body class="antialiased">
    
    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 bg-white/80 backdrop-blur-md border-b border-deep-navy/10 shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-ocean-blue to-arctic-mist rounded-xl blur opacity-30 group-hover:opacity-60 transition duration-300"></div>
                        <div class="relative bg-gradient-to-br from-deep-navy via-ocean-blue to-arctic-mist w-12 h-12 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-water text-white text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-deep-navy via-ocean-blue to-arctic-mist bg-clip-text text-transparent tracking-tight">ImpactHub</span>
                        <p class="text-xs text-soft-gray">Diving into Opportunities</p>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-deep-navy/80 hover:text-deep-navy transition font-medium text-sm pb-1">Beranda</a>
                    <a href="#kegiatan" class="text-deep-navy/80 hover:text-deep-navy transition font-medium text-sm pb-1">Kegiatan</a>
                    <a href="#tentang" class="text-deep-navy/80 hover:text-deep-navy transition font-medium text-sm pb-1">Tentang</a>
                    <a href="#kontak" class="text-deep-navy/80 hover:text-deep-navy transition font-medium text-sm pb-1">Kontak</a>
                </div>
                
                <div class="flex items-center space-x-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary text-white px-6 py-2.5 rounded-xl hover:shadow-xl transition font-medium text-sm">
                                <i class="fas fa-compass mr-2"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="glass-morphism text-deep-navy px-6 py-2.5 rounded-xl hover:bg-deep-navy/5 transition font-medium text-sm border border-deep-navy/20">
                                <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-primary text-white px-6 py-2.5 rounded-xl font-medium text-sm">
                                    <i class="fas fa-user-plus mr-2"></i>Daftar
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative min-h-screen flex items-center overflow-hidden pt-20">
        <!-- Floating Shapes Background -->
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        
        <div class="container mx-auto px-6 py-24 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="animate-fade-in-up">
                    <!-- Badge -->
                    <div class="glass-morphism inline-flex items-center space-x-3 px-5 py-3 rounded-full mb-8 border border-deep-navy/15">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-arctic-mist opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-arctic-mist"></span>
                        </span>
                        <span class="text-sm font-semibold text-deep-navy">Platform #1 di Indonesia</span>
                    </div>
                    
                    <h1 class="text-6xl lg:text-7xl font-bold mb-8 leading-tight text-deep-navy">
                        Selami Potensi
                        <span class="gradient-text block mt-2">Tanpa Batas</span>
                    </h1>
                    
                    <p class="text-xl mb-10 text-ocean-blue/80 leading-relaxed">
                        Platform modern yang menghubungkan mimpi dengan aksi nyata. Bergabunglah dalam kegiatan sosial, bootcamp, dan event yang mengubah hidup.
                    </p>
                    
                    <div class="flex flex-wrap gap-4 mb-12">
                        <a href="{{ route('register') }}" class="group btn-primary px-8 py-4 rounded-xl text-white font-semibold text-lg flex items-center">
                            Mulai Perjalanan
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                        <a href="{{ route('events.index') }}" class="bg-arctic-mist hover:bg-arctic-mist/90 px-8 py-4 rounded-xl text-white font-semibold text-lg flex items-center border border-arctic-mist/30 shadow-lg transition">
                            Jelajahi Event
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6">
                        <div class="glass-card p-5 rounded-2xl text-center">
                            <div class="text-4xl font-bold text-arctic-mist mb-1">100+</div>
                            <div class="text-sm text-snow-veil">Event Sukses</div>
                        </div>
                        <div class="glass-card p-5 rounded-2xl text-center">
                            <div class="text-4xl font-bold text-arctic-mist mb-1">5K+</div>
                            <div class="text-sm text-snow-veil">Peserta Aktif</div>
                        </div>
                        <div class="glass-card p-5 rounded-2xl text-center">
                            <div class="text-4xl font-bold text-arctic-mist mb-1">50+</div>
                            <div class="text-sm text-snow-veil">Organizer</div>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Image Side -->
                <div class="hidden lg:block relative animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="relative">
                        <!-- Decorative Glass Cards -->
                        <div class="absolute -top-10 right-0 glass-card p-6 rounded-2xl shadow-2xl max-w-xs border border-snow-veil/10 animate-float">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-snow-veil to-soft-gray flex items-center justify-center">
                                    <i class="fas fa-trophy text-deep-navy"></i>
                                </div>
                                <div>
                                    <div class="text-snow-veil font-bold">Achievement</div>
                                    <div class="text-soft-gray text-sm">Level Up!</div>
                                </div>
                            </div>
                            <div class="bg-white/5 rounded-lg p-3">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-soft-gray">Progress</span>
                                    <span class="text-snow-veil font-bold">85%</span>
                                </div>
                                <div class="w-full bg-deep-navy/50 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-soft-gray via-arctic-mist to-snow-veil h-2 rounded-full" style="width: 85%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute bottom-10 -left-10 glass-card p-5 rounded-2xl shadow-2xl border border-white/10 animate-float" style="animation-delay: 1s;">
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <div class="absolute -inset-1 bg-gradient-to-r from-arctic-mist to-soft-gray rounded-full blur opacity-50"></div>
                                    <img src="https://ui-avatars.com/api/?name=User&background=6a90b4&color=fff&size=48" class="relative w-12 h-12 rounded-full border-2 border-white/20">
                                </div>
                                <div>
                                    <div class="text-white font-semibold text-sm">Sarah joined</div>
                                    <div class="text-soft-gray text-xs">Web Dev Bootcamp</div>
                                </div>
                                <div class="ml-4">
                                    <div class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center">
                                        <i class="fas fa-check text-green-400 text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Main Hero Visual -->
                        <div class="glass-card p-8 rounded-3xl border border-white/10 shadow-2xl">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="glass-morphism p-6 rounded-2xl hover:bg-snow-veil/5 transition cursor-pointer group">
                                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-snow-veil/30 to-soft-gray/30 flex items-center justify-center mb-4 group-hover:scale-110 transition">
                                        <i class="fas fa-hands-helping text-snow-veil text-2xl"></i>
                                    </div>
                                    <div class="text-snow-veil font-bold mb-1">Social Impact</div>
                                    <div class="text-soft-gray text-sm">Volunteer programs</div>
                                </div>
                                
                                <div class="glass-morphism p-6 rounded-2xl hover:bg-snow-veil/5 transition cursor-pointer group">
                                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-arctic-mist/30 to-ocean-blue/30 flex items-center justify-center mb-4 group-hover:scale-110 transition">
                                        <i class="fas fa-graduation-cap text-arctic-mist text-2xl"></i>
                                    </div>
                                    <div class="text-snow-veil font-bold mb-1">Bootcamps</div>
                                    <div class="text-soft-gray text-sm">Skill development</div>
                                </div>
                                
                                <div class="glass-morphism p-6 rounded-2xl hover:bg-snow-veil/5 transition cursor-pointer group">
                                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-soft-gray/30 to-arctic-mist/30 flex items-center justify-center mb-4 group-hover:scale-110 transition">
                                        <i class="fas fa-calendar-alt text-soft-gray text-2xl"></i>
                                    </div>
                                    <div class="text-snow-veil font-bold mb-1">Events</div>
                                    <div class="text-soft-gray text-sm">Networking</div>
                                </div>
                                
                                <div class="glass-morphism p-6 rounded-2xl hover:bg-snow-veil/5 transition cursor-pointer group">
                                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-snow-veil/30 to-arctic-mist/30 flex items-center justify-center mb-4 group-hover:scale-110 transition">
                                        <i class="fas fa-certificate text-snow-veil text-2xl"></i>
                                    </div>
                                    <div class="text-snow-veil font-bold mb-1">Certificates</div>
                                    <div class="text-soft-gray text-sm">Recognition</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

    <!-- Events Section -->
    <section id="kegiatan" class="py-24 relative">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="glass-morphism inline-block px-5 py-2 rounded-full mb-4 border border-white/20">
                    <span class="text-sm font-semibold text-arctic-mist">Event Terbaru</span>
                </div>
                <h2 class="text-5xl font-bold text-deep-navy mb-4">Kegiatan Mendatang</h2>
                <p class="text-xl text-soft-gray max-w-2xl mx-auto">Jangan lewatkan kesempatan emas untuk berkembang bersama komunitas terbaik</p>
            </div>
            
            @if($events && $events->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($events->take(3) as $index => $event)
                <div class="glass-card rounded-3xl overflow-hidden border border-white/10 card-hover group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <!-- Image -->
                    <div class="relative h-56 overflow-hidden bg-gradient-to-br from-ocean-blue to-deep-navy">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-arctic-mist/30 text-6xl"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-deep-navy/80 to-transparent"></div>
                        
                        <!-- Badges -->
                        <div class="absolute top-4 left-4">
                            <span class="glass-morphism px-3 py-1.5 rounded-full text-xs font-bold text-white border border-white/20">
                                {{ $event->category->icon ?? '📅' }} {{ $event->category->name ?? 'Event' }}
                            </span>
                        </div>
                        
                        <div class="absolute top-4 right-4">
                            @if($event->isFree())
                                <span class="bg-green-500/90 backdrop-blur-sm text-white px-3 py-1.5 rounded-full text-xs font-bold">
                                    GRATIS
                                </span>
                            @else
                                <span class="bg-arctic-mist/90 backdrop-blur-sm text-white px-3 py-1.5 rounded-full text-xs font-bold">
                                    Rp {{ number_format($event->price, 0, ',', '.') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-4 line-clamp-2 group-hover:text-arctic-mist transition">
                            {{ $event->title }}
                        </h3>
                        
                        <div class="space-y-3 mb-5">
                            <div class="flex items-center text-soft-gray text-sm">
                                <i class="fas fa-calendar mr-3 text-arctic-mist"></i>
                                <span>{{ $event->start_date->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center text-soft-gray text-sm">
                                <i class="fas fa-map-marker-alt mr-3 text-arctic-mist"></i>
                                <span class="line-clamp-1">{{ $event->location ?? 'Online' }}</span>
                            </div>
                            <div class="flex items-center text-soft-gray text-sm">
                                <i class="fas fa-users mr-3 text-arctic-mist"></i>
                                <span>{{ $event->registered_count ?? 0 }}/{{ $event->quota }} peserta</span>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        @php
                            $percentage = $event->quota > 0 ? (($event->registered_count ?? 0) / $event->quota) * 100 : 0;
                        @endphp
                        <div class="mb-5">
                            <div class="w-full bg-deep-navy/50 rounded-full h-2">
                                <div class="bg-gradient-to-r from-arctic-mist to-soft-gray h-2 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                        
                        <!-- Button -->
                        <a href="{{ route('events.show', $event->slug) }}" class="group/btn block w-full text-center bg-gradient-to-r from-arctic-mist/10 to-ocean-blue/10 hover:from-arctic-mist hover:to-ocean-blue text-white py-3 rounded-xl font-semibold transition-all duration-300 border border-arctic-mist/20">
                            <span class="flex items-center justify-center">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center">
                <a href="{{ route('events.index') }}" class="btn-primary inline-block px-8 py-4 rounded-xl text-white font-semibold text-lg">
                    Lihat Semua Event <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            @else
            <div class="glass-card p-12 rounded-3xl text-center border border-white/10">
                <i class="fas fa-calendar-times text-arctic-mist/50 text-6xl mb-4"></i>
                <p class="text-xl text-white font-semibold mb-2">Belum ada kegiatan tersedia</p>
                <p class="text-soft-gray">Pantau terus untuk event menarik selanjutnya!</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-24 relative bg-white/30">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="glass-morphism inline-block px-5 py-2 rounded-full mb-4 border border-deep-navy/20">
                    <span class="text-sm font-semibold text-ocean-blue">Tentang Kami</span>
                </div>
                <h2 class="text-5xl font-bold text-deep-navy mb-4">Kenali ImpactHub</h2>
                <p class="text-xl text-soft-gray max-w-2xl mx-auto">Platform yang menghubungkan komunitas untuk menciptakan dampak positif</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center mb-16">
                <div class="space-y-6" data-aos="fade-right">
                    <div class="glass-card p-6 rounded-2xl border border-white/10">
                        <div class="flex items-start space-x-4">
                            <div class="bg-gradient-to-br from-arctic-mist to-ocean-blue w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-bullseye text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white mb-2">Misi Kami</h3>
                                <p class="text-soft-gray">Memberdayakan individu dan organisasi untuk menciptakan perubahan positif melalui kegiatan sosial, pembelajaran, dan kolaborasi.</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-6 rounded-2xl border border-white/10">
                        <div class="flex items-start space-x-4">
                            <div class="bg-gradient-to-br from-ocean-blue to-deep-navy w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-eye text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white mb-2">Visi Kami</h3>
                                <p class="text-soft-gray">Menjadi platform #1 di Indonesia yang menginspirasi dan memfasilitasi aksi nyata untuk dampak sosial yang berkelanjutan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-6 rounded-2xl border border-white/10">
                        <div class="flex items-start space-x-4">
                            <div class="bg-gradient-to-br from-soft-gray to-arctic-mist w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-heart text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white mb-2">Nilai Kami</h3>
                                <p class="text-soft-gray">Integritas, kolaborasi, inovasi, dan komitmen untuk memberikan dampak positif bagi masyarakat.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-8 rounded-3xl border border-white/10" data-aos="fade-left">
                    <h3 class="text-2xl font-bold text-white mb-6">Mengapa ImpactHub?</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-arctic-mist text-xl mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-white mb-1">Platform Terpadu</h4>
                                <p class="text-soft-gray text-sm">Satu tempat untuk semua kebutuhan pengembangan diri dan aksi sosial</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-arctic-mist text-xl mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-white mb-1">Komunitas Solid</h4>
                                <p class="text-soft-gray text-sm">Bergabung dengan ribuan individu yang berpikiran sama</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-arctic-mist text-xl mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-white mb-1">Verifikasi Ketat</h4>
                                <p class="text-soft-gray text-sm">Semua event dan organizer terverifikasi untuk kualitas terjamin</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-arctic-mist text-xl mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-white mb-1">Sertifikat Resmi</h4>
                                <p class="text-soft-gray text-sm">Dapatkan sertifikat digital yang dapat diverifikasi</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-arctic-mist text-xl mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-white mb-1">Dukungan 24/7</h4>
                                <p class="text-soft-gray text-sm">Tim support siap membantu kapanpun Anda membutuhkan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid md:grid-cols-4 gap-6">
                <div class="glass-card p-6 rounded-2xl text-center border border-white/10 hover:scale-105 transition" data-aos="zoom-in" data-aos-delay="0">
                    <div class="text-4xl font-bold text-arctic-mist mb-2">100+</div>
                    <div class="text-soft-gray text-sm">Event Terlaksana</div>
                </div>
                <div class="glass-card p-6 rounded-2xl text-center border border-white/10 hover:scale-105 transition" data-aos="zoom-in" data-aos-delay="100">
                    <div class="text-4xl font-bold text-arctic-mist mb-2">5,000+</div>
                    <div class="text-soft-gray text-sm">Peserta Aktif</div>
                </div>
                <div class="glass-card p-6 rounded-2xl text-center border border-white/10 hover:scale-105 transition" data-aos="zoom-in" data-aos-delay="200">
                    <div class="text-4xl font-bold text-arctic-mist mb-2">50+</div>
                    <div class="text-soft-gray text-sm">Organizer Partner</div>
                </div>
                <div class="glass-card p-6 rounded-2xl text-center border border-white/10 hover:scale-105 transition" data-aos="zoom-in" data-aos-delay="300">
                    <div class="text-4xl font-bold text-arctic-mist mb-2">4.8/5</div>
                    <div class="text-soft-gray text-sm">Rating Kepuasan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-24 relative">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="glass-morphism inline-block px-5 py-2 rounded-full mb-4 border border-white/20">
                    <span class="text-sm font-semibold text-arctic-mist">Hubungi Kami</span>
                </div>
                <h2 class="text-5xl font-bold text-deep-navy mb-4">Mari Terhubung</h2>
                <p class="text-xl text-soft-gray max-w-2xl mx-auto">Punya pertanyaan atau ingin berkolaborasi? Kami siap membantu Anda</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Side - Contact Info & Features -->
                <div class="space-y-6" data-aos="fade-right">
                    <!-- Main Contact Card -->
                    <div class="glass-card p-8 rounded-3xl border border-white/10">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-arctic-mist to-ocean-blue flex items-center justify-center">
                                <i class="fas fa-headset text-white text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white">Dukungan 24/7</h3>
                                <p class="text-soft-gray">Kami siap membantu kapan saja</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition">
                                <i class="fas fa-envelope text-arctic-mist text-xl"></i>
                                <div>
                                    <p class="text-xs text-soft-gray">Email</p>
                                    <p class="text-white font-semibold">info@impacthub.com</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition">
                                <i class="fas fa-phone text-arctic-mist text-xl"></i>
                                <div>
                                    <p class="text-xs text-soft-gray">Telepon</p>
                                    <p class="text-white font-semibold">(021) 1234-5678</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition">
                                <i class="fas fa-map-marker-alt text-arctic-mist text-xl"></i>
                                <div>
                                    <p class="text-xs text-soft-gray">Alamat</p>
                                    <p class="text-white font-semibold">Jakarta, Indonesia</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Why Contact Us -->
                    <div class="glass-card p-6 rounded-2xl border border-white/10">
                        <h4 class="text-lg font-bold text-white mb-4">Mengapa Hubungi Kami?</h4>
                        <div class="space-y-3">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-arctic-mist mt-1"></i>
                                <p class="text-soft-gray text-sm">Respon cepat dalam 1x24 jam</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-arctic-mist mt-1"></i>
                                <p class="text-soft-gray text-sm">Tim profesional dan berpengalaman</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-arctic-mist mt-1"></i>
                                <p class="text-soft-gray text-sm">Solusi terbaik untuk kebutuhan Anda</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="glass-card p-6 rounded-2xl border border-white/10">
                        <h4 class="text-lg font-bold text-white mb-4">Ikuti Kami</h4>
                        <div class="flex space-x-3">
                            <a href="#" class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-arctic-mist hover:border-arctic-mist hover:scale-110 transition-all group">
                                <i class="fab fa-facebook text-soft-gray group-hover:text-white text-lg"></i>
                            </a>
                            <a href="#" class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-arctic-mist hover:border-arctic-mist hover:scale-110 transition-all group">
                                <i class="fab fa-twitter text-soft-gray group-hover:text-white text-lg"></i>
                            </a>
                            <a href="#" class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-arctic-mist hover:border-arctic-mist hover:scale-110 transition-all group">
                                <i class="fab fa-instagram text-soft-gray group-hover:text-white text-lg"></i>
                            </a>
                            <a href="#" class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-arctic-mist hover:border-arctic-mist hover:scale-110 transition-all group">
                                <i class="fab fa-linkedin text-soft-gray group-hover:text-white text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Contact Form -->
                <div data-aos="fade-left">
                    <div class="glass-card p-8 rounded-3xl border border-white/10 shadow-2xl">
                        <div class="text-center mb-6">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-arctic-mist to-ocean-blue mb-4">
                                <i class="fas fa-paper-plane text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Kirim Pesan</h3>
                            <p class="text-soft-gray text-sm">Isi form di bawah dan kami akan segera merespons</p>
                        </div>
                        
                        <form class="space-y-5">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-soft-gray mb-2">
                                        <i class="fas fa-user mr-2 text-arctic-mist"></i>Nama
                                    </label>
                                    <input type="text" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-soft-gray focus:outline-none focus:border-arctic-mist focus:ring-2 focus:ring-arctic-mist/20 transition" placeholder="Nama Anda" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-soft-gray mb-2">
                                        <i class="fas fa-envelope mr-2 text-arctic-mist"></i>Email
                                    </label>
                                    <input type="email" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-soft-gray focus:outline-none focus:border-arctic-mist focus:ring-2 focus:ring-arctic-mist/20 transition" placeholder="email@anda.com" required>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-soft-gray mb-2">
                                    <i class="fas fa-tag mr-2 text-arctic-mist"></i>Subjek
                                </label>
                                <input type="text" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-soft-gray focus:outline-none focus:border-arctic-mist focus:ring-2 focus:ring-arctic-mist/20 transition" placeholder="Topik pesan" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-soft-gray mb-2">
                                    <i class="fas fa-comment-dots mr-2 text-arctic-mist"></i>Pesan
                                </label>
                                <textarea rows="5" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-soft-gray focus:outline-none focus:border-arctic-mist focus:ring-2 focus:ring-arctic-mist/20 transition resize-none" placeholder="Tulis pesan Anda..." required></textarea>
                            </div>
                            
                            <button type="submit" class="w-full btn-primary px-6 py-4 rounded-xl text-white font-semibold text-lg flex items-center justify-center group hover:scale-105 transition-all">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Pesan
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 relative">
        <div class="container mx-auto px-6 relative z-10">
            <div class="glass-card rounded-3xl p-12 text-center border border-white/10 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-arctic-mist/5 to-ocean-blue/5"></div>
                <div class="relative z-10">
                    <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                        Siap Memulai Perjalanan Anda?
                    </h2>
                    <p class="text-xl text-soft-gray mb-10 max-w-2xl mx-auto">
                        Bergabunglah dengan ribuan peserta yang telah mengubah hidupnya melalui ImpactHub
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('register') }}" class="btn-primary px-10 py-4 rounded-xl text-white font-semibold text-lg">
                            Daftar Sekarang Gratis
                        </a>
                        <a href="mailto:info@impacthub.com" class="glass-morphism px-10 py-4 rounded-xl text-white font-semibold text-lg border border-white/20 hover:bg-white/5 transition">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 relative border-t border-deep-navy/20 bg-gradient-to-br from-deep-navy via-ocean-blue to-deep-navy">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-gradient-to-br from-arctic-mist to-ocean-blue w-10 h-10 rounded-xl flex items-center justify-center">
                            <i class="fas fa-water text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-white">ImpactHub</span>
                    </div>
                    <p class="text-soft-gray mb-4 text-sm">Platform terpercaya untuk kegiatan sosial, event, dan bootcamp yang mengembangkan potensi Anda.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-soft-gray hover:text-arctic-mist transition"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="text-soft-gray hover:text-arctic-mist transition"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-soft-gray hover:text-arctic-mist transition"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-soft-gray hover:text-arctic-mist transition"><i class="fab fa-linkedin text-xl"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-4 text-sm">Menu</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#beranda" class="text-soft-gray hover:text-arctic-mist transition">Beranda</a></li>
                        <li><a href="{{ route('events.index') }}" class="text-soft-gray hover:text-arctic-mist transition">Kegiatan</a></li>
                        <li><a href="#tentang" class="text-soft-gray hover:text-arctic-mist transition">Tentang</a></li>
                        <li><a href="#kontak" class="text-soft-gray hover:text-arctic-mist transition">Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-4 text-sm">Kontak</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center"><i class="fas fa-envelope mr-2 text-arctic-mist"></i> info@impacthub.com</li>
                        <li class="flex items-center"><i class="fas fa-phone mr-2 text-arctic-mist"></i> (021) 1234-5678</li>
                        <li class="flex items-center"><i class="fas fa-map-marker-alt mr-2 text-arctic-mist"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-4 text-sm">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white/10 transition"><i class="fab fa-facebook text-lg"></i></a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white/10 transition"><i class="fab fa-twitter text-lg"></i></a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white/10 transition"><i class="fab fa-instagram text-lg"></i></a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white/10 transition"><i class="fab fa-linkedin text-lg"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-white/10 pt-8 mt-8 text-center text-sm text-soft-gray">
                <p>&copy; 2026 ImpactHub. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Scroll-based active navigation
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('nav a[href^="#"]');
            
            function setActiveNav() {
                let current = '';
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (window.pageYOffset >= sectionTop - 200) {
                        current = section.getAttribute('id');
                    }
                });
                
                // Default to beranda if at top of page
                if (window.pageYOffset < 100) {
                    current = 'beranda';
                }
                
                navLinks.forEach(link => {
                    link.classList.remove('text-deep-navy', 'font-semibold', 'border-b-2', 'border-ocean-blue');
                    link.classList.add('text-deep-navy/80');
                    
                    if (link.getAttribute('href') === '#' + current) {
                        link.classList.remove('text-deep-navy/80');
                        link.classList.add('text-deep-navy', 'font-semibold', 'border-b-2', 'border-ocean-blue');
                    }
                });
            }
            
            window.addEventListener('scroll', setActiveNav);
            setActiveNav();
            
            // Smooth scroll behavior
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        const offsetTop = targetSection.offsetTop - 80; // 80px offset for fixed nav
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
