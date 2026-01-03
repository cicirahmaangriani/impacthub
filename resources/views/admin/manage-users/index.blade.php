<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Manage Users</h1>

        <div class="bg-white rounded-2xl shadow-sm p-6 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                <tr class="text-left text-gray-600">
                    <th class="py-2">Name</th>
                    <th class="py-2">Email</th>
                    <th class="py-2">Role</th>
                    <th class="py-2">Created</th>
                </tr>
                </thead>
                <tbody class="divide-y">
                @foreach($users as $user)
                    <tr>
                        <td class="py-2 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="py-2 text-gray-700">{{ $user->email }}</td>
                        <td class="py-2 text-gray-700">{{ $user->role ?? '-' }}</td>
                        <td class="py-2 text-gray-700">{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
