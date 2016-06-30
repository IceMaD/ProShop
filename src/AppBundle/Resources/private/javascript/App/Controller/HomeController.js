module.exports = ['$scope', '$http', '$mdDialog', 'Router', function($scope, $http, $mdDialog, Router) {
    $scope.url = 'http://www.ldlc-pro.com/fiche/PB00202978.html';

    var postUrl = Routing.generate('app_api_url');

    $scope.submit = function() {
        $http.post(postUrl, {url: $scope.url}).then(function(response) {

            $mdDialog.show({
                controller: ['$scope', function($scope) {
                    $scope.product = response.data
                }],
                templateUrl: Router.directive('Product'),
                clickOutsideToClose: true
            });

        });
    }
}];
