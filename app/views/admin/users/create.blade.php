@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
<!-- Nav tabs -->
<ul class="nav nav-tabs">
	<li><a href="#basic" data-toggle="tab">Basic Info</a></li>
	<li><a href="#contest" data-toggle="tab">Contest Related Info</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div class="tab-pane active" id="basic">
		{{Form::open(array('url' => 'admin/user/create', 'method' =>'POST' , 'class' => "form-horizontal"))}}
		<div class="form-group">
			<label class="col-md-2 control-label" for="fullname">Full Name</label>
			<div class="col-md-10">
				{{form::text('fullname', null, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="username">User Name</label>
			<div class="col-md-10">
				{{form::text('username', null, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="email">Email</label>
			<div class="col-md-10">
				{{form::text('email', null, array('id' => 'email', 'class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="password">Password</label>
			<div class="col-md-10">
				{{ Form::password('password', array('class' => 'form-control')) }}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="password_confirmation">Password Confirm</label>
			<div class="col-md-10">
				{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="confirm">Activate User?</label>
			<div class="col-md-4">
				{{ Form::select('confirm', array('1' => 'Yes', '2' => 'No'),'1',array('class' => 'form-control')) }}
			</div>
		</div>



		<div class="form-group {{{ $errors->has('roles') ? 'error' : '' }}}">
			<label class="col-md-2 control-label" for="roles">Roles</label>
			<div class="col-md-6">
				<select class="form-control" name="roles[]" id="roles[]" multiple>
					@foreach ($roles as $role)
						<option value="{{{ $role->id }}}"{{{ ( in_array($role->id, $selectedRoles) ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
					@endforeach
				</select>

				<span class="help-block">
					Select a group to assign to the user, remember that a user takes on the permissions of the group they are assigned.
				</span>
			</div>
		</div>



		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-success">Create</button>
				<button type="reset" class="btn btn-default">Clear</button>
				<element class="btn-cancel close_popup">Cancel</element>
			</div>
		</div>
		{{Form::close()}}
	</div>
	<div class="tab-pane" id="contest">
		<h1> Will Add Something </h1>
	</div>
</div>
@stop