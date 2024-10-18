<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    @stack('css')
</head>

<body class="bg-gray-100 overflow-x-hidden">
    <!-- Mobile Navbar -->
    <div class="md:hidden bg-blue-600 text-white flex items-center justify-between px-4 py-3">
        <h1 class="text-lg font-bold">Admin Panel</h1>
        <button id="menu-toggle" class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar"
            class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="flex items-center justify-center h-16 bg-gray-900">
                <h1 class="text-2xl font-semibold">Admin</h1>
            </div>
            <nav class="mt-10">
                <ul class="flex flex-col">
                    <!-- Home Admin Menu -->
                    <li class="py-3 px-5">
                        <a class="flex items-center text-gray-400 hover:bg-blue-700 hover:text-white rounded-lg py-2 px-4 {{ request()->routeIs('homeAdmin') ? 'bg-blue-500 text-white' : '' }}"
                            href="{{ route('homeAdmin') }}">
                            <i class="ri-dashboard-2-line mr-2"></i>Dashboard
                        </a>
                    </li>
                    <!-- Kelola User Dropdown Menu -->
                    <div class="relative py-3 px-5">
                        <button onclick="toggleDropdownUser()"
                            class="w-full text-left text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg py-2 px-4 focus:outline-none"
                            type="button">
                            <i class="ri-arrow-down-s-line mr-2"></i>
                            Kelola User
                        </button>
                        <ul id="dropdown-user-menu" class="hidden bg-gray-700 mt-1 text-white">
                            <li><a class="block px-4 py-2 hover:bg-blue-600 {{ request()->routeIs('kelolaCustomer') ? 'bg-blue-500 text-white' : '' }}"
                                    href="{{ route('kelolaCustomer') }}"><i class="ri-user-line mr-2"></i>Customer</a></li>
                            <li><a class="block px-4 py-2 hover:bg-blue-600 {{ request()->routeIs('kelolaKreator') ? 'bg-blue-500 text-white' : '' }}"
                                    href="{{ route('kelolaKreator') }}"><i class="ri-user-2-line mr-2"></i>Creator</a></li>
                            <li><a class="block px-4 py-2 hover:bg-blue-600 {{ request()->routeIs('pending.users') ? 'bg-blue-500 text-white' : '' }}"
                                    href="{{ route('pending.users') }}"><i class="ri-user-follow-fill mr-2"></i>Permintaan Creator</a></li>
                        </ul>
                    </div>
                    <!-- Kelola Event Dropdown Menu -->
                    <div class="relative py-3 px-5">
                        <button onclick="toggleDropdownEvent()"
                            class="w-full text-left text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg py-2 px-4 focus:outline-none"
                            type="button">
                            <i class="ri-arrow-down-s-line mr-2"></i>
                            Kelola Event
                        </button>
                        <ul id="dropdown-event-menu" class="hidden bg-gray-700 mt-1 text-white">
                            <li><a class="block px-4 py-2 hover:bg-blue-600 {{ request()->routeIs('listEventAdm') ? 'bg-blue-500 text-white' : '' }}"
                                    href="{{ route('listEventAdm') }}"><i class="ri-calendar-event-line mr-2"></i>Event</a></li>
                        </ul>
                    </div>
                    <li class="py-3 px-5">
                        <a class="flex items-center text-gray-400 hover:bg-blue-700 hover:text-white rounded-lg py-2 px-4 {{ request()->routeIs('') ? 'bg-blue-500 text-white' : '' }}"
                            href="{{ route('profileAdmin') }}">
                            <i class="ri-account-circle-fill  mr-2"></i>Account
                        </a>
                    </li>
                    <div class="relative py-3 px-5">
                        <a href="#"
                            class="w-full text-left text-red-600 hover:bg-gray-700 hover:text-red-400 rounded-lg py-2 px-4 focus:outline-none"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ri-logout-box-r-line"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </ul>
                {{-- <a href="{{ route('homeAdmin')}}" class="block py-2.5 px-4 rounded hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('kelolaCustomer')}}" class="block py-2.5 px-4 rounded hover:bg-gray-700">Kelola Customer</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-gray-700">Kelola Kamar</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-gray-700">Laporan</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-gray-700">Pengaturan</a> --}}
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-6 md:ml-64 max-w-full">
            @yield('content')
        </div>
    </div>

    <script>
        const menuToggle = document.getElementById("menu-toggle");
        const sidebar = document.getElementById("sidebar");

        menuToggle.addEventListener("click", () => {
            sidebar.classList.toggle("-translate-x-full");
        });

        function toggleDropdownUser() {
            var dropdownUser = document.getElementById('dropdown-user-menu');
            dropdownUser.classList.toggle('hidden');
        }

        function toggleDropdownEvent() {
            var dropdownEvent = document.getElementById('dropdown-event-menu');
            dropdownEvent.classList.toggle('hidden');
        }
    </script>
</body>

</html>


{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('components/asset/logo/512.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('components/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('components/css/nav.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    @stack('css')
</head>

<body>
    @include('template.notifikasi')
    <div class="container">
        <div class="sidebar bg-gray-800 text-white fixed top-0 left-0 w-64 h-full shadow-lg z-50">
            <h4 class="text-center text-blue-400 py-4">Admin Menu</h4>
            <hr class="border-gray-600">
            <ul class="flex flex-col">
                <!-- Home Admin Menu -->
                <li class="py-3 px-5">
                    <a class="flex items-center text-gray-400 hover:bg-blue-700 hover:text-white rounded-lg py-2 px-4 {{ request()->routeIs('homeAdmin') ? 'bg-blue-500 text-white' : '' }}"
                        href="{{ route('homeAdmin') }}">
                        <i class="ri-home-4-fill mr-2"></i> Dashboard
                    </a>
                </li>
                <!-- Kelola User Dropdown Menu -->
                <div class="relative py-3 px-5">
                    <button onclick="toggleDropdownUser()"
                        class="w-full text-left text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg py-2 px-4 focus:outline-none"
                        type="button">
                        Kelola User
                        <i class="ri-arrow-down-s-line ml-2"></i>
                    </button>
                    <ul id="dropdown-user-menu" class="hidden bg-gray-700 mt-1 text-white">
                        <li><a class="block px-4 py-2 hover:bg-blue-600 {{ request()->routeIs('kelolaCustomer') ? 'bg-blue-500 text-white' : '' }}"
                                href="{{ route('kelolaCustomer') }}">List Customer</a></li>
                        <li><a class="block px-4 py-2 hover:bg-blue-600 {{ request()->routeIs('kelolaKreator') ? 'bg-blue-500 text-white' : '' }}"
                                href="{{ route('kelolaKreator') }}">List Creator</a></li>
                        <li><a class="block px-4 py-2 hover:bg-blue-600 {{ request()->routeIs('pending.users') ? 'bg-blue-500 text-white' : '' }}"
                                href="{{ route('pending.users') }}">Permintaan Creator</a></li>
                    </ul>
                </div>
                <!-- Kelola Event Dropdown Menu -->
                <div class="relative py-3 px-5">
                    <button onclick="toggleDropdownEvent()"
                        class="w-full text-left text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg py-2 px-4 focus:outline-none"
                        type="button">
                        Kelola Event
                        <i class="ri-arrow-down-s-line ml-2"></i>
                    </button>
                    <ul id="dropdown-event-menu" class="hidden bg-gray-700 mt-1 text-white">
                        <li><a class="block px-4 py-2 hover:bg-blue-600 {{ request()->routeIs('listEvent') ? 'bg-blue-500 text-white' : '' }}"
                                href="{{ route('listEventAdm') }}">List Event</a></li>
                    </ul>
                </div>
                <div class="relative py-3 px-5">
                    <a href="#"
                        class="w-full text-left text-red-600 hover:bg-gray-700 hover:text-red-400 rounded-lg py-2 px-4 focus:outline-none"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ri-logout-box-r-line"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </ul>
        </div>
        @yield('content')
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleDropdownUser() {
            var dropdownUser = document.getElementById('dropdown-user-menu');
            dropdownUser.classList.toggle('hidden');
        }

        function toggleDropdownEvent() {
            var dropdownEvent = document.getElementById('dropdown-event-menu');
            dropdownEvent.classList.toggle('hidden');
        }
    </script>

    @stack('js')
</body>

</html> --}}
