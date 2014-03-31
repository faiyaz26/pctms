@extends('site.layouts.default')

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
<div class="panel panel-primary">
	<div class="panel-heading">

		<ul class="nav nav-pills">
			<li><a href="{{URL::to('/profile')}}">Profile</a></li>
			<li><a href="#">Blogs</a></li>
			<li><a href="{{URL::to('profile/'.Auth::user()->username.'/contests')}}">Contests</a></li>
			<li class="active"><a href="{{URL::to('/settings')}}">Settings</a></li>
		</ul>
	</div>
	<div class = "panel-body">
		{{Form::open(array('url' => '/settings', 'method' =>'POST' , 'class' => "form-horizontal"))}}
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
						{{form::text('username', $user->username, array('class' => "form-control", 'disabled ' => ''))}}
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
			</div>
		</div>
		{{form::close()}}
	</div>
</div>
@stop