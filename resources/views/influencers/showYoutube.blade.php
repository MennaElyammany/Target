@extends('layouts.app')

@section('content')


<div class='container ' >
    <div class='row no-gutters'>

        <div class='col-6 modal-dialog  modal-dialog-scrollable mx-0 container-fluid'>
            <div class="modal-content">
                <div class="modal-body">
                
                <div class="row no-gutters">
                @foreach($data['videoList'] as $index=>$video)
                <div class="col-6">
               <div class="card" >
               <iframe @php echo $video->videoIframe  @endphp></iframe>
               <div class="card-body text-light bg-secondary " style="height:60px;">
               <span>
               <i class="far fa-thumbs-up"></i> <span class=" text-sm"> {{convertNumber($video->videoLikes)}}</span>
               <i class="far fa-comments"></i>  <span class=" text-sm">{{convertNumber($video->videoComments)}}</span> 
               <i class="far fa-thumbs-down"></i>  <span class=" text-sm">{{convertNumber($video->videoDislikes)}}</span>
               <i class="far fa-eye"></i>  <span class="text-sm">{{convertNumber($video->videoViews)}}</span>
               </span>
                  </div>
                   </div>
               
              </div>
                @endforeach
              
              </div>
                </div>
            </div>
        </div>


        <div class='col-6 modal-dialog modal-dialog-scrollable mx-0  '>
            <div class="modal-content">
                <div class="modal-body">
                    <div id="title">
                        <div class="row">
                            <div class="col-3">
                                <image src="{{$data['imageUrlSmall']}}" class="rounded-circle">
                            </div>
                            <div class="col-8 my-3">
                                <h3>{{$data['name']}}
                                    @php
                                    if($data['verified'])
                                    echo '<i class="fas fa-check-circle"></i>'
                                    @endphp
                                    <img src="https://img.icons8.com/offices/30/000000/youtube-play.png" class="m-3 ">
                                    @if(has_uncompleted_request($data['influencer_id']))
                                  <a href="{{ route('requests.create',['influencer_id'=> $data['influencer_id']]) }}" >  <i class="fas fa-file-signature text-dark " title="Request Influencer For Ad"></i></a>
                                @endif
                                </h3>
                            </div>
                        </div>

                    </div>
                    <br>

                    <div id="statistics">
                        <div class="row">
                            <div class="col-3">
                                <h3 class="font-weight-bold">{{ convertNumber($data['videoCount'])}}</h3>
                                <span class="font-weight-light">Videos</span>
                            </div>
                            <div class="col-3">
                                <h3 class="font-weight-bold">{{convertNumber($data['subscribers'])}}</h3>
                                <span class="font-weight-light">Subscribers</span>
                            </div>
                            <div class="col-3">
                                <center>
                                    <h3 class="font-weight-bold">{{convertNumber($data['subscriptions'])}}</h3>
                                </center>
                                <span>Subscriptions</span>
                            </div>
                            <div class="col-3">
                                <center>
                                    <h3 class="font-weight-bold">x%</h3>
                                </center>
                                <span>Engagement</span>
                            </div>
                        </div>
                    </div>
                   <br>
                    <div id="About" >
                    <p>{{$data['about']}}</p>
                    </div>

                   <h6> <img src="https://img.icons8.com/offices/30/000000/globe.png">  {{$data['country']}} </h6>
                   <br>
                   <center>
                   <a id="report" href="{{route('influencers.chart',['id' => $id,'data'=>$data])}}"  class="btn btn-outline-info">View Report</a>
                   </center>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script type="text/javascript">
var reportButton = document.getElementById('report');
console.log(reportButton);


</script>

@endsection
