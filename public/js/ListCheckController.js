app.controller("ListCheckController", function($scope, $http, $routeParams) {
	$scope.status = false;

	$http.get("/listCheck/" + $routeParams.day + "/" + $routeParams.room + "/" + $routeParams.page)
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
		$scope.pageNo = $routeParams.page;
		$scope.lastPage = response.total_page;

		for(var i = 1 ; i <= response.total_page ; i++)
		{
			$scope.total_page.push(i);
		}
	});

});
