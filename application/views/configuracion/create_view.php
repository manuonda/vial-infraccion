
  <?php echo form_open_multipart('configuraciones/guardar', ' id="formulario" class="horizontal-form"'); ?>
 <div class="row"> 
 <div class="col-md-12">
 <!-- BEGIN EXAMPLE TABLE PORTLET-->
 <div class="portlet light bordered">
 <div class="portlet-title">
 <div class="caption font-dark">
 <i class="icon-settings font-dark"></i>
 <span class="caption-subject bold uppercase"> Crear Valor Unidad </span>
 </div>
 </div>
 

 <div class="portlet-body"> 
 <div class="row">
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
 


 function guardar() {
    $("#estado-error-unidad").hide();
    $("#valor-error-unidad").hide();
   const valorUnidad = document.getElementById("valor_unidad").value;
   const estadoUnidad = document.getElementById("estado_unidad").checked;
   debugger;
   if ( valorUnidad === "") {
      $("#valor-error-unidad").show();
      return;
   } else {
     //guardao los valores
      $("#valor-error-unidad").hide();
     //se debe enviar los datos al controller Configuraciones y pasar los datos
       var data = {
                   'valorUnidad':valorUnidad,
                   'estadoUnidad':estadoUnidad ? 1 : 0
                  };


      $.post('<?php echo base_url(); ?>/configuraciones/post_guardar/', 
          JSON.stringify(data),
          function(response) {
             console.log("response=> "+JSON.stringify(response));
          if(response.status=='OK'){
                alert("Se agrego el valor de Unidad");
                window.location.reload("configuraciones/index");
          }else{
                alert("Se Produjo un Error");
          }
      }, 'json');
    }
   }
 
 </script>
          

                     
     