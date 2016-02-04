@extends('layouts.app')

@section('content')
	<h1>{{ $article->title }}</h1>

	<article>
		{{ $article->body }}
	</article>
	@unless ($article->tags->isEmpty())
		<h5>Tags:</h5>
		<ul>
			@foreach ($article->tags as $tag)
				<li>{{ $tag->name }}</li>
			@endforeach
		</ul>
	@endunless
	<hr>
	@if (!Auth::guest() && (Auth::user()->id == $article->user_id))
    {!! Form::open(['action' => ['ArticlesController@destroy', $article->id]]) !!}
		{!! method_field('delete') !!}
		<div class='form-group'>
			{!! Form::submit('Delete Article', ['class' => 'btn btn-danger form-control']) !!}
		</div>
	{!! Form::close() !!}
    @endif
@stop