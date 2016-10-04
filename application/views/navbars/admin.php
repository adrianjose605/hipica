<md-toolbar layout="row"  class="md-theme-indigo">
    <div class="md-toolbar-tools">
        <md-button ng-click="toggleSidenav('left')" class="md-icon-button">
            <span class="glyphicon glyphicon-align-justify"></span>
        </md-button>
        <h1>Hipica</h1>
    </div>
</md-toolbar>
<div layout="row" flex>
    <md-sidenav layout="column" class="md-sidenav-left md-whiteframe-z2" md-component-id="left">
        <md-content layout-padding="">
            <accordion close-others="oneAtATime">
                <accordion-group>
                    <accordion-heading>
                        <p><span class="glyphicon glyphicon-menu-down" style="margin-right: 10px;"></span> Configuracion</p>
                    </accordion-heading> 
                    <md-list class="listdemoListControls">
                    <h2 class="md-no-sticky md-subheader md-default-theme"><div class="md-subheader-inner"><span class="md-subheader-content"><span class="ng-scope">Localizacion y Pistas</span></span></div></h2>
                        <md-list-item ng-click="navigateTo('Admin/pais')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Paises</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/hipodromo')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Hipodromos</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/tipoUnidad')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Tipos de Unidad</p>
                        </md-list-item>  
                        <md-list-item ng-click="navigateTo('Admin/pista')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Pista</p>
                        </md-list-item> 
                        <md-list-item ng-click="navigateTo('Admin/tipoPista')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Tipo Pista</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/distancia')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Distancias</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/estadoPista')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Estados de Pista</p>
                        </md-list-item>
                    <md-divider class="md-default-theme"></md-divider>
                    <h2 class="md-no-sticky md-subheader md-default-theme"><div class="md-subheader-inner"><span class="md-subheader-content"><span class="ng-scope">Opciones de Carrera</span></span></div></h2>
                        <md-list-item ng-click="navigateTo('Admin/haras')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Haras</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/tropiezo')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Tropiezos</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/implemento')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Implementos</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/TipoImplemento')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span>Tipos de  Implementos</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/jugada')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Jugadas</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/tipoJugada')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Tipos de Jugadas</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/premio')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Premios</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/stud')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Studs</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/tipoComentario')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Tipos de Comentario</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/tipoCondicion')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Tipos de Condicion</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/condicion')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Condiciones</p>
                        </md-list-item>
                           <md-list-item ng-click="navigateTo('Admin/clasico')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Clasicos y Copas</p>
                        </md-list-item>
                        <md-divider class="md-default-theme"></md-divider>
                    <h2 class="md-no-sticky md-subheader md-default-theme"><div class="md-subheader-inner"><span class="md-subheader-content"><span class="ng-scope">Opciones de Ejemplar</span></span></div></h2>
                        <md-list-item ng-click="navigateTo('Admin/tipoOrigen')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Tipo Origen</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/tipoPelaje')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Tipo Pelaje</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Admin/ejemplar')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Ejemplares</p>
                        </md-list-item>
                    </md-list>
                    
                       
                    <md-divider class="md-default-theme"></md-divider>
                </accordion-group>
                <accordion-group>
                    <accordion-heading>
                        <p><span class="glyphicon glyphicon-menu-down" style="margin-right: 10px;"></span> Llamados</p>
                    </accordion-heading> 
                    <md-list class="listdemoListControls">
                        <md-list-item ng-click="navigateTo('bloque/preCarga')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Llamados</p>
                        </md-list-item>
                        </md-list>
                </accordion-group>
                <accordion-group>
                    <accordion-heading>
                        <p><span class="glyphicon glyphicon-menu-down" style="margin-right: 10px;"></span> Pronosticos</p>
                    </accordion-heading>
                    <md-list class="listdemoListControls">
                        <md-list-item ng-click="navigateTo('bloque/preCarga')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Llamados</p>
                        </md-list-item>
                        </md-list> 
                </accordion-group>
                <accordion-group>
                    <accordion-heading>
                        <p><span class="glyphicon glyphicon-menu-down" style="margin-right: 10px;"></span> Llegadas</p>
                    </accordion-heading> 
                    <md-list class="listdemoListControls">
                        <md-list-item ng-click="navigateTo('bloque/preCarga')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Llamados</p>
                        </md-list-item>
                        </md-list>
                </accordion-group>
                <accordion-group>
                    <accordion-heading>
                        <p><span class="glyphicon glyphicon-menu-down" style="margin-right: 10px;"></span> Usuarios</p>
                    </accordion-heading> 
                    <md-list class="listdemoListControls">
                        <md-list-item ng-click="navigateTo('Person/personas')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Gestion de Personas</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Person/jinetes')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Gestion de Jinetes</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Person/entrenadores')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Gestion de Entrenadores</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Person/propietarios')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Gestion de Propietarios</p>
                        </md-list-item>
                        <md-list-item ng-click="navigateTo('Person/usuarios')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Control de Usuarios</p>
                        </md-list-item>
                    </md-list>

                </accordion-group>
                
            </accordion>
        </md-content>
    </md-sidenav>