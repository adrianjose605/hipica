

<div class="container" ng-controller="ejemplar" layout="column" flex id="content">
    <div class="container" style="width:95%">

        <h1>Ejemplares</h1>
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
                        <td>{{ row.Nombre}}</td>
                        <td>{{ row.Abreviatura}}</td>
                        <td>{{ row.Pais}}</td>
                        <td>{{ row.Pelaje}}</td>
                        <td>{{ row.Origen}}</td>
                        <td>{{ row.Hara}}</td>
                        <td>{{ row.Stud}}</td>
                        <td>{{row.Sexo==1 ? 'C' : 'Y'}}</td>
                        <td>{{ row.Madre}}</td>
                        <td>{{ row.Padre}}</td>
                        <td>
                            <span class="glyphicon" ng-class="{'mdi-action-done activo':(row.Estatus==1) ,
                                'mdi-action-highlight-remove inactivo':(row.Estatus==0), 'glyphicon-time inactivo':(row.Estatus==2)}" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-material-indigo btn-xs" href="" ng-click="get(row.Opciones)" data-toggle="modal" data-target="#edicion"><span class="glyphicon glyphicon-search"></span></a>
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
                        <h4 class="modal-title">Nuevo Ejemplar</h4>
                    </div>
                    <div class="modal-body">                

                        <form class="form-inline" name="crear" role="form" novalidate>

                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Nombre</label>
                                    <input ng-model="obj.nombre" maxlength="45"  name="detalle_pais" type="text"  ng-required="true">
                                    <ng-messages for="crear.detalle_pais.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe cargar un Nombre</ng-message>
                                        <ng-message when="pattern">El Nombre deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>



                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Fecha de Nacimiento</label>
                                    <input ng-model="obj.fecha_nacimiento" name="fecha" type="text" date-time required="true" format="DD-MM-YYYY" max-view="year" min-view="date" ng-required="true" auto-close="true">
                                    <ng-messages for="crear.fecha.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe indicar una Descripcion</ng-message>
                                        <ng-message when="pattern">La Descripcion deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>

                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Abreviatura <small>Max 15 Car</small></label>
                                    <input ng-model="obj.nombre_abrev" maxlength="15"  pattern="[a-zA-Z]+" name="nombre_abrev" type="text"  ng-required="true">
                                    <ng-messages for="crear.nombre_abrev.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe cargar una Abreviatura</ng-message>
                                        <ng-message when="pattern">La Descripcion deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>
                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Comentario Inicial </label>
                                    <input ng-model="obj.comentario_inicial" maxlength="255" name="comentario_inicial" type="text"  ng-required="true">
                                    <ng-messages for="crear.comentario_inicial.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe cargar una Abreviatura</ng-message>
                                        <ng-message when="pattern">La Descripcion deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>




                            
                            <div class="form-group">
                                <md-switch ng-model="obj.castrado=0">
                                    Castrado
                                </md-switch>
                            </div> 




                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="sexos" placeholder="Sexo" ng-model="obj.sexo" required>      
                                        <md-option ng-repeat="tcon in tsexos" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="crear.paises.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar el Sexo</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                            </div> 




                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="paises" md-on-open="cargarPaises()" placeholder="Pais" ng-model="obj.pais" required>      
                                        <md-option ng-repeat="tcon in tpaises" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="crear.paises.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un Pais</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                            </div> 


                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="pelajes" md-on-open="cargarPelajes()" placeholder="Pelaje" ng-model="obj.pelaje" required>      
                                        <md-option ng-repeat="tcon in tpelajes" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="crear.pelajes.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un Pelaje</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                            </div> 

                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="origenes" md-on-open="cargarOrigenes()" placeholder="Origen" ng-model="obj.origen" required>      
                                        <md-option ng-repeat="tcon in torigenes" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="crear.origenes.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un Pelaje</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                            </div> 


                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="studs" md-on-open="cargarStuds()" placeholder="Stud" ng-model="obj.stud" required>      
                                        <md-option ng-repeat="tcon in tstuds" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="crear.studs.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un Stud</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                            </div> 

                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="haras" md-on-open="cargarHaras()" placeholder="Hara" ng-model="obj.hara" required>      
                                        <md-option ng-repeat="tcon in tharas" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="crear.pelajes.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un Hara</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                            </div> 


                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="padres" md-on-open="cargarPadres()" placeholder="Padre" ng-model="obj.padre">      
                                        <md-option ng-repeat="tcon in tpadres" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>

                                </md-input-container>
                            </div> 

                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="madres" md-on-open="cargarMadres()" placeholder="Madre" ng-model="obj.madre">      
                                        <md-option ng-repeat="tcon in tmadres" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>

                                </md-input-container>
                            </div> 

                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="estatus" md-on-open="cargarEstatus()" placeholder="Estatus" ng-model="obj.estatus">      
                                        <md-option ng-repeat="tcon in testatus" ng-value="tcon.id">{{tcon.nombre}}</md-option>
                                    </md-select>

                                </md-input-container>
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
                        <h4 class="modal-title">Modificar Ejemplar</h4>
                    </div>
                    <div class="modal-body">                               
                        <form class="form-inline" name="modificar" role="form" novalidate>
                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Nombre</label>
                                    <input ng-model="obj2.nombre" maxlength="15"  name="detalle_pais" type="text"  ng-required="true">
                                    <ng-messages for="modificar.detalle_pais.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe cargar un Nombre</ng-message>
                                        <ng-message when="pattern">El Nombre deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>



                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Fecha de Nacimiento</label>
                                    <input ng-model="obj2.fecha_nacimiento" name="fecha" type="text" date-time required="true" format="DD-MM-YYYY" max-view="year" min-view="date" ng-required="true" auto-close="true">
                                    <ng-messages for="modificar.fecha.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe indicar una Descripcion</ng-message>
                                        <ng-message when="pattern">La Descripcion deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>

                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Abreviatura <small>Max 15 Car</small></label>
                                    <input ng-model="obj2.nombre_abrev" maxlength="15"  pattern="[a-zA-Z]+" name="nombre_abrev" type="text"  ng-required="true">
                                    <ng-messages for="modificar.nombre_abrev.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe cargar una Abreviatura</ng-message>
                                        <ng-message when="pattern">La Descripcion deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>

                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Comentario Inicial </label>
                                    <input ng-model="obj2.comentario_inicial" maxlength="255" name="comentario_inicial" type="text"  ng-required="true">
                                    <ng-messages for="crear.comentario_inicial.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe cargar una Abreviatura</ng-message>
                                        <ng-message when="pattern">La Descripcion deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>


                            
                            <div class="form-group">
                                <md-switch ng-model="obj2.castrado">
                                    Castrado
                                </md-switch>
                            </div> 




                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="sexos" placeholder="Sexo" ng-model="obj2.sexo" required>      
                                        <md-option ng-repeat="tcon in tsexos" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="modificar.paises.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar el Sexo</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                            </div> 




                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="paises" md-on-open="cargarPaises()" placeholder="Pais" ng-model="obj2.pais" required>      
                                        <md-option ng-repeat="tcon in tpaises" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="modificar.paises.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un Pais</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                            </div> 


                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="pelajes" md-on-open="cargarPelajes()" placeholder="Pelaje" ng-model="obj2.pelaje" required>      
                                        <md-option ng-repeat="tcon in tpelajes" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="modificar.pelajes.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un Pelaje</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                            </div> 

                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="origenes" md-on-open="cargarOrigenes()" placeholder="Origen" ng-model="obj2.origen" required>      
                                        <md-option ng-repeat="tcon in torigenes" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="modificar.origenes.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un Pelaje</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                            </div> 


                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="studs" md-on-open="cargarStuds()" placeholder="Stud" ng-model="obj2.stud" required>      
                                        <md-option ng-repeat="tcon in tstuds" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="modificar.studs.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un Stud</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                            </div> 

                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="haras" md-on-open="cargarHaras()" placeholder="Hara" ng-model="obj2.hara" required>      
                                        <md-option ng-repeat="tcon in tharas" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="modificar.pelajes.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un Hara</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                            </div> 


                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="padres" md-on-open="cargarPadres()" placeholder="Padre" ng-model="obj2.padre">      
                                        <md-option ng-repeat="tcon in tpadres" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>

                                </md-input-container>
                            </div> 

                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="madres" md-on-open="cargarMadres()" placeholder="Madre" ng-model="obj2.madre">      
                                        <md-option ng-repeat="tcon in tmadres" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>

                                </md-input-container>
                            </div> 
                            <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="estatus" md-on-open="cargarEstatus()" placeholder="Estatus" ng-model="obj2.estatus">      
                                        <md-option ng-repeat="tcon in testatus" ng-value="tcon.id">{{tcon.nombre}}</md-option>
                                    </md-select>

                                </md-input-container>
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

<script src="<?php echo base_url(); ?>public/js/Administrador/Ejemplar.js"></script>
