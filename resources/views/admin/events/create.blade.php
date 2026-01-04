<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Create Event (Admin)</h1>

            @if ($errors->any())
                <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-700 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.events.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input name="title" value="{{ old('title') }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                </div>

                @if(isset($categories) && $categories->count())
                <div>
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" class="mt-1 w-full rounded-lg border-gray-300" required>
                        <option value="">-- pilih --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                @if(isset($types) && $types->count())
                <div>
                    <label class="block text-sm font-medium text-gray-700">Event Type</label>
                    <select name="event_type_id" class="mt-1 w-full rounded-lg border-gray-300" required>
                        <option value="">-- pilih --</option>
                        @foreach($types as $t)
                            <option value="{{ $t->id }}" @selected(old('event_type_id') == $t->id)>{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="4" class="mt-1 w-full rounded-lg border-gray-300">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" name="price" value="{{ old('price', 0) }}" class="mt-1 w-full rounded-lg border-gray-300" min="0">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Quota</label>
                        <input type="number" name="quota" value="{{ old('quota') }}" class="mt-1 w-full rounded-lg border-gray-300" min="1">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Location</label>
                    <input name="location" value="{{ old('location') }}" class="mt-1 w-full rounded-lg border-gray-300">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="datetime-local" name="start_date" value="{{ old('start_date') }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="datetime-local" name="end_date" value="{{ old('end_date') }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                    </div>
                </div>
                <div>
                     <label class="block text-sm font-medium text-gray-700">Registration Deadline (opsional)</label>
                    <input type="datetime-local" name="registration_deadline"
                     value="{{ old('registration_deadline') }}"
                    class="mt-1 w-full rounded-lg border-gray-300">
                </div>


                <div class="flex items-center gap-2 pt-4">
                    <a href="{{ route('admin.events.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                        Batal
                    </a>
                    <button class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
