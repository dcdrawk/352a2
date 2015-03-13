'use strict';

/**
 * @ngdoc function
 * @name myappApp.controller:MemberCtrl
 * @description
 * # MemberCtrl
 * Controller of the myappApp
 */

angular.module('myappApp')
  .controller('MemberCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data, toastr, $log, $filter, $cookies) {
    Data.get('members').then(function (results) {
      $scope.memberArray = results.message;
      //$log.debug($scope.memberArray);
    });
    var orderBy = $filter('orderBy');

    //function to change the order of the items of the member page
    $scope.order = function(predicate, reverse) {
      $scope.memberArray = orderBy($scope.memberArray, predicate, reverse);
    };

    //function to reverse the message array to order by date, ascending
    $scope.reverse = function(array) {
      var copy = [].concat(array);
      return copy.reverse();
    };

    //setting the values to the cookies
    $rootScope.selectedUserName = $cookies.selectedUserName;
    $scope.selectedUID = $cookies.selectedUID;
    var selectedUserName = $cookies.selectedUserName;

    //get the messages from the selected user
    $scope.getMessages = function(uid, userName){
      //sets some cookies to remember this page
      $rootScope.messageArray = {};
      $cookies.selectedUID = uid;
      $cookies.selectedUserName = userName;
      //get the messages from the database
      Data.post('memberMessages',{
        uid: uid
      }).then(function (results) {
        //store the messages into an array

        $rootScope.messageArray = results.message;
        $scope.messageArray = $scope.reverse($scope.messageArray);
        //if there's no messages in the array
        if($scope.messageArray.length == 0){
          //display a message if there are no logs written
          $scope.messageArray = [{0:'', 1:'', 2:'This user has not written any Adventure logs yet'}];
        }
      });
    };

  });
