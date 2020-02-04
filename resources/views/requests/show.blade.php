@extends('layouts.app')
@section('content')
@role('Influencer')
<br><br>
<div class="card mb-3 " style="max-width: 540px;  position:absolute;left:25%" >
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
     @elseif($request->status =='accepted')
     <label class="text-danger" >Notify Client When You Are Completed </label>
     <a class="btn btn-outline-success my-3 "href="/requests/completed/{{$request->id}}" role="button" >Completed</a>
     @elseif($request->status =='completed')
     <h3 class="text-primary"> Rate Your Experience </h3>
     <input id="input-1-ltr-star-xs" name="input-1-ltr-star-xs" class="kv-ltr-theme-svg-star rating-loading" value="1" dir="ltr" data-size="xs">

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
@role('Admin')
<br><br>

<div class="card mb-3 " style="max-width: 600px; position:absolute;left:25%">
  <div class="row no-gutters">
    <div class="col-md-3">
      <img src="{{asset('storage/'.$request->product_image)}}"class="card-img" alt="...">
    </div>
    <div class="col-md-9">
      <div class="card-body">
        <h5 class="card-title font-weight-bold text-primary">Request From {{$request->company_name}} To {{findUserName($request->influencer_id)}}</h5>
         <p class="font-weight-bold " >Description: 
         <span class="float-right"><a  href="{{$request->website_url}}" >Visit Website</a>
        </span></p> 
         <div class="border">
         {{$request->description}}

@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $('.kv-ltr-theme-svg-star').rating({
        hoverOnClear: false,
        theme: 'krajee-svg'
    });
});
</script>
       </div>
        <p> <span class="font-weight-bold" >Requested Date:</span> {{$request->ad_date}}</p>
        @if($request->modified_date)
        <p> <span class="font-weight-bold text-danger" >new requested date</span> {{$request->modified_date}}</p>
        @endif
        <p> <span class="font-weight-bold" >Type:</span> {{$request->type}}</p>
        <p> <span class="font-weight-bold" >Status: </span> 
        @if($request->status=='waiting')
       <span class="text-danger"> {{$request->status}} </span></p>
       @elseif($request->status=='completed')
       <span class="text-success"> {{$request->status}} </span></p> 
       @else
       <span > {{$request->status}} </span></p> 
       @endif
      </div>
    </div>
  </div>
</div>

@endrole
@endsection