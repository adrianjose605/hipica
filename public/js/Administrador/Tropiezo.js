angular.module('hipica').
controller('tropiezo', ['$scope','$http','$mdToast', function($scope,$http,$mdToast){
	$scope.tropiezo={};
	$scope.tropiezo2={};
	$scope.busqueda={estatus:true,query:''};
	$scope.paginador={valor:true};
	
	$scope.contador=0;
	$scope.submitted = false;


	$scope.resetForm = function(){
		$scope.tropiezo=angular.copy({});
		$scope.tropiezo2=angular.copy({});
		$scope.submitted=false;
	}


	$scope.getTropiezo= function(id){
		console.log('Admin/tropiezo/ver/'+id);
		$http.get('Admin/tropiezo/ver/'+id).
			success(function(data, status, headers, config) {				
					data.estatus=data.estatus=='1';
					console.log(data);
					$scope.tropiezo2=data;					
					console.log($scope.tropiezo2);
					var $j = jQuery.noConflict();
	                $j("#modificar_tropiezo").modal("show");				
			}).
			error(function(data, status, headers, config) {
				console.log(status);
				hacerToast('error','Error '+status,$mdToast);
			});
	}
		$scope.recargar=function(){
			$scope.paginador.valor=!$scope.paginador.valor;
		}


	$scope.getResource = function (params, paramsObj) {	
		if(!paramsObj){
			console.log('Cambio  de Asignacion');
			paramsObj=$scope.paginador;
			console.log(paramsObj);
		}

	
		$scope.paginador=paramsObj;
		console.log('Antes de la Carga Inicial');
		console.log($scope.paginador);

		var urlApi = 'Admin/tropiezo/tabla_principal_tropiezo/'+paramsObj.count+'/'+paramsObj.page+'/';
		if(paramsObj.sortBy){
			urlApi+=paramsObj.sortBy+'/'+paramsObj.sortOrder;    
		}

		return $http.post(urlApi,$scope.busqueda).then(function (response) {
			console.log(response);
			$scope.contador=response.data.pagination.size;
			return {
				'rows': response.data.rows,
				'header': response.data.header,
				'pagination': response.data.pagination,
				'sortBy': response.data['sort-by'],
				'sortOrder': response.data['sort-order']
			}
		});
	};



	$scope.registrar_tropiezo=function(tipo){	
		var url='',obj={};

		if(tipo){
			url='Admin/tropiezo/nuevo_tropiezo';
			obj=$scope.tropiezo;
                        console.log($scope.tropiezo);
		}else{
			url='Admin/tropiezo/modificar_tropiezo';
			obj=$scope.tropiezo2;
			console.log($scope.tropiezo2);

		}
		$scope.submitted = true;
		if ((tipo&&$scope.formTropiezo.$valid)||(!tipo&&$scope.formTropiezoM.$valid)) {
                    
			$http.post(url, obj).
			success(function(data, status, headers, config) {
				if(data.status){
					hacerToast('success',data.mensaje,$mdToast);
					$scope.recargar();
				}
				else
					hacerToast('error',data.mensaje,$mdToast);   
			}).
			error(function(data, status, headers, config) {
				console.log(status);
				hacerToast('error','Error '+status,$mdToast);
			});
		}else{
                        hacerToast('error',data.mensaje,$mdToast); 
		}

	};

}]);
