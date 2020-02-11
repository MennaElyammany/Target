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
<a class="btn btn-outline-secondary float-left my-3" href="/influencers/{{$request->influencer_id}}" role="button" width="30px">View</a>
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
     <a class="btn btn-outline-danger my-3 "href="/requests/{{$request->id}}" role="button" data-toggle="modal" data-target="#editDateModal" data-id="{{$request->id}}">Edit Date</a>
     <div class="modal fade" id="editDateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class='container'>
    <form class="form-inline" method="POST" action="/requests/{{$request->id}}">
        @csrf
        @method('PATCH')

        <div class="form-group my-2 ">
            <label>Sechedule Date</label>
            <input type="date" class="form-control mx-4" name="ad_date">
            </select>
        </div>
     
</div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn  btn-outline-secondary my-3 mx-2">Send to Influencer</button>

</form>
       
      </div>
    </div>
  </div>
</div>

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

      @if(checkIfRated($request->influencer_id,$request->id)==='no')
      <button type="button" class="btn btn-outline-primary my-3" data-toggle="modal" data-target="#ratingInfluencerModal" data-id="{{$request->id}}" data-influencer-name="{{$influencer->name}}" data-influencer-id="{{$influencer->id}}" data-request-id="{{$request->id}}">
      Rate your Experience</button>
      @else 
      <div style="margin-top:30px;">
      <p>Thanks for rating!</p>
      </div>
      @endif
</td>
<div class="modal fade" id="ratingInfluencerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" data-name="" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <form method="post" action="/rating">
     @csrf
  <div style="display:flex;" class="form-group">
    <label class="ratinglabel" for="">Rating: </label>
    <div class="rate">
    <input class="form-control" type="radio" id="star5" name="rate" value="5" />
    <label for="star5" title="text">5 stars</label>
    <input class="form-control" type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input class="form-control" type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input class="form-control" type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input class="form-control" type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
  </div>
  </div>
  <div class="form-group">
    <label class="modal-label"></label>
    <textarea class="form-control" rows="5" name="review"></textarea>

  </div>
  <input type="hidden" class="modal-influencer-id" name="rateable_id">
  <input type="hidden" class="modal-request-id" name="request_id">


  <div class="modal-footer">
  <button type="submit" class="btn btn-primary">Submit</button>
      </div>
</form>
      </div>
     
    </div>
  </div>
</div>

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
      <center>
      <a class="btn btn-outline-danger my-3 "href="/requests/{{$request->id}}" role="button" >View Request</a>
@if($request->status=='completed'&&checkIfRated($request->client_id,$request->id)=='no')
 @php
 $clientName=findClientName($request->client_id);
echo'
      <button type="button" class="btn btn-outline-primary my-3" data-toggle="modal" data-target="#ratingClientModal" data-client-name='.$clientName.' data-client-id='.$request->client_id.' data-request-id='.$request->id.'>
Rate your Experience</button>';
@endphp
@endif
</center>
      </td>
      <div class="modal fade" id="ratingClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <form method="post" action="/rating">
     @csrf
  <div style="display:flex;" class="form-group">
    <label class="ratinglabel" for="">Rating: </label>
    <div class="rate">
    <input class="form-control" type="radio" id="star5" name="rate" value="5" />
    <label for="star5" title="text">5 stars</label>
    <input class="form-control" type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input class="form-control" type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input class="form-control" type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input class="form-control" type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
  </div>
  </div>
  <div class='form-group'>
    <label class="modal-label"></label>

    <textarea class="form-control" rows="5" name="review"></textarea>

  </div>
  <input type="hidden" class="modal-client-id" name="rateable_id">
  <input type="hidden" class="modal-request-id" name="request_id">


  <div class="modal-footer">
  <button type="submit" class="btn btn-primary">Submit</button>
      </div>
</form>
      </div>
       

      


    </tr>
@endforeach

  </tbody>
</table>
@endrole
@role('Admin')

<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th scope="col" style="text-align:center">Company </th>
      <th scope="col" style="text-align:center">Influencer</th>
      <th scope="col"style="text-align:center"> Date</th>
      <th scope="col"style="text-align:center">Price</th>
      <th scope="col"style="text-align:center">Type</th>
      <th scope="col"style="text-align:center">Status</th>
      <th scope="col"style="text-align:center">Website Url</th>
      <th scope="col"style="text-align:center">View</th>

    </tr>
  </thead>
  <tbody>


@foreach($requests as $request)

    <tr>
   <td style="text-align:center"> <p class="font-weight-bold my-4 ">{{$request->company_name}}</p>  </td>
   <td style="text-align:center"> <p class="font-weight-bold my-4 ">{{findUserName($request->influencer_id)}}</p>  </td>
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
@section('scripts')
<script>
$('#ratingClientModal').on('show.bs.modal', function (event) {
  console.log('hi');
  var button = $(event.relatedTarget) 
  var clientName = button.data('client-name') 
  console.log(clientName)
  var clientId = button.data('client-id')
  console.log(clientId)
  var requestId = button.data('request-id')
  console.log(requestId)


  var modal = $(this)
  modal.find('.modal-title').text('Rate ' + clientName);
  modal.find('.modal-label').text('How was your experience with ' + clientName +'?');
  modal.find('.modal-client-id').val(clientId)
  modal.find('.modal-request-id').val(requestId)

  
})
</script>
<script>
$('#ratingInfluencerModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var influencerName = button.data('influencer-name') 
  var influencerId = button.data('influencer-id')
  var requestId = button.data('request-id')

  var modal = $(this)
  modal.find('.modal-title').text('Rate ' + influencerName);
  modal.find('.modal-label').text('How was your experience with ' + influencerName +'?');
  modal.find('.modal-influencer-id').val(influencerId)
  modal.find('.modal-request-id').val(requestId)

  
})
</script>
@endsection