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

<div style="margin-top:25px;" class="container-fluid influencers-container" >
@foreach($influencers as $influencer)
<div class="card" onclick="window.location='/influencers/{{$influencer->id}}'">
<div style="display:flex;">

<img class="rounded-circle"data-toggle="modal" data-target="#show" data-url="{{$influencer->youtube_url}}"
 style="display:inline-block; 100px;width: 100px; margin-top:20px;margin-right:10px;margin-left:20px" src="{{$influencer->avatar}}" alt="Card image cap">
<!-- Modal -->
 <div class="modal fade" id="show" role="dialog">
    <div class="modal-dialog">    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <div class="form-group">
		        	<label for="url">URL</label>
		        	<input type="text" class="form-control" name="title" id="input">
              <!-- <label for="url">Name</label>
		        	<input type="text" class="form-control" name="title" id="name"> -->
             
	      </div>
        </div> 
      </div><!--modal-content-->
    </div><!--modal-dialog-->
  </div><!--modal-->
<div style=" display:flex;margin-top:40px;width:200px;height:50px;">
<h5 style="font-size:25px;" class="roboto-font card-title"onclick="window.location='/influencers/{{$influencer->id}}'">{{$influencer->name}}</h5>



<div>
    @if($influencer->verified)
    <img src='verified.png'style='margin-left:10px;width:15px;height:15px;'>
    @endif
    <!-- <i class='fa fa-youtube-play' style='font-size:36px;color:red;padding-left:10px;'></i> -->

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