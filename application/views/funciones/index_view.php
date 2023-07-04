 
<div class="row">
  <div class="col-md-12">
  <div class="portlet light">
  <div class="portlet-title">
  <div class="caption font-orange">
  <i class="fa fa-file-text-o font-orange"></i> <span
    class="caption-subject bold uppercase"> Buscar Viales</span></div>
  <div class="tools">
  <a href="javascript:;" class="expand">
  </a>
  </div>
  </div>
  
  <div class="portlet-body display-hide">
  <?php echo form_open_multipart('direccionvial/buscar', 'class="horizontal-form"'); ?>
  <div class="row">
  <div class="col-md-3">
  <div class="form-group">
  <label class="control-label">Número Expediente</label>
  <input id="firstName" name="numero_expediente" class="form-control" placeholder="Numero Expediente" type="text"/>
  </div>
  </div>
  
  <div class="col-md-3">
  <div class="form-group">
  <label class="control-label">Número Expediente Entrante</label>
  <input id="firstName" name="numero_expediente_entrante" class="form-control" placeholder="Numero Expediente Entrante" type="text"/>
  </div>
  </div>


  <div class="col-md-3">
  <div class="form-group">
  <label class="control-label">Número Acta Vial</label>
  <input id="firstName" name="numero_acta" class="form-control" placeholder="Número Acta Vial" type="text"/>
  </div>
  </div>

  </div>
 
  <div class="row">

  <div class="col-md-3">
  <div class="form-group">
  <label class="control-label">Fecha desde :</label>
  <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
  <input type="text" class="form-control" readonly="" name="fecha_desde">
  <span class="input-group-btn">
  <button class="btn default" type="button">
  <i class="fa fa-calendar"></i>
  </button>
  </span>
  </div>
  </div>
  </div>

 <div class="col-md-3">
 <div class="form-group">
 <label class="control-label">Fecha hasta :</label>
 <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
 <input type="text" class="form-control" readonly="" name="fecha_hasta">
 <span class="input-group-btn">
 <button class="btn default" type="button">
 <i class="fa fa-calendar"></i>
 </button>
 </span>
 </div>
 </div>
 </div>

  </div>
   <div class="form-actions noborder text-right">
   <a href="<?php echo base_url() ;?>direccionvial" class="btn red">Limpiar</a>
   <button type="submit" class="btn green" id="button-contravencion-buscar">
   <i class="fa fa-search"></i> Buscar
   </button>
   </div>


  <?php ?>
  </div>
  </div>
  </div>
  </div>

 
  <?php 
   if($message!=null && !empty($message)){
   ?>
    <div class="alert alert-<?php echo $status ;?> alert-dismissable">
        <?php echo $message ;?>
    <button class="close" data-dismiss="alert">&times;</button>
    </div>
  
   <?php } ?>

 <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase"> Listado</span>
                                        </div>
                                        
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-toolbar">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="btn-group">
                                                        <a href="<?php echo base_url(); ?>infraccionvial/agregar" id="sample_editable_1_new" class="btn sbold green"> Agregar
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="btn-group pull-right">
                                                        <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-print"></i> Print </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table_expediente">
                                            <thead>
                                                <tr>
                                                   
                                                    <th> ID </th>
                                                  
                                                    <th> Nro. Acta Vial</th>
                                                    <th> Fecha Hecho</th>
                                                    <th> Infractor</th>
                                                    <th> Descargo </th>
                                                    <th> Estado Pago</th>
                                                    <th> Acciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            	<?php foreach($infracciones as $infraccion): ?>


                                                <tr class="odd gradeX">
                                                   
                                                  <td> <?php echo $infraccion->id ;?></td> 
                                                  <td> <?php echo $infraccion->numeroActa;?></td>
                                                  <td> <?php echo $infraccion->fechaHecho ;?></td>
                                                  <td> <?php echo $infraccion->infractor;?></td>
                                                  <td> 
                                                   <?php 
                                                      
                                                       if($infraccion->fechaHecho!=null && !empty($infraccion->fechaHecho)){
                                                      
                                                         //A la fecha del hecho le agrego los 5 dias 
                                                         $dateHecho = new DateTime($infraccion->fechaHecho); // Y-m-d
                                                         $dateHecho->add(new DateInterval('P5D'));
                                                         $dateHechoFormat=$dateHecho->format('Y-m-d');

                                                         //Fecha de hoy 
                                                         $dateNow=date("Y-m-d");
                                                        
                                                        //Comparamos las 2 fechas 
                                                        //mientras la fecha de hecho + 5 dias sea mayor o 
                                                        //o igual que una fecha actual, se puede realizar el 
                                                        //descargo
                                                        if($dateHechoFormat >= $dateNow){
                                                          echo "<div class='text-center'><button onclick='generarDescargo(".$infraccion->id.");return false;' class='btn default btn-xs red' ><strong>REALIZAR DESCARGO</strong></button></div>";
                                                        
                                                        }else{
                                                          echo  "<div class='text-center'><span class='label label-sm label-info'><strong>NO SE PUEDE REALIZAR DESCARGO</strong></span></div>";
                                                        } 
                                                       }
                                                        
                                                     ?>
                                                           
                                                  </td>
                                                  <td>

                                                  <?php
                                                    //Se debe verificar si el estado de pago es nulo o 
                                                    //no generado se debe poder generar o seleccionar el pago 
                                                    if(empty($infraccion->estadoPago) || $infraccion->estadoPago==INFRACCION_PAGO_NO_GENERADO){
                                                      echo "<button onclick='showModalGenerarPago(".$infraccion->id.",".$infraccion->importe.")' class='btn default btn-xs green '><strong>GENERAR PAGO
                                                            </strong></button>"; 
                                                    }else if($infraccion->estadoPago==INFRACCION_PAGO_INCOMPLETO){
                                                      echo  "<a href='".base_url().'infraccionpago/index/'.$infraccion->idInfraccionPago."' class='btn btn-success label-sm btn-xs'><strong>".$infraccion->labelCuotas."</strong></a>";
                                                    }else if($infraccion->estadoPago==INFRACCION_PAGO_COMPLETO){
                                                       
                                                       echo  "<a href='".base_url().'infraccionpago/index/'.$infraccion->idInfraccionPago."' class='btn btn yellow label-sm btn-xs'><strong><strong> PAGO COMPLETO</strong></a>";
                                                    }
                                                  ?>
                                                   </td>
                                                  <td>
                                                  <div class="text-center">
                                                    <button 
                                                     type="button"
                                                     onclick="showModalView(<?php echo $infraccion->id;?>);" 
                                                     class="btn default btn-xs red"> 
                                                     <i class="fa fa-eye"></i> 
                                                    </button>
                                                    <a title="Editar"
                                                       href='<?php echo base_url().'infraccionvial/editar/'.$infraccion->id;?>'
                                                       class="btn default btn-xs yellow"> 
                                                       <i class="fa fa-pencil"></i> 
                                                    </a>
                                                    
                                                    <a data-toggle="modal" href="#modal_factura"
                                                      class="btn default btn-xs green"
                                                      >
                                                      <i class="fa fa-file-text-o"></i> 
                                                     </a>
                                                  
                                                    

                                                    </div>
                                                  </td> 
                                                    
                                                </tr>
                                            <?php endforeach;?>
                                             
                                             
                                            </tbody>
                                        </table>

                                      <!-- *********************************** -->
                                      


                                      <!-- modales -->
                                      

                                        <!-- load moal view contravencion -->
                                        <?php $this->load->view('infracciones/vial/modal_view'); ?>

                                        <!-- load modal metodo de pago -->
                                        <?php $this->load->view('infracciones/vial/modal_tipo_pago');?>
                                      <!-- end modales --> 
                                  

                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>


                            <!-- *******************************  -->
     

                        </div>

                        <script type="text/javascript">
                         jQuery(document).ready(function(){
                            console.log("ready documento");
                            $("#table_expediente").dataTable();

                         });
                        </script>

                        

                     
     