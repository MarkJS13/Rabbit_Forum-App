<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href={{ asset('img/icon.png') }} />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Martian+Mono:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href={{ asset('css/index.css') }}>
    <link rel="stylesheet" href={{ asset('css/media-queries/create.css') }}>
    <script src="https://kit.fontawesome.com/07b61b3998.js" crossorigin="anonymous" defer></script>
    <script src={{ asset('js/script.js') }} defer></script>
    <title>Forum App</title>
  </head>

  <body>
    <div id="root">
        <div class="wrapper"> </div>
        <div class="sidebarToggle">
            <div class="close"> &times; </div>
            <ul>
                <li> 
                    <a href="{{ route('question.index') }}">
                        <span> <i class="fa-solid fa-house"></i> </span> Home 
                    </a>
                </li>
                <li>
                    <a href="{{ route('question.myquestions') }}">
                        <span> <i class="fa-regular fa-circle-question"></i> </span> My Questions 
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span> <i class="fa-solid fa-right-from-bracket"></i> </span> Logout </a> 
                </li> 

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>      
            </ul>
        </div>
        <div class="container">
            <section class="sidebarL">
                <div class="logo"> 
                <h1> rabbit. </h1> 
                <div class="hamburger"> <i class="fa-solid fa-bars"></i> </div>
                </div>
                
                <ul>
                    <li> 
                        <a href="{{ route('question.index') }}">
                            <span> <i class="fa-solid fa-house"></i> </span> Home 
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('question.myquestions') }}">
                            <span> <i class="fa-regular fa-circle-question"></i> </span> My Questions 
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span> <i class="fa-solid fa-right-from-bracket"></i> </span> Logout </a> </li> 

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>      
                </ul>
            </section>

                <main>
                    <header>
                        <li class='input'>
                                <span class="search-icon">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="search" name="qsearch" placeholder='Search' class='search-input'/>
                        </li>
                        <li class='createBtn'>
                            <button> <a href="{{ route('question.create') }}"> Ask Question </a> </button>
                        </li>

                        <li class='light-bulb'>
                            <i class="fa-regular fa-bell"></i>
                        </li>
                    </header>

                    <div class="create-question">
                        <h2> Post a question 
                            <span><i class="fa-solid fa-signs-post"></i></span>
                            <div class="close">
                                <a href="{{ route('question.index') }}"> <i class="fa-regular fa-circle-xmark"></i> </a> 
                            </div> 
                        </h2>

                        <div class="create-question-form">
                            <form action="{{ route('question.store') }}" method="post">
                                @csrf
                                <input type="text" placeholder="Title" name="title">
                                <textarea name="content" placeholder="Text"></textarea>
    
                                <label> Category:
                                <select name="category">
                                    <option value=""> Select category </option>
                                    <option value="general discussion"> General Discussion </option>
                                    <option value="help & support"> Help & Support </option>
                                    <option value="news & announcements"> News & Announcements </option>
                                    <option value="introductions & greetings"> Introductions & Greetings </option>
                                    <option value="lifestyle & hobbies"> Lifestyle & Hobbies </option>
                                    <option value="education & learning"> Education & Learning </option>
                                    <option value="relationships & dating"> Relationships & Dating </option>
                                    <option value="parenting & family"> Parenting & Family </option>
                                    <option value="career & business"> Career & Business </option>
                                    <option value="other"> Other </option>
                                </select>
                            </label>

                            <div class="btn">
                                <button type="submit"> Post </button>
                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="create-form-error">
                        @if ($errors->any())
                            @foreach ($errors->all() as $err)
                                <p> {{ $err }} </p>
                            @endforeach
                        @endif
                    </div>
                </main>

                <section class="sidebarR">
                    <div class="profile-details">
                        <h2> <i class="fa-regular fa-id-card"></i> </h2> 
                        <h1> {{ Auth::user()->name }} </h1>
                        <p> {{ Auth::user()->email }} </p>
                        <h5> 
                            @if ($question_count > 1) 
                                Total Question: {{ $question_count }} 
                            @endif
                                Total Question: {{ $question_count }} 
                        </h5>
                    </div>
            
                    <div class="trends">
                            <div class="trending-title">
                                <h1> Trends for you </h1>
                                <i class="fa-solid fa-arrow-trend-up"></i>
                            </div>
                    
                            <ul class="trending-list">
                                @foreach ($topCategories as $index =>$category) 
                                    <li>
                                        <p> {{ $category->category }} </p>
                                        <h5>  {{ $category->category_count }} Tags </h5>
                                    </li>
                
            
                                @endforeach
                            </ul>
            
                            <footer>
                                
                                <li> Made by: Mark Joseph Serrano </li>
                                <li>  Forum App. 2023</li> 
                            </footer>
                    </div>
            
                </section>
        </div>
    </div>
  </body>
</html>