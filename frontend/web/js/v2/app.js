'use strict';

var serviceBase = 'http://admin.films.loc/';

var app = angular.module('app', [
  'ngRoute',
  'filmControllers',
]);

app.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.useXDomain = true;
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
    }
]);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/film/index', {
        templateUrl: 'film/index.html',
        controller: 'index'
      })
      .when('/film/create', {
        templateUrl: 'film/create.html',
        controller: 'create',
        resolve: {
            film: function(services, $route){
                return services.getFilms();
            }
        }
    })
    .when('/film/update/:filmId', {
        templateUrl: 'film/update.html',
        controller: 'update',
        resolve: {
          film: function(services, $route){
            var filmId = $route.current.params.filmId;
            return services.getFilm(filmId);
          }
        }
    })    
    .when('/film/view/:filmId', {
        templateUrl: 'film/view.html',
        controller: 'view',
        resolve: {
          film: function(services, $route){
            var filmId = $route.current.params.filmId;
            return services.getFilm(filmId);
          }
        }
    })
    .when('/film/delete/:filmId', {
        templateUrl: 'film/index.html',
        controller: 'delete',
    })
    .otherwise({
        redirectTo: '/film/index'
    });
  }]);