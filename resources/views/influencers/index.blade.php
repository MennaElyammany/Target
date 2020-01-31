@extends('layouts.app')
@section('content')

<style>
.influencer{
    float:left;
    
}
.font{
  font-family: 'Pacifico';
}
</style>
<div class="container">
    <h1 style="font-family: 'Pacifico', cursive;font-size: 35px;padding-top:30px;">List of influencers</h1>
<div style="display: flex;">
<div class="dropdown">
    <button class="font btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    <button class="font btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
<br><b>

@foreach($influencers as $influencer)


    <div class="card influencer " style="width: 18rem; margin-left:20px; padding-left:10px;">
    <div style="display: flex;">
    <div class="container">

    <img role="button" data-toggle="modal" data-target="#show" data-url="{{$influencer->youtube_url}}"  class="rounded-circle" style="height: 100px;width: 100px; margin-top:20px;margin-right:10px;margin-left:20px" src="{{$influencer->avatar}}" alt="Card image cap">
    
    <div>
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
		        	<input type="text" class="form-control" name="title" id="url">
              <!-- <label for="url">Name</label>
		        	<input type="text" class="form-control" name="title" id="name"> -->
             
	      </div>
        </div>       
      </div>
      
    </div>
  </div>
  
</div>

</div>




    <div>
    <p class="influencer" style="margin-top:30px;font-family: 'Pacifico', cursive;font-size: 30px;height: 40px;width: 110px;" >{{ $influencer->name}}</p>   
    <i class='fa fa-youtube-play' style='font-size:36px;color:red;padding-left:10px;'></i>
    <div style='float:left;'>
    @if($influencer->verified)
    <img src='verified.png'style='width:30px;height:30px;'>
    @endif
    </div>
    </div>
    </div>

    @php
    
    
    if(!$influencer->followers){
      $influencer->followers = 0;}
    $subscribers = convertNumber($influencer->followers);
    echo "<h5 class='font'style='width:120px;height:30px;'><b>".$subscribers."</b></h5>";
    $category_name = getCategoryName($influencer->category_id);
    $country_name = getCountryName($influencer->country_id);
    echo "<div style='display: flex;'>";
    echo "<i class ='fas fa-map-marker-alt'style='margin-left: 5px;margin-top:5px;'></i>";
    echo "<h5 class='font card-title'style='margin-right:10px;margin-left:10px'>".$country_name[0]->country_name."</h5>";
    echo "</div>";
    echo "<div style='display: flex;'>";
    echo "<i class='fas fa-tag'style='margin-left: 5px;margin-top:5px;'></i>";
    echo "<h5 class='font card-title'style='margin-right:10px;margin-left:10px'>".$category_name[0]->category_name."</h5>";
    echo "</div>";
    
    @endphp
    


</div>



@endforeach
<div class="font" style="margin-top:400px;">
{{$influencers->links()}} 
</div>
</div>



@endsection