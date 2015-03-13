//this code his modified from an online tutorial: http://www.angularcode.com/user-authentication-using-angularjs-php-mysql/
app.controller('authCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data, $timeout, toastr, $log, $filter) {
    //initially set those objects to null to avoid undefined error
    $scope.login = {};
    $scope.signup = {};
    $scope.message = {};
    $scope.testName = '';

    //reverses the array that is inputed
    $scope.reverse = function(array) {
      var copy = [].concat(array);
      return copy.reverse();
    };
    //Login function
    $scope.doLogin = function (userName) {
        //perform the login function in api/v1/authentication.php
        Data.post('login', {
          userName: userName
        }).then(function (results) {
            //if it's successful:
            if (results.status == "success") {
                toastr.clear();
                toastr.success(results.message);
                //$scope.testMessage = 'Logged in as: ';

                //get the session
                Data.get('session').then(function (results) {
                  if (results.uid) {
                      $scope.testName = results.name;
                  }
                });
                //when they log in, bring them to their profile
                $location.path('profile');
                $rootScope.isLogged = true;
                $log.debug($scope.isLogged);

            } else {
              //if things don't go so well, altert the user
              toastr.clear();
              toastr.error(results.message);
              $scope.testMessage = 'Wrong username or password! ' + results.status;
            }

        });
    };

    //initially set up the arrays for the signup information
    $scope.userExp = ['-Select Experience Level-', 'Beginnner', 'Intermediate', 'Expert'];
    $scope.signup = {email:'',password:'',username:'', experience:$scope.userExp[0]};

    //signup function
    $scope.signUp = function (userName) {
        //check to see if they have selected an experience level
        if($scope.signup.experience == '-Select Experience Level-'){
          toastr.error('No experience level selected');
        } else {
          //perform the signup function
          Data.post('signUp', {
            userName: userName
          }).then(function (results) {
              if (results.status == "success") {
                //tell the user what happened and take them to their profile
                toastr.clear();
                toastr.success(results.message);
                $location.path('profile');
              } else {
                //if things don't go so well, altert the user
                toastr.clear();
                toastr.error(results.message);
              }
          });
        }
    };

    //logout function
    $scope.logout = function () {
        Data.get('logout').then(function (results) {
            //when logging out, altert the user and reset some fields
            toastr.clear();
            toastr.success(results.message);
            $location.path('login');
            $scope.testMessage = 'Logged out';
            $scope.testName = '';
            $rootScope.uid = '';
            $rootScope.isLogged = false;
        });
    };

    //initialize the adventure log with some user info
    //gets the date in
    $scope.date = $filter('date')(new Date(),'yyyy-MM-dd');

    Data.get('session').then(function (results) {
      $scope.newMessage = {uid:results.uid, message:'', created:$scope.date};
      if (results.uid) {
        $rootScope.isLogged = true;
      }
    });

    //gets the user's adventure log postings, I've called them 'messages'
    Data.get('messages').then(function (results) {
      $scope.test = results.message;
      $scope.test = $scope.reverse($scope.test);
    });

    $scope.createMsg = false;

    $scope.createMessage = function (userName) {
      $scope.createMsg = true;
    }

    $scope.cancelMessage = function (userName) {
      $scope.createMsg = false;
    }

    //postMessage function
    $scope.postMessage = function (userName) {
        Data.post('postMessage', {
          userName: userName
        }).then(function (results) {
            if (results.status == "success") {
              toastr.clear();
              toastr.success(results.message);
              Data.get('messages').then(function (results) {
                $scope.test = results.message;
                $scope.test = $scope.reverse($scope.test);
              });
              $scope.newMessage.title = '';
              $scope.newMessage.message = '';
              $scope.newMessage.$error = false;
              $scope.newMessage.message.$error = false;
              $scope.createMsg = false;
            } else {
              toastr.clear();
              toastr.error(results.message);
            }

        });
    };
});
