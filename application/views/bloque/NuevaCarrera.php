<script type="text/javascript">
    var __pais='<?php echo $pais; ?>';
    var __hipodromo='<?php echo $hipodromo; ?>';
    var __fecha='<?php echo $fecha; ?>';
    var __id='<?php echo $id; ?>';
    
</script>

<div  ng-controller="nuevaCarrera" layout="column" flex id="content">
    <div class="container" style="width:95%">
        <h1>Nuevo Llamado </h1>
    </div>
<div class="container">
  <fieldset>
    <legend>Resumen de Llamado</legend>
    <div layout="row">
        <div flex="15"><code>Premio Total:</code>{{obj.premioTotal}}</div>
        <div flex="15"><code>1° Premio:</code>{{showDistribucion(0)}}</div>
        <div flex="15"><code>2° Premio:</code>{{showDistribucion(1)}}</div>
        <div flex="15"><code>3° Premio:</code>{{showDistribucion(2)}}</div>
        <div flex="15"><code>4° Premio:</code>{{showDistribucion(3)}}</div>
        <div flex="15"><code>5° Premio:</code>{{showDistribucion(4)}}</div>
    </div>

    <div layout="row">
        <div flex="15"><code>Dia:</code>{{formatoDia()}}</div>
        <div flex="15"><code>Hora:</code>{{formatoHora()}}</div>
        <div flex="15"><code>Anual:</code>{{obj.numero}}</div>        

    </div>

    
  </fieldset>
