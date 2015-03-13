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
      .when('/adventure-log', {
        templateUrl: 'views/adventure-log.html',
        controller: 'authCtrl'
      })
      .when('/members', {
        templateUrl: 'views/members.html',
        controller: 'MemberCtrl'
      })
      .when('/member-details', {
        templateUrl: 'views/member-details.html',
        controller: 'MemberCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });

  })
  //this function will run when the page is loaded
  .run(function ($rootScope, $location, Data) {
    $rootScope.$on("$routeChangeStart", function (event, next, current) {
        $rootScope.authenticated = false;
        Data.get('session').then(function (results) {
            if (results.uid) {
                $rootScope.authenticated = true;
                $rootScope.uid = results.uid;
                $rootScope.name = results.name;
                $rootScope.email = results.email;
            }
        });
    });
  })
  // //Old Controller
  // .controller('ProfileCtrl', function($scope) {
  //   $scope.title4 = 'Warn';
  //   $scope.isDisabled = true;
  //   $scope.googleUrl = 'http://google.com';
  // })

  .controller('AppCtrl', function($scope, $rootScope, $window, $timeout, $mdSidenav, $log, $location, $anchorScroll, Data, toastr) {
    $scope.editingEmail = false;

    Data.get('session').then(function (results) {
      if (results.uid) {
        $scope.myEmail = results.email;
        $scope.userExperience = results.experience;
      }
    });

    //this function will force the browser to use HTTPS
    //code from: http://stackoverflow.com/questions/22689543/forcing-a-specific-page-to-use-https-with-angularjs
    $rootScope.forceSSL = function () {
         if ($location.protocol() != 'https')
             $window.location.href = $location.absUrl().replace('http', 'https');
   }

     //If I wanted to switch back to HTTP, but it causes the whole page to refresh
     $rootScope.forceHTTP = function () {
          if ($location.protocol() != 'http')
              $window.location.href = $location.absUrl().replace('https', 'http');
    }

      //call the function when the app runs
      $rootScope.forceSSL();

    //function to toggle the left navigation
    $scope.toggleLeft = function() {
      $mdSidenav('left').toggle()

      //check to see if the user is logged in, will change what options are shown in the menu
      Data.get('session').then(function (results) {
        if (results.uid) {
          $scope.isLoggedIn = true;
        } else {
          $scope.isLoggedIn = false;
        }
      });
    };

    //changes the location path/page of the app
    $scope.go = function ( path ) {
      $location.path( path );
      $mdSidenav('left').close();
    };

    //When user is editing the email
    $scope.editEmail = function (){
      $scope.editingEmail = true;
    }

    //User cancles the action
    $scope.cancel = function (){
      $scope.editingEmail = false;
    }

    //User confirms the edit to email
    $scope.newEmail = {email:''}
    $scope.confirmEmail = function (userName) {
        Data.post('updateEmail', {
          userName: userName
        }).then(function (results) {
            if (results.status == "success") {
              toastr.clear();
              toastr.success(results.message);
              Data.get('session').then(function (results) {
                $log.debug(results.email);
                //$scope.newEmail = {email:results.email};
                $scope.myEmail = results.email;
                $scope.editingEmail = false;
              });
            } else {
              toastr.clear();
              toastr.error(results.message);
            }
        });
    };
  })

  //Controller for the left nav
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
