@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

    <!-- Tabs -->
    <!-- ./ tabs -->
    {{-- Delete Post Form --}}
    {{ Form::open(array('route' => array('admin.division.destroy', $div->id), 'method' => 'Delete', 'class' => "form-horizontal")) }}
        <!-- Form Actions -->
        <div class="control-group">
            <div class="controls">
               <h2> Are you Sure to delete the division named {{{$div->division_name}}} ? </h2>
                <button class="btn-cancel close_popup">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
        <!-- ./ form actions -->
    {{Form::close()}}
@stop