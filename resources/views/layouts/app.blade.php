<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" , initial-scale="1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Target</title>

   

    <!-- Fonts -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <!-- <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"> -->


    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    
    <link href="https://fonts.googleapis.com/css?family=Merriweather|Merriweather+Sans|Pacifico|Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Ajax -->    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
    <!-- Styles -->
    <style>
    .navbar{
        background-color:#f9f7f7;
    }
    .navbar-brand{
        margin-left: 10px!important;
        font-family: 'Pacifico', cursive;
        font-size: 35px;
        margin-right:2px;
        letter-spacing:0.5px;
    }
    .footer-target{
        font-family: 'Pacifico', cursive;
    }
    .btn-blue{
        background-color:#112d4e;
        margin:5px;
        width:85px; 
    }
    .nav-item{
        font-family: 'Merriweather Sans', sans-serif;
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
    *{
    margin: 0;
    padding: 0;
}
.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
.ratinglabel{
    margin-top:12px;
}
    
    </style>
</head>
<body>
    <div id="app" style="margin-top:90px;" >
        <nav class="navbar fixed-top navbar-expand-lg navbar-light shadow-sm pb-2" >
            <img src="{{asset('goal.png')}}" width='45'>
            <a class="navbar-brand" style="color:#112d4e" href="/">Target</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                    @role('Admin')
                    <li class="nav-item ">
                    <a class="nav-link mt-2" style="color:#112d4e;" href="{{ url('/users') }}">Users<span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item ">
                    <a class="nav-link mt-2" style="color:#112d4e;" href="{{ url('/requests') }}">System Requests<span class="sr-only">(current)</span></a>
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
                                <a class="nav-link btn btn-secondary text-light mt-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            @if(Route::currentRouteName()!='welcome')
                                <li class="nav-item">
                                    <a class="nav-link btn btn-blue text-light mt-2" href="/">{{ __('Register') }}</a>
                                </li>
                                @endif
                            @endif
                        @else
                        <li class="nav-item" style="margin-top:27px;">
                        <a href="/messages/index/{{Auth::user()->id}}">
                        <i class='far fa-comment' style='font-size:20px;color:grey;'></i>
                        </a>
                        </li>

                        <li class="nav-item   dropdown mr-2" id="alert"  >
                        
                        <a href="#" role="button" class="nav-link " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre >
                        <span class="nav-text ">
                        @if((count(get_unread_messages()))>0)
                        <span  id="alertRead">
                        <i class="far fa-bell float-left my-4 text-danger"id="alertRead"></i>
                         </span>
                         @else
                       <i class="far fa-bell float-left my-4 text-secondary"></i>
                       @endif
                       </span>
                       <span class="caret"></span>
                       </a>
                       <div class="dropdown-menu " aria-labelledby="navbarDropdown" style="background-color:#f9f7f7;" >
                       @foreach($messages=get_all_messages() as $message)
                       <a class="dropdown-item"  href="{{ url('/requests') }}" onmouseover="this.style.backgroundColor='#f9f7f7'">
                       {{$message->data['request_status']}}
                       </a>
                       @endforeach
                       
                      </li>

                        <li class="nav-item dropdown">

                       <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          <span class="nav-text " >  {{ Auth::user()->name }}</span>
                          <image src={{asset(Auth::user()->avatar)}} class="rounded-circle" width="50px" height="50px">

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
</div>
        </nav>
   
        </div>


        <main class="y-4 mb-0">
            @yield('content')
        </main>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')

<script type="text/javascript">
$(document).ready(function(){
document.getElementById("alert").addEventListener('click',function(e){
    $.ajax({
        type: "GET",
           url:  "{{ route('messages.read') }}",
           data: "{}",
           dataType: "json",
           success:function() {    
              
             document.getElementById('alertRead').classList.add('text-secondary');
          
           
      }
})
});
})
// $(function () {
//     $('#datetimepicker1').datetimepicker();
//  });
 </script>
@csrf
<script> 
  $('#show').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var youtubeUrl = button.data('url');
      var name = button.data('name');
      var modal = $(this);    
      var csrf=document.querySelector("input[name='_token']").getAttribute('value'); 
      $.ajax({
        type:'POST',
        url:'/influencers/view',
        data:{
            'url':youtubeUrl,
            '_token':csrf //pass CSRF
            },
        success:function(data){
            console.log("success");            
            console.log(data);
            youtubeData = document.getElementById('youtubeData');          
            videos = data['videoList'];
            while (youtubeData.firstChild) {
                youtubeData.removeChild(youtubeData.firstChild);
            }
            var verified = document.getElementById('verified');
            verified.classList.remove("fas");
            verified.classList.remove("fa-check-circle");
            for(i=0;i<videos.length;i++){
                var iframe = document.createElement('iframe');
                str=videos[i]['videoIframe'];
                sub=str.substring(5, str.length-1);
                console.log("here is the substring",sub)
                iframe.src = sub;
                iframe.setAttribute("width", "200");
                iframe.setAttribute("height", "200");
                iframe.setAttribute("controls", "controls");
                youtubeData.appendChild(iframe);
            }    
            $('#name').html(data['name']);
            $('#subscribers').html(data['subscribers']);
            $('#subscriptions').html(data['subscriptions']);
            $('#showPic').attr('src', data['imageUrl']);
            $('#videoCount').html(data['videoCount']);
            $('#country').html(data['country']);
            $('#about').html(data['about']);    
            if(data['verified']){
                $('#verified').attr('class',"fas fa-check-circle");
            }
            
        },
        error:function(){
                console.log("error");
        }
    });
  });
  </script>


  
  @csrf
  <script>
  $('#twitter').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) ;
    var id = button.data('idtwitter');
    var name = button.data('nametwitter');
    var auth =button.data('auth');
    var modal = $(this);
    var tableBody = document.getElementById("tweetBody");
    var post = document.getElementById("posttwitter");
    while (post.firstChild) {
        post.removeChild(post.firstChild);
            }
    while (tableBody.firstChild) {
        tableBody.removeChild(tableBody.firstChild);
            }
    var csrf=document.querySelector("input[name='_token']").getAttribute('value'); 
      $.ajax({
        type:'GET',
        url:'/influencers/twitter/'+id,
        data:{
            '_token':csrf //pass CSRF
            },
        success:function(data){
            console.log('success');
            console.log(data);
            console.log(typeof(id));
            console.log(auth);
            var table = document.getElementById("tweetTable");
            var nameTwitter = document.getElementById("nameTwitter");
            nameTwitter.innerHTML = name;
            var postBtn = document.createElement("button");
            postBtn.setAttribute("class","btn btn-primary");
            postBtn.innerHTML = "post";
            
            if(id == auth){
                post.appendChild(postBtn);             
            }
            postBtn.onclick = function () {
                location.href = "/influencers/posttwitter";
            };
            for(i = 0; i < data.length;i++){
                var container = document.createElement('div');
                var text = document.createElement("div");
                text.innerHTML = data[i]['text'];
                container.appendChild(text);
                var favorite = document.createElement("div");
                var favIcon = document.createElement("div");
                favIcon.setAttribute("class","fa fa-heart");
                favorite.appendChild(favIcon);
                var favorite_count = document.createElement("div");
                favorite_count.innerHTML = data[i]['favorite_count'];
                favorite.appendChild(favorite_count);
                container.appendChild(favorite);
                var retweet = document.createElement("div");
                var retIcon = document.createElement("div");
                retIcon.setAttribute("class","fa fa-retweet");
                retweet.appendChild(retIcon);
                var retweet_count = document.createElement("div");
                retweet_count.innerHTML = data[i]['retweet_count'];
                retweet.appendChild(retweet_count);
                container.appendChild(retweet);
                var hr = document.createElement("hr");
                container.appendChild(hr);
                tableBody.appendChild(container);
                }
            
        },
        error:function(){
            console.log('error in twitter');
        }
      
});});
</script>




<script>
    function myFunction() {
        document.getElementById("#country").disabled = true;
        }
</script>
  

</body>
</html>