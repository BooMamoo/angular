app.controller("CheckController", function($scope, $http, $routeParams) 
{
	$scope.status = false;

	$http.get("/checkinfo/" + $routeParams.room + "/" + $routeParams.page)
	.success(function(response) {
		$scope.checks = response.checks;
		$scope.room = response.room;
		$scope.status = response.status;

		$scope.total_page = [];
		$scope.pageNo = parseInt($routeParams.page);
		$scope.lastPage = parseInt(response.total_page);

		var lenPage = 3;

		function sortNumber(a, b) 
		{
		    return a - b;
		}

		if($scope.lastPage < 7)
		{
			for(var i = 1 ; i <= $scope.lastPage ; i++)
			{
				$scope.total_page.push(i);
			}
		}
		else if(($scope.pageNo - lenPage >= 1) && ($scope.pageNo + lenPage <= $scope.lastPage))
		{
			$scope.total_page.push($scope.pageNo);

			for(var i = 1 ; i <= lenPage ; i++)
			{
				$scope.total_page.push($scope.pageNo - i);
				$scope.total_page.push($scope.pageNo + i);
			}

			$scope.total_page.sort(sortNumber);
		}
		else if($scope.pageNo - lenPage < 1)
		{
			var tmp = lenPage - ($scope.pageNo - 1);

			$scope.total_page.push($scope.pageNo);

			for(var i = 1 ; i <= lenPage + tmp ; i++)
			{
				if($scope.pageNo - i >= 1)
				{
					$scope.total_page.push($scope.pageNo - i);
				}

				$scope.total_page.push($scope.pageNo + i);
			}

			$scope.total_page.sort(sortNumber);
		}
		else if($scope.pageNo + lenPage > $scope.lastPage)
		{
			var tmp = lenPage - ($scope.lastPage - $scope.pageNo);

			$scope.total_page.push($scope.pageNo);

			for(var i = 1 ; i <= lenPage + tmp ; i++)
			{
				if($scope.pageNo + i <= $scope.lastPage)
				{
					$scope.total_page.push($scope.pageNo + i);
				}

				$scope.total_page.push($scope.pageNo - i);
			}

			$scope.total_page.sort(sortNumber);
		}
	});
});
