angular.module('hipica').
controller('ejemplar', ['$scope','$http','$mdToast', function($scope, $http,$mdToast){
	$scope.obj={};
	$scope.obj2={};	
	$scope.tpaises=[];	
	$scope.tpelajes=[];	
	$scope.torigenes=[];	
	$scope.tpadres=[];	
	$scope.tmadres=[];	
	$scope.tstuds=[];	
	$scope.tharas=[];
	$scope.testatus=[];
	$scope.tsexos=[{id:'0',val:'Y'},{id:'1',val:'C'}];		

	$scope.paginador={valor:true};

	$scope.busqueda={estatus:true,query:''};
	$scope.contardor=0;
	$scope.submitted=false;



	$scope.resetForm = function(){
		$scope.obj=angular.copy({});
		$scope.obj2=angular.copy({});
		$scope.submitted=false;
	}


	$scope.cargarHaras=function(){
		return $http.get('Admin/haras/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.tharas=data;
			 $scope.tcondicion;
			 console.log($scope.tcondicion);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar las Haras');
		});
	}

	$scope.cargarStuds=function(){
		return $http.get('Admin/stud/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.tstuds	=data;
			 
			 console.log($scope.tcondicion);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar los Studs');
		});
	}



	$scope.cargarOrigenes=function(){
		return $http.get('Admin/tipoOrigen/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.torigenes=data;
			 $scope.tcondicion;
			 console.log($scope.tcondicion);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar los Tipos de Origenes');
		});
	}



	$scope.cargarPelajes=function(){
		return $http.get('Admin/tipoPelaje/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.tpelajes=data;
			console.log($scope.tpelajes);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar los Tipos de Pelajes');
		});
	}
        
        $scope.cargarEstatus=function(){
		return $http.get('Admin/Ejemplar/ver_estatus').
		success(function(data, status, headers, config) {				
			$scope.testatus=data;
			console.log('Estatus');
			console.log($scope.testatus);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar los Estatus');
		});
	}

		$scope.cargarPadres=function(){
		return $http.get('Admin/ejemplar/ver_sel/0/1').
		success(function(data, status, headers, config) {				
			$scope.tpadres=data;
			console.log($scope.tpelajes);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar los Tipos de Pelajes');
		});
	}

	$scope.cargarMadres=function(){
		return $http.get('Admin/ejemplar/ver_sel/0/0').
		success(function(data, status, headers, config) {				
			$scope.tmadres=data;
			console.log($scope.tpelajes);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar los Tipos de Pelajes');
		});
	}
	$scope.cargarPaises=function(){


		return $http.get('Admin/pais/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.tpaises=data;
			 
			 console.log($scope.tcondicion);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar los Tipos de Jugadas');
		});
	}



	$scope.recargar=function(){
		$scope.paginador.valor=!$scope.paginador.valor;
	}


	$scope.crear_nuevo= function(tipo){
		var url='';
		$scope.obj.fecha_nacimiento=moment($scope.obj.fecha_nacimiento).format('YYYY-MM-DD')

		if(tipo){
			url='Admin/ejemplar/crear_ejemplar';
			obj=$scope.obj;
			console.log(obj);
		}else{
			url='Admin/ejemplar/modificar_ejemplar';
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



	$scope.get= function(id){	
		$scope.cargarHaras();
		$scope.cargarMadres();
		$scope.cargarPadres();
		$scope.cargarPelajes();
		$scope.cargarOrigenes();
		$scope.cargarStuds();
		$scope.cargarPaises();
		$scope.cargarEstatus();
		$http.get('Admin/ejemplar/ver/'+id).
		success(function(data, status, headers, config) {	

			console.log('exito');
			console.log(data);
			data.estatus=parseInt(data.estatus);	
			data.castrado=data.castrado&&data.castrado=='1';		
			data.precio=parseInt(data.precio);		
			
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

		var urlApi = 'Admin/ejemplar/tabla_principal_ejemplar/'+paramsObj.count+'/'+paramsObj.page+'/';
		if(paramsObj.sortBy){
			urlApi+=paramsObj.sortBy+'/'+paramsObj.sortOrder;    
		}

		return $http.post(urlApi,$scope.busqueda).then(function (response) {
			console.log('exito');
			console.log(response.data);
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