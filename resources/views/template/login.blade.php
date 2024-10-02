<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>



  <!--==================== LOGIN ====================-->
  <div class="login" id="login">
   <form action="{{ route('postLogin') }}" class="login__form" method="POST">
      @csrf
      <h2 class="login__title">Log In</h2>
  
      <div class="login__group">
          <div>
              <label for="email" class="login__label">Email</label>
              <input type="email" name="email" placeholder="Write your email" id="email" class="login__input">
          </div>
  
          <div>
              <label for="password" class="login__label">Password</label>
              <input type="password" name="password" placeholder="Enter your password" id="password" class="login__input">
          </div>
      </div>
  
      <div>
          <p class="login__signup">
              You do not have an account? <a href="{{ route('register') }}">Sign up</a>
          </p>
  
          <a href="#" class="login__forgot">
              You forgot your password
          </a>
  
          @if (Session::has('notifikasi'))
              <p class="error-message">{{ Session::get('notifikasi') }}</p>
          @endif
  
          <button type="submit" class="login__button">Log In</button>
      </div>
  </form>
  
  
    <i class="ri-close-line login__close" id="login-close"></i>
 </div>



</body>
</html>
