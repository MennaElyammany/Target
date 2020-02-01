( function ( $ ) {

	var charts = {
		init: function () {

			// -- Set new default font family and font color to mimic Bootstrap's default styling
			Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
			Chart.defaults.global.defaultFontColor = '#292b2c';
			this.ajaxGetAudienceGender();

			// this.createCompletedJobsChart($response);

		},
		ajaxGetAudienceGender: function () {
            var url = window.location.pathname;
            var id = url.substring(url.lastIndexOf('/') + 1);
			var urlPath =  '/genderchart/'+id;
			var request = $.ajax( {
				method: 'GET',
				url: urlPath,
				success: function (){
					console.log('Success');
				},
				error: function (){
					console.log('Error');
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
            console.log(response);
            var ctx= document.getElementById('PieChart');
             var PieChart = new Chart(ctx, {
             type: 'pie',
           data: {
             labels: response.gender,
             datasets: [{
               backgroundColor: [
                 "blue",
                 "pink",
               ],
               data: response.gender_count
             }]
           }
         });


			
		}
	};
	


	charts.init();

} )( jQuery );