<header class="bg-white">
<nav class="">
<div>
    <img class="w-16" src="{{asset('components/asset/logo/512.png')}}" alt="">
</div>
<div class="">
    <ul>
        <li>
            <a href="#"><i class="ri-calendar-event-fill"></i> Event</a>
        </li>
        <li>
            <a href="{{route('login')}}"><i class="ri-user-line"></i></a>
        </li>
    </ul>
</div>
<div>
    <button class="bg-[#7fa1c3] text-white px-5 py-2">Log In </button>
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
