<div class="container" ng-controller="implemento" layout="column" flex id="content">
    <div class="container" style="width:95%">

    <h1>Implementos</h1>
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
                <td>{{ row.Tipo}}</td>
                <td>{{ row.Registrado}}</td>                
                <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
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
                <h4 class="modal-title">Nuevo Implemento</h4>
            </div>
            <div class="modal-body">                

                <form class="form-inline" name="crear" role="form" novalidate>
                 <div class="form-group">
                    <md-input-container flex>
                    <label>Descripcion</label>
                    <input ng-model="obj.descripcion" maxlength="15"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="nombre_pais" type="text"  ng-required="true">
                    <ng-messages for="crear.nombre_pais.$error" role="alert" ng-if="submitted">
                    <ng-message when="required">Debe indicar una Descripcion</ng-message>
                    <ng-message when="pattern">La Descripcion deben ser caracteres</ng-message>  
                </ng-messages>
            </md-input-container>
        </div>




        <div class="form-group">
            <md-input-container flex>
            <label>Abreviatura</label>
            <input ng-model="obj.abreviatura" maxlength="3"  pattern="[a-zA-Z.-]+" name="abre" type="text"  ng-required="true">
            <ng-messages for="crear.abre.$error" role="alert" ng-if="submitted">
            <ng-message when="required">Debe indicar una Abreviatura</ng-message>
            <ng-message when="pattern">La Abreviatura deben ser caracteres</ng-message>  
        </ng-messages>
    </md-input-container>
</div>




<div class="form-group">

    <md-input-container flex>

    <md-select name="tipos" md-on-open="cargarTipos()" placeholder="Tipo de Implemento" ng-model="obj.tipo" required>      
    <md-option ng-repeat="tcon in tcondicion" ng-value="tcon.id">{{tcon.val}}</md-option>
</md-select>
<ng-messages for="crear.tipos.$error" role="alert" ng-if="submitted">
<ng-message when="required">Debe seleccionar un tipo de Implemento</ng-message>                        
</ng-messages>

</md-input-container>



</div> 

<div class="form-group">
    <md-switch ng-model="obj.defecto">
    Por Defecto
</md-switch>
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
                <h4 class="modal-title">Modificar Implemento</h4>
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
            <label>Abreviatura</label>
            <input ng-model="obj2.abreviatura" maxlength="3"  pattern="[a-zA-Z.-]+" name="abre" type="text"  ng-required="true">
            <ng-messages for="modificar.abre.$error" role="alert" ng-if="submitted">
            <ng-message when="required">Debe indicar una Abreviatura</ng-message>
            <ng-message when="pattern">La Abreviatura deben ser caracteres</ng-message>  
        </ng-messages>
    </md-input-container>
</div>





<div class="form-group">

    <md-input-container flex>

    <md-select name="tipos" md-on-open="cargarTipos()" placeholder="Tipo de Implemento" ng-model="obj2.tipo" required>      
    <md-option ng-repeat="tcon in tcondicion"  ng-value="tcon.id" >{{tcon.val}}</md-option>
</md-select>
<ng-messages for="modificar.tipos.$error" role="alert" ng-if="submitted">
<ng-message when="required">Debe seleccionar un tipo de Implemento</ng-message>                        
</ng-messages>

</md-input-container>



</div> 

<div class="form-group">
    <md-switch ng-model="obj2.defecto">
    Por Defecto
</md-switch>
</div> 

<div class="form-group">
    <md-switch ng-model="obj2.estatus">
    Activo
</md-switch>
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

<script src="<?php echo base_url(); ?>public/js/Administrador/Implemento.js"></script>
