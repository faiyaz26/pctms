@extends('admin.layouts.default')

{{-- Content --}}
@section('content')
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
{{Form::open(array('url' => 'admin/users/'.$user->id."/edit", 'method' =>'POST' , 'class' => "form-horizontal"))}}
<!-- Tab panes -->
<div class="panel panel-default">
	<div class="panel-heading">Basic Info</div>
	<div class = "panel-body">
		<div class="form-group">
			<label class="col-md-2 control-label" for="fullname">Full Name</label>
			<div class="col-md-10">
				{{form::text('fullname', $user->fullname, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="username">User Name</label>
			<div class="col-md-10">
				{{form::text('username', $user->username, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="email">Email</label>
			<div class="col-md-10">
				{{form::text('email', $user->email , array('id' => 'email', 'class' => "form-control"))}}
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
				<select class="form-control" {{{ ($user->id === Confide::user()->id ? ' disabled="disabled"' : '') }}} name="confirm" id="confirm">
								<option value="1"{{{ ($user->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
								<option value="0"{{{ ( ! $user->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
				</select>
			</div>
		</div>



		<div class="form-group {{{ $errors->has('roles') ? 'error' : '' }}}">
			<label class="col-md-2 control-label" for="roles">Roles</label>
			<div class="col-md-6">
				<select class="form-control" name="roles[]" id="roles[]" multiple>
					@foreach ($roles as $role)
					<option value="{{{ $role->id }}}"{{{ ( array_search($role->id, $user->currentRoleIds()) !== false && array_search($role->id, $user->currentRoleIds()) >= 0 ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
					@endforeach
				</select>

				<span class="help-block">
					Select a group to assign to the user, remember that a user takes on the permissions of the group they are assigned.
				</span>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">Contest Related Information</div>
	<div class = "panel-body">
		<div class="form-group">
			<label class="col-md-2 control-label" for="cf_handle">Codeforces Handle</label>
			<div class="col-md-10">
				{{form::text('cf_handle', $info->cf_handle, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="cc_handle">Codechef Handle</label>
			<div class="col-md-10">
				{{form::text('cc_handle', $info->cc_handle, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="cm_handle">Codemarshal Handle</label>
			<div class="col-md-10">
				{{form::text('cm_handle', $info->cm_handle, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="tc_handle">Topcoder Handle</label>
			<div class="col-md-10">
				{{form::text('tc_handle', $info->tc_handle, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="loj_handle">Lightoj Handle</label>
			<div class="col-md-10">
				{{form::text('loj_handle', $info->loj_handle, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="uva_handle">UvA Handle</label>
			<div class="col-md-10">
				{{form::text('uva_handle', $info->uva_handle, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="spoj_handle">SPOJ Handle</label>
			<div class="col-md-10">
				{{form::text('spoj_handle', $info->spoj_handle, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="sgu_handle">SGU Handle</label>
			<div class="col-md-10">
				{{form::text('sgu_handle', $info->sgu_handle, array('class' => "form-control"))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label" for="hustoj_handle">HustOJ Handle</label>
			<div class="col-md-10">
				{{form::text('hustoj_handle', $info->hustoj_handle, array('class' => "form-control"))}}
			</div>
		</div>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<button type="submit" class="btn btn-success">Update</button>
		<button type="reset" class="btn btn-default">Clear</button>
		<element class="btn-cancel close_popup">Cancel</element>
	</div>
</div>
{{form::close()}}
@stop