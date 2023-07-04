<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-file-text-o"></i><?php echo $subtitulo ?> </div>
    </div>

    
    <div class="portlet-body form">
        <!-- BEGIN FORM-->

        <?php echo form_open_multipart('infraccionpago/guardar', 'class="horizontal-form"'); ?>
        <div class="form-body">                    
           

            <input type="hidden" name="id" id="id" value="<?php if (isset($infraccionPago)) echo $infraccionPago->id_infraccion_pago; ?>" />
          

            <div class="row">
            <div class="col-md-6">
              <h3 class="form-section"> Detalles de la Infracción e Infractor</h3>
             <table class="table table-bordered table-striped">
             <tbody>
             <tr class="success">
             <td>Número de Acta</td>
             <td>
             <div id="pulsate-once-target" style="padding:5px;"> 
              <strong><?php if (isset($infraccion)) echo $infraccion->numero_acta; ?>
              </strong> 
             </div>
             </td>
             </tr>
             <tr>
             <td>
              Nombre y Apellido
              </td>
              <td>
               <div id="pulsate-once-target" style="padding:5px;"> 
               <strong><?php if (isset($involucrado)) echo $involucrado->nombre.",".$involucrado->apellido; ?>  
               </div>
               </td>
              </tr>
              <tr class="success">
              <td>
               Dni
              </td>
              <td>
               <div id="pulsate-crazy-target" style="padding:5px;">
               <strong>
               <?php if(isset($involucrado)) echo $involucrado->dni; ?>
               </strong>
               </div>
               </td>
               </tr>
               </tbody></table>
            </div> 
            <div class="col-md-6">
               <h3 class="form-section"> Detalles del Pago</h3>
             <table class="table table-bordered table-striped">
             <tbody>
            <tr class="success">
             <td>Fecha y Hora de Pago </td>
             <td>
             <div id="pulsate-once-target" style="padding:5px;"> 
              <strong><?php if (isset($infraccionPago))  
                          echo date('d-m-Y',strtotime($infraccionPago->fecha))." , ".
                               $infraccionPago->hora; ?>
              </strong> 
             </div>
             </td>
             </tr>
             <tr >
             <td>Valor Unidad</td>
             <td>
             <div id="pulsate-once-target" style="padding:5px;"> 
              <strong><?php if (isset($infraccionPago))  
                           echo $infraccionPago->valor_unidad; 
                      ?>
              </strong> 
             </div>
             </td>
             </tr>
              <tr class="success">
                <td>Importe Leyes General </td>
                  <td><div id="pulsate-crazy-target" style="padding:5px;">
                  <strong>$<?php if (isset($infraccionPago)) echo $infraccionPago->importe_general; ?></strong>
               </div>
               </td>
               <td>Importe Leyes Alcoholemia </td>
                  <td><div id="pulsate-crazy-target" style="padding:5px;">
                  <strong>$<?php if (isset($infraccionPago)) echo $infraccionPago->importe_alcoholemia; ?></strong>
               </div>
               </td>

               </tr>
               <tr ><td>Porcentaje de Descuento </td>
                  <td><div id="pulsate-crazy-target" style="padding:5px;">
                  <strong> %
                  <?php if (isset($infraccionPago) )  echo $infraccionPago->porcentaje_descuento_general;?>
                  </strong>
               </div>
               </td>
               <td>Porcentaje de Descuento </td>
                  <td><div id="pulsate-crazy-target" style="padding:5px;">
                  <strong> %
                  <?php if (isset($infraccionPago) )  echo $infraccionPago->porcentaje_descuento_alcoholemia;?>
                  </strong>
               </div>
               </td>
             </tr>
              <tr class="success">
                <td>Importe con Descuento</td>
                  <td><div id="pulsate-crazy-target" style="padding:5px;">
                  <strong>$
                  <?php if (isset($infraccionPago) )  echo $infraccionPago->importe_descuento_general;?>
                  </strong>
               </div>
               </td>

                <td>Importe con Descuento</td>
                  <td><div id="pulsate-crazy-target" style="padding:5px;">
                  <strong>$
                  <?php if (isset($infraccionPago) )  echo $infraccionPago->importe_descuento_alcoholemia;?>
                  </strong>
               </div>
               </td>
             </tr>
               </tbody></table>
            </div>
          </div>

        

            <h3 class="form-section">Listado de Pago de Cuotas</h3>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box blue" id="box_detalle_pago">
                        <div class="portlet-title">
                            <div class="caption">
                                Listado</div>
                            
                        </div>
                        <div class="portlet-body">
                            <table  id="tabla-cuotas" class="table table-striped table-bordered table-hover table-checkable order-column" id="tableDetalle">
                                <thead>
                                <th  width="5%"> Nro. Cuota</th>
                                <th  width="5%"> Estado</th>
                                <th  width="20%"> Tipo Pago </th>
                                <th  width="20%"> Operacion </th>
                                <th  width="3%"> Fecha Pago</th>
                                <th  width="3%"> Hora Pago</th>
                                <th  width="15%"> Importe Ley General</th>
                                <th  width="30%"> Importe Ley Alcoholemia</th>
                                <th  width="10%"> Comprobante</th>
                                <th  width="10%"> Acciones Pago</th>
                                </tr>
                                </thead>
                                <tbody id="detalle">
                                <?php if($pagos!=null): ?>
                                <?php foreach($pagos as $pago): ?>
  
                                    <tr class="odd gradeX">
                                       
                                        <td><?php echo $pago->numero_cuota; ?> </td>
                                        <td>
                                        <?php if($pago->estado==CUOTA_PAGADA){
                                                  echo  "<div class='text-center'><span class='label label-sm label-info form-rounded'><strong>CP</strong></span></div>";
                                             }else{
                                                  echo   "<div class='text-center'><span class='label label-sm label-warning form-rounded'><strong>CNP</strong></span></div>";
                                             }
                                        
                                           

                                        ?>
                                       </td>
                                       
                                           <?php 
                                           if( $pago->tipo_pago_cuota == FES){
                                               echo " <td><div class='text-center'><strong>FES</strong></div> </td>";
                                               echo " <td><div class='text-center'><strong>Compr. Alcoholemia : </strong>".$pago->comprobanteAlcoholemia." , <strong> Compr. General : </strong>".$pago->comprobanteGeneral."</div></td>";
                                            } else if ($pago->tipo_pago_cuota == TARJETA_DEBITO) {
                                               echo  "<td><div class='text-center'><strong>TARJETA DEBITO</strong></div></td>";
                                               echo " <td><div class='text-center'><strong>Nro.Compra</strong> ".$pago->numeroCompra." <strong>, Nro.Factura </strong>".$pago->digitoFactura.
                                                    " <strong>-</strong>".$pago->numeroFactura."</div></td>";
                                            } else if ($pago->tipo_pago_cuota == TARJETA_CREDITO) {
                                                 echo " <td><div class='text-center'><strong>TARJETA CREDITO</strong></div></td>";
                                                 echo " <td><div class='text-center'><strong>Nro.Compra</strong> ".$pago->numeroCompra." <strong>, Nro.Factura </strong>".$pago->digitoFactura.
                                                    " <strong>-</strong>".$pago->numeroFactura."</div></td>";
                                            } else if ($pago->tipo_pago_cuota == BANCO) {
                                                 echo " <td><div class='text-center'><strong>BANCO</strong></div></td>";
                                                 echo " <td><div class='text-center'><strong>Nro.Compr. Banco</strong> ".$pago->comprobanteBanco." <strong></td>";
                                            } else {
                                              echo "<td><div class='text-center'>NO REALIZADO</div></td><td><div class='text-center'>NO REALIZADO</div></td>";
                                            }
                                            ?>
                                        <td width="10%"><div class="text-center"><?php if(isset($pago->fecha_pago)) echo date('d-m-Y',strtotime($pago->fecha_pago));?> </div></td>
                                        <td width="10%"><div class="text-center"><?php echo $pago->hora_pago;?></div></td>
                                        <td width="10%"><div class="text-center"><strong><?php echo "$".$pago->importe_general ;?></strong></td>
                                        <td width="10%"><div class="text-center"><strong><?php echo "$".$pago->importe_alcoholemia;?></strong></div></td>
                                       
                                        <td width="10%">
                                        <div class='text-center'>
                                          <?php 
                                            if($infraccionPago->tipo_pago =='TIPO_PAGO_CONTADO' || $infraccionPago->tipo_pago =='TIPO_PAGO_TARJETA'){
                                                 echo "<a href='".base_url()."infraccionpagocuota/generarComprobantePDF/".$pago->id."' class='btn default btn-xs blue' target='_blank'>COMPROBANTE CONTADO</a>";
                                            
                                                 
                                            }else if($infraccionPago->tipo_pago =='TIPO_PAGO_CUOTAS'){ 
                                            echo   "<a href='".base_url()."infraccionpagocuota/generarComprobantePDF/".$pago->id."' class='btn default btn-xs blue' target='_blank' >BANCO </a>";
                                            
                                            } ?>
                                           </div>
                                        </td>
                                        <td width="10%">
                                            <div class="text-center">
                                            <?php 
                                            if($pago->estado==CUOTA_PAGADA){
             
                                                echo "<button type='button' onclick='if(confirm(\"Desea eliminar el pago de la cuota?\")) module_detalle_pago.eliminarPagoCuota(".$pago->id.");'".
                                                     "  class='btn btn-danger label-sm btn-xs'>".
                                                     "<i class='fa glyphicon glyphicon-trash'></i>
                                                      ELIMINAR PAGO
                                                     </button>";

                                            }else{
                                                 echo "<div class='text-center'>
                                                        <button type='button' onclick='module_generar_pago.showModalRealizarPago(".$pago->id.");return false;' class='btn default btn-xs green' >
                                                      <i class='fa glyphicon glyphicon-usd'></i>
                                                      REALIZAR PAGO
                                                       </button></div>";
                                            }
                                            ?>  
                                           
                                            
                                           </div>
                                        </td>
                                      </tr>
                                   <?php endforeach;?>
                                 <?php endif; ?>  
                                 </tbody>
                                 <tfoot>
                                   <tr>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th>Totales</th>
                                     <th><div class="text-center">
                                         $
                                         <?php 
                                            if ( isset($infraccionPago->importe_descuento_general)) { 
                                               echo $infraccionPago->importe_descuento_general;
                                             } else {
                                               echo '0';
                                             }


                                         ?>
                                         </div>
                                      </th>
                                     <th><div class="text-center">
                                         $ <?php 
                                              if ( isset($infraccionPago->importe_descuento_alcoholemia)) {
                                                echo $infraccionPago->importe_descuento_alcoholemia;
                                              } else {
                                                echo '0';
                                              }
                                             ?>     

                                         </div>
                                     </th>
                                     <th></th>
                                     
                                   </tr>
                                 </tfoot>
                            
                            </table>

                           
                            
                              <!-- *********************************** -->
                              <!-- modales -->
                              <!-- load modal metodo de pago -->
                              <?php $this->load->view('vial/modal_pago/modal_realizar_pago');?>

                              <?php $this->load->view('vial/modal_pago/modal_generar_comprobante_cuota');?>
                              
                              <?php $this->load->view('vial/modal_pago/modal_generar_comprobante_contado');?>
                              
                        </div>
                    </div>
                </div>

            </div>

            

          
            <!-- end detalle de la infraccion -->
             <div class="row">
            <div class="col-md-6">
             <table class="table table-bordered table-striped">
             <tbody>
             <tr>
             <td>
             <span class='label label-sm label-info circle-in'><strong>CP</strong></span>
             </td>
             <td><strong>CUOTA PAGADA</strong></td>
             </tr>
             <tr>
             <td>
              <span class='label label-sm label-warning'><strong>CNP</strong></span>
              </td>
              <td><strong>CUOTA NO PAGADA</strong></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
             


            <!-- Acciones -->
            <div class="form-actions right">
               
                <button type="button" class="btn blue" 
                 onclick='if(confirm("Desea eliminar el Pago ? ")) module_detalle_pago.eliminarPago(<?php echo $infraccionPago->id_infraccion_pago;?>);return false;'>
                  <i class="fa fa-trash"></i>
                    Eliminar Pago de la Infracción
                </button>
              
                <a href="<?php echo base_url(); ?>infraccionvial/" class="btn default"> Cerrar</a>
              
            </div>


            </form>
            <!-- END FORM-->
            <!- /**********************************************/ -->
            

              
             <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
             </div>
             <!-- /.modal -->
            <!-- end modal -->
        </div>

        
    </div>

    <script>
      $(document).ready(function(){
          $("#digito_factura").inputmask({mask:"9999",placeholder:""})
      });
    </script> 

           
    <!--load js -->  
    <?php $this->load->view('js/module_detalle_pago');?>