'use strict';

/**
 * @ngdoc function
 * @name myappApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the myappApp
 */
angular.module('myappApp')
  .controller('SummaryCtrl', function ($scope, $cookies, $log, $location, $anchorScroll) {


    var myName = $cookies.charName;
    var myLevel = $cookies.level;
    var myRace = $cookies.race;
    var myClass = $cookies.class;
    var i = 0;
    var j = 0;

    $scope.detailsArray = [$cookies.charName, $cookies.level, $cookies.race, $cookies.class];
    $scope.modArray = [$cookies.strMod, $cookies.dexMod, $cookies.conMod, $cookies.intMod, $cookies.wisMod, $cookies.chaMod];
    //
    // for (j = 0; j < $scope.modArray.length; j++){
    //   var
    // }
    // var myStr = $cookies.strMod;
    // var myDex = $cookies.dexMod;
    // var myCon = $cookies.conMod;
    // var myInt = $cookies.intMod;
    // var myWis = $cookies.wisMod;
    // var myCha = $cookies.chaMod;
    var missingDetails = 0;
    var missingStats = 0;



  //  $scope.modArray = [myStr, myDex, myCon, myInt, myWis, myCha];
    $scope.isHidden = false;
    $scope.isModMsgHidden = false;

    $scope.levelMsg = '';
    $scope.raceMsg = '';
    $scope.classMsg = '';

    $scope.basicMessage = [{
      msg : 'Some character details appear to be missing. Tap to correct.'
    }];

    $scope.abilityScoreMessage = [{
      msg : 'Ability scores missing. Tap to correct.'
    }];

    if(typeof $scope.detailsArray[0] === 'undefined' || $scope.detailsArray[0] === ''){
      $scope.detailsArray[0] = 'Unknown Name'; //Placeholder name if undefined
    }

    if(typeof myLevel === 'undefined' || myLevel === 'NaN'){
      $scope.levelMsg = '';
    }else{
      $scope.levelMsg = 'Level ' + myLevel;
    }

    if(typeof myRace === 'undefined' || myRace === 'Select a Race'){
      $scope.raceMsg = '';
    }else{
      $scope.raceMsg = myRace;
    }

    if(typeof myClass === 'undefined' || myClass === 'Select a Class'){
      $scope.classMsg = '';
    }else{
      $scope.classMsg = myClass;
    }

    for(j = 0; j < $scope.detailsArray.length; j++){
      $log.debug($scope.detailsArray[j]);
      if(typeof $scope.detailsArray[j] === 'undefined' || $scope.detailsArray[j] === 'Unknown Name' || $scope.detailsArray[j] === 'NaN' || $scope.detailsArray[j] === 'Select a Class' || $scope.detailsArray[j] === 'Select a Race'){
        $scope.isHidden = false;
        missingDetails++;
      } else {
        if(missingDetails === 0){
          $scope.isHidden = true;
        }
      }
    }


    for(i = 0; i < $scope.modArray.length; i++){
      //$log.debug('It works');
      if (typeof $scope.modArray[i] === 'undefined' || $scope.modArray[i] === 'undefined' || $scope.modArray[i] === 'null'){
        //$log.debug('NOT DEFINED!');
        $scope.isModMsgHidden = false;
        missingStats++;
        $scope.modArray[i] = '-';
      } else {
        if (missingStats === 0){
          $scope.isModMsgHidden = true;
        }
      }
    }

    // if(myStr === 'undefined' || myStr === 'NaN' || myDex === 'undefined' || myDex === 'NaN' || myCon === 'undefined' || myCon === 'NaN' || myInt === 'undefined' || myInt === 'NaN' || myWis === 'undefined' || myWis === 'NaN' || myCha === 'undefined' || myCha === 'NaN'){
    //   $scope.isModMsgHidden = false;
    // } else {
    //   $scope.isModMsgHidden = true;
    // }

    $scope.charSummary = [{
      name : $scope.detailsArray[0],
      level : $scope.levelMsg,
      race : $scope.raceMsg,
      class : $scope.classMsg,
      strMod : $scope.modArray[0],
      dexMod : $scope.modArray[1],
      conMod : $scope.modArray[2],
      intMod : $scope.modArray[3],
      wisMod : $scope.modArray[4],
      chaMod : $scope.modArray[5]
    }];
  });
