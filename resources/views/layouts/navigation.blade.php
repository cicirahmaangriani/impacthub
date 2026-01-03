<nav x-data="{ open: false }" class="shadow-lg" style="background: rgba(0, 56, 90, 0.98); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(106, 144, 180, 0.2); position: relative; z-index: 1000;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="transition-transform hover:scale-105">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                    </a>
                </div>

                <!-- Nav Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-all duration-300 {{ request()->routeIs('home') ? 'text-white border-b-2' : 'text-snow-veil hover:text-white' }}" style="{{ request()->routeIs('home') ? 'border-color: #d2dbcb;' : '' }}">
                        Beranda
                    </a>

                    <a href="{{ route('events.index') }}"
                       class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-all duration-300 {{ request()->routeIs('events.*') ? 'text-white border-b-2' : 'text-snow-veil hover:text-white' }}" style="{{ request()->routeIs('events.*') ? 'border-color: #d2dbcb;' : '' }}">
                        Kegiatan
                    </a>
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <!-- Dashboard shortcut -->
                    <a href="{{ route('dashboard') }}"
                       class="mr-4 inline-flex items-center px-4 py-2 text-white text-sm font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1" style="background: #6a90b4;">
                        Dashboard
                    </a>

                    <!-- User Dropdown -->
                    <div style="position: relative; z-index: 99999;">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white transition ease-in-out duration-300" style="background: rgba(106, 144, 180, 0.3); backdrop-filter: blur(10px);" onmouseover="this.style.background='rgba(106, 144, 180, 0.5)'" onmouseout="this.style.background='rgba(106, 144, 180, 0.3)'">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center px-4 py-2 text-white text-sm font-semibold rounded-lg transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5" style="background: #6a90b4; box-shadow: 0 10px 30px rgba(1, 22, 43, 0.25);">
                        Masuk
                    </a>
                @endguest

            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-snow-veil transition" style="background: rgba(106, 144, 180, 0.2);">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background: rgba(1, 22, 43, 0.98);">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('home') }}" class="block py-2 text-sm {{ request()->routeIs('home') ? 'font-semibold border-l-4 pl-3' : '' }} text-white" style="{{ request()->routeIs('home') ? 'border-color: #d2dbcb;' : '' }}">Beranda</a>
            <a href="{{ route('events.index') }}" class="block py-2 text-sm {{ request()->routeIs('events.*') ? 'font-semibold border-l-4 pl-3' : '' }} text-white" style="{{ request()->routeIs('events.*') ? 'border-color: #d2dbcb;' : '' }}">Kegiatan</a>
        </div>

        <div class="pt-4 pb-3 border-t px-4" style="border-color: rgba(210, 219, 203, 0.2);">
            @auth
                <div class="mb-3">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm" style="color: #d2dbcb;">{{ Auth::user()->email }}</div>
                </div>

                <a href="{{ route('dashboard') }}" class="block py-2 text-sm text-white font-semibold">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="block py-2 text-sm text-white">Profile</a>

                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 text-sm" style="color: #ff6b6b;">
                        Log Out
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="block py-2 text-sm text-white font-semibold">Masuk</a>
            @endguest
        </div>
    </div>
</nav>
