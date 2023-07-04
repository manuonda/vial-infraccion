
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

<div id="modal_eliminar_pago_cuota" class="modal fade in" tabindex="-1" data-width="360">
<div class="modal-header  modal-header-sucess">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title ">Eliminar Pago Cuota</h4>
</div>
<div class="modal-body">
  
<input type="hidden" id="idInfraccionPagoCuota"/>


<div class="row">
 <div class="col-md-12">
 <div class="form-group">
  <label class="control-label">Descripción(*):</label>
 
  <textarea id="descripcionEliminarPago" class="form-control col-md-12 requerido" name="descripcion" rows="9"> </textarea> 

</div>
</div>

</div>


 <div id="div_message_eliminar_pago_cuota" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_eliminar_pago">
</div> 
</div>

<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnCerrar" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnEliminarPagoCuota">Guardar</button>
</div>
</div>



<script type="text/javascript">
  /** Funcion que muestra el modal 
    * de Generar el Pago 
    **/

  $("#div_message_eliminar_pago_cuota").hide();

 function showModalEliminarPago(idInfraccionPagoCuota){
   console.log("showModalGenerarPago");
   //asignamos el valor de identificador de infraccion 
   $("#idInfraccion").val(idInfraccionPagoCuota);
   $("#modal_eliminar_pago_cuota").modal('show'); 
     console.log("modal_view");
 }



  


  //Funcion que permite guardar la informacion
  //del pago 
  $("#btnEliminarPagoCuota").click(function(ev){
     console.log("btnDescargo");
   
    var idInfraccionPagoCuota=$("#idInfraccionPagoCuota").val();
    var descripcion=$("#descripcionDescargo").val();

    if(validar()){
     var data = {'idInfraccionPagoCuota': idInfraccionPagoCuota,'descripcion':descripcion};
      $.post('<?php echo base_url(); ?>/infraccionpagocuota/delete_pagoCuota/', 
          JSON.stringify(data),
          function(response) {
             console.log("response=> "+JSON.stringify(response));
          if(response.status=='OK'){
                console.log("aqui ingreso");
               $("#btnCerrar").click();
                window.location.reload();
          }else{
                $("#btnCerrar").click();
               alert("Se produjo un error al realizar el descargo");
          }
      }, 'json');
    }
  });


     /**
        * Funcion que permite realizar 
        * la validacion del descargo
       */

      function validar(){
         console.log("---------------------------");
         console.log(" Funcion validar Descargo");
            var msg="";

            var bandForm=true;
            var bandTipoPago=false;
            var bandCuota=true;
            var bandImporteTotal=true;

            var descripcion=$("#descripcionEliminarPago").val();
           console.log("length: "+descripcion.length);

            //tipo pago 
            if(descripcion.length >1){
               bandForm=true;
            }else{
              bandForm=false;
              msg="Debe ingresar una descripción";
            }


            
            if(bandForm){
                $("#div_message_eliminar_pago_cuota").hide();

                return true;
            }else{
                console.log("msg =>"+msg);
                //alert(msg);
                $("#div_message_eliminar_pago_cuota").show();
                $("#message_alert_eliminar_pago").empty();
                $("#message_alert_eliminar_pago").append(msg);
                return false;
            }
             
         }
        
</script>