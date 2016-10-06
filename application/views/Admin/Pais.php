
<div ng-controller="pais" layout="column" flex id="content">
    <div class="container" style="width:95%">
        <h1 >Paises</h1>

        <h3>Busqueda</h3>

            <form class="form-inline" name="formBusquedaPais" role="form" novalidate>
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
                    <md-button class="md-accent md-raised md-hue-2" data-toggle="modal" data-target="#nuevo_pais">Crear</md-button>
                </div>

            </form>




            <div ng-show="contador != 0" tasty-table bind-resource-callback="getResource" bind-filters="paginador">
                <table class="table table-striped table-condensed" >
                    <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                    <tbody>
                        <tr ng-repeat="row in rows" class="centrado">

                            <td>{{ row.Nombre}}</td>
                            <td>{{ row.Abreviatura}}</td>
                            <td>{{ row['Registrado']}}</td>                
                            <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-material-blue btn-xs" href=""  ng-click="getPais(row.Opciones)" data-toggle="modal" data-target="#modificar_pais"><span class="glyphicon glyphicon-search"></span></a>
                                </div>
                            </td>

                        </tr>
                    </tbody>
                </table>
                <div tasty-pagination></div>
            </div>

            <!--MODAL DE CREACION-->

            <div id="nuevo_pais" class="modal fade" role="dialog">
                <div class="modal-dialog">                
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nuevo Pais</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" name="formPais" role="form" novalidate>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Nombre</label>
                                        <input ng-model="pais.nombre"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="nombre_pais" type="text"  ng-required="true">
                                        <ng-messages for="formPais.nombre_pais.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Nombre</ng-message>
                                            <ng-message when="pattern">El nombre deben ser caracteres</ng-message>  
                                        </ng-messages>
                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Abreviatura</label>
                                        <input ng-model="pais.abreviatura" maxlength="3" ng-required="true"  pattern="[a-zA-Z]+" type="text" name="abreviatura_pais">
                                        <ng-messages for="formPais.abreviatura_pais.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar una Abreviatura</ng-message>
                                            <ng-message when="pattern">No se permiten Caracteres especiales</ng-message>  
                                        </ng-messages>
                                    </md-input-container>
                                </div>


                            </form>
                        </div>
                        <div class="modal-footer">


                            <md-button class="md-raised md-primary" ng-click="registrar_pais(true)">Registrar</md-button>
                            <md-button   ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                        </div>
                    </div>

                </div>
            </div>

            <!--MODAL DE EDICION-->
            <div id="modificar_pais" class="modal fade" >
                <div class="modal-dialog modal-wide-md">
                    <!-- Modal content-->
                    <div class="modal-content ">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modificar Pais</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" name="formPaisM" role="form" novalidate>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Nombre</label>
                                        <input ng-model="pais2.nombre"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="nombre_pais" type="text"  ng-required="true">

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Abreviatura</label>
                                        <input maxlength="3" ng-model="pais2.abreviatura" ng-required="true"  pattern="[a-zA-Z]+" type="text" name="abreviatura_pais">
                                        <ng-messages for="formPaisM.nombre_pais.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Nombre</ng-message>
                                            <ng-message when="pattern">El nombre deben ser caracteres</ng-message>  
                                        </ng-messages>

                                    </md-input-container>
                                </div>

                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Fecha de Registro</label>
                                        <input ng-model="pais2.fecha_registro"   name="fecha_registro_pais" disabled>                            
                                    </md-input-container>
                                </div>

                                <div class="form-group">
                                    <md-switch ng-model="pais2.estatus">
                                        Activo
                                    </md-switch>
                                </div>

                            </form>
                            <div class="modal-footer">
                                <md-button class="md-raised md-primary" ng-click="registrar_pais(false)">Modificar</md-button>

                                <md-button ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>public/js/Administrador/Pais.js"></script>










