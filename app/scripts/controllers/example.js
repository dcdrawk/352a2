'use strict';

/**
 * @ngdoc function
 * @name myappApp.controller:ExampleCtrl
 * @description
 * # ExampleCtrl
 * Controller of the myappApp
 */

angular.module('myappApp')
  .controller('ExampleCtrl', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];

  });
