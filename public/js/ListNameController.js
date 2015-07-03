app.controller("ListNameController", function($scope, $http, $routeParams) {
	$scope.status = false;

	$http.get("listName/" + $routeParams.id + "/" + $routeParams.room + "/" + $routeParams.page)
	.success(function(response) {
		$scope.shows = response.shows;
		$scope.name = response.name;
		$scope.card_id = response.card_id;
		$scope.room = $routeParams.room;
		$scope.id = $routeParams.id;
		$scope.status = response.status;

		if($scope.shows.length == 0)
			$scope.show = false;
		else
		{
			$scope.show = true;
		}

		$scope.total_page = [];
		$scope.pageNo = $routeParams.page;
		$scope.lastPage = response.total_page;

		for(var i = 1 ; i <= response.total_page ; i++)
		{
			$scope.total_page.push(i);
		}
	});
});
