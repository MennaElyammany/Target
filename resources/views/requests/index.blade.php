@extends('layouts.app')
@section('content')
@role('Client')
<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th scope="col" style="text-align:center">Username</th>
      <th scope="col"style="text-align:center">Followers</th>
      <th scope="col"style="text-align:center">Engagement</th>
      <th scope="col"style="text-align:center">Price</th>
      <th scope="col"style="text-align:center">Type</th>
      <th scope="col"style="text-align:center">Status</th>
      <th scope="col"style="text-align:center">Action</th>
      <th scope="col"style="text-align:center">Date</th>   
    </tr>
  </thead>
  <tbody>
 
@foreach($requests as $request)
  @php
  $influencer=findUser($request->influencer_id);
  @endphp
    <tr  style="width: 200px;">
      <td >
    <div class="card border-0 float-left mp-0" style="width: 160px"border-0>
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
      <td style="text-align:center"><p class="font-weight-bold my-4 text-danger">{{$request->price}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->type}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->status}}</p></td>
      @if($request->status=='modifiedByInf')
      <td style="text-align:center">    
      <a class="btn btn-outline-primary my-3 "href="/requests/accept/{{$request->id}}" role="button" >Accept</a>
     <a class="btn btn-outline-danger my-3 "href="/requests/decline/{{$request->id}}" role="button" >Decline</a>
     <a class="btn btn-outline-danger my-3 "href="/requests/{{$request->id}}" role="button" >Edit Date</a>

</td>
@elseif($request->status=='accepted')
<td style="text-align:center">    
      <a class="btn btn-outline-success my-3  disabled"href="/requests/accept/{{$request->id}}" role="button" >Accepted</a>
</td>
@elseif($request->status=='declined')
<td style="text-align:center">    
      <a class="btn btn-outline-danger my-3  disabled"href="/requests/accept/{{$request->id}}" role="button" >Declined</a>
</td>
@elseif($request->status=='completed')
<td style="text-align:center">    
      <a class="btn btn-outline-primary my-3 "href="" role="button" >Rate Your Experience</a>
</td>

@else
<td style="text-align:center">    
      <a class="btn btn-outline-danger my-3  disabled"href="/requests/accept/{{$request->id}}" role="button" >Waiting</a>
</td>
@endif
<td style="text-align:center"> 
<p class="font-weight-bold ">{{$request->ad_date}}</p> 
@if($request->modified_date)
<p class="font-weight-bold text-danger ">Requested date:{{$request->modified_date}}</p> 
@endif
</td>
    
    </tr>
    @endforeach
    </tbody>
</table>

@endrole
@role('Influencer')
<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th scope="col" style="text-align:center">Company Name</th>
      <th scope="col"style="text-align:center">Requested Date</th>
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
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->ad_date}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->price}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->type}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4">{{$request->status}}</p></td>
      <td > <center><a class="btn btn-outline-primary  my-3" href="{{$request->website_url}}" role="button" >Visit Website</a> </center></td>
      
      <td >
      <a class="btn btn-outline-danger my-3 "href="/requests/{{$request->id}}" role="button" >View Request</a>
      </td>
       

      


    </tr>
@endforeach

  </tbody>
</table>
@endrole
@endsection