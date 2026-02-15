@php
    use Illuminate\Support\Facades\Auth;
@endphp


<nav x-data="{ open: false }"
     class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">


    <!-- ================= PRIMARY NAV ================= -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">


            <!-- LEFT -->
            <div class="flex">


                <!-- LOGO -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <x-application-logo
                            class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>


                <!-- DESKTOP MENU -->
                <div class="hidden sm:flex sm:ms-10 space-x-8">
                    <a href="{{ url('/') }}" class="text-gray-700 dark:text-gray-200">
                        Beranda
                    </a>
                </div>
            </div>


            <!-- RIGHT -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">


                {{-- ================= AUTH USER ================= --}}
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 text-sm font-medium
                                       text-gray-500 dark:text-gray-400
                                       bg-white dark:bg-gray-800
                                       hover:text-gray-700 dark:hover:text-gray-300
                                       rounded-md transition">


                                <span>{{ Auth::user()->name }}</span>


                                <svg class="ms-2 h-4 w-4 fill-current"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>


                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>


                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link
                                    :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth


                {{-- ================= GUEST ================= --}}
                @guest
                    <a href="{{ route('login') }}"
                       class="text-sm text-gray-700 dark:text-gray-200">
                        Login
                    </a>
                @endguest


            </div>


            <!-- HAMBURGER -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                        class="p-2 rounded-md text-gray-400 hover:text-gray-500
                               hover:bg-gray-100 dark:hover:bg-gray-900">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path
                            :class="{ 'hidden': open, 'inline-flex': !open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path
                            :class="{ 'hidden': !open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>


        </div>
    </div>


    <!-- ================= MOBILE MENU ================= -->
    <div x-show="open" class="sm:hidden">


        @auth
            <div class="px-4 py-3 border-t">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                    {{ Auth::user()->name }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>
            </div>
        @endauth


        @guest
            <div class="px-4 py-3 border-t">
                <a href="{{ route('login') }}"
                   class="block text-gray-700 dark:text-gray-200">
                    Login
                </a>
            </div>
        @endguest


    </div>
</nav>
