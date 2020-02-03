@extends('layouts.app')
@section('content')
<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th scope="col" style="text-align:center">Username</th>
      <th scope="col"style="text-align:center">Email</th>
      <th scope="col"style="text-align:center">Engagement</th>
      <th scope="col"style="text-align:center">Role</th>
      <th scope="col"style="text-align:center">country</th>
      <th scope="col"style="text-align:center">Total Requests</th>
      <th scope="col"style="text-align:center">Average Ratings</th>
      <th scope="col"style="text-align:center">Action</th> 
    </tr>
  </thead>
  <tbody>
  @foreach($users as $user)
  <tr  style="width: 100px;">
      <td >
    <div class="card border-0 float-left mp-0" style="width: 160px"border-0>
  <div class="row no-gutters">
    <div class="col-md-4 ">
      <img src="{{$user->avatar}}" class="card-img rounded-circle my-2 " alt="...">
    </div>
    <div class="col-md-8" >
      <div class="card-body">
      <span class="card-title text-primary font-weight-bold">{{$user->name}}</span>
      </div>
    </div>
  </div>
</div>

      </td>
      
      <td style="text-align:center"><p class="font-weight-bold my-4 ">{{$user->email}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4 ">x%</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4 ">{{  $user->roles[0]->name}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4 "><i class="fas fa-map-marker-alt"></i> {{findCountry($user->country_id)}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4 ">{{  $user->Requests->count()}}</p></td>
      <td style="text-align:center"><p class="font-weight-bold my-4 "> x%</p></td>

      <td style="text-align:center">      
      <form class="form-inline"  method="POST" action='users/{{$user->id}}'>
      @csrf
      @method('delete')

       <meta name="csrf-token" content="{{ csrf_token() }}">
       @if($user->hasRole('Influencer'))
       <a class="btn btn-outline-secondary float-left my-3" href="/influencers/{{$user->id}}" role="button" width="30px">View</a>
     @else
     <a class="btn btn-outline-secondary float-left my-3" href="/users/{{$user->id}}" role="button" width="30px">View</a>
      @endif
       <button type="submit"  class="btn btn-danger deleteRecord" data-id='{{$user->id}}' onclick='return confirm("Are you sure to delete this User?");'>Delete </button>
       <a href="/users/{{$user->id}}/edit" class="btn btn-primary " tabindex="-1" role="button" aria-disabled="true">Edit</a> 
     </form>    
      </td>

      </tr>
  @endforeach


  </tbody>
</table>
@endsection