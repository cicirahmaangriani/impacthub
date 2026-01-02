
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-abyss leading-tight">
            Buat Kegiatan Baru
        </h2>
        <p class="text-frost mt-2">
            Isi informasi lengkap tentang kegiatan yang akan Anda selenggarakan
        </p>
    </x-slot>

    <div class="min-h-screen bg-veil py-8">
        <div class="max-w-7xl mx-auto px-4">

            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid lg:grid-cols-3 gap-6">

                    <!-- MAIN FORM -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- SECTION CARD -->
                        @php
                        function sectionHeader($title) {
                            return "<h2 class='text-lg font-bold text-abyss mb-6'>$title</h2>";
                        }
                        @endphp

                        <!-- BASIC INFO -->
                        <div class="bg-white rounded-xl shadow p-6">
                            {!! sectionHeader('Informasi Dasar') !!}

                            <div class="space-y-5">

                                <div>
                                    <label class="block text-sm font-semibold text-abyss">Judul Kegiatan *</label>
                                    <input type="text" name="title" required
                                        class="w-full px-4 py-3 border border-veil rounded-lg focus:ring-current focus:border-current">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-abyss">Kategori *</label>
                                    <select name="category_id" required
                                        class="w-full px-4 py-3 border border-veil rounded-lg focus:ring-current focus:border-current">
                                        <option disabled selected>— Pilih Kategori —</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-abyss">Tipe Event *</label>
                                    <select name="event_type_id" required
                                        class="w-full px-4 py-3 border border-veil rounded-lg focus:ring-current focus:border-current">
                                        <option disabled selected>— Pilih Tipe Event —</option>
                                        @foreach($eventTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-abyss">Venue *</label>
                                    <div class="grid grid-cols-3 gap-3 mt-2">
                                        @foreach(['offline','online','hybrid'] as $v)
                                        <label class="flex items-center justify-center border border-veil rounded-lg py-2 cursor-pointer hover:bg-veil">
                                            <input type="radio" name="venue_type" value="{{ $v }}" class="mr-2">
                                            {{ ucfirst($v) }}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-abyss">Deskripsi *</label>
                                    <textarea name="description" rows="5" required
                                        class="w-full px-4 py-3 border border-veil rounded-lg focus:ring-current focus:border-current"></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-abyss">Poster *</label>
                                    <input type="file" name="image" required
                                        class="w-full border border-veil rounded-lg p-3">
                                </div>

                            </div>
                        </div>

                        <!-- SCHEDULE -->
                        <div class="bg-white rounded-xl shadow p-6">
                            {!! sectionHeader('Jadwal & Lokasi') !!}

                            <div class="grid md:grid-cols-2 gap-4">
                                <input type="date" name="start_date"
                                    class="w-full px-4 py-3 border border-veil rounded-lg">
                                <input type="date" name="end_date"
                                    class="w-full px-4 py-3 border border-veil rounded-lg">
                            </div>

                            <div class="mt-4">
                                <input type="text" name="location"
                                    class="w-full px-4 py-3 border border-veil rounded-lg"
                                    placeholder="Lokasi">
                            </div>

                            <div class="mt-4">
                                <input type="url" name="meeting_link"
                                    class="w-full px-4 py-3 border border-veil rounded-lg"
                                    placeholder="Link Meeting (opsional)">
                            </div>
                        </div>

                        <!-- REGISTRATION -->
                        <div class="bg-white rounded-xl shadow p-6">
                            {!! sectionHeader('Detail Pendaftaran') !!}

                            <div class="grid md:grid-cols-2 gap-4">
                                <input type="number" name="quota" placeholder="Kuota"
                                    class="w-full px-4 py-3 border border-veil rounded-lg">
                                <input type="number" name="price" placeholder="Harga (0 = Gratis)"
                                    class="w-full px-4 py-3 border border-veil rounded-lg">
                                <input type="datetime-local" name="registration_deadline"
                                    class="w-full px-4 py-3 border border-veil rounded-lg">
                                <input type="number" name="points_reward" placeholder="Point Reward"
                                    class="w-full px-4 py-3 border border-veil rounded-lg">
                            </div>

                            <label class="flex items-center mt-4 space-x-3">
                                <input type="checkbox" name="certificate_available" value="1">
                                <span class="text-sm font-semibold text-abyss">Sediakan Sertifikat</span>
                            </label>
                        </div>

                        <!-- ADDITIONAL -->
                        <div class="bg-white rounded-xl shadow p-6">
                            {!! sectionHeader('Informasi Tambahan') !!}

                            <textarea name="objectives" rows="3"
                                class="w-full px-4 py-3 border border-veil rounded-lg mb-4"
                                placeholder="Tujuan Pembelajaran"></textarea>

                            <textarea name="requirements" rows="3"
                                class="w-full px-4 py-3 border border-veil rounded-lg mb-4"
                                placeholder="Persyaratan"></textarea>

                            <input type="text" name="instructor_info"
                                class="w-full px-4 py-3 border border-veil rounded-lg"
                                placeholder="Pembicara / Instruktur">
                        </div>
                    </div>

                    <!-- SIDEBAR -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-24 bg-white rounded-xl shadow p-6 space-y-3">
                            <button type="submit" name="status" value="published"
                                class="w-full bg-current hover:bg-abyss text-white py-3 rounded-lg font-semibold transition">
                                Publikasikan Kegiatan
                            </button>
                            <button type="submit" name="status" value="draft"
                                class="w-full bg-mist hover:bg-frost text-white py-3 rounded-lg font-semibold transition">
                                Simpan sebagai Draft
                            </button>
                            <button type="button" onclick="window.location='{{ route('dashboard') }}'"
                                class="w-full border border-current text-current py-3 rounded-lg font-semibold hover:bg-veil transition">
                                Kembali ke Menu Dashboard
                            </button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <script>
        // Image preview
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('previewImg').src = event.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
