(function() {
    angular.module('proshop.app', [
            'ui.router',
            'ui.router.stateHelper',
            'ngMaterial'
        ])
        .config(require('../Config/config'))

        .controller('LayoutController', require('./Controller/LayoutController'))
})();
