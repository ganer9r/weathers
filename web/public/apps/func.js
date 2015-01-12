angular.module('myApp')
.factory('func', function(){
    var date = {
        'monthes' : [{'id':0, 'title':'전체'},
            {'id':1, 'title':'1월'},
            {'id':2, 'title':'2월'},
            {'id':3, 'title':'3월'},
            {'id':4, 'title':'4월'},
            {'id':5, 'title':'5월'},
            {'id':6, 'title':'6월'},
            {'id':7, 'title':'7월'},
            {'id':8, 'title':'8월'},
            {'id':9, 'title':'9월'},
            {'id':10, 'title':'10월'},
            {'id':11, 'title':'11월'},
            {'id':12, 'title':'12월'}
        ],

        'month' : function(i){
            if( i == 0)
                return '전체';
            else
                return i+'월';
        },
    };

    console.log(date.monthes);
    var weather = {
        'states' :[
            {'id':1, 'title':'맑음'},
            {'id':2, 'title':'비옴'},
            {'id':3, 'title':'비올것같음'},
            {'id':4, 'title':'바람붐'},
            {'id':5, 'title':'추움'},
            {'id':6, 'title':'더움'},
        ],
        'types':[
            {'id':0, 'title':'값 없음'},
            {'id':1, 'title':'비옴'},
            {'id':2, 'title':'비올것같음'},
            {'id':3, 'title':'바람'},
            {'id':4, 'title':'온도'},
        ],
    };

    var msg = function(v, datas){
        for(var i in datas){
            if(datas[i].id === v)
                return datas[i].title;
        }
    }

    var service = {
        'date' : date,
        'weather': weather,
        'msg': msg,
    }

    return service;
});
