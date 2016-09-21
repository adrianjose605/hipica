<div ng-controller="new_personas" layout="column" flex id="content">
    <div class="container" style="width:95%">
        <h1 >Personas<small> - Nueva Persona</small></h1>
        <md-card class="well">
            <form style="margin-bottom: 20px;">
                <legend>Datos Personales</legend>
                <div class="row">
                    <md-input-container class="col-md-3">
                        <label>Rif</label>
                        <input ng-model="formPersona.rif" type="text" required>
                    </md-input-container>
                    <md-select placeholder="Nacionalidad" ng-model="formPersona.nacionalidad" required>
                        <md-option value="ven">Venezolana</md-option>
                    </md-select>
                </div>
                <div class="row">
                    <md-input-container class="col-md-3">
                        <label>Primer Apellido</label>
                        <input ng-model="formPersona.primer_apellido" type="text" required>
                    </md-input-container>
                    <md-input-container class="col-md-3">
                        <label>Segundo Apellido</label>
                        <input ng-model="formPersona.segundo_apellido" type="text">
                    </md-input-container>
                    <md-input-container class="col-md-3">
                        <label>Primer Nombre</label>
                        <input ng-model="formPersona.primer_nombre" required>
                    </md-input-container>
                    <md-input-container class="col-md-3">
                        <label>Segundo Nombre</label>
                        <input ng-model="formPersona.segundo_nombre" type="text">
                    </md-input-container>
                </div>
                <legend>Datos de Participacion</legend>
                <div class="row">
                    <md-switch class="md-primary" md-no-ink aria-label="Switch No Ink" ng-model="formPersona.propietario">
                        Es Propietario?
                    </md-switch>
                </div>
                <div class="row">
                    <md-switch class="md-primary" md-no-ink aria-label="Switch No Ink" ng-model="formPersona.entrenador">
                        Es Entrenador?
                    </md-switch>
                </div>
                <div class="row">
                    <md-switch class="md-primary" md-no-ink aria-label="Switch No Ink" ng-model="formPersona.jinete">
                        Es Jinete?
                    </md-switch>
                    <div ng-show="formPersona.jinete">
                        <md-input-container class="col-md-3">
                            <label>Peso (Kg)</label>
                            <input required type="number" step="any" name="peso_jinete" ng-model="formPersona.jinete_peso">
                        </md-input-container>
                        <md-input-container class="col-md-3">
                            <label>Nivel</label>
                            <input required type="number" ng-model="formPersona.jinete_nivel">
                        </md-input-container>
                    </div>
                </div>
                <legend>Datos de Usuario</legend>
                <div class="row">
                    <md-switch class="md-primary" md-no-ink aria-label="Switch No Ink" ng-model="formPersona.usuario">
                        Es Usuario?
                    </md-switch>
                </div>
                <div ng-show="formPersona.usuario">
                <div class="row">
                    <md-input-container class="col-md-3"  >
                        <label>Login ID</label>
                        <input ng-model="formPersona.formUsuario.login" required>
                    </md-input-container>
                    <md-input-container class="col-md-3"  >
                        <label>Email</label>
                        <input ng-model="formPersona.formUsuario.email" required>
                    </md-input-container>
                    <md-input-container class="col-md-3"  >
                        <label>Clave</label>
                        <input ng-model="formPersona.formUsuario.clave" required>
                    </md-input-container>
                    <md-input-container class="col-md-3"  >
                        <label>Confirmar Clave</label>
                        <input ng-model="formPersona.formUsuario.clave2" required>
                    </md-input-container>
                </div>
                <legend  >Permisologia</legend>
                <md-select placeholder="Grupo de Usuario" ng-model="formPersona.grupo" required>
                    <md-option value="ven">Sistemas</md-option>
                </md-select>
                <p>*Permiosologia Personal</p>
                <table class="table table-condensed"  >
                    <thead>
                        <tr>
                            <th class="col-md-10">Permiso</th>
                            <th class="col-md-2" style="text-align:right">Opcion</th>
                        </tr>
                    </thead>
                    <tr>
                        <td style="text-align:left">Permiso 1</td>
                        <td style="text-align:center">
                    <md-switch class="md-primary pull-right" md-no-ink aria-label="Switch No Ink" ng-model="formUsuario.permiso1">
                    </md-switch>
                    </td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Permiso 2</td>
                        <td style="text-align:center">
                    <md-switch class="md-primary pull-right" md-no-ink aria-label="Switch No Ink" ng-model="formUsuario.permiso2">
                    </md-switch>
                    </td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Permiso 3</td>
                        <td style="text-align:center">
                    <md-switch class="md-primary pull-right" md-no-ink aria-label="Switch No Ink" ng-model="formUsuario.permiso3">
                    </md-switch>
                    </td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Permiso 4</td>
                        <td style="text-align:center">
                    <md-switch class="md-primary pull-right" md-no-ink aria-label="Switch No Ink" ng-model="formUsuario.permiso4">
                    </md-switch>
                    </td>
                    </tr>
                </table>
                </div>
                <div class="pull-right" layout="row" layout-align="end center">
                    <md-button class="md-primary md-button">Guardar</md-button>
                    <md-button class="md-warn md-button" ng-click="navigateTo('Person/personas')">Cancelar</md-button>
                </div>
            </form>
        </md-card>
    </div>
</div>

<script src="<?php echo base_url(); ?>public/js/Person/Personas.js"></script>