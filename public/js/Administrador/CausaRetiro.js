angular.module('hipica').
controller('causaretiro', ['$scope','$http','$mdToast', function($scope, $http,$mdToast){
	$scope.causaretiro={};
	$scope.causaretiro2={};
	$scope.submitted=false;
	$scope.paginador={valor:true};
	$scope.busqueda={estatus:true,query:''};
	$scope.contardor=0;


	$scope.resetForm = function(){
		$scope.causaretiro=angular.copy({});
		$scope.causaretiro2=angular.copy({});
		$scope.submitted=false;
	}

	$scope.recargar=function(){
		$scope.paginador.valor=!$scope.paginador.valor;
	}


	$scope.getCausaRetiro= function(id){		
		$http.get('Admin/causaRetiro/ver/'+id).
		success(function(data, status, headers, config) {				
			data.estatus=data.estatus=='1';
			console.log(data);
			$scope.causaretiro2=data;										

		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Error '+status,$mdToast);
		});
	}





	$scope.getResource = function (params, paramsObj) {	
				console.log('Antes de la Carga Inicial');

		$scope.geCausaRetiroa= function(id){		
		$http.get('Admin/tipcausaRetiro//'+id).
		success(function(data, status, headers, config) {				
			data.estatus=data.estatus=='1';
			console.log(data);
			$scope.tipopista2=data;										

		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Error '+status,$mdToast);
		});
	}
	if(!paramsObj){
			console.log('Cambio  de Asignacion');
			paramsObj=$scope.paginador;
			console.log(paramsObj);
		}

		
		$scope.paginador=paramsObj;
		console.log('Antes de la Carga Inicial');
		console.log($scope.paginador);

		var urlApi = 'Admin/causaRetiro/tabla_principal_causa_retiro/'+paramsObj.count+'/'+paramsObj.page+'/';
		if(paramsObj.sortBy){
			urlApi+=paramsObj.sortBy+'/'+paramsObj.sortOrder;    
		}

		return $http.post(urlApi,$scope.busqueda).then(function (response) {
			console.log('averga');
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











	$scope.crear_causa_retiro= function(causa){
		var url='';

		if(causa){
			url='Admin/causaRetiro/crear_causa_retiro';
			obj=$scope.causaretiro;
		}else{
			url='Admin/causaRetiro/modificar_causa_retiro';
			obj=$scope.causaretiro2;
		}

		console.log(obj);
		if ((causa&&$scope.formcausaRetiro_crear.$valid)||(!causa&&$scope.formcausaRetiro_modificar.$valid)) {

			
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





}]);