</div>


    <form class="form-inline container" name="formNuevaCarrera" role="form" novalidate>
            
            

        <div layout-gt-sm="row" layout-wrap>

        <div class="form-group" flex="5">
                <md-input-container>
                    <label>Anual</label>
                    <input ng-model="obj.numero" name="numero" type="number" required>
                    <ng-messages for="formNuevaCarrera.numero.$error" role="alert" ng-if="submitted">
                       <ng-message when="required">Debe indicar un Numero Anual</ng-message>
                       <ng-message when="number">Se debe Indicar un Valor Numerico</ng-message>  
                    </ng-messages>
                </md-input-container>            
            </div>

            <div class="form-group" flex="5">
                <md-input-container>
                    <label>Reunion</label>
                    <input ng-model="obj.reunion" name="reunion" type="number" required>
                    <ng-messages for="formNuevaCarrera.reunion.$error" role="alert" ng-if="submitted">
                       <ng-message when="required">Debe indicar una Reunion</ng-message>
                       <ng-message when="number">Se debe Indicar un Valor Numerico</ng-message>  
                    </ng-messages>
                </md-input-container>            
            </div>

            <div class="form-group" flex="10">
                <md-input-container flex>
                    <label>Nro Llamado</label>
                    <input ng-model="obj.llamado" name="llamado" type="number" required>
                    <ng-messages for="formNuevaCarrera.llamado.$error" role="alert" ng-if="submitted">
                       <ng-message when="required">Debe indicar un llamado</ng-message>
                       <ng-message when="number">Se debe Indicar un llamado</ng-message>  
                    </ng-messages>
                </md-input-container>            
            </div>

            <div class="form-group" flex='25'>
                <md-input-container flex>
                    <label>Trofeo</label>
                    <input ng-model="obj.trofeo" maxlength="120"  pattern="[a-zA-Z]+" name="trofeo" type="text">
                    <ng-messages for="formNuevaCarrera.trofeo.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe indicar un trofeo</ng-message>
                        <ng-message when="pattern">El trofeo deben ser caracteres</ng-message>  
                    </ng-messages>
                </md-input-container>
            </div>

            <div class="form-group" flex='25'>
                <md-input-container flex>
                    <label>Premio Total</label>
                    <input ng-model="obj.premioTotal" name="premioTotal" type="number" required>
                    <ng-messages for="formNuevaCarrera.premioTotal.$error" role="alert" ng-if="submitted">
                       <ng-message when="required">Debe indicar una Total</ng-message>
                       <ng-message when="number">Se debe Indicar un Valor Numerico</ng-message>  
                    </ng-messages>
                </md-input-container>            
            </div>

             <div class="form-group" flex='25'>
                <md-input-container flex>
                <label>Premio</label>
                    <md-select name="premios" md-on-open="cargarPremios()" placeholder="Premio" ng-model="obj.premio"  ng-change="getDistribucion();" required>      
                        <md-option ng-repeat="tcon in premios" ng-value="tcon.id">{{tcon.val}}</md-option>
                    </md-select>
                    <ng-messages for="formNuevaCarrera.premios.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe seleccionar un tipo de premiacion</ng-message>                        
                    </ng-messages>

                </md-input-container>
            </div> 
        </div>

        <div layout="row" layout-wrap>
            <div class="form-group" flex='15'>
                <md-input-container flex>
                    <label>Fecha de Carrera</label>
                    <input ng-model="obj.fecha_carrera" name="fecha" type="text" date-time required="true" format="DD-MM-YYYY" max-view="year" min-view="date" ng-required="true" auto-close="true">
                    <ng-messages for="formNuevaCarrera.fecha.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe indicar una Fecha</ng-message>
                            <ng-message when="pattern">La Fecha deben ser caracteres</ng-message>  
                    </ng-messages>
                </md-input-container>
            </div>
            <div class="form-group" flex='15'>
                <md-input-container  class="bootstrap-timepicker" flex>

                    <label>Hora de Carrera</label>
                    <input id="timepicker" ng-model="obj.hora_carrera" name="fecha" type="text" required="true"  ng-required="true">
                    <ng-messages for="formNuevaCarrera.fecha.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe indicar una Fecha</ng-message>
                            <ng-message when="pattern">La Fecha deben ser caracteres</ng-message>  
                        </ng-messages>
                </md-input-container>
            </div>

            <div class="form-group" flex="15">
                <md-input-container flex>
                    <label>Pais</label>
                    <md-select name="paises" md-on-open="cargarPaises()" placeholder="Pais" ng-model="obj.pais" required>                                  
                        <md-option ng-repeat="tcon in paises" ng-value="tcon.id">{{tcon.val}}</md-option>
                    </md-select>
                    <ng-messages for="formNuevaCarrera.paises.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe seleccionar un Pais</ng-message>                        
                    </ng-messages>

                </md-input-container>
            </div> 

            <div class="form-group" flex="15">
                <md-input-container flex>
                <label>Hipodromo</label>
                    <md-select name="hipodromos" ng-change="cargarJugadas();getAnual();" md-on-open="cargarHipodromos()" placeholder="Hipodromo" ng-model="obj.hipodromo"   required>      
                        <md-option ng-repeat="tcon in hipodromos" ng-value="tcon.id">{{tcon.val}}</md-option>
                    </md-select>
                    <ng-messages for="formNuevaCarrera.hipodromos.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe seleccionar un hipodromo</ng-message>                        
                    </ng-messages>

                </md-input-container>
            </div> 

            <div class="form-group" flex="15">
                <md-input-container flex>
                <label>Pista</label>
                    <md-select name="pistas" md-on-open="cargarPistas()" placeholder="Pista"   ng-model="obj.pista" required>      
                        <md-option ng-repeat="tcon in pistas" ng-value="tcon.id">{{tcon.val}}</md-option>
                    </md-select>
                    <ng-messages for="formNuevaCarrera.pistas.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe seleccionar una pistas</ng-message>                        
                    </ng-messages>

                </md-input-container>
            </div> 

            <div class="form-group" flex="15">
                <md-input-container flex>
                <label>Distancia</label>
                    <md-select name="distancias" md-on-open="cargarDistancias()" placeholder="Distancia" ng-model="obj.distancia" required>      
                        <md-option ng-repeat="tcon in distancias" ng-value="tcon.id">{{tcon.val}}</md-option>
                    </md-select>
                    <ng-messages for="formNuevaCarrera.distancias.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe seleccionar una distancia</ng-message>                        
                    </ng-messages>

                </md-input-container>
            </div> 



            <div class="form-group" flex="15">
                <md-input-container flex>
                    <label>Cantidad de Participantes</label>
                    <input ng-model="obj.cantidad" name="participantes" type="number" ng-change="iniciarParticipantes();" required>
                   <ng-messages for="formNuevaCarrera.participantes.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Deben Haber Participantes</ng-message>                        
                    </ng-messages>
                </md-input-container>            
            </div>                
        </div>

        

        <div layout-gt-sm="row">
            <div class="form-group" flex='20'>
                <md-switch ng-model="obj.cestatus">
                    Clasico
                </md-switch>
            </div>

            <md-chips ng-model="obj.clasico" md-autocomplete-snap md-require-match="true" ng-if="obj.cestatus" flex='80' >
                <md-autocomplete
                md-selected-item="atc.selectedItem"
                md-search-text="atc.searchText"
                md-items="item in clasicosSearch(atc.searchText)"
                md-item-text="item.name"
                placeholder="Clasicos y Copas">
                    <span md-highlight-text="atc.searchText">{{item.clasico}}</span>
                </md-autocomplete>
                <md-chip-template >
                    <span>
                        <strong>{{$chip.clasico}}</strong>                    
                    </span>
                </md-chip-template>
            </md-chips>
        </div>     



        <label>Condiciones</label>
        <md-chips ng-model="obj.condicion" md-autocomplete-snap md-require-match="true"   >
             <md-autocomplete
                md-selected-item="atc.selectedItem"
                md-search-text="atc.searchText"
                md-items="item in condicionSearch(atc.searchText)"
                md-item-text="item.name"
                placeholder="Condicion">
                <span md-highlight-text="atc.searchText">{{item.condicion}} ({{item.tipo}}) </span>
            </md-autocomplete>
            <md-chip-template >
                <span>
                    <strong>{{$chip.condicion}} ({{$chip.tipo}})</strong>
                    
                </span>
            </md-chip-template>
        </md-chips>

        <div layout="row" layout-wrap="" ng-if="obj.jugadas.length">
            <div flex="100" flex-gt-sm="50"
                <fieldset class="standard">
                    <legend>Jugadas</legend>
                    <div layout="row" layout-wrap flex>
                        <div flex="15" ng-repeat="jugada in obj.jugadas">
                            <md-checkbox  ng-model="jugada.estatus">
                                {{ jugada.abreviatura }} 
                            </md-checkbox>
                        </div>
                    </div>            
                </fieldset>
            </div>
        </div>
    </form>

    <md-toolbar class="md-accent md-hue-2 container" ng-if="participantes.length">
        <h2 class="md-toolbar-tools">
            <span>Participantes</span>
        </h2>
    </md-toolbar>

    <form name='participantesf' class="container" >    
        <ng-form ng-repeat="participante in participantes" class="form-inline" name="formas" role="form" novalidate>
            <div   class="divider"></div>
                <div layout="row" layout-wrap flax="100">
                    <md-input-container flex="5" >
                        <label>Numero</label>
                        <input ng-model="participante.numero" name="numero" type="text" size="10"  ng-change="validar_numeros($index)" required >
                        <ng-messages for="formas.numero.$error" role="alert" ng-if="sub_part" >
                            <ng-message when="required">Debe indicar una Numero</ng-message>
                            <ng-message when="number">Se debe Indicar un Valor Numerico</ng-message>  
                        </ng-messages>
                    </md-input-container >
        <!--inicio de chip-->
            
                    <md-chips ng-model="participante.ejemplar" md-on-add="cargar_implementos_defecto(participante);" md-autocomplete-snap md-require-match="true" md-transform-chip="limitar(participante.ejemplar,$chip,1)" flex="30" >
                        <md-autocomplete
                        md-selected-item="atc.selectedItem"
                        md-search-text="atc.searchText"
                        md-items="item in ejemplaresSearch(atc.searchText)"
                        md-item-text="item.name"
                        placeholder="Ejemplar">
                            <span md-highlight-text="atc.searchText">{{item.ejemplar}} </span>
                        </md-autocomplete>
                        <md-chip-template >
                            <span>
                                <strong>{{$chip.ejemplar}}</strong>                        
                            </span>
                        </md-chip-template>
                    </md-chips>
            
                    <md-chips flex="30" ng-model="participante.jinete" md-autocomplete-snap md-require-match="true" md-transform-chip="limitar(participante.jinete,$chip,2)" >
                        <md-autocomplete

                        md-selected-item="atc.selectedItem"
                        md-search-text="atc.searchText"
                        md-items="item in jinetesSearch(atc.searchText)"
                        md-item-text="item.name"
                        placeholder="Jinete">
                            <span md-highlight-text="atc.searchText">{{item.jinete}} </span>
                        </md-autocomplete>
                        <md-chip-template >
                            <span>
                                <strong>{{$chip.jinete}}</strong>                            
                            </span>
                        </md-chip-template>
                    </md-chips>



            
                    <md-chips flex="30" ng-model="participante.entrenador" md-autocomplete-snap md-require-match="true" md-transform-chip="limitar(participante.entrenador,$chip,3)">
                    <md-autocomplete
                        md-selected-item="atc.selectedItem"
                        md-search-text="atc.searchText"
                        md-items="item in entrenadoresSearch(atc.searchText)"
                        md-item-text="item.name"
                        placeholder="Entrenador">
                        <span md-highlight-text="atc.searchText">{{item.entrenador}} </span>
                    </md-autocomplete>
                    <md-chip-template >
                        <span>
                            <strong>{{$chip.entrenador}}</strong>                                
                        </span>
                    </md-chip-template>
                    </md-chips>

                    
                </div>


                <div layout-gt-sm="row" layout-wrap>

                    <md-input-container flex="10" >
                        <label>Pos. Partida</label>
                        <input ng-model="participante.posicion" name="numero" type="number" required>
                        <ng-messages for="formas.numero.$error" role="alert" ng-if="sub_part">
                            <ng-message when="required">Debe indicar una Total</ng-message>
                            <ng-message when="number">Se debe Indicar un Valor Numerico</ng-message>  
                        </ng-messages>
                    </md-input-container>   
                
                    <md-chips flex="30" ng-model="participante.implemento" md-autocomplete-snap md-require-match="true"   >
                        <md-autocomplete
                            md-selected-item="atc.selectedItem"
                            md-search-text="atc.searchText"
                            md-items="item in implementosSearch(atc.searchText)"
                            md-item-text="item.name"
                            placeholder="Implementos">
                            <span md-highlight-text="atc.searchText">{{item.implemento}} </span>
                        </md-autocomplete>
                        <md-chip-template >
                            <span>
                                <strong>{{$chip.implemento}}</strong>
                                
                            </span>
                        </md-chip-template>
                    </md-chips>



                    <md-input-container flex="10" md-no-float>
                                        <label>Peso Jinete</label>

                        <input ng-model="participante.pesoJinete" name="pesoJinete" type="number"  required >
                        <ng-messages for="formas.pesoJinete.$error" role="alert" ng-if="sub_part">
                            <ng-message when="required">Debe indicar una Total</ng-message>                            
                        </ng-messages>
                    </md-input-container>  

                    <div class="form-group" flex='5'>
                        <md-switch ng-model="participante.valellave" ng-change="eliminar_llave(participante);">
                            Llave
                        </md-switch>
                    </div>

                    <md-input-container flex="5" ng-if="participante.valellave">
                        <label>Nro Llave</label>
                        <input ng-model="participante.llave" name="llave" type="text" size="10" ng-required="participante.valellave" ng-change="recacular_numero(participante);" >
                        <ng-messages for="formas.llave.$error" role="alert" ng-if="sub_part">
                            <ng-message when="required">Debe indicar una Numero</ng-message>
                            <ng-message when="number">Se debe Indicar un Valor Numerico</ng-message>  
                        </ng-messages>
                    </md-input-container >
            <!--fin  de chip-->
                </div>
        </ng-form>        
    </form>
    <div layout="row" class="container">
        <md-button ng-if="!obj.id" class="md-raised md-primary" ng-click="generar();"  flex="15">Registrar</md-button>
        <md-button ng-if="obj.id" class="md-raised md-primary" ng-click="generar();"  flex="15">Editar</md-button>
        <md-button ng-if="obj.id" class="md-raised md-primary" ng-click="reinicio();"  flex="20">Registrar Nuevo</md-button>
    </div>
    
</div>
<script src="<?php echo base_url(); ?>public/js/bloque/NuevaCarrera.js"></script>