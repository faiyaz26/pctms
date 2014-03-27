@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<h2> Edit Contest </h2>
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
	{{ Form::model($div, array('route' => array('admin.division.update', $div->id), 'method' => 'PUT', 'class' => "form-horizontal")) }}
		<div class="form-group">
			<label class="col-sm-2 control-label" for="division_name">Division Name</label>
			<div class="col-sm-10">
				{{form::text('division_name', null, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="division_description">Division Description</label>
			<div class="col-sm-10">
				{{form::textarea('division_description', null, array('class' => "form-control"))}}
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
