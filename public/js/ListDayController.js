app.controller("ListDayController", function($scope, $http, $routeParams) {
	$scope.status = false;

	$http.get("/listDay/" + $routeParams.day + "/" + $routeParams.room + "/" + $routeParams.page)
	.success(function(response) {
		$scope.shows = response.shows;
		$scope.day = response.day;
		$scope.room = $routeParams.room;
		$scope.date = $routeParams.day;
		$scope.status = response.status;

		if($scope.shows.length == 0)
			$scope.show = false;
		else
		{
			$scope.show = true;
		}

		var date = new Date($scope.day);
		$scope.day = date.toISOString()

		$scope.total_page = [];
		$scope.pageNo = $routeParams.page;
		$scope.lastPage = response.total_page;

		for(var i = 1 ; i <= response.total_page ; i++)
		{
			$scope.total_page.push(i);
		}
	});
});
