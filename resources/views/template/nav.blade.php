<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 mr-3">
                <img class="w-16" src="{{asset('components/asset/logo/512.png')}}" alt="">
            </div>
            <!-- Hamburger Menu Button (Mobile) -->
            <div class="flex lg:hidden">
                <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-2 w-full max-w-lg">
                <div class="relative w-full">
                    <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-2xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Search...">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                @auth
                <div class="relative ml-6">
                    <button class="flex text-2xl border-2 border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-purple-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <i class='bx bx-user'></i>
                    </button>
                    <div class="absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                            <a href="" class=" px-4 py-2 text-sm text-gray-700 bg-gray-200 hover:bg-purple-100 flex items-center" role="menuitem">
                                <img class="w-12 sm:w-10 mr-3 rounded-full" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="User Image"><span>{{ Auth::user()->name }}</span></a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100" role="menuitem"><i class="fa-solid fa-gear"></i> Settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-purple-100" role="menuitem" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="flex space-x-2 ml-6">
                    <div class="flow-root">
                        <a href="{{ Route('login')}}" class="block p-2 font-medium text-gray-900 hover:scale-105 hover:text-purple-800">Login</a>
                    </div>
                    <div class="flow-root">
                        <a href="{{ Route('register')}}" class="block p-2 border border-purple-800 rounded-lg font-medium text-purple-800 hover:text-white hover:bg-purple-800 hover:shadow-lg">Daftar</a>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div class="lg:hidden">
        <div id="mobile-menu" class="hidden px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <div class="relative w-full max-w-xs mx-auto">
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-2xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Search...">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            @auth
            <a href="" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">Your Profile</a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">Settings</a>
            <a href="" class="block px-3 py-2 rounded-md text-base font-medium text-red-600 hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            @else
            <a href="{{ Route('login')}}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">Login</a>
            <a href="{{ Route('register')}}" class="block px-3 py-2 rounded-md text-base font-medium text-purple-800 border border-purple-800 hover:bg-gray-100">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

<script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    const userMenuButton = document.getElementById('user-menu-button');
    const dropdownMenu = userMenuButton.nextElementSibling;
    
    userMenuButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', (event) => {
        if (!userMenuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>
