var app = angular.module('CalendarApp', ['ngRoute']);
app.config(function ($routeProvider) {
    $routeProvider
        .when("/", {
            controller: "DaysController",
            templateUrl: "views/test.html"
        })
        .otherwise({
            redirecTo: "/"
        });
});