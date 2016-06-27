module.exports = ['$interpolateProvider', '$httpProvider', function($interpolateProvider, $httpProvider) {

    /**
     * Config to work with Symfony 2
     */
    $interpolateProvider.startSymbol('{[').endSymbol(']}');
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';

}];
