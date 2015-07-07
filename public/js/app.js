var app = angular.module("app", ["ngRoute", 'ngFileUpload']);

// var app = angular.module("app", ["ngRoute", 'ngFileUpload', 'ngResource']);
// app.factory('Room' , ['$resource', function($resource){
// 	return $resource('/room', {}, {
// 		query : {
// 			isArray: false
// 		}
// 	});
// }]);

app.config(function($routeProvider) {
	$routeProvider.when('/', {
		templateUrl: 'pages/index.html',
	});

	$routeProvider.when('/form', {
		templateUrl: 'pages/form.html',
		controller: 'FormController'
	});

	$routeProvider.when('/list', {
		templateUrl: 'pages/list.html',
		controller: 'RoomController',
		// resolve: {
		// 	roomData: ['$http', function($http){
		// 		return $http.get("/room");
		// 	}]
		// }
	});

	$routeProvider.when('/name/:room/:page', {
		templateUrl: 'pages/name.html',
		controller: 'NameController'
	});

	$routeProvider.when('/day/:room/:page', {
		templateUrl: 'pages/day.html',
		controller: 'DayController'
	});

	$routeProvider.when('/check/:room/:page', {
		templateUrl: 'pages/check.html',
		controller: 'CheckController'
	});

	$routeProvider.when('/listName/:id/:room/:page', {
		templateUrl: 'pages/listName.html',
		controller: 'ListNameController'
	});

	$routeProvider.when('/listDay/:day/:room/:page', {
		templateUrl: 'pages/listDay.html',
		controller: 'ListDayController'
	});

	$routeProvider.when('/listCheck/:day/:room/:page', {
		templateUrl: 'pages/listCheck.html',
		controller: 'ListCheckController'
	});

	$routeProvider.otherwise({
		redirectTo: '/'
	});

	
});
