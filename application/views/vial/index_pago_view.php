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
            <div class="col-md-3">
              <h3 class="form-section"> Detalles de la Infracción e Infractor</h3>
             <table class="table table-bordered table-striped">
             <tbody><tr>
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
               <strong><?php if (isset($infractor)) echo $infractor->nombre.",".$infractor->apellido; ?>  
               </div>
               </td>
              </tr>
              <tr>
              <td>
               Dni
              </td>
              <td>
               <div id="pulsate-crazy-target" style="padding:5px;">
               <strong>
               <?php if(isset($infractor)) echo $infractor->dni; ?>
               </strong>
               </div>
               </td>
               </tr>
               </tbody></table>
            </div> 
            <div class="col-md-6">
               <h3 class="form-section"> Detalles del Pago</h3>
             <table class="table table-bordered table-striped">
             <tbody><tr>
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
             <tr><td>Tipo de Pago</td>
              <td><div id="pulsate-once-target" style="padding:5px;"> 
               <strong><?php if (isset($infraccionPago) && $infraccionPago->tipo_pago==='TIPO_PAGO_CUOTAS')  echo "CUOTAS";?>
                                   <?php if(isset($infraccionPago) && $infraccionPago->tipo_pago==='TIPO_PAGO_CONTADO') echo "CONTADO";?>
               </strong>  
               </div>
              </td>
              </tr>
              <tr><td> Cantidad de Cuotas</td>
                <td><div id="pulsate-crazy-target" style="padding:5px;">
                  <strong>
                <?php if (isset($infraccionPago)) echo $infraccionPago->cant_cuotas; ?>
                  </strong>
                </div>
               </td>
               </tr>
               <tr>
                <td>Import Total </td>
                  <td><div id="pulsate-crazy-target" style="padding:5px;">
                  <strong><?php if (isset($infraccionPago)) echo $infraccionPago->importe; ?></strong>
               </div>
               </td>
               </tr>
               <tr><td>Porcentaje de Descuento</td>
                  <td><div id="pulsate-crazy-target" style="padding:5px;">
                  <strong>
                  <?php if (isset($infraccionPago) )  echo $infraccionPago->porcentaje_descuento;?>
                  </strong>
               </div>
               </td>
             </tr>
              <tr>
                <td>Importe con Descuento</td>
                  <td><div id="pulsate-crazy-target" style="padding:5px;">
                  <strong>
                  <?php if (isset($infraccionPago) )  echo $infraccionPago->importe_reduccion;?>
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
                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                Listado</div>
                            
                        </div>
                        <div class="portlet-body">
                            <table  id="tabla-cuotas" class="table table-striped table-bordered table-hover table-checkable order-column" id="tableDetalle">
                                <thead>
                                <th  width="25"> Nro. Cuota</th>
                                <th>Estado</th>
                                <th >Comprobante </th>
                                <th> Fecha Pago</th>
                                <th> Hora Pago</th>
                                <th> Importe </th> 
                                <th> Generar</th>
              
                                <th> Acciones Pago</th>
                                </tr>
                                </thead>
                                <tbody id="detalle">
                                <?php if($pagos!=null): ?>
                                <?php foreach($pagos as $pago): ?>
  
                                    <tr class="odd gradeX">
                                       
                                        <td><?php echo $pago->numero_cuota; ?> </td>
                                        <td>
                                        <?php if($pago->estado==CUOTA_PAGADA){
                                                  echo  "<div class='text-center'><span class='label label-sm label-info'><strong>CUOTA PAGADA</strong></span></div>";
                                             }else{
                                                  echo   "<div class='text-center'><span class='label label-sm label-warning'><strong>CUOTA NO PAGADA</strong></span></div>";
                                             }
                                        ?>
                                        <td><?php echo $pago->numero_comprobante ;?></td>
                                        <td><?php if(isset($pago->fecha_pago)) echo date('d-m-Y',strtotime($pago->fecha_pago));?> </td>
                                        <td><?php echo $pago->hora_pago;?></td>
                                        <td><?php echo $pago->importe ;?></td>
                                        <td>
                                        <div class='text-center'>
                                          <?php 
                                            if($infraccionPago->tipo_pago =='TIPO_PAGO_CONTADO'){
                                                 echo "<button onclick='showModalGenerarComprobanteContado(".$pago->id.");return false;' class='btn default btn-xs blue' > GENERAR COMPROBANTE CONTADO</button>";
                                            
                                                 
                                            }else if($infraccionPago->tipo_pago =='TIPO_PAGO_CUOTAS'){ 
                                            echo "<button onclick='showModalGenerarComprobanteCuota(".$pago->id.");return false;' class='btn default btn-xs blue' >GENERAR COMPROBANTE CUOTA</button>";
                                            
                                            } ?>
                                           </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                            <?php 
                                            if($pago->estado==CUOTA_PAGADA){
                                                /*echo  "<a href='".base_url().'infraccionpagocuota/generarComprobantePDF/'.$pago->id."' class='btn btn-success label-sm btn-xs' target='_blank'>
                                                      <i class='fa fa-file-pdf-o'></i></a>";
                                                 */
                                                
                                                

                                                echo "<button type='button' onclick='if(confirm(\"Desea eliminar el pago de la cuota?\")) eliminarPagoCuota(".$pago->id.");'".
                                                     "  class='btn btn-danger label-sm btn-xs'>".
                                                     "<i class='fa glyphicon glyphicon-trash'></i>
                                                      ELIMINAR PAGO
                                                     </button>";

                                            }else{
                                                 echo "<div class='text-center'><button onclick='showModalRealizarPago(".$pago->id.");return false;' class='btn default btn-xs green' >
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
            



            <!-- Acciones -->
            <div class="form-actions right">
               
                <button type="button" class="btn red" onclick='if(confirm("Desea eliminar el Pago ? "));eliminarPago(<?php echo $infraccionPago->id_infraccion_pago;?>)'>
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





        <script type="text/javascript">

        $(document).ready(function(){
           $('#tabla-cuotas').DataTable();
        });




       /**
         * Funcion que permite eliminar la infraccion 
           de Pago
        **/ 
       function eliminarPago(idInfraccionPago){
         
          $.get('<?php echo base_url(); ?>/infraccionpago/delete_pago/'+idInfraccionPago, 
          function(response) {
             console.log("response=> "+JSON.stringify(response));
             if(response.status=='OK'){
               
                window.location .href="<?php echo base_url(); ?>infraccionvial/";
             }
           }, 'json');
       }

        //Funcion que permite guardar la informacion
        //del pago 
       function eliminarPagoCuota(idInfraccionPagoCuota){
        
        $.get('<?php echo base_url(); ?>/infraccionpagocuota/delete_pagoCuota/'+idInfraccionPagoCuota, 
          
          function(response) {
             console.log("response=> "+JSON.stringify(response));
          if(response.status=='OK'){
                console.log("aqui ingreso");
               $("#btnCerrar").click();
                window.location.reload();
          }else{
                $("#btnCerrar").click();
               alert("Se produjo un error al realizar el descargo");
          }
      }, 'json');
    
    }

                
        </script>
    </div>
