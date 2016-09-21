angular.module('hipica').
controller('tipopista', ['$scope','$http','$mdToast', function($scope, $http,$mdToast){
	$scope.tipopista={};
	$scope.tipopista2={};
	$scope.paginador={valor:true};

	$scope.busqueda={estatus:true,query:''};
	$scope.contardor=0;
	$scope.submitted=false;



	$scope.resetForm = function(){
		$scope.tipopista=angular.copy({});
		$scope.tipopista2=angular.copy({});
		$scope.submitted=false;
	}



	$scope.recargar=function(){
		$scope.paginador.valor=!$scope.paginador.valor;
	}



	$scope.getTipoPista= function(id){		
		$http.get('Admin/tipoPista/ver/'+id).
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



	$scope.getResource = function (params, paramsObj) {	
		if(!paramsObj){
			console.log('Cambio  de Asignacion');
			paramsObj=$scope.paginador;
			console.log(paramsObj);
		}

		
		$scope.paginador=paramsObj;
		console.log('Antes de la Carga Inicial');
		console.log($scope.paginador);

		var urlApi = 'Admin/TipoPista/tabla_principal_tipopista/'+paramsObj.count+'/'+paramsObj.page+'/';
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













	$scope.crear_pista= function(tipo){
		var url='';
                
		if(tipo){
			url='Admin/tipoPista/crear_tipo_pista';
			obj=$scope.tipopista;
		}else{
			url='Admin/tipoPista/modificar_tipo_pista';
			obj=$scope.tipopista2;
		}

		console.log(obj);
		if ((tipo&&$scope.formTipoPista_crear.$valid)||(!tipo&&$scope.formTipoPista_modificar.$valid)) {

			
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