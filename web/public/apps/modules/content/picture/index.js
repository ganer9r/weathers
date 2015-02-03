angular.module('content.picture', [
  'ui.router',
  'angularFileUpload',
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
              controller: PictureListController ,
            });

    }

  ]
);



var PictureListController = function($state, $scope, $http, $filter, $timeout, $upload) {
    $scope.$nav.sub_title   = "리스트";
    $scope.req  = {};
    $scope.newItem  = {'season':1, 'state':1};
    $scope.selectedFile = null;

    $scope.onFile = function($file){
        console.log($scope.selectedFile);
        var file = $file[0];
        $scope.selectedFile = file;

        var fileReader = new FileReader();
        fileReader.readAsDataURL(file);
        fileReader.onload = function(e) {
            $timeout(function () {
                file.dataUrl = e.target.result;
                console.log(file.dataUrl);
            });
        }

    }

    $scope.save = function(item){
        var id = item.id || 'new';
        if(!item.season){
            alert("입력정보가 없습니다.");
            return false;
        }

        $scope.upload = $upload.upload({
            url: '/api/picture/'+id,
            method: 'POST',
            file: $scope.selectedFile,
            data : item,
            fileFormDataName : 'img',
        }).success(function(data, status, headers, config) {
            //서버에서 전송시 보낸 email을 그대로 응답 데이터로 전달함.
            alert("업로드 완료");
        });

    }

    $scope.delete = function(item){
        $http.delete('/api/picture/'+item.id);
        $state.reload();
    }

    $scope.load = function(){
        $http.get('/api/picture').success(function(data, status){
            $scope.data = data.pictures;

        });
    }

    $scope.buttonName = function(item){
        if(item.id) return '수정하기';
        else        return '저장하기';
    }

    $scope.setForm  = function(item){
        item = item || {'season':1, 'state':1};
        $scope.newItem = item;
    }
    $scope.showPic = function(item){

        if($scope.selectedFile )
            return $scope.selectedFile.dataUrl;
        else
            return item.img;

    }

    $scope.load();
}

