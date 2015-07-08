app.controller("StatusController", function($scope, $http) {
	$http.get("/status")
	.success(function(response) {
		$scope.status = response.status;

		if($scope.status)
		{
			$scope.name = response.name;
		}
	});
});