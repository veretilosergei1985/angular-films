'use strict';

var serviceBase = 'http://admin.films.loc/';

var app = angular.module('app', [
  'ngRoute',
  'filmControllers',
]);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/site/index', {
        templateUrl: 'film/index.html',
        controller: 'filmListCtrl'
      }).
      otherwise({
        redirectTo: '/film/index'
      });
  }]);