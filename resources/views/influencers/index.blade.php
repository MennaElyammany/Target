@extends('layouts.app')
@section('content')

<style>
.influencer{
    float:left;
    width:200px;
    
}
</style>
<div class="container-float">
    <h1>List of influencers</h1>
    Filter:
    <a href="/influencers/?category_id=1">Fashion</a>|
    <a href="/influencers/?category_id=2">Singers</a>|
    <a href="/influencers">Reset</a>
    <hr>

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