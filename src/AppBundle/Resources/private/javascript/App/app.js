(function() {
    angular.module('proshop.app', [
            'ui.router',
            'ui.router.stateHelper',
            'ngMaterial'
        ])
        .config(require('../Config/config'))
        .config(require('./Config/routing'))

        .config(function($mdThemingProvider) {
            var proshopPalette = $mdThemingProvider.extendPalette('red', {
                '50': '#fff'
            });

            $mdThemingProvider.definePalette('proshopPalette', proshopPalette);

            $mdThemingProvider.theme('default')
                .primaryPalette('proshopPalette', {
                    'default': '600',
                    'hue-1': '50'
                })
                .accentPalette('red');
        })

        .service('Router', require('./Service/Router'))

        .controller('LayoutController', require('./Controller/LayoutController'))
})();
