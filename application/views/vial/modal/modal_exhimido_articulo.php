
<style type="text/css">
.modal-header-success {
    color:#fff;
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #5cb85c;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
}
</style>

<div id="modal_exhimido_articulo" class="modal fade in" tabindex="-1" data-width="460">
<div class="modal-header  modal-header-sucess">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title ">Informacion de Exhimicion</h4>
</div>
<div class="modal-body">

<input id="idRowArticuloExhimido" type="hidden">
<div class="row">
 <div class="col-md-12">
 <div class="form-group">
  <label class="control-label">Adjunto a la Presente(*):</label>
  <textarea id="descripcionExhimido" class="form-control col-md-12 requerido" name="descripcion" rows="9"> </textarea> 

</div>
</div>

</div>


 <div id="div_message_exhimido" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_exhimido">
</div> 
</div>
<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnCerrarExhimido" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnDescargo" onclick="module_exhimido_articulo.guardar()">Guardar</button>
<button type="button" class="btn primary" id="btnDescargo" onclick="module_exhimido_articulo.eliminar()">Eliminar</button>
</div>
</div>



<script type="text/javascript">

   $("#div_message_exhimido").hide();

   var module_exhimido_articulo = (function() {


     var eliminar = function(){
        var idRowArticuloExhimido=$("#idRowArticuloExhimido").val();
           $("#estado_exhimido_"+idRowArticuloExhimido).val('NO');
           $("#texto_exhimido_"+idRowArticuloExhimido).val("");
           $("#action_exhimir_"+idRowArticuloExhimido).empty();
           $("#action_exhimir_"+idRowArticuloExhimido).addClass("blue");
           $("#action_exhimir_"+idRowArticuloExhimido).removeClass("yellow");
           $("#action_exhimir_"+idRowArticuloExhimido).append('<strong>NO EXHIMIDO</strong>');
           // seteo los valores
           $("#idRowArticuloExhimido").val("");
           $("#descripcionExhimido").val("");
           $("#modal_exhimido_articulo").modal('hide');
     }

     var guardar = function(generarComprobante){

        var idRowArticuloExhimido=$("#idRowArticuloExhimido").val();
        var descripcion =$("#descripcionExhimido").val();

       if(validar()){
           $("#estado_exhimido_"+idRowArticuloExhimido).val('SI');
           $("#texto_exhimido_"+idRowArticuloExhimido).val(descripcion);
           $("#action_exhimir_"+idRowArticuloExhimido).empty();
           $("#action_exhimir_"+idRowArticuloExhimido).removeClass("blue");
           $("#action_exhimir_"+idRowArticuloExhimido).addClass("yellow");
           $("#action_exhimir_"+idRowArticuloExhimido).append('<strong>SI EXHIMIDO</strong>');
           // seteo los valores
           $("#idRowArticuloExhimido").val("");
           $("#descripcionExhimido").val("");
           $("#modal_exhimido_articulo").modal('hide');

        }
     }

     var validar = function() {
            var msg="";
            var bandForm=true;
            var bandTipoPago=false;
            var bandCuota=true;
            var bandImporteTotal=true;

            var descripcion= document.getElementById("descripcionExhimido").value;

            if(descripcion.length >1){
               bandForm=true;
            }else{
              bandForm=false;
              msg="Debe ingresar una descripción";
            }


            if(bandForm){
                $("#div_message_exhimido").hide();
                 return true;
              }else{
                $("#div_message_exhimido").show();
                $("#message_alert_exhimido").empty();
                $("#message_alert_exhimido").append(msg);
                return false;
            }
      }
     
 
     return {
        eliminar: eliminar,
        guardar : guardar
     }

   }());

</script>