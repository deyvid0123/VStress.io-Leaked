
  $(function() {
    "use strict";

    $('#sparklinechart1').sparkline([ 1, 4, 5, 9, 8, 10, 5, 8, 4, 1, 0, 7, 5, 7, 9, 8, 10, 5], {
            type: 'bar',
            height: '45',
            barWidth: '3',
            resize: true,
            barSpacing: '4',
            barColor: '#14b6ff',
			spotColor: '#14b6ff',
            minSpotColor: '#14b6ff',
            maxSpotColor: '#14b6ff',
            highlightSpotColor: '#14b6ff',
            highlightLineColor: '#14b6ff'
        });
		
		
	$("#sparklinechart2").sparkline([1,1,0,1,-1,-1,1,-1,0,0,1,-1,1,1,-1,0,0,1,1,-1,-1,1,1], {
		type: 'tristate',
		height: '30',
		zeroAxis: false
		});	
		
		
	$("#sparklinechart3").sparkline([28,48,40,19,96,27,100], {
            type: 'line',
            width: '150',
            height: '65',
            lineWidth: '2',
            lineColor: '#04b962',
            fillColor: 'transparent',
            spotColor: '#04b962',
            minSpotColor: '#04b962',
            maxSpotColor: '#04b962',
            highlightSpotColor: '#04b962',
            highlightLineColor: '#04b962'
    }); 	
		
		
	  $("#sparklinechart4").sparkline([5,6,7,9,9,5,3,2,2,4,6,7], {
		type: 'line',
		width: '180',
		height: '65',
		lineWidth: '2',
		lineColor: '#7934f3',
		fillColor: 'rgba(121, 52, 243, 0.33)',
		maxSpotColor: '#7934f3',
		highlightLineColor: '#7934f3',
		highlightSpotColor: '#7934f3'
	  });
  
  
   $('#sparklinechart5').sparkline([20, 20, 20], {
            type: 'pie',
            height: '200',
            resize: true,
            sliceColors: ['#14b6ff', '#04b962', '#f43643']
        }); 


	$('#sparklinechart6').sparkline([40, 40, 40], {
		  type: 'pie',
		  height: '200',
		  resize: true,
		  sliceColors: ['#7934f3', 'rgba(121, 52, 243, 0.65)', 'rgba(121, 52, 243, 0.45)']
	  });
	  
  
  $("#sparklinechart7").sparkline([15,16,20,18,19,14,17,12,11,12,10,14,17,14,10,15], {
    type: 'bar',
    width: '100%',
    height: '200',
    barWidth: 10,
    barSpacing: 10,
    barColor: '#0a151f'
  });
  


   });