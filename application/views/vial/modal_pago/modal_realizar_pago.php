<div id="modal_pago" class="modal container fade" tabindex="-1" >

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Datos de Pago</h4>
</div>
<div class="modal-body">
  

<input type="hidden" id="idInfraccionPagoCuota"/>
<input type="hidden" id="idInfraccionPago"/>
<input type="hidden" id="estadoPago"/>



<div class="row">
<table class="table table-bordered table-striped">
<tbody>
<tr class="success">
<td>Importe Leyes Generales</td>
<td><label><strong>$ <span class="success" id="importe_general"></span> </strong></label></td>
</tr>
<tr><td>Importe Alcoholemia</td>
<td><label><strong>$ <span id="importe_alcoholemia"></span></strong></label></td>
</tr>
<tr class="success"><td> Importe Total a Pagar </td>
<td><label><strong>$ <span id="importe_total" class="warning"></span></strong></label></td>
</tr>
<tr><td> Número de Cuota </td>
<td><label><strong><span id="numero_cuota"></span></strong></label></td>
</tr>   

</tbody>
</table>
</div> 

<!--
<div class="row">
<label><strong>NOTA:</strong>En caso de que no exista el valor de algunos de los comprobantes color el valor <strong>0(cero)</strong></label>
</div>
-->
<div class="row">
  <div class="col-md-12">
  <div class="form-group" >
 <h4>SELECCIONE COMO SE REALIZO EL PAGO</h4>
</div> 
</div>
</div>
<div class="row">
<div class="col-md-3">
<div class="radio">
<label>
<input type="radio" name="tipo_pago" value="FES"   onclick="module_generar_pago.mostrarSection('fes')">
FES
</label>
</div>
</div>
<div class="col-md-3">
<div class="radio">
<label>
<input type="radio" name="tipo_pago" value="BANCO"   onclick="module_generar_pago.mostrarSection('banco')">
BANCO
</label>
</div>
</div>   
<div class="col-md-3">
<div class="radio">
<label>
<input type="radio" name="tipo_pago" value="TARJETA_DEBITO" onclick="module_generar_pago.mostrarSection('tarjeta')">
TARJETA DEBITO
</label>
</div>
</div>
<div class="col-md-3">
<div class="radio">
<label>
<input type="radio" name="tipo_pago" value="TARJETA_CREDITO" onclick="module_generar_pago.mostrarSection('tarjeta')">
 TARJETA CREDITO
</label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-3" id="tipo_pago-div">
 <span class="help-block help-block-error" id="tipo_pago-error">Seleccion un Tipo de Pago Realizado</span>
 </div>
</div>

<hr/>


<!-- Referido a tarjeta de credito -->
<div  id="div-credito">
  <h4><strong>Completar los siguientes campos</strong></h4>  
<div class="row">
  <div class="col-md-3">
  <div class="form-group"  id="numero_compra-div">
    <label>Numero Compra</label>
    <input type="text" id="numero_compra" />
    <span class="help-block help-block-error" id="numero_compra-error">Debe Ingresar Numero Compra</span>
   </div> 
 </div>

 <div class='col-md-3'>
  <div class="form-group"  id="digito_factura-div">
    <label>Digito de factura</label>
    <input type="text" id="digito_factura" />
    <span class="help-block help-block-error" id="digito_factura-error">Debe Ingresar Digito Factura</span>
   </div> 
  </div>
  
  <div class="col-md-3">
  <div class="form-group"  id="numero_factura-div">
    <label>Numero de factura</label>
    <input type="text" id="numero_factura" />
    <span class="help-block help-block-error" id="numero_factura-error">Debe Ingresar Numero Factura</span>
   </div> 
 </div>
 <div class="col-md-3">
 <div class="form-group"  id="tipo_tarjeta-div">
    <label>Tipo de Tarjetas </label>
    <select id="tipo_tarjeta" class="form-control">
      <option value="-1">-- Seleccionar --</option>
      <?php foreach ($tipotarjetas as $tipo): ?>                                                                        
      <option value="<?php echo $tipo->id_tipo_tarjeta ?>">    
      <?php echo $tipo->nombre; ?></option>
      <?php endforeach; ?>
    </select>  
    <span class="help-block help-block-error" id="tipo_tarjeta-error">Debe Seleccionar Tipo Tarjeta</span>
   </div> 
 </div>

