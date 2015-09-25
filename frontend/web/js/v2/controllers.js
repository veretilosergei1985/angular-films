'use strict';

/* Controllers */

var filmControllers = angular.module('filmControllers', []);
/*
filmControllers.controller('filmListCtrl', ['$scope', '$http',
  function($scope, $http) {
    $http.get('phones/phones.json').success(function(data) {
      $scope.phones = data;
    });

    $scope.orderProp = 'age';
  }]);
*/  
  
filmControllers.controller('index', ['$scope', '$http', 'services', 
    function($scope, $http, services) {
    $scope.message = 'Everyone come and see how good I look!';
    services.getFilms().then(function(data){
        $scope.films = data.data;
    });    
    $scope.deleteFilm = function(filmID) {
        if(confirm("Are you sure to delete film number: " + filmID)==true && filmID>0){
            services.deleteFilm(filmID);    
            $route.reload();
        }
    };
}])
.controller('create', ['$scope', '$http', 'services','$location','film', 
    function($scope,$http,services,$location,film) {
    $scope.message = 'Look! I am an about page.';
    $scope.createFilm = function(film) {
        var results = services.createFilm(film);
    }  
}])
.controller('view', ['$scope', '$http', 'services', '$location', 'film', 
    function($scope, $http, services, $location, film) {
    //$scope.message = 'Look! I am an about page.';
    //$scope.mainImageUrl = film.data.images[0].image;
    $scope.film = film.data;
    
    $scope.setImage = function(imageUrl) {
      $scope.mainImageUrl = imageUrl.image;
    };
}])
.controller('update', ['$scope', '$http', '$routeParams', 'services','$location','film', 
    function($scope,$http,$routeParams,services,$location,film) {
    $scope.message = 'Contact us! JK. This is just a demo.';
    var original = film.data;
    $scope.film = angular.copy(original);
    $scope.isClean = function() {
        return angular.equals(original, $scope.film);
    }
    $scope.updateFilm = function(film) {    
        var results = services.updateFilm(film);
    } 
}]);

