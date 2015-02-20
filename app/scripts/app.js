'use strict';

/**
 * @ngdoc overview
 * @name myappApp
 * @description
 * # myappApp
 *
 * Main module of the application.
 */
var app = angular.module('myappApp', ['ngAnimate','ngCookies','ngMessages','ngRoute','ngSanitize','ngTouch','ngMaterial','ngMdIcons','ngCookies', 'toastr']);

app.config(function($mdThemingProvider) {
  $mdThemingProvider.theme('default')
  .primaryColor('blue-grey', {
    'default': '700', // by default use shade 700 from the cyan palette for primary intentions
    'hue-1': '100', // use shade 100 for the <code>md-hue-1</code> class
    'hue-2': '200', // use shade 200 for the <code>md-hue-2</code> class
    'hue-3': 'A100' // use shade A100 for the <code>md-hue-3</code> class
  })
  // If you specify less than all of the keys, it will inherit from the
  // default shades
  .accentColor('amber', {
    'default': '400', // use shade 600 for default, and keep all other shades the same
    'hue-1': '700' // use shade 100 for the <code>md-hue-1</code> class
  })
  .warnColor('red', {
    'default': '600' // use shade 400 for default, and keep all other shades the same
  });
})
  app.config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/character-details', {
        templateUrl: 'views/character-details.html',
        controller: 'DetailsCtrl'
      })
      .when('/proficiency', {
        templateUrl: 'views/proficiency.html#profTitle',
        controller: 'ProfCtrl'
      })
      .when('/ability-scores', {
        templateUrl: 'views/ability-scores.html',
        controller: 'AScoreCtrl'
      })
      .when('/to-do', {
        templateUrl: 'views/to-do.html',
        controller: 'ToDoCtrl'
      })
      .when('/character-summary', {
        templateUrl: 'views/character-summary.html',
        controller: 'SummaryCtrl'
      })
      .when('/login', {
        templateUrl: 'views/login.php',
        controller: 'authCtrl'
      })
      .when('/signup', {
        templateUrl: 'views/signup.html',
        controller: 'authCtrl'
      })
      .when('/profile', {
        templateUrl: 'views/profile.html',
        controller: 'authCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });

  })
  .run(function ($rootScope, $location, Data) {
    $rootScope.$on("$routeChangeStart", function (event, next, current) {
        $rootScope.authenticated = false;
        Data.get('session').then(function (results) {
            if (results.uid) {
                $rootScope.authenticated = true;
                $rootScope.uid = results.uid;
                $rootScope.name = results.name;
                $rootScope.email = results.email;
            } else {
                var nextUrl = next.$$route.originalPath;
                if (nextUrl == '/' || nextUrl == '/signup' || nextUrl == '/login') {

                } else {
                    $location.path("/login");
                }
            }
        });
    });
  })
  .controller('TestCtrl', function($scope) {
    $scope.title1 = 'Button';
    $scope.title4 = 'Warn';
    $scope.isDisabled = true;
    $scope.googleUrl = 'http://google.com';
  })
  .controller('AppCtrl', function($scope, $timeout, $mdSidenav, $log, $location, $anchorScroll, Data) {
    $scope.toggleLeft = function() {
      $mdSidenav('left').toggle()
      // .then(function(){
      //   $log.debug('toggle left is done');
      // });
      Data.get('session').then(function (results) {
        if (results.uid) {
          $scope.isLoggedIn = true;
          $log.debug($scope.isLoggedOut);
        } else {
          $scope.isLoggedIn = false;
          $log.debug($scope.isLoggedOut);
        }
      });
    };
    $scope.go = function ( path ) {
      $location.path( path );
      $mdSidenav('left').close();
    };

  })
  .controller('LeftCtrl', function($scope, $timeout, $mdSidenav, $log, $location, $anchorScroll) {
    $scope.close = function() {
      $mdSidenav('left').close()
      .then(function(){
        $log.debug('close LEFT is done');
      });
    };
    $scope.gotoTop = function (){
      // set the location.hash to the id of
      // the element you wish to scroll to.
      $location.hash('pageTitle');

      // call $anchorScroll()
      $anchorScroll();
    };
  });
