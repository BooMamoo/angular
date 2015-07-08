app.controller('FormController', ['$scope', 'Upload', '$http', '$location', '$window', function ($scope, Upload, $http, $location, $window) 
{
   $scope.fileNameCard = "";
   $scope.fileNameLog = "";
   $scope.filesCard = [];
   $scope.filesLog = [];
   $scope.filesCard[0] = "";
   $scope.filesLog[0] = "";
   $scope.showCard = false;
   $scope.showLog = false;
   $scope.status = false;

    $http.get("form/info")
    .success(function(response) 
    {
        $scope.rooms = response.rooms;
        $scope.status = response.status;
    })
    .error(function(response, status) {
        if(status == 401)
        {
            $window.location = "/auth/login";
        }
    });

    $scope.$watch('filesCard', function () 
    {
        if($scope.filesCard != null && $scope.filesCard[0] != undefined)
        {
            $scope.fileNameCard = $scope.filesCard[0].name;
        }
    });

    $scope.$watch('filesLog', function () 
    {
        if($scope.filesLog != null && $scope.filesLog[0] != undefined)
        {
            $scope.fileNameLog = $scope.filesLog[0].name;
        }
    });

    $scope.uploadCard = function (filesCard) 
    {
        if($scope.model == undefined)
        {
            Materialize.toast("Please, choose room.", 2000);

            $scope.showCard = false;
        }
        else if(filesCard[0] == "")
        {
            Materialize.toast("Please, choose file.", 2000);

            $scope.showCard = false;
        }
        else
        {
            $scope.showCard = true;

            if (filesCard && filesCard.length) 
            {
                for (var i = 0; i < filesCard.length; i++) 
                {
                    var file = filesCard[i];
                    Upload.upload({
                        url: 'store/card',
                        method: 'POST',
                        fields: {'room': $scope.model.idCard},
                        file: file       
                    }).success(function(data) {
                        if(data == "true")
                        {
                            Materialize.toast("Success", 2000);
                        }
                        else
                        {
                            Materialize.toast(data[0], 2000)
                        }

                        $scope.filesCard = [];
                        $scope.filesCard[0] = "";
                        $scope.model.idCard = "";
                        $scope.fileNameCard = "";
                        $scope.showCard = false;
                        $('#selectFormCard').trigger('reset');
                    });
                }
            }
        }
    };

    $scope.uploadLog = function (filesLog) 
    {
        if($scope.model == undefined)
        {
            Materialize.toast("Please, choose room.", 2000);

            $scope.showLog = false;
        }
        else if(filesLog[0] == "")
        {
            Materialize.toast("Please, choose file.", 2000);

            $scope.showLog = false;
        }
        else
        {
            $scope.showLog = true;

            if (filesLog && filesLog.length) 
            {
                for (var i = 0; i < filesLog.length; i++) 
                {
                    var file = filesLog[i];
                    Upload.upload({
                        url: 'store/log',
                        method: 'POST',
                        fields: {'room': $scope.model.idLog},
                        file: file       
                    }).success(function(data) {
                        if(data == "true")
                        {
                            Materialize.toast("Success", 2000);
                        }
                        else
                        {
                            Materialize.toast(data[0], 2000)
                        }

                        $scope.filesLog = [];
                        $scope.filesLog[0] = "";
                        $scope.model.idCard = "";
                        $scope.fileNameLog = "";
                        $scope.showLog = false;
                        $('#selectFormLog').trigger('reset');
                    });
                }
            }
        }
    };
}]);

app.directive('myRepeatDirective', function($timeout) 
{
    return function(scope, element, attrs) 
    {
        if (element.is("option")) 
        {
            $timeout(function() {
                $('select').material_select();
            });  
        }
    };
});