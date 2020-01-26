@extends('layouts.app')
@section('content')
<h3 class="text-center"> Hello {{$influencer->name}}, please add Your information here. </h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="/influencers">
@csrf
<div class="form-group">
    <label>Select Country</label>
    <select name="country_id" class="mdb-select md-form form-control form-control-md">
  <option value="" disabled selected>--</option>
  @foreach($countries as $country)
  <option value="{{$country->id}}">{{$country->country_name}}</option>
  @endforeach
</select> 

</div>
<div class="form-group">
    <label>Select Category</label>
    <select name="category_id" class="mdb-select md-form form-control">
  <option value="" disabled selected>--</option>
  @foreach($categories as $category)
  <option value="{{$category->id}}">{{$category->category_name}}</option>
  @endforeach
</select> 
</div>
<div class="form-group">
    <label>Add Your Youtube Channel</label>
    <input name="youtube_url" class="form-control" type="text">
</div>
<div class="form-group">
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="role" id="inlineRadio1" value="influencer">
  <label class="form-check-label" for="inlineRadio1">Influencer</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="client">
  <label class="form-check-label" for="inlineRadio2">Client</label>
</div>
</div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection