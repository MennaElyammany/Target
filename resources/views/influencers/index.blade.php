@extends('layouts.app')
@section('content')
<style>
    .fa-star,.fa-star-half {
        color: #ffc60b;
    }
    .card {
        /* display:inline-block!important; */
        float: left !important;
        margin-bottom: 10px;
        width: 320px;
        margin-left: 10px;
        /* margin-right:10px; */
        border-radius: 10px;
    }
    .roboto-font {
        font-family: 'Roboto', sans-serif;
    }
    .text-uppercase {
        font-size: 22px;
        font-weight: bold;
    }
    .influencers-container {
        padding: 0px !important;
        margin: auto !important;
    }
    .colInsta{
        /* border:solid;
        border-color:white; */
      border-radius: 20px;
      margin-top:7px;
    }
    .twitter-dialog{
      overflow-y: initial !important
    }
  .twitter-body{
    height: 500px;
    overflow-y: auto;
  }
</style>
<i class="glyphicon glyphicon-star-empty"></i>

<div class="container-fluid">
    <div style="display:flex;padding-top:35px;">
        <div class="dropdown">
            <button class="font btn btn-light btn-lg dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Categories
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="font dropdown-item" href="/influencers/?category_id=1">Beauty</a>
                <a class="font dropdown-item" href="/influencers/?category_id=2">Food</a>
                <a class="font dropdown-item" href="/influencers/?category_id=3">Vlogs</a>
                <a class="font dropdown-item" href="/influencers/?category_id=4">Gaming</a>
                <a class="font dropdown-item" href="/influencers/?category_id=5">Entertainment</a>
                <a class="font dropdown-item" href="/influencers/?category_id=6">Science</a>
                <a class="font dropdown-item" href="/influencers/?category_id=7">Music</a>
            </div>
        </div>



        <div class="dropdown">
    <button class="font btn btn-light btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Countries
  </button>
  <div class="font dropdown-menu" aria-labelledby="dropdownMenuButton">
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>1])}}">Egypt</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>2])}}">Bahrain</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>3])}}">Iraq</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>4])}}">Jordan</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>5])}}">Kuwait</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>6])}}">Lebanon</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>7])}}">Oman</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>8])}}">Qatar</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>9])}}">Saudi Arabia</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>10])}}">Syria</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>11])}}">United Arab Emirates</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>12])}}">Tunisia</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>13])}}">Algeria</a>
  <a class="font dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>14])}}">Morocco</a>

  </div>
  
  <a href="/influencers" class="font">Remove filter</a>
</div>
<div style="margin-left:20px;margin-top:10px;">
Sort:
<a href="/influencers/?sort=asc">Ascending</a>
<a href="/influencers/?sort=desc">Descending</a>
</div>

</div>


</div>
<div style="margin-top:25px;" class="container-fluid influencers-container">
@foreach($influencers as $influencer)
<div class="card">
<!-- <div class="card" onclick="window.location='/influencers/{{$influencer->id}}'"> -->
<div style="display:flex;">

<img class="rounded-circle"style="display:inline-block; 100px;width: 100px; margin-top:20px;margin-right:10px;margin-left:20px" 
src="{{$influencer->avatar}}" alt="Card image cap"
data-toggle="modal" data-target="#show" data-url="{{$influencer->youtube_url}}">

