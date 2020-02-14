( function ( $ ) {

	var charts = {
		init: function () {

			// -- Set new default font family and font color to mimic Bootstrap's default styling
			Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
			Chart.defaults.global.defaultFontColor = '#292b2c';
			this.ajaxGetSubscribersPerMonth();

			// this.createCompletedJobsChart($response);

		},
		ajaxGetSubscribersPerMonth: function () {
			var url = window.location.pathname;
			if(url.match(/[0-9]+$/)){
				var id = url.substring(url.lastIndexOf('/') + 1);
			}
			else{
				var button = document.getElementById('instaButton');
				var id= button.getAttribute('data-idinsta');

			}
			var urlPath =  '/subscriberschart/'+id;
			var request = $.ajax( {
				method: 'GET',
				url: urlPath,
				success: function (){
					console.log('success');
				},
				error: function (){
					console.log('error');
				}
		} );

			request.done( function ( response ) {
				charts.createCompletedJobsChart(response);
			});
		},

		/**
		 * Created the Completed Jobs Chart
		 */
		createCompletedJobsChart: function (response) {

			var ctx = document.getElementById("myChart");
			var myLineChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: response.months, // The response got from the ajax request containing all month names in the database
					datasets: [{
						label: "Subscribers",
						lineTension: 0.3,
						backgroundColor: "rgba(2,117,216,0.2)",
						borderColor: "rgba(2,117,216,1)",
						pointRadius: 5,
						pointBackgroundColor: "rgba(2,117,216,1)",
						pointBorderColor: "rgba(255,255,255,0.8)",
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "rgba(2,117,216,1)",
						pointHitRadius: 20,
						pointBorderWidth: 2,
						data: response.subscribers// The response got from the ajax request containing data for the completed jobs in the corresponding months
					}],
				},
				options: {
					scales: {
						xAxes: [{
							time: {
								unit: 'date'
							},
							gridLines: {
								display: false
							},
							ticks: {
								maxTicksLimit: 7
							},
							scaleLabel:{
								display:true,
								labelString:'Date'
							}
						}],
						yAxes: [{
							ticks: {
								min: 0,
								max: response.max, // The response got from the ajax request containing max limit for y axis
								maxTicksLimit: 5
							},
							gridLines: {
								color: "rgba(0, 0, 0, .125)",
							}
						}],
					},
					legend: {
						display: false
					}
				}
			});
		}
	};



	charts.init();

} )( jQuery );