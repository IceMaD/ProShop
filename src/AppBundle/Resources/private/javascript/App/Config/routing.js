module.exports = ['stateHelperProvider', '$urlRouterProvider', 'RouterProvider', function(stateHelperProvider, $urlRouterProvider, RouterProvider) {

    /**
     * As we are in config context, we need to fetch factory from their providers. Angular stuff y'know
     */
    var Router = RouterProvider.$get();

    stateHelperProvider
        .state({
            name: 'Home',
            url: '/',
            templateUrl: Router.state('Hello')
        })
        .state({
            name: 'Another',
            url: '/',
            templateUrl: Router.state('Another')
        });

    /**
     * Handle Angular "404"
     */
    $urlRouterProvider.otherwise(function($injector) {
        $injector.get("$state").go('Home');
    });
}];
