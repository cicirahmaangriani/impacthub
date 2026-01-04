<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Manage Users</h1>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-50 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filter & Search -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <form method="GET" action="{{ route('admin.manage-users.index') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau email..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-ocean-500 focus:border-ocean-500"
                    >
                </div>
                <div class="min-w-[150px]">
                    <select 
                        name="role" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-ocean-500 focus:border-ocean-500"
                    >
                        <option value="">Semua Role</option>
                        <option value="participant" {{ request('role') === 'participant' ? 'selected' : '' }}>Participant</option>
                        <option value="organizer" {{ request('role') === 'organizer' ? 'selected' : '' }}>Organizer</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <button type="submit" class="px-6 py-2 bg-ocean-500 text-white rounded-lg hover:bg-ocean-600">
                    Filter
                </button>
                @if(request('search') || request('role'))
                    <a href="{{ route('admin.manage-users.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                <tr class="text-left text-gray-600 border-b">
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">Role</th>
                    <th class="py-3 px-4">Created</th>
                    <th class="py-3 px-4">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            <form method="POST" action="{{ route('admin.manage-users.update-role', $user->id) }}" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <select 
                                    name="role" 
                                    onchange="this.form.submit()"
                                    class="px-3 py-1 border border-gray-300 rounded-lg text-sm focus:ring-ocean-500 focus:border-ocean-500
                                        {{ $user->role === 'admin' ? 'bg-red-50 text-red-700 border-red-200' : '' }}
                                        {{ $user->role === 'organizer' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                        {{ $user->role === 'participant' ? 'bg-green-50 text-green-700 border-green-200' : '' }}"
                                    {{ $user->id === auth()->id() ? 'disabled' : '' }}
                                >
                                    <option value="participant" {{ $user->role === 'participant' ? 'selected' : '' }}>Participant</option>
                                    <option value="organizer" {{ $user->role === 'organizer' ? 'selected' : '' }}>Organizer</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </form>
                        </td>
                        <td class="py-3 px-4 text-gray-700">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="py-3 px-4">
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.manage-users.destroy', $user->id) }}" 
                                      onsubmit="return confirm('Yakin hapus user {{ $user->name }}?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">
                                        Hapus
                                    </button>
                                </form>
                            @else
                                <span class="text-sm text-gray-400">You</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500">
                            Tidak ada user ditemukan.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
