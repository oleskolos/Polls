var app = angular.module("cabinet", ["ngRoute", "ui.bootstrap"]);

app.config(function($routeProvider, $locationProvider) {

    $routeProvider
    .when("/:id", {
        templateUrl: "/views/userPolls.tpl.php"
    });

    $locationProvider.html5Mode(true);
});

app.controller('cabinetController', function($scope, $http, $uibModal){


    $scope.capitalize = function(input) {
        // Check if input is defined and not null
        if (input && input.length > 0) {
            return input.charAt(0).toUpperCase() + input.slice(1);
        } else {
            // Handle the case where input is undefined or an empty string
            return input;
        }
    };
    

    $scope.getInfoByPollId = function(id) {
        $http({
            method: "GET",
            url: "poll/cabinet/getPoll",
            params: { id: id }
        }).then(function(result) {
            console.log(result);
    
            if (result.data && result.data[id]) {
                var pollData = result.data[id];

                $scope.optionNames = pollData.option_names;    
                $scope.pollName = pollData.poll_name;
                $scope.pollID = pollData.poll_id;
                $scope.pollStatus = pollData.status_name;
            } else {
                console.error("Incorrect object structure");
            }
        });
    };
    
	$scope.open = function(id) {
		
		$http({
			method: "POST",
			url: "poll/cabinet/getPollbyID",
			data: $.param({id: id}),
			headers: {"Content-Type": 'application/x-www-form-urlencoded'}
		}).then(function(result){
			console.log(result);
			console.log(id);
			if(result.data.success != false) {
				$scope.pollData = result.data;

                console.log($scope.pollData); // Додайте цей вивід

				var modalWindow = $uibModal.open({
					animation: true,
                    backdrop: 'static', // Це блокує закриття модального вікна при кліці на фон
                    keyboard: false, 
					controller: "modalWindowController",
					templateUrl: '/views/modal.tpl.php',
					resolve: {
						pollData: function(){
							return $scope.pollData;
						},
                        pollID: function () {
                            return id; // Передаємо pollID як параметр
                        }
					}
				});

                modalWindow.result.then(function () {
                    // Обробка закриття модального вікна
                }).catch(function (error) {
                    if (error !== 'cancel') {
                        console.error("Error in modalWindow:", error);
                    }
                });
			}
		}).catch(function(error) {
            console.error("Error in $http request:", error);
        });
	}
// console.log(id);
    $scope.deletePoll = function(id) {
        var confirmation = confirm("Are you sure, you want to delete the poll?");

        if (confirmation) {
            $http({
                method: "POST",
                url: "poll/cabinet/deletePoll",
                data: $.param({id: id}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function(result){
                location.reload(true);
            });
        }
    }
  
    
});


app.controller('modalWindowController', function($scope, $http, $window, $uibModalInstance, pollData, pollID) {
    $scope.capitalize = function(input) {
        // Check if input is defined and not null
        if (input && input.length > 0) {
            return input.charAt(0).toUpperCase() + input.slice(1);
        } else {
            // Handle the case where input is undefined or an empty string
            return input;
        }
    };

    if (pollData && pollData[pollID]) {
        var pollDataItem  = pollData[pollID];

        $scope.optionNames = pollDataItem.option_names;    
        $scope.pollName = pollDataItem.poll_name;
        $scope.pollID = pollDataItem.poll_id;
        $scope.pollStatus = pollDataItem.status_name;
    } else {
        console.error("Incorrect object structure");
    }
	$scope.save = function() {
	}
	$scope.close = function() {
		$uibModalInstance.dismiss('cancel');
	}
	$scope.save = function() {
		$http({
			method: "POST",
			url: "poll/cabinet/updatePollAction",
			data: $.param({id: pollID, name: $scope.pollName, status: $scope.pollStatus, optionNames: $scope.optionNames}),
			headers: {"Content-Type": 'application/x-www-form-urlencoded'}
		}).then(function(result){
            console.log(result);

			// alert(result.data.text);
			$uibModalInstance.close();
            location.reload(true);
			// $window.location.href = 'cabinet/';
		}).catch(function(error) {
            console.error("Помилка в $http запиті:", error);
        });
	}    
    
});