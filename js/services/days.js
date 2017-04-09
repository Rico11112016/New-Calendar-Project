app.factory('days', ['$http', function($http) {
    return $http.get('http://slimapp/api/calendar')
        .success(function(data) {
            return data;
        })
        .error(function(err) {
            return err;
        });
}]);