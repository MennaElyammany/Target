@extends('layouts.app')
@section('content')
<br>
    <div class="container">
    <h1>Metrics</h1>
    <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Engagement </div>
            <div class="card-body">
            
        <div  style=" display:inline-block; float:left;margin-right:150px;margin-left:200px;">
        <center>
            <h3> Engagement: <br> {{$result['engagement']}}%<h3>
            </center>
            </div>
            <div>
            <center>
            <h3>Average Views: <br> {{$result['average_views']}}<h3>
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
                <i class="fa fa-area-chart"></i> Audience </div>
            <div class="card-body">
                <canvas id="GenderChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-body">
                <canvas id="LocationChart" width="100%" height="30"></canvas>
            </div>
            <div>
            <canvas id="AgeChart" width="100%" height="30"></canvas>

            </div>

            <div class="card-footer small text-muted">Updated yesterday at @php  echo date('F j, Y', time() ) @endphp</div>
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



<script>
 





			
		

</script>

@endsection