<!-- Youtube Modal -->
 <div class="modal fade" id="show" role="dialog">
    <div class="modal-dialog" style="max-width:1000px; overflow-y: initial !important">    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body"style=" height: 500px;overflow-y: auto;">
        <div class="row">
        <!--left container-->
        <div class='col-5'> 
          <div class="row">   
              <div id="youtubeData">
            </div>
          </div>
        </div>
        <!-- end of left container -->
      <!-- right container -->          
      <div class='col-7'>
          <div class="row"> <!-- first row -->
            <div class ='col-3'>
                <img src="" id="showPic" class="rounded-circle" style="width:60px;height:60px">
            </div>
            <div class='col-9'>
              <h3>
                <div id="name"></div>
                <div id="verified">
                </div>
                <!-- <a href="" >   -->
                <i class="fas fa-file-signature text-dark " title="Request Influencer For Ad"></i>
                <!-- </a> -->
                <img src="https://img.icons8.com/offices/30/000000/youtube-play.png" class="m-3 ">
              </h3>
            </div>
            </div><!-- first row -->
              <span class="font-weight-bold" id="videoCount"></span>              
              <span class="font-weight-bold" style="margin-left:40px;" id="subscribers"></span>
              <span class="font-weight-bold" style="margin-left:40px;"id="subscriptions"></span>
              <!-- <span> <h3 class="font-weight-bold"id="engagement">x</h3></span> -->
              <br>
              <span style="margin-right:20px;" >Videos </span>             
              <span style="margin-right:20px;">Subscribers </span>             
              <span style="margin-right:20px;">Subscription </span>   
              <span>Engagement</span> 
              <br>
              
            
            
            <span id="country"></span><br>            
            <span id="about"></span>       
            
            
                  
           
        </div><!-- right container -->           
        </div>  <!--row container--> 
        </div>  <!--modalbody-->
        

        <!--<label for="url">URL</label>
		        	<input type="text" class="form-control" name="title" id="input">
              <label for="name">Name</label>
              </div> -->
      </div><!--modal-content-->
    </div><!--modal-dialog-->
  </div><!--modal-->
<div style=" margin-top:40px;width:200px;height:50px;">
<h5 style="font-size:25px;" class="roboto-font card-title"onclick="window.location='/influencers/{{$influencer->id}}'">{{$influencer->name}}</h5>
<div>
    @if($influencer->verified)
    <img src='verified.png'style='margin-left:10px;width:15px;height:15px;'>
    @endif
    @if($influencer->youtube_url)
    <a class='fa fa-youtube-play' style='font-size:36px;color:red;padding-left:10px;margin-top:10px;' href="/influencers/{{$influencer->id}}"></a>
    @endif

        <!-- INSTAGRAM -->
        @if ($influencer->instagram_id)
<!-- "href="/influencers/instagram/{{$influencer->id}}" -->
    <a id ="instaButton" class="ml-2" href data-toggle="modal" data-target="#showInstaMedia" data-idinsta="{{$influencer->id}}" data-nameinsta="{{$influencer->name}}" data-imginsta="{{$influencer->avatar}}" data-influencer="{{$influencer}}">
    <img src="{{asset('instagram.png')}}" style="vertical-align:top; margin-top:13px"  width='29'></a>
    <div class="modal fade" id="showInstaMedia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" style="max-width:1400px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="title">
            <div class = "col-6">
            </div>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div><!-- header -->
          <div class="modal-body row" id="instaBody">
              <div class='col-6 modal-body mx-0  border-right' style="height:500px; overflow-y:auto;" id="instaMedia">
                </div>  <!--media-->
              <div class='col-6  mx-0 ' style="height:500px; overflow-y:auto;" id="instaInfo">
              <div class="row">
                            <div class="col-4">
                                <img id="instaImg" class="rounded-circle img-fluid">
                            </div>
                            <div class="col-8 mt-4">
                            <div class="row" id="row1">
                              <h3 id="instaName" class='d-inline'> </h3>
                              @if(has_uncompleted_request($influencer->id) && Auth::User()->isNotBanned())
                                  <a id='request_link' href=""  >  <i class="fas fa-lg fa-file-signature text-dark ml-2" title="Request Influencer For Ad"></i></a>
                              @endif
                                  <a id='message_link' href=""> <i class='far fa-comment ml-2' style='font-size:26px;color:grey;' title="Message Influencer"></i></a>
                                </div> <!--row1-->
                            <div class="row" id="row2">
                            <h5 id="instaUsername" class='d-inline'> </h5>
                            <img class='ml-2 d-inline' src='instagram.png' width='25' height='25'>
                            </div> <!--row2-->
                      
                            </div> <!--col8-->
                            
                 </div> <!--row-->           
                  <hr>
                 <div id="statistics">
                        <div class="row no-gutters text-center">
                            <div class="col-3">
                                <h3 class="font-weight-bold" id="media_count"></h3>
                                <span >photos</span>
                            </div>
                            <div class="col-3">
                                <h3 class="font-weight-bold" id="follower_count"></h3>
                                <span >followers</span>
                            </div>
                            <div class="col-3">
                                <center>
                                    <h3 class="font-weight-bold" id="follows_count"></h3>
                                </center>
                                <span>Subscriptions</span>
                            </div>
                            <div class="col-3">
                                <center>
                                    <h3 class="font-weight-bold" id="engagement"></h3>
                                </center>
                                <span>Engagement</span>
                            </div>
                        </div>
                    </div> <!--statistics-->
                    <br>
                    <div id="instaAbout" class='container' >
                    <p id='instaBiography'></p>
                    <img src="https://img.icons8.com/offices/30/000000/globe.png" class='d-inline' width='25'>  
                   
                    <h6 id='instaCountry' class='d-inline ml-1'> </h6>
                   <br>
                    </div>
                    <div class="container mt-5">
    <h3>Core Metrics</h3>
    <div class="card mb-3" style="width:100%">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> Photo Post Metrics </div>
        <div class="card-body" >
