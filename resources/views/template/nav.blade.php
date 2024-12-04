<header class="bg-[#36455c]">
    <nav class="flex justify-between items-center w-[92%] mx-auto p-2">
        <div>
            <a href="{{ route('homeCustomer') }}">
                <img class="img-nav" src="{{ asset('components/asset/logo/512.png') }}" alt="Logo" >
            </a>
        </div>
        <div class="nav-links duration-500 md:static absolute bg-[#36455c] md:min-h-fit min-h-[90vh] left-[-100%] top-[10%] md:w-auto w-full flex items-center px-5 transition-all ease-in-out">
            <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8 w-full">
                <li class="input relative md:w-auto w-full">
                    <form action="{{ route('search') }}" method="GET" class="w-full">
                        <input
                            type="text"
                            name="search"
                            class="input-nav md:w-auto w-full p-1 rounded-md"
                            placeholder="Search"
                            value="{{ request('search') }}"
                        >
                    </form>
                </li>
                <li>
                    <a href="{{ route('registerCreator') }}" class="a-navbar text-white">Create Event</a>
                </li>
            </ul>
        </div>

        <div class="flex items-center gap-6">
            @guest
                <button class="px-5 py-2 rounded-full b-navbar">
                    <a href="{{ route('login') }}">Sign In</a>
                </button>
            @endguest
            @auth
                @if (Auth::user()->role === 'customer')

                        <a href="{{ route('profil', ['user' => Auth::user()->id]) }}" class="px-5 py-2 rounded-full">
                            <img src="{{ Auth::user()->profil ? asset(Auth::user()->profil) : asset('components/asset/logo/user.png') }}"
                                 alt="Foto Profil {{ Auth::user()->username }}"
                                 class="profile-nav">
                        </a>

                @else
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

            <ion-icon name="menu" class="text-3xl cursor-pointer md:hidden text-white" onclick="onToggleMenu(this)"></ion-icon>
        </div>
    </nav>
</header>

<script>
    const navLinks = document.querySelector(".nav-links");

    function onToggleMenu(icon) {
        const isMenuOpen = navLinks.classList.toggle('left-0'); 
        icon.name = isMenuOpen ? 'close' : 'menu';
        document.body.style.overflow = isMenuOpen ? 'hidden' : 'auto'; 
    }
</script>

<style>
    @media (max-width: 768px) {


        .input-nav {
            width: 100%; 
        }

        
        .input {
            width: 100%;
        }
    }

    @media (min-width: 768px) {


        .input-nav {
            width: auto;
        }

        ion-icon[name="menu"] {
            display: none; 
        }
    }
</style>
