<!doctype html>

<html>
	<head>
		<base href="/">

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="access logs">
		<meta name="description" content="Show information about entering company.">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">	
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--	<link rel="stylesheet" href="materialize/css/materialize.min.css">		-->
		<link rel="stylesheet" href="css/template.css">
		<link rel="stylesheet" href="css/welcome.css">
		<link rel="stylesheet" href="css/angular-chart.css">

<!--	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>	-->
		<script src="js/jquery.min.js"></script>
<!--	<script src="materialize/js/materialize.min.js"></script>	-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>		

<!--	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.1/angular.js"></script>	
		<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.1/angular-route.js"></script>	-->
		<script src="js/angular.js"></script> 
		<script src="js/angular-route.js"></script> 
<!--	<script src="js/angular-resource.js"></script>	-->
		<script src="js/ng-file-upload-shim.min.js"></script> 
		<script src="js/ng-file-upload.min.js"></script> 
		<script src="js/Chart.js"></script> 
		<script src="js/angular-chart.js"></script> 
		<script src="js/app.js"></script>
		<script src="js/StatusController.js"></script>
		<script src="js/FormController.js"></script>
		<script src="js/RoomController.js"></script>
		<script src="js/ListController.js"></script>
		<script src="js/NameController.js"></script>
		<script src="js/DayController.js"></script>
		<script src="js/CheckController.js"></script>
		<script src="js/ListNameController.js"></script>
		<script src="js/ListDayController.js"></script>
		<script src="js/ListCheckController.js"></script>
		<script src="js/ChartController.js"></script>

		<title> Access Logs </title>
	</head>

	<body ng-app="app">

		<nav>
		    <div class="nav-wrapper cyan">
			<a href="{{ url('/') }}" class="brand-logo space"> Access Logs </a>
			<ul id="nav-mobile" class="right hide-on-med-and-down space">

				@if(!Auth::guest())
					<li><a href="{{ url('/form') }}"> Forms </a></li>
				@endif

				<li><a href="{{ url('/list') }}"> Lists </a></li>

				@if (Auth::guest())
					<li><a href="{{ url('/auth/login') }}" target="_self">Login</a></li>
				@else
					<li><a class="dropdown-button" href="" data-activates="dropdown1"> {{ Auth::user()->name }} <i class="mdi-navigation-arrow-drop-down right"></i></a></li>
					<ul id="dropdown1" class="dropdown-content">
						<li><a href="{{ url('/auth/logout') }}" target="_self">Logout</a></li>
					</ul>
				@endif
				<!--
				<li><a class="dropdown-button" href="" data-activates="dropdown1"> Lists <i class="mdi-navigation-arrow-drop-down right"></i></a></li>
				<ul id="dropdown1" class="dropdown-content">
					<li><a href="#/name">Names</a></li>
					<li><a href="#/day">Days</a></li>
					<li><a href="#/check">Checks</a></li>
				</ul>
				-->
			</ul>

		    </div>
		</nav>

		<div class="container content">

			@yield('content')

		</div>

		<footer class="page-footer white">	
		    <div class="footer-copyright cyan darken-3">
			<div class="space right white-text">
			    Boo Mamoo :)
			</div>
		    </div>
		</footer>

		<script>
			$(document).ready(function() {
    			$('select').material_select();
 
				@yield('script')

			});
		</script>
	</body>

</html>
