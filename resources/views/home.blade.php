@extends('template')

@section('link')

	<link rel="stylesheet" href="{{ asset('/css/home.css') }}">

@endsection

@section('content')

	<div class="home center blue-grey lighten-5">
		<p> Hello, {{ Auth::user()->name }} </p>
	</div>

	<div class="button-home">  	  
		<a href="{{ url('list') }}" class="waves-effect waves-light btn center"><i class="mdi-file-cloud right"></i> Lists </a>	
	</div>

@endsection
