<div ng-controller="personas" layout="column" flex id="content">
    <div class="container" style="width:95%">
        <h1>Personas</h1>
        <h3>Busqueda</h3>

        <form class="row" name="formBusquedaPais" role="form" novalidate>

            <md-input-container flex class="col-md-4">
                <label>Nombre - Apellido - RIF</label>
                <input ng-model="busqueda.query" name="query_busqueda" type="text">                
            </md-input-container>            

            <md-button class="md-raised md-primary col-md-1" ng-click="recargar()">Buscar</md-button>


            <md-button class="md-accent md-raised col-md-1" ng-click="navigateTo('Person/personas/nuevo')">Crear</md-button>


        </form>

        <div ng-show="contador != 0" tasty-table bind-resource-callback="getResource" bind-filters="paginador">
            <table class="table table-striped table-condensed" >
                <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                <tbody>
                    <tr ng-repeat="row in rows" class="centrado">

                        <td>{{ row.ID}}</td>
                        <td>{{ row.Cedula}}</td>
                        <td>{{ row.Nombre}}</td>
                        <td>{{ row.Apellido}}</td>
                        <td><span class="glyphicon" ng-class="( (row.Usuario==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                        <td><span class="glyphicon" ng-class="( (row.Jinete==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                        <td><span class="glyphicon" ng-class="( (row.Propietario==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                        <td><span class="glyphicon" ng-class="( (row.Entrenador==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-material-blue btn-xs" href=""  ng-click="navigateTo('Person/personas/info')" data-toggle="modal" data-target="#modificar_pais"><span class="glyphicon glyphicon-search"></span></a>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
            <div tasty-pagination></div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>public/js/Person/Personas.js"></script>