@php 
$engagement=calcInstagramEngagement($influencer->id);
         echo   '<div style=" display:inline-block; float:left;margin-right:50px;margin-left:100px;">
                <center> 
                  <p> Average Likes: <br><b style="font-size:40px;">'.$engagement['averageLikes'].' </b>
                </center>
            </div>
            <div>
                <center>
                <p> Average Comments:  <br> <b style="font-size:40px;">'.$engagement['averageComments'],'</b>';
                  @endphp


                </center>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at @php echo date('F j, Y', time() ) @endphp</div>
    </div>
    <!-- Area Chart Example-->
    <div style="width:100%;" class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> Followers Growth </div>
        <div class="card-body">
            <canvas id="myChart" width="100%" height="60"></canvas>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at @php echo date('F j, Y', time() ) @endphp</div>
    </div>
    <div  style="width:100%;" class="card mb-3">
        <div class="card-header mt-3">
            <i class="fa fa-area-chart"></i> Audience Insights</div>
        <div class="card-body mt-3">
            <canvas id="GenderChart" width="100%" height="70"></canvas>
        </div>
        <div class="card-body mt-3">
            <canvas id="LocationChart" width="100%" height="70"></canvas>
        </div>
        <div>
            <canvas id="AgeChart" width="100%" height="70"></canvas>

        </div>

        <div class="card-footer small text-muted">Updated yesterday at @php echo date('F j, Y', time() ) @endphp</div>
    </div>
