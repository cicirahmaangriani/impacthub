<x-app-layout>
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center text-sm text-gray-600 mb-4">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Buat Kegiatan Baru
                </h2>
            </x-slot>

            </div>
            <h1 class="text-3xl font-bold text-gray-800">Buat Kegiatan Baru</h1>
            <p class="text-gray-600 mt-2">Isi informasi lengkap tentang kegiatan yang akan Anda selenggarakan</p>
        </div>

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Main Form -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Basic Information -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                            Informasi Dasar
                        </h2>
                        
                        <div class="space-y-5">
                            <!-- Event Title -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Judul Kegiatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Contoh: Workshop Digital Marketing 2025">
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Event Category -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select name="category" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Pilih Kategori</option>
                                    <option value="sosial">Kegiatan Sosial</option>
                                    <option value="event">Event & Seminar</option>
                                    <option value="bootcamp">Bootcamp</option>
                                    <option value="workshop">Workshop</option>
                                    <option value="course">Course</option>
                                    <option value="volunteer">Volunteer</option>
                                </select>
                                @error('category')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Sub-Category -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Sub-Kategori
                                </label>
                                <select name="sub_category"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Pilih Sub-Kategori</option>
                                    <option value="teknologi">Teknologi & IT</option>
                                    <option value="bisnis">Bisnis & Kewirausahaan</option>
                                    <option value="marketing">Digital Marketing</option>
                                    <option value="design">Design & Multimedia</option>
                                    <option value="pendidikan">Pendidikan</option>
                                    <option value="kesehatan">Kesehatan</option>
                                    <option value="lingkungan">Lingkungan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Deskripsi Kegiatan <span class="text-red-500">*</span>
                                </label>
                                <textarea name="description" rows="6" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Jelaskan detail kegiatan, tujuan, materi yang akan dibahas, dan manfaat bagi peserta..."></textarea>
                                @error('description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Event Image -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Banner/Poster Kegiatan <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                            <p class="text-xs text-gray-500">PNG, JPG atau JPEG (MAX. 2MB)</p>
                                        </div>
                                        <input type="file" name="image" class="hidden" accept="image/*" required>
                                    </label>
                                </div>
                                @error('image')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Schedule & Location -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-calendar-alt text-purple-600 mr-3"></i>
                            Jadwal & Lokasi
                        </h2>
                        
                        <div class="space-y-5">
                            <!-- Event Type -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tipe Kegiatan <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-500 transition">
                                        <input type="radio" name="event_type" value="offline" class="mr-3">
                                        <div>
                                            <div class="font-semibold text-gray-800">Offline</div>
                                            <div class="text-xs text-gray-500">Lokasi fisik</div>
                                        </div>
                                    </label>
                                    <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-500 transition">
                                        <input type="radio" name="event_type" value="online" class="mr-3">
                                        <div>
                                            <div class="font-semibold text-gray-800">Online</div>
                                            <div class="text-xs text-gray-500">Via platform digital</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Start Date & Time -->
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tanggal Mulai <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="start_date" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Waktu Mulai <span class="text-red-500">*</span>
                                    </label>
                                    <input type="time" name="start_time" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>

                            <!-- End Date & Time -->
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tanggal Selesai <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="end_date" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Waktu Selesai <span class="text-red-500">*</span>
                                    </label>
                                    <input type="time" name="end_time" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>

                            <!-- Location -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Lokasi/Platform <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="location" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Contoh: Zoom Meeting atau Gedung Serbaguna Jakarta">
                            </div>

                            <!-- Address (for offline) -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Alamat Lengkap <span class="text-gray-500 text-xs">(untuk offline)</span>
                                </label>
                                <textarea name="address" rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Jl. Contoh No. 123, Jakarta Selatan..."></textarea>
                            </div>

                            <!-- Meeting Link (for online) -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Link Meeting <span class="text-gray-500 text-xs">(untuk online)</span>
                                </label>
                                <input type="url" name="meeting_link"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="https://zoom.us/j/...">
                            </div>
                        </div>
                    </div>

                    <!-- Registration Details -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-users text-green-600 mr-3"></i>
                            Detail Pendaftaran
                        </h2>
                        
                        <div class="space-y-5">
                            <!-- Max Participants -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Kuota Peserta <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="max_participants" required min="1"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Contoh: 100">
                            </div>

                            <!-- Registration Fee -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Biaya Pendaftaran <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3 text-gray-500">Rp</span>
                                    <input type="number" name="registration_fee" required min="0"
                                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="0">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Isi 0 jika gratis. Platform akan mengambil komisi 10% dari biaya pendaftaran.
                                </p>
                            </div>

                            <!-- Registration Deadline -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Batas Pendaftaran <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" name="registration_deadline" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- Certificate -->
                            <div>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="has_certificate" value="1"
                                        class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                                    <span class="text-sm font-semibold text-gray-700">
                                        Sediakan Sertifikat Digital untuk Peserta
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-plus-circle text-orange-600 mr-3"></i>
                            Informasi Tambahan
                        </h2>
                        
                        <div class="space-y-5">
                            <!-- Requirements -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Persyaratan Peserta
                                </label>
                                <textarea name="requirements" rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Contoh: Laptop pribadi, Koneksi internet stabil, Pengetahuan dasar programming..."></textarea>
                            </div>

                            <!-- Instructor/Speaker -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Pembicara/Instruktur
                                </label>
                                <input type="text" name="instructor"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Nama pembicara atau instruktur">
                            </div>

                            <!-- Contact Person -->
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nama Contact Person <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="contact_person" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nomor WhatsApp <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" name="contact_phone" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="08xxxxxxxxxx">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        <!-- Preview Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl shadow-sm p-6">
                            <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-eye text-blue-600 mr-2"></i>
                                Preview
                            </h3>
                            <div class="bg-white rounded-lg p-4 mb-4">
                                <div class="bg-gray-200 h-32 rounded-lg mb-3 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-3xl"></i>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                    <div class="h-3 bg-gray-200 rounded w-full"></div>
                                    <div class="h-3 bg-gray-200 rounded w-5/6"></div>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600">
                                <i class="fas fa-info-circle mr-1"></i>
                                Preview akan ditampilkan setelah Anda mengisi form
                            </p>
                        </div>

                        <!-- Tips -->
                        <div class="bg-yellow-50 rounded-xl shadow-sm p-6">
                            <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-lightbulb text-yellow-600 mr-2"></i>
                                Tips
                            </h3>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                    <span>Gunakan judul yang menarik dan deskriptif</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                    <span>Upload banner berkualitas tinggi</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                    <span>Jelaskan manfaat yang didapat peserta</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                    <span>Tentukan kuota sesuai kapasitas</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition mb-3">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Publikasikan Kegiatan
                            </button>
                            <button type="button" class="w-full border-2 border-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                                <i class="fas fa-save mr-2"></i>
                                Simpan sebagai Draft
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</x-app-layout>