angular.module('hipica').
controller('jugada', ['$scope','$http','$mdToast', function($scope, $http,$mdToast){
	$scope.obj={};
	$scope.obj2={};
	$scope.obj3={};
	$scope.tcondicion=[];	
	$scope.thipodromos=[];	
	$scope.tjugadas=[];	
	$scope.paginador={valor:true};
        $scope.hipodromos=[];
	$scope.busqueda={estatus:true,query:''};
	$scope.contardor=0;
	$scope.submitted=false;



	$scope.resetForm = function(){
		$scope.obj=angular.copy({});
		$scope.obj2=angular.copy({});
		$scope.submitted=false;
	}

	$scope.generar_out= function(data){
		nuevo=angular.copy(data);
		if(nuevo.compuesta){
			delete nuevo.compuesta;
			return nuevo;
		}
		return nuevo;
	}


	$scope.cargarTipos=function(){
		return $http.get('Admin/tipoJugada/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.tcondicion=data;
			 $scope.tcondicion;
			 console.log($scope.tcondicion);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar los Tipos de Jugadas');
		});
	}
        
        $scope.hipodromosSearch=function(param){
		return $http.get('Admin/hipodromo/ver_chip/'+param)
		.then(function(result){
			return result.data;
		});
	}
        

	$scope.cargarJugadas=function(){
		return $http.get('Admin/jugada/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.tjugadas=data;
			 
			 console.log($scope.tcondicion);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar las Jugadas');
		});
	}



	$scope.recargar=function(){
		$scope.paginador.valor=!$scope.paginador.valor;
	}

            $scope.CHipodromos=function(){
		rt=[];
		for (index = 0; index < $scope.hipodromos.length; ++index) {			
    		rt.push({'id':$scope.hipodromos[index].id});
		}
		return rt;
	};

	$scope.crear_nuevo= function(tipo){
		var url='';

		if(tipo){
			url='Admin/jugada/crear_jugada';
			obj=$scope.generar_out($scope.obj);
            obj.hipodromos=$scope.CHipodromos();
			 
		}else{
			url='Admin/jugada/modificar_jugada';
			obj=$scope.generar_out($scope.obj2);
            obj.hipodromos=$scope.CHipodromos();


		}
		console.log('Enviando');
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


//         $scope.get= function(id){	
//		$scope.cargarTipos();
//		$scope.cargarHipos();
//		$http.get('Admin/pista/ver/'+id).
//		success(function(data, status, headers, config) {				
//			data.estatus=data.estatus=='1';			
//			console.log(data);
//			$scope.distancias=[];									
//			if(data.distancias){
//				console.log('distancias');
//				console.log(data.distancias);
//				$scope.distancias=data.distancias;									
//				//delete data.distancias;
//			}
//
//			$scope.obj2=data;	
//			
//
//			
//
//		}).
//		error(function(data, status, headers, config) {
//			console.log(status);
//			hacerToast('error','Error '+status,$mdToast);
//		});
//	}
	$scope.get= function(id){	
		$scope.cargarTipos();		
		$scope.cargarJugadas();
		$http.get('Admin/jugada/ver/'+id).
		success(function(data, status, headers, config) {
                        $scope.hipodromos=[];									
			if(data.hipodromos){
				console.log('hipodromos');
				console.log(data.hipodromos);
				$scope.hipodromos=data.hipodromos;									
				//delete data.distancias;
			}
			data.estatus=data.estatus=='1';
			console.log('bandera ');
			console.log(data);
			if(data.compuesta){
				data.base=data.compuesta;				
			}else{
				data.compuesta=false;
			}
			data.multijugada=data.multijugada=='1';							
			data.por_defecto=data.por_Defecto=='1';							
			data.cantcarr=parseInt(data.cantcarr);			
			$scope.obj2=data;										

		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Error '+status,$mdToast);
		});
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

		var urlApi = 'Admin/jugada/tabla_principal_jugada/'+paramsObj.count+'/'+paramsObj.page+'/';
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
			};
		});
	};


}]);