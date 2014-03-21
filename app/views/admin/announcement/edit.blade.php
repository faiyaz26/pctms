@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<h2> Edit Division </h2>
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
	{{ Form::model($contest, array('route' => array('admin.announcement.update', $contest->id), 'method' => 'PUT', 'class' => "form-horizontal")) }}
		<div class="form-group">
			<label class="col-sm-2 control-label" for="contest_name">Contest Name</label>
			<div class="col-sm-8">
				{{form::text('contest_name', null, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
				<label class="col-sm-2 control-label" for="contest_datetime">Contest DateTime</label>
				<div class = "col-sm-8">
	                <div class='input-group date' id='datetimepicker1' data-date-format="YYYY-MM-DD hh:mm">
	                	{{form::text('contest_datetime', null, array('class' => "form-control"))}}
	                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                </div>
	            </div>
         </div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="contest_description">Contest Description</label>
			<div class="col-sm-8">
				{{form::textarea('contest_description', null, array('class' => "form-control"))}}
			</div>
		</div>
	    <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-success">Update</button>
		      <element class="btn-cancel close_popup">Cancel</element>
		    </div>
		  </div>
	{{ Form::close() }}
@stop
