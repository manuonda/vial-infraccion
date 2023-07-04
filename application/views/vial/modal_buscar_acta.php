
<div id="modal_buscar_acta" class="modal fade in" tabindex="-1" data-width="360">
<div class="modal-header  modal-header-sucess">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title ">Modal Buscar Acta</h4>
</div>
<div class="modal-body">
  

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="control-label">NRO ACTA VIAL(*):</label>
<input type="text" id="numeroActaBuscar" onkeypress="return module_util.isNumber(event)" class="form-control col-md-12" name="numeroActaBuscar"/>  
</div>
</div>
</div>


 <div id="div_add_message_numero_acta" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_numero_acta">
</div> 
</div>

<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnModalBuscarActaCerrar" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnBuscarActa" onclick="acta_module.buscarNumeroActa()">Buscar</button>
</div>
</div>






<script type="text/javascript">

 var acta_module = ( function() {

    function init(){
     
      $("#message_alert_numero_acta").empty();
      $("#div_add_message_numero_acta").hide();
      $("#numeroActaBuscar").val("");
    }

   function agregar() {
    console.log("agregar ");
     init();
     $("#modal_buscar_acta").modal('show');
   }

   function buscarNumeroActa(){
     var numeroActa = document.getElementById("numeroActaBuscar").value;
     if (numeroActa != "") {
       console.log("aqui paso ");
          $.ajax({
                 type: "GET",
                 url: '<?php echo base_url(); ?>infraccionvial/buscarNumeroActa/'+numeroActa,
                 dataType: "JSON",
                 success: function (data) {
                    $("#modal_buscar_acta").modal('hide');
                    if (data != null && data.length > 0 ){
                        var acta = data[0];
                        console.log(acta);
                        if (acta != null) {
                             alert("El numero de acta se encuentra cargado");
                             window.location="<?php echo base_url();?>infraccionvial/editar/"+acta.id_infraccion;
                        }
                    } else {
                         window.location="<?php echo base_url();?>infraccionvial/agregar/"+numeroActa;
                    }
                 
                 }, error : function(data){
                       alert(data);     
                 }
         });


     } else {
              $("#message_alert_numero_acta").empty();
              $("#message_alert_numero_acta").append("Debe ingresar el numero de Acta");
              $("#div_add_message_numero_acta").show();
      }
   } 
    return {
      init : init ,
      buscarNumeroActa : buscarNumeroActa ,
      agregar : agregar
    }

 }()); 

 
 acta_module.init();

</script>