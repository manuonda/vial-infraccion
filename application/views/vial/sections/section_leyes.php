  <h3 class="form-section">Detalle de Leyes de Alcholemia </h3>
               <div class="row">
               <div class="col-md-3">
                <div class="form-group" >  
                <label class="control-label">Precio $  Valor Unidad</label>
                <input type="text" class="form-control requerido"  name="valor_unidad" readonly="true"
                    value="<?php  if(isset($configuracion)) echo $configuracion->valor; ?>">
                </div>
                </div>    
               </div>

                <div class="row" id="table_leyes">
                    <div class="col-md-12 col-sm-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    Listado</div>
                                <div class="actions">
                                 <button  type="button" onclick="moduleDetalleLey.agregarRow('tbodyDetalleInfraccion')"  class="btn btn-default btn-sm green">
                                    <i class="fa fa-plus"></i> Agregar
                                </button> 

                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tableDetalle">
                                    <thead>


                                    <th width="60"> Ley </th>
                                    <th width="60"> Artículo</th>
                                    <th width="60"> Inciso</th>
                                    <th width="30"> Unidades</th>
                                    <th width="30"> Texto</th>
                                    <th width="20"> Exhimido</th>
                                    <th width="20"> Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbodyDetalleInfraccion">
                                        <?php 
                                         if($detalleLeyes!=null && $detalleLeyes!=""):
                                           foreach ($detalleLeyes as $detalle) {
                                               echo $detalle ;
                                           }
                                         endif;
                                        ?>  
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>