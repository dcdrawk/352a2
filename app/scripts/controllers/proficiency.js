'use strict';

angular.module('myappApp')
  .controller('ProfCtrl', function ($scope, $cookies, $mdDialog, $log) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
    var myClass = $cookies.class;
    var myLevel = $cookies.level;


    $scope.isHidden = false;
    $scope.isMessage = true;
    $scope.isWarning = true;

    $scope.levelMsg = '';

    $scope.isDisabled = false;
    $scope.bonusDisabled = false;
    $scope.equipmentDisabled = false;

    //test to see if the level is set
    if(myLevel >= 1){
      $log.debug(myLevel);
      $scope.levelMsg = 'Level ' + myLevel;
      $scope.detectClass = [{//sets the text for the warning
        msg1 : 'Displaying proficiency bonus for ',//tell the user
        bold : $scope.levelMsg+'.',//More detailed warning if class check also fails
      }];
    }else{
      $log.debug('level not set');
      $scope.warningMessage = [{//sets the text for the warning
        msg1 : 'Level not set. Set level in ',//tell the user
        bold : 'Character Details',
        msg2 : ' to show Proficiency Bonus.'
      }];
      $scope.levelMsg = '';
      $scope.bonusDisabled = true;
      if(myClass !== 'Cleric' && myClass !== 'Fighter' && myClass !== 'Rogue' && myClass !== 'Wizard'){//Checks if a class is selected yet
        $scope.warningMessage = [{//sets the text for the warning
          msg1 : 'Level/Class not set. Set level/class in ',//tell the user
          bold : 'Character Details',//More detailed warning if class check also fails
          msg2 : ' to show Proficiency info.'
        }];
      }

    }
    if(myLevel >= 1 && myLevel <= 4){$scope.profBonus = 2;}
    if(myLevel >= 5 && myLevel <= 8){$scope.profBonus = 3;}
    if(myLevel >= 9 && myLevel <= 12){$scope.profBonus = 4;}
    if(myLevel >= 12 && myLevel <= 16){$scope.profBonus = 5;}
    if(myLevel >= 17){$scope.profBonus = 6;}
    $cookies.profBonus = $scope.profBonus;

      // $scope.detectClass = [{//sets the text for the warning
      //   msg1 : 'Class not set. Set class in ',//tell the user
      //   bold : 'Character Details',
      //   msg2 : ' to show Proficiency Info.'
      // }];
      // $scope.isMessage = false;
      // $scope.isWarning = true; //Sets the warning class on the message span
    if(myClass !== 'Cleric' && myClass !== 'Fighter' && myClass !== 'Rogue' && myClass !== 'Wizard'){//Checks if a class is selected yet
      $log.debug(myClass);
      $scope.warningMessage = [{//sets the text for the warning
        msg1 : 'Class not set. Set class in ',//tell the user
        bold : 'Character Details',//More detailed warning if class check also fails
        msg2 : ' to show Proficiency info.'
      }];
      $scope.equipmentDisabled = true;
    } else {
      $scope.detectClass = [{//sets the text for the warning
        msg1 : 'Displaying proficiency for ',//tell the user
        bold : $scope.levelMsg + ' ' + myClass + '.',//More detailed warning if class check also fails
      }];
    }
    if(myClass === 'Cleric'){
      $scope.armorProf = 'Light and medium armor, shields';
      $scope.weapProf = 'All simple weapons';
      $scope.toolProf = 'None';
      $scope.savingThrows = 'Wisdom, Charisma';
      $scope.skillsProf = 'Choose two from History, Insight, Medicine, Persuasion, and Religion';
    }

    if(myClass === 'Fighter'){
      $scope.armorProf = 'All armor, shields';
      $scope.weapProf = 'Simple weapons, martial weapons';
      $scope.toolProf = 'None.';
      $scope.savingThrows = 'Strength, Constitution';
      $scope.skillsProf = 'Choose two from Acrobatics, Animal Handling, Athletics, History, Insight, Intimidation, Perception, and Survival';
    }

    if(myClass === 'Rogue'){
      $scope.armorProf = 'Light Armor';
      $scope.weapProf = 'Simple weapons, hand crossbows, longswords, rapiers, shortswords';
      $scope.toolProf = 'Thieves tools';
      $scope.savingThrows = 'Dexterity, Intelligence';
      $scope.skillsProf = 'Choose four from Acrobatics, Athletics, Deception, Insight, Intimidation, Investigation, Perception, Performance, Persuasion, Sleight of Hand, and Stealth';
    }

    if(myClass === 'Wizard'){
      $scope.armorProf = 'None';
      $scope.weapProf = 'Daggers, darts, slings, quarterstaffs, light crossbows.';
      $scope.toolProf = 'None';
      $scope.savingThrows = 'Intelligence, Wisdom';
      $scope.skillsProf = 'Choose two from Arcana, History, Insight, Investigation, Medicine, and Religion';
    }

    //Code from https://material.angularjs.org/#/demo/material.components.dialog
    //Use to help build alter dialogues, we would like to use them to explain this to the user.
    $scope.alert = '';
    $scope.showAlert = function(ev) {
      $mdDialog.show(
        $mdDialog.alert()
          .title('Proficiency Info')
          .content('Your proficiency bonus is calculated based on your level. Your class determines the type of weapons, armor, tools, etc. that your character is able to use.')
          .ariaLabel('Ability Score Info')
          .ok('Close')
          .targetEvent(ev)
      );
    };

    function DialogController($scope, $mdDialog) {
      $scope.hide = function() {
        $mdDialog.hide();
      };
      $scope.cancel = function() {
        $mdDialog.cancel();
      };
      $scope.answer = function(answer) {
        $mdDialog.hide(answer);
      };
    }
    });
