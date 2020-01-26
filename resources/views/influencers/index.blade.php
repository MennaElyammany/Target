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
    <a href="/influencers/?category_id=1">Fashion|</a>
    <a href="/influencers/?category_id=2">Singers|</a>
    <a href="/influencers">Reset</a>
    <hr>

@foreach($influencers as $influencer)



<div class="card influencer" style="width: 18rem;">
  <img class="card-img-top" src="{{$influencer->avatar}}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{ $influencer->name}}</h5>
    <h5 class="card-title">{{ $influencer->followers}}</h5>
    @php
    $category_name = getCategoryName($influencer->category_id);
    $country_name = getCountryName($influencer->country_id);
    echo "<i class = "fas fa-map-market-alt mr-l"></i>";
    echo "<h5 class='card-title'>".$country_name[0]->country_name."</h5>";
    echo "<h5 class='card-title'>".$category_name[0]->category_name."</h5>";
    @endphp
  </div>
</div>
@endforeach
{{$influencers->links()}} 

</div>
@endsection