{{-- Form Event yang Reusable --}}
<div class="grid lg:grid-cols-3 gap-6">

    <!-- MAIN FORM -->
    <div class="lg:col-span-2 space-y-6">

        @php
        if (!function_exists('sectionHeader')) {
            function sectionHeader($title) {
                return "<h2 class='text-lg font-bold text-gray-900 mb-6'>$title</h2>";
            }
        }
        @endphp

        <!-- BASIC INFO -->
        <div class="bg-white rounded-xl shadow p-6">
            {!! sectionHeader('Informasi Dasar') !!}

            <div class="space-y-5">

                <div>
                    <label class="block text-sm font-semibold text-gray-900">Judul Kegiatan *</label>
                    <input type="text" name="title" value="{{ old('title', $event->title ?? '') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-ocean-500 focus:border-ocean-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900">Kategori *</label>
                    <select name="category_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-ocean-500 focus:border-ocean-500">
                        <option disabled selected>— Pilih Kategori —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $event->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900">Tipe Event *</label>
                    <select name="event_type_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-ocean-500 focus:border-ocean-500">
                        <option disabled selected>— Pilih Tipe Event —</option>
                        @foreach($eventTypes as $type)
                            <option value="{{ $type->id }}" {{ old('event_type_id', $event->event_type_id ?? '') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900">Venue *</label>
                    <div class="grid grid-cols-3 gap-3 mt-2">
                        @foreach(['offline','online','hybrid'] as $v)
                        <label class="flex items-center justify-center border border-gray-300 rounded-lg py-2 cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="venue_type" value="{{ $v }}" 
                                {{ old('venue_type', $event->venue_type ?? '') == $v ? 'checked' : '' }} class="mr-2">
                            {{ ucfirst($v) }}
                        </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900">Deskripsi *</label>
                    <textarea name="description" rows="5" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-ocean-500 focus:border-ocean-500">{{ old('description', $event->description ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900">Poster {{ isset($event) ? '' : '*' }}</label>
                    <input type="file" name="image" {{ isset($event) ? '' : 'required' }}
                        class="w-full border border-gray-300 rounded-lg p-3">
                    @if(isset($event) && $event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="mt-2 h-32 rounded" alt="Current image">
                    @endif
                </div>

            </div>
        </div>

        <!-- SCHEDULE -->
        <div class="bg-white rounded-xl shadow p-6">
            {!! sectionHeader('Jadwal & Lokasi') !!}

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai *</label>
                    <input type="date" name="start_date" value="{{ old('start_date', isset($event) ? $event->start_date?->format('Y-m-d') : '') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai *</label>
                    <input type="date" name="end_date" value="{{ old('end_date', isset($event) ? $event->end_date?->format('Y-m-d') : '') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $event->location ?? '') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg"
                    placeholder="Lokasi">
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Link Meeting (opsional)</label>
                <input type="url" name="meeting_link" value="{{ old('meeting_link', $event->meeting_link ?? '') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg"
                    placeholder="https://meet.google.com/xxx">
            </div>
        </div>

        <!-- REGISTRATION -->
        <div class="bg-white rounded-xl shadow p-6">
            {!! sectionHeader('Detail Pendaftaran') !!}

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kuota *</label>
                    <input type="number" name="quota" value="{{ old('quota', $event->quota ?? '') }}" required
                        placeholder="Kuota" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga *</label>
                    <input type="number" name="price" value="{{ old('price', $event->price ?? '') }}" required
                        placeholder="0 = Gratis" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deadline Pendaftaran *</label>
                    <input type="date" name="registration_deadline" 
                        value="{{ old('registration_deadline', isset($event) ? $event->registration_deadline?->format('Y-m-d') : '') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Point Reward</label>
                    <input type="number" name="points_reward" value="{{ old('points_reward', $event->points_reward ?? '') }}"
                        placeholder="Point Reward" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                </div>
            </div>

            <label class="flex items-center mt-4 space-x-3">
                <input type="checkbox" name="certificate_available" value="1" 
                    {{ old('certificate_available', $event->certificate_available ?? false) ? 'checked' : '' }}>
                <span class="text-sm font-semibold text-gray-900">Sediakan Sertifikat</span>
            </label>
        </div>

        <!-- ADDITIONAL -->
        <div class="bg-white rounded-xl shadow p-6">
            {!! sectionHeader('Informasi Tambahan') !!}

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tujuan Pembelajaran</label>
                    <textarea name="objectives" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg"
                        placeholder="Tujuan Pembelajaran">{{ old('objectives', $event->objectives ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Persyaratan</label>
                    <textarea name="requirements" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg"
                        placeholder="Persyaratan">{{ old('requirements', $event->requirements ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pembicara / Instruktur</label>
                    <input type="text" name="instructor_info" value="{{ old('instructor_info', $event->instructor_info ?? '') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg"
                        placeholder="Pembicara / Instruktur">
                </div>
            </div>
        </div>
    </div>

    <!-- SIDEBAR -->
    <div class="lg:col-span-1">
        <div class="sticky top-24 bg-white rounded-xl shadow p-6 space-y-3">
            <button type="submit" name="status" value="published"
                class="w-full bg-ocean-500 hover:bg-ocean-600 text-white py-3 rounded-lg font-semibold transition">
                {{ isset($event) ? 'Update & Publikasikan' : 'Publikasikan Kegiatan' }}
            </button>
            <button type="submit" name="status" value="draft"
                class="w-full bg-gray-400 hover:bg-gray-500 text-white py-3 rounded-lg font-semibold transition">
                Simpan sebagai Draft
            </button>
            <button type="button" onclick="history.back()"
                class="w-full border border-ocean-500 text-ocean-500 py-3 rounded-lg font-semibold hover:bg-ocean-50 transition">
                Batal
            </button>
        </div>
    </div>

</div>
