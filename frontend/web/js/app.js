'use strict';

var serviceBase = 'http://admin.films.loc';

var yii2AngApp = angular.module('yii2AngApp', [
  'ngRoute',
  'yii2AngApp.site1'
]);
// рабочий модуль
var yii2AngApp_site1 = angular.module('yii2AngApp.site1', ['ngRoute']);

yii2AngApp.config(['$routeProvider', function($routeProvider) {
  // Маршрут по-умолчанию
  $routeProvider.otherwise({redirectTo: '/site/index'});
}]);