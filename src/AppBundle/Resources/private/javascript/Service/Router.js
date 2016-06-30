module.exports = [function() {

    return {
        state: function(name) {
            return Routing.generate('app_static_view', {name: 'State/' + name})
        },
        directive: function(name) {
            return Routing.generate('app_static_view', {name: 'Directive/' + name})
        }
    }

}];
