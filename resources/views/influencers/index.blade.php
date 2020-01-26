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
<!-- $country_name = getCountryName($influencer->country_id);
$category_name = getCategoryName($influencer->category_id); -->
<div style=" float:left;
    width:300px;margin-left:10px">
<img class="card-img-top" src={{$influencer->avatar}}>
{{ $influencer->name}}
<!-- $category_name -->
</div>
@endforeach

        {{$influencers->links()}} 

</div>
@endsection