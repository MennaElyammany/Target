@extends('layouts.app')
@section('content')

<br><br>
<div class="card mb-3 " style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="{{(asset('storage/'.$request->product_image))}}" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title font-weight-bold text-primary">Request From {{$request->company_name}}</h5>
         <p class="font-weight-bold " >Description: 
         <span class="float-right"><a  href="{{$request->website_url}}" >Visit Website</a>
        </span></p> 
         <div class="border">
         {{$request->description}}

       </div>
        <p> <span class="font-weight-bold" >Requested Date:</span> {{$request->ad_date}}</p>

        <p> <span class="font-weight-bold" >Type:</span> {{$request->type}}</p>
        @if($request->status=='waiting')
        <form class="form-inline" method="POST" action="/requests/accept/{{$request->id}}">
        @csrf
        <div class="form-group mb-2">
       <label for="Price" class="sr-only">Enter Price</label>
       <input type="text" name="price" placeholder="Price in $">
       </div>
     <button type="submit" class="btn  btn-outline-secondary mb-2">Accept</button>
     <a class="btn btn-outline-danger my-3 "href="/requests/decline/{{$request->id}}" role="button" >Decline</a>
@endif
     </form>

      

        

      </div>
    </div>
  </div>
</div>

@endsection