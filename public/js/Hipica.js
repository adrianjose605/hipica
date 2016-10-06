angular.module('hipica', ['ngMaterial', 'ngMessages', 'ngTasty', 'ui.bootstrap','datePicker']).
        controller('ToastCtrl', function($scope, $mdToast) {
            $scope.closeToast = function() {
                $mdToast.hide();
            };
        })
        .controller('AppCtrl', ['$scope', '$mdSidenav', function($scope, $mdSidenav) {
                $scope.oneAtATime = true;
                $scope.toggleSidenav = function(menuId) {
                    $mdSidenav(menuId).toggle();
                };
                $scope.navigateTo = function(url) {
                    window.location=(base_url+url);
                };
            }]).config(function($mdThemingProvider) {
  $mdThemingProvider.theme('default')
    .primaryPalette('blue', {
      'default': '800', // by default use shade 400 from the pink palette for primary intentions
      'hue-1': '100', // use shade 100 for the <code>md-hue-1</code> class
      'hue-2': '800', // use shade 600 for the <code>md-hue-2</code> class
      'hue-3': 'A700' // use shade A100 for the <code>md-hue-3</code> class
    })
    .accentPalette('red',{
        'default': '900',
        'hue-1': 'A700',
        'hue-2': '900',
        'hue-3': 'A700',
    });
});
function hacerToast(type, msg, toast) {

    toast.show({
        controller: 'ToastCtrl',
        template: '<md-toast class="md-toast ' + type + '"> <span flex>' + msg + '</span> <md-button ng-click="closeToast();">OK</md-button></md-toast>',
        hideDelay: 6000,
        position: 'top right'
    });
}
;