</div>



                </div>  <!--info-->
          </div><!-- body -->
        </div><!-- content -->
      </div><!-- modal dialog -->
    </div><!-- modal -->
    @endif







    <!-- TWITTER -->

    @if ($influencer->twitter_id)
    <a class="ml-2" data-toggle="modal" data-target="#showTwitter" >    
    <img src="twitter.png" width='30'class="ml-2" data-toggle="modal" data-target="#twitter" data-followers="{{$influencer->followers}}"
    data-idtwitter="{{$influencer->id}}" data-img="{{$influencer->avatar}}"data-nametwitter="{{$influencer->name}}" data-auth="{{Auth::user()->id}}"></a>
    <div class="modal fade" id="twitter" tabindex="-1" role="dialog">
    <div class="modal-dialog twitter-dialog" role="document" style="max-width:800px;">
    <div class="modal-content">
      <div class="modal-header">
      <img id="Img" class="rounded-circle"
      style="height:50px;width:50px;margin-right:10px;margin-left:20px">
      <!-- <div class=row -->
      <div style=" display: block;">
      <h5 class="modal-title" style="font-weight: bold;"id="nameTwitter"></h5>
      <div style="color:grey"id="nickname"></div> 
      <div style=""id="description"></div>
      <a href style=""id="expanded_url"></a>
      </div>
      
     
      <div style=" display: block;">
      <div style="margin-left:100px;margin-top:5px;margin-bottom:5px;">
            <a href="/messages/create/{{$influencer->id}}"id="message">
            <i class='far fa-comment' style='font-size:20px;color:grey;margin-right:15px;margin-top:10px;'></i></a>
            <a href="{{ route('requests.create',['influencer_id'=> $influencer->id])}}">
            <i class="fas fa-file-signature text-dark "></i></a>      
      </div>
      <div  style="margin-left:100px;">
      <div style="display:flex;">
      <div style="display:block">
      <i class="fa fa-globe" style="margin-left:10px;"aria-hidden="true"></i>
      <div id="locTwitter"></div>
      </div>
      <div style="display:block">
      <div style="margin-left:60px;font-weight: bold;"id="followers"></div>
      <div style="margin-left:50px;"> Followers </div>
      </div>
      <div style="display:block">
      <div style="margin-left:60px;font-weight: bold;" id="friends_count"></div>
      <div style="margin-left:40px;"> Following </div>
      </div>
      <div style="display:block">
      <div style="margin-left:60px;font-weight: bold;"id="statuses_count"></div>
      <div style="margin-left:50px;"> Tweets </div>
      </div>
      
      </div>
      </div>
      </div>
      
      
      


        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div><!--modal-header-->
      <div class="modal-body twitter-body">
            <table class="table"id="tweetTable">
              <thead>
                <tr>
                
                <th class="col-3">Tweets</th>
                
                <th class="col-9" id="posttwitter"></th>
                
                </tr>
                <!-- <tr>
                <p>
                </p>
                </tr> -->
              </thead>
              <tbody id="tweetBody">

              <tbody>
              </table>
      </div><!--modal-body-twitter"-->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal fade -->
@endif



    
</div>
<div class="mt-2"style="display:flex;width:300px;height:80px;margin-right:10px;">
                    <!-- <span style="margin-bottom:0px;"> {{$influencer->averageRating}}</span> -->
                    @php $rating = roundAverageRating($influencer->averageRating); @endphp  
                    @foreach(range(1,5) as $i)
                    <div class="fa-stack" style="margin-right:5px;gbackground-color:black;width:15px">
                        <i class="far fa-star fa-stack-1x"></i>

                        @if($rating>0)
                            @if($rating>0.5)
                            <i class="fas fa-star fa-stack-1x"></i>
                            @else
                            <i class="fas fa-star-half fa-stack-1x"></i>
                        @endif
                        @endif
                        @php $rating--; @endphp
                    </div>
                    @endforeach

                </div>


</div>
</div>
  <div style=" margin-top:20px;"class="card-body">
  @php 
$subscribers = convertNumber($influencer->followers);
echo " <div style='display:flex'>
<div class=' text-center mx-auto' style=''>
<span class=' text-uppercase roboto-font'>".$subscribers."</span>
<p style='roboto-font color:grey;'> Subscribers";
    if($influencer->provider_name=='facebook'&& $influencer->instagram_id!=null)
     echo "<br><i class='text-secondary'> <small> on instagram </small> </i> </p>";
    else if($influencer->provider_name=='twitter')
    echo "<br><i class='text-secondary'> <small> on twitter </small> </i> </p>";
    else 
    echo "<br><i class='text-secondary'> <small> on youtube</small> </i> </p>";