</div> 
<hr/>

</div> 


<!-- Referido a fes -->
<div id="fes">
<h4><strong>Completar los siguientes campos</strong></h4> 
<div class="row">
<div class="col-md-3">
<div class="form-group" id="comprobante_generado_alcoholemia-div">
    <label>Comprobante Alcoholemia(*)</label>
    <input type="text" id="comprobante_generado_alcoholemia" class="form-control requerido" />
    <span class="help-block help-block-error" id="comprobante_generado_alcoholemia-error">Requerido</span>
    </div>
</div>

  <div class="col-md-3">
<div class="form-group" id="comprobante_generado_general-div">
    <label>Comprobante General (*) </label>
    <input type="text" id="comprobante_generado_general" class="form-control requerido" />
    <span class="help-block help-block-error" id="comprobante_generado_general-error">Requerido</span>
    </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
<div class="form-group" id="comprobante_generado_alcoholemia-div">
<span class="label label-primary">En caso de No tener los comprobantes color un valor 0</span>
</div>
</div>
</div>
</div>


<!-- comprobante de banco -->
<div id="banco">
<div class="row">
<div class="col-md-3">
<div class="form-group" id="comprobante_banco-div">
    <label>Comprobante Banco</label>
    <input type="text" id="comprobante_banco" class="form-control requerido"  disabled="true" />
    </div>
</div>

  </div>
</div>



<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnCerrarModalPago" class="btn btn-outline dark">Cerrar</button>
<button type="button" onclick="module_generar_pago.realizarPago()" class="btn green" id="btnGuardarPago">Realizar Pago</button>
</div>
</div>



