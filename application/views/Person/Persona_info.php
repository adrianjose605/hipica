<style>
    .tabsdemoDynamicHeight md-content {
        background-color: transparent !important; }
    .tabsdemoDynamicHeight md-content md-tabs {
        background: #f6f6f6;
        border: 1px solid #e1e1e1; }
    .tabsdemoDynamicHeight md-content md-tabs md-tabs-canvas {
        background: white; }
    .tabsdemoDynamicHeight md-content h1:first-child {
        margin-top: 0; }
    </style>


    <div ng-controller="info_persona" layout="column" flex id="content">
    <div class="container" style="width:95%">
        <md-card class="well">
            <h2>1 - Carlos J. Mendoza H.<small> - V20504015-0</small></h2>
            <div class="tabsdemoDynamicHeight">
                <md-content class="md-padding">
                    <md-tabs md-dynamic-height="" md-border-bottom="">
                        <md-tab label="Persona">
                            <md-content class="md-padding">
                                <h1 class="md-display-2">Datos Personales</h1>
                                <form style="margin-bottom: 20px;">
                                    <legend>Datos Personales</legend>
                                    <div class="row">
                                        <md-input-container class="col-md-3">
                                            <label>Rif</label>
                                            <input ng-model="formPersona.rif = 'V20504015-0'" type="text" required disabled>
                                        </md-input-container>
                                        <md-select placeholder="Nacionalidad" ng-model="formPersona.nacionalidad = 'ven'" required>
                                            <md-option value="ven" seleted>Venezolana</md-option>
                                        </md-select>
                                    </div>
                                    <div class="row">
                                        <md-input-container class="col-md-3">
                                            <label>Primer Apellido</label>
                                            <input ng-model="formPersona.primer_apellido = 'Mendoza'" type="text" required>
                                        </md-input-container>
                                        <md-input-container class="col-md-3">
                                            <label>Segundo Apellido</label>
                                            <input ng-model="formPersona.segundo_apellido = 'Hernandez'" type="text">
                                        </md-input-container>
                                        <md-input-container class="col-md-3">
                                            <label>Primer Nombre</label>
                                            <input ng-model="formPersona.primer_nombre = 'Carlos'" required>
                                        </md-input-container>
                                        <md-input-container class="col-md-3">
                                            <label>Segundo Nombre</label>
                                            <input ng-model="formPersona.segundo_nombre = 'Javier'" type="text">
                                        </md-input-container>
                                    </div>
                                    <div class="pull-right" layout="row" layout-align="end center">
                                        <md-button class="md-primary md-button">Guardar</md-button>
                                    </div>
                                </form>
                            </md-content>
                        </md-tab>
                        <md-tab label="Usuario">
                            <md-content class="md-padding">
                                <h1 class="md-display-2">Usuario</h1>
                                <div class="row">
                                    <md-input-container class="col-md-3">
                                        <label>Login ID</label>
                                        <input ng-model="formPersona.formUsuario.login = 'cmendoza'" required disabled>
                                    </md-input-container>
                                    <md-input-container class="col-md-3"  disabled>
                                        <label>Email</label>
                                        <input ng-model="formPersona.formUsuario.email = 'cmendoza@correo.com'" required >
                                    </md-input-container>
                                </div>
                                <legend>Cambiar Clave</legend>
                                <div class="row"> 
                                    <md-input-container class="col-md-3"  >
                                        <label>Clave</label>
                                        <input ng-model="formPersona.formUsuario.clave" required>
                                    </md-input-container>
                                    <md-input-container class="col-md-3"  >
                                        <label>Confirmar Clave</label>
                                        <input ng-model="formPersona.formUsuario.clave2" required>
                                    </md-input-container>
                                    <md-button class="md-primary md-button">Guardar</md-button>
                                </div>
                                <legend  >Permisologia</legend>
                                <md-select placeholder="Grupo de Usuario" ng-model="formPersona.grupo = 'sis'" required>
                                    <md-option value="sis">Sistemas</md-option>
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
                                    <md-switch class="md-primary pull-right" md-no-ink aria-label="Switch No Ink" ng-model="formUsuario.permiso2 = true">
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
                                    <md-switch class="md-primary pull-right" md-no-ink aria-label="Switch No Ink" ng-model="formUsuario.permiso4 = true">
                                    </md-switch>
                                    </td>
                                    </tr>
                                </table>
                                <div class="pull-right" layout="row" layout-align="end center">
                                    <md-button class="md-primary md-button">Guardar</md-button>
                                </div>
                            </md-content>
                        </md-tab>
                        <md-tab label="Jinete">
                            <md-content class="md-padding">
                                <h1 class="md-display-2">Jinete</h1>
                                <legend>Datos del jinete</legend>
                                <div class="row">
                                    <md-input-container class="col-md-3">
                                        <label>Peso (Kg)</label>
                                        <input required type="number" step="any" name="peso_jinete" ng-model="formPersona.jinete_peso = 90">
                                    </md-input-container>
                                    <md-input-container class="col-md-3">
                                        <label>Nivel</label>
                                        <input required type="number" ng-model="formPersona.jinete_nivel = 2">
                                    </md-input-container>
                                    <md-button class="md-primary md-button">Guardar</md-button>
                                </div>
                                <hr/>
                                <legend>Datos en competiciones</legend>
                                <md-grid-list
                                    md-cols-sm="1" md-cols-md="2" md-cols-gt-md="6"
                                    md-row-height-gt-md="1:1" md-row-height="2:2"
                                    md-gutter="12px" md-gutter-gt-sm="8px" >
                                    <md-grid-tile style="background: rgb(255,64,129);" md-rowspan="1" md-colspan="1">
                                        <p class="md-display-1" style="color: white;">999</p>
                                        <md-grid-tile-footer>
                                            <h3>Participaciones</h3>
                                        </md-grid-tile-footer>
                                    </md-grid-tile>
                                    <md-grid-tile style="background: rgb(63,81,181);" md-rowspan="1" md-colspan="1">
                                        <p class="md-display-1" style="color: white;">999</p>
                                        <md-grid-tile-footer>
                                            <h3>Victorias</h3>
                                        </md-grid-tile-footer>
                                    </md-grid-tile>
                                    <md-grid-tile style="background: #259b24;" md-rowspan="1" md-colspan="2">
                                        <p class="md-display-1" style="color: white;">99,999,999.99 Bs</p>
                                        <md-grid-tile-footer>
                                            <h3>Acumulado Actual</h3>
                                        </md-grid-tile-footer>
                                    </md-grid-tile>
                                    <md-grid-tile style="background: #26c6da;" md-rowspan="1" md-colspan="2">
                                        <ul class="list-group" style="width: 95%; color: white">
                                            <li class="list-group-item" style=" margin-bottom: 5px;">
                                                <span class="badge">14</span>
                                                1°
                                            </li>
                                            <li class="list-group-item" style=" margin-bottom: 5px;">
                                                <span class="badge">14</span>
                                                2°
                                            </li>
                                            <li class="list-group-item" style=" margin-bottom: 5px;">
                                                <span class="badge">14</span>
                                                3°
                                            </li>
                                            <li class="list-group-item" style=" margin-bottom: 5px;">
                                                <span class="badge">14</span>
                                                4° o mas
                                            </li>
                                        </ul>
                                        <md-grid-tile-footer>
                                            <h3>Estadistica de Posiciones</h3>
                                        </md-grid-tile-footer>
                                    </md-grid-tile>
                                </md-grid-list>
                                <div class="alert alert-info" role="alert" style="margin-top:10px;">Ultimas 5 Carreras</div>
                                <table class="table table-condensed" style="width:'95%'">
                                    <thead>
                                        <tr>
                                            <th>Fech</th>
                                            <th>Car</th>
                                            <th>Pes</th>
                                            <th>Ejem</th>
                                            <th>Pes.Ej</th>
                                            <th>Dist</th>
                                            <th>PP</th>
                                            <th>Pos</th>
                                            <th>LL</th>
                                            <th>Div</th>
                                            <th>Gana</th>
                                            <th>Serie</th>
                                            <th>Rat</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td style="text-align:left">31/12</td>
                                        <td style="text-align:left">C12</td>
                                        <td style="text-align:left">87</td>
                                        <td style="text-align:left">E12-NombreE</td>
                                        <td style="text-align:left">450</td>
                                        <td style="text-align:left">1100</td>
                                        <td style="text-align:left">7</td>
                                        <td style="text-align:left">7</td>
                                        <td style="text-align:left">5</td>
                                        <td style="text-align:left">45</td>
                                        <td style="text-align:left">E12-P15</td>
                                        <td style="text-align:left">G1-4a</td>
                                        <td style="text-align:left">71</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left">31/12</td>
                                        <td style="text-align:left">C12</td>
                                        <td style="text-align:left">87</td>
                                        <td style="text-align:left">E12-NombreE</td>
                                        <td style="text-align:left">450</td>
                                        <td style="text-align:left">1100</td>
                                        <td style="text-align:left">7</td>
                                        <td style="text-align:left">7</td>
                                        <td style="text-align:left">5</td>
                                        <td style="text-align:left">45</td>
                                        <td style="text-align:left">E12-P15</td>
                                        <td style="text-align:left">G1-4a</td>
                                        <td style="text-align:left">71</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left">31/12</td>
                                        <td style="text-align:left">C12</td>
                                        <td style="text-align:left">87</td>
                                        <td style="text-align:left">E12-NombreE</td>
                                        <td style="text-align:left">450</td>
                                        <td style="text-align:left">1100</td>
                                        <td style="text-align:left">7</td>
                                        <td style="text-align:left">7</td>
                                        <td style="text-align:left">5</td>
                                        <td style="text-align:left">45</td>
                                        <td style="text-align:left">E12-P15</td>
                                        <td style="text-align:left">G1-4a</td>
                                        <td style="text-align:left">71</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left">31/12</td>
                                        <td style="text-align:left">C12</td>
                                        <td style="text-align:left">87</td>
                                        <td style="text-align:left">E12-NombreE</td>
                                        <td style="text-align:left">450</td>
                                        <td style="text-align:left">1100</td>
                                        <td style="text-align:left">7</td>
                                        <td style="text-align:left">7</td>
                                        <td style="text-align:left">5</td>
                                        <td style="text-align:left">45</td>
                                        <td style="text-align:left">E12-P15</td>
                                        <td style="text-align:left">G1-4a</td>
                                        <td style="text-align:left">71</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left">31/12</td>
                                        <td style="text-align:left">C12</td>
                                        <td style="text-align:left">87</td>
                                        <td style="text-align:left">E12-NombreE</td>
                                        <td style="text-align:left">450</td>
                                        <td style="text-align:left">1100</td>
                                        <td style="text-align:left">7</td>
                                        <td style="text-align:left">7</td>
                                        <td style="text-align:left">5</td>
                                        <td style="text-align:left">45</td>
                                        <td style="text-align:left">E12-P15</td>
                                        <td style="text-align:left">G1-4a</td>
                                        <td style="text-align:left">71</td>
                                    </tr>
                                </table>
                                <div class="alert alert-info" role="alert" style="margin-top:10px;">Proximas Carreras</div>
                                <table class="table table-condensed" style="width:'95%'">
                                    <thead>
                                        <tr>
                                            <th>Fech</th>
                                            <th>Hora</th>
                                            <th>Car</th>
                                            <th>Ejem</th>
                                            <th>Pes.Ej</th>
                                            <th>Dist</th>
                                            <th>PP</th>
                                            <th>LL</th>
                                            <th>Div</th>
                                            <th>Serie</th>
                                            <th>Rat</th>
                                            <th>Premio</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td style="text-align:left">31/12</td>
                                        <td style="text-align:left">8:00am</td>
                                        <td style="text-align:left">C150</td>
                                        <td style="text-align:left">E15-Nombre E</td>
                                        <td style="text-align:left">450</td>
                                        <td style="text-align:left">1200</td>
                                        <td style="text-align:left">12</td>
                                        <td style="text-align:left">6</td>
                                        <td style="text-align:left">45</td>
                                        <td style="text-align:left">G6-A5</td>
                                        <td style="text-align:left">70</td>
                                        <td style="text-align:left">150,000.00</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left">31/12</td>
                                        <td style="text-align:left">8:00am</td>
                                        <td style="text-align:left">C150</td>
                                        <td style="text-align:left">E15-Nombre E</td>
                                        <td style="text-align:left">450</td>
                                        <td style="text-align:left">1200</td>
                                        <td style="text-align:left">12</td>
                                        <td style="text-align:left">6</td>
                                        <td style="text-align:left">45</td>
                                        <td style="text-align:left">G6-A5</td>
                                        <td style="text-align:left">70</td>
                                        <td style="text-align:left">150,000.00</td>
                                    </tr>
                                </table>

                            </md-content>
                        </md-tab>
                        <md-tab label="Propietario">
                            <md-content class="md-padding">
                                <h1 class="md-display-2">Propietario</h1>
                                <div class="alert alert-info" role="alert" style="margin-top:10px;">Studs Asociados</div>
                                <table class="table table-condensed" style="width:'95%'">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Colores</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left">1</td>
                                            <td style="text-align:left">Stud el campito</td>
                                            <td style="text-align:left">Amarillo / Azul</td>
                                            <td style="text-align:left"><span class="mdi-action-done"></span></td>
                                            <td style="text-align:left">
                                                <div class="btn-group">
                                                    <a class="btn btn-material-indigo btn-xs" href=""  ng-click="navigateTo('Person/personas/info')" data-toggle="modal" data-target="#modificar_pais"><span class="glyphicon glyphicon-search"></span></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </md-content>
                        </md-tab>
                        <md-tab label="Entrenador">
                            <md-content class="md-padding">
                                <h1 class="md-display-2">Entrenador</h1>
                                <p>Integer turpis erat, porttitor vitae mi faucibus, laoreet interdum tellus. Curabitur posuere molestie dictum. Morbi eget congue risus, quis rhoncus quam. Suspendisse vitae hendrerit erat, at posuere mi. Cras eu fermentum nunc. Sed id ante eu orci commodo volutpat non ac est. Praesent ligula diam, congue eu enim scelerisque, finibus commodo lectus.</p>
                            </md-content>
                        </md-tab>
                    </md-tabs>
                </md-content>
            </div>
        </md-card>
    </div>
</div>
<script src="<?php echo base_url(); ?>public/js/Person/Personas.js"></script>