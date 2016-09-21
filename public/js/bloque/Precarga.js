angular.module('hipica').
controller('preCarga', ['$scope', '$http','$mdToast','$mdDialog', function($scope,$http,$mdToast,$mdDialog,$window){	

//datos globales necesarios
$scope.paises={};
$scope.paginador={valor:true};
$scope.hipodromos={};
$scope.pistas={};
$scope.premios={};
$scope.premios={};
$scope.estadosPista={};
$scope.fecha='';
$scope.submitted=false;
$scope.sub_part=false;

$scope.abrir=function(url){

	$window.open('//facebook.com');
};
 

$scope.cambiar_estado=function(col){
	return $http.get('bloque/nuevaCarrera/cambiar_estado/'+col.Opciones).
		success(function(data, status, headers, config) {		

			if(data.status=='1'){
				hacerToast('success',data.mensaje,$mdToast);


			}
			else{
				hacerToast('error',data.mensaje,$mdToast);
				col.valor=!col.valor;
			}
		}).	
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar Paises');
		});
		$scope.hipodromos={};
};


$scope.obj={'condicion':[],'jugadas':[],'clasico':[]};



  $scope.showConfirm = function(ev,col) {
    // Appending dialog to document.body to cover sidenav in docs app
    var confirm = $mdDialog.confirm()
          .title('Desea Cambiar el Estado de esta Carrera')
          .textContent('Esta Seguro?')          
          .targetEvent(ev)
          .ok('Si')
          .cancel('No');
    $mdDialog.show(confirm).then(function() {
      	$scope.cambiar_estado(col)
    }, function() {
    
	

      col.valor=!col.valor;

      

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

		var urlApi = 'bloque/nuevaCarrera/tabla_principal_carrera/'+paramsObj.count+'/'+paramsObj.page+'/';
		if(paramsObj.sortBy){
			urlApi+=paramsObj.sortBy+'/'+paramsObj.sortOrder;    
		}

		return $http.post(urlApi,$scope.obj).then(function (response) {
			
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


$scope.condicionSearch=function(param){
	return $http.get('Admin/condicion/ver_busqueda/'+param)
		.then(function(result){
			return result.data;
		});
};

$scope.clasicosSearch=function(param){
	return $http.get('Admin/clasico/ver_busqueda/'+param)
		.then(function(result){
			return result.data;
		});
};


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


$scope.cargarHipodromos=function(){
	if(!$scope.obj.pais)
		return;
	return $http.get('Admin/hipodromo/ver_sel_pais/'+$scope.obj.pais).
		success(function(data, status, headers, config) {				
			$scope.hipodromos=data;			 
			 console.log($scope.hipodromos);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar Paises');
		});
}



	$scope.recargar=function(){
		$scope.paginador.valor=!$scope.paginador.valor;
	}



$scope.enviar = function() {

console.log($scope.participantesf.$valid);	
console.log('previa');
console.log($scope.formPrecarga.$valid);
	if(!$scope.formPrecarga.$valid){
		$scope.submitted=true;
				$scope.sub_part=true;

		return;
	}
	if (!$scope.participantesf.$valid){
		$scope.sub_part=true;
		return;
	}
	
	console.log($scope.obj);
                    var nuevo = [];
                    var cantidad = $scope.obj.cantidad;
                    if (!cantidad)
                        cantidad = 0;

                    var i=0;
	              	var tmp=$scope.obj;
                  for(i=0; i<cantidad; i++){
					

                    nuevo[i] = {'llave':$scope.participantes[i].llave,'idejemplar':$scope.participantes[i].ejemplar[0].id,'idjinete':$scope.participantes[i].jinete[0].id,'identrenador':$scope.participantes[i].entrenador[0].id,'pesoJinete':$scope.participantes[i].pesoJinete,'numero':$scope.participantes[i].posicion,'implementos':$scope.participantes[i].implemento};
                   
                    }
                    tmp.participantes=nuevo;

//                    console.log(nuevo);//
                    console.log($scope.obj);
                    var url= $scope.obj.id ? 'bloque/nuevaCarrera/edit' : 'bloque/nuevaCarrera/nueva';
                    $http.post(url, tmp).
			success(function(data, status, headers, config) {
				if(data.status){
					hacerToast('success',data.mensaje,$mdToast);
					$scope.submitted=false;
					if (data.id){
					$scope.obj.id=data.id;
					}
				}
				else
					hacerToast('error',data.mensaje,$mdToast);

			}).
			error(function(data, status, headers, config) {
				console.log(status);
				hacerToast('error','Error '+status,$mdToast);
			});

                };




}]);	