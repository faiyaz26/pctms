@extends('admin.layouts.default')

@section('content')
<div class="jumbotron">
  <h1>Hello, Administrator</h1>
  <h3> Some Infos about this Application </h3>
  <p> You have {{$usercnt}} users, you can manage users from here <a class="btn btn-primary" role="button" href = "{{URL::to('admin/users')}}">Users</a></p>
  <p> {{$contestcnt}} contests are coming, you can manage contest announcements from here <a class="btn btn-primary" role="button" href = "{{URL::to('admin/announcement')}}">Contest Announcements</a></p>
</div>
@stop