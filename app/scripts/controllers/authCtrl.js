app.controller('authCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data, $timeout, toastr) {
    //initially set those objects to null to avoid undefined error
    $scope.login = {};
    $scope.signup = {};
    $scope.message = {};
    $scope.testMessage = 'Just Testing';
    $scope.testName = '';
    $scope.doLogin = function (userName) {
        Data.post('login', {
          userName: userName
        }).then(function (results) {

          //  Data.toastr.success(results);
            if (results.status == "success") {
                toastr.clear();
                toastr.success(results.message);
                $scope.testMessage = 'Logged in as: ';
                //$scope.testName = results.name;

                Data.get('session').then(function (results) {
                  if (results.uid) {
                      $scope.testName = results.name;
                  }
                });
                //$scope.testName = ($_SESSION['name']);
                $location.path('profile');

                // $timeout(function() {
                //   // anything you want can go here and will safely be run on the next digest.
                // })
                // if($scope.$$phase) {
                //   //$digest or $apply
                // }

                // while($scope.$$phase) {
                //   //$digest or $apply
                // }
            } else {
              toastr.clear();
              toastr.error(results.message);
              $scope.testMessage = 'Wrong username or password! ' + results.status;
            }

        });
    };
    $scope.signup = {email:'',password:'',username:''};
    $scope.signUp = function (userName) {
        Data.post('signUp', {
          userName: userName
        }).then(function (results) {

            if (results.status == "success") {
              toastr.clear();
              toastr.success(results.message);
              $location.path('profile');
            } else {
              toastr.clear();
              toastr.error(results.message);
            }
        });
    };
    $scope.logout = function () {
        Data.get('logout').then(function (results) {
            //Data.toast(results);
            toastr.clear();
            toastr.success(results.message);
            $location.path('login');
            $scope.testMessage = 'Logged out';
            $scope.testName = '';
            $rootScope.uid = '';
        });
    };

    //$scope.testtest = $scope.uid;
    Data.get('session').then(function (results) {
      $scope.newMessage = {uid:results.uid, message:''};
    });

    Data.get('messages').then(function (results) {
      $scope.test = results.message;
    });

    $scope.postMessage = function (userName) {
        Data.post('postMessage', {
          userName: userName
        }).then(function (results) {
            if (results.status == "success") {
              toastr.clear();
              toastr.success(results.message);
              Data.get('messages').then(function (results) {
                $scope.test = results.message;
              });
            } else {
              toastr.clear();
              toastr.error(results.message);
            }
        });


    };


});
