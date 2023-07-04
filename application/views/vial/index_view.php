 
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

  <input type="hidden" id="nropagina" />

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
  <label class="control-label">Dni Infractor : </label>
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
        value="<?php  if(!empty($filter['fecha_desde'])) echo date('Y-m-d',strtotime($filter['fecha_desde'])); ?>"/>
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
        value="<?php  if(!empty($filter['fecha_hasta'])) echo date('Y-m-d',strtotime($filter['fecha_hasta'])); ?>"
    />
  <span class="input-group-btn">
  <button class="btn default" type="button">
  <i class="fa fa-calendar"></i>
  </button>
  </span>
  </div>
  </div>
  </div>
  
<div class="col-md-3">
 <div class="form-group" >  
<label class="control-label">Estado Pago</label>
<select class="form-control"  data-toggle="tooltip" id="estado_pago"  name="estado_pago" >
<option value="">Seleccionar</option>
<option 
  value="INFRACCION_PAGO_NO_GENERADO" <?php if (isset($filter) && $filter['estado_pago'] == 'INFRACCION_PAGO_NO_GENERADO') echo 'selected="selected"'; ?>>GENERAR PAGO</option>
<option value="INFRACCION_PAGO_INCOMPLETO"
    <?php if (isset($filter) && $filter['estado_pago'] == 'INFRACCION_PAGO_INCOMPLETO') echo 'selected="selected"'; ?> 
>PAGO CUOTAS/CONTADO</option>
<option value="INFRACCION_PAGO_COMPLETO"
   <?php if (isset($filter) && $filter['estado_pago'] == 'INFRACCION_PAGO_COMPLETO') echo 'selected="selected"'; ?> 
>PAGO COMPLETO</option>
<option value="INFRACCION_PAGO_EXHIMIDO"
   <?php if (isset($filter) && $filter['estado_pago'] == 'INFRACCION_PAGO_EXHIMIDO') echo 'selected="selected"'; ?> 
> EXHIMIDO</option>


</select>
</div>
</div>


  </div>



   <div class="form-actions noborder text-right">
   <a href="<?php echo base_url() ;?>infraccionvial/limpiar" class="btn default">Limpiar</a>
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
 <div class="actions">
  <div class="btn-group btn-group-devided">
   <a class="btn btn-transparent red btn-outline btn-circle btn-sm active"
     href="<?php echo base_url();?>infraccionvial/downloadExcelActual"
     target="_blank"
     > 
  <i class="fa fa-file-excel-o"></i>   
  Exportar las actas del Día </a>
  <a class="btn btn-transparent green btn-outline btn-circle btn-sm active"
     href="<?php echo base_url();?>infraccionvial/downloadExcel"
     target="_blank"
     > 
  <i class="fa fa-file-excel-o"></i>   
  Exportar las actas del Filtro </a>

  
  </div>
  </div>
 </div>
 <div class="portlet-body">
 <div class="table-toolbar">
 <div class="row">
 <div class="col-md-6">
 <div class="btn-group">
 <a href="#" onclick="acta_module.agregar()" class="btn sbold green">
 Agregar
 <i class="fa fa-plus"></i>
 </a>
 </div>
 </div>
 </div>
 </div>
 <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table_infracciones">
 <thead>
 <tr>
 <th>ID</th>
 <th> Nro. Acta Vial</th>
 <th> Fecha Hecho</th>
 <th> Tipo Persona</th>
 <th> Infractor</th>
 <th> Dni Infractor </th>
 <th> Dominio</th>
 <!--
 <th> Usuario Alta </th>
 -->
 <th> Estado Pago</th>
 <th> Acciones </th>
 </tr>
 </thead>
 <tbody id="table_infracciones_row">
 </tbody>
 </table>     
 <div id='pagination'></div>

  <!-- load moal view contravencion -->
  <?php $this->load->view('vial/modal/modal_view'); ?>

  <!-- load modal metodo de pago -->
  <?php $this->load->view('vial/modal_pago/modal_tipo_pago');?>
   
  <!-- modal descargo -->
  <?php $this->load->view('vial/modal/modal_realizar_descargo');?>
  <!--modal entrega licencia -->
  <?php $this->load->view('vial/modal/modal_generar_comprobante_entrega_licencia');?>
  
  <!-- modal numero acta buscar -->
  <?php $this->load->view('vial/modal_buscar_acta');?>   

  <!-- modal exhimido --> 
  <?php $this->load->view('vial/modal/modal_exhimido');?>   

  
  </div>
  </div>
  <!-- END EXAMPLE TABLE PORTLET-->
  </div>
 <!-- *******************************  -->
 </div>

    <script type='text/javascript'>

     $(document).ready(function(){
       $('#pagination').on('click','a',function(e){
         e.preventDefault(); 
         const pageno = $(this).attr('data-ci-pagination-page');
        //call function load pagination 
         loadPagination(pageno);

       });

       loadPagination(0);


      /**
       * load pagination 
      **/
     function loadPagination(pagno){
       $.blockUI({ message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Cargando..</h1>' }); 
       $.ajax({
          url: "<?php echo base_url();?>"+'infraccionvial/pagination/'+pagno,
          type: 'get',
          dataType: 'json',
          success: function(response){
            $('#pagination').html(response.pagination);
            $("#table_infracciones_row").html(response.result);
            $.unblockUI();

           },
           error: function(error){
              alert("informacion ");
              $.unblockUI();
              alert('Se produjo un error : ', JSON.stringify(error));
           }
         });
       }
      
    });

    </script>
                        

                     
     