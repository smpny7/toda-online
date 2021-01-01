<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('home') }}">
                        <x-jet-application-mark/>
                        <h1 class="font-medium inline-block ml-3 relative text-lg top-0.5 tracking-wider">戸田塾</h1>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 lg:-my-px lg:ml-10 lg:flex">
                    @include('layouts/x-jet-nav-link')
                </div>
            </div>

            <div class="flex">
                <!-- Search Box -->
                <form action="{{ route('search') }}" method="GET" class="hidden lg:block relative">
                    <input type="text" name="keyword" placeholder="検索" required
                           class="bg-gray-100 h-9 mt-4 pl-3 placeholder-gray-500 rounded-lg text-gray-500 text-sm lg:w-64 xl:w-80 transition duration-500 ease-in-out focus:outline-none focus:shadow">
                    <button type="submit" class="absolute mt-4 right-0 top-2 focus:outline-none" value="検索">
                        <img src="{{ asset('img/search.png') }}" class="w-1/2" alt="search">
                    </button>
                </form>

                <!-- Settings Dropdown -->
                <div class="hidden lg:flex lg:items-center lg:ml-6">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-10 w-10 rounded-full object-cover"
                                         src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                                </button>
                            @else
                                <button
                                    class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Management -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Team Settings') }}
                                </x-jet-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                        {{ __('Create New Team') }}
                                    </x-jet-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-jet-switchable-team :team="$team"/>
                                @endforeach

                                <div class="border-t border-gray-100"></div>
                        @endif

                        <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                     onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center lg:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @include('layouts/x-jet-responsive-nav-link')
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                         alt="{{ Auth::user()->name }}"/>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                                           :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                                               :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

            <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                                               :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('teams.create') }}"
                                               :active="request()->routeIs('teams.create')">
                        {{ __('Create New Team') }}
                    </x-jet-responsive-nav-link>

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link"/>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
