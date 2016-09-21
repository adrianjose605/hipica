angular.module('hipica').
controller('clasico', ['$scope','$http','$mdToast', function($scope, $http,$mdToast){

$scope.obj={grado:'1'};
$scope.obj2={};
$scope.paginador={valor:true};
$scope.busqueda={estatus:true,query:''};
$scope.contardor=0;
$scope.submitted=false;


	$scope.cargarPaises=function(){
	return $http.get('Admin/pais/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.paises=data;			 
			 console.log($scope.paises);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar Paises');
		});
		$scope.hipodromos={};
	};

	$scope.resetForm = function(){
		$scope.obj=angular.copy({grado:'1'});
		$scope.obj2=angular.copy({});
		$scope.submitted=false;
	}



	$scope.get= function(id){		
		$scope.cargarPaises();
		$http.get('Admin/clasico/ver/'+id).
		success(function(data, status, headers, config) {				
			data.estatus=data.estatus=='1';
			console.log(data);
			$scope.cargarHipodromos(data.pais);
			$scope.obj2=data;

										

		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Error '+status,$mdToast);
		});
	}


	$scope.cargarHipodromos=function(pais){
	if(!pais)
		return;
	return $http.get('Admin/hipodromo/ver_sel_pais/'+pais).
		success(function(data, status, headers, config) {				
			$scope.hipodromos=data;			 
			 console.log($scope.hipodromos);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar Paises');
		});
	};


	$scope.creacion= function(tipo){
		var url='';
		console.log('verga');
		if(tipo){
			url='Admin/clasico/crear_clasico';
			obj=$scope.obj;
			console.log(obj);
		}else{
			url='Admin/clasico/modificar_clasico';
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

	$scope.recargar=function(){
		$scope.paginador.valor=!$scope.paginador.valor;
	};

	$scope.getResource = function (params, paramsObj) {	
		if(!paramsObj){
			console.log('Cambio  de Asignacion');
			paramsObj=$scope.paginador;
			console.log(paramsObj);
		}

		
		$scope.paginador=paramsObj;
		console.log('Antes de la Carga Inicial');
		console.log($scope.paginador);

		var urlApi = 'Admin/clasico/tabla_principal_clasico/'+paramsObj.count+'/'+paramsObj.page+'/';
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