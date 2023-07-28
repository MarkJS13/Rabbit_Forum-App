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
    <link rel="stylesheet" href={{ asset('css/media-queries/dashboard.css') }}>
    <script src="https://kit.fontawesome.com/07b61b3998.js" crossorigin="anonymous" defer></script>
    <script src={{ asset('js/script.js') }} defer></script>
    <script src={{ asset('js/search.js') }} defer></script>
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
                        <form action="{{ route('question.index') }}" method="GET">
                                <span class="search-icon">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="search" name="qsearch" placeholder='Search' class='search-input' value="{{ $searchQuery ?? '' }}"/>
                        </form>
                        </li>
                        <li class='createBtn'>
                            <button> <a href="{{ route('question.create') }}"> Ask Question </a> </button>
                        </li>

                        <li class='light-bulb'>
                            <i class="fa-regular fa-bell"></i>
                        </li>
                    </header>

                    @if ($questions->isEmpty() && $searchQuery)
                    <p class="no-result">No results found for "{{ $searchQuery }}".</p>
                    @endif

                    @foreach ($questions as $question)
                        <div class="question-block">
                            <div class="upvotes">
                                    <h3> <span> <a href="{{ route('question.like', $question->id) }}"> <i class="fa-solid fa-hand-point-up"></i> </a> </span> </h3> 
                                    <h2>  {{ $question->like }}  </h2> 
                                    <h3> <span> <a href="{{ route('question.dislike', $question->id) }}"> <i class="fa-regular fa-hand-point-down"></i> </a> </span> </h3> 
                            </div>
                
                            <div class="questions">
                                <div class="qtitle">
                                    <h1> <a href="{{ route('question.show', $question->id) }}"> {{ $question->title }} </a> </h1> 
                                </div>
                
                                <div class="content">
                                    <p> {{ $question->content }} </p>
                                </div>
                
                                <div class="question-details">
                                    <p class='user'>- {{ $question->user->name }}</p>
                                    <div class="right">
                                        <p class='category'> Category: {{ $question->category }} </p>
                                        <p class='responses'>  
                                           @if ( $question->comments->count() > 1)
                                                {{ $question->comments->count() }} Responses                         
                                                @elseif ( $question->comments->count() === 1) 
                                                {{ $question->comments->count() }} Response
                                                @else 
                                                No response
                                            @endif
                    
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    @endforeach
                    
                    @if ($questions->count() < 1) 
                        <div class="emptyq">
                            <h1> No posted questions! </h1>
                        </div>
                    @endif
                </main>


                <section class="sidebarR">
                    <div class="profile-details">
                        <h2> <i class="fa-regular fa-id-card"></i> </h2> 
                        <h1> {{ Auth::user()->name }} </h1>
                        <p> {{ Auth::user()->email }} </p>
                        <h5> 
                            @if ($question_count > 1) 
                                Total Questions: {{ $question_count }} 
                            @else
                                Total Question: {{ $question_count }} 
                            @endif
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