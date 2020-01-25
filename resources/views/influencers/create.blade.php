@extends('layouts.app')
@section('content')
<form>
<div class="form-group">
    <label>Select Country</label>
    <select name="country_id" class="mdb-select md-form">
  <option value="" disabled selected>--</option>
  @php 
  $countries=listCountries();
   echo $countries;
  @endphp
 


</select>
  </div> 
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection