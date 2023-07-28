<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href={{ asset('img/icon.png') }}/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Martian+Mono:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href={{ asset('css/index.css') }}
    <script src="https://kit.fontawesome.com/07b61b3998.js" crossorigin="anonymous" defer></script>
    <script src="script.js" defer></script>
    <title>Forum App</title>
  </head>

  <body>
    <div id="root">
        <div class="welcome-page-login">
            <div class="login-form">
                <div class="logo">
                    <h1> Rabbit. </h1>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div>
                        <label for="name" :value="__('Name')"> Name </label>
                        <input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                    </div>

                    <div>
                        <label for="email" :value="__('Email')"> Email </label>
                        <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username">
                    </div>
                    
                    <div>
                        <label for="password" :value="__('Password')"> Password </label>
                        <input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="new-password">
                    </div>
                    
                    <div>
                        <label for="password_confirmation" :value="__('Confirm Password')"> Confirm Password </label>
                        <input id="password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="btn">
                        <a href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                        <button type="submit"> Register </button>
                    </div>
                </form>
                <div class="error-msg">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
  </body>
  
</html>




