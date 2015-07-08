app.controller("ListCheckController", function($scope, $http, $routeParams) {
	$scope.status = false;

	$http.get("/listCheckinfo/" + $routeParams.day + "/" + $routeParams.room + "/" + $routeParams.page)
	.success(function(response) {
		$scope.shows = response.shows;
		$scope.day = response.day;
		$scope.cards = response.cards;
		$scope.room = $routeParams.room;
		$scope.status = response.status;
		$scope.date = $routeParams.day;

		if($scope.shows.length == 0)
			$scope.show = false;
		else
		{
			$scope.show = true;
		}
		
		$scope.prints = [];

		for(var i = 0 ; i < $scope.cards.length ; i++)
		{
			$scope.prints[i] = {};
			$scope.prints[i].id = $scope.cards[i].card_id;
			$scope.prints[i].name = $scope.cards[i].name;
			$scope.prints[i].room_id = $scope.cards[i].room_id;
			$scope.prints[i].room_name = $scope.cards[i].room.room;

			if($scope.shows.length != 0)
			{
				while(parseInt($scope.cards[i].id) > parseInt($scope.shows[0].card_id))
				{
					$scope.shows.shift();
				}
		
				if($scope.cards[i].id == $scope.shows[0].card_id)
				{
					var tmp = $scope.shows.shift();
					$scope.prints[i].show = true;
					$scope.prints[i].access = tmp.access;
				}
				else
				{
					$scope.prints[i].show = false;
				}
			}
				
		}

		var date = new Date($scope.day);
		$scope.day = date.toISOString();

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
