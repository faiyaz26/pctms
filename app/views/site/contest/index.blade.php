@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
Contests
@stop

{{-- Content --}}
@section('content')
<div class = "row">
	<div class = "panel panel-info">
		<div class = "panel-heading">
			Upcoming Contests
		</div>
		<table class="table">
			<tbody>
				@foreach ($contest_ann as $ann)
					<tr>
						<td>
							<p class = "text-center"> 
								    		<h4> {{ $ann->contest_name }} </h4>
								    			<?php
								    				$datetime = date_parse_from_format ('Y-m-d H:i:s' , $ann->contest_datetime );
								    				$day = $datetime['day'];
								    				$mon = $datetime['month'];
								    				$year = $datetime['year'];
								    				$hour = $datetime['hour'];
								    				$min = $datetime['minute'];
								    				$val = mktime($hour,$min,0,$mon,$day,$year);
								    				$format = date("Ymd", $val);
								    				$tm = date('Hi', $val);
								    				print '<a target = "_blank" href = "http://www.timeanddate.com/countdown/generic?p0=73&iso='.$format.'T'.$tm.'">';
								    			?>
								    			Check Time </a>

						 	</p>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>

	<div class = "panel panel-success">
		<div class = "panel panel-heading">
			Past Contests
		</div>
		<table class = "table table-bordered table-hover">
			<thead>
				<th class = "text-center"> Name </th>
				<th class = "text-center"> Date </th>
				<th class = "text-center"> Standings </th>
				<th class = "text-center"> Judge Data </th>
			</thead>
			<tbody>
				@foreach ($contest as $con)
				 	<tr>
				 		<td class = "text-center"> {{$con->contest_name}} </td>
				 		<td class = "text-center"> {{$con->contest_date}} </td>
				 		<td class = "text-center">  <a href = "{{$con->contest_standing_url}}" target = "_blank"> Contest Standing </a> </td>
				 		<td class = "text-center"> <a href = "{{$con->contest_judge_data_url}}" target = "_blank"> Judge Data </a> </td>
				 	</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop