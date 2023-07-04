 
<div class="row">
  <div class="col-md-12">
  <div class="portlet light">
  <div class="portlet-title">
  <div class="caption font-orange">
  <i class="fa fa-file-text-o font-orange"></i> <span
    class="caption-subject bold uppercase"> Buscar Pago de Cuotas</span></div>
  <div class="tools">
  <a href="javascript:;" class="expand">
  </a>
  </div>
  </div>
  
  <div class="portlet-body display-block">
  <?php echo form_open('informecuotas/buscar', 'class="horizontal-form"'); ?>

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
 <div class="form-group" >  
<label class="control-label">Tipo Pago</label>
<select class="form-control"  data-toggle="tooltip" id="tipo_pago"  name="tipo_pago" >
<option value="">Seleccionar</option>
<option value="FES" <?php if (isset($filter) && $filter['tipo_pago'] == 'FES') echo 'selected="selected"'; ?>>FES</option>
<option value="BANCO" <?php if (isset($filter) && $filter['tipo_pago'] == 'BANCO') echo 'selected="selected"'; ?> >
BANCO
</option>
<option value="TARJETA_DEBITO"<?php if (isset($filter) && $filter['tipo_pago'] == 'TARJETA_DEBITO') echo 'selected="selected"'; ?> >TARJETA DEBITO
</option>
<option value="TARJETA_CREDITO" <?php if (isset($filter) && $filter['tipo_pago'] == 'TARJETA_CREDITO') echo 'selected="selected"'; ?>> 
TARJETA CREDITO
</option>
</select>
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
  

</div>



   <div class="form-actions noborder text-right">
   <a href="<?php echo base_url() ;?>informecuotas/limpiar" class="btn default">Limpiar</a>
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
 <div class="portlet light bordered">
 <div class="portlet-title">
 <div class="caption font-dark">
 <i class="icon-settings font-dark"></i>
 <span class="caption-subject bold uppercase"> Listado de Pago de Cuotas</span>
 </div>
 <div class="actions">
  <div class="btn-group btn-group-devided">
   <a class="btn btn-transparent red btn-outline btn-circle btn-sm active"
     href="<?php echo base_url();?>informecuotas/downloadExcelActual"
     target="_blank"
     > 
  <i class="fa fa-file-excel-o"></i>   
  Exportar Pagos del Día </a>
  <a class="btn btn-transparent green btn-outline btn-circle btn-sm active"
     href="<?php echo base_url();?>informecuotas/downloadExcel"
     target="_blank"
     > 
  <i class="fa fa-file-excel-o"></i>   
  Exportar Pagos del Filtro  </a>
  </div>
  </div>
 </div>
 <div class="portlet-body">
 <div class="table-toolbar">
 </div>
 <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table_infracciones">
 <thead>
  <tr>
   <th  width="10%"> Numero Acta </th>
   <th  width="5%"> Nro. Cuota</th>
   <th  width="5%"> Estado</th>
   <th  width="20%"> Tipo Pago </th>
   <th  width="20%"> Operacion </th>
   <th  width="3%"> Fecha Pago</th>
   <th  width="3%"> Hora Pago</th>
   <th  width="15%"> Importe Ley General</th>
   <th  width="30%"> Importe Ley Alcoholemia</th>
 </tr>
 </thead>
 <tbody id="table_cuotas_row">
 </tbody>
 </table>     
 <div class="row">
  <div class="col-md-6">
  <div id='pagination'></div>
  </div>
  <div class="col-md-6 right">
  <?php $this->load->view('vial/common/informacion_cuota');?>
  </div>
 </div>

  
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
          url: "<?php echo base_url();?>"+'informecuotas/pagination/'+pagno,
          type: 'get',
          dataType: 'json',
          success: function(response){
            $('#pagination').html(response.pagination);
            $("#table_cuotas_row").html(response.result);
            $.unblockUI();

           },
           error: function(){
              $.unblockUI();
              alert('Se produjo un error : ', JSON.stringify(error));
           }
         });
       }
      
    });

    </script>
                        

                     
     