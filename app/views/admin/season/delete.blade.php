@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

    <!-- Tabs -->
    <!-- ./ tabs -->
    {{-- Delete Post Form --}}
    {{ Form::open(array('route' => array('admin.season.destroy', $div->id), 'method' => 'Delete', 'class' => "form-horizontal")) }}
        <!-- Form Actions -->
        <div class="control-group">
            <div class="controls">
               <h2> Are you Sure to delete the season named  <strong> {{{$div->division_name}}}</strong> ? </h2>
                <button type="submit" class="btn btn-danger">Delete</button>
                <button class="btn btn-warning close_popup">Cancel</button>
            </div>
        </div>
        <!-- ./ form actions -->
    {{Form::close()}}
@stop