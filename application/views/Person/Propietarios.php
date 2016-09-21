<div ng-controller="propietarios" layout="column" flex id="content">
    <div class="container" style="width:95%">
        <h1>Propietarios</h1>
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
                <md-button class="md-accent md-raised md-hue-2" ng-click="navigateTo('Person/personas/nuevo')">Crear</md-button>
            </div>

        </form>

        <div ng-show="contador != 0" tasty-table bind-resource-callback="getResource" bind-filters="paginador">
            <table class="table table-striped table-condensed" >
                <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                <tbody>
                    <tr ng-repeat="row in rows" class="centrado">

                        <td>{{ row.ID}}</td>
                        <td>{{ row.RIF}}</td>
                        <td>{{ row.Nombre}}</td>
                        <td>{{ row.Apellido}}</td>
                        <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi - action - highlight - remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-material-indigo btn-xs" href=""  ng-click="navigateTo('Person/jinetes/info')" data-toggle="modal" data-target="#modificar_pais"><span class="glyphicon glyphicon-search"></span></a>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
            <div tasty-pagination></div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>public/js/Person/Propietarios.js"></script>