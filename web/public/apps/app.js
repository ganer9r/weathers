'use strict';


// Declare app level module which depends on filters, and services
var app = angular.module('myApp', [
    'ui.router', 
    'content',
], function($httpProvider){
    $httpProvider.interceptors.push(function($q, $location) {
        return {
            'request': function(config) {
                // same as above
                var html = /^\/api\//;
                if(html.test(config.url)){
                    config.url  = '.'+config.url;
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
