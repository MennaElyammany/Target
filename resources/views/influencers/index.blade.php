@extends('layouts.app')
@section('content')
<style>
.card {
/* display:inline-block!important; */
float:left!important;
margin-bottom:10px;
width: 320px;
margin-left:10px;
/* margin-right:10px; */
border-radius:10px;
}
.roboto-font{
  font-family: 'Roboto', sans-serif;
}
.text-uppercase{
  font-size:22px;
  font-weight:bold;
}
.influencers-container{
  padding:0px!important;
  margin:auto!important;
}
</style>
<div class="container-fluid">
<div style="display:flex;padding-top:35px;">
<div class="dropdown">
    <button class="font btn btn-light btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

</div>
</div>

<div style="margin-top:25px;" class="container-fluid influencers-container">
@foreach($influencers as $influencer)
<div class="card">
<div style="display:flex;">

<img class="rounded-circle"data-toggle="modal" data-target="#show" data-url="{{$influencer->youtube_url}}"
 style="display:inline-block; 100px;width: 100px; margin-top:20px;margin-right:10px;margin-left:20px" src="{{$influencer->avatar}}" alt="Card image cap">
<!-- Modal -->
 <div class="modal fade " id="show" role="dialog">
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
                <!-- <i class="fas fa-check-circle"></i> -->
                </div>
                <!-- <a href="" >   -->
                <i class="fas fa-file-signature text-dark " title="Request Influencer For Ad"></i>
                <!-- </a> -->
                <img src="https://img.icons8.com/offices/30/000000/youtube-play.png" class="m-3 ">
              </h3>
            </div>
            </div><!-- first row -->
              <span class="font-weight-bold" id="videoCount"></span>              
              <span class="font-weight-bold" style="margin-left:20px;" id="subscribers"></span>
              <span class="font-weight-bold" style="margin-left:20px;"id="subscriptions"></span>
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
    <!-- <i class='fa fa-youtube-play' style='font-size:36px;color:red;padding-left:10px;'></i> -->
    @if ($influencer->instagram_id)
    <a class="ml-2" href="/influencers/instagram/{{$influencer->id}}"><img src="{{asset('instagram.png')}}" width='30'></a>
    @endif
    @if ($influencer->twitter_id)
    <a class="ml-2" href="/twitter/tweets"><img src="twitter.png" width='30'></i></a>
    @endif
</div>
</div>
</div>
  <div style=" margin-top:20px;"class="card-body">
  @php 
$subscribers = convertNumber($influencer->followers);
echo " <div style='display:flex'>
<div class=' text-center mx-auto' style=''>
<span class=' text-uppercase roboto-font'>".$subscribers."</span>
<p style='roboto-font color:grey;'> Subscribers </p>
</div>
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

<div class="font" style="margin-top:800px;margin-left:650px;">
{{$influencers->links()}} 
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="scripts/moment-2.4.0.js"></script>
<script type="text/javascript" src="scripts/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
var reportButton = document.getElementById('report');
console.log(reportButton);


</script>

@endsection