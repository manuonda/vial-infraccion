<div id="modal_comprobante" class="modal fade" tabindex="-1" data-width="860">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Comprobante</h4>
</div>
<div class="modal-body">
  

<input type="hidden" id="idInfraccionPagoComprobante"/>
<input type="hidden" id="idInfraccionPagoCuotaComprobante"/>
<input type="hidden" id="estadoPagoComprobante"/>

<div class="row">

<div class="col-sm-6">
<div class="form-group">
  <label class="control-label">Numero de Cuota : </label>
  <input id="numeroCuotaComprobante" name="numeroCuotaComprobante" class="form-control" type="text" readonly="true" />
  </div> 
</div>

<div class="col-sm-6">
<div class="form-group">
  <label class="control-label">Importe a Pagar : </label>
  <input id="importePagoComprobante" name="importePagoComprobante" class="form-control" type="text"  />
  </div> 
</div>
</div>


</div>







 <div id="div_message_comprobante" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_comprobante">
</div> 
</div>


<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnCerrarModalPago" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn btn blue" id="btnGenerarComprobante" >Generar Comprobante</button>

</div>
</div>



<script type="text/javascript">


  //oculto messages
  $("#message_alert_comprobante").empty();
  $("#div_message_comprobante").hide();
  

 function showModalGenerarComprobante(idInfraccionPagoCuota){
  
  //oculto messages
  $("#message_alert_comprobante").empty();
  $("#div_message_comprobante").hide();

  $.get('<?php echo base_url(); ?>/infraccionpagocuota/get_pagocuota/'+idInfraccionPagoCuota, 
         
          function(response) {
            
           if(response.status=='OK'){

                $("#idInfraccionPagoComprobante").val(response.data.idInfraccionPago);
                $("#idInfraccionPagoCuotaComprobante").val(response.data.idInfraccionPagoCuota);
                $("#numeroCuotaComprobante").val(response.data.numero_cuota);
                $("#importePagoComprobante").val(response.data.importe);
                $("#estadoPagoComprobante").val(response.data.estado);
                
                $("#modal_comprobante").modal('show'); 
                console.log("estado pago : "+response.data.estado);
            
          }else{
             
          }
      }, 'json');
 
 }


    /**
      * Evento correspondiente a generar comprobante
      * estableciendo si existe el numero de comprobante
     **/
    $("#btnGenerarComprobante").click(function(ev){
        console.log("btnGenerarComprobante");

        let idInfraccionPagoCuota=$("#idInfraccionPagoCuotaComprobante").val();
        let idInfraccionPago=$("#idInfraccionPagoComprobante").val();
        let fecha=$("#fechaPago").val();
        let hora=$("#horaPago").val();
        let tipo_pago=$("#tipo_pago").val();
        let numero_cuota=$("#numeroCuotaComprobante").val();
        let importe=$("#importePagoComprobante").val();
        let estado =$("#estadoPago").val();

        if(validateComprobante()){

          var data = {
                      'idInfraccionPagoCuota': idInfraccionPagoCuota,
                      'idInfraccionPago':idInfraccionPago,
                      'numero_cuota':numero_cuota,
                      'importe':importe
          };

          $.post('<?php echo base_url(); ?>/infraccionpagocuota/generarComprobanteCuota/', 
          JSON.stringify(data),
          function(response) {
             console.log("response=> "+JSON.stringify(response));
          if(response.status=='OK'){
                console.log("aqui ingreso");
                $("#btnCerrarModalPago").click();
                 if(response.data.url_comprobante!=null && response.data.url_comprobante!=""){
                   window.open(response.data.url_comprobante,'_blank'); 
                    setTimeout(function(){ 
                       window.location.reload(); 
                    }, 1500);
                   
                  
                 }
                 
          }else{
             
          }
      }, 'json');
 



     }
   });


    /**
      * Funcion que permite realizar 
      * la validacion del pago 
      * del comprobante
     **/
    function validateComprobante(){
            let msg="";
            let bandImporte = true ; 

             if($("#importePagoComprobante").val()=="" || $("#importePagoComprobante").val()<0){
               msg=msg + "Debe ingresar el importe<br>";
               bandImporte=false;   
            }

            if(bandImporte){
                return true;
            }else{
                $("#div_message_comprobante").show();
                $("#message_alert_comprobante").empty();
                $("#message_alert_comprobante").append(msg);
                return false;
            }

    }
      


   
</script>