<header class="bg-[#6482ad]">
    <nav class="flex justify-between items-center w-[92%] mx-auto">
        <!-- Logo -->
        <div>
            <a href="{{ route('homeCustomer') }}">
                <img class="img-nav" src="{{ asset('components/asset/logo/512.png') }}" alt="Logo">
            </a>
        </div>

        <!-- Link Navigasi -->
        <div class="nav-links duration-500 md:static absolute bg-[#6482ad] md:min-h-fit min-h-[90vh] left-[100%] top-[9%] md:w-auto w-full flex items-center px-5">
            <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8">
                <li class="input">
                    <input type="text" class="input-nav" placeholder="Search">
                </li>
                <li>
                    <a href="{{ route('registerCreator') }}" class="a-navbar">Event</a>
                </li>
            </ul>
        </div>

        <!-- Tombol Profil / Sign In -->
        <div class="flex items-center gap-6">
            @guest
                <!-- Tampilkan tombol Sign In jika belum login -->
                <button class="px-5 py-2 rounded-full b-navbar">
                    <a href="{{ route('login') }}">Sign In</a>
                </button>
            @endguest

            @auth
                @if (Auth::user()->role === 'customer')
                    <!-- Tampilkan tombol Profil jika user adalah customer -->
                    <button class="px-5 py-2 rounded-full">
                        <a href="{{ route('profil', ['user' => Auth::user()->id]) }}">
                            <img src="{{ Auth::user()->profil ? asset(Auth::user()->profil) : asset('components/asset/logo/user.png') }}"
                                 alt="Foto Profil {{ Auth::user()->username }}"
                                 class="profile-nav">
                        </a>
                    </button>
                @else
                    <!-- Tampilkan tombol Logout untuk role selain customer -->
                    <button class="px-5 py-2 rounded-full b-navbar">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endif
            @endauth

            <!-- Tombol menu untuk versi mobile -->
            <ion-icon name="menu" class="text-3xl cursor-pointer md:hidden text-white" onclick="onToggleMenu(this)"></ion-icon>
        </div>
    </nav>
</header>

<!-- Script Toggle Menu -->
<script>
    const navLinks = document.querySelector(".nav-links");

    function onToggleMenu(icon) {
        icon.name = icon.name === 'menu' ? 'close' : 'menu';
        navLinks.classList.toggle('left-[0%]');
    }
</script>
