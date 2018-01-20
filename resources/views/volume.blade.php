@extends('layouts.master')

@section('title', 'Detail')

{{-- @section('h3', 'Chi tiết') --}}

@section('content')
<div class="col-sm-12">
	<div id="volume">
		<h4></h4>
	</div>
</div>
<div class="col-sm-12">
	<div id="chart"></div>
	<div class="col-sm-12 title mt-3 text-center">Colume</div>
</div>
<div class="col-sm-12 mt-3">
	<div id="chart-line"></div>
	<div class="col-sm-12 title mt-3 text-center">Line</div>
</div>
@stop
@section('script')	
	<script type="text/javascript">
		var data = [];
		var buttons = [{
				    type: 'minute',
				    count: 1,
				    text: '1m'
				}, {
				    type: 'minute',
				    count: 5,
				    text: '5m'
				}, {
				    type: 'minute',
				    count: 15,
				    text: '15m'
				}, {
				    type: 'minute',
				    count: 30,
				    text: '30m'
				}, {
				    type: 'hour',
				    count: 1,
				    text: '1h'
				}, {
				    type: 'hour',
				    count: 2,
				    text: '2h'
				}, {
				    type: 'hour',
				    count: 4,
				    text: '4h'
				}, {
				    type: 'hour',
				    count: 6,
				    text: '6h'
				}, {
				    type: 'hour',
				    count: 12,
				    text: '12h'
				}];
		var symbol = "<?php echo $symbol; ?>";
		$('#volume h4')[0].textContent = 'Current volume: ' + {{ $prevDay['quoteVolume'] }};
		data.push([ new Date().getTime(), {{ $prevDay['quoteVolume'] }}]);
		Highcharts.setOptions({
			global: {
				useUTC: false,
				timezone: 'Asia/Ho_Chi_Minh'
			}
		});
		var chart_volume = Highcharts.stockChart('chart', {
			chart: {
				alignTicks: false
			},
			rangeSelector: {
				allButtonsEnabled: true,
				buttons: buttons
			},
			title: {
				text: symbol
			},
			xAxis: {
				type: 'datetime',
				labels: {
					format: '{value:%H:%M:%S}'
				},
			},
			tooltip: {
				formatter: function() {
					return  '<b>Volume: ' + this.y + '</b><br>(Time: ' +
					Highcharts.dateFormat('%e/%b/%Y %H:%M:%S', new Date(this.x)) + ')';
				}
			},
			series: [{
				type: 'column',
				name: 'Volume',
				data: data,
			}]
		});

		// Create the chart
		var chart_line = Highcharts.stockChart('chart-line', {
		    rangeSelector: {
		        allButtonsEnabled: true,
				buttons: buttons
		    },
		    title: {
		        text: symbol
		    },
		    xAxis: {
				type: 'datetime',
				labels: {
					format: '{value:%H:%M:%S}'
				},
			},
		    series: [{
		        name: 'Volume ' + symbol,
		        data: data,
		        marker: {
		            enabled: true,
		            radius: 3
		        },
		        shadow: true,
		        tooltip: {
		            valueDecimals: 8
		        }
		    }]
		});

		setInterval(function(){
			$.ajax({
				url: '{{ url("get/symbol") }}',
				type: 'GET',
				dataType: 'JSON',
				data: {symbol: symbol}
			})
			.done(function(res) {
				var time = new Date().getTime();
				var volume = parseFloat(res.volume['quoteVolume']);
				$('#volume h4')[0].textContent = 'Current volume: ' + volume;
				chart_volume.series[0].addPoint([time, volume]);
				chart_line.series[0].addPoint([time, volume]);
			})
			.fail(function(res) {
				console.log("error");
			});
		}, 1000);
	</script>
@stop