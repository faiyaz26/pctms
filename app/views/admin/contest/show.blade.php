@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
<h2> Show Contest </h2>
@if ($errors->all())
<div class="alert alert-danger">
	{{  HTML::ul($errors->all()) }}
</div>
@endif
{{ Form::open(array('url' => 'admin/contest', 'class' => "form-horizontal")) }}
<fieldset disabled>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="contest_name">Contest Name</label>
		<div class="col-sm-8">
			{{form::text('contest_name',  $contest->contest_name, array('class' => "form-control"))}}
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="contest_description">Contest Description</label>
		<div class="col-sm-8">
			{{form::textarea('contest_description', $contest->contest_description, array('class' => "form-control"))}}
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="contest_name">Contest Date</label>
		<div class="col-sm-8">
			<div class='input-group date' id='datetimepicker1' data-date-format="YYYY-MM-DD">
				{{form::text('contest_date',  $contest->contest_date, array('class' => "form-control"))}}
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="contest_name">Contest Standing URL</label>
	<div class="col-sm-8">
		{{form::text('contest_standing_url',  $contest->contest_standing_url, array('class' => "form-control"))}}
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="contest_name">Contest Judge Data URL</label>
	<div class="col-sm-8">
		{{form::text('contest_judge_data_url', $contest->contest_judge_data_url, array('class' => "form-control"))}}
	</div>
</div>
<div class="form-group">
	<label class="col-md-2 control-label" for="division_id">Division</label>
	<div class="col-md-6">
		<input class = "form-control" type = "text" value = " {{$division->division_name}} " />
	</div>
</div>
<div class="form-group">
	<label class="col-md-2 control-label" for="season_id">Season</label>
	<div class="col-md-6">
		<input class = "form-control" type = "text" value = " {{$season->season_name}} " />
	</div>
</div>
</fieldset>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<a class = "btn btn-danger" href = "{{URL::to('admin/contest/'.$contest->id.'/del')}}"> Delete </a>
		<button class="btn btn-warning close_popup">Cancel</button>
	</div>
</div>
{{ Form::close() }}
@stop


@section('scripts')
<script type="text/javascript">
$(function () {
	$('#datetimepicker1').datetimepicker();
});
</script>
@stop
