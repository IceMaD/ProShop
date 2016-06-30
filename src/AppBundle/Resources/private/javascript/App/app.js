(function() {
    angular.module('proshop.app', [
            'ui.router',
            'ui.router.stateHelper',
            'ngMaterial'
        ])
        .config(require('../Config/config'))
        .config(require('../Config/theme'))
        .config(require('./Config/routing'))

        .service('Router', require('../Service/Router'))

        .controller('LayoutController', require('./Controller/LayoutController'))
})();
