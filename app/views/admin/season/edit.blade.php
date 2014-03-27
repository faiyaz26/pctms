@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<h2> Edit Season </h2>
	@if ($errors->all())
		<div class="alert alert-danger">
			{{  HTML::ul($errors->all()) }}
		</div>
	@endif
	@if (isset($success))
		<div class = "alert alert-success">
			{{$success}}
		</div>
	@endif
	{{ Form::model($div, array('route' => array('admin.season.update', $div->id), 'method' => 'PUT', 'class' => "form-horizontal")) }}
		<div class="form-group">
			<label class="col-sm-2 control-label" for="season_name">Season Name</label>
			<div class="col-sm-10">
				{{form::text('season_name', null, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="season_description">Season Description</label>
			<div class="col-sm-10">
				{{form::textarea('season_description', null, array('class' => "form-control"))}}
			</div>
		</div>
	    <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-success">Update</button>
		      <button type="reset" class="btn btn-default">Clear</button>
		      <element class="btn-cancel close_popup">Cancel</element>
		    </div>
		  </div>
	{{ Form::close() }}
@stop
