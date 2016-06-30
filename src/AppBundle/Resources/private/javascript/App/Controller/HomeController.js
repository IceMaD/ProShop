module.exports = ['$scope', '$http', '$mdDialog', 'Router', function($scope, $http, $mdDialog, Router) {
    var postUrl = Routing.generate('app_api_url');

    $scope.submit = function() {
        $http.post(postUrl, {url: $scope.url}).then(function(response) {

            $mdDialog.show({
                controller: ['$scope', function($scope) {
                    $scope.product = response.data;

                    $scope.cancel = function() {
                        $mdDialog.cancel();
                    };
                }],
                templateUrl: Router.directive('Product'),
                clickOutsideToClose: true
            });

        }, function(response) {

            $mdDialog.show({
                controller: ['$scope', function($scope) {
                    $scope.message = response.data;

                    $scope.cancel = function() {
                        $mdDialog.cancel();
                    };
                }],
                templateUrl: Router.directive('NoHost'),
                clickOutsideToClose: true
            });
        });
    }
}];
