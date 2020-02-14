( function ( $ ) {

	var charts = {
		init: function () {

			// -- Set new default font family and font color to mimic Bootstrap's default styling
			Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
			Chart.defaults.global.defaultFontColor = '#292b2c';
			this.ajaxGetAudienceAge();


		},
		ajaxGetAudienceAge: function () {
			var url = window.location.pathname;
			if(url.match(/[0-9]+$/)){
				var id = url.substring(url.lastIndexOf('/') + 1);
			}
			else{
				var button = document.getElementById('instaButton');
				var id= button.getAttribute('data-idinsta');

			}
			var urlPath =  '/agechart/'+id;
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
            new Chart(document.getElementById("AgeChart"), {
                type: 'horizontalBar',
                data: {
                  labels: response.ages,
                  datasets: [
                    {
                      label: "Audience Age",
                      backgroundColor: ["#b04669","#ca8094","#dfb8c1","#f1f1f1","#a9b6c5","#63809b","#0b4d73"
	
						],
                      data: response.count
                    }
                  ]
                },
                options: {
                  legend: { display: false },
                  title: {
                    display: true,
					text: 'Audience Age',
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