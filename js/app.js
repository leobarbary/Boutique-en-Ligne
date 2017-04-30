document.addEventListener('deviceready', function(){
    navigator.splashscreen.hide();
}, false);

var app = angular.module('app', []);

app.factory('GeolocationService', function($window, $q, $rootScope){
    var geolocation = $window.navigator.geolocation;
    return {
        getCurrentPosition : function(onSuccess, onError){
            geolocation.getCurrentPosition(function(position){
                $rootScope.$apply(function(){
                    onSuccess(position);
                })
            }, function(){
                $rootScope.$apply(function(){
                    onError();
                })
            })
        }
    }
})

app.config(function($routeProvider){
    $routeProvider
        .when('/Map', {templateUrl: 'Map.html'})
        .when('/Option', {templateUrl: 'Option.html'})
        .otherwise({redirectTo: '/home'})
})