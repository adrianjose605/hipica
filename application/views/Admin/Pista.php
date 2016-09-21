<div class="container" ng-controller="pista"layout="column" flex id="content">
    <div class="container" style="width:95%">

        <h1>Pistas</h1>
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
                <td>{{ row.Tipo}}</td>                        
                <td>{{ row.Hipodromo}}</td>                
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


<div id="nuevo" class="modal fade" role="dialog">x
    <div class="modal-dialog">                
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nueva Pista</h4>
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
            <md-select name="tipos" md-on-open="cargarTipos()" placeholder="Tipo de Pista" ng-model="obj.tipo" required>      
            <md-option ng-repeat="tcon in spaices" ng-value="tcon.id">{{tcon.val}}</md-option>
        </md-select>
        <ng-messages for="crear.tipos.$error" role="alert" ng-if="submitted">
        <ng-message when="required">Debe seleccionar Tipo de Pista</ng-message>                        
    </ng-messages>
</md-input-container>
</div> 

<div class="form-group">
    <md-input-container flex>
    <md-select name="hipos" md-on-open="cargarHipos()" placeholder="Hipodromo" ng-model="obj.hipodromo" required>      
    <md-option ng-repeat="tcon in hipos" ng-value="tcon.id">{{tcon.val}}</md-option>
</md-select>
<ng-messages for="crear.hipos.$error" role="alert" ng-if="submitted">
<ng-message when="required">Debe seleccionar un Hipodromo</ng-message>                        
</ng-messages>
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
                <h4 class="modal-title">Modificar Pista</h4>
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
            <md-select name="tipos" md-on-open="cargarTipos()" placeholder="Tipo de Pista" ng-model="obj2.tipo" required>      
            <md-option ng-repeat="tcon in spaices" ng-value="tcon.id">{{tcon.val}}</md-option>
        </md-select>
        <ng-messages for="modificar.tipos.$error" role="alert" ng-if="submitted">
        <ng-message when="required">Debe seleccionar Tipo de Pista</ng-message>                        
    </ng-messages>
</md-input-container>
</div> 

<div class="form-group">
    <md-input-container flex>
    <md-select name="hipos" md-on-open="cargarHipos()" placeholder="Hipodromo" ng-model="obj2.hipodromo" required>      
    <md-option ng-repeat="tcon in hipos" ng-value="tcon.id">{{tcon.val}}</md-option>
</md-select>
<ng-messages for="modificar.hipos.$error" role="alert" ng-if="submitted">
<ng-message when="required">Debe seleccionar un Hipodromo</ng-message>                        
</ng-messages>
</md-input-container>
</div> 


<div class="form-group">
    <md-switch ng-model="obj2.estatus">
    Activo
</md-switch>
</div>
<h2 class="md-title"><code>Distancias Asociadas</code></h2>
<md-chips ng-model="distancias" md-autocomplete-snap md-require-match   >
<md-autocomplete
md-selected-item="participante.selectedItem"
md-search-text="participante.searchText"
md-items="item in distanciasSearch(participante.searchText)"
md-item-text="item.name"
placeholder="Distancias">
<span md-highlight-text="participante.searchText">{{item.distancia}} </span>
</md-autocomplete>
<md-chip-template >
<span>
  <strong>{{$chip.distancia}}</strong>
  <em>({{$chip.distancia}})</em>
</span>
</md-chip-template>
</md-chips>

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

<script src="<?php echo base_url(); ?>public/js/Administrador/Pista.js"></script>
