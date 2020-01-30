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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
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
    <div id="app" style="margin-top:90px">
        <nav class="navbar fixed-top navbar-expand-md navbar-light shadow-sm pb-2" >
            <img src="goal.png" width='45'>
            <a class="navbar-brand" style="color:#112d4e" href="/">Target</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
  </button>
     <!-- Right Side Of Navbar -->
     <ul class="navbar-nav mx-auto row">
                   <li class="nav-item active">
                    <a class="nav-link mt-2" style="color:#112d4e;" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    @auth
                    <li class="nav-item ">
                    <a class="nav-link mt-2 float-left" style="color:#112d4e;" href="{{ url('/influencers') }}">Influencers<span class="sr-only">(current)</span></a>
                    </li>
                    @endauth
                    @role('Influencer')
                    <li class="nav-item ">
                    <a class="nav-link mt-2 float-left" style="color:#112d4e;" href="{{ url('/requests') }}">Requests<span class="sr-only">(current)</span></a>
                    </li>
                    @endrole
                    @role('Client')
                    <li class="nav-item ">
                    <a class="nav-link mt-2" style="color:#112d4e;" href="{{ url('/requests') }}">My Influencers<span class="sr-only">(current)</span></a>
  
                    </li>
                    @endrole
                    <li class="nav-item ">
                    <a class="nav-link mt-2" style="color:#112d4e;" href="{{ url('/influencers/about') }}">About Us<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                    <a class="nav-link mt-2 " style="color:#112d4e;" href="{{ url('/influencers/contactUs') }}">Contact Us<span class="sr-only">(current)</span></a>

                    </li>
                 </ul>
                 <ul class="navbar-nav mr-2 ">

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link btn btn-success text-light mt-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn-blue color text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else

                        <li class="nav-item  dropdown mr-2" >
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre >
                        <span class="nav-text " id="alert" >
                        @if((count(get_unread_messages()))>0)
                        <span  id="alertRead">
                        <svg class="my-3" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="30" height="30"viewBox="0 0 172 172"style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#e74c3c"><path d="M86,20.64c-5.65719,0 -10.32,4.66281 -10.32,10.32v4.68969c-16.60875,4.085 -27.52,18.06 -27.52,36.80531v26.83469c0,7.47125 -4.4075,15.93688 -6.94719,20.16969l-6.235,9.3525c-0.69875,1.04812 -0.77938,2.41875 -0.17469,3.53406c0.60469,1.11531 1.77375,1.81406 3.03687,1.81406h96.32c1.26313,0 2.43219,-0.69875 3.03688,-1.81406c0.60469,-1.11531 0.52406,-2.4725 -0.17469,-3.53406l-6.14094,-9.21813c-4.74344,-7.88781 -7.04125,-14.37812 -7.04125,-19.83375v-26.83469c0,-18.97375 -10.91125,-33.12344 -27.52,-37.24875v-4.71656c0,-5.65719 -4.66281,-10.32 -10.32,-10.32zM86,27.52c1.90813,0 3.44,1.53188 3.44,3.44v3.60125c-1.12875,-0.09406 -2.27094,-0.16125 -3.44,-0.16125c-1.16906,0 -2.31125,0.06719 -3.44,0.16125v-3.60125c0,-1.90812 1.53188,-3.44 3.44,-3.44zM11.97281,32.59938c-7.67281,12.47 -11.97281,27.31844 -11.97281,43.08062c0,15.76219 4.3,30.61063 11.97281,43.08063l5.87219,-3.60125c-7.00094,-11.38156 -10.965,-24.96688 -10.965,-39.47938c0,-14.5125 3.96406,-28.09781 10.965,-39.47937zM160.02719,32.59938l-5.87219,3.60125c7.00094,11.38156 10.965,24.96687 10.965,39.47937c0,14.5125 -3.96406,28.09781 -10.965,39.47938l5.87219,3.60125c7.67281,-12.47 11.97281,-27.31844 11.97281,-43.08063c0,-15.76219 -4.3,-30.61062 -11.97281,-43.08062zM26.88844,41.76375c-6.26187,10.11844 -9.68844,21.37906 -9.68844,33.91625c0,12.63125 3.88344,24.24125 9.66156,33.87594l5.89906,-3.5475c-5.21375,-8.7075 -8.68063,-19.10812 -8.68063,-30.32844c0,-11.31437 2.99656,-21.15062 8.65375,-30.30156zM145.11156,41.76375l-5.84531,3.61469c5.65719,9.15094 8.65375,18.98719 8.65375,30.30156c0,11.22031 -3.46687,21.62094 -8.69406,30.32844l5.9125,3.5475c5.77813,-9.63469 9.66156,-21.24469 9.66156,-33.87594c0,-12.53719 -3.42656,-23.79781 -9.68844,-33.91625zM70.25125,141.04c2.67406,6.06031 8.7075,10.32 15.74875,10.32c7.04125,0 13.07469,-4.25969 15.74875,-10.32z"></path></g></g></svg>              
                         </span>
                         @else
                       <i id="alertRead"class="far fa-bell float-left my-4"></i>
                       @endif
                       </span>
                       <span class="caret"></span>
                       </a>
                       <div class="dropdown-menu " aria-labelledby="navbarDropdown" style="background-color:#f9f7f7;" >
                       @foreach($messages=get_all_messages() as $message)
                       <a class="dropdown-item"  href="{{ url('/') }}" onmouseover="this.style.backgroundColor='#f9f7f7'"><span style="color:#112d4e; ">
                       {{$message->data['request_status']}}</span>
                       </a>
                       @endforeach
                       
                       </div>

                      </li>

                        <li class="nav-item dropdown">

                       <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          <span class="nav-text " >  {{ Auth::user()->name }}</span>
                          <image src="minions.jpg" class="rounded-circle" width="50px" height="50px">

                           <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu " aria-labelledby="navbarDropdown" style="background-color:#f9f7f7;" >
                           
                        <a class="dropdown-item"  href="{{route('users.show',['user' => Auth::user()->id ])}}" onmouseover="this.style.backgroundColor='#f9f7f7'"><span style="color:#112d4e; ">Profile</span></a>
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
   
        </div>


        <main class="y-4 mb-0">
            @yield('content')
        </main>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    @yield('scripts')



<script type="text/javascript">
document.getElementById("alert").addEventListener('click',function(){
    $.ajax({
           type: "GET",
           url: '/message/read',
           data: "{}",
           dataType: "json",
           success:function(data) {
alert(data)
             document.getElementById('AlertRead').innerHtml=' <i id="alertRead"class="far fa-bell float-left my-4"></i>'
           
      }
})
});




$(function () {
    $('#datetimepicker1').datetimepicker();
 });



</body>
</html>
