<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" type="image/svg+xml" href={{ asset('img/icon.png') }} />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Martian+Mono:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href={{ asset('css/index.css') }}>
        <link rel="stylesheet" href={{ asset('css/media-queries/welcome.css') }}>
        <script src="https://kit.fontawesome.com/07b61b3998.js" crossorigin="anonymous" defer></script>
        <script src="script.js" defer></script>
        <title>Forum App</title>
    </head>
    
</html>


<body>
    <div id="root">
        <div class="welcome-page">
            <section class="left">   
                <div class="logo">
                    <h1> rabbit. </h1>
                </div>

                <div class="text">
                    <h1> Welcome to <span> Rabbit Forum App! </span> Join the conversation, connect with others, and grow together! </h1>
                </div>
            </section>
            <section class="right">
                    @if (Route::has('login'))
                        <nav>
                            @auth
                               <li> <a href="{{ url('/question') }}">Dashboard</a> </li> 
                            @else
                                <li> <a href="{{ route('login') }}"> Log in </a> </li> 

                                @if (Route::has('register'))
                                    <li> <a href="{{ route('register') }}">Register</a> </li> 
                                @endif
                            @endauth
                        </nav>
                    @endif

                <div class="hero">
                    <div class="hero-container">
                    </div>
                </div>
            </section>
        </div>
    </div>
  </body>

  