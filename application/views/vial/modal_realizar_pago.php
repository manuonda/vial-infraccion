<div id="modal_pago" class="modal fade" tabindex="-1" data-width="860">

 <?php echo form_open_multipart('infraccionvial/guardar', ' id="form-realizar-pago" class="horizontal-form"'); ?>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Datos de Pago</h4>
</div>
<div class="modal-body">
  

<input type="hidden" id="idInfraccionPagoCuota"/>
<input type="hidden" id="idInfraccionPago"/>
<div class="row ">
<div class="col-sm-6">
<div class="form-group form-md-line-input has-feedback">    
<label class="control-label">Fecha</label>   
<div class="input-group input-medium date date-picker" data-date-format="    dd-mm-yyyy" >
<input type="text" class="form-control" readonly="" name="fecha" id="fecha"
value="<?php if (isset($fecha_hecho)) echo $fecha_hecho; ?>">
<span class="input-group-btn">
<button class="btn default" type="button">
<i class="fa fa-calendar"></i>
</button>
</span>
</div>
<!-- /input-group -->
<span class="help-block"> Fecha </span>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-md-line-input has-feedback"><label class="control-label">Hora</label>
<div class="input-group">
<input type="text" class="form-control timepicker timepicker-24" name="hora" id="hora"
value=""
>
<span class="input-group-btn">
<button class="btn default" type="button">
<i class="fa fa-clock-o"></i>
</button>
</span>
</div>
</div>
</div>
</div>


<div class="row">

<div class="col-sm-6">
<div class="form-group">
  <label class="control-label">Numero de Cuota : </label>
  <input id="numero_cuota" name="numero_cuota" class="form-control" placeholder="0.00" type="text" readonly="true" />
  </div> 
</div>

<div class="col-sm-6">
<div class="form-group">
  <label class="control-label">Importe a Pagar : </label>
  <input id="importe" name="importe" class="form-control" placeholder="0.00" type="text" readonly="true" />
  </div> 
</div>
</div>


<div class="row">
<div class="col-sm-6">
<div class="form-group" id="comprobante-div"> 
  <label class="control-label">Comprobante(*) : </label>
  <input id="comprobante" name="comprobante" class="form-control requerido" placeholder="Comprobante" type="text" />
  <span class="span_none" id="comprobante-error">Ingrese el comprobante </span>
  </div> 
</div>
</div>

</div>







 <div id="div_message" class="custom-alerts alert alert-danger fade in">
<div id="message_alert">
</div> 
</div>


<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnCerrarModalPago" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnGuardarPago">Realizar Pago</button>
<button type="button" class="btn btn blue" id="btnGenerarComprobante" >Generar Comprobante<button>

</div>
</form>

</div>

