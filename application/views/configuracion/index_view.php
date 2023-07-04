
  <?php echo form_open_multipart('configuraciones/guardar', ' id="formulario" class="horizontal-form"'); ?>
 <div class="row"> 
 <div class="col-md-12">
 <!-- BEGIN EXAMPLE TABLE PORTLET-->
 <div class="portlet light bordered">
 <div class="portlet-title">
 <div class="caption font-dark">
 <i class="icon-settings font-dark"></i>
 <span class="caption-subject bold uppercase"> Configuracion de Valores </span>
 </div>
 </div>
 
<?php  if($this->session->flashdata('message')) { ?>
<div class="row">
 <div class="col-md-3">
 <div class="alert alert-info">
  
    <strong>
     <?php  echo $this->session->flashdata('message'); ?>
     </strong> 
    </div>
 </div>
</div>

    
 <?php } ?>

 <div class="portlet-body">
  <input type="hidden" name="id" id="id" value="<?php if (isset($configuracion)) echo $configuracion->id_configuracion; ?>" />
        

  <!--  
 <div class="row">
 <div class="col-md-3">
 <div class="form-group" id="numero_acta-div">
 <label class="control-label">VALOR UNIDAD FIJA (*)</label>
 <input class="form-control requerido" id="valor" type="text" name="valor"
        oninput="moduleConfiguracion.validateNumber(this)"
        value="<?php if (isset($configuracion)) echo $configuracion->valor; ?> "> 
 <span class="span_none" id="numero_acta-error">Ingrese Valor Unidad Fija</span>    
 </div>
 </div>

   <div class="col-md-3">
                    <label class="control-label">Serie</label>
                    <input class="form-control" placeholder="" type="text" name="serie"
                           value="<?php if (isset($configuracion)) echo $configuracion->serie; ?>"/>
                </div> 
 </div>
-->
 
 <div class="row">
 <div class="col-md-3">
<div class="form-group" id="valor-div">
<label class="control-label">Valores</label>
<div class=" input-group bootstrap-touchspin">
<select class="form-control requerido"  data-toggle="tooltip" id="id_valor_unidad" 
 onchange="loadValor(event)" >
<option value="">-- Seleccionar --</option>
<?php foreach ($valores as $valor): ?>                                                                        
<option id_valor_unidad="<?php echo $valor->id_valor;?>" value="<?php echo $valor->valor ?>">
<?php echo $valor->valor; ?></option>
<?php endforeach; ?>
 </select>
 </div>
 <span class="span_none" id="valor-error"> Seleccione </span>
 </div>
 </div>
 <div class="col-md-3">
   <div class="form-group">
    <input type="number" id="valor_unidad" />
     <span class="span_none" id="valor-error-unidad"> Seleccione </span>

   </div>

 </div>
</div>

<!-- Acciones -->
<div class="form-actions right">
<button type="button"  onClik="guardar()" class="btn green">
<i class="fa fa-save"></i> Guardar
</button>
</div>
 </div>
 </div>
 </div>
</div>
 </form>



 <script type="text/javascript">
       $(document).ready(function(){
         $("#valor-error-unidad").hide();
       }); 
 
 function loadValor(event){
   console.log(event);
   const idSelect = event.target.id;
   const value = event.target.value;
   const idValorUnidad = event.target.options[event.target.selectedIndex].getAttribute('id_valor_unidad');
   document.getElementById("valor_unidad").value= value;

   debugger;
 }

 function guardar() {
   const valorUnidad = document.getElementById("valor_unidad").value;
   if ( valorUnidad === "") {
      $("#valor-error-unidad").show();
   } else {
     //guardao los valores
     $("#valor-error-unidad").hide();
     //se debe enviar los datos al controller Configuraciones y pasar los datos
      const event = document.getElementById("id_valor_unidad");
      const idSelect = event.target.id;
      const value = event.target.value;
      const idValorUnidad = event.target.options[event.target.selectedIndex].getAttribute('id_valor_unidad');
   }
 }
 </script>
          

                     
     