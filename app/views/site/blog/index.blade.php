@extends('site.layouts.default')

{{-- Content --}}
@section('content')
@foreach ($posts as $post)
<div class="row">
	<div class="col-md-10">
		<!-- Post Title -->
		<div class="row">
			<div class="col-md-8">
				<h4><strong><a href="{{{ $post->url() }}}">{{ String::title($post->title) }}</a></strong></h4>
			</div>
		</div>
		<!-- ./ post title -->

		<!-- Post Content -->
		<div class="row">
			<div class="col-md-12">
				<p>
					{{ String::tidy(Str::limit($post->content, 200)) }}
				</p>
				<p><a class="btn btn-mini btn-default" href="{{{ $post->url() }}}">Read more</a></p>
			</div>
		</div>
		<!-- ./ post content -->

		<!-- Post Footer -->
		<div class="row">
			<div class="col-md-8">
				<p></p>
				<p>
					<span class="glyphicon glyphicon-user"></span> by <span class="muted"> <a href = "{{{URL::to('profile')}}}/{{{ $post->author->username }}}">
					{{{ $post->author->username}}}</a></span>
					| <span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $post->date() }}}
					| <span class="glyphicon glyphicon-comment"></span> <a href="{{{ $post->url() }}}#comments">{{$post->comments()->count()}} {{ \Illuminate\Support\Pluralizer::plural('Comment', $post->comments()->count()) }}</a>
				</p>
			</div>
		</div>
		<!-- ./ post footer -->
	</div>
</div>

<hr />
@endforeach

{{ $posts->links() }}

@stop
