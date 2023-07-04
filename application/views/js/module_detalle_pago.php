
<script>

var module_detalle_pago = (function(){

     var eliminarPago =  function(idInfraccionPago){
           $.blockUI({
              message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Eliminando Pago..</h1>' 
         });
          $.get('<?php echo base_url(); ?>/infraccionpago/delete_pago/'+idInfraccionPago, 
             function(response) {
             console.log("response=> "+JSON.stringify(response));
             if(response.status=='OK'){
                window.location .href="<?php echo base_url(); ?>infraccionvial/";
             }
            }, 'json');
         }

    var eliminarPagoCuota = function(idInfraccionPagoCuota){
         $("#box_detalle_pago").block({
          message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Eliminando Pago Cuota..</h1>' 
        });
        $.get('<?php echo base_url(); ?>/infraccionpagocuota/delete_pagoCuota/'+idInfraccionPagoCuota, 
          function(response) {
          $("#box_detalle_pago").unblock();
          $("#btnCerrar").click();

          if(response.status=='OK'){
              $("#box_detalle_pago").block({
                   message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Actualizando Datos..</h1>' 
              }); 
              window.location.reload();
           }else{
               alert("Se produjo un error al realizar el descargo");
            }
          }, 'json');
    
    }     



   
   
   return {
      eliminarPago : eliminarPago,
      eliminarPagoCuota: eliminarPagoCuota
   }


  }());
</script>
 