angular.module('content.message', [
  'ui.router',
  'ngTable',
])
  
.config(
  [          '$stateProvider', '$urlRouterProvider',
    function ($stateProvider,   $urlRouterProvider) {
      $stateProvider
        .state('content.message', {
            abstract:true,
            url: '/message',
            templateUrl: "apps/views/content.html",
            controller: function($scope){
                $scope.$nav.title   = "메시지 관리";
            }
        })
            .state('content.message.list', {
              url: '',
              templateUrl: 'apps/modules/content/message/list.html',
              controller: MessageListController,
            });

    }

  ]
);



var MessageListController = function($state, $scope, $http, $filter, ngTableParams) {
    $scope.$nav.sub_title   = "리스트";
    $scope.req  = {};
    $scope.newitem  = {};

    $scope.save = function(item){
        if(!item.season || !item.ment){
            alert("입력정보가 없습니다.");
            return false;
        }
        
        var id = item.id || '';
        $http.post('/api/message/'+id, item).success(function(){
            if(!id)
                item = {};
            $state.reload();
        });
        item.$edit = false;

    }

    $scope.delete = function(item){
        $http.delete('/api/message/'+item.id);
        $state.reload();
    }

    $scope.load = function(){
        $http.get('/api/message').success(function(data, status){
            $scope.data = data.messages;
            console.log($scope.data);

            $scope.tableParams = new ngTableParams({
                page: 1,            // show first page
                count: 10,          // count per page
            }, {
                total: $scope.data.length, // length of data
                getData: function($defer, params) {
                    var orderedData = params.filter() ?
                       $filter('filter')($scope.data, params.filter()) :
                       $scope.data;

                    $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count()));
                }
            });
        });
    }

    $scope.load();
}

