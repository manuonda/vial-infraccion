 <div class="col-md-6 col-sm-6">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">Listado de Ley de Alcoholemia</div>  
                        </div>
                        <div class="portlet-body">
                            <table  id="tabla-cuotas" class="table table-striped table-bordered table-hover table-checkable order-column" 
                                    id=" tableDetalle">
                                <thead>
                                <th width="130"> Ley</th>
                                <th width="100"> Articulo</th>
                                <th width="100"> Inciso </th>
                                <th width="25"> Unidad </th>
                                </thead>
                                <tbody id="detalle">
                                <?php if($leyesAlcoholemia !=null ): ?>
                                <?php foreach($leyesAlcoholemia as $row): ?>
  
                                    <tr class="odd gradeX">
                                        <td width="130"><?php echo $row->nombre; ?> </td>
                                        <td width="100"><?php echo $row->nombreArticulo ;?></td>
                                        <td width="100"><?php echo $row->nombreInciso;?></td>
                                        <td width="25"><div class="text-center"><?php echo $row->unidad; ?></div></td>
                                    </tr>
                                   <?php endforeach;?>
                                 <?php endif; ?>  
                                 </tbody>
                                <tfoot>
                                <tr>
                                <th></th>
                                <th></th>
                                <th scope="row">Total de Unidades</th>
                                <td><div class="text-center"><?php echo $cant_unidad_alcoholemia;?></div></td>
                                </tr>
                                <!--
                                <tr>
                                <th></th>
                                <th></th>
                                <th scope="row">Valor Unidad x Total Unidades : </th>
                                <td><div class="text-center">$<?php echo $importe_alcoholemia;?></div></td>
                                </tr>
                                -->
                                </tfoot>
                            
                            </table>
                            
                              
                        </div>
                    </div>
                </div>