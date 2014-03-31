@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
Contests
@stop

{{-- Content --}}
@section('content')
<div class = "row">
	<div class = "panel panel-default">
		<div class = "panel-heading">
			<span>
				{{Form::open(array('url' => '/rank', 'method' => 'GET', 'role' => 'role', 'class' => 'form-inline'))}}
					<div class="form-group">
						<label  for="division">Division</label>
						<select class="form-control" name = "division">
							<option value = "-1"> Overall </option>
							@foreach ($division as $div)
								<option value = "{{$div->id}}" @if ($divid == $div->id) {{'selected'}} @endif> {{$div->division_name}} </option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label  for="season">Season</label>
						<select class="form-control" name = "season">
							<option value = "-1"> Overall </option>
							@foreach ($season as $sea)
								<option value = "{{$sea->id}}" @if ($seaid == $sea->id) {{'selected'}} @endif > {{$sea->season_name}} </option>
							@endforeach
						</select>
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				{{Form::close()}}
			</span>
		</div>
		<div class = "panel-body">
			<table class = "table table-bordered table-hover">
				<thead>
					<tr>
						<th class="text-center"> User Name </th>
						<th class="text-center"> Points </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($rank as $r)
						<tr>
							<td class="text-center">
								<a href = "{{URL::to('profile/'.$r->username)}}" target = "_blank"> {{$r->username}} </a> 
							</th>
							<td class="text-center">
								{{$r->points}}
							</th>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop