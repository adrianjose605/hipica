<div class="container" ng-controller="clasico" layout="column" flex id="content">
    <div class="container" style="width:95%">
        <h1>Clasicos</h1>
        <h3>Busqueda</h3>


            <form class="form-inline" name="formBusquedaClasico" role="form" novalidate>
                <div class="form-group">
                    <md-input-container flex>
                        <label>Nombre</label>
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
                        <td>{{ row.Nombre}}</td>

                        <td>{{ row.Ponderacion}}</td>
                        <td>{{ row.Hipodromo}}</td>                        
                        <td>{{ row.Grado=='1' ? 'Cl':'Cp'}}</td>                
                        <td>{{ row.Patrocinador}}</td>                        
                        
                        <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-material-blue btn-xs" href="" ng-click="get(row.Opciones)" data-toggle="modal" data-target="#edicion"><span class="glyphicon glyphicon-search"></span></a>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
            <div tasty-pagination></div>
        </div>




            <!--CREACION-->

            <div id="nuevo" class="modal fade" role="dialog">
                <div class="modal-dialog">                
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nuevo Clasico</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" name="crear" role="form" novalidate>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Nombre</label>
                                        <input name="descripcion" ng-model="obj.descripcion"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$"  type="text"  required>
                                        <ng-messages for="crear.descripcion.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Nombre</ng-message>
                                            <ng-message when="pattern">El nombre deben ser caracteres</ng-message>  
                                        </ng-messages>
                                    </md-input-container>
                                </div>

                                <div class="form-group">
				                    <md-input-container flex>
                    					<label>Pais</label>
                        				<md-select name="paises" md-on-open="cargarPaises()" placeholder="Pais" ng-model="obj.pais" required>
                            				<md-option ng-repeat="tcon in paises" ng-value="tcon.id">{{tcon.val}}</md-option>
                        				</md-select>
                        				<ng-messages for="crear.paises.$error" role="alert" ng-if="submitted">
                            				<ng-message when="required">Debe seleccionar un Pais</ng-message>                        
                        				</ng-messages>

                    				</md-input-container>
            					</div> 


                				<div class="form-group">
                    				<md-input-container flex>
                    					<label>Hipodromo</label>
                        				<md-select name="hipodromos" md-on-open="cargarHipodromos(obj.pais)" placeholder="Hipodromo" ng-model="obj.hipodromo"  required>      
                            				<md-option ng-repeat="tcon in hipodromos" ng-value="tcon.id">{{tcon.val}}</md-option>
                        				</md-select>
                        				<ng-messages for="crear.hipodromos.$error" role="alert" ng-if="submitted">
                            				<ng-message when="required">Debe seleccionar un hipodromo</ng-message>                        
                        				</ng-messages>
                    				</md-input-container>
            					</div> 

            					<div class="form-group">
                                    <md-input-container flex>
                                        <label>Patrocinador</label>
                                        <input ng-model="obj.patrocinador"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="patrocinador" type="text">
                                        <ng-messages for="crear.patrocinador.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Patrocinador</ng-message>
                                            <ng-message when="pattern">El nombre deben ser caracteres</ng-message>  
                                        </ng-messages>
                                    </md-input-container>
                                </div>

                                <div class="form-group">
                                <md-input-container flex>
                                    <label>Ponderacion</label>
                                    <input ng-model="obj.pond" maxlength="15"  pattern="-?[0-9]+" name="pond" type="text"  ng-required="true">
                                    <ng-messages for="crear.pond.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe indicar una Ponderacion</ng-message>
                                        <ng-message when="pattern">La ponderacion deben er valores enteros</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>

                            	<p>Tipo:
                                <md-radio-group ng-model="obj.grado">
      								<md-radio-button value="1" class="md-primary">Clasico</md-radio-button>
      								<md-radio-button value="0">Copa</md-radio-button>      								
    							</md-radio-group>

                                


                            </form>
                        </div>
                        <div class="modal-footer">


                            <md-button class="md-raised md-primary" ng-click="creacion(true);">Registrar</md-button>
                            <md-button   ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                        </div>
                    </div>

                </div>
            </div>












            <div id="edicion" class="modal fade" >
                <div class="modal-dialog modal-wide-md">
                    <!-- Modal content-->
                    <div class="modal-content ">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modificar Pais</h4>
                        </div>
                        <div class="modal-body">
                        <form class="form-inline" name="modificar" role="form" novalidate>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Nombre</label>
                                        <input name="descripcion" ng-model="obj2.descripcion"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$"  type="text"  required>
                                        <ng-messages for="modificar.descripcion.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Nombre</ng-message>
                                            <ng-message when="pattern">El nombre deben ser caracteres</ng-message>  
                                        </ng-messages>
                                    </md-input-container>
                                </div>

                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Pais</label>
                                        <md-select name="paises" md-on-open="cargarPaises()" placeholder="Pais" ng-model="obj2.pais" required>
                                            <md-option ng-repeat="tcon in paises" ng-value="tcon.id">{{tcon.val}}</md-option>
                                        </md-select>
                                        <ng-messages for="modificar.paises.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe seleccionar un Pais</ng-message>                        
                                        </ng-messages>

                                    </md-input-container>
                                </div> 


                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Hipodromo</label>
                                        <md-select name="hipodromos" md-on-open="cargarHipodromos(obj2.pais)" placeholder="Hipodromo" ng-model="obj2.hipodromo"  required>      
                                            <md-option ng-repeat="tcon in hipodromos" ng-value="tcon.id">{{tcon.val}}</md-option>
                                        </md-select>
                                        <ng-messages for="modificar.hipodromos.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe seleccionar un hipodromo</ng-message>                        
                                        </ng-messages>
                                    </md-input-container>
                                </div> 

                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Patrocinador</label>
                                        <input ng-model="obj2.patrocinador"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="patrocinador" type="text">
                                        <ng-messages for="modificar.patrocinador.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Patrocinador</ng-message>
                                            <ng-message when="pattern">El nombre deben ser caracteres</ng-message>  
                                        </ng-messages>
                                    </md-input-container>
                                </div>

                                <div class="form-group">
                                <md-input-container flex>
                                    <label>Ponderacion</label>
                                    <input ng-model="obj2.pond" maxlength="15"  pattern="-?[0-9]+" name="pond" type="text"  ng-required="true">
                                    <ng-messages for="modificar.pond.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe indicar una Ponderacion</ng-message>
                                        <ng-message when="pattern">La ponderacion deben er valores enteros</ng-message>  
                                    </ng-messages>
                                </md-input-container>
                            </div>

                                <p>Tipo:
                                <md-radio-group ng-model="obj2.grado">
                                    <md-radio-button value="1" class="md-primary">Clasico</md-radio-button>
                                    <md-radio-button value="0">Copa</md-radio-button>                                   
                                </md-radio-group>


                                <div class="form-group">
                                    <md-switch ng-model="obj2.estatus">
                                        Activo
                                    </md-switch>
                                </div>

                                


                            </form>

                            
                            <div class="modal-footer">
                                <md-button class="md-raised md-primary" ng-click="creacion(false)">Modificar</md-button>

                                <md-button ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>









</div>

<script src="public/js/Administrador/Clasico.js"></script>