<script type="text/javascript">
  /** Funcion que muestra el modal 
    * de Generar el Pago 
    **/

  //oculto messages
  $("#div_message").hide();
  

 function showModalRealizarPago(idInfraccionPagoCuota){
  

  $.get('<?php echo base_url(); ?>/infraccionpagocuota/get_pagocuota/'+idInfraccionPagoCuota, 
         
          function(response) {
            
           if(response.status=='OK'){
                console.log("aqui ingreso");
               
                 ///Generamos la url para la generacion del comprobante
                 //var base_url="'"+<?php echo base_url().'infraccionpago';?>;

                // console.log("base_url : "+base_url);

                //$("#btnGenerarComprobante").attr("href","");  //
                //var urlGenerarComprobante=$("#btnGenerarComprobante").attr("href")+response.data.url_comprobante ;
                //console.log("urlGenerarComprobante : "+response.data.url_comprobante);
                 //var urlGenerarComprobante=urlGenerarComprobante+idInfraccionPagoCuota;
   
                //$("#btnGenerarComprobante").attr("href", urlGenerarComprobante);
                $("#idInfraccionPago").val(response.data.idInfraccionPago);
                $("#idInfraccionPagoCuota").val(response.data.idInfraccionPagoCuota);
                $("#numero_cuota").val(response.data.numero_cuota);
                $("#importe").val(response.data.importe);
                $("#comprobante").val(response.data.numero_comprobante); 
                
                $("#modal_pago").modal('show'); 
                 console.log("modal_view");
                
                //Verificamos si habilito o no el boton 
                //de realizar pago segun el estado donde se encuentre
                console.log("estado pago : "+response.data.estado);
                if(response.data.estado=='CUOTA_PAGADA'){
                  $("#btnGuardarPago").attr('disabled',true);
                  $("#btnGenerarComprobante").attr('disabled',true);  
                }

                //mostramos el boton de pago si ya se genero 
                //un nmero de comprobante 
                if(response.data.numero_comprobante==''|| response.data.numero_comprobante==null){
                  $("#btnGuardarPago").attr('disabled',true);
                }

              

          }else{
             
          }
      }, 'json');
 
 }

 $("#btnGuardarPago").click(function(ev){
     var idInfraccionPagoCuota=$("#idInfraccionPagoCuota").val();
    var idInfraccionPago=$("#idInfraccionPago").val();
    var fecha=$("#fecha").val();
    var hora=$("#hora").val();
    var tipo_pago=$("#tipo_pago").val();
    var numero_cuota=$("#numero_cuota").val();
    var importe=$("#importe").val();
    var comprobante=$("#comprobante").val();



    if(validate()){

      var data = {'idInfraccionPagoCuota': idInfraccionPagoCuota,'idInfraccionPago':idInfraccionPago,'fecha':fecha,'hora':hora,'numero_cuota':numero_cuota,'importe':importe,'comprobante':comprobante};

      $.post('<?php echo base_url(); ?>/infraccionpagocuota/post_pagoCuota/', 
          JSON.stringify(data),
          function(response) {
             console.log("response=> "+JSON.stringify(response));
          if(response.status=='OK'){
                console.log("aqui ingreso");
                $("#btnCerrarModalPago").click();
                 //window.location.href=response.url;
                 //window.open(response.url,'_blank');
          }else{
             
          }
      }, 'json');
 

    }
  });


    /**
      * Evento correspondiente a generar comprobante
      * estableciendo si existe el numero de comprobante
     **/
    $("#btnGenerarComprobante").click(function(ev){
        console.log("btnGenerarComprobante");

        var idInfraccionPagoCuota=$("#idInfraccionPagoCuota").val();
        var idInfraccionPago=$("#idInfraccionPago").val();
        var fecha=$("#fecha").val();
        var hora=$("#hora").val();
        var tipo_pago=$("#tipo_pago").val();
        var numero_cuota=$("#numero_cuota").val();
        var importe=$("#importe").val();
        var comprobante=$("#comprobante").val();

        if(validate()){

          var data = {'idInfraccionPagoCuota': idInfraccionPagoCuota,'idInfraccionPago':idInfraccionPago,'fecha':fecha,'hora':hora,'numero_cuota':numero_cuota,'importe':importe,'comprobante':comprobante};
          $.post('<?php echo base_url(); ?>/infraccionpagocuota/generarComprobanteCuota/', 
          JSON.stringify(data),
          function(response) {
             console.log("response=> "+JSON.stringify(response));
          if(response.status=='OK'){
                console.log("aqui ingreso");
                $("#btnCerrarModalPago").click();
                 if(response.data.url_comprobante!=null && response.data.url_comprobante!=""){
                   window.open(response.data.url_comprobante,'_blank'); 
                   /*$("#hrefComprobante").attr("href","");  //
                   $("#hrefComprobante").attr("href",response.data.url_comprobante);
                   $("#hrefComprobante").click();
                   */
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
    function validate(){
      console.log("validarCreateView");
            var msg="";

            var bandComprobante=true;
            
             if($("#comprobante").val()=="" || $("#comprobante").length==0){
               msg=msg + " \n.Debe establecer el comprobante";
               bandComprobante=false;   
            }

            if(bandComprobante){
                return true;
            }else{
                console.log("msg =>"+msg);
                //alert(msg);
                $("#div_message").show();
                $("#message_alert").empty();
                $("#message_alert").append(msg);
                return false;
            }

    }
      


   
</script>