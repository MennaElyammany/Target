@extends('layouts.app')
@section('content')

<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th scope="col" style="text-align:center">Username</th>
      <th scope="col"style="text-align:center">Followers</th>
      <th scope="col"style="text-align:center">Engagement</th>
      <th scope="col"style="text-align:center">Price</th>
      <th scope="col"style="text-align:center">Type</th>
      <th scope="col"style="text-align:center">Status</th>
    </tr>
  </thead>
  <tbody>
 
@foreach($requests as $request)
  @php
  $influencer=findUser($requests[0]->influencer_id);
  @endphp
    <tr  style="width: 200px;">
      <td >
    <div class="card border-0 float-left mp-0" style="width: 160px"order-0>
  <div class="row no-gutters">
    <div class="col-md-4 ">
      <img src="{{$influencer->avatar}}" class="card-img rounded-circle my-2 " alt="...">
    </div>
    <div class="col-md-8" >
      <div class="card-body">
      <span class="card-title text-primary font-weight-bold">{{$influencer->name}}</span>
      <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt"></i>  {{findCountry($influencer->country_id)}}</small></p>
      </div>
    </div>
  </div>
</div>
<a class="btn btn-outline-secondary float-left my-3" href="#" role="button" width="30px">View</a>
      </td>
      <td style="text-align:center" ><p class="font-weight-bold my-4 ">{{convertNumber($influencer->followers)}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4 ">x%</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->price}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->type}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->status}}</p></td>
    
    </tr>
@endforeach



<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th scope="col" style="text-align:center">Company Name</th>
      <th scope="col"style="text-align:center">Description</th>
      <th scope="col"style="text-align:center">Requested Date</th>
      <th scope="col"style="text-align:center">Product Image</th>
      <th scope="col"style="text-align:center">Price</th>
      <th scope="col"style="text-align:center">Type</th>
      <th scope="col"style="text-align:center">Status</th>
      <th scope="col"style="text-align:center">Website Url</th>
      <th scope="col"style="text-align:center">Take Action</th>

    </tr>
  </thead>
  <tbody>

 
@foreach($requests as $request)

    <tr>
   <td style="text-align:center"> <p class="font-weight-bold my-4 ">{{$request->company_name}}</p>  </td>
      <td style="text-align:center"><p class="font-weight-bold my-4 ">{{$request->description}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->ad_date}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->product_image}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->price}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->type}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->status}}</p></td>
      <td > <center><a class="btn btn-outline-primary  my-3" href="{{$request->website_url}}" role="button" >Visit Website</a> </center></td>
      @if($request->status=='accepted' ||$request->status=='declined')
      <td > <center><a class="btn btn-outline-success my-3 disabled "aria-disabled="true"href="/requests/accept/{{$request->id}}" role="button" >{{$request->status}}</a></td>
       @else
       <td > <center><a class="btn btn-outline-secondary my-3 "href="/requests/accept/{{$request->id}}" role="button" >Accept</a>
      <a class="btn btn-outline-danger my-3 "href="/requests/decline/{{$request->id}}" role="button" >Decline</a>
       </center></td>
@endif
      


    </tr>
@endforeach

  </tbody>
</table>

@endsection