@extends('layouts.app')
@section('content')

<style>
.influencer{
    float:left;
    width:200px;
    
}
</style>
<div class="container">
    <h1>List of influencers</h1>
<div style="display: flex;">
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Categories
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="/influencers/?category_id=1">Beauty</a>
    <a class="dropdown-item" href="/influencers/?category_id=2">Food</a>
    <a class="dropdown-item" href="/influencers/?category_id=3">Vlogs</a>
    <a class="dropdown-item" href="/influencers/?category_id=4">Gaming</a>
    <a class="dropdown-item" href="/influencers/?category_id=5">Entertainment</a>
    <a class="dropdown-item" href="/influencers/?category_id=6">Science</a>
    <a class="dropdown-item" href="/influencers/?category_id=7">Music</a>
  </div>  
</div>



<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Countries
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>1])}}">Egypt</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>2])}}">Bahrain</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>3])}}">Iraq</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>4])}}">Jordan</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>5])}}">Kuwait</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>6])}}">Lebanon</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>7])}}">Oman</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>8])}}">Qatar</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>9])}}">Saudi Arabia</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>10])}}">Syria</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>11])}}">United Arab Emirates</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>12])}}">Tunisia</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>13])}}">Algeria</a>
  <a class="dropdown-item" href="{{route('influencers.index',['category_id'=>request('category_id'),'country_id'=>14])}}">Morocco</a>

  </div>
  
  <a href="/influencers">Reset</a>
</div>
</div>


@foreach($influencers as $influencer)



<div class="card influencer" style="width: 18rem;">
<div style="display: flex;">
  <img class="rounded-circle" style="height: 100px;width: 100px; margin-top:20px;margin-right:10px;margin-left:20px" src="{{$influencer->avatar}}" alt="Card image cap">
  <h5 class="card-title influencer" style="margin-top:40px;" >{{ $influencer->name}}</h5>
</div>
    @php
    $subscribers = convertNumber($influencer->followers);
    echo "<h2><b>".$subscribers."</b></h2>";
    $category_name = getCategoryName($influencer->category_id);
    $country_name = getCountryName($influencer->country_id);
    echo "<div style='display: flex;'>";
    echo "<i class ='fas fa-map-marker-alt'style='margin-left: 5px;margin-top:5px;'></i>";
    echo "<h5 class='card-title'style='margin-right:10px;margin-left:10px'>".$country_name[0]->country_name."</h5>";
    echo "</div>";
    echo "<div style='display: flex;'>";
    echo "<i class='fas fa-tag'style='margin-left: 5px;margin-top:5px;'></i>";
    echo "<h5 class='card-title'style='margin-right:10px;margin-left:10px'>".$category_name[0]->category_name."</h5>";
    echo "</div>";
    @endphp
</div>
@endforeach
{{$influencers->links()}} 

</div>
@endsection