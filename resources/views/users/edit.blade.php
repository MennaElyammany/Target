@extends('layouts.app')
@section('content')

<div class="container pt-5">
<h3>Update Profile</h3>
<form method="POST" enctype="multipart/form-data" action="{{route('users.update', $user)}}">
        <input type='text' hidden name="_token" value='{{csrf_token()}}'>
        <input type='text' hidden name="_method" value='PUT'>

        <div class="form-group">
          <label for="name">Name</label>
          @if($user->provider_name==null)
          <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value='{{$user->name}}'  >
          @else <i class="text-secondary"> <small> from {{$user->provider_name}} </small> </i>
          <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value='{{$user->name}}' readonly="readonly" >
          @endif
          @error('name')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
        <label for="email">Email</label>
        @if($user->provider_name==null)
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{ $user->email }}" />
        @else <i class="text-secondary"> <small> from {{$user->provider_name}} </small> </i>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{ $user->email }}"readonly="readonly"  />
        @endif
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
    @error('youtube_url')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
</div>
@endrole
@role('Client')
<div class="form-group">
  <label for="avatar"> Attach avatar</label>
 <input type="file" class="form-control-file" name="avatar" id="avatar" >
</div>
@endrole
     
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
</div>
@endsection