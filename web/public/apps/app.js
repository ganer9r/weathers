'use strict';


// Declare app level module which depends on filters, and services
var app = angular.module('myApp', [
    'ui.router', 
    'content',
]);


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
