angular.module('hipica').
controller('tipojugada', ['$scope','$http','$mdToast', function($scope, $http,$mdToast){
	$scope.obj={};
	$scope.obj2={};
	$scope.paginador={valor:true};

	$scope.busqueda={estatus:true,query:''};
	$scope.contardor=0;
	$scope.submitted=false;



	$scope.resetForm = function(){
		$scope.obj=angular.copy({});
		$scope.obj2=angular.copy({});
		$scope.submitted=false;
	}



	$scope.recargar=function(){
		$scope.paginador.valor=!$scope.paginador.valor;
	}


	$scope.crear_nuevo= function(tipo){
		var url='';

		if(tipo){
			url='Admin/tipoJugada/crear_tipo_jugada';
			obj=$scope.obj;
		}else{
			url='Admin/tipoJugada/modificar_tipo_jugada';
			obj=$scope.obj2;
		}
		console.log(url);
		console.log(obj);
		if ((tipo&&$scope.crear.$valid)||(!tipo&&$scope.modificar.$valid)) {

			
			$http.post(url, obj).
			success(function(data, status, headers, config) {
				if(data.status){
					hacerToast('success',data.mensaje,$mdToast);
					$scope.submitted=false;
				}
				else
					hacerToast('error',data.mensaje,$mdToast);

			}).
			error(function(data, status, headers, config) {
				console.log(status);
				hacerToast('error','Error '+status,$mdToast);
			});
		}else{
			$scope.submitted=true;  

		}
		$scope.recargar();

	};



	$scope.get= function(id){		
		$http.get('Admin/tipoJugada/ver/'+id).
		success(function(data, status, headers, config) {				
			data.estatus=data.estatus=='1';
			console.log(data);
			$scope.obj2=data;										

		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Error '+status,$mdToast);
		});
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

		var urlApi = 'Admin/tipoJugada/tabla_principal_tipo_jugada/'+paramsObj.count+'/'+paramsObj.page+'/';
		if(paramsObj.sortBy){
			urlApi+=paramsObj.sortBy+'/'+paramsObj.sortOrder;    
		}

		return $http.post(urlApi,$scope.busqueda).then(function (response) {
			
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


}]);