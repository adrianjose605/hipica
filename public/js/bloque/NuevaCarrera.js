
$('#timepicker').timepicker({
    template: false,
    showInputs: false,
    minuteStep: 5
});




angular.module('hipica').
controller('nuevaCarrera', ['$scope', '$http','$mdToast', function($scope,$http,$mdToast){	

//datos globales necesarios
$scope.premios=[];
$scope.paises={};
$scope.hipodromos={};
$scope.pistas={};
$scope.dimplementos=[];
$scope.anual='';
$scope.premios={};
$scope.premios={};
$scope.estadosPista={};
$scope.fecha='';
$scope.submitted=false;
$scope.sub_part=false;





$scope.obj={'condicion':[],'jugadas':[],'clasico':[]};



$scope.cargar_implementos_defecto=function(participante){
	console.log('activo');
	$http.get('Admin/implemento/ver_busqueda_defecto/'+participante.ejemplar[0].id)
		.then(function(result){
			 participante.implemento=result.data;			 
			 console.log(result.data);
		});
}


$scope.getDistribucion=function(){
	$http.get('Admin/premio/ver_distribucion/'+$scope.obj.premio)
		.then(function(result){
			 var dat=result.data;
			 $scope.premios[0]=parseInt(dat.porcentaje_1);
			 $scope.premios[1]=parseInt(dat.porcentaje_2);
			 $scope.premios[2]=parseInt(dat.porcentaje_3);
			 $scope.premios[3]=parseInt(dat.porcentaje_4);
			 $scope.premios[4]=parseInt(dat.porcentaje_5);
			 console.log($scope.premios);
		});
};

$scope.formatoDia=function(){
	var tmp=$scope.obj.fecha_carrera;
	return tmp ? tmp.format('dddd'): '';
}

$scope.getAnual=function(){
	console.log('mierda');
	var url='';
	if($scope.obj.id)
		url='bloque/nuevaCarrera/ver_anual/false/'+$scope.obj.id;
	else
		url='bloque/nuevaCarrera/ver_anual/true/'+$scope.obj.hipodromo;
	$http.get(url)
		.then(function(result){
			$scope.anual=result.data;
		});
}

$scope.formatoHora=function(){
	return $scope.obj.hora_carrera;
}

$scope.showDistribucion=function(index){
	
	var tmp=$scope.obj.premioTotal/100*$scope.premios[index];
		console.log(tmp);

	
	return (tmp) ? tmp.toFixed(2):'';
}

$scope.iniciarParticipantes=function(){	
	var cantidad=$scope.obj.cantidad;
	if(!cantidad)
		cantidad=0;	
	$scope.participantes=[];
	for(var i=1;i!=cantidad+1;i++){
		$scope.participantes.push({'posicion':i,'ejemplar':[],'jinete':[],'entrenador':[],'implemento':[], 'numero':i});		
	}
	
};


$scope.limitar=function(ar,chip,tipo){
	console.log('limitando');
	console.log(chip);

	console.log(ar.length);
	if(tipo==2&&!$scope.buscar_repe_jinetes(chip.id))
		return null;
	if(tipo==1&&!$scope.buscar_repe_ejemaplares(chip.id))
		return null;
	if(tipo==3&&!$scope.buscar_repe_entrenadores(chip.id))
		return null;
	if(ar.length>0){
		return null;
	}

}

$scope.validar_numeros=function(index){
	console.log('validar_numeros');
	console.log(index);
	var i=0;
	for(i=0;i!=$scope.participantes.length;i++){
		if(i==index)continue;
		if($scope.participantes[i].numero==$scope.participantes[index].numero)
			$scope.participantes[index].numero='';		
	}
	

}



$scope.buscar_repe_jinetes=function(id){
	var i=0;
	for(i=0;i!=$scope.participantes.length;i++){
		var jinete=$scope.participantes[i].jinete[0];

		if(jinete&&jinete.id==id)
			return false;
	}
	return true;
}
$scope.buscar_repe_ejemaplares=function(id){
	var i=0;
	for(i=0;i!=$scope.participantes.length;i++){
		var jinete=$scope.participantes[i].ejemplar[0];

		if(jinete&&jinete.id==id)
			return false;
	}
	return true;
}


$scope.buscar_repe_entrenadores=function(id){
	var i=0;
	for(i=0;i!=$scope.participantes.length;i++){
		var jinete=$scope.participantes[i].entrenador[0];

		if(jinete&&jinete.id==id)
			return false;
	}
	return true;
}

$scope.eliminar_llave=function(participante){
	if(!participante.valellave){
		delete(participante.llave);
		$scope.recacular_numero(participante);
	}


};

$scope.recacular_numero=function(participante){
	var pre='';
	console.log('numero');
	participante.numero=participante.numero+'';
	var llave= participante.llave ? '-'+participante.llave : '';
	if(participante.numero&&participante.numero+''.split('-').length>0)
		 pre=participante.numero.split('-')[0];
	else
		pre=participante.numero;


	participante.numero=pre+ llave;

}




		$scope.distanciasSearch=function(param){
		return $http.get('Admin/distancia/ver_busqueda/'+param)
		.then(function(result){
			return result.data;
		});
	}

$scope.ejemplaresSearch=function(param){
	return $http.get('Admin/ejemplar/ver_busqueda/'+param)
		.then(function(result){
			return result.data;
		});
};

$scope.jinetesSearch=function(param){
	return $http.get('Person/jinetes/ver_busqueda/'+param)
		.then(function(result){
			return result.data;
		});
};


$scope.implementosSearch=function(param){
	return $http.get('Admin/implemento/ver_busqueda/'+param)
		.then(function(result){
			return result.data;
		});
};

$scope.entrenadoresSearch=function(param){
	return $http.get('Person/entrenadores/ver_busqueda/'+param)
		.then(function(result){
			return result.data;
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

$scope.cargarJugadas=function(){
	return $http.get('Admin/jugada/ver_checks/'+$scope.obj.hipodromo).
		success(function(data, status, headers, config) {				
			$scope.obj.jugadas=data;			 
			 console.log($scope.jugadas);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			//hacerToast('error','Ocurrio un Error al Cargar las jugadas');
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

$scope.cargarPremios=function(){
return $http.get('Admin/premio/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.premios=data;			 
			 console.log($scope.paises);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar Paises');
		});		
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

$scope.cargarPistas=function(){
	if(!$scope.obj.hipodromo)
		return;

	return $http.get('Admin/pista/ver_sel_hipodromo/'+$scope.obj.hipodromo).
		success(function(data, status, headers, config) {				
			$scope.pistas=data;			 
			 console.log($scope.pistas);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar Paises');
		});
};




$scope.cargarDistancias=function(){
	if(!$scope.obj.pista)
		return;

	return $http.get('Admin/distancia/ver_sel_pista/'+$scope.obj.pista).
		success(function(data, status, headers, config) {
			$scope.distancias=data;
			 console.log($scope.distancias);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar Paises');
		});
};

$scope.cargarEstadoPista=function(){

	return $http.get('Admin/estadoPista/ver_estadoPistas_sel').
		success(function(data, status, headers, config) {
			$scope.estadosPista=data;
			 console.log($scope.distancias);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar Paises');
		});
};

$scope.reinicio= function(){

$scope.obj={'condicion':[],'jugadas':[],'clasico':[]};
$scope.participantes=[];

};

$scope.generar = function() {

console.log($scope.participantesf.$valid);	
console.log('previa');
console.log($scope.formNuevaCarrera.$valid);
	if(!$scope.formNuevaCarrera.$valid){
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
					

                    nuevo[i] = {'llave':$scope.participantes[i].llave,'idejemplar':$scope.participantes[i].ejemplar[0].id,'idjinete':$scope.participantes[i].jinete[0].id,'identrenador':$scope.participantes[i].entrenador[0].id,'pesoJinete':$scope.participantes[i].pesoJinete,'numero':$scope.participantes[i].numero,'posicion':$scope.participantes[i].posicion,'implementos':$scope.participantes[i].implemento};
                   
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

if(__pais){
	$scope.obj.pais=__pais;
	$scope.cargarPaises();
}

if(__hipodromo){
	$scope.obj.hipodromo=__hipodromo;
	$scope.cargarHipodromos();
}
if(__fecha){
	$scope.obj.fecha_carrera=moment(__fecha,'DD-MM-YYYY');
	console.log(__fecha);
}
else
	$scope.obj.fecha_carrera=moment();




$scope.getFromServer=function(id){
	$http.get('bloque/nuevaCarrera/ver/'+id).
		success(function(data, status, headers, config) {				
			//$scope.spaises=data;
			console.log(data);
			data.c.cantidad=parseInt(data.c.cantidad);
			data.c.llamado=parseInt(data.c.llamado);
			data.c.reunion=parseInt(data.c.reunion);
			data.c.numero=parseInt(data.c.numero);
			data.c.premioTotal=parseInt(data.c.premioTotal);
			data.c.fecha_carrera=moment(data.c.fecha_carrera);
			var tem=new moment(data.c.hora_carrera,'h:mm:ss');
			data.c.hora_carrera=tem.format('h:mm A');
			$scope.participantes=data.c.participantes;
			console.log('aqui coño');
			console.log(data.c.participantes);
			delete(data.c.participantes);
			$scope.obj=data.c;
			console.log('antes');

			//$scoype.obj.jugadas=$scope.obj.jug;
			console.log($scope.obj);
						console.log('despues');
						$scope.obj.jugadas=angular.copy($scope.obj.jug);
						delete($scope.obj.jug);
						

						console.log($scope.obj.jugadas);
						var index;


						for	(index = 0; index < $scope.obj.jugadas.length; index++) {
    						$scope.obj.jugadas[index].estatus=$scope.obj.jugadas[index].estatus =='1' ? true:false;    						
						}
						
						console.log($scope.obj.jugadas);

			//console.log(data.c);			

			$scope.cargarPremios();
			$scope.cargarPaises();
			$scope.cargarHipodromos();
			$scope.cargarDistancias();	
			$scope.cargarEstadoPista();$scope.cargarPistas();
			if($scope.obj.clasico)
				$scope.obj.cestatus=true;
			$scope.getDistribucion();
			$scope.obj.id=id;
			$scope.getAnual();
			console.log('elide');
			console.log($scope.obj.id);

			//console.log($scope.clasico);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar Paises');
		});

}
if(__id){
$scope.getFromServer(__id);
console.log('OHY');
console.log(__id);
}
//$scope.getFromServer(26);


}]);	