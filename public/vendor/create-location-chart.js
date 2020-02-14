( function ( $ ) {

	var charts = {
		init: function () {

			// -- Set new default font family and font color to mimic Bootstrap's default styling
			Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
			Chart.defaults.global.defaultFontColor = '#292b2c';
			this.ajaxGetAudienceLocation();


		},
		ajaxGetAudienceLocation: function () {
			var url = window.location.pathname;
            var id = url.substring(url.lastIndexOf('/') + 1);
			var urlPath =  '/locationchart/'+id;
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

new Chart(document.getElementById("LocationChart"), {
	type: 'horizontalBar',
	data: {
	  labels: response.countries,
	  datasets: [
		{
		  label: "Location",
		  backgroundColor: ["#3e95cd", "#3e95cd","#3e95cd","#3e95cd","#3e95cd"],
		  data: response.count
		}
	  ]
	},
	options: {
	  legend: { display: false },
	  title: {
		display: true,
		text: 'Audience Location'
	  }
	}
});


		}
	};



	charts.init();

} )( jQuery );