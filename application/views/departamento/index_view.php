 
<div class="row">
  <div class="col-md-12">
  <div class="portlet light">
  <div class="portlet-title">
  <div class="caption font-orange">
  <i class="icon-users font-orange"></i> <span
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
  <input id="firstName" name="num_exp_vial" class="form-control" placeholder="Numero Expediente" type="text"/>
  </div>
  </div>
  
  <div class="col-md-3">
  <div class="form-group">
  <label class="control-label">Número Expediente Entrante</label>
  <input id="firstName" name="num_exp_vial_entrante" class="form-control" placeholder="Numero Expediente Entrante" type="text"/>
  </div>
  </div>


  <div class="col-md-3">
  <div class="form-group">
  <label class="control-label">Número Acta Vial</label>
  <input id="firstName" name="num_acta_vial" class="form-control" placeholder="Número Acta Vial" type="text"/>
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
                                                        <a href="<?php echo base_url(); ?>direccionvial/agregar" id="sample_editable_1_new" class="btn sbold green"> Agregar
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
                                                    <th> Nro. Expediente </th>
                                                    <th> Nro. Expediente Entrante</th>
                                                    <th> Nro. Acta Vial</th>
                                                    <th> Fecha Ingreso</th>
                                                    <th> Propietario</th>
                                                    <th> Estado </th>
                                                    <th> Factura</th>
                                                    <th> Acciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            	<?php foreach($contravenciones as $contravencion): ?>


                                                <tr class="odd gradeX">
                                                   
                                                  <td> <?php echo $contravencion->id ;?></td> 
                                                  <td> <?php echo $contravencion->expediente;?> </td>
                                                  <td> <?php echo $contravencion->expedienteEntrante;?></td>
                                                  <td> <?php echo $contravencion->actaVial;?></td>
                                                  <td> <?php echo $contravencion->fechaIngreso;?></td>
                                                  <td> <?php echo $contravencion->propietario;?></td>
                                                  <td> <?php echo $contravencion->estado ;?></td>
                                                  <td></td>
                                                  <td>
                                                  <div class="text-center">
                                                  <button data-toggle="modal" href="#ver-multa-{{$multa->idMulta}}" 
                                                    class="btn default btn-xs red"> 
                                                   <i class="fa fa-eye"></i> 
                                                  </button>
                                                    <a title="Editar">
                                                      href='<?php echo base_url().'direccionvial/editar/'.$contravencion->id;?>'
                                                       class="btn default btn-xs yellow"> 
                                                      <i class="fa fa-pencil"></i> 
                                                    </a>
                                                  
                                                    <button data-toggle="modal" href="#draggable" 
                                                      class="btn default btn-xs red"> 
                                                     <i class="fa fa-eye"></i> 
                                                    </button>
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
                        </div>

                        <!-- modal cupon -->
                         <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title">Start Dragging Here</h4>
                                                    </div>
                                                    <div class="modal-body"> Modal body goes here </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn green">Save changes</button>
                                                    </div>
hmmjc</div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>