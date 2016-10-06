<div class="container" ng-controller="jugada" layout="column" flex id="content">
    <div class="container" style="width:95%">

        <h1>Jugadas</h1>
        <h3>Busqueda</h3>

        <form class="form-inline" name="formBusqueda" role="form" novalidate>

            <div class="form-group">
                <md-input-container flex>
                    <label>Nombre/Descripcion</label>
                    <input ng-model="busqueda.query" name="query_busqueda" type="text">                
                </md-input-container>            
            </div>

            <div class="form-group">
                <md-switch ng-model="busqueda.estatus" ng-change="recargar()">
                    Solo Activos
                </md-switch>
            </div>

            <div class="form-group">    
                <md-button class="md-raised md-primary" ng-click="recargar()">Buscar</md-button>
            </div>
            <div class="form-group">
                <md-button class="md-accent md-raised md-hue-2" data-toggle="modal" data-target="#nuevo">Crear</md-button>
            </div>

        </form>




        <div ng-show="contador != 0" tasty-table bind-resource-callback="getResource" bind-filters="paginador">
            <table class="table table-striped table-condensed" >
                <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                <tbody>
                    <tr ng-repeat="row in rows" class="centrado">                
                        <td>{{ row.Descripcion}}</td>
                        <td>{{ row.Abreviatura}}</td>
                        <td>{{ row.Detalle}}</td>                        
                        <td><span class="glyphicon" ng-class="( (row.Compuesta) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                        <td><span class="glyphicon" ng-class="( (row.Default==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                        
                        <td><span class="glyphicon" ng-class="( (row.Multiple==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                        <td>{{ row.Carreras}}</td>
                        <td>{{ row.Tipo}}</td>                
                        <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-material-blue btn-xs" href="" ng-click="get(row.Opciones)" data-toggle="modal" data-target="#edicion"><span class="glyphicon glyphicon-search"></span></a>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
            <div tasty-pagination></div>
        </div>






        <!--MODAL DE CREACION-->


        <div id="nuevo" class="modal fade" role="dialog">
            <div class="modal-dialog">                
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Nueva Jugada</h4>
                    </div>
                    <div class="modal-body">                

                        <form class="form-inline" name="crear" role="form" novalidate>
                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Descripcion</label>
                                    <input ng-model="obj.descripcion" maxlength="45"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="descripcion" type="text"  ng-required="true">
                                    <ng-messages for="crear.descripcion.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe indicar una Descripcion</ng-message>
                                        <ng-message when="pattern">La Descripcion deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>

                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Detalle</label>
                                    <input ng-model="obj.detalle" maxlength="255"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="detalle" type="text"  ng-required="true">
                                    <ng-messages for="crear.detalle.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe cargar algun Detalle</ng-message>
                                        <ng-message when="pattern">La Descripcion deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>

                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Abreviatura</label>
                                    <input ng-model="obj.abreviatura" maxlength="5"  pattern="[a-zA-Z]+" name="abreviatura" type="text"  ng-required="true">
                                    <ng-messages for="crear.abreviatura.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe cargar algun Abreviatura</ng-message>
                                        <ng-message when="pattern">La Abreviatura deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>

                            <div class="form-group">
                                <md-switch ng-model="obj.por_defecto">
                                    Por Defecto
                                </md-switch>
                            </div> 

                            <div class="form-group">
                                <md-switch ng-model="obj.multijugada">
                                    Multijugada
                                </md-switch>
                            </div> 



                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Cant Carreras</label>
                                    <input maxlength="3" ng-model="obj.cantcarr" ng-required="true" pattern="[0-9]+" type="number" name="pond">
                                    <ng-messages for="crear.pond.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe indicar una cantidad</ng-message>                        
                                        <ng-message when="number">Solo se Admiten valores numericos</ng-message>  
                                        <ng-message when="pattern">El valor debe ser entero</ng-message>  
                                    </ng-messages>

                                </md-input-container>

                            </div>  





                            <div class="form-group">

                                <md-input-container flex>

                                    <md-select name="tipos" md-on-open="cargarTipos()" placeholder="Tipo de Jugada" ng-model="obj.tipo" required>      
                                        <md-option ng-repeat="tcon in tcondicion" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="crear.tipos.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un tipo de Jugada</ng-message>                        
                                    </ng-messages>

                                </md-input-container>



                            </div> 


                            <div class="form-group">
                                <md-switch ng-model="obj.compuesta">
                                    Compuesta
                                </md-switch>
                            </div> 

                            <div class="form-group" ng-if="obj.compuesta">

                                <md-input-container flex>

                                    <md-select name="base" md-on-open="cargarJugadas()" placeholder="Jugada" ng-model="obj.base" ng-required="obj.compuesta">      
                                        <md-option ng-repeat="tcon in tjugadas" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="crear.base.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar una Jugada</ng-message>                        
                                    </ng-messages>

                                </md-input-container>



                            </div> 




                            <div class="form-group">
                            <md-chips ng-model="hipodromos" md-autocomplete-snap md-require-match   >
                            <md-autocomplete
                                md-selected-item="participante.selectedItem"
                                md-search-text="participante.searchText"
                                md-items="item in hipodromosSearch(participante.searchText)"
                                md-item-text="item.name"
                                placeholder="Hipodromos Asociados">
                                <span md-highlight-text="participante.searchText">{{item.abreviatura}} </span>
                            </md-autocomplete>
                            <md-chip-template >
                            <span>
                                <strong>{{$chip.abreviatura}}</strong>
                             </span>
                            </md-chip-template>
                            </md-chips>
                                

                            </div> 




                        </form>

                    </div>
                    <div class="modal-footer">
                        <md-button class="md-raised md-primary" ng-click="crear_nuevo(true)">Crear</md-button>
                        <md-button ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                    </div>
                </div>

            </div>
        </div>















        <!--MODAL DE MODIFICACION-->

        <div id="edicion" class="modal fade" role="dialog">
            <div class="modal-dialog">                
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modificar Jugada</h4>
                    </div>
                    <div class="modal-body">                               
                        <form class="form-inline" name="modificar" role="form" novalidate>
                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Descripcion</label>
                                    <input ng-model="obj2.descripcion" maxlength="15"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="nombre_pais" type="text"  ng-required="true">
                                    <ng-messages for="modificar.nombre_pais.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe indicar una Descripcion</ng-message>
                                        <ng-message when="pattern">La Descripcion deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>

                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Detalle</label>
                                    <input ng-model="obj2.detalle" maxlength="15"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="detalle_pais" type="text"  ng-required="true">
                                    <ng-messages for="modificar.detalle_pais.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe cargar algun Detalle</ng-message>
                                        <ng-message when="pattern">La Descripcion deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>

                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Abreviatura</label>
                                    <input ng-model="obj2.abreviatura" maxlength="5"  pattern="[a-zA-Z]+" name="abreviatura" type="text"  ng-required="true">
                                    <ng-messages for="modificar.abreviatura.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe cargar algun Abreviatura</ng-message>
                                        <ng-message when="pattern">La Abreviatura deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>

                            <div class="form-group">
                                <md-switch ng-model="obj2.por_defecto">
                                    Por Defecto
                                </md-switch>
                            </div> 

                            <div class="form-group">
                                <md-switch ng-model="obj2.multijugada">
                                    Multijugada
                                </md-switch>
                            </div> 



                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Cant Carreras</label>
                                    <input maxlength="3" ng-model="obj2.cantcarr" ng-required="true" pattern="[0-9]+" type="number" name="pond">
                                    <ng-messages for="modificar.pond.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe indicar una cantidad</ng-message>                        
                                        <ng-message when="number">Solo se Admiten valores numericos</ng-message>  
                                        <ng-message when="pattern">El valor debe ser entero</ng-message>  
                                    </ng-messages>

                                </md-input-container>

                            </div>  

                            <div class="form-group">

                                <md-input-container flex>

                                    <md-select name="tipos" md-on-open="cargarTipos()" placeholder="Tipo de Jugada" ng-model="obj2.tipo" required>      
                                        <md-option ng-repeat="tcon in tcondicion" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="modificar.tipos.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un tipo de Jugada</ng-message>                        
                                    </ng-messages>

                                </md-input-container>


                            </div> 
                                


                            <div class="form-group">
                                <md-switch ng-model="obj2.compuesta">
                                    Compuesta
                                </md-switch>
                            </div> 

                            <div class="form-group" ng-if="obj2.compuesta">

                                <md-input-container flex>

                                    <md-select name="base" md-on-open="cargarJugadas()" placeholder="Jugada" ng-model="obj2.base" ng-required="obj2.compuesta">      
                                        <md-option ng-repeat="tcon in tjugadas" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="modificar.base.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar una Jugada</ng-message>                        
                                    </ng-messages>

                                </md-input-container>

                            </div> 



                            <div class="form-group">
                                <md-switch ng-model="obj2.estatus">
                                    Activo
                                </md-switch>
                            </div> 

                            <div class="form-group">
                            <md-chips ng-model="hipodromos" md-autocomplete-snap md-require-match   >
                            <md-autocomplete
                                md-selected-item="participante.selectedItem"
                                md-search-text="participante.searchText"
                                md-items="item in hipodromosSearch(participante.searchText)"
                                md-item-text="item.name"
                                placeholder="Hipodromos Asociados">
                                <span md-highlight-text="participante.searchText">{{item.abreviatura}} </span>
                            </md-autocomplete>
                            <md-chip-template >
                            <span>
                                <strong>{{$chip.abreviatura}}</strong>
                             </span>
                            </md-chip-template>
                            </md-chips>
                                

                            </div>




                        </form>
                    </div>
                    <div class="modal-footer">
                        <md-button class="md-raised md-primary" ng-click="crear_nuevo(false)">Modificar</md-button>
                        <md-button ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                    </div>
                </div>

            </div>
        </div>


    </div>

</div>

<script src="<?php echo base_url(); ?>public/js/Administrador/Jugada.js"></script>
