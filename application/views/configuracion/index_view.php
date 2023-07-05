
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
 

 <div class="portlet-body"> 
 <div class="row">
 <div class="col-md-3">
<div class="form-group" id="valor-div">
<label class="control-label">Valores</label>
<div class=" input-group bootstrap-touchspin">
<select class="form-control requerido"  data-toggle="tooltip" id="id_valor_unidad" 
 onchange="loadValor(event)" >
<option value="">-- Seleccionar --</option>
<?php foreach ($valores as $valor): ?>                                                                        
<option id_valor_unidad="<?php echo $valor->id_valor;?>" 
        value="<?php echo $valor->valor ?>"
        estado="<?php echo $valor->estado;?>">
<?php echo $valor->valor; ?></option>
<?php endforeach; ?>
 </select>
 </div>
 <span class="span_none" id="id-error-unidad" style="color:red; font-size:23;"> Seleccione </span>
 </div>
 </div>
 <div class="col-md-3">
  <label>Valor Unidad</label>
   <div class="form-group">
    <input type="number" id="valor_unidad" />
     <span class="span_none" id="valor-error-unidad" style="color: red; font-size: 23;" > Debe ingresar valor </span>
   </div>

 </div>
  <div class="col-md-3">
  <label>Estado</label>
   <div class="form-group">
    <input type="checkbox" id="estado_unidad" />
     <span class="span_none" id="estado-error-unidad" style="color:red;  font-size:23"> Seleccione </span>
   </div>

 </div>
</div>

<!-- Acciones -->
<div class="form-actions right">
<button type="button"  onclick="guardar()" class="btn green">
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
         $("#id-error-unidad").hide();
         $("#estado-error-unidad").hide();
         $("#valor-error-unidad").hide();
       }); 
 
 function loadValor(event){
   console.log(event);
   const idSelect = event.target.id;
   const value = event.target.value;
   const idValorUnidad = event.target.options[event.target.selectedIndex].getAttribute('id_valor_unidad');
   const estadoUnidad = event.target.options[event.target.selectedIndex].getAttribute('estado');
   if( estadoUnidad === "1") {
       document.getElementById("estado_unidad").checked = true;
       document.getElementById("estado_unidad").value = estadoUnidad;
   } else {
       document.getElementById("estado_unidad").checked = false;
       document.getElementById("estado_unidad").value = estadoUnidad;
   }
   debugger;
   document.getElementById("valor_unidad").value= value;
   
 }

 function guardar() {
    $("#id-error-unidad").hide();
    $("#estado-error-unidad").hide();
    $("#valor-error-unidad").hide();
   const valorUnidad = document.getElementById("valor_unidad").value;
   const estadoUnidad = document.getElementById("estado_unidad").checked;
   const valueSelected = document.getElementById("id_valor_unidad").value;
   debugger;
   if ( valorUnidad === "") {
      $("#valor-error-unidad").show();
      return;
   } else if (valueSelected === ""){
        $("#id-error-unidad").show();
        return; 
   } else {
     //guardao los valores
     $("#valor-error-unidad").hide();
      $("#id-error-unidad").hide();
     //se debe enviar los datos al controller Configuraciones y pasar los datos
      const event = document.getElementById("id_valor_unidad");
      const idSelect = event.id;
      const value = event.value;
      const idValorUnidad = event.options[event.selectedIndex].getAttribute('id_valor_unidad');   
       var data = {'idValorUnidad': idValorUnidad,
                   'valorUnidad':valorUnidad,
                   'estadoUnidad':estadoUnidad ? 1 : 0
                  };


      $.post('<?php echo base_url(); ?>/configuraciones/post_update/', 
          JSON.stringify(data),
          function(response) {
             console.log("response=> "+JSON.stringify(response));
          if(response.status=='OK'){
                alert("Se actualizo el valor de Unidad");
                window.location.reload();
          }else{
                alert("Se Produjo un Error");
          }
      }, 'json');
    }
   }
 
 </script>
          

                     
     