'use strict';


// Declare app level module which depends on filters, and services
var app = angular.module('myApp', [
    'ui.router', 
    'content',
], function($httpProvider){
    $httpProvider.interceptors.push(function($q) {
        return {
            'request': function(config) {
                // same as above
                var html = /^\/api\//;
                if(html.test(config.url)){
                    config.url  = '..'+config.url;
                }

                return config || $q.when(config);
            },

            'response': function(response) {
                // same as above
                return response;
            },
            responseError: function (rejection) {
                return rejection;
            }
        };
    });
});



var angularApp = angular.module("webapp", [
        'ui.bootstrap',
        'ui.calendar',
        'ui.select'],
    function($httpProvider){
        $httpProvider.interceptors.push(function($q) {
            return {
                'request': function(config) {
                    // same as above
                    return config || $q.when(config);
                },

                'response': function(response) {
                    // same as above
                    return response;
                },
                responseError: function (rejection) {
                    modalAlert(rejection.statusText, "alert-danger");
                    return rejection;
                }
            };
        });

    });


app.run(function($rootScope, func){
    $rootScope.$fn = func;
});


app.config(function($httpProvider, $stateProvider, $urlRouterProvider){
        // For any unmatched url, send to /populations
      $urlRouterProvider.otherwise('/');
      
      $stateProvider
        .state('admin', {
          url: '/',
          templateUrl: 'apps/views/main.html'
        })

});



app.controller('AppCtrl', ['$scope', function($scope) {
}]);
