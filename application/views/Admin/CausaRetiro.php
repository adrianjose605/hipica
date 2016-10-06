<div class="container" ng-controller="causaretiro" layout="column" flex id="content">
    <div class="container" style="width:95%">
        <h1>Causas de Retiro</h1>
        <h3>Busqueda</h3>

            <form class="form-inline" name="formBusquedaCausaRetiro" role="form" novalidate>
                <div class="form-group">
                    <md-input-container flex>
                        <label>Descripcion</label>
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
                    <md-button class="md-accent md-raised md-hue-2" data-toggle="modal" data-target="#nuevo_causa_retiro">Crear</md-button>
                </div>
            </form>

            <div ng-show="contador != 0" tasty-table bind-resource-callback="getResource" bind-filters="paginador">
                <table class="table table-striped table-condensed" >
                    <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                    <tbody>
                        <tr ng-repeat="row in rows" class="centrado">

                            <td>{{ row.Descripcion}}</td>                                                             
                            <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-material-blue btn-xs" href=""  ng-click="getCausaRetiro(row.Opciones)" data-toggle="modal" data-target="#edicion"><span class="glyphicon glyphicon-search"></span></a>
                                </div>
                            </td>




                            <div ng-show="contador != 0" tasty-table bind-resource-callback="getResource" bind-filters="paginador">
                <table class="table table-striped table-condensed" >
                    <tbody>
                        <tr ng-repeat="row in rows" class="centrado">

                            <td>{{ row.Descripcion}}</td>                                                             
                            <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-material-blue btn-xs" href=""  ng-click="getCausaRetiro(row.Opciones)" data-toggle="modal" data-target="#edicion"><span class="glyphicon glyphicon-search"></span></a>
                                </div>
                            </td>



                        </tr>
                    </tbody>
                </table>
                <div tasty-pagination></div>
            </div>



                        </tr>
                    </tbody>
                </table>
            </div>














            <!--MODAL DE CREACION-->

            <div id="nuevo_causa_retiro" class="modal fade" role="dialog">
                <div class="modal-dialog">                
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nueva Causa de Retiro</h4>
                        </div>
                        <div class="modal-body">                


                            <form class="form-inline" name="formcausaRetiro_crear" role="form" novalidate>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Descripcion</label>
                                        <input maxlength="15" ng-model="causaretiro.descripcion" ng-required="true"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" type="text" name="descripcion_c">
                                        <ng-messages for="formcausaRetiro_crear.descripcion_c.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Descripcion</ng-message>
                                            <ng-message when="pattern">Solo deben ser caracteres</ng-message>  			
                                        </ng-messages>
                                    </md-input-container>
                                </div>        

                            </form>


                        </div>
                        <div class="modal-footer">
                            <md-button class="md-raised md-primary" ng-click="crear_causa_retiro(true)">Crear</md-button>
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
                            <h4 class="modal-title">Modificar Causa de Retiro</h4>
                        </div>
                        <div class="modal-body">                               

                            <form class="form-inline" name="formcausaRetiro_modificar" role="form" novalidate>

                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Descripcion</label>
                                        <input maxlength="15" ng-model="causaretiro2.descripcion" ng-required="true"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" type="text" name="descripcion_c">
                                        <ng-messages for="formcausaRetiro_modificar.descripcion_c.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Descripcion</ng-message>
                                            <ng-message when="pattern">Solo deben ser caracteres</ng-message>  
                                            <ng-message when="text">caracter invalido</ng-message>  
                                        </ng-messages>

                                    </md-input-container>


                                </div>

                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Fecha de Registro</label>
                                        <input ng-model="causaretiro2.fecha_registro"   name="fecha_registro_pais" disabled>                            
                                    </md-input-container>
                                </div>

                                <div class="form-group">
                                    <md-switch ng-model="causaretiro2.estatus">
                                        Activo
                                    </md-switch>
                                </div>



                            </form>
                        </div>
                        <div class="modal-footer">
                            <md-button class="md-raised md-primary" ng-click="crear_causa_retiro(false)">Modificar</md-button>
                            <md-button ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                        </div>
                    </div>

                </div>
            </div>

    </div>






</div>

<script src="public/js/Administrador/CausaRetiro.js"></script>
