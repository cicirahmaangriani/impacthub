<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buat Kegiatan Baru
        </h2>
        <p class="text-gray-600 mt-2">Isi informasi lengkap tentang kegiatan yang akan Anda selenggarakan</p>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4">

            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="grid lg:grid-cols-3 gap-6">

                    <!-- ====================== MAIN FORM ======================= -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- BASIC INFORMATION -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-info-circle text-blue-600 mr-3"></i> Informasi Dasar
                            </h2>

                            <div class="space-y-5">

                                <!-- Title -->
                                <div>
                                    <label class="block text-sm font-semibold">Judul Kegiatan *</label>
                                    <input type="text" name="title" required
                                           class="w-full px-4 py-3 border rounded-lg"
                                           placeholder="Contoh: Workshop Digital Marketing 2025">
                                </div>

                                <!-- Category -->
                                <div>
                                    <label class="block text-sm font-semibold">Kategori *</label>
                                    <select name="category_id" required
                                            class="w-full px-4 py-3 border rounded-lg @error('category_id') border-red-500 @enderror">

                                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>
                                            — Pilih Kategori —
                                        </option>

                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" 
                                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>


    <!-- Event Type ID (online/offline) -->
    <div>
        <label class="block text-sm font-semibold">Tipe Event *</label>
        <select name="event_type_id" required
                class="w-full px-4 py-3 border rounded-lg @error('event_type_id') border-red-500 @enderror">

            <option value="" disabled {{ old('event_type_id') ? '' : 'selected' }}>
                — Pilih Tipe Event —
            </option>

            @foreach($eventTypes as $type)
                <option value="{{ $type->id }}" 
                    {{ old('event_type_id') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>

        @error('event_type_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    <!-- Venue Type -->
    <div>
        <label class="block text-sm font-semibold">Venue *</label>
            <div class="grid grid-cols-2 gap-4">
                <label class="flex items-center p-3 border rounded-lg cursor-pointer">
                    <input type="radio" name="venue_type" value="offline" class="mr-3">
                        Offline
                </label>
                <label class="flex items-center p-3 border rounded-lg cursor-pointer">
                    <input type="radio" name="venue_type" value="online" class="mr-3">
                        Online
                </label>
                <label class="flex items-center p-3 border rounded-lg cursor-pointer">
                        <input type="radio" name="venue_type" value="hybrid" class="mr-3">
                            Hybrid
                </label>
            </div>
   </div>

                                <!-- Description -->
                                <div>
                                    <label class="block text-sm font-semibold">Deskripsi *</label>
                                    <textarea name="description" rows="6" required
                                              class="w-full px-4 py-3 border rounded-lg"
                                              placeholder="Jelaskan detail kegiatan..."></textarea>
                                </div>

                                <!-- Image -->
                                <div>
                                    <label class="block text-sm font-semibold">Poster *</label>
                                    <input type="file" name="image" required accept="image/*"
                                           class="w-full border rounded-lg p-3">
                                </div>
                            </div>
                        </div>

                        <!-- ====================== SCHEDULE ======================= -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-calendar-alt text-purple-600 mr-3"></i> Jadwal & Lokasi
                            </h2>

                            <div class="space-y-5">

                                <!-- Start -->
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-semibold">Tanggal Mulai *</label>
                                        <input type="date" name="start_date" required class="w-full px-4 py-3 border rounded-lg">
                                    </div>
                                    <div>
                                        <label class="text-sm font-semibold">Tanggal Selesai *</label>
                                        <input type="date" name="end_date" required class="w-full px-4 py-3 border rounded-lg">
                                    </div>
                                </div>

                                <!-- Location -->
                                <div>
                                    <label class="text-sm font-semibold">Lokasi *</label>
                                    <input type="text" name="location" required class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <!-- Meeting Link (Online Only) -->
                                <div>
                                    <label class="text-sm font-semibold">Link Meeting (Online)</label>
                                    <input type="url" name="meeting_link" class="w-full px-4 py-3 border rounded-lg">
                                </div>
                            </div>
                        </div>

                        <!-- ====================== REGISTRATION ======================= -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-users text-green-600 mr-3"></i> Detail Pendaftaran
                            </h2>

                            <div class="space-y-5">
                                <!-- Quota -->
                                <div>
                                    <label class="text-sm font-semibold">Kuota Peserta *</label>
                                    <input type="number" name="quota" min="1" required
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <!-- Price -->
                                <div>
                                    <label class="text-sm font-semibold">Biaya *</label>
                                    <input type="number" name="price" min="0" required
                                           class="w-full px-4 py-3 border rounded-lg"
                                           placeholder="0 untuk gratis">
                                </div>

                                <!-- Deadline -->
                                <div>
                                    <label class="text-sm font-semibold">Batas Pendaftaran *</label>
                                    <input type="datetime-local" name="registration_deadline" required
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <!-- Point Reward -->
                                <div>
                                    <label class="text-sm font-semibold">Point Reward</label>
                                    <input type="number" name="points_reward" required
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <!-- Certificate -->
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" name="certificate_available" value="1" class="w-5 h-5">
                                    <span class="text-sm font-semibold">Sediakan Sertifikat</span>
                                </div>

                            </div>
                        </div>

                        <!-- ====================== ADDITIONAL INFO ======================= -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-plus-circle text-orange-600 mr-3"></i> Informasi Tambahan
                            </h2>

                             <div>
                                    <label class="text-sm font-semibold">Tujuan Pembelajaran</label>
                                    <textarea name="objectives" rows="4"
                                              class="w-full px-4 py-3 border rounded-lg"></textarea>
                                </div>

                            <div class="space-y-5">
                                <div>
                                    <label class="text-sm font-semibold">Persyaratan</label>
                                    <textarea name="requirements" rows="4"
                                              class="w-full px-4 py-3 border rounded-lg"></textarea>
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Pembicara / Instruktur</label>
                                    <input type="text" name="instructor_info"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ====================== SIDEBAR ======================= -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-24 space-y-6">

                            <!-- Action Buttons -->
                            <div class="bg-white rounded-xl shadow-sm p-6">
                                <button type="submit" name="status" value="published"
                                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold mb-3">
                                    Publikasikan Kegiatan
                                </button>

                                <button type="submit" name="status" value="draft"
                                        class="w-full border-2 border-gray-300 py-3 rounded-lg font-semibold">
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
