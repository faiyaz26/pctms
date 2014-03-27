@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.profile') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')

<div class="panel panel-default">
  <div class="panel-header">
    <h3>Contest Records with <a href= "{{URL::to('profile/'.$username)}}"> {{$username}} </a> </h3>
  </div>
  <div class="panel-body">
    <div class = "row">
        <div class="col-md-12">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th> <p class="text-center">#</p> </th>
                        <th> <p class="text-center">Contest Name </p></th>
                        <th> <p class="text-center">Contest Date </p></th>
                        <th> <p class="text-center">Rank </p></th>
                        <th> <p class="text-center">Points </p></th>
                        <th> <p class="text-center">Solved </p></th>
                        <th> <p class="text-center">Attempted </p></th>
                    </tr>
                </thead>
                <?php $i = 0; ?>
                <tbody>
                    @foreach ($contest_data as $data)
                        <tr>
                            <td> <p class="text-center"> {{++$i}} </p> </td>
                            <td> <p class="text-center"> {{$data->contest_name}} </p></td>
                            <td> <p class="text-center"> {{$data->contest_date}} </p></td>
                            <td> <p class="text-center"> {{$data->position}} </p></td>
                            <td> <p class="text-center"> {{$data->points}} </p></td>
                            <td> <p class="text-center"> {{$data->solved}} </p></td>
                            <td> <p class="text-center"> {{$data->attempt}} </p></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
</div>
@stop
