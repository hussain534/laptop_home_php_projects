<style>
body{width:550px;}
.chart-filter{    border-bottom: #CCC 1px solid;padding: 20px;}
.btn-input {background: #333;color: #FFF;border: 0;padding: 8px 20px;border-radius: 4px;}
.chart-item-title {padding:25px 0px;}
.chart-item-option {margin-left: 20px;}
</style>
<div class="chart-filter">
<div class="chart-item-title">
<input type="checkbox" name="countries" value="China" checked /> China
<input type="checkbox" name="countries" value="India" class="chart-item-option" checked /> India
<input type="checkbox" name="countries" value="United States" class="chart-item-option" /> United States
</div>
<input type="button" id="compare" value="Compare" class="btn-input" />
</div>
<div id="chart"></div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="highchart/highcharts.js"></script>
<script>
$(function () {
	$(document).ready(function() {
		//Default Options
		var options = {
			chart: {
				 renderTo: 'chart',
				type: 'column',
				height: 500,
				width:530
			},
			title: {
				text: 'Population'
			},
			xAxis: {
				categories: [ '2014','2015','2016' ],
				title: { text: 'Year' }
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Millon',
					align: 'middle'
				}
			},
			plotOptions: {
				column: {
					dataLabels: {
						enabled: true
					}
				}
			},
			series: [{},{},{}]
		};
		
		
		// On click event handler to compare data
		$("#compare").on("click",function(){
			var countries = ["China","India","United States"];
			var data = [[1347,1360,1374],[1210,1233,1255],[311,316,322]];
			var color = ["#10c0d2","#f1e019","#a2d210"];
			var selected_countries,j;

			// Clear previous data and reset series data
			for (i=0;i<data.length;i++) {
				options.series[i].name = "";
				options.series[i].data = "";
				options.series[i].color = "";
			}

			// Intializeseries data based on selected countries
			var i = 0;
			$("input[name='countries']:checked").each(function() {	
				selected_countries = $(this).val();
				j = jQuery.inArray(selected_countries,countries)
				if(j >= 0){
				options.series[i].name = countries[j];
				options.series[i].data = data[j];
				options.series[i].color = color[j];
				i++;	
				}
				
			});
			
			// Draw chart with options
			var chart = new Highcharts.Chart(options);

			// Display legend only for visible data.
			var item;
			for (k=i;k<=data.length;k++) {
				item= chart.series[k];				
				if(item) {
					item.options.showInLegend = false;
					item.legendItem = null;
					chart.legend.destroyItem(item);
					chart.legend.render();
				}
			}
		
		});
				
	});
});

</script>