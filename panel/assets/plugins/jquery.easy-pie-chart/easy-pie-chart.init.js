!function($) {
    "use strict";

    var EasyPieChart = function() {};

    EasyPieChart.prototype.init = function() {
    	//initializing various types of easy pie charts
		
    	$('.easy-pie-chart-1').easyPieChart({
			easing: 'easeOutBounce',
			barColor : '#7934f3',
			lineWidth: 6,
			animate: 1000,
            lineCap: 'rgba(121, 52, 243, 0.20)',
            trackColor : 'rgba(121, 52, 243, 0.20)',
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});

		$('.easy-pie-chart-2').easyPieChart({
			easing: 'easeOutBounce',
			barColor : '#04b962',
			lineWidth: 6,
			lineCap: 'rgba(4, 185, 98, 0.20)',
            trackColor : 'rgba(4, 185, 98, 0.20)',
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});

		$('.easy-pie-chart-3').easyPieChart({
			easing: 'easeOutBounce',
			barColor : '#94614f',
			lineWidth: 6,
			lineCap: 'rgba(148, 97, 79, 0.20)',
            trackColor : 'rgba(148, 97, 79, 0.20)',
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});

		$('.easy-pie-chart-4').easyPieChart({
			easing: 'easeOutBounce',
			barColor : '#f43643',
			lineWidth: 6,
			lineCap: 'rgba(244, 54, 67, 0.20)',
            trackColor : 'rgba(244, 54, 67, 0.20)',
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});

		$('.easy-pie-chart-5').easyPieChart({
			easing: 'easeOutBounce',
			barColor : '#14b6ff',
			lineWidth: 8,
			trackColor : 'rgba(20, 182, 255, 0.20)',
			scaleColor: false,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});

		$('.easy-pie-chart-6').easyPieChart({
			easing: 'easeOutBounce',
			barColor : '#ff8800',
			lineWidth: 8,
			trackColor : 'rgba(255, 136, 0, 0.20)',
			scaleColor: false,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});


		$('.easy-pie-chart-7').easyPieChart({
			easing: 'easeOutBounce',
			barColor : '#009688',
			lineWidth: 8,
			trackColor : 'rgba(0, 150, 136, 0.20)',
			scaleColor: false,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});

		$('.easy-pie-chart-8').easyPieChart({
			easing: 'easeOutBounce',
			barColor : '#0a151f',
			lineWidth: 8,
			trackColor : 'rgba(10, 21, 31, 0.20)',
			scaleColor: false,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});


    },
    //init
    $.EasyPieChart = new EasyPieChart, $.EasyPieChart.Constructor = EasyPieChart
}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.EasyPieChart.init()
}(window.jQuery);