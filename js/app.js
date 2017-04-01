var app = angular.module('CalendarApp', ['ngRoute']);
app.config(function ($routeProvider) {
    $routeProvider
        .when("/", {
            controller: "DaysController",
            templateUrl: "views/days.html"
        })
        .otherwise({
            redirecTo: "/"
        });
});