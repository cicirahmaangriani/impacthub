<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hapus Kegiatan: {{ $event->title }}
        </h2>
        <p class="text-gray-600 mt-1">Pastikan bahwa Anda ingin menghapus kegiatan ini secara permanen.</p>
    </x-slot>

    <div class="min-h-screen bg-veil py-10">
        <div class="max-w-3xl mx-auto bg-white p-8 shadow-md rounded-xl">

            <h2 class="text-2xl font-bold text-red-600 mb-4">
                Apakah Anda yakin ingin menghapus event ini?
            </h2>

            <p class="text-frost mb-6 leading-relaxed">
                Event <strong>"{{ $event->title }}"</strong> akan dihapus secara permanen.
                <br>
                Semua data terkait termasuk pendaftaran peserta **akan ikut terhapus**.
                <br><br>
                Tindakan ini <span class="font-bold text-red-500">tidak dapat dipulihkan</span>.
            </p>

            <div class="flex items-center gap-4 mt-6">

                <!-- Tombol Hapus -->
                <form action="{{ route('events.destroy', $event->slug) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="px-6 py-3 bg-current text-white font-semibold rounded-lg shadow hover:bg-abyss transition">
                        Ya, Hapus Permanen
                    </button>
                </form>

                <!-- Tombol Batal -->
                <a href="{{ route('events.edit', $event->slug) }}"
                   class="px-6 py-3 bg-veil text-abyss rounded-lg hover:bg-frost transition">
                    Batal
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
