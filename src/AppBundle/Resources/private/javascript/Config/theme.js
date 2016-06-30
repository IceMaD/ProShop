module.exports = ['$mdThemingProvider', function($mdThemingProvider) {
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
}];
