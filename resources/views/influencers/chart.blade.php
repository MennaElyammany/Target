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
                <canvas id="PieChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-body">
                <canvas id="BarChart" width="100%" height="30"></canvas>
            </div>
            <div>
            <canvas id="bar-chart-horizontal" width="100%" height="30"></canvas>

            </div>

            <div class="card-footer small text-muted">Updated yesterday at @php  echo date('F j, Y', time() ) @endphp</div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{url( 'vendor/jquery.min.js' )}}"></script>

<script src="{{url( 'vendor/Chart.min.js' )}}"></script>

<script src="{{url( 'vendor/create-charts.js' )}}"></script>
<script>
   var ctx= document.getElementById('PieChart');
   console.log(ctx);
    var PieChart = new Chart(ctx, {
    type: 'pie',
  data: {
    labels: ["Male", "Female"],
    datasets: [{
      backgroundColor: [
        "blue",
        "pink",
      ],
      data: [70,20]
    }]
  }
});
new Chart(document.getElementById("BarChart"), {
    type: 'horizontalBar',
    data: {
      labels: ["Egypt", "Saudi Arabia", "UAE", "Lebanon", "Other"],
      datasets: [
        {
          label: "",
          backgroundColor: ["#3e95cd", "#3e95cd","#3e95cd","#3e95cd","#3e95cd"],
          data: [40,30,15,10,5]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Audience Location (percentage)'
      }
    }
});
new Chart(document.getElementById("bar-chart-horizontal"), {
    type: 'horizontalBar',
    data: {
      labels: ["<15", "15-20", "20-25", "25-30", "35>"],
      datasets: [
        {
          label: "Audience Age",
          backgroundColor: ["#8e5ea2", "#8e5ea2","#8e5ea2","#8e5ea2","#8e5ea2"],
          data: [20,30,20,10,10]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Audience Age'
      }
    }
});

</script>

@endsection
