@extends('layouts.app')
@section('content')
<h3 class="text-center mt-3"> Hello {{$influencer->name}}, please add Your information here. </h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@isset($msg)
                                    <div class="text-danger col-12 mt-3 offset-md-4" role="alert">
                                    <strong>{{$msg}} </strong>
                                    </div>
                                @endisset
<form method="POST" action="/influencers" id="login_form">
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
    <label>Add Your Youtube Channel </label> @if ($influencer->provider_name =='google' || $influencer->provider_name ==null) <b>(required)</b> @else <b>(optional)</b> @endif  
    <input name="youtube_url" class="form-control" type="text">
</div>

  <button type="submit" id="formSubmit" class="btn btn-primary">Submit</button>
</form>
</div>
<div class="spinner-border text-info" role="status" id="loading" style="display: block; margin: 0 auto;  visibility: hidden;">
  <span class="sr-only">Loading...</span>
</div>

@endsection
@section('scripts')
<script>
$('#login_form').submit(function() {
    $('#loading').css('visibility', 'visible');
});
</script>
@endsection