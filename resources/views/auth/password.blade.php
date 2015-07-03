@extends('template')

@section('link')

	<link rel="stylesheet" href="{{ asset('/css/login.css') }}">

@endsection

@section('content')

	<div class="row form blue-grey lighten-5">
		<p class="text-form teal-text">Reset Password</p>

		@if (session('status'))
			<div class="alert green-text green lighten-4">
				{{ session('status') }}
			</div>
		@endif
		
		@if (count($errors) > 0)
			<div class="alert red-text red lighten-4">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li> - {{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form class="col s12" method="POST" action="{{ url('/password/email') }}" role="form">
		    	<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="row">
				<div class="input-field col s12">
					<input id="email" type="email" class="validate" value="{{ old('email') }}" name="email">
					<label for="email">E-mail Address</label>
				</div>
			</div>
			
			<button class="btn waves-effect wave-light right submit" type="submit" name="action">Send Password Reset Link</button>
		</form>
	</div>

@endsection
