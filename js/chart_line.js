var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			type: 'line',
			marginRight: 130,
			marginBottom: 25
		},
		title: {
			text: '<?php echo $user;?>',
			x: -20 //center
		},
		subtitle: {
			text: '<?php echo $testname;?>',
			x: -20
		},
		xAxis: {
			categories: ['1', '2', '3', '4', '5', '6',
				'7', '8', '9', '10', '11', '12', '13','14', '15']
		},
		yAxis: {
			title: {
				text: 'Тест'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +'-й вопрос:'+ this.y +' ';
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: -10,
			y: 100,
			borderWidth: 0
		},
		series: [ {
			name: '<?php echo $user;?>',
			data: [<?php echo $value_text;?>]
		}]
	});
});