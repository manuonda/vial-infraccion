 
<div class="row">
  <div class="col-md-12">
  <div class="portlet light">
  <div class="portlet-title">
  <div class="caption font-orange">
  <i class="fa fa-file-text-o font-orange"></i> <span
    class="caption-subject bold uppercase"> Buscar Seccion</span></div>
  <div class="tools">
  <a href="javascript:;" class="expand">
  </a>
  </div>
  </div>
  
  <div class="portlet-body display-hide">
  <?php echo form_open_multipart('seccion/buscar', 'class="horizontal-form"'); ?>
  <div class="row">
  <div class="col-md-3">
  <div class="form-group">
  <label class="control-label">Nombre</label>
  <input id="firstName" name="nombre" class="form-control" placeholder="Nombre" type="text"/>
  </div>
  </div>
  
 

   <div class="form-actions noborder text-right">
   <a href="<?php echo base_url() ;?>perfil" class="btn red">Limpiar</a>
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
                                                        <a href="<?php echo base_url(); ?>seccion/agregar" id="sample_editable_1_new" class="btn sbold green"> Agregar
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
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table_perfil">
                                            <thead>
                                                <tr>
                                                   
                                                    <th> ID </th>
                                                    <th> Nombre</th>
                                                    <th> Grupo</th>
                                                    <th> Acciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                              <?php foreach($secciones as $seccion): ?>


                                                <tr class="odd gradeX">
                                                   
                                                  <td> <?php echo $seccion->id ;?></td> 
                                                  <td> <?php echo $seccion->nombre;?></td>
                                                  <td> <?php echo $seccion->nombreGrupo;?></td>

                                                  <td>
                                                  <div class="text-center">
                                                    <a title="Editar"
                                                       href='<?php echo base_url().'seccion/editar/'.$seccion->id;?>'
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
                                    
                                  

                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>


                            <!-- *******************************  -->
     

                        </div>

                        <script type="text/javascript">
                         jQuery(document).ready(function(){
                            console.log("ready documento");
                            $("#table_perfil").dataTable();

                         });
                        </script>

                        

                     
     