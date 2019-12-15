@extends ('index')
@section ('body_dashboard')

<section id="main-content">
	<section class="wrapper">
	<div class="row">
		<div class="col-md-4 form-year">
			<form action="dashboard-year" method="POST">
				{{ csrf_field() }}
				<label for="">Select the year:</label>
				<select name="year" id="year">
					<option value="2019">2019</option>
					<option value="2018">2018</option>
				</select>
				<button type="submit" class="btn btn-success btn-go">Go</button>
			</form>
		</div>
	</div>
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Total revenue earned during the year</h4>
					<h3>{{$TotalPrice}} $</h3>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>The most month of sale. Month: {{$maxM}}</h4>
						<h3>{{$max}} $</h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>The least month of sale. Month: {{$minM}}</h4>
						<h3>{{$min}} $</h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->

		<div id="columnchart_material" style="width: 100%; height: 700px; padding: 10px;"></div>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			google.charts.load('current', {'packages':['bar']});
			google.charts.setOnLoadCallback(drawChart);
	
			function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Month', 'Price'],
				['1', {{$arrPrice[0]}} ],
				['2', {{$arrPrice[1]}} ],
				['3', {{$arrPrice[2]}} ],
				['4', {{$arrPrice[3]}} ],
				['5', {{$arrPrice[4]}} ],
				['6', {{$arrPrice[5]}} ],
				['7', {{$arrPrice[6]}} ],
				['8', {{$arrPrice[7]}} ],
				['9', {{$arrPrice[8]}} ],
				['10', {{$arrPrice[9]}} ],
				['11', {{$arrPrice[10]}} ],
				['12', {{$arrPrice[11]}} ],
			]);
	
			var options = {
				chart: {
				title: 'Revenue statistics',
				subtitle: 'Months, Years',
				}
			};
	
			var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
	
			chart.draw(data, google.charts.Bar.convertOptions(options));
			}
		</script>

		<div class="clearfix mb-10"> </div>
</section>

@stop