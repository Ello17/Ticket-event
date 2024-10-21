<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('components/asset/logo/512.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('components/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('components/css/nav.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    @stack('css')
</head>

<body>
    @include('template.notifikasi')

    <div class="sidebar bg-gray-800 text-white fixed top-0 left-0 w-64 h-full shadow-lg z-50">
        <h4 class="text-center text-blue-400 py-4">Creator Menu</h4>
        <hr class="border-gray-600">
        <ul class="flex flex-col">
            <!-- Home Admin Menu -->
            <li class="py-3 px-5">
                <a class="flex items-center text-gray-400 hover:bg-blue-700 hover:text-white rounded-lg py-2 px-4 {{ request()->routeIs('homeAdmin') ? 'bg-gray-500 text-white' : '' }}" href="{{ route('homeCreator') }}">
                    <i class="ri-home-4-fill mr-2"></i> Home Creator
                </a>
            </li>
             <!-- Kelola Event Dropdown Menu -->
            <div class="relative py-3 px-5">
                <button onclick="toggleDropdown('event-menu')"
                        class="w-full text-left text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg py-2 px-4 focus:outline-none"
                        type="button">
                    Kelola Event
                    <i class="ri-arrow-down-s-line ml-2"></i>
                </button>
                <ul id="event-menu" class="hidden bg-gray-700 mt-1 text-white rounded-lg">
                    <li>
                        <a class="block px-4 py-2 hover:bg-gray-600" href="{{ route('tambahEvent') }}">Tambah Event</a>
                    </li>
                </ul>
            </div>

                <div class="relative py-3 px-5">
                    <button onclick="toggleDropdown('tiket-menu')"
                            class="w-full text-left text-gray-400 hover:bg-gray-700 hover:text-white rounded-lg py-2 px-4 focus:outline-none"
                            type="button">
                        Kelola Tiket
                        <i class="ri-arrow-down-s-line ml-2"></i>
                    </button>
                    <ul id="tiket-menu" class="hidden bg-gray-700 mt-1 text-white rounded-lg">
                        <li>
                            <a class="block px-4 py-2 hover:bg-gray-600" href="{{ route('kelolaTiket') }}">Lihat Tiket</a>
                        </li>
                    </ul>
                </div>
                <li class="py-3 px-5">
                    <a class="flex items-center text-gray-400 hover:bg-blue-700 hover:text-white rounded-lg py-2 px-4 {{ request()->routeIs('') ? 'bg-blue-500 text-white' : '' }}"
                        href="{{ route('profilCreator') }}">
                        <i class="ri-account-circle-fill  mr-2"></i>Account
                    </a

                    {{-- <ul id="tiket-menu" class="hidden bg-gray-700 mt-1 text-white rounded-lg">
                        <li>
                            <a class="block px-4 py-2 hover:bg-gray-600" href="{{ route('kirimTiket', $eventId) }}">Kirim Tiket</a>

                        </li>
                    </ul> --}}
                {{-- </div>
                <li class="py-3 px-5">
                    <a class="flex items-center text-gray-400 hover:bg-blue-700 hover:text-white rounded-lg py-2 px-4 {{ request()->routeIs('') ? 'bg-blue-500 text-white' : '' }}"
                        href="{{ route('profilCreator') }}">
                        <i class="ri-account-circle-fill  mr-2"></i>Account
                    </a
 --}}


            <!-- Logout -->
            <div class="relative py-3 px-5">
                <a href="#" class="w-full text-left text-red-600 hover:bg-gray-700 hover:text-red-400 rounded-lg py-2 px-4 focus:outline-none" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ri-logout-box-r-line"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </ul>
    </div>

    @yield('content')

    <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function toggleDropdown(menuId) {
    const menu = document.getElementById(menuId);
    menu.classList.toggle('hidden');
    }
  </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    @stack('js')
</body>

</html>
