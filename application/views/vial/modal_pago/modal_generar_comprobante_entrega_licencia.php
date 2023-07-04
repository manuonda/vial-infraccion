<div id="modal_comprobante_entrega_licencia" class="modal fade" tabindex="-1" data-width="860">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Comprobante de Entrega Licencia</h4>
</div>
<div class="modal-body" id="form-comprobante-contado">


<input type="hidden" id="idInfraccionPagoComprobanteCuota"/>
<input type="hidden" id="idInfraccionPagoCuotaComprobanteCuota"/>
<input type="hidden" id="estadoPagoComprobanteCuota"/>
<input type="hidden" id="dniInfractorComprobanteCuota"/>



<!-- Datos representante  -->
<div class="row">
 <div class="col-sm-6">
 <button type="button" class="btn btn yellow" id="btnCopiarDatosCuota" >Copiar datos del infractor</button>
 </div>
</div>

<br>


<div class="row">
<div class="col-sm-6">
  <div class="form-group" id="nombreApellidoRepresentanteCuota-div">
  <label class="control-label">Nombre, Apellido Representante (*)</label>
  <input id="nombreApellidoRepresentanteCuota"  class="form-control requerido-comprobante-cuota" type="text"/>
  </div>
</div>

<div class="col-sm-6">
<div class="form-group" id="dniRepresentanteCuota-div">
 <label class="control-label">DNI (*)</label>
 <input type="number" id="dniRepresentanteCuota" class="form-control requerido-comprobante-cuota"/> 
</div>  
</div>

</div>

<div class="row">
 <div class="col-sm-12">
 <div class="form-group" id="domicilioRepresentanteCuota-div">
  <label class="control-label">Domicilio Representante (*)</label>
  <input type="text" id="domicilioRepresentanteCuota" name="domicilioRepresentanteCuota" class="form-control requerido-comprobante-cuota"/>
 </div>
 </div> 
</div>

<div class="row">
 <div class="col-sm-4">
 <div class="form-group" id="vinculoRepresentanteCuota-div">
  <label class="control-label">Vínculo Representante (*)</label>
  <input type="text" id="vinculoRepresentanteCuota" name="vinculoRepresentante" class="form-control requerido-comprobante-cuota"/>
 </div>
 </div> 


<div class="row">

<div class="col-sm-3">
<div class="form-group" id="numeroCuota-div">
  <label class="control-label">Numero de Cuota : </label>
  <input id="numeroCuota" name="numeroCuota" class="form-control" type="text" readonly="true" />
  </div> 
</div>

<div class="col-sm-3">
<div class="form-group" id="importePagoComprobanteCuota-div">
  <label class="control-label">Importe a Pagar (*) : </label>
  <input id="importePagoComprobanteCuota" name="importePagoComprobanteCuota" class="form-control requerido-comprobante-cuota" type="text"  />
  </div> 
</div>
</div>



 <div id="div_message_comprobante_cuota" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_comprobante_cuota">
</div> 
</div>

</div>


<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnCerrarModalPagoCuota" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn btn blue" id="btnGenerarComprobanteCuota" >Generar Comprobante</button>

</div>
</div>



<script type="text/javascript">


  //oculto messages
  $("#message_alert_comprobante_cuota").empty();
  $("#div_message_comprobante_cuota").hide();
  

 function showModalEntregaLicencia(idInfraccion){
  
  //oculto messages
  $("#message_alert_comprobante_cuota").empty();
  $("#div_message_comprobante_cuota").hide();

  $.get('<?php echo base_url(); ?>/infraccion/get_informe/'+idInfraccion, 
         
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
                $("#precioUF").val(response.data.precio_uf);
                $("#valorUF").val(response.data.valor_uf);
                $("#dniInfractorComprobante").val(response.persona.dni);
                
                $("#modal_comprobante_cuota").modal('show'); 
              
            
          }else{
             
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
    $("#btnGenerarComprobanteCuota").click(function(ev){

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