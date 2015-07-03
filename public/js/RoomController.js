app.controller("RoomController", function($scope, $http) {
	$scope.status = false;

	$http.get("/room")
	.success(function(response) {
		$scope.rooms = response.rooms;
		$scope.status = response.status;
	});
});
