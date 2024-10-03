<header class="bg-[#f5eded]">
    <nav class="flex justify-between items-center w-[92%] mx-auto">
        <div>
            <img class="w-16" src="{{asset('components/asset/logo/512.png')}}" alt="">
        </div>
        <div class="nav-links duration-500 md:static absolute bg-[#f5eded] md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto w-full flex items-center px-5">
            <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8">
                <li>
                    <input type="text" name="" id="" class="input-nav" placeholder="Search">
                </li>
                <li>
                    <a href="{{route('login')}}" class="hover:bg-[#6482ad] a-navbar">Event</a>
                </li>
            </ul>
        </div>
        <div class="flex items-center gap-6">
           <button class="bg-[#7fa1c3] text-white px-5 py-2 rounded-full hover:bg-[#6482ad]"><a href="{{route('login')}}">Sign In</a></button>
           <ion-icon name="menu" class="text-3xl cursor-pointer md:hidden" onclick="onToggleMenu(this)"></ion-icon>
        </div>
    </nav>
</header>

<script>
    const navLinks = document.querySelector(".nav-links")
    function onToggleMenu(e){
        e.name = e.name === 'menu' ? 'close' : 'menu'
        navLinks.classList.toggle('top-[8%]')
     }
</script>
