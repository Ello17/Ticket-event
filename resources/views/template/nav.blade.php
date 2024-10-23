<header class="bg-[#36455c]">
    <nav class="flex justify-between items-center w-[92%] mx-auto">
        <!-- Logo -->
        <div>
            <a href="{{ route('homeCustomer') }}">
                <img class="img-nav" src="{{ asset('components/asset/logo/512.png') }}" alt="Logo" >
            </a>
        </div>

        <!-- Link Navigasi -->
        <div class="nav-links duration-500 md:static absolute bg-[#36455c] md:min-h-fit min-h-[90vh] left-[-100%] top-[12%] md:w-auto w-full flex items-center px-5 transition-all ease-in-out">
            <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8 w-full">
                <li class="input relative md:w-auto w-full">
                    <input type="text" class="input-nav md:w-auto w-full p-1 rounded-md" placeholder="Search">
                </li>
                <li>
                    <a href="{{ route('registerCreator') }}" class="a-navbar text-white">Event</a>
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

                        <a href="{{ route('profil', ['user' => Auth::user()->id]) }}" class="px-5 py-2 rounded-full">
                            <img src="{{ Auth::user()->profil ? asset(Auth::user()->profil) : asset('components/asset/logo/user.png') }}"
                                 alt="Foto Profil {{ Auth::user()->username }}"
                                 class="profile-nav">
                        </a>

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
        const isMenuOpen = navLinks.classList.toggle('left-0'); // Menu toggle logic
        icon.name = isMenuOpen ? 'close' : 'menu'; // Switch between menu and close icon
        document.body.style.overflow = isMenuOpen ? 'hidden' : 'auto'; // Disable scrolling when menu is open
    }
</script>

<style>
    /* Mobile styles for navigation */
    @media (max-width: 768px) {


        .input-nav {
            width: 100%; /* Full width input for mobile */
        }

        /* Make search aligned as in the original */
        .input {
            width: 100%;
        }
    }

    /* Desktop styles */
    @media (min-width: 768px) {


        .input-nav {
            width: auto; /* Auto width input for desktop */
        }

        ion-icon[name="menu"] {
            display: none; /* Hide menu icon for desktop */
        }
    }
</style>
