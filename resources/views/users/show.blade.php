@extends('layouts.app')
@section('content')
<br><br><br>
<div class="container row pt-5">
<div class="col-4 text-center">
<img class=" d-block w-75 mb-1 mx-auto" src="{{$user->avatar}}" alt="image"> 
<h3 class="mb-4">{{$user->name}}</h3>
<a class="btn btn-success mx-auto d-block w-50" href="{{ route('users.edit',['user' => Auth::user()->id ])}}">Edit Profile</a>
</div>

<div class="col-8">
<div class="card  mx-auto">
<div class="card-header">{{ __('Profile') }}</div>

    <div class="card-body">
    <table class="table ">
    <tr   style="width: 200px; border-top:0px;">
    <td  style="text-align:center border-top:0px;" ><p class="font-weight-bold "> Name </td>
    <td style="text-align:center border-top:0px;">  {{ $user->name }} </td>
    </tr>
    <tr   style="width: 200px;">
    <td  style="text-align:center" ><p class="font-weight-bold "> Email </td>
    <td style="text-align:center">  {{ $user->email }} </td>
    </tr>
    <tr   style="width: 200px;">
    <td  style="text-align:center" ><p class="font-weight-bold "> Country </td>
    <td style="text-align:center">  {{ $country_name }} </td>
    </tr>
    <tr   style="width: 200px;">
    <td  style="text-align:center" ><p class="font-weight-bold "> Category </td>
    <td style="text-align:center">  {{ $category_name }} </td>
    </tr>
    </table>
</div>
</div>
</div>