      <header class="header" id="header">
         <nav class="nav container">
            <a href="#" class="nav__logo"><img src="{{asset('components/asset/logo/512.png')}}"></a>

            <div class="nav__menu" id="nav-menu">
               <ul class="nav__list">
                  <li class="nav__item">
                    <a href="#" class="nav__link"><i class="ri-calendar-event-fill"></i> Buat Event</a>
                  </li>
                </ul>

                <!-- Close button -->
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
            </div>
            <div class="nav__actions">
               <!-- Search button -->
               <i class="ri-search-line nav__search" id="search-btn"></i>

               <!-- Login button -->
               <i class="ri-user-line nav__login" href="{{ route('login') }}" id="login-btn"></i>

               <!-- Toggle button -->
               <div class="nav__toggle" id="nav-toggle">
                  <i class="ri-menu-line"></i>
               </div>
            </div>
         </nav>
      </header>

      <!--==================== SEARCH ====================-->
      <div class="search" id="search">
         <form action="" class="search__form">
            <i class="ri-search-line search__icon"></i>
            <input type="search" placeholder="What are you looking for?" class="search__input">
         </form>

         <i class="ri-close-line search__close" id="search-close"></i>
      </div>

<script src="{{asset('components/js/nav.js')}}"></script>
