
<div ng-controller="tropiezo" class="container" layout="column" flex id="content">
    <div class="container" style="width:95%">
    <h1 >Tropiezos</h1>

    <h3>Busqueda</h3>

        <form class="form-inline" name="formBusquedaTropiezo" role="form" novalidate>
            <div class="form-group">
                <md-input-container flex>
                    <label>Nombre / Abrev</label>
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
                <md-button class="md-accent md-raised md-hue-2" data-toggle="modal" data-target="#nuevo_tropiezo">Crear</md-button>
            </div>

        </form>


        

        <div ng-show="contador != 0" tasty-table bind-resource-callback="getResource" bind-filters="paginador">
             <table class="table table-striped table-condensed" >
                <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                <tbody>
                    <tr ng-repeat="row in rows" class="centrado">

                        <td>{{ row.Descripcion}}</td>
                        <td>{{ row.Abreviatura}}</td>
                        <td>{{ row['Registrado']}}</td>                
                        <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-material-indigo btn-xs" href=""  ng-click="getTropiezo(row.Opciones)" data-toggle="modal" data-target="#modificar_tropiezo"><span class="glyphicon glyphicon-search"></span></a>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
            <div tasty-pagination></div>
        </div>

        <!--MODAL DE CREACION-->

        <div id="nuevo_tropiezo" class="modal fade" role="dialog">
            <div class="modal-dialog">                
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                      
                    </div>
                    <div class="modal-body">
                        <h2 class="modal-title">Nuevo Tropiezo</h2>

                        <form class="form-inline" name="formTropiezo" role="form" novalidate>
                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Nombre</label>
                                    <input ng-model="tropiezo.descripcion" maxlength="35"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="descripcion_tropiezo" type="text"  ng-required="true">
                                    <ng-messages for="formTropiezo.descripcion_tropiezo.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe indicar un Nombre</ng-message>
                                        <ng-message when="pattern">El nombre deben ser caracteres</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>
                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Abreviatura</label>
                                    <input maxlength="5" ng-model="tropiezo.abreviatura" ng-required="true"  pattern="[a-zA-Z]+" type="text" name="abreviatura_tropiezo">
                                    <ng-messages for="formtropiezo.abreviatura_tropiezo.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe indicar una Abreviatura</ng-message>
                                        <ng-message when="pattern">No se permiten Caracteres especiales</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <md-button class="md-raised md-primary" ng-click="registrar_tropiezo(true)">Registrar</md-button>

                        <md-button  ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                    </div>
                </div>

            </div>
        </div>

        <!--MODAL DE EDICION-->
        <div id="modificar_tropiezo" class="modal fade" >
            <div class="modal-dialog modal-wide-md">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                        
                    </div>
                    <div class="modal-body">
                        <h2>Modificar Tropiezo</h2>

                        <form class="form-inline" name="formTropiezoM" role="form" novalidate>
                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Nombre</label>
                                    <input ng-model="tropiezo2.descripcion"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="descripcion_tropiezo" type="text"  ng-required="true">

                                </md-input-container>
                            </div>
                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Abreviatura</label>
                                    <input maxlength="5" ng-model="tropiezo2.abreviatura" ng-required="true"  pattern="[a-zA-Z]+" type="text" name="abreviatura_tropiezo">
                                    <ng-messages for="formTropiezoM.abreviatura_tropiezo.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe indicar un Nombre</ng-message>
                                        <ng-message when="pattern">El nombre deben ser caracteres</ng-message>  
                                    </ng-messages>

                                </md-input-container>
                            </div>

                            <div class="form-group">
                                <md-input-container flex>
                                    <label>Fecha de Registro</label>
                                    <input ng-model="tropiezo2.fecha_registro"   name="fecha_registro_tropiezo" disabled>                            
                                </md-input-container>
                            </div>

                            <div class="form-group">
                                <md-switch ng-model="tropiezo2.estatus">
                                    Activo
                                </md-switch>
                            </div>

                        </form>
                        <div class="modal-footer">
                                                        <md-button class="md-raised md-primary" ng-click="registrar_tropiezo(false)">Modificar</md-button>

                            <md-button ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>public/js/Administrador/Tropiezo.js"></script>










