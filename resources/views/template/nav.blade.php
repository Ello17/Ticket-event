<header class="bg-[#6482ad]">
    <nav class="flex justify-between items-center w-[92%] mx-auto">
        <div>
            <a href="{{route('homeCustomer')}}">
            <img class="img-nav" src="{{asset('components/asset/logo/512.png')}}" alt="">
        </a>
        </div>
        <div class="nav-links duration-500 md:static absolute bg-[#6482ad] md:min-h-fit min-h-[90vh] left-[100%] top-[9%] md:w-auto w-full flex items-center px-5">
            <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8">
                <li class="input">
                    <input type="text" name="" id="" class="input-nav" placeholder="Search">
                </li>
                <li>
                    <a href="{{route('registerCreator')}}" class="a-navbar">Event</a>
                </li>
            </ul>
        </div>
        <div class="flex items-center gap-6">
            @guest
                <!-- Tombol Sign In hanya muncul jika belum login -->
                <button class="px-5 py-2 rounded-full b-navbar">
                    <a href="{{ route('login') }}">Sign In</a>
                </button>
            @endguest

            @auth
                <!-- Tombol Profil hanya muncul jika sudah login -->
                <button class="px-5 py-2 rounded-full">
                    <a href="{{ route('profil', ['user' => Auth::user()->id]) }}">
                        <!-- Tampilkan gambar profil atau gambar default jika tidak ada -->
                        <img src="{{ Auth::user()->profil ? asset(Auth::user()->profil) : asset('components/asset/default-profile.png') }}" alt="Profile" class="profile-nav">
                    </a>
                </button>
            @endauth
            <!-- Tombol menu -->
            <ion-icon name="menu" class="text-3xl cursor-pointer md:hidden text-white" onclick="onToggleMenu(this)"></ion-icon>
        </div>

    </nav>
</header>

<script>
    const navLinks = document.querySelector(".nav-links")
    function onToggleMenu(e){
        e.name = e.name === 'menu' ? 'close' : 'menu'
        navLinks.classList.toggle('left-[0%]')
     }
</script>
