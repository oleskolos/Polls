// var news = angular.module('addPoll', []);
// news.controller('addPoll', function($scope, $http, $window) {
//     $scope.options = []; // Масив для зберігання опцій

//     $scope.addOptions = function () {
//       // Отримати кількість опцій введених користувачем
//       var numOptions = $scope.numOptions;

//       // Ініціалізувати масив опцій порожніми об'єктами
//       $scope.options = Array.from({ length: numOptions }, function () {
//         return { name: '', votes: 0 };
//       });
//     };

//     $scope.addPoll = function() {
//         $http({
//             method: "POST",
//             url: "poll/cabinet/createPoll/addPoll",
//             data: $.param({pollName: $scope.newPollName, pollOptions: $scope.newPollOptions, pollStatus: $scope.newpollStatus, pollOptionNames: $scope.newOptionNames, polloptionVotes: $scope.newOptionVotes}),
//             headers: {'Content-Type': 'application/json'}
//         }).then(function(result){
//             // location.reload(true);
//             console.log(result);
//             if(result.data.success) {
//                 $window.location.href = '/cabinet/';
//                 console.log(result);
//             }
//         });
//     }
// });


var addPoll = angular.module('addPoll', []);
addPoll.controller('addPoll', function($scope, $http, $window) {
    
    $scope.options = [];

    $scope.addOptions = function () {
        var numOptions = $scope.numOptions;
        $scope.options = Array.from({ length: numOptions }, function () {
            return { name: '', votes: 0 };
        });
        console.log("Options added:", $scope.options);

    };

    $scope.addPoll = function () {
        console.log("Data before sending:", {
            pollName: $scope.newPollName,
            pollOptions: $scope.options,  // Змінено на $scope.options
            pollStatus: $scope.newPollStatus
        });
        $scope.newPollStatus = $scope.newPollStatus ? 2 : 1;

        $http({
            method: "POST",
            url: "poll/cabinet/createPoll/addPoll",
            data: {
                pollName: $scope.newPollName,
                pollOptions: $scope.options,
                pollStatus: $scope.newPollStatus
            },
            headers: { 'Content-Type': 'application/json' }
        }).then(function (result) {
            console.log(result);
            if (result.data.success) {
                $window.location.href = '/cabinet/';
            }
        });
    }
    
});
