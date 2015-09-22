'use strict';
yii2AngApp_site.config(['$routeProvider', function($routeProvider) {
  $routeProvider
    .when('/site/index', {
        templateUrl: '/partials/site/index.php',
        controller: 'index'
    })
    .when('/site/about', {
        templateUrl: 'partials/site/about.php',
        controller: 'about'
    })
    .when('/site/contact', {
        templateUrl: 'partials/site/contact.php',
        controller: 'contact'
    })
    .otherwise({
        redirectTo: '/site/index'
    });
}])
.controller('index', ['$scope', '$http', function($scope,$http) {
    // Сообщение для отображения представлением
    $scope.message = 'Вы читаете главную страницу приложения. ';
}])
.controller('about', ['$scope', '$http', function($scope,$http) {
    // Сообщение для отображения представлением
    $scope.message = 'Это страница с информацией о приложении.';
}])
.controller('contact', ['$scope', '$http', function($scope,$http) {
    // Сообщение для отображения представлением
    $scope.message = 'Пишите письма. Мы будем рады!.';
}]);