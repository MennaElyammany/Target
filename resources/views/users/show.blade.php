@extends('layouts.app')
@section('content')
<br><br><br>
<div class="container row pt-5">
<div class="col-4 text-center">
<img class="  w-75 mb-2 mx-auto" src="{{$user->avatar}}" alt="image"> 
<h3 class="mb-4">{{$user->name}}</h3>
<a class="btn btn-success mx-auto d-block w-50" href="{{ route('users.edit',['user' => $user->id ])}}">Edit Profile</a>
</div>

<div class="col-lg-6 col-8 mx-auto">
<div class="card ">
<div class="card-header">{{ __('Profile') }}</div>    
<div class="card-body mx-auto ">
    <table class="table table-responsive ">
    <tr style="border-top:0px;">
    <td  style="text-align:center; border-top:0px;" ><p class="font-weight-bold "> Name </td>
    <td style="text-align:center; border-top:0px;">  {{ $user->name }} </td>
    </tr>
    <tr   >
    <td  style="text-align:center" ><p class="font-weight-bold "> Email </td>
    <td style="text-align:center">  {{ $user->email }} </td>
    </tr>
    @role('Influencer|Admin')
    @if($user->role=='Influencer')
    <tr   >
    <td  style="text-align:center" ><p class="font-weight-bold "> Country </td>
    <td style="text-align:center">  {{ $country_name }} </td>
    </tr>
    <tr   >
    <td  style="text-align:center" ><p class="font-weight-bold "> Category </td>
    <td style="text-align:center">  {{ $category_name }} </td>
    </tr>
    <tr   >
    <td  style="text-align:center" ><p class="font-weight-bold "> Youtube Channel </td>
    <td style="text-align:center">  <a href= '{{ $user->youtube_url }}'> View My Channel</a> </td>
    </tr>
    <tr   >
    <td  style="text-align:center" ><p class="font-weight-bold "> Number of Followers </td>
    <td style="text-align:center">   {{ $user->followers }} </td>
    </tr>
    @endif
    @endrole
    </table>
</div>
</div>
</div>
</div>