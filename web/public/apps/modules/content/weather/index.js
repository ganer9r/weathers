angular.module('content.weather', [
  'ui.router',
  'ngTable',
])
  
.config(
  [          '$stateProvider', '$urlRouterProvider',
    function ($stateProvider,   $urlRouterProvider) {
      $stateProvider
        .state('content.weather', {
            abstract:true,
            url: '/weather',
            templateUrl: "apps/views/content.html",
            controller: function($scope){
                $scope.$nav.title   = "날씨 관리";
            }
        })
            .state('content.weather.list', {
              url: '',
              templateUrl: 'apps/modules/content/weather/list.html',
              controller: WeatherListController,
            });

    }

  ]
);



var WeatherListController = function($state, $scope, $q, $http, $filter, ngTableParams, func) {
    $scope.$nav.sub_title   = "리스트";
    $scope.req  = {};
    $scope.newitem  = {};

    $scope.save = function(item){
        if(!item.month || !item.state){
            alert("입력정보가 없습니다.");
            return false;
        }
        
        var id = item.id || '';
        $http.post('../api/weather/'+id, item).success(function(){
            if(!id)
                item = {};
            $state.reload();
        });
        item.$edit = false;

    }

    $scope.delete = function(item){
        $http.delete('../api/weather/'+item.id);
        $state.reload();
    }

    $scope.load = function(){
        $http.get('../api/weather').success(function(data, status){
            $scope.data = data.weathers;

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

    $scope.selection   = function(data){
        var def = $q.defer();
        //def.resolve(func.date.monthes());
        def.resolve(data);
        return def;
    };

    $scope.load();
}

