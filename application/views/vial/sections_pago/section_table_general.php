 <div class="col-md-6 col-sm-6">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">Listado de Leyes Generales</div>  
                        </div>
                        <div class="portlet-body">
                            <table  id="tabla-cuotas" class="table table-striped table-bordered table-hover table-checkable order-column" 
                                    id=" tableDetalle">
                                <thead>
                                <th width="150"> Ley</th>
                                <th width="150"> Articulo</th>
                                <th width="80"> Inciso </th>
                                <th width="25"> Unidad </th>
                                </thead>
                                <tbody id="detalle">
                                <?php if($leyesGeneral !=null ): ?>
                                <?php foreach($leyesGeneral as $row): ?>
  
                                    <tr class="odd gradeX">
                                        <td width="150"><?php echo $row->nombre; ?> </td>
                                        <td width="150"><?php echo $row->nombreArticulo ;?></td>
                                        <td width="80"><?php echo $row->nombreInciso;?></td>
                                        <td width="25"><?php echo $row->unidad; ?></td>
                                    </tr>
                                   <?php endforeach;?>
                                 <?php endif; ?>  
                                 </tbody>
                                <tfoot>
                                <tr>
                                <th></th>
                                <th></th>
                                <th scope="row">Total de Unidades</th>
                                <td><?php echo $cant_unidad_general; ?></td>
                                </tr>
                                <!--
                                <tr>
                                <th></th>
                                <th></th>
                                <th scope="row">Valor Unidad x Total Unidades : </th>
                                <td><div class="text-center">$<?php echo $importe_general;?></div></td>
                                </tr>
                            -->
                                </tfoot>
                            
                            </table>
                            
                              
                        </div>
                    </div>
                </div>