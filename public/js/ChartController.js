app.controller("ChartController", function ($scope, $http, $routeParams) {
	$http.get('chartinfo/' + $routeParams.room)
	.success(function(response) {
		$scope.labels = [];
		$scope.data = [[], []];
		var total = response.totalCharts;
		var num = response.numCharts;

		var month = { "01" : "January",   "02" : "February", "03" : "March",    "04" : "April", 
					  "05" : "May",       "06" : "June",     "07" : "July",     "08" : "August",
					  "09" : "September", "10" : "October",  "11" : "November", "12" : "December"}

		for(var i = 0 ; i < total.length ; i++)
		{
			var tmp = total[i].month.split(" ");
			$scope.labels.push(month[tmp[1]] + " " + tmp[0]);
			$scope.data[0].push(total[i].total);
		}

		for(var i = 0 ; i < num.length ; i++)
		{
			$scope.data[1].push(num[i].num);
		}

		$scope.series = ['Total Log', 'Num of Card'];

	});
});