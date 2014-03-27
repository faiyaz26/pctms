@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.profile') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <div class = "row">
        <div class="col-md-8">
            <h1>{{ $username }}</h1>
            <h4>{{ $fullname }} </h4>
            <table class="table">
                <thead>
                    <tr>
                        <th> OJ </th>
                        <th> Handle </th>
                    </tr>
                </thead>
                <tbody>
                    <tr> <td> Codeforces</td> <td> <a href = "http://codeforces.com/profile/{{$info->cf_handle}}" target= "_blank" style = "text-decoration: none;"> {{$info->cf_handle}} </a> </td> </tr>
                    <tr> <td> CodeChef</td> <td> <a href = "http://www.codechef.com/users/{{$info->cc_handle}}" target= "_blank" style = "text-decoration: none;"> {{$info->cc_handle}} </a> </td> </tr>
                    <tr> <td> CodeMarshal </td> <td> <a href = "http://codeforces.com/profile/{{$info->cf_handle}}" target= "_blank" style = "text-decoration: none;"> {{$info->cf_handle}} </a> </td> </tr>
                    <tr> <td> TopCoder </td> <td>  {{$info->tc_handle}}  </td> </tr>
                    <tr> <td> LightOJ </td> <td> <a href = "http://www.lightoj.com/volume_userstat.php?user_id={{$info->loj_handle}}" target= "_blank" style = "text-decoration: none;"> {{$info->loj_handle}} </a> </td> </tr>
                    <tr> <td> UVa </td> <td> <a href = "http://codeforces.com/profile/{{$info->cf_handle}}" target= "_blank" style = "text-decoration: none;"> {{$info->uva_handle}} </a> </td> </tr>
                    <tr> <td> SPOJ  </td> <td> <a href = "http://www.spoj.com/users/{{$info->spoj_handle}}" target= "_blank" style = "text-decoration: none;"> {{$info->spoj_handle}} </a> </td> </tr>
                    <tr> <td> SGU </td> <td> <a href = "http://codeforces.com/profile/{{$info->cf_handle}}" target= "_blank" style = "text-decoration: none;"> {{$info->sgu_handle}} </a> </td> </tr>
                    <tr> <td> HustOJ </td> <td>  {{$info->hustoj_handle}}  </td> </tr>

                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="text-right">
                    <img src="http://www.gravatar.com/avatar/{{$avatar}}?s=200" alt="" class="img-rounded img-responsive" />
                    </p>
                </div>
            </div>
            <div>
            </div>
        </div>

    </div>
</div>
</div>
@stop
