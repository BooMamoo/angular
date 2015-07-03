app.controller("ListController", function($scope, $http, $routeParams) {
	$http.get("/list/" + $routeParams.room)
	.success(function(response) {
		$scope.cards = response.cards;
		$scope.days = response.days;
		$scope.checks = response.checks;
		$scope.room = response.room;

		for(var i = 0 ; i < $scope.checks.length ; i++)
		{
			var date = new Date($scope.checks[i].d);
			$scope.checks[i].d = date.toISOString();
		}
	});
});
