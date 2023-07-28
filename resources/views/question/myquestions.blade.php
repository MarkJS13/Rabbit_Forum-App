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
                    <span> <i class="fa-regular fa-circle-question"></i> </span> My Questions 
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
                        <span> <i class="fa-regular fa-circle-question"></i> </span> My Questions 
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
                                <input type="search" name="qsearch" placeholder='Search' class='search-input' value="{{ $searchQuery ?? '' }}"/>
                        </li>
                        <li class='createBtn'>
                            <button> <a href="{{ route('question.create') }}"> Ask Question </a> </button>
                        </li>

                        <li class='light-bulb'>
                            <i class="fa-regular fa-bell"></i>
                        </li>
                    </header>

                    <div class="my-question">
                        <h1> My Questions </h1>
                        <div class="table-questions">
                            <table>
                                <tr>
                                    <th>Title</th>
                                    <th> Time created </th>
                                    <th> -  </th>
                                    <th> - </i> </th>
                                </tr>

    
                                @foreach ($user_questions as $user_question)
                                <tr>
                                        <td class="table-title"> <a href={{ route('question.show', $user_question->id) }}>
                                            {{ $user_question->title }}
                                        </a> </td>
                                        <td class="table-time"> {{ $user_question->created_at }} </td>
                                        <td>
                                            <a href="{{ route('question.edit', $user_question->id) }}">
                                                <i class="fa-regular fa-pen-to-square"> </i>
                                            </a> 
                                        </td>
    
                                        <td> 
                                            <form action="{{ route('question.destroy', $user_question->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button>
                                                    <i class="fa-solid fa-trash-can"></i> 
                                                </button>
                                            </form>
                                        </td>
                                </tr>

                                @endforeach
                                
                            </table>

                            @if ($user_questions->count() < 1)
                                    <div class="emptyq">
                                        <h1> You have no posted questions! </h1>
                                    </div>
                                @endif
                        </div>
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