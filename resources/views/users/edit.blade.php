@extends('layouts.app')
@section('content')

<div class="container pt-5">
<h3>Update Profile</h3>
<form method="POST" action="{{route('users.update', $user)}}">
        <input type='text' hidden name="_token" value='{{csrf_token()}}'>
        <input type='text' hidden name="_method" value='PUT'>
        <div class="form-group">
          <label for="name">Name</label>
          <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value='{{$user->name}}'>
          @error('name')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{ $user->email }}" />
        @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
@role('Influencer')
        <div class="form-group">
        <label>Select Country</label>
        <select name="country_id" class="mdb-select form-control ">
        <option value=" {{ $user->country_id }}" selected>{{ $country_name }}</option>
         @foreach($countries as $country)
         @if ($country->id == $user->country_id)
        @continue
        @endif
        <option value="{{$country->id}}">{{$country->country_name}}</option>
        @endforeach
        </select> 
        </div>

     
        <div class="form-group">
        <label>Select Category</label>
        <select name="category_id" class="mdb-select form-control">
        <option value=" {{ $user->category_id }}" selected>{{ $category_name }}</option>
        @foreach($categories as $category)
        @if ($category->id == $user->category_id)
        @continue
        @endif
        <option value="{{$category->id}}">{{$category->category_name}}</option>
        @endforeach
        </select> 
        </div>
        
<div class="form-group">
    <label>Add Your Youtube Channel</label>
    <input name="youtube_url" value="{{ $user->youtube_url }}" class="form-control" type="text">
</div>
@endrole

<img class="rounded-circle d-block" style="height: 100px;width: 100px;"  src="{{$user->avatar}}" alt="image">

        <!-- <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control"  value="{{ $user->password }}" />
        </div> -->
     
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
</div>
@endsection