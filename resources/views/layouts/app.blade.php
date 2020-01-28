<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Target</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
  
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans|Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('fontawesome-free/css/all.min.css')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    .navbar{
        background-color:#f9f7f7;

    }
    .navbar-brand{
        margin-left: 10px!important;
        font-family: 'Pacifico', cursive;
        font-size: 35px;
        margin-right:2px;
        /* font-weight: bold; */
        letter-spacing:0.5px;
    }
    .footer-target{
        font-family: 'Pacifico', cursive;

    }
    .btn-blue{
        background-color:#3f72af;
        margin:5px;
        width:85px; 

    }
    .nav-item{
        font-family: 'Merriweather Sans', sans-serif;
        /* margin-top:2px; */
        margin-left:5px;
        font-size:20px;
    }
    .color{
        color:#3f72af;
    }
    .margin{
        margin-left:500px;
    }
    .text{
        font-family: 'Merriweather Sans', sans-serif;

    }
    .paragraph-size{
        font-size:20px;
    }
    .footer{
        background-color:#112d4e;
        color:white;
    }
    


    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-light shadow-sm pb-2" >
            <img src="goal.png" width='45'>
            <a class="navbar-brand" style="color:#112d4e" href="#">Target</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
  </button>
     <!-- Right Side Of Navbar -->
     <ul class="navbar-nav ml-auto row">
                   <li class="nav-item active">
                    <a class="nav-link mt-2" style="color:#112d4e;" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                    <a class="nav-link mt-2" style="color:#112d4e;" href="{{ url('/') }}">Requests<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                    <a class="nav-link mt-2" style="color:#112d4e;" href="{{ url('/') }}">My Influencers<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                    <a class="nav-link mt-2" style="color:#112d4e;" href="{{ url('/influencers/about') }}">About Us<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                    <a class="nav-link mt-2 " style="color:#112d4e;" href="{{ url('/influencers/contactUs') }}">Contact Us<span class="sr-only">(current)</span></a>

                 
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item mr-3" style="margin-left:300px;">
                                <a class="nav-link btn btn-success text-light mt-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn-blue color text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                        <li class="nav-item dropdown" style="margin-left:200px;">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          <span class="nav-text " >  {{ Auth::user()->name }}</span>
                          <image src="minions.jpg" class="rounded-circle" width="50px" height="50px">

                           <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu " aria-labelledby="navbarDropdown" style="background-color:#f9f7f7;" >
                           
                        <a class="dropdown-item"  href="{{ url('/') }}" onmouseover="this.style.backgroundColor='#f9f7f7'"><span style="color:#112d4e; ">Profile</span></a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();" onmouseover="this.style.backgroundColor='#f9f7f7'">
                                          <span style="color:#112d4e;" >{{ __('Logout') }} </span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br><br>
        </div>


        <main class="y-4 mb-0">
            @yield('content')
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

</body>
</html>
