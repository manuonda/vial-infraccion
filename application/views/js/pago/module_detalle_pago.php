
<script>

var module_detalle_pago = (function(){
        
     var eliminarPago =  function(idInfraccionPago){
          alert("elminiar pago ");
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
          message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Cargando..</h1>' 
        });
        $.get('<?php echo base_url(); ?>/infraccionpagocuota/delete_pagoCuota/'+idInfraccionPagoCuota, 
          function(response) {
          $("#btnCerrar").click();
          $("#box_detalle_pago").unblock();
          
          if(response.status=='OK'){
                window.location.reload();
           }else{
                alert("Se produjo un error al realizar el descargo");
            }
          }, 'json');
    
         }     


       // Function init
      var init = function() {
         $("#message_alert_comprobante_cuota").empty();
         $("#div_message_comprobante_cuota").hide();
       } 

  
      var generarComprobanteCuota =  function(idInfraccionPagoCuota){
  
      //oculto messages
      $("#message_alert_comprobante_cuota").empty();
      $("#div_message_comprobante_cuota").hide();

      $.get('<?php echo base_url(); ?>/infraccionpagocuota/get_pagocuota/'+idInfraccionPagoCuota, 
         
             function(response) {
            
              if(response.status=='OK'){
                  $("#idInfraccionPagoComprobanteCuota").val(response.data.idInfraccionPago);
                  $("#idInfraccionPagoCuotaComprobanteCuota").val(response.data.idInfraccionPagoCuota);
                  $("#numeroCuota").val(response.data.numero_cuota);
                  $("#importePagoComprobanteCuota").val(response.data.importe);
                  $("#estadoPagoComprobanteCuota").val(response.data.estado);
                  $("#nombreApellidoRepresentanteCuota").val(response.data.nombre_apellido);
                  $("#dniRepresentanteCuota").val(response.data.dni_representante);
                  $("#domicilioRepresentanteCuota").val(response.data.domicilio_representante);
                  $("#vinculoRepresentanteCuota").val(response.data.vinculo_representante);
                  $("#dniInfractorComprobante").val(response.persona.dni);
                  $("#modal_comprobante_cuota").modal('show'); 
              
            
            }else{
             alert("No se pudo generar el comprobante de la cuota");  
           }
       }, 'json');
  }
   
    $("#btnCopiarDatosCuota").click(function(ev){
           let dni = $("#dniInfractorComprobante").val();
           let valor = [dni+'-Involucrado'];

           $.get('<?php echo base_url(); ?>/request_json/get_informacionPersonaDomicilioActual/'+dni, 
           
          function(response) {
            
           if(response.status=='OK'){

               console.log(response.persona);
                $("#nombreApellidoRepresentanteCuota").val(response.persona.datos.nombre + "," +response.persona.datos.apellido );
                $("#dniRepresentanteCuota").val(response.persona.datos.dni);
                if(response.persona.domicilio != "" && response.persona.domicilio.length === 0){
                  $("#domicilioRepresentanteCuota").val(response.data.domicilio_representante); 
                }else{
                  $("#domicilioRepresentanteCuota").val("No hay Domicilios Asociado");
                }
                $("#vinculoRepresentanteCuota").val("TITULAR");
                
                
          }
      }, 'json');
    });

    /**
      * Evento correspondiente a generar comprobante
      * estableciendo si existe el numero de comprobante
     **/
    var generarPagoContado = function(ev){

        console.log("btnGenerarComprobanteContado");

        if(validarComprobanteCuota('form-comprobante-contado')){
          console.log("validado");

        let idInfraccionPagoCuota=$("#idInfraccionPagoCuotaComprobanteCuota").val();
        let idInfraccionPago=$("#idInfraccionPagoComprobanteCuota").val();
        let numero_cuota=$("#numeroCuota").val();
        let importe=$("#importePagoComprobanteCuota").val();
        let nombreApellidoRepresentante = $("#nombreApellidoRepresentanteCuota").val();
        let dniRepresentante =$("#dniRepresentanteCuota").val();
        let domicilioRepresentante=$("#domicilioRepresentanteCuota").val();
        let vinculoRepresentante=$("#vinculoRepresentanteCuota").val();
        let importeGeneral = $("#importePagoComprobanteGeneral").val();
        let importeAlcoholemia = $("#importePagoAlcoholemia").val();

          var data = {
                      'idInfraccionPagoCuota': idInfraccionPagoCuota,
                      'idInfraccionPago':idInfraccionPago,
                      'numero_cuota':numero_cuota,
                      'importe':importe,
                      'nombreApellido': nombreApellidoRepresentante,
                      'dni':dniRepresentante,
                      'domicilio':domicilioRepresentante,
                      'vinculo':vinculoRepresentante
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
                    }, 3000);
                   
                  
                 }
                 
          }else{
             
          }
       }, 'json');
      }
   };


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


      //oculto messages
  $("#message_alert_comprobante_contado").empty();
  $("#div_message_comprobante_contado").hide();
  

 var  generarComprobanteContado = function(idInfraccionPagoCuota){
  
  //oculto messages
  $("#message_alert_comprobante_contado").empty();
  $("#div_message_comprobante_contado").hide();

  $.get('<?php echo base_url(); ?>/infraccionpagocuota/get_pagocuota/'+idInfraccionPagoCuota, 
         
          function(response) {
            
           if(response.status=='OK'){

                $("#idInfraccionPagoComprobanteContado").val(response.data.idInfraccionPago);
                $("#idInfraccionPagoCuotaComprobanteContado").val(response.data.idInfraccionPagoCuota);
                $("#numeroCuotaComprobanteContado").val(response.data.numero_cuota);
                $("#importePagoComprobanteContado").val(response.data.importe);
                $("#estadoPagoComprobanteContado").val(response.data.estado);
                $("#nombreApellidoRepresentante").val(response.data.nombre_apellido);
                $("#dniRepresentante").val(response.data.dni_representante);
                $("#domicilioRepresentante").val(response.data.domicilio_representante);
                $("#vinculoRepresentante").val(response.data.vinculo_representante);
                $("#dniInfractorComprobante").val(response.persona.dni);
                $("#importeGeneral").val(response.data.importe_general);
                $("#importeAlcoholemia").val(response.data.importe_alcoholemia);
                
                $("#modal_comprobante_contado").modal('show'); 
                console.log("estado pago : "+response.data.estado);
            
          }else{
             
          }
      }, 'json');
 
  }
   
    $("#btnCopiarDatos").click(function(ev){
           let dni = $("#dniInfractorComprobante").val();
           let valor = [dni+'-Involucrado'];

           $.get('<?php echo base_url(); ?>/request_json/get_informacionPersonaDomicilioActual/'+dni, 
           
          function(response) {
            
           if(response.status=='OK'){

               console.log(response.persona);
                $("#nombreApellidoRepresentante").val(response.persona.datos.nombre + "," +response.persona.datos.apellido );
                $("#dniRepresentante").val(response.persona.datos.dni);
                if(response.persona.domicilio != "" && response.persona.domicilio.length === 0){
                  $("#domicilioRepresentante").val(response.data.domicilio_representante); 
                }else{
                  $("#domicilioRepresentante").val("No hay Domicilios Asociado");
                }
                $("#vinculoRepresentante").val("TITULAR");
                
                
          }
      }, 'json');
    });

    /**
      * Evento correspondiente a generar comprobante
      * estableciendo si existe el numero de comprobante
     **/
    var generarPagoContado = function(ev){

        console.log("btnGenerarComprobanteContado");

        if(validarComprobanteContado('form-comprobante-contado')){
          console.log("validado");

        let idInfraccionPagoCuota=$("#idInfraccionPagoCuotaComprobanteContado").val();
        let idInfraccionPago=$("#idInfraccionPagoComprobanteContado").val();
        let numero_cuota=$("#numeroCuotaComprobanteContado").val();
        let importe=$("#importePagoComprobanteContado").val();
        let nombreApellidoRepresentante = $("#nombreApellidoRepresentante").val();
        let dniRepresentante =$("#dniRepresentante").val();
        let domicilioRepresentante=$("#domicilioRepresentante").val();
        let vinculoRepresentante=$("#vinculoRepresentante").val();
        let importeGeneral = $("#importeGeneral").val();
        let importeAlcoholemia = $("#importeAlcoholemia").val();


          var data = {
                      'idInfraccionPagoCuota': idInfraccionPagoCuota,
                      'idInfraccionPago':idInfraccionPago,
                      'numero_cuota':numero_cuota,
                      'importeGeneral':importeGeneral,
                      'importeAlcoholemia': importeAlcoholemia,
                      'nombreApellido': nombreApellidoRepresentante,
                      'dni':dniRepresentante,
                      'domicilio':domicilioRepresentante,
                      'vinculo':vinculoRepresentante
          };

          $.post('<?php echo base_url(); ?>/infraccionpagocuota/generarComprobanteContado/', 
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
                    }, 3000);
                   
                  
                 }
                 
          }else{
             
          }
       }, 'json');
  
    
     }
   }


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


   
   return {
      eliminarPago : eliminarPago,
      eliminarPagoCuota: eliminarPagoCuota,
      validarComprobanteCuota : validarComprobanteCuota,
      validateComprobante: validateComprobante ,
      generarComprobanteCuota : generarComprobanteCuota ,
      generarComprobanteContado : generarComprobanteContado,
      generarPagoContado : generarPagoContado 
   }

}());
</script>
 