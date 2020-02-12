@extends('layouts.app')
@section('content')
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
<script src="{{url( 'vendor/create-gender-chart.js' )}}"></script>
<script src="{{url( 'vendor/create-location-chart.js' )}}"></script>
<script src="{{url( 'vendor/create-age-chart.js' )}}"></script>


@endsection
