app.controller("DayController", function($scope, $http, $routeParams) 
{
	$scope.status = false;

	$http.get("/day/" + $routeParams.room + "/" + $routeParams.page)
	.success(function(response) {
		$scope.days = response.days;
		$scope.room = response.room;
		$scope.total_page = [];
		$scope.pageNo = $routeParams.page;
		$scope.lastPage = response.total_page;
		$scope.status = response.status;

		for(var i = 1 ; i <= response.total_page ; i++)
		{
			$scope.total_page.push(i);
		}
	});
});
