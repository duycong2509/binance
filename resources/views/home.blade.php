@extends('layouts.master')

@section('title', 'All')

@section('h3', 'Price of all Coins')

@section('content')

<div class="col-sm-12">
	<table class="table table-dark table-striped table-hover">
		<thead>
			<tr>
				<th>Symbol</th>
				<th>Price</th>
				<th>Detail</th>
			</tr>
		</thead>
		<tbody>
			@foreach($prices as $key => $value)
				<tr>
					<td>{{ $key }}</td>
					<td>{{ $value }}</td>
					<td><a href="{{ route('volume.symbol', $key) }}">Chi tiết</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop

@section('script')
	<script type="text/javascript">
		var el = $('table > tbody > tr');
		var keys = [];
		for (var i = 0; i < el.length; i++) {
			keys.push(el[i].firstElementChild.innerText);
		}
		setInterval(function(){
			$.ajax({
				url: 'prices/all',
				type: 'GET',
				dataType: 'JSON'
			})
			.done(function(res) {
				for (var i = 0; i < keys.length; i++) {
					for(key in res.prices){
						if(key == keys[i]){
							var j = i + 1;
							$('.table > tbody > tr:nth-child('+ j +') > td:nth-child(2)').html(res.prices[key]);
						}
					}
				}
			})
			.fail(function(res) {
				console.log("error");
			});
		}, 1000);
	</script>
@stop