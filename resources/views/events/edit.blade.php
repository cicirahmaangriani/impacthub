<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kegiatan: {{ $event->title }}
        </h2>
        <p class="text-gray-600 mt-2">
            Perbarui informasi kegiatan Anda di bawah ini
        </p>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4">

            <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid lg:grid-cols-3 gap-6">

                    <!-- MAIN FORM -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- BASIC INFO -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-info-circle text-blue-600 mr-3"></i> Informasi Dasar
                            </h2>

                            <div class="space-y-5">

                                <!-- Title -->
                                <div>
                                    <label class="block text-sm font-semibold">Judul Kegiatan *</label>
                                    <input type="text" name="title"
                                           value="{{ old('title', $event->title) }}"
                                           required
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <!-- Category -->
                                <div>
                                    <label class="block text-sm font-semibold">Kategori *</label>
                                    <select name="category_id"
                                            class="w-full px-4 py-3 border rounded-lg">
                                        <option value="" disabled>— Pilih Kategori —</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id', $event->category_id) == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Event Type -->
                                <div>
                                    <label class="block text-sm font-semibold">Tipe Event *</label>
                                    <select name="event_type_id"
                                            class="w-full px-4 py-3 border rounded-lg">

                                        @foreach($eventTypes as $type)
                                            <option value="{{ $type->id }}"
                                                {{ old('event_type_id', $event->event_type_id) == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <!-- Venue Type -->
                                <div>
                                    <label class="block text-sm font-semibold">Venue *</label>
                                    <div class="grid grid-cols-3 gap-4">
                                        @foreach(['offline' => 'Offline', 'online' => 'Online', 'hybrid' => 'Hybrid'] as $key => $label)
                                            <label class="flex items-center p-3 border rounded-lg cursor-pointer">
                                                <input type="radio" name="venue_type" value="{{ $key }}"
                                                    class="mr-3"
                                                    {{ old('venue_type', $event->venue_type) == $key ? 'checked' : '' }}>
                                                {{ $label }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Description -->
                                <div>
                                    <label class="block text-sm font-semibold">Deskripsi *</label>
                                    <textarea name="description" rows="6"
                                              class="w-full px-4 py-3 border rounded-lg">{{ old('description', $event->description) }}</textarea>
                                </div>

                                <!-- Banner -->
                                <div>
                                    <label class="block text-sm font-semibold">Banner</label>
                                    <input type="file" name="image" accept="image/*"
                                           class="w-full border rounded-lg p-3">

                                    @if($event->image)
                                        <p class="text-sm text-gray-600 mt-2">Banner saat ini:</p>
                                        <img src="{{ asset('storage/' . $event->image) }}"
                                             class="w-64 rounded-lg shadow-md mt-2">
                                    @endif
                                </div>

                            </div>
                        </div>

                        <!-- SCHEDULE -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-calendar-alt text-purple-600 mr-3"></i> Jadwal & Lokasi
                            </h2>

                            <div class="space-y-5">

                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-semibold">Tanggal Mulai *</label>
                                        <input type="date" name="start_date"
                                               value="{{ old('start_date', $event->start_date->format('Y-m-d')) }}"
                                               class="w-full px-4 py-3 border rounded-lg">
                                    </div>

                                    <div>
                                        <label class="text-sm font-semibold">Tanggal Selesai *</label>
                                        <input type="date" name="end_date"
                                               value="{{ old('end_date', $event->end_date->format('Y-m-d')) }}"
                                               class="w-full px-4 py-3 border rounded-lg">
                                    </div>
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Lokasi *</label>
                                    <input type="text" name="location"
                                           value="{{ old('location', $event->location) }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Link Meeting (Online)</label>
                                    <input type="url" name="meeting_link"
                                           value="{{ old('meeting_link', $event->meeting_link) }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                            </div>
                        </div>

                        <!-- REGISTRATION -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-users text-green-600 mr-3"></i> Detail Pendaftaran
                            </h2>

                            <div class="space-y-5">
                                <div>
                                    <label class="text-sm font-semibold">Kuota Peserta *</label>
                                    <input type="number" name="quota"
                                           value="{{ old('quota', $event->quota) }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Biaya *</label>
                                    <input type="number" name="price"
                                           value="{{ old('price', $event->price) }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Batas Pendaftaran *</label>
                                    <input type="datetime-local" name="registration_deadline"
                                           value="{{ old('registration_deadline', $event->registration_deadline->format('Y-m-d\TH:i')) }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" name="certificate_available" value="1"
                                           class="w-5 h-5"
                                           {{ old('certificate_available', $event->certificate_available) ? 'checked' : '' }}>
                                    <span class="text-sm font-semibold">Sediakan Sertifikat</span>
                                </div>

                            </div>
                        </div>

                        <!-- Additional -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-plus-circle text-orange-600 mr-3"></i> Informasi Tambahan
                            </h2>

                            <div class="space-y-5">

                                <div>
                                    <label class="text-sm font-semibold">Persyaratan</label>
                                    <textarea name="requirements" rows="4"
                                              class="w-full px-4 py-3 border rounded-lg">{{ old('requirements', $event->requirements) }}</textarea>
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Pembicara / Instruktur</label>
                                    <input type="text" name="instructor_info"
                                           value="{{ old('instructor_info', $event->instructor_info) }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- SIDEBAR -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-24 space-y-6">

                            <div class="bg-white rounded-xl shadow-sm p-6">
                                <button type="submit" name="status" value="published"
                                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold mb-3">
                                    Simpan & Publikasikan
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
