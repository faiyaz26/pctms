@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<h2> Create Contest </h2>
	@if ($errors->all())
		<div class="alert alert-danger">
			{{  HTML::ul($errors->all()) }}
		</div>
	@endif
	{{ Form::open(array('url' => 'admin/contest', 'class' => "form-horizontal")) }}
		<div class="form-group">
			<label class="col-sm-2 control-label" for="contest_name">Contest Name</label>
			<div class="col-sm-8">
				{{form::text('contest_name', null, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="contest_description">Contest Description</label>
			<div class="col-sm-8">
				{{form::textarea('contest_description', null, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="contest_name">Contest Date</label>
			<div class="col-sm-8">
				<div class='input-group date' id='datetimepicker1' data-date-format="YYYY-MM-DD">
	                    {{form::text('contest_date', null, array('class' => "form-control"))}}
	                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	            </div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="contest_name">Contest Standing URL</label>
			<div class="col-sm-8">
				{{form::text('contest_standing_url', null, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="contest_name">Contest Judge Data URL</label>
			<div class="col-sm-8">
				{{form::text('contest_judge_data_url', null, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="division_id">Division</label>
			<div class="col-md-6">
				<select class="form-control" name="division_id">
					@foreach ($div as $dv)
						<option value="{{{ $dv->id }}}">{{{ $dv->division_name }}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="season_id">Season</label>
			<div class="col-md-6">
				<select class="form-control" name="season_id">
					@foreach ($season as $s)
						<option value="{{{ $s->id }}}">{{{ $s->season_name }}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
	    <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-success">Create</button>
		      <button type="reset" class="btn btn-danger">Clear</button>
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
