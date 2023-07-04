 
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
  
  <div class="portlet-body display-block">
  <?php echo form_open('infraccionvial/buscar', 'class="horizontal-form"'); ?>
  <div class="row">
  
  <div class="col-md-3">
  <div class="form-group">
  <label class="control-label">Número Acta Vial</label>
  <input id="firstName" name="numero_acta" class="form-control" placeholder="Número Acta Vial" type="text"
        value="<?php  if(isset($filter['numero_acta'])) echo $filter['numero_acta']; ?>"
  />
  </div>
  </div>

   <div class="col-md-3">
  <div class="form-group">
  <label class="control-label">Dni : </label>
  <input id="dni" name="dni" class="form-control" placeholder="Dni" type="text"
    value="<?php  if(isset($filter['dni'])) echo $filter['dni']; ?>"
  />
  </div>
  </div>

   <div class="col-md-3">
  <div class="form-group">
  <label class="control-label">Dominio : </label>
  <input id="dominio" name="dominio" class="form-control" placeholder="Dominio" type="text"
   value="<?php  if(isset($filter['dominio'])) echo $filter['dominio']; ?>"
  />
  </div>
  </div>

  </div>

  <div class="row">
      <div class="col-md-3">
     <div class="form-group">
     <label class="control-label">Fecha Desde: </label>
      <div class="input-group ">
      <input id="firstName" name="fecha_desde" class="form-control"  type="date"
        value="<?php  if(isset($filter['fecha_desde'])) echo date('Y-m-d',strtotime($filter['fecha_desde'])); ?>"/>
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
     <label class="control-label">Fecha Hasta: </label>
      <div class="input-group ">
      <input id="firstName" name="fecha_hasta" class="form-control"  type="date"
        value="<?php  if(isset($filter['fecha_hasta'])) echo date('Y-m-d',strtotime($filter['fecha_hasta'])); ?>"
    />
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
   <a href="<?php echo base_url() ;?>infraccionvial" class="btn red">Limpiar</a>
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
                                            <span class="caption-subject bold uppercase"> Listado de Infracciones</span>
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
                                               
                                            </div>
                                        </div>
                                       <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table_ley">
                                            <thead>
                                                <tr>
                                                   
                                                    <th>ID</th>
                                                    <th> Nro. Acta Vial</th>
                                                    <th> Fecha Acta</th>
                                                    <th> Propietario</th>
                                                     <th> Dni </th>
                                                    <th> Dominio</th>
                                                   
                                                   
                                                   
                                                    <th> Descargo </th>
                                                    <th> Estado Pago</th>
                                                    <!--
                                                    <th>Informes</th>
                                                    -->
                                                    <th> Acciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                              <?php foreach($infracciones as $infraccion): ?>


                                                <tr class="odd gradeX">
                                                  <td><?php echo $infraccion->id;?> </td> 
                                                  <td> <?php echo $infraccion->numeroActa;?></td>
                                                  <td> <?php echo date('d-m-Y',strtotime($infraccion->fechaIngreso));?></td>
                                                  <td width="25%"> <?php echo $infraccion->propietario;?></td>
                                                  <td> <?php echo $infraccion->dni ;?></td>
                                                  <td> <?php echo $infraccion->dominio ;?></td>
                                                 
                                                
                                                  <!-- Descargo 
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
                                                          echo "<div class='text-center'><button onclick='showModalDescargo(".$infraccion->id.");return false;' class='btn default btn-xs red' ><strong>REALIZAR DESCARGO</strong></button></div>";
                                                        
                                                        }else{
                                                          echo  "<div class='text-center'><span class='label label-sm label-info'><strong>NO SE PUEDE REALIZAR DESCARGO</strong></span></div>";
                                                        } 
                                                       }
                                                        
                                                     ?>
                                                           
                                                  </td>
                                                 -->

                                                 <td class="text-center">
                                                  <?php 
                                                   echo "<div class='text-center'><button onclick='showModalDescargo(".$infraccion->id.");return false;' class='btn default btn-xs red' ><strong>REALIZAR DESCARGO</strong></button></div>";
                                                   ?>
                                                 </td>
                                                  <td  class="text-center"> 

                                                  <?php
                                                    //Se debe verificar si el estado de pago es nulo o 
                                                    //no generado se debe poder generar o seleccionar el pago 
                                                    if(empty($infraccion->estadoPago) || $infraccion->estadoPago==INFRACCION_PAGO_NO_GENERADO){
                                                      echo "<button type='button' onclick='showModalGenerarPago(".$infraccion->id.")' class='btn default btn-xs green '><strong>GENERAR PAGO
                                                            </strong></button>"; 
                                                    }else if($infraccion->estadoPago==INFRACCION_PAGO_INCOMPLETO){
                                                      echo  "<a href='".base_url().'infraccionpago/index/'.$infraccion->idInfraccionPago."' class='btn btn-success label-sm btn-xs'><strong>".$infraccion->labelCuotas."</strong></a>";
                                                    }else if($infraccion->estadoPago==INFRACCION_PAGO_COMPLETO){
                                                       
                                                       echo  "<a href='".base_url().'infraccionpago/index/'.$infraccion->idInfraccionPago."' class='btn btn yellow label-sm btn-xs'><strong><strong> PAGO COMPLETO</strong></a>";
                                                    }
                                                  ?>
                                                   </td>
                                                 

                                                  <!-- 
                                                  <td>
                                                     <a title="Informes"
                                                       href='<?php echo base_url().'informes/index/'.$infraccion->id;?>'
                                                       class="btn default btn-xs blue">
                                                        INFORMES
                                                    </a>
                                                  </td> 
                                                  --> 

                                                  <td>
                                                  <div class="text-center">
                                                    

                                                    
                                                    <a title="Editar"
                                                       href='<?php echo base_url().'infraccionvial/editar/'.$infraccion->id;?>'
                                                       class="btn default btn-xs yellow"> 
                                                       <i class="fa fa-pencil"></i> 
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
                                        <?php $this->load->view('vial/modal/modal_view'); ?>

                                   
                                         
                                        <!-- load modal metodo de pago -->
                                        <?php $this->load->view('vial/modal_pago/modal_tipo_pago');?>
                                        <!-- end modales --> 

                                        <!-- modal descargo -->
                                        <?php $this->load->view('vial/modal/modal_realizar_descargo');?>
                              



                                  

                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>


                            <!-- *******************************  -->
     

                        </div>

                        <script type="text/javascript">
                         jQuery(document).ready(function(){
                            $("#table_ley").dataTable();

                         });
                        </script>

                        <script>
    $(document).ready(function () {
        $('#posts').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
         "url": "<?php echo base_url('home/posts') ?>",
         "dataType": "json",
         "type": "POST",
         "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
                       },
      "columns": [
              { "data": "id" },
              { "data": "title" },
              { "data": "body" },
              { "data": "created_at" },
           ]   

      });
    });
</script>
                        

                     
     