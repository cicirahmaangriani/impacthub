<x-app-layout>

    <!-- Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kegiatan: {{ $event->title }}
        </h2>
        <p class="text-gray-600 mt-1">Perbarui informasi kegiatan Anda di bawah ini.</p>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4">

            <!-- FORM UPDATE -->
            <form action="{{ route('events.update', $event->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid lg:grid-cols-3 gap-6">

                    <!-- MAIN FORM -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- Informasi Dasar -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold mb-4">Informasi Dasar</h2>

                            <div class="space-y-4">

                                <!-- Title -->
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Judul Kegiatan *</label>
                                    <input type="text" name="title"
                                           value="{{ old('title', $event->title) }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <!-- Category -->
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Kategori *</label>
                                    <select name="category_id"
                                            class="w-full px-4 py-3 border rounded-lg">
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ $event->category_id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Event Type -->
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Tipe Event *</label>
                                    <select name="event_type_id"
                                            class="w-full px-4 py-3 border rounded-lg">
                                        @foreach($eventTypes as $type)
                                            <option value="{{ $type->id }}"
                                                {{ $event->event_type_id == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Venue -->
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Venue *</label>

                                    <div class="grid grid-cols-3 gap-3">
                                        @foreach(['offline' => 'Offline', 'online' => 'Online', 'hybrid' => 'Hybrid'] as $key => $label)
                                            <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer">
                                                <input type="radio" name="venue_type" value="{{ $key }}"
                                                    {{ $event->venue_type === $key ? 'checked' : '' }}>
                                                {{ $label }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Description -->
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Deskripsi *</label>
                                    <textarea name="description" rows="6"
                                              class="w-full px-4 py-3 border rounded-lg">{{ old('description', $event->description) }}</textarea>
                                </div>

                                <!-- Banner -->
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Poster</label>
                                    <input type="file" name="image" class="w-full p-3 border rounded-lg">

                                    @if($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}"
                                             class="mt-3 w-64 rounded-lg shadow-md">
                                    @endif
                                </div>

                            </div>
                        </div>

                        <!-- Jadwal & Lokasi -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold mb-4">Jadwal & Lokasi</h2>

                            <div class="space-y-4">

                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-semibold">Tanggal Mulai *</label>
                                        <input type="date" name="start_date"
                                               value="{{ $event->start_date->format('Y-m-d') }}"
                                               class="w-full px-4 py-3 border rounded-lg">
                                    </div>

                                    <div>
                                        <label class="text-sm font-semibold">Tanggal Selesai *</label>
                                        <input type="date" name="end_date"
                                               value="{{ $event->end_date->format('Y-m-d') }}"
                                               class="w-full px-4 py-3 border rounded-lg">
                                    </div>
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Lokasi *</label>
                                    <input type="text" name="location"
                                           value="{{ $event->location }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Link Meeting (Online)</label>
                                    <input type="url" name="meeting_link"
                                           value="{{ $event->meeting_link }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                            </div>
                        </div>

                        <!-- Detail Pendaftaran -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold mb-4">Detail Pendaftaran</h2>

                            <div class="space-y-4">

                                <div>
                                    <label class="text-sm font-semibold">Kuota Peserta *</label>
                                    <input type="number" name="quota"
                                           value="{{ $event->quota }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Biaya *</label>
                                    <input type="number" name="price"
                                           value="{{ $event->price }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Batas Pendaftaran *</label>
                                    <input type="datetime-local" name="registration_deadline"
                                           value="{{ $event->registration_deadline->format('Y-m-d\TH:i') }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Point Reward</label>
                                    <input type="number" name="points_reward"
                                           value="{{ $event->points_reward }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                                <div class="flex items-center gap-2">
                                    <input type="checkbox" name="certificate_available" value="1"
                                           {{ $event->certificate_available ? 'checked' : '' }}>
                                    <span class="text-sm font-semibold">Sediakan Sertifikat</span>
                                </div>

                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold mb-4">Informasi Tambahan</h2>

                            <div class="space-y-4">

                                <div>
                                    <label class="text-sm font-semibold">Tujuan Event</label>
                                    <textarea name="objectives" rows="4"
                                              class="w-full px-4 py-3 border rounded-lg">{{ $event->objectives }}</textarea>
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Persyaratan</label>
                                    <textarea name="requirements" rows="4"
                                              class="w-full px-4 py-3 border rounded-lg">{{ $event->requirements }}</textarea>
                                </div>

                                <div>
                                    <label class="text-sm font-semibold">Pembicara / Instruktur</label>
                                    <input type="text" name="instructor_info"
                                           value="{{ $event->instructor_info }}"
                                           class="w-full px-4 py-3 border rounded-lg">
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- SIDEBAR -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24 space-y-4">

                            <button type="submit" name="status" value="published"
                                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold">
                                Simpan & Publikasikan
                            </button>

                            <button type="submit" name="status" value="draft"
                                    class="w-full border border-gray-300 py-3 rounded-lg font-semibold">
                                Simpan sebagai Draft
                            </button>

                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>

</x-app-layout>
