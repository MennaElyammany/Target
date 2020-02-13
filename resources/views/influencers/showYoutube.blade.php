@extends('layouts.app')
@section('content')

<div class='container' >
    <div class='row no-gutters'>

        <div class='col-6 modal-dialog modal-lg  modal-dialog-scrollable mx-0 container-fluid'>
            <div class="modal-content p-0">
                <div class="modal-body p-0">
                
                <div class="row no-gutters">
                @foreach($data['videoList'] as $index=>$video)
                <div class="col-6">
               <div class="card" >
               <iframe @php echo $video['videoIframe']  @endphp></iframe>
               <div class="card-body text-light bg-secondary " style="height:60px;">
               <span>
               <i class="far fa-thumbs-up"></i> <span class=" text-sm"> {{convertNumber($video['videoLikes'])}}</span>
               <i class="far fa-comments"></i>  <span class=" text-sm">{{convertNumber($video['videoComments'])}}</span> 
               <i class="far fa-thumbs-down"></i>  <span class=" text-sm">{{convertNumber($video['videoDislikes'])}}</span>
               <i class="far fa-eye"></i>  <span class="text-sm">{{convertNumber($video['videoViews'])}}</span>
               </span>
                  </div>
                   </div>
               
              </div>
                @endforeach
              
              </div>
                </div>
            </div>
        </div>


        <div class='col-6 modal-dialog modal-lg modal-dialog-scrollable mx-0 '>
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
                                    @if(has_uncompleted_request($data['influencer_id']) && Auth::User()->isNotBanned())
                                  <a href="{{ route('requests.create',['influencer_id'=> $data['influencer_id']]) }}" >  <i class="fas fa-file-signature text-dark " title="Request Influencer For Ad"></i></a>
                                  <a href="/messages/create/{{$data['influencer_id']}}"><i class='far fa-comment' style='font-size:26px;color:grey;'></i></a>
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
                                    <h3 class="font-weight-bold">{{$engagement['engagement']}}%</h3>
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
                <div class="container p-1">
    <h3>Core Metrics</h3>
    <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Average Video Metrics </div>
            <div class="card-body">
            
        <div  style=" display:inline-block; float:left;margin-right:100px;">
        <center>
        <p> <b>Engagement:</b> <br> {{$engagement['engagement']}}%<p>

            </center>
            </div>
            <div style="display:inline-block;float:left;">
            <center>
            <p> <b>Average Views:</b> <br> {{$engagement['average_views']}}<p>

            </center>
            </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at @php  echo date('F j, Y', time() ) @endphp</div>
        </div>
        <!-- Area Chart Example-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Subsribers Growth </div>
            <div class="card-body">
                <canvas id="myChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at @php  echo date('F j, Y', time() ) @endphp</div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Audience Insights</div>
            <div class="card-body">
                <canvas id="GenderChart" width="100%" height="60"></canvas>
            </div>
            <div class="card-body">
                <canvas id="LocationChart" width="100%" height="60"></canvas>
            </div>
            <div>
            <canvas id="AgeChart" width="100%" height="60"></canvas>

            </div>

            <div class="card-footer small text-muted">Updated yesterday at @php  echo date('F j, Y', time() ) @endphp</div>
        </div>
    </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script src="{{url( 'vendor/jquery.min.js' )}}"></script>
<script src="{{url( 'vendor/Chart.min.js' )}}"></script>
<script src="{{url( 'vendor/create-charts.js' )}}"></script>
<script src="{{url( 'vendor/create-gender-chart.js' )}}"></script>
<script src="{{url( 'vendor/create-location-chart.js' )}}"></script>
<script src="{{url( 'vendor/create-age-chart.js' )}}"></script>
<script type="text/javascript" src="scripts/moment-2.4.0.js"></script>
<script type="text/javascript" src="scripts/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
var reportButton = document.getElementById('report');
console.log(reportButton);


</script>

@endsection
