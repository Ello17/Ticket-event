<header class="header" id="header">
    <nav class="nav container">
    <img src="{{asset('components/asset/logo/512.png')}}" class="image">

        <div class="nav__menu" id="nav-menu">
          <ul class="nav__list">
             <li class="nav__item">
               <a href="#" class="nav__link"><i class="ri-calendar-event-fill"></i> Buat Event</a>
             </li>
             <li class="gap_item">
                <i class="ri-search-line nav__search" id="search-btn"></i>
               <a href="{{ route('login') }}" style="text-decoration: none">
                  <i class="ri-user-line nav__login" id="login-btn"></i>
              </a>
             </li>
           </ul>
           <div class="nav__toggle" id="nav-toggle">
              <i class="ri-menu-line"></i>
           </div>

           <!-- Close button -->
           {{-- <div class="nav__close" id="nav-close">
               <i class="ri-close-line"></i>
           </div>
       </div>
       <div class="nav__actions">
          <!-- Search button -->

          <!-- Login button -->

<<<<<<< HEAD
         <i class="ri-close-line search__close" id="search-close"></i>
      </div>
  <!--==================== LOGIN ====================-->
      <div class="login" id="login">
=======
          <!-- Toggle button -->
       </div> --}}
    </nav>
 </header>

 <!--==================== SEARCH ====================-->
 <div class="search" id="search">
    <form action="" class="search__form">
       <i class="ri-search-line search__icon"></i>
       <input type="search" placeholder="What are you looking for?" class="search__input">
    </form>
>>>>>>> eb0529d6f1d9567b7e9604b4dfafc47192f9e30b

    <i class="ri-close-line search__close" id="search-close"></i>
 </div>

 <!--==================== LOGIN ====================-->

<script src="{{asset('components/js/nav-backup.js')}}"></script>
