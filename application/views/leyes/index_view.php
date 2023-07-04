 
<div class="row">
  <div class="col-md-12">
  <div class="portlet light">
  <div class="portlet-title">
  <div class="caption font-orange">
  <i class="fa fa-file-text-o font-orange"></i> <span
    class="caption-subject bold uppercase"> Buscar Leyes</span></div>
  <div class="tools">
  <a href="javascript:;" class="expand">
  </a>
  </div>
  </div>
  
  <div class="portlet-body display-block">
  <?php echo form_open_multipart('ley/buscar', 'class="horizontal-form"'); ?>
  <div class="row">
  <div class="col-md-3">
  <div class="form-group">
  <label class="control-label">Nombre</label>
  <input id="firstName" name="nombre" class="form-control" placeholder="Nombre Ley" type="text"
     value="<?php  if(isset($filter['nombre'])) echo $filter['nombre']; ?>"
  />
  </div>
  </div>
  </div>
  


  <div class="row">
   <div class="form-actions noborder text-right">
   <a href="<?php echo base_url() ;?>ley" class="btn red">Limpiar</a>
   <button type="submit" class="btn green" id="button-ley-buscar">
   <i class="fa fa-search"></i> Buscar
   </button>
   </div>
 </div>


  <?php ?>
  </div>
  </div>
  </div>
  </div>


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
                                                        <a href="<?php echo base_url(); ?>ley/create" id="sample_editable_1_new" class="btn sbold green"> Agregar
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                              
                                            </div>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table_ley">
                                            <thead>
                                                <tr>
                                                   
                                                    <th> ID </th>
                                                  
                                                    <th> Nombre</th>
                                                    <th> Descripción</th>
                                                    <th> Tipo Infracción</th>
                                                    <th> Tipo de Tramite</th>
                                                    <th> Unidad Fija</th>
                                                   
                                                    <th> Acciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                              <?php foreach($leyes as $ley): ?>


                                                <tr class="odd gradeX">
                                                   
                                                  <td> <?php echo $ley->id ;?></td> 
                                                  <td> <?php echo $ley->nombre;?></td>
                                                  <td> <?php echo $ley->descripcion ;?></td>
                                                  <td> 
                                                    <?php 
                                                        
                                                        if($ley->tipoInfraccion=='C'){
                                                          echo "<div class='text-center'><span class='label label-sm label-warning'><strong><strong>Contravencional</strong></span></div>";
                                                        
                                                        }elseif($ley->tipoInfraccion=='V'){
                                                          echo  "<div class='text-center'><span class='label label-sm label-info'><strong>VIAL</strong></span></div>";
                                                        }elseif($ley->tipoInfraccion=='VC'){
                                                            echo  "<div class='text-center'><span class='label label-sm label-info'><strong>Vial-Contravencional</strong></span></div>";
                                                        }

                                                       ;?>
                                                      
                                                  </td>
                                                  <td><?php echo $ley->tipoTramite; ?></td>
                                                  <td><?php echo $ley->unidad_fija;?></td>
                                                  
                                               

                                                  <td>
                                                  <div class="text-center">
                                                   
                                                   <a title="Editar"
                                                       href='<?php echo base_url().'ley/editar/'.$ley->id;?>'
                                                       class="btn default btn-xs yellow"> 
                                                       <i class="fa fa-pencil"></i> 
                                                    </a>
                                                    
                                                  
                                                  
                                                    

                                                    </div>
                                                  </td> 
                                                    
                                                </tr>
                                            <?php endforeach;?>
                                             
                                             
                                            </tbody>
                                        </table>

                                      

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

                        

                     
     