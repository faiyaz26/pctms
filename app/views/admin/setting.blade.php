@extends('admin.layouts.default')

@section('content')



<div class = "row">
	<h2> Edit Division </h2>
	@if ($error)
		<div class="alert alert-danger">
			{{  $error }}
		</div>
	@endif
	@if (isset($success))
		<div class = "alert alert-success">
			{{$success}}
		</div>
	@endif
	<div class="col-md-8">
		{{Form::open(array('url'=> 'admin/appsettings/site','method' => "POST", 'role' => 'form'))}}
		  <div class="form-group">
		    <label for="site_name">Site Name</label>
		    <input type="text" class="form-control" name="site_name" value = "{{{Setting::get('site_name')}}}"/>
		  </div>
		  <div class="form-group">
		    <label for="contest_view_limit">Contest Announcment View Limit</label>
		    <input type="text" class="form-control" name="contest_view_limit" value = "{{Setting::get('contest_view_limit')}}"/>
		  </div>
		  <button type="submit" class="btn btn-default">Submit</button>
		{{Form::close()}}
	</div>
  	<div class="col-md-4">.col-md-4</div>
</div>
@stop