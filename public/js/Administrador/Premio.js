angular.module('hipica').
controller('premio', ['$scope','$http','$mdToast', function($scope, $http,$mdToast){
	$scope.obj={};
	$scope.obj2={};
	$scope.tcondicion=[];	
	$scope.paginador={valor:true};
	$scope.spaises=[];
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
			url='Admin/premio/crear_premio';
			obj=$scope.obj;
		}else{
			url='Admin/premio/modificar_premio';
			obj=$scope.obj2;
		}

		console.log(obj);
		if ((tipo&&$scope.crear.$valid)||(!tipo&&$scope.modificar.$valid)) {
			console.log('pase la prueba');
			
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


	$scope.cargarHipodromos=function(){
		return $http.get('Admin/hipodromo/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.shipodromos=data;			 			
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar Paises');
		});
	}



	$scope.get= function(id){	
		$scope.cargarHipodromos();
		$http.get('Admin/premio/ver/'+id).
		success(function(data, status, headers, config) {				
			data.estatus=data.estatus=='1';			
			data.porcentaje_1=parseInt(data.porcentaje_1);
			data.porcentaje_2=parseInt(data.porcentaje_2);
			data.porcentaje_3=parseInt(data.porcentaje_3);
			data.porcentaje_4=parseInt(data.porcentaje_4);
			data.porcentaje_5=parseInt(data.porcentaje_5);

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

		var urlApi = 'Admin/premio/tabla_principal_premio/'+paramsObj.count+'/'+paramsObj.page+'/';
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