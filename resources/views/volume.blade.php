@extends('layouts.master')

@section('title', 'Detail')

{{-- @section('h3', 'Chi tiết') --}}

@section('content')
<div class="col-sm-12">
	<div id="chart"></div>
</div>
@stop
@section('script')	
	<script type="text/javascript">
		var data = [];
		var symbol = "<?php echo $symbol; ?>";
		@foreach($ticks as $value)
			data.push([{{ $value['openTime'] }}, {{ $value['volume'] }}]);
		@endforeach
		Highcharts.setOptions({
			global: {
				useUTC: false,
				timezone: 'Asia/Ho_Chi_Minh'
			}
		});
		var chart = Highcharts.stockChart('chart', {
			rangeSelector: {
				allButtonsEnabled:true,
				buttons: [
				{   type: 'second',
				    count: 5,
				    text: '5s'
				}, {
				    type: 'minute',
				    count: 1,
				    text: '1m'
				},{
				    type: 'minute',
				    count: 30,
				    text: '30m'
				}, {
				    type: 'hour',
				    count: 1,
				    text: '1h'
				}, {
				    type: 'hour',
				    count: 6,
				    text: '6h'
				}, {
				    type: 'hour',
				    count: 12,
				    text: '12h'
				}]
			},
			title: {
				text: symbol
			},
			xAxis: {
				type: 'datetime',
			},
			yAxis: 
				[{
					labels: {
						align: 'right',
						x: 3
					},
					title: {
						text: 'Volume'
					},
					
					offset: 0,
					lineWidth: 2
				}],
			tooltip: {
				formatter: function() {
					return  '<b>Volume: ' + this.y + '</b><br>(Time: ' +
					Highcharts.dateFormat('%e/%b/%Y %H:%M:%S', new Date(this.x)) + ')';
				}
			},
			series: [{
				type: 'column',
				name: 'Volume',
				data: data
			}]
		});
		chart.rangeSelector.clickButton(0, 1, true);
		setInterval(function(){
			$.ajax({
				url: '{{ url("get/symbol") }}',
				type: 'GET',
				dataType: 'JSON',
				data: {symbol: symbol}
			})
			.done(function(res) {
				var time = new Date().getTime();
				var volume = parseFloat(res['volume'][symbol]);
				chart.series[0].addPoint([time, volume]);
			})
			.fail(function(res) {
				console.log("error");
			});
		}, 3000);
	</script>
@stop