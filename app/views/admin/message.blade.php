@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	@if (isset($success))
		<div class="alert alert-success">
			<h2> {{$success}} </h2>
		</div>
	@endif
	@if (isset($error))
		<div class="alert alert-error">
			<h2> {{$error}} </h2>
		</div>
	@endif
	<button class="btn btn-warning close_popup">Close</button>
@stop