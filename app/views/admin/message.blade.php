@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	@if (isset($success))
		<div class="alert alert-success">
			{{{$success}}}
		</div>
	@endif
	@if (isset($error))
		<div class="alert alert-error">
			{{{$error}}}
		</div>
	@endif
	<button class="btn-cancel close_popup">Close</button>
@stop