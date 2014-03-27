<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Programming Contest Team Management System
			@show
		</title>
		<meta name="keywords" content="Programming Contest, Programming Contest Managment" />
		<meta name="author" content="Ahmad Faiyaz" />
		<meta name="description" content="Programming Contest Team Management System is system to manage and track programming contest team or contestants of 
a university or any other institution. It is kinda intra social network." />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
        {{-- Basset::show('public.css') --}}

        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/bootstrap.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/less.compiled.css')}}" />
		<style>
		@section('styles')
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('ico/apple-touch-icon-144-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('ico/apple-touch-icon-114-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('ico/apple-touch-icon-72-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" href="{{{ asset('ico/apple-touch-icon-57-precomposed.png') }}}">
		<link rel="shortcut icon" href="{{{ asset('ico/favicon.png') }}}">
	</head>

	<body>
		<!-- To make sticky footer need to wrap in a div -->
		<div id="wrap">
		<!-- Navbar -->
		<div class="navbar navbar-default navbar-fixed-top">
			 <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
						<li {{ (Request::is('/') ? ' class="active"' : '') }}><a class="navbar-brand" href="{{{ URL::to('') }}}">{{Setting::get('site_name') }}</a></li>
					</ul>

                    <ul class="nav navbar-nav pull-right">
                        @if (Auth::check())
                        @if (Auth::user()->hasRole('admin'))
                        	<li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
                        @endif
                        <li><a href="{{{ URL::to('user') }}}">Logged in as {{{ Auth::user()->username }}}</a></li>
                        <li><a href="{{{ URL::to('user/logout') }}}">Logout</a></li>
                        @else
                        <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
                        <li {{ (Request::is('user/register') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
                        @endif
                    </ul>
					<!-- ./ nav-collapse -->
				</div>
			</div>
		</div>
		<!-- ./ navbar -->
		<div style = "margin-top: 5%;">
		</div>
		<!-- Container -->
		<div class="container">
			<!-- Notifications -->
			@include('notifications')
			<!-- ./ notifications -->
			<div class="row">
				<div class="col-md-8">
					<!-- Content -->
						@yield('content')
					<!-- ./ content -->
				</div>
				<div class="col-md-4">
					@if (Auth::guest() == false)
						<div class="panel panel-success">
						  <div class="panel-heading">
						    <h3 class="panel-title">Hello, {{{Auth::user()->username}}}</h3>
						  </div>
						  <div class="panel-body">
						  	  <div class = "col-md-8">
						  	   <p class = "text-left">
							  	  	<ul>
							  	  		<li> <a href = "{{URL::to('profile/'.Auth::user()->username)}}"> Profile </a> </li>
							  	  		<li> Blogs </li>
							  	  		<li> <a href = "{{URL::to('profile/'.Auth::user()->username).'/contests'}}"> Contests </li>
							  	  		<li> <a href = "{{URL::to('/settings')}}"> Settings </a> </li>
							  	  		<li> <a href = "{{URL::to('user/logout')}}"> Logout </a> </li>
							  	  	</ul>
						  	  	</p>
						  	  </div>
						  	  <div class = "col-md-4">
						  	  		<p class = "text-center">
						  	  			<a href = "{{URL::to('profile/'.Auth::user()->username)}}">
							  	  			<img src="http://www.gravatar.com/avatar/{{md5(Auth::user()->email)}}?s=200" alt="" class="img-responsive" />
							  	  		</a>
							  	  		<a href = "{{URL::to('profile/'.Auth::user()->username)}}" style = "text-decoration: none;"> {{Auth::user()->username}}</a>
						  	  		</p>
						  	  </div>
						  </div>
						</div>
					@else
						<div class="panel panel-warning">
							  <div class="panel-heading">
							    <h3 class="panel-title">Hello, Stranger</h3>
							  </div>
							  <div class="panel-body">
							  	  Please login, or register your self </br>
							  	  <a href = "{{URL::to('login')}}" class="btn btn-success">Login</a>
							  	  <a href = "{{URL::to('register')}}" class="btn btn-info">Register</a>
							  </div>
							</div>
					@endif
					@if (isset($contest_ann))
						<div class="panel panel-info">
						  <div class="panel-heading">
						    <h3 class="panel-title">Upcoming Contests</h3>
						  </div>
						  <div class="panel-body">
							    @foreach ($contest_ann as $ann)
							    	<div class="well">
								    	<p class = "text-center"> 
								    		<h4> {{ $ann->contest_name }} </h4>
								    			<?php
								    				$datetime = date_parse_from_format ('Y-m-d H:i:s' , $ann->contest_datetime );
								    				$day = $datetime['day'];
								    				$mon = $datetime['month'];
								    				$year = $datetime['year'];
								    				$hour = $datetime['hour'];
								    				$min = $datetime['minute'];
								    				$val = mktime($hour,$min,0,$mon,$day,$year);
								    				$format = date("Ymd", $val);
								    				$tm = date('Hi', $val);
								    				print '<a target = "_blank" href = "http://www.timeanddate.com/countdown/generic?p0=73&iso='.$format.'T'.$tm.'">';
								    			?>
								    			Check Time </a>

								    	</p>
								    </div>
								@endforeach
						  </div>
						</div>
					@endif
					<div class="panel panel-default">
					  <div class="panel-heading">
					    <h3 class="panel-title">Find User</h3>
					  </div>
					  <div class="panel-body">
					  	
					  </div>
					</div>
				</div>
			</div>
			
		</div>
		<!-- ./ container -->

		<!-- the following div is needed to make a sticky footer -->
		<div id="push"></div>
		</div>
		<!-- ./wrap -->


	    <div id="footer">
	      <div class="container">
	        <p class="muted credit">Programming Contest Team Management System on <a href="https://github.com/faiyaz26/pctms">Github</a>.</p>
	      </div>
	    </div>

		<!-- Javascripts
		================================================== -->
		<script src = "{{asset('js/jquery_1.10.1.js')}}"> </script>
		<script src = "{{asset('js/bootstrap/bootstrap.js')}}"> </script>
		@yield('scripts')
        {{-- Basset::show('public.js') --}}
	</body>
</html>
