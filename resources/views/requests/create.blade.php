@extends('layouts.app')
@section('content')
<div class="container pt-5">
<form method="POST" action="{{route('requests.store',['influencer_id'=> $influencer_id]) }}" enctype="multipart/form-data">
@csrf
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Company Name</label>
      <input type="text" class="form-control" name="company_name">
    </div>
    <div class="form-group col-md-6">
      <label >Website Url</label>
      <input type="text" class="form-control" name="website_url">
    </div>
  </div>
  <div class="form-group">
    <label>Brand Description</label>
    <textarea class="form-control" name="description" rows="4"></textarea>
  </div>
  <div class="form-row">
 
    <div class="form-group col-md-6">
      <label for="inputState">Type</label>
      <select name="type"class="form-control">
        <option selected>Choose Type</option>
        <option value="image">Image</option>
        <option vlaue="story">Story</option>
        <option value="video">Video</option>
      </select>
    </div>

    <div class="form-group col-md-6">
    <label >Sechedule Date</label>
    <input type="date" class="form-control" name="ad_date">
      </select>
    </div>
    
    
  </div>
  <div class="form-group">
    <label for="avatar"> </label>
    <input type="file" class="form-control-file" name="product_image" >
        </div>
@if ($influencer_id!=null)
@if(has_uncompleted_request($influencer_id))
  <button type="submit" class="btn btn-primary">Submit Request</button>
  @else
  <h3 class="text-danger"> You already have uncompleted request with this influencer please see your requests at
  <a href='/requests'>requests</a></h3>
  @endif
  @else
  <h3 class="text-danger"> please go back and choose specific influencer for ad </h3>
</form>
@endif
</div>
</div>
</div>
@endsection