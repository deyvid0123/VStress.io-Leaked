
(function(window, document, $, undefined) {
	  "use strict";
	$(function() {

		if ($('#lineChart').length) {
			
			var ctx = document.getElementById('lineChart').getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
					datasets: [{
						label: 'Google',
						data: [13, 20, 4, 18, 7, 4, 8],
						backgroundColor: "transparent",
						borderColor: "#14b6ff",
						pointRadius :"0",
						borderWidth: 3
					}, {
						label: 'Facebook',
						data: [3, 30, 6, 6, 3, 4, 11],
						backgroundColor: "transparent",
						borderColor: "#7934f3",
						pointRadius :"0",
						borderWidth: 3
					}]
				},
			options: {
				maintainAspectRatio: false,
				legend: {
				  display: true,
				  labels: {
					fontColor: '#585757',  
					boxWidth:40
				  }
				},
				tooltips: {
				  enabled:false
				},	
			  scales: {
				  xAxes: [{
					ticks: {
						beginAtZero:true,
						fontColor: '#585757'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(0, 0, 0, 0.07)"
					},
				  }],
				   yAxes: [{
					ticks: {
						beginAtZero:true,
						fontColor: '#585757'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(0, 0, 0, 0.07)"
					},
				  }]
				 }

			 }
			});
			
		}


		if ($('#barChart').length) {
			var ctx = document.getElementById("barChart").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
					datasets: [{
						label: 'Google',
						data: [13, 20, 4, 18, 29, 25, 8],
						backgroundColor: "#04b962"
					}, {
						label: 'Facebook',
						data: [31, 30, 6, 6, 21, 4, 11],
						backgroundColor: "#14b6ff"
					}]
				},
			options: {
				maintainAspectRatio: false,
				legend: {
				  display: true,
				  labels: {
					fontColor: '#585757',  
					boxWidth:40
				  }
				},
				tooltips: {
				  enabled:true
				},	
			  scales: {
				  xAxes: [{
					  barPercentage: .5,
					ticks: {
						beginAtZero:true,
						fontColor: '#585757'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(0, 0, 0, 0.07)"
					},
				  }],
				   yAxes: [{
					ticks: {
						beginAtZero:true,
						fontColor: '#585757'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(0, 0, 0, 0.07)"
					},
				  }]
				 }

			 }
			});
		}

		if ($('#polarChart').length) {
			var ctx = document.getElementById("polarChart").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'polarArea',
				data: {
					labels: ["Lable1", "Lable2", "Lable3", "Lable4"],
					datasets: [{
						backgroundColor: [
							"#7934f3",
							"#f43643",
							"#04b962",
							"#14b6ff"
						],
						data: [13, 20, 11, 18],
						borderWidth: [0, 0, 0, 0]
					}]
				},
			options: {
				maintainAspectRatio: false,
			   legend: {
				 position :"right",	
				 display: true,
				    labels: {
					  fontColor: '#585757',  
					  boxWidth:15
				   }
				},
			scale: {
				  gridLines: {
					   color: "rgba(0, 0, 0, 0.07)" 
					 }, 
				}
			   }
			});
		}


		if ($('#pieChart').length) {
			var ctx = document.getElementById("pieChart").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'pie',
				data: {
					labels: ["Lable1", "Lable2", "Lable3", "Lable4"],
					datasets: [{
						backgroundColor: [
							"#04b962",
							"#ff8800",
							"#14b6ff",
							"#94614f"
						],
						data: [13, 120, 11, 20],
						borderWidth: [0, 0, 0, 0]
					}]
				},
			options: {
				maintainAspectRatio: false,
			   legend: {
				 position :"right",	
				 display: true,
				    labels: {
					  fontColor: '#585757',  
					  boxWidth:15
				   }
				}
			   }
			});
		}


		if ($('#doughnutChart').length) {
			var ctx = document.getElementById("doughnutChart").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: ["Lable1", "Lable2", "Lable3", "Lable4"],
					datasets: [{
						backgroundColor: [
							"#7934f3",
							"#f43643",
							"#04b962",
							"#0a151f"
						],
						data: [13, 120, 11, 20],
						borderWidth: [0, 0, 0, 0]
					}]
				},
			options: {
				maintainAspectRatio: false,
			   legend: {
				 position :"right",	
				 display: true,
				    labels: {
					  fontColor: '#585757',  
					  boxWidth:15
				   }
				}
			   }
			});
		}


	});

})(window, document, window.jQuery);