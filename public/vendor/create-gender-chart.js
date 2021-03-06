( function ( $ ) {

	var charts = {
		init: function () {

			// -- Set new default font family and font color to mimic Bootstrap's default styling
			Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
			Chart.defaults.global.defaultFontColor = '#292b2c';
			this.ajaxGetAudienceGender();


		},
		ajaxGetAudienceGender: function () {
			var url = window.location.pathname;
			if(url.match(/[0-9]+$/)){
				var id = url.substring(url.lastIndexOf('/') + 1);
			}
			else{
				var button = document.getElementById('instaButton');
				var id= button.getAttribute('data-idinsta');

			}
         
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
            var ctx= document.getElementById('GenderChart');
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
		   },
		   options: {
			legend: { display: false },
			title: {
			  display: true,
			  text: 'Audience Gender',
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