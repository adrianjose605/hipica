<div  ng-controller="preCarga" layout="column" flex id="content">
    <div class="container" style="width:95%">
        <h1>Llamados</h1>
    </div>

    <form target="_blank" method="post" action="bloque/nuevaCarrera" class="form-inline container" name="formPrecarga" role="form" novalidate>
        

        <div layout="row" layout-wrap>
            <div class="form-group" flex='20'>
                <md-input-container flex>
                    <label>Fecha de Carrera</label>
                    <input ng-model="obj.fecha_carrera"  ng-change="recargar();"name="fecha" type="text" date-time required="true" format="DD-MM-YYYY" max-view="year" min-view="date" ng-required="true" auto-close="true">
                    <ng-messages for="formPrecarga.fecha.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe indicar una Fecha</ng-message>
                            <ng-message when="pattern">La Fecha deben ser caracteres</ng-message>  
                        </ng-messages>
                </md-input-container>
            </div>
            <input type='hidden' value="{{obj.pais}}" name='pais'/>
            <div class="form-group" flex="10">
                <md-input-container flex>
                    <label>Pais</label>
                    <md-select name="paises" id="paises"  ng-change="recargar();"  md-on-open="cargarPaises()" placeholder="Pais" ng-model="obj.pais" required>                                  
                        <md-option ng-repeat="tcon in paises" ng-value="tcon.id">{{tcon.val}}</md-option>
                    </md-select>
                    <ng-messages for="formPrecarga.paises.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe seleccionar un Pais</ng-message>                        
                    </ng-messages>

                </md-input-container>
            </div> 
            <input type='hidden' value="{{obj.hipodromo}}" name='hipodromo'/>

            <div class="form-group" flex="15">
                <md-input-container flex>
                <label>Hipodromo</label>

                    <md-select name="hipodromos" ng-change="recargar();" md-on-open="cargarHipodromos()" placeholder="Hipodromo" ng-model="obj.hipodromo"  required>      
                        <md-option ng-repeat="tcon in hipodromos" ng-value="tcon.id">{{tcon.val}}</md-option>
                    </md-select>
                    <ng-messages for="formPrecarga.hipodromos.$error" role="alert" ng-if="submitted">
                        <ng-message when="required">Debe seleccionar un hipodromo</ng-message>                        
                    </ng-messages>

                </md-input-container>
            </div> 


            <div layout-gt-sm="row">
            <div class="form-group" flex='20'>
                <md-switch ng-model="obj.revisado" ng-change="recargar();">
                    Revisadas
                </md-switch>
            </div>

               
        </div>



  
    
        <md-button type="submit" class="md-raised md-primary"  flex="15">Registrar Nuevo</md-button>
        <md-button  class="md-raised md-warn" ng-click="recargar();" flex="10">Buscar</md-button>
        
    
    

           </form>


           

           <div style="margin-top:70px;" class="container" ng-show="contador != 0" tasty-table bind-resource-callback="getResource" bind-filters="paginador">
    <table class="table table-striped table-condensed " >
        <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
        <tbody>
            <tr ng-repeat="row in rows" class="centrado">                
                <td>{{ row['Hipodromo-Anual']}}</td>
                <td>{{ row.Pista}}</td>                        
                <td>{{ row.Distancia}}</td>
                <td>{{ row['Fecha-Hora']}}</td>
                <td>{{ row.Participantes}}</td>                

                
                <td>
                <form target="_blank" method="post" action="bloque/nuevaCarrera" name='da'>

                <md-button class="md-accent md-raised md-hue-2" type="submit" name='valor'>Editar</md-button>
                <input type='hidden' value="{{row.Opciones}}" name='id'/>
                </form>

                </td>


                <td><md-switch ng-model="row.valor"  ng-change="showConfirm($event,row)" ng-init="row.valor=row.Revisado=='1'  ">
                    
                </md-switch></td>                

            </tr>
        </tbody>
    </table>
    <div tasty-pagination></div>
</div>

    </div>

<script src="<?php echo base_url(); ?>public/js/bloque/Precarga.js"></script>
