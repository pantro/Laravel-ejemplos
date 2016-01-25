@extends('examples.layout')

@section('title')
	Curso Laravel duilio.me
@stop

@section('content')

	<h2> Curso básico de Laravel</h2>
	<p>
		@if (isset($user))
			Bienvenidos {{ $user }}
		@else
			[Login]
		@endif
	</p>
@stop