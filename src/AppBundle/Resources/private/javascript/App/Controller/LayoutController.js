module.exports = ['$scope', '$mdSidenav', function($scope, $mdSidenav) {

    var sidenav;

    function getSideNav() {
        sidenav = sidenav || $mdSidenav('left');

        return sidenav;
    }

    $scope.toggle = function() {
        getSideNav().toggle();
    };

    $scope.$on('$stateChangeStart', function() {
        getSideNav().close();
    })
}];
