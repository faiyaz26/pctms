@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<h2> Create Season </h2>
	@if ($errors->all())
		<div class="alert alert-danger">
			{{  HTML::ul($errors->all()) }}
		</div>
	@endif
	{{ Form::open(array('url' => 'admin/season', 'class' => "form-horizontal")) }}
		<div class="form-group">
			<label class="col-sm-2 control-label" for="season_name">Season Name</label>
			<div class="col-sm-8">
				{{form::text('season_name', null, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="division_description">Season Description</label>
			<div class="col-sm-8">
				{{form::textarea('season_description', null, array('class' => "form-control"))}}
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
