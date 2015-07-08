<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="access logs">
		<meta name="description" content="Show information about entering company.">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
		<link rel="stylesheet" href="{{ asset('/css/template.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/login.css') }}">

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>

		<title> Access Logs </title>
	</head>

	<body>
		<nav>
		    <div class="nav-wrapper cyan">
			<a href="{{ url('/') }}" class="brand-logo space"> Access Logs </a>
			<ul id="nav-mobile" class="right hide-on-med-and-down space">

				@if(!Auth::guest())
					<li><a href="{{ url('/form') }}"> Forms </a></li>
				@endif

				<li><a href="{{ url('/list') }}"> Lists </a></li>

				@if (Auth::guest())
					<li><a href="{{ url('/auth/login') }}">Login</a></li>
				@else
					<li><a class="dropdown-button" href="" data-activates="dropdown1"> {{ Auth::user()->name }} <i class="mdi-navigation-arrow-drop-down right"></i></a></li>
					<ul id="dropdown1" class="dropdown-content">
						<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
					</ul>
				@endif
				
			</ul>

		    </div>
		</nav>

		<div class="container content">

			<div class="row form blue-grey lighten-5">
				<p class="text-form teal-text">Login</p>
				
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

				<form class="col s12" method="POST" action="{{ url('/auth/login') }}" role="form">
				    	<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="row">
						<div class="input-field col s12">
							<input id="email" type="email" class="validate" value="{{ old('email') }}" name="email">
							<label for="email">E-mail Address</label>
						</div>
					</div>
					
					<div class="row">
						<div class="input-field col s12">
							<input id="password" type="password" class="validate" name="password">
							<label for="password">Password</label>
						</div>
					</div>
				    
					<p>
						<input type="checkbox" class="filled-in" id="filled-in-box" name="remember" />
						<label for="filled-in-box">Remember Me</label>
					</p>

					<button class="btn waves-effect wave-light right submit" type="submit" name="action">Login</button>
					
				</form>
			</div>

		</div>

		<footer class="page-footer white">	
		    <div class="footer-copyright cyan darken-3">
			<div class="space right white-text">
			    Boo Mamoo :)
			</div>
		    </div>
		</footer>

	</body>

</html>