<div id="events" class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <form action="{{ route('events.index') }}" method="GET">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari Event</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul event..." class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category_id" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->icon }} {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Event</label>
                <select name="event_type_id" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Semua Tipe</option>
                    @foreach($eventTypes as $type)
                        <option value="{{ $type->id }}" {{ request('event_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <select name="venue_type" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Semua Lokasi</option>
                    <option value="online" {{ request('venue_type') == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="offline" {{ request('venue_type') == 'offline' ? 'selected' : '' }}>Offline</option>
                    <option value="hybrid" {{ request('venue_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <select name="price_filter" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Semua Harga</option>
                    <option value="free" {{ request('price_filter') == 'free' ? 'selected' : '' }}>Gratis</option>
                    <option value="paid" {{ request('price_filter') == 'paid' ? 'selected' : '' }}>Berbayar</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Urutkan</label>
                <select name="sort_by" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="start_date" {{ request('sort_by') == 'start_date' ? 'selected' : '' }}>Tanggal Mulai</option>
                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                    <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Harga</option>
                    <option value="registered_count" {{ request('sort_by') == 'registered_count' ? 'selected' : '' }}>Paling Populer</option>
                </select>
            </div>

            <div class="flex items-end space-x-2">
                <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                    Filter
                </button>
                <a href="{{ route('events.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Reset
                </a>
            </div>
        </div>
    </form>
</div>