echo"</div>
<div class='text-center mx-auto' style=' '>
<span class='roboto-font text-uppercase'>".$influencer->engagement."%</span>
<p style='roboto-font color:grey;'>Engagement</p>
</div>
</div>";
$category_name = getCategoryName($influencer->category_id);
$country_name = getCountryName($influencer->country_id);
echo "    <div style='display: flex;'>
          <i class='fas fa-tag'style='color:grey;margin-left: 5px;margin-top:5px;'></i>
          <p class='font card-title'style='margin-right:10px;margin-left:10px'>".$category_name[0]->category_name."</p>
          </div>
          <div style='display: flex;'>
          <i class ='fas fa-map-marker-alt'style='color:grey; margin-left: 5px;margin-top:5px;'></i>
          <p class='font card-title'style='margin-right:10px;margin-left:10px'>".$country_name[0]->country_name."</p>
          </div>
        ";
@endphp
</div>
</div>  
</div>
@endforeach

<div class="font" style="margin-top:800px;margin-left:650px;">
    {{$influencers->links()}}
</div>
@endsection
@section('scripts')
<!-- @csrf -->
<script>
  $('#showInstaMedia').on('show.bs.modal', function (event) {
    // var csrf=document.querySelector("input[name='_token']").getAttribute('value'); 
    var button = $(event.relatedTarget) 
    var influencer= button.data('influencer');
    // console.log(inf.country_id);
    var modal = $(this);
    var instaBody = document.getElementById("instaBody");
    var instaMedia = document.getElementById("instaMedia");
    //first row in instaInfo
    var instaName = document.getElementById("instaName");
    var request_link=document.getElementById("request_link");
    var message_link=document.getElementById("message_link");
    var instaImg = document.getElementById("instaImg");
    var instaUsername=document.getElementById("instaUsername");
    //second row in insta info
    var media_count=document.getElementById("media_count");
    var follower_count=document.getElementById("follower_count");
    var follows_count=document.getElementById("follows_count");
    var engagement=document.getElementById("engagement");
    //3rd part in insta info
    var biography=document.getElementById("instaBiography");
    var country=document.getElementById("instaCountry");
//fill instaMedia
    while (instaMedia.firstChild) {
        instaMedia.removeChild(instaMedia.firstChild);
            }
      $.ajax({
        type:'GET',
        url:'/influencers/instagram/'+influencer.id,
        data:{ 
            // '_token':csrf //pass CSRF
        },
        success:function(data){
          console.log("success");
          console.log(data);
          var media=data[7];
          var row = document.createElement('div');
            row.classList.add("row");
          for(i=0;i<media.length;i++){             
            col = document.createElement('div');
            col.classList.add('col-6','mb-4','text-center');
            var img = document.createElement("IMG");
            var likes = document.createElement("i");
            var comments = document.createElement("i");
            img.src = media[i][0];
            img.classList.add('colInsta','img-fluid');
            likes.innerHTML=media[i][1];            
            likes.setAttribute("class", "far fa-thumbs-up mr-3");
            comments.innerHTML=media[i][2];
            comments.setAttribute("class", "far fa-comment");
            col.appendChild(img);
            col.appendChild(likes);
            col.appendChild(comments);
            row.appendChild(col);
            }
          instaMedia.appendChild(row);
          //fill instaInfo
          instaImg.src=influencer.avatar;
          instaName.innerHTML = influencer.name;
          request_link.href="requests/create?influencer_id="+influencer.id;
          message_link.setAttribute("href","/messages/create/"+influencer.id);
          instaUsername.innerHTML='('+data[0]+')';
          media_count.innerHTML=data[1];
          follower_count.innerHTML=data[2];
          follows_count.innerHTML=data[3];
          engagement.innerHTML=data[4]+'%';
          biography.innerHTML=data[5];
         
          country.innerHTML=data[6];
        },
        error:function(){
          console.log("error");
        }
      });
  
  });
</script>
@endsection