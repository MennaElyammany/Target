@extends('layouts.app')
@section('content')
@role('Influencer')
<br><br>
<div class="card mb-3 " style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="{{asset('storage/'.$request->product_image)}}"class="card-img" alt="...">
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
        @if($request->modified_date)
        <p> <span class="font-weight-bold text-danger" >new requested date</span> {{$request->modified_date}}</p>
@endif
        <p> <span class="font-weight-bold" >Type:</span> {{$request->type}}</p>

        @if($request->status=='waiting')
        <form class="form-inline" method="POST" action="/requests/{{$request->id}}">
        @csrf
        @method('PATCH') 
        <div class="form-group mb-2">
       <label for="Price" >Enter Price</label>
       <input type="text" name="price" class="mx-5" placeholder="Price in $">
       </div>
       <div class="form-group my-2 ">
    <label >Sechedule Date</label>
    <input type="date" class="form-control mx-4" name="ad_date">
      </select>
    </div>
     <button type="submit" class="btn  btn-outline-secondary my-3 mx-2">Send to client</button>
     <a class="btn btn-outline-danger my-3 "href="/requests/decline/{{$request->id}}" role="button" >Decline</a>
     @else
     <a class="btn btn-outline-primary my-3  "href="/requests/accept/{{$request->id}}" role="button" >Accept</a>
     <a class="btn btn-outline-danger my-3 "href="/requests/decline/{{$request->id}}" role="button" >Decline</a>
     
     
      @endif
     </form>
      </div>
    </div>
  </div>
</div>
@endrole
@role('Client')
<div class='container'>
<form class="form-inline" method="POST" action="/requests/{{$request->id}}">
        @csrf
        @method('PATCH') 
     
       <div class="form-group my-2 ">
    <label >Sechedule Date</label>
    <input type="date" class="form-control mx-4" name="ad_date">
      </select>
    </div>
     <button type="submit" class="btn  btn-outline-secondary my-3 mx-2">Send to Influencer</button>
      
     </form>
</div>
@endrole

@endsection