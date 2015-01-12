angular.module('content', [
    'ui.router',
    'content.weather',
    'content.picture',
    'content.message',
])
.config(
  [          '$stateProvider', '$urlRouterProvider',
    function ($stateProvider,   $urlRouterProvider) {
      $stateProvider
        .state('content', {
          abstract:true,
          url: '/content',
          templateUrl: "apps/views/menu.html",
          controller: function($rootScope){
            $rootScope.$nav = {
                menu: 'Content',
                sidemenus: [
                    {'id': 'content.weather.list', 'name': '날씨 설정', 'icon': 'fa-users'},
                    {'id': 'content.message.list', 'name': '메시지 설정', 'icon': 'fa-users'},
                    {'id': 'content.picture.list', 'name': '이미지 설정', 'icon': 'fa-home'}
                ]
            };
          }
        });


    }
  ]

);
