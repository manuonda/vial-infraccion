
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

<div id="modal_exhimido" class="modal fade in" tabindex="-1" data-width="460">
<div class="modal-header  modal-header-sucess">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title ">Informacion de Exhimicion</h4>
</div>
<div class="modal-body">
  
<input type="hidden" id="idInfraccion"/>

<div class="row">
<div class="col-md-6">  
<div class="form-group" id="fecha_expedicion-div">    
  <label class="control-label">Fecha de Exhimición : </label>   
  <div class="input-group">
  <input type="date" class="form-control" id="fecha_exhimido" name="fecha_exhimido"  value="">
  <span class="input-group-btn">
  <button class="btn default" type="button">
  <i class="fa fa-calendar"></i>
  </button>
  </span>
  </div>
  </div>
</div>
</div>

<div class="row">
 <div class="col-md-12">
 <div class="form-group">
  <label class="control-label">Carece de (*):</label>
  <textarea id="descripcionCareceExhimido" class="form-control col-md-12 requerido" name="descripcionCareceExhimido" rows="9"> </textarea> 
</div>
</div>
</div>

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
<button type="button" class="btn green" id="btnDescargo" onclick="module_exhimido.guardar(false)">Guardar</button>
<button type="button" class="btn primary" id="btnDescargo" onclick="module_exhimido.guardar(true)">Guardar Y Generar Comprobante</button>

</div>
</div>



<script type="text/javascript">

   $("#div_message_exhimido").hide();

   var module_exhimido = (function() {
     
     var idInfraccion = ""; 
     var mostrar = function(idInfraccion ){
        $("#table_infracciones").block({
           message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Cargando..</h1>' 
        }); 
       $.get('<?php echo base_url(); ?>/infraccionvial/get/'+idInfraccion,
         function(response){
          $("#table_infracciones").unblock();
          var data = JSON.parse( response );
          var infraccion =  data.infraccion;   
          if ( infraccion.fecha_exhimido === null  || infraccion.fecha_exhimido === '' ) {
            let date = new Date();
            let day = date.getDate() < 10  ? '0' + date.getDate() : date.getDate();
            let month =  ( date.getMonth() + 1 ) < 10 ? '0'+(date.getMonth()+1) : (date.getMonth() + 1 );
            let dateStr = date.getFullYear()+"-"+ month +"-"+ day ;
             $("#fecha_exhimido").val(dateStr);
          } else {
            $("#fecha_exhimido").val(infraccion.fecha_exhimido );
          }
         this.idInfraccion = idInfraccion; 
         $("#idInfraccion").val(idInfraccion);
         $("#descripcionExhimido").val(infraccion.texto_exhimido);
         $("#descripcionCareceExhimido").val(infraccion.texto_carece_exhimido);
         $("#modal_exhimido").modal('show');
       }); 
     }


     var agregar = function(idInfraccion){
         this.idInfraccion = idInfraccion;  
         $("#idInfraccion").val(idInfraccion);
         $("#descripcionExhimido").val("");
         $("#modal_exhimido").modal('show'); 
     }   

     var guardar = function(generarComprobante){
        console.log('generarComprobante ', generarComprobante);

        var idInfraccion=$("#idInfraccion").val();
        var descripcion =$("#descripcionExhimido").val();
        var carece      =$("#descripcionCareceExhimido").val();
        var fecha = $("#fecha_exhimido").val();

       if(validar()){
           var data = {'id': idInfraccion,'descripcion':descripcion , 'fecha': fecha, 'carece':carece};
          $.post('<?php echo base_url(); ?>/infraccionvial/post_exhimir/', 
             JSON.stringify(data),
             function(response) {
            if(response.status=='OK'){

                $("#btnCerrarExhimido").click();
                alert(response.message);
                if ( !generarComprobante ) {
                  window.location.reload();
                } else {
                  let url = '<?php echo base_url(); ?>/infraccionvial/generarComprobanteExhimirPDF/'+idInfraccion;
                  window.open(url,'_blank');   
                  window.location.reload();
                }
                
             }else{
                 $("#btnCerrarExhimido").click();
                 alert("Se produjo un error al realizar el descargo");
             }
          }, 'json');

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
        mostrar : mostrar,
        agregar : agregar,
        guardar : guardar
     }

   }());

</script>