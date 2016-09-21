angular.module('hipica')
        .controller('jinetes', ['$scope', '$http', '$mdToast', function ($scope, $http, $mdToast) {
                $scope.busqueda = {estatus: true, query: ''};
                $scope.paginador = {valor: true};

                $scope.contador = 0;
                $scope.submitted = false;

                $scope.recargar = function () {
                    $scope.paginador.valor = !$scope.paginador.valor;
                }

                $scope.getResource = function (params, paramsObj) {
                    if (!paramsObj) {
                        console.log('Cambio  de Asignacion');
                        paramsObj = $scope.paginador;
                        console.log(paramsObj);
                    }

                   $scope.paginador = paramsObj;
                    console.log('Antes de la Carga Inicial');
                    console.log($scope.paginador);

                    var urlApi = 'Person/jinetes/tabla_principal/' + paramsObj.count + '/' + paramsObj.page + '/';
                    if (paramsObj.sortBy) {
                        urlApi += paramsObj.sortBy + '/' + paramsObj.sortOrder;
                    }

                    return $http.post(urlApi, $scope.busqueda).then(function (response) {
                        console.log(response);
                        $scope.contador = response.data.pagination.size;
                        return {
                            'rows': response.data.rows,
                            'header': response.data.header,
                            'pagination': response.data.pagination,
                            'sortBy': response.data['sort-by'],
                            'sortOrder': response.data['sort-order']
                        }
                    });
                };

            }])
        .controller('info_jinete',['$scope', '$http', '$mdToast', function ($scope, $http, $mdToast){
              $scope.user = {};  
        }]);
