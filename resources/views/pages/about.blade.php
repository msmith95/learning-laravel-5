@extends('app')

@section('content')
	<h1>About Me!</h1>

	<h3>People I Like:</h3>
	<ul>
	@foreach ($people as $person)
		<li> {{ $person }}
	@endforeach
	</ul>
@stop
</html>