<div class="container" ng-controller="tipopista" layout="column" flex id="content">
    <div class="container" style="width:95%">

<h1>Tipos de Pista</h1>
    <h3>Busqueda</h3>

        <form class="form-inline" name="formBusquedaTipoPista" role="form" novalidate>
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
        <md-button class="md-accent md-raised md-hue-2" data-toggle="modal" data-target="#nuevo_tipo_pista">Crear</md-button>
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
                        <a class="btn btn-material-blue btn-xs" href=""  ng-click="getTipoPista(row.Opciones)" data-toggle="modal" data-target="#edicion_tipo_pista"><span class="glyphicon glyphicon-search"></span></a>
                    </div>
                </td>

            </tr>
        </tbody>
    </table>
    <div tasty-pagination></div>
</div>






<!--MODAL DE CREACION-->

<div id="nuevo_tipo_pista" class="modal fade" role="dialog">
    <div class="modal-dialog">                
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevo Tipo de Pista</h4>
            </div>
            <div class="modal-body">                

                            <form class="form-inline" name="formTipoPista_crear" role="form" novalidate>

                    <div class="form-group">
                        <md-input-container flex>
                        <label>Descripcion</label>
                        <input maxlength="15" ng-model="tipopista.descripcion" ng-required="true"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" type="text" name="descripcion_c">
                        <ng-messages for="formTipoPista_crear.descripcion_c.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe indicar un Descripcion</ng-message>
                        <ng-message when="pattern">Solo deben ser caracteres</ng-message>  
                        <ng-message when="text">caracter invalido</ng-message>  
                    </ng-messages>

                </md-input-container>
            </div>        
            
        </form>
    </div>
    <div class="modal-footer">
        <md-button class="md-raised md-primary" ng-click="crear_pista(true)">Crear</md-button>
        <md-button ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
    </div>
</div>

</div>
</div>











<!--MODAL DE MODIFICACION-->

<div id="edicion_tipo_pista" class="modal fade" role="dialog">
    <div class="modal-dialog">                
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modificar Tipo de Pista</h4>
            </div>
            <div class="modal-body">                               

                <form class="form-inline" name="formTipoPista_modificar" role="form" novalidate>

                    <div class="form-group">
                        <md-input-container flex>
                        <label>Descripcion</label>
                        <input maxlength="15" ng-model="tipopista2.descripcion" ng-required="true"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" type="text" name="descripcion_c">
                        <ng-messages for="formTipoPista_modificar.descripcion_c.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe indicar un Descripcion</ng-message>
                        <ng-message when="pattern">Solo deben ser caracteres</ng-message>  
                        <ng-message when="text">caracter invalido</ng-message>  
                    </ng-messages>

                </md-input-container>


            </div>

            <div class="form-group">
                <md-switch ng-model="tipopista2.estatus">
                Activo
            </md-switch>
        </div>
       
    </form>
</div>
<div class="modal-footer">
<md-button class="md-raised md-primary" ng-click="crear_pista(false)">Modificar</md-button>
    <md-button ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
</div>
</div>

</div>
</div>


    </div>

</div>

<script src="<?php echo base_url(); ?>public/js/Administrador/TipoPista.js"></script>
