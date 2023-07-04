 
<div class="row">
  <div class="col-md-12">
  <div class="portlet light">
  <div class="portlet-title">
  <div class="caption font-orange">
  <i class="fa fa-file-text-o font-orange"></i> <span
    class="caption-subject bold uppercase"> Buscar Inciso</span></div>
  <div class="tools">
  <a href="javascript:;" class="expand">
  </a>
  </div>
  </div>
  
  <div class="portlet-body display-block">
  <?php echo form_open_multipart('inciso/buscar', 'class="horizontal-form"'); ?>
  <div class="row">
  <div class="col-md-3">
  <div class="form-group">
  <label class="control-label">Nombre</label>
  <input id="firstName" name="nombre" class="form-control" placeholder="Nombre Articulo" type="text"
      value="<?php  if(isset($filter['nombre'])) echo $filter['nombre']; ?>"
  />
  </div>
  </div>

   <div class="col-md-3">
  <div class="form-group" id="grupo-div">
  <label class="control-label">Leyes:</label>
  <select class="form-control select"  data-toggle="tooltip" id="idLey"  name="idLey">
  <option value="">-- Seleccionar --</option>
  <?php foreach ($leyes as $ley): ?>                                                                        
  <option value="<?php echo $ley->id ?>"    
  <?php if (isset($filter) && $filter['idLey'] == $ley->id) echo 'selected="selected"'; ?>>
  <?php echo $ley->nombre.",".$ley->descripcion; ?></option>
  <?php endforeach; ?>
  </select>
  </div>
  </div>

  <div class="col-md-3">
  <div class="form-group" id="grupo-div">
  <label class="control-label">Artículos:</label>
  <select class="form-control select"  data-toggle="tooltip" id="articulo"  name="articulo">
  <option value="">-- Seleccionar --</option>
  <?php foreach ($articulos as $articulo): ?>                                                                        
  <option value="<?php echo $articulo->id ?>" 
   <?php if (isset($filter) && $filter['idArticulo'] == $articulo->id) echo 'selected="selected"'; ?>>
  <?php echo $ley->nombre.",".$ley->descripcion; ?>
  </option>
  
  <?php endforeach; ?>
  </select>
  </div>
  </div>
  
  </div> 


   <div class="form-actions noborder text-right">

   <a href="<?php echo base_url();?>inciso" class='btn red'>Limpiar</a>
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
    <div class="alert  alert-dismissable">
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
                                                        <a href="<?php echo base_url()."/inciso/create" ; ?>" id="sample_editable_1_new" class="btn sbold green"> Agregar
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                             
                                            </div>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table_expediente">
                                            <thead>
                                                <tr>
                                                   
                                                    <th> ID </th>
                                                  
                                                    <th> Nombre</th>
                                                    <th> Descripción</th>
                                                    <th> Ley</th>
                                                    <th> Artículo</th>
                                                    <th> Unidad Fija</th>
                                                    <th> Tipo Infracción</th>
                                                    
                                                    <th> Acciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                              <?php foreach($incisos as $inciso): ?>


                                                <tr class="odd gradeX">
                                                   
                                                  <td> <?php echo $inciso->id ;?></td> 
                                                  <td> <?php echo $inciso->nombre;?></td>
                                                  <td> <?php echo $inciso->descripcion;?></td>
                                                  <td> <?php echo $inciso->nombreLey ;?></td>
                                                  <td> <?php echo $inciso->nombreArticulo;?></td>
                                                  <td> <?php echo $inciso->unidad;?> </td>
                                                  <td>
                                                    <?php 
                                                        
                                                        if($inciso->tipoInfraccion=='C'){
                                                          echo "<div class='text-center'><span class='label label-sm label-warning'><strong><strong>Contravencional</strong></span></div>";
                                                        
                                                        }elseif($inciso->tipoInfraccion=='V'){
                                                          echo  "<div class='text-center'><span class='label label-sm label-info'><strong>VIAL</strong></span></div>";
                                                        } else if($inciso->tipoInfraccion=='VC'){
                                                           echo  "<div class='text-center'><span class='label label-sm label-info'><strong>Vial- Contravencional</strong></span></div>";
                                                        }

                                                       ;?>
                                                      </td> 

                                              
                           

                                                  <td>
                                                  <div class="text-center">
                                                   
                                                   <a title="Editar"
                                                       href='<?php echo base_url().'inciso/editar/'.$inciso->id;?>'
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
                            console.log("ready documento");
                            $("#table_expediente").dataTable();

                             /////////////////////////////////////
                             //select ley
                             $("#idLey").change(function () {
                                
                                id_ley = $(this).val();
                                if (id_ley === '')
                                return false;
                                 
                                resetaCombo('articulo');
                                $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_articulos/' + id_ley, function (data) {
                                   var option = new Array();
                                   $.each(data, function (i, obj) {
                                   option[i] = document.createElement('option');
                                   $(option[i]).attr({value: obj.id_articulo});
                                   $(option[i]).append(obj.nombre);
                                   $("select[name=articulo]").append(option[i]);
                                });
                              });
                            });

                         });


             function resetaCombo(el) {
                    $("select[name='" + el + "']").empty();
                    var option = document.createElement('option');
                    $(option).attr({value: ''});
                    $(option).append('-- Seleccionar --');
                    $("select[name='" + el + "']").append(option);
            }
       </script>

                        

                     
     