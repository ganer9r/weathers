angular.module('content.picture', [
  'ui.router',
  'ngTable',
])
  
.config(
  [          '$stateProvider', '$urlRouterProvider',
    function ($stateProvider,   $urlRouterProvider) {
      $stateProvider
        .state('content.picture', {
            abstract:true,
            url: '/picture',
            templateUrl: "apps/views/content.html",
            controller: function($scope){
                $scope.$nav.title   = "날씨 이미지 관리";
            }
        })
            .state('content.picture.list', {
              url: '',
              templateUrl: 'apps/modules/content/picture/list.html',
              controller: PictureListController,
            });

    }

  ]
);



var PictureListController = function($state, $scope, $http, $filter, ngTableParams) {
    $scope.$nav.sub_title   = "리스트";
    $scope.req  = {};
    $scope.newitem  = {};

    $scope.save = function(item){
        if(!item.month || !item.ment){
            alert("입력정보가 없습니다.");
            return false;
        }
        
        var id = item.id || '';
        $http.post('/api/picture/'+id, item).success(function(){
            if(!id)
                item = {};
            $state.reload();
        });
        item.$edit = false;

    }

    $scope.delete = function(item){
        $http.delete('/api/picture/'+item.id);
        $state.reload();
    }

    $scope.load = function(){
        $http.get('/api/picture').success(function(data, status){
            $scope.data = data.pictures;

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