<script type="text/javascript">


 var module_generar_pago = (function() {


    /**
      funcion que permite inicializar 
      los valores del modal
     */
    var init = function() {
       $("#comprobante_generado_alcoholemia-div").hide();
       $("#comprobante_generado_general-div").hide();
       $("#comprobante_generado_alcoholemia-error").hide();
       $("#comprobante_generado_general-error").hide();
       $("#tipo_pago-div").hide();
       $("#div-credito").hide();
       $("#contado").hide();
       $("#digito_factura-error").hide();
       $("#numero_factura-error").hide();
       $("#numero_compra-error").hide();
       $("#tipo_tarjeta-error").hide();
       $("input[name=tipo_pago]").prop('checked', false);    
       $("#banco").hide();
       $("#fes").hide();
     }

   /**
     funcion que permite realizar 
     un determinado pago de cuota 
   **/
    var realizarPago = function() {
     $("#comprobante_generado_general-error").hide();
     $("#comprobante_generado_alcoholemia-error").hide();
     $("#numero_compra-error").hide();
     
     $("#comprobante_generado_alcoholemia-div").removeClass('has-error');
     $("#comprobante_generado_general-div").removeClass('has-error');
     $("#tipo_pago-error").removeClass('has-error');
     $("#numero_compra-error").removeClass('has-error');
     $("#numero_compra-div").removeClass('has-error');
     $("#digito_factura-error").removeClass('has-error');
     $("#digito_factura-div").removeClass('has-error');
     $("#numero_factura-div").removeClass('has-error');
     $("#numero_factura-error").removeClass('has-error');


    var comprobante_generado_alcoholemia = $("#comprobante_generado_alcoholemia").val();
    var comprobante_generado_general     = $("#comprobante_generado_general").val();
    var tipo_pago = $("input[name='tipo_pago']:checked"). val();
    var numero_compra =$("#numero_compra").val();
    var digito_factura = $("#digito_factura").val();
    var numero_factura = $("#numero_factura").val();
    var comprobante_banco = $("#comprobante_banco").val();
    var tipo_tarjeta = $("#tipo_tarjeta").val();
    
    var bandError = false;

    
    
    if ( tipo_pago === ""  || tipo_pago === undefined ){
       $("#tipo_pago-div").show();
       $("#tipo_pago-div").addClass('has-error');
       $("#tipo_pago-error").addClass('error_input');  
       bandError = true;
    } else if ( (tipo_pago === 'TARJETA_CREDITO' || tipo_pago ==='TARJETA_DEBITO' ) && numero_compra === '') {
       $("#numero_compra-error").show();
       $("#numero_compra-div").addClass('has-error');
       $("#numero_compra-error").addClass('error_input');  
       bandError = true;
    } 

    if ( (tipo_pago === 'TARJETA_CREDITO' || tipo_pago ==='TARJETA_DEBITO' ) && digito_factura === '') {
          $("#digito_factura-error").show();
          $("#digito_factura-error").addClass('has-error');
          $("#digito_factura-div").addClass('has-error');
          bandError = true;
    } else {
         $("#digito_factura-error").hide();
         $("#digito_factura-error").removeClass('has-error');
         $("#digito_factura-div").removeClass('has-error');
    }

    if ( (tipo_pago === 'TARJETA_CREDITO' || tipo_pago ==='TARJETA_DEBITO' ) && numero_factura === '') {
          $("#numero_factura-error").show();
          $("#numero_factura-error").addClass('has-error');
          $("#numero_factura-div").addClass('has-error');
          bandError = true;
    } else {
         $("#numero_factura-error").hide();
         $("#numero_factura-error").removeClass('has-error');
         $("#numero_factura-div").removeClass('has-error');
    }    

    console.log("tipo_tarjeta : ", tipo_tarjeta);

    if ( (tipo_pago === 'TARJETA_CREDITO' || tipo_pago ==='TARJETA_DEBITO' ) && tipo_tarjeta === '-1') {
          $("#tipo_tarjeta-error").show();
          $("#tipo_tarjeta-error").addClass('has-error');
          $("#tipo_tarjeta-div").addClass('has-error');
          bandError = true;
    } else {
         $("#tipo_tarjeta-error").hide();
         $("#tipo_tarjeta-error").removeClass('has-error');
         $("#tipo_tarjeta-div").removeClass('has-error');
    }     
    


    if( tipo_pago === 'FES' && comprobante_generado_alcoholemia == "") {
         $("#comprobante_generado_alcoholemia-error").show();
         $("#comprobante_generado_alcoholemia-div").addClass('has-error');
         $("#comprobante_generado_alcoholemia").addClass('error_input');  
         bandError = true;
    }else {
        $("#comprobante_generado_alcoholemia-error").hide();
         $("#comprobante_generado_alcoholemia-div").removeClass('has-error');
         $("#comprobante_generado_alcoholemia").removeClass('error_input');  
    }

    if ( tipo_pago === 'FES' && comprobante_generado_general == "" ) {
         $("#comprobante_generado_general-error").show();
         $("#comprobante_generado_general-div").addClass('has-error');
         $("#comprobante_generado_general").addClass('error_input');  
         bandError = true;
    } else {
         $("#comprobante_generado_general-error").hide();
         $("#comprobante_generado_general-div").removeClass('has-error');
         $("#comprobante_generado_general").removeClass('error_input');  
    }
  



    if ( bandError ) {
      return;
    }

     $("#modal_pago").modal('hide'); 
     $("#box_detalle_pago").block({
        message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Realizando Pago..</h1>' 
     });

     let idInfraccionPagoCuota= $("#idInfraccionPagoCuota").val();
     let idInfraccionPago     = $("#idInfraccionPago").val(); 
     
     var data = { 'idInfraccionPagoCuota':idInfraccionPagoCuota , 
                  'comprobante_general': comprobante_generado_general , 
                  'comprobante_alcoholemia': comprobante_generado_alcoholemia,
                  'tipo_pago': tipo_pago,
                  'numero_compra': numero_compra,
                  'digito_factura': digito_factura,
                  'numero_factura': numero_factura,
                  'comprobante_banco': comprobante_banco,
                  'tipo_tarjeta': tipo_tarjeta
                };
                 

      $.post('<?php echo base_url(); ?>/infraccionpagocuota/post_pagoCuota/', 
          JSON.stringify(data),
          function(response) {
             console.log("response=> "+JSON.stringify(response));
             $("#box_detalle_pago").unblock();
          if(response.status=='OK'){
                console.log("aqui ingreso");
                $("#btnCerrarModalPago").click();
                 alert("Se realizo el pago de la cuota");
                  $.blockUI({
                     message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Cargando..</h1>' 
                  }); 
                 window.location.reload();
                 
          }else{
             $("#box_detalle_pago").unblock();
          }
      }, 'json');

   };
   /**
      * Function que permite poder mostrar 
      * la section de datos a mostrar 
      * dependiendo si es FES/CONTADO , TARJETA
     **/  
    var mostrarSection = function(tipoPago) {
        $("#tipo_pago-div").hide();
        $("#comprobante_generado_alcoholemia").val("");
        $("#comprobante_generado_general").val("");
        $("#comprobante_generado_alcoholemia-error").hide();
        $("#numero_compra-div").removeClass('has-error');
        $("#numero_compra").val("");
        $("#digito_factura").val("");
        $("#numero_factura").val("");

        if (tipoPago === 'tarjeta') {
          $("#div-credito").show();
          $("#numero_compra-error").hide();
          $("#numero_factura-error").hide();
          $("#numero_factura-error").removeClass('has-error');
          $("#numero_factura-div").removeClass('has-error');
          $("#digito_factura-error").hide();
          $("#digito_factura-error").removeClass('has-error');
          $("#digito_factura-div").removeClass('has-error');
        } else {
          $("#div-credito").hide();
          $("#numero_compra").val("");
          $("#numero_compra-div").removeClass('has-error');
        }

        if ( tipoPago === 'fes') {
            $("#fes").show();
            $("#comprobante_generado_general-div").show();
            $("#comprobante_generado_alcoholemia-div").show();  
        } else {
            $("#contado").hide();
            $("#comprobante_generado_general-div").hide();
            $("#comprobante_generado_general-error").hide();
            $("#comprobante_generado_general-div").removeClass('has-error');
            $("#comprobante_generado_general").removeClass('error_input');  
            $("#comprobante_generado_alcoholemia-div").hide();  
            $("#comprobante_generado_alcoholemia-div").removeClass('has-error'); 
        }

        if ( tipoPago == 'banco') {
          $("#banco").show();
          $("#fes").hide();
          $("#div-banco-error").show();
           $("#comprobante_banco-div").show();
          $("#comprobante_banco-error").show();
          $("#comprobante_banco-div").removeClass('has-error');
          $("#comprobante_banco-error").removeClass('has-error');
          $("#contado").show();
          $("#comprobante_generado_general-div").show();
          $("#comprobante_generado_alcoholemia-div").show();  
         } else {
          $("#banco").hide();
          $("#comprobante_banco-div").hide();
          $("#comprobante_banco-error").hide();
        }
    }


   var showModalRealizarPago = function(idInfraccionPagoCuota) {
    init();
     //oculto messages
     $("#message_alert_pago").empty();
     $("#div_message_pago").hide();
     $("#comprobante_generado_general-error").hide();
     $("#comprobante_generado_alcoholemia-error").hide();
     $("#comprobante_generado_alcoholemia-div").removeClass('has-error');
     $("#comprobante_generado_general-div").removeClass('has-error');

     $("#box_detalle_pago").block({
        message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Cargando..</h1>' 
     });

     $.get('<?php echo base_url(); ?>/infraccionpagocuota/get_pagocuota/'+idInfraccionPagoCuota, 
         
          function(response) {
            
           if(response.status=='OK'){
                var data = response.data; 
                $("#idInfraccionPago").val(response.data.idInfraccionPago);
                $("#idInfraccionPagoCuota").val(response.data.idInfraccionPagoCuota);
                $("#numero_cuota").empty();
                $("#numero_cuota").append(response.data.numero_cuota);
                $("#importe_general").empty();
                $("#importe_general").append(response.data.importe_general);
                $("#importe_alcoholemia").empty();
                $("#importe_alcoholemia").append(response.data.importe_alcoholemia);
                $("#importe_total").empty();
                $("#importe_total").append(response.data.total);
                $("#comprobante").empty();
                $("#comprobante").append(response.data.comprobante);
                $("#comprobante_banco").val(response.data.comprobante);
                $total = 0;

                $("#modal_pago").modal('show'); 
                
        
          }
          $("#box_detalle_pago").unblock();
      }, 'json');
    }


 

   return {
     realizarPago : realizarPago,
     showModalRealizarPago : showModalRealizarPago,
     mostrarSection : mostrarSection,
     init: init
   }

 }()); 

 module_generar_pago.init();



  //oculto messages
  $("#message_alert_pago").empty();
  $("#div_message_pago").hide();
   
</script>