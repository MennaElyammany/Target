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
      border-radius: 20px;
      margin-top:7px;
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

<!-- Modal -->
 <div class="modal fade" id="show" role="dialog">
    <div class="modal-dialog" style="max-width:1000px;">    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
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
    <a class="ml-2"
    data-toggle="modal" data-target="#showInstaMedia" data-idinsta="{{$influencer->id}}" data-nameinsta="{{$influencer->name}}">
    <img src="{{asset('instagram.png')}}" style="vertical-align:top; margin-top:13px"  width='29'></a>
    <div class="modal fade" id="showInstaMedia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" style="max-width:1000px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="title">
            <div class = "col-6"><a href="{{ route('requests.create',['influencer_id'=> $influencer->id]) }}" >
            <i class="fas fa-file-signature text-dark "></i></a></div>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div><!-- header -->
          <div class="modal-body"id="instaBody">
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
    @endif
    <div class="modal fade" id="twitter" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width:800px;">
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
            <a href="/messages/create/{{$influencer->id}}">
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
      <div class="modal-body">
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
<span class='roboto-font text-uppercase'>3.6%</span>
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

<div class="font" style="margin-top:1320px;margin-left:650px;">
    {{$influencers->links()}}
</div>
@endsection
@section('scripts')
@csrf
<script>
  $('#showInstaMedia').on('show.bs.modal', function (event) {
    var csrf=document.querySelector("input[name='_token']").getAttribute('value'); 
    var button = $(event.relatedTarget) 
    var id = button.data('idinsta');
    var name = button.data('nameinsta');
    console.log("id",button.data('id'));
    console.log("name",name)
    var modal = $(this);
    var tableBody = document.getElementById("instaBody");
    var title = document.getElementById("title");
    nameDiv = document.createElement('div');
    nameDiv.innerHTML = name;
    // nameDiv.classList.add("col-6");
    title.appendChild(nameDiv);
    while (tableBody.firstChild) {
        tableBody.removeChild(tableBody.firstChild);
            }
      $.ajax({
        type:'GET',
        url:'/influencers/instagram/'+id,
        data:{ 
            '_token':csrf //pass CSRF
        },
        success:function(data){
          console.log("success");
          console.log(data);
          var row = document.createElement('div');
            row.classList.add("row");
          for(i=0;i<data.length;i++){             
            col = document.createElement('div');
            col.classList.add('col-4');
            var img = document.createElement("IMG");
            img.src = data[i];
            img.width = "280";
            img.height = "280";
            img.classList.add('colInsta');
            col.appendChild(img);
            row.appendChild(col);
            }
          tableBody.appendChild(row);
        },
        error:function(){
          console.log("error");
        }
      });
  
  });
</script>
@endsection