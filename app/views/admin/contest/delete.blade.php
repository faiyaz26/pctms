@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

    <!-- Tabs -->
    <!-- ./ tabs -->
    {{-- Delete Post Form --}}
    {{ Form::open(array('route' => array('admin.contest.destroy', $contest->id), 'method' => 'Delete', 'class' => "form-horizontal")) }}
        <!-- Form Actions -->
        <div class="control-group">
            <div class="controls">
               <h2> Are you Sure to delete the contest this contest ? </h2>
               <h3> {{ $contest->contest_name}} </h3>
               <p> {{$contest->contest_description}} </p>
                <button type="submit" class="btn btn-danger">Delete</button>
                <button class="btn btn-warning close_popup">Cancel</button>
                
            </div>
        </div>
        <!-- ./ form actions -->
    {{Form::close()}}
@stop