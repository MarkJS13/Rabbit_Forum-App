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
    <link rel="stylesheet" href={{ asset('css/media-queries/show.css') }}>
    <script src="https://kit.fontawesome.com/07b61b3998.js" crossorigin="anonymous" defer></script>
    <script src={{ asset('js/script.js') }} defer></script>
    <script src={{ asset('js/load.replies.js') }} defer></script>
    <title>Forum App</title>
  </head>
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
                                <input type="search" name="qsearch" placeholder='Search' class='search-input' value="{{ $searchQuery ?? '' }}"/>
                        </li>
                        <li class='createBtn'>
                            <button> <a href="{{ route('question.create') }}"> Ask Question </a> </button>
                        </li>

                        <li class='light-bulb'>
                            <i class="fa-regular fa-bell"></i>
                        </li>
                    </header>

                    <section id="question-show">
                        <div class="title-question">
                                <h1>{{ $question->title }} 
                                    
                                <span> {{ $question->category }} </span> </h1>
                                
                                <div class="close">
                                    @if ($question->user->name === Auth::user()->name)
                                    <span class="edit-btn">
                                        <a href="{{ route('question.edit', $question->id) }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a> 
                                    </span>
                                    @endif
                                    <a href="{{ route('question.index') }}"> <i class="fa-regular fa-circle-xmark"></i> </a> 
                                </div>   
                        </div>
                    
                        <div class="main-question">
                            <h3>
                                {{ $question->content }} 
                            </h3>

                            <div class="reply_likes">
                                <p class="like">
                                    <a href="{{ route('question.like', $question->id) }}">
                                        <i class="fa-solid fa-hand-point-up"></i>
                                    </a>
                                        <span> {{ $question->like }} </span>
                                    <a href="{{ route('question.dislike', $question->id) }}">
                                        <i class="fa-regular fa-hand-point-down"></i> 
                                    </a>
                                     
                                </p>
                            </div>
                    
                            <div class="posted-by">
                                <h4> Posted by: {{ $question->user->name }} </h4>                  
                            </div>

                            <div class="question_time">
                                <p> {{ $question->created_at->diffForHumans() }} </p> 
                            </div>
                        </div>
                    
                        <div class="comment-form">
                            <p> Comment as <span> {{ Auth::user()->name }} </span> </p>

                            <form action="{{ route('comment.store', $question->id) }}" method="post">
                                @csrf
                                
                                <textarea name="comment" placeholder="What are your thoughts?"></textarea>
                                <button> Comment </button>
                            </form>

                        </div>
                    
                         <!-- loop all comments here  -->
                    
                        <div class="comments">
                            @foreach ($comments as $comment)
                                <div class="commenter-section">
                                        <h1> 
                                            {{ $comment->user->name }} 
                                            <span> {{ $comment->created_at->diffForHumans() }} </span>
                                            
                                            @if (Auth::user()->name === $comment->user->name)
                                                <form action="{{ route('comment.destroy', [$comment->id, $question->id]) }}" method="post" class="delete-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit">
                                                        <i class="fa-regular fa-trash-can"></i> 
                                                    </button>
                                                </form>                                            
                                                 
                                            @endif

                                        </h1>
                                        <p> {{ $comment->comment }} </p>

                                        <div class="reply_likes">
                                            <p class="like">
                                                <a href="{{ route('comment.like', $comment->id) }}">
                                                    <i class="fa-solid fa-hand-point-up"></i>
                                                </a>
                                                <span> {{ $comment->like }} </span>
                                                <a href="{{ route('comment.dislike', $comment->id) }}">
                                                    <i class="fa-regular fa-hand-point-down"></i> 
                                                </a>
                                            </p>
                                            <p class="click-reply"> Reply </p>
                                            <div class='reply-form hide'>
                                                <p> Reply as <span> {{ Auth::user()->name }} </span> </p>
                                                    <form action="{{ route('reply.store', [$question->id, $comment->id]) }}" method="post">
                                                        @csrf
                                                        <label >  </label>
                                                        <textarea placeholder="Write a reply" name="reply"></textarea>
                                                        <button> Submit a reply </button>
                                                    </form>
                                            </div>
                                        </div>    

                                        <!----- Reply ------>
                                        <div class="load-replies">
                                            <i class="fa-solid fa-rotate"></i> load replies
                                        </div>
                                        <div class="reply-section">
                                            <!-- LOOP REPLIES HERE -->
                                            @if ($question->comments->count())
                                                @foreach ($replies[$comment->id] as $reply)
                                                
                                                <div class="replies">
                                                    
                                                    <h1> {{ $reply->user->name }} 
                                                        <span> {{ $reply->created_at->diffForHumans() }} </span>
                                                        
                                                    @if (Auth::user()->name === $reply->user->name)
                                                        <form action="{{ route('reply.destroy', $reply->id) }}" method="post" class="delete-form">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit">
                                                                <i class="fa-regular fa-trash-can"></i> 
                                                            </button>
                                                        </form>                                            
                                                    
                                                    @endif
                                                    
                                                    </h1>

                                                    
                                                    <p> {{ $reply->reply }} </p>
            
                                                    <div class="reply_likes">
                                                        <p class="like">
                                                            <a href="{{ route('reply.like', $reply->id) }}">
                                                                <i class="fa-solid fa-hand-point-up"></i>
                                                            </a>
                                                            
                                                            <span> {{ $reply->like }} </span>

                                                            <a href="{{ route('reply.dislike', $reply->id) }}">
                                                                <i class="fa-regular fa-hand-point-down"></i>
                                                            </a>
 
                                                        </p>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @endif       
                                            <div class="hide-replies">
                                                <i class="fa-regular fa-eye-slash"></i> hide replies
                                            </div>
                                        </div>                                    
                                </div>
                            @endforeach 
                                           
                        </div> 
                    
                    </section>
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