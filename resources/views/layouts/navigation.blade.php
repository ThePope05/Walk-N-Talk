<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <!-- ========== Top navigation (desktop) ========== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left: Logo + primary nav links -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Primary nav links (desktop) -->
                <div class="hidden sm:flex sm:items-center sm:ms-10 space-x-8">

                    {{-- Dashboard (altijd voor ingelogden) --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @auth
                        {{-- Mijn profiel (read-only pagina /me) --}}
                        <x-nav-link :href="route('me.show')" :active="request()->routeIs('me.show')">
                            Mijn profiel
                        </x-nav-link>

                        {{-- Studenten: lijst van alle users (read-only) --}}
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                            {{ __('Studenten') }}
                        </x-nav-link>

                        {{-- Alleen zichtbaar voor admins: Gebruikersbeheer in /admin --}}
                        @if(auth()->user()->is_admin)
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                {{ __('Gebruikersbeheer') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right: User dropdown (desktop) -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">

                    <!-- Trigger -->
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <!-- Content -->
                    <x-slot name="content">
                        {{-- Mijn profiel (read-only) --}}
                        <x-dropdown-link :href="route('me.show')">
                            👤 {{ __('Mijn profiel') }}
                        </x-dropdown-link>

                        {{-- Profiel bewerken --}}
                        <x-dropdown-link :href="route('profile.edit')">
                            ✏️ {{ __('Profiel bewerken') }}
                        </x-dropdown-link>

                        {{-- Studentenlijst (zelfde als de top-link) --}}
                        <x-dropdown-link :href="route('users.index')">
                            👥 {{ __('Studenten') }}
                        </x-dropdown-link>

                        {{-- Alleen admins: Gebruikersbeheer --}}
                        @if(auth()->user()->is_admin)
                            <x-dropdown-link :href="route('admin.users.index')">
                                🛠️ {{ __('Gebruikersbeheer') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>

                </x-dropdown>
            </div>
            @endauth

            <!-- Hamburger (mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
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

    <!-- ========== Mobile navigation (when hamburger open) ========== -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- Primary links (mobile) -->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('me.show')" :active="request()->routeIs('me.show')">
                    {{ __('Mijn profiel') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    {{ __('Studenten') }}
                </x-responsive-nav-link>

                @if(auth()->user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                        {{ __('Gebruikersbeheer') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- User box + logout (mobile) -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profiel bewerken') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
