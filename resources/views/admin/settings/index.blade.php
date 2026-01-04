<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">System Settings</h1>
                <p class="text-gray-600 mt-1">Kelola konfigurasi dan pengaturan sistem</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 text-green-700 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm p-4 sticky top-24">
                    <nav class="space-y-1">
                        <a href="#general" class="flex items-center px-4 py-3 text-sm font-medium text-gray-900 bg-ocean-50 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            General
                        </a>
                        <a href="#events" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Event Settings
                        </a>
                        <a href="#payment" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Payment
                        </a>
                        <a href="#maintenance" class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            </svg>
                            Maintenance
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- General Settings -->
                <div id="general" class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">General Settings</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Application Name</label>
                            <input type="text" value="{{ $settings['app_name'] }}" disabled
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                            <p class="text-xs text-gray-500 mt-1">Ubah di file .env (APP_NAME)</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Environment</label>
                            <input type="text" value="{{ $settings['app_env'] }}" disabled
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                            <p class="text-xs text-gray-500 mt-1">Current: {{ config('app.env') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Debug Mode</label>
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    {{ config('app.debug') ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ config('app.debug') ? 'ON' : 'OFF' }}
                                </span>
                                <p class="text-xs text-gray-500 ml-3">Ubah di file .env (APP_DEBUG)</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                            <input type="text" value="{{ config('app.timezone') }}" disabled
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                        </div>
                    </div>
                </div>

                <!-- Event Settings -->
                <div id="events" class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Event Settings</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Default Quota</label>
                                <input type="number" value="100" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                                <p class="text-xs text-gray-500 mt-1">Quota default untuk event baru</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Default Points Reward</label>
                                <input type="number" value="10" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                                <p class="text-xs text-gray-500 mt-1">Point default untuk peserta</p>
                            </div>
                        </div>

                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" disabled class="rounded border-gray-300 text-ocean-500 focus:ring-ocean-500">
                                <span class="ml-2 text-sm text-gray-700">Require approval for new events</span>
                            </label>
                            <p class="text-xs text-gray-500 mt-1 ml-6">Event harus disetujui admin sebelum publish</p>
                        </div>

                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" disabled class="rounded border-gray-300 text-ocean-500 focus:ring-ocean-500">
                                <span class="ml-2 text-sm text-gray-700">Auto-approve participant registrations</span>
                            </label>
                            <p class="text-xs text-gray-500 mt-1 ml-6">Registrasi langsung confirmed tanpa approval</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Settings -->
                <div id="payment" class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Payment Settings</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Midtrans Server Key</label>
                            <input type="password" value="{{ str_repeat('•', 32) }}" disabled
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                            <p class="text-xs text-gray-500 mt-1">Konfigurasi di file .env (MIDTRANS_SERVER_KEY)</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Midtrans Client Key</label>
                            <input type="password" value="{{ str_repeat('•', 32) }}" disabled
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                            <p class="text-xs text-gray-500 mt-1">Konfigurasi di file .env (MIDTRANS_CLIENT_KEY)</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Environment</label>
                            <select disabled class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                                <option>Sandbox</option>
                                <option>Production</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Current: {{ config('midtrans.is_production') ? 'Production' : 'Sandbox' }}</p>
                        </div>
                    </div>
                </div>

                <!-- System Maintenance -->
                <div id="maintenance" class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">System Maintenance</h2>
                    <div class="space-y-4">
                        
                        <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                <div class="ml-3 flex-1">
                                    <h3 class="text-sm font-medium text-blue-900">Clear Cache</h3>
                                    <p class="text-sm text-blue-700 mt-1">Bersihkan cache aplikasi, config, view, dan route</p>
                                    <form action="{{ route('admin.settings.clear-cache') }}" method="POST" class="mt-3">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
                                            Clear All Cache
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                </svg>
                                <div class="ml-3 flex-1">
                                    <h3 class="text-sm font-medium text-green-900">Optimize Application</h3>
                                    <p class="text-sm text-green-700 mt-1">Optimasi dan cache config, route, dan view untuk performa lebih baik</p>
                                    <form action="{{ route('admin.settings.optimize') }}" method="POST" class="mt-3">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm font-medium">
                                            Optimize App
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <div class="ml-3 flex-1">
                                    <h3 class="text-sm font-medium text-gray-900">System Information</h3>
                                    <div class="mt-2 text-sm text-gray-600 space-y-1">
                                        <p>Laravel Version: <span class="font-medium">{{ app()->version() }}</span></p>
                                        <p>PHP Version: <span class="font-medium">{{ PHP_VERSION }}</span></p>
                                        <p>Storage Path: <span class="font-mono text-xs">{{ storage_path() }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
