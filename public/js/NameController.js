app.controller("NameController", function($scope, $http, $routeParams) 
{
	$scope.status = false;

	$http.get("/name/" + $routeParams.room + "/" + $routeParams.page)
	.success(function(response) {
		$scope.cards = response.cards;
		$scope.room = response.room;
		$scope.status = response.status;
		$scope.total_page = [];
		$scope.pageNo = $routeParams.page;
		$scope.lastPage = response.total_page;

		for(var i = 1 ; i <= response.total_page ; i++)
		{
			$scope.total_page.push(i);
		}
	});
});
