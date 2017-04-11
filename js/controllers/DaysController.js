app.controller('DaysController', ['$scope', 'weeks_and_days', function($scope, weeks_and_days) {
    weeks_and_days.success(function(data) {
        $scope.weeks_and_days = data;
    });
}]);