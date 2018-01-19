<!DOCTYPE html>
<html>
<head>
	<title>Home | @yield('title')</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
</head>
<body>
	<div class="main mt-5">
		<div class="container">
			<div class="row text-center">
				<div class="col-sm-12">
					<h3>@yield('h3')</h3>
				</div>
			</div>
			<div class="row">@yield('content')</div>
		</div>
	</div>
	<div class="footer m-5">
		<div class="row text-center">
			<div class="col-sm-12">
				<p>Copyright &copy; <a href="https://fb.com/leduycong.2509">Lê Duy Công</a></p>
			</div>
		</div>
	</div>	
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>

	<script src="https://code.highcharts.com/stock/highstock.js"></script>
	<script src="https://code.highcharts.com/stock/modules/drag-panes.js"></script>
	<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
	
	@yield('script')
</body>
</html>