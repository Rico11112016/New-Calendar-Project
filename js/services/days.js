app.factory('days', ['$http', function($http) {
    return $http.get('calendar.json')
        .success(function(data) {
            return data;
        })
        .error(function(err) {
            return err;
        });
}]);