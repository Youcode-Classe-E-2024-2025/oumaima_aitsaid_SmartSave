<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SaveSmart</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .navbar-dropdown {
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
            opacity: 0;
            transform: translateY(-10px);
            pointer-events: none;
        }
        .navbar-dropdown.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
    </style>
</head>
<body class="bg-[#ECF0F1]"> <!-- Arrière-plan principal (Blanc) -->
    <div id="app">
        <!-- Navigation Bar -->
        <nav class="bg-[#2C3E50] shadow-lg"> <!-- Bleu foncé pour la navigation -->
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <a class="text-2xl font-bold text-[#ECF0F1] hover:text-[#27AE60] transition duration-300" href="{{ url('/') }}">
                        SaveSmart
                    </a>

                    <!-- Mobile Menu Button -->
                    <button class="lg:hidden p-2 focus:outline-none" id="mobile-menu-button">
                        <svg class="w-6 h-6 text-[#ECF0F1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>

                    <!-- Navigation Links -->
                    <div class="hidden lg:flex items-center space-x-8">
                        <!-- Additional Links -->
                        <a href="#features" class="text-[#ECF0F1] hover:text-[#27AE60] transition duration-300">Fonctionnalités</a>
                        <a href="#pricing" class="text-[#ECF0F1] hover:text-[#27AE60] transition duration-300">Tarifs</a>
                        <a href="#testimonials" class="text-[#ECF0F1] hover:text-[#27AE60] transition duration-300">Témoignages</a>
                        <a href="#faq" class="text-[#ECF0F1] hover:text-[#27AE60] transition duration-300">FAQ</a>

                        <!-- Auth Links -->
                        @guest
                            @if (Route::has('login'))
                                <a class="text-[#ECF0F1] hover:text-[#27AE60] transition duration-300" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @endif

                            @if (Route::has('register'))
                                <a class="bg-[#27AE60] text-[#ECF0F1] px-4 py-2 rounded-md hover:bg-[#219653] transition duration-300" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                        <li class="nav-item">
                  <a class="text-[#ECF0F1] hover:text-[#27AE60] transition duration-300"  href="{{ route('settings.index') }}">Settings</a>
                          </li>
                            <div class="relative">
                                <button id="navbarDropdown" class="flex items-center space-x-2 focus:outline-none" onclick="toggleDropdown()">
                                    <span class="text-[#ECF0F1]">{{ Auth::user()->name }}</span>
                                    <svg class="fill-current h-4 w-4 text-[#ECF0F1]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </button>
                                <!-- Dropdown Menu -->
                                <div id="dropdownMenu" class="navbar-dropdown absolute right-0 mt-2 w-48 bg-[#2C3E50] rounded-md shadow-lg z-10">
                                    <a class="block py-2 px-4 text-sm text-[#ECF0F1] hover:bg-[#34495E] transition duration-300" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div class="lg:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <!-- Additional Links -->
                    <a href="#features" class="block text-[#ECF0F1] hover:text-[#27AE60]">Fonctionnalités</a>
                    <a href="#pricing" class="block text-[#ECF0F1] hover:text-[#27AE60]">Tarifs</a>
                    <a href="#testimonials" class="block text-[#ECF0F1] hover:text-[#27AE60]">Témoignages</a>
                    <a href="#faq" class="block text-[#ECF0F1] hover:text-[#27AE60]">FAQ</a>

                    <!-- Auth Links -->
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="block text-[#ECF0F1] hover:text-[#27AE60]">{{ __('Login') }}</a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block text-[#ECF0F1] hover:text-[#27AE60]">{{ __('Register') }}</a>
                        @endif
                    @else
                        <a href="{{ route('logout') }}" class="block text-[#ECF0F1] hover:text-[#27AE60]"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8">
            @if(session('success'))
                <div class="bg-[#27AE60] border-l-4 border-[#219653] text-[#ECF0F1] p-4 mb-6 rounded" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-[#C0392B] border-l-4 border-[#A5281B] text-[#ECF0F1] p-4 mb-6 rounded" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- JavaScript for Dropdown and Mobile Menu -->
    <script>
        // Toggle Dropdown
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.classList.toggle('show');
        }

        // Close Dropdown on Click Outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdownMenu');
            const button = document.getElementById('navbarDropdown');
            if (!button.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Toggle Mobile Menu
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>