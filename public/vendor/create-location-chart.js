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
			if(url.match(/[0-9]+$/)){
				var id = url.substring(url.lastIndexOf('/') + 1);
			}
			else{
				var button = document.getElementById('instaButton');
				var id= button.getAttribute('data-idinsta');

			}
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
				console.log(response);
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
		  backgroundColor: ["#004c6d",
			"#2e6181",
			"#4b7795",
			"#678daa",
			"#83a5c0",
			"#9ebdd6",
			"#bad5ec"],
		  data: response.count
		}
	  ]
	},
	options: {
	  legend: { display: false },
	  title: {
		display: true,
		text: 'Audience Location',
		fontSize:18,
		fontFamily: 'Helvetica Neue',
		padding:5
	  }
	}
});


		}
	};



	charts.init();

} )( jQuery );