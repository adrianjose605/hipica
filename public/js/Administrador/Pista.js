angular.module('hipica').
controller('pista', ['$scope','$http','$mdToast', function($scope, $http,$mdToast){
	$scope.obj={};
	$scope.obj2={};
	$scope.distancias=[];
	$scope.spaices=[];	
	$scope.hipos=[];	
	$scope.paginador={valor:true};

	$scope.busqueda={estatus:true,query:''};
	$scope.contardor=0;
	$scope.submitted=false;



	$scope.resetForm = function(){
		$scope.obj=angular.copy({});
		$scope.obj2=angular.copy({});
		$scope.submitted=false;
	}



	$scope.distanciasSearch=function(param){
		return $http.get('Admin/distancia/ver_busqueda/'+param)
		.then(function(result){
			return result.data;
		});
	}




	$scope.cargarTipos=function(){
		return $http.get('Admin/tipoPista/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.spaices=data;			 
			console.log($scope.spaices);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar Paises');
		});
	}


	$scope.cargarHipos=function(){
		return $http.get('Admin/hipodromo/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.hipos=data;
			console.log($scope.spaices);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar Paises');
		});
	}


	$scope.CDistancias=function(){
		rt=[];
		for (index = 0; index < $scope.distancias.length; ++index) {			
    		rt.push({'id':$scope.distancias[index].id});
		}
		return rt;
	};





	$scope.recargar=function(){
		$scope.paginador.valor=!$scope.paginador.valor;
	}


	$scope.crear_nuevo= function(tipo){
		var url='';

		if(tipo){
			url='Admin/pista/crear_pista';
			obj=$scope.obj;
		}else{
			url='Admin/pista/modificar_pista';
			obj=$scope.obj2;
			obj.distancias=$scope.CDistancias();

		}
		console.log('registrando');
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
		$scope.cargarTipos();
		$scope.cargarHipos();
		$http.get('Admin/pista/ver/'+id).
		success(function(data, status, headers, config) {				
			data.estatus=data.estatus=='1';			
			console.log(data);
			$scope.distancias=[];									
			if(data.distancias){
				console.log('distancias');
				console.log(data.distancias);
				$scope.distancias=data.distancias;									
				//delete data.distancias;
			}

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

		var urlApi = 'Admin/pista/tabla_principal_pista/'+paramsObj.count+'/'+paramsObj.page+'/';
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