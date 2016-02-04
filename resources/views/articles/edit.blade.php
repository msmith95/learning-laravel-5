@extends('layouts.app')

@section('content')
	<h1>
	Edit: {!! $article->title !!}
	</h1>

	{!! Form::model( $article,['method' => 'PATCH', 'action' => ['ArticlesController@update', $article->id]]) !!}

	@include('articles.partials.form', array('submitButtonText' => 'Update Article'))

	{!! Form::close() !!}

	@include('errors.list')
@stop