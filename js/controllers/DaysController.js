app.controller('DaysController', ['$scope', 'days', function($scope, days) {
    days.success(function(data) {
        $scope.days = data;
    });
}]);