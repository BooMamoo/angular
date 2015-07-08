app.controller("RoomController", function($scope, $http) {
	$scope.status = false;

	$http.get("/roominfo")
	.success(function(response) {
		$scope.rooms = response.rooms;
		$scope.status = response.status;
	});
});

// app.controller("RoomController", function($scope, $http, roomData) {
// 	$scope.status = false;
// 	$scope.rooms = roomData.rooms;
// 	$scope.status = roomData.status;
// });

// app.controller("RoomController", function($scope, $http, Room) {
// 	$scope.status = false;
// 	$rooms = Room.query();	
// });