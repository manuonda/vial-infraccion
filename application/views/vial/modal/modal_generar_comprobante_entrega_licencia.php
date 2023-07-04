<div id="modal_comprobante_entrega_licencia" class="modal fade" tabindex="-1" data-width="1200">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Comprobante de Entrega Documentos</h4>
</div>
<div class="modal-body" id="form-comprobante-licencia">


<input type="hidden" id="idInfraccionPagoComprobanteCuota"/>
<input type="hidden" id="idInfraccionPagoCuotaComprobanteCuota"/>
<input type="hidden" id="estadoPagoComprobanteCuota"/>
<input type="hidden" id="dniInfractorComprobanteCuota"/>
<input type="hidden" id="cuilRepresentante"/>
<input type="hidden" id="cuilConductor"/>



 <div class="row">
 <div class="col-md-6">
 <h3 class="form-section">Datos del Propietario</h3>
 <table class="table table-bordered table-striped">
 <tbody>
 <tr>
 <td width="20%">Nombre Apellido</td>
 <td width="30%"><div id="nombreApellidoPropietario"></div></td>
 </tr>
 <tr> 
 <td width="15%">Dni</td>
 <td width="30%"><div id="dniPropietario"></div></td>
 </tr>
 <tr>
 <td width="20%">Domicilio</td>
 <td width="30%"><div id="domicilioPropietario"></div></td>
 </tr>
 <tr id = "mostrarTituloPersonaJuridica">
 <td> TIPO PERSONA</td>
 <td> <strong class="btn default btn-xs red">PERSONA JURIDICA</strong></td>
 </tr>

 </tbody>
 </table>
  <button type="button" class="btn btn yellow" id="btnCopiarDatosPropietario" onclick="module_comprobante_licencia.copiarDatosPropietario()" >Copiar datos del Propietario</button>
 </div>

  <div class="col-md-6">
 <h3 class="form-section">Datos del Conductor</h3>
 <table class="table table-bordered table-striped">
 <tbody>
 <tr>
 <td width="20%">Nombre Apellido</td>
 <td width="30%"><div id="nombreApellidoConductor"></div></td>
 </tr>
 <tr> 
 <td width="15%">Dni</td>
 <td width="30%"><div id="dniConductor"></div></td>
 </tr>
 <tr>
 <td width="20%">Domicilio</td>
 <td width="30%"><div id="domicilioConductor"></div></td>
 </tr>
 </tbody>
 </table>
  <button type="button" class="btn btn yellow"  onclick="module_comprobante_licencia.copiarDatosConductor()" >Copiar datos del Conductor</button>
 </div>
 </div>  
 
   
 <hr/>

<h3>Datos del Representante</h3>

<div class="row" id="datos_representante">
<div class="col-sm-3">
  <div class="form-group" id="nombreApellidoRepresentante-div">
  <label class="control-label">Nombre, Apellido Representante (*)</label>
  <input id="nombreApellidoRepresentante"  class="form-control requerido-comprobante-licencia" type="text"/>
  </div>
</div>

<div class="col-sm-3">
<div class="form-group" id="dniRepresentante-div">
 <label class="control-label">DNI (*)</label>
 <input type="number" id="dniRepresentante" class="form-control requerido-comprobante-licencia"/> 
</div>  
</div>

<div class="col-sm-4">
 <div class="form-group" id="vinculoRepresentante-div">
  <label class="control-label">Vínculo Representante (*)</label>
  <input type="text" id="vinculoRepresentante" name="vinculoRepresentante" class="form-control requerido-comprobante-licencia"/>
 </div>
 </div> 


</div>

<div class="row">
 <div class="col-sm-6">
 <div class="form-group" id="domicilioRepresentante-div">
  <label class="control-label">Domicilio Representante </label>
  <input type="text" id="domicilioRepresentante" name="domicilioRepresentante" class="form-control"/>
 </div>
 </div> 
</div>



 <hr/>
 <h3>Descripción de Entrega</h3>
 <div class="row">
 <div class="col-sm-6">
 <div class="form-group">
 <div class="mt-checkbox-list">
 <label class="mt-checkbox mt-checkbox-outline"> DNI
 <input type="checkbox" value="1" name="test" id="pedido_dni">
 <span></span>
 </label>
 <label class="mt-checkbox mt-checkbox-outline"> LICENCIA
 <input type="checkbox" value="1" name="test" id="pedido_licencia">
 <span></span>
 </label>
 <label class="mt-checkbox mt-checkbox-outline" > CEDULA
 <input type="checkbox" value="1" name="test" id="pedido_cedula">
 <span></span>
 </label>
 
 <label class="mt-checkbox mt-checkbox-outline" id="pedido_otros"> OTROS
 <input type="checkbox" value="1" name="test" id="pedido_otro">
 <span></span>
 </label>
 </div>
 </div>
 </div>
 </div>

 <div class="row">
 <div class="col-sm-6">
 <div class="form-group" id="descripcionRepresentante-div">
  <label class="control-label">Descripcion</label>
  <input type="text" id="descripcionRepresentante" name="descripcionRepresentante" class="form-control"/>
 </div>
 </div> 
</div>
 
 
 <div class="row">
 

 <div id="div_message_comprobante_licencia" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_comprobante_licencia">
</div> 
</div>

</div>


<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnCerrarModalLicencia" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn btn blue" id="btnGenerarComprobanteLicencia" onclick="module_comprobante_licencia.generar()">Generar Comprobante</button>
</div>
</div>



<script type="text/javascript">
 
  
  

  var module_comprobante_licencia = (function(){
   
  var _propietario = null;
  var _propietarioDomicilio = null;
  var _conductor = null;
  var _conductorDomicilio = null;
  var _informe = null;

  

  var showModal =  function(idInfraccion){
  //oculto messages
  $("#message_alert_comprobante_licencia").empty();
  $("#div_message_comprobante_licencia").hide();
  $("#descripcionRepresentante-div").hide();

  $("#pedido_otros").change(function(ev){
      console.log( $("#pedido_otro").prop('checked'));

      if($("#pedido_otro").prop('checked')){
        console.log("aqui ingreso");
         $("#descripcionRepresentante-div").show();
      }else{
        $("#descripcionRepresentante-div").hide();
      }
  });
  
  //oculto messages
  $("#message_alert_comprobante_licencia").empty();
  $("#div_message_comprobante_licencia").hide();
  $("#mostrarTituloPersonaJuridica").hide();
  $("#btnCopiarDatosPropietario").prop("disabled", false);


  $.get('<?php echo base_url(); ?>/infraccionvial/get_informe/'+idInfraccion, 
         
          function(response) {
            
           if(response.status=='OK'){
             
             $("#nombreApellidoPropietario").empty();
             $("#dniPropietario").empty();
             $("#domicilioPropietario").empty();
             $("#nombreApellidoConductor").empty();
             $("#dniConductor").empty();
             $("#domicilioConductor").empty();
             $("#nombreApellidoRepresentante").empty();
             $("#dniRepresentante").empty();  
             $("#domicilioRepresentante").empty();
             $("#vinculoRepresentante").empty();
             $("#pedido_dni").attr('checked',false);
             $("#pedido_cedula").attr('checked',false);
             $("#pedido_licencia").attr('checked',false);
             $("#pedido_otros").attr('checked',false);


              //propietario 
              if(typeof response.propietario != undefined  && response.propietario != null){
                 _propietario = response.propietario;
                 $('#nombreApellidoPropietario').append (`<strong>${response.propietario.nombre} , ${response.propietario.apellido}</strong>`);
                 $("#dniPropietario").append(`<strong>${response.propietario.dni}</strong>`);
                 $("#btnCopiarDatosPropietario").prop("disabled", false);
                 if( typeof response.domicilioPropietario != null){
                  _propietarioDomicilio =  response.domicilioPropietario;
                  if ( response.domicilioPropietario != null ) {
                     $("#domicilioPropietario").append(`<strong>${response.domicilioPropietario}</strong>`);
                   } else {
                     $("#domicilioPropietario").append(`<strong>Sin Domicilio</strong>`);
                   }
                 }
              } else if ( response.infraccion.persona_establecer_propietario === '1') {
                  $("#datos_representante").hide();
                  $("#persona_establecer_propietario").attr("display", "");
              } else if ( response.infraccion.tipo_persona == "PJ" && response.personaJuridica != null ) {
                  $("#nombreApellidoPropietario").append(`<strong>${response.personaJuridica.nombre}<strong>`);
                  $("#dniPropietario").append(`<strong>${response.personaJuridica.cuit}<strong>`);
                  $("#domicilioPropietario").append(`<strong>${response.personaJuridica.direccion}<strong>`);
                  $("#btnCopiarDatosPropietario").prop("disabled", true);
                  $("#mostrarTituloPersonaJuridica").show();

              }

                 
              if(response.involucrado != undefined && response.involucrado != null ) {
                 _conductor =  response.involucrado ;
                 $('#nombreApellidoConductor').append (`<strong>${response.involucrado.nombre} , ${response.involucrado.apellido}</strong>`);
                 $("#dniConductor").append(`<strong>${response.involucrado.dni}</strong>`);
                 if( response.domicilioInvolucrado != null){
                     _conductorDomicilio =  response.domicilioInvolucrado;
                     $("#domicilioConductor").append(`<strong>${response.domicilioInvolucrado}</strong>`);
                   } else {
                     $("#domicilioConductor").append(`<strong>Sin Domicilio </strong>`);
                   }
                 }
    
              
              

              // Copiamos los datos del informe
              informe = response.informe[0];
              $("#nombreApellidoRepresentante").val(response.informe[0].nombre_apellido_representante);
              $("#dniRepresentante").val(response.informe[0].dni_representante);  
              $("#domicilioRepresentante").val(response.informe[0].domicilio_representante);
              $("#vinculoRepresentante").val(response.informe[0].vinculo_representante);
              $("#descripcionRepresentante").val(informe.texto);
              $("#modal_comprobante_entrega_licencia").modal('show'); 


              if(informe.pedido_dni !=null && informe.pedido_dni == 1){
                 $("#pedido_dni").prop('checked',true);
              }else{
                $("#pedido_dni").prop('checked',false);
              }

              if(informe.pedido_licencia!=null && informe.pedido_licencia == 1){
                $("#pedido_licencia").prop('checked',true);
              }else{
                $("#pedido_licencia").prop('checked',false);
              }
              
              
              if(informe.pedido_cedula!=null && informe.pedido_cedula == 1){
                $("#pedido_cedula").prop('checked',true);
              }else{
                $("#pedido_cedula").prop('checked',false);
              }  

              if(informe.pedido_otro!=null && informe.pedido_otro == 1){
                $("#pedido_otro").prop('checked',true);
                $("#descripcionRepresentante-div").show();
              }else{
                $("#pedido_otro").prop('checked',false);
                $("#descripcionRepresentante-div").hide();
              }  
              
            
          }else{
             
          }
      }, 'json');
 
 }

 var copiarDatosConductor = function(){
     informe.nombre_apellido_representante =  `${_conductor.nombre} , ${_conductor.apellido}`;
     informe.dni = _conductor.dni;
     informe.cuil =  _conductor.cuil;
     informe.domicilio_representante =  _conductorDomicilio;
     informe.vinculo_representante =  'CONDUCTOR';

     $("#nombreApellidoRepresentante").val(`${_conductor.nombre} , ${_conductor.apellido}`);
     $("#dniRepresentante").val(_conductor.dni);  
     $("#domicilioRepresentante").val(_conductorDomicilio);
     $("#vinculoRepresentante").val('CONDUCTOR');

 };

 
 var copiarDatosPropietario = function(){
     informe.nombre_apellido_representante = `${_propietario.nombre} , ${_propietario.apellido}`;
     informe.dni_representante = _propietario.dni;
     informe.cuil_representante =  _propietario.cuil;
     informe.domicilio_representante =  _propietarioDomicilio;
     informe.vinculo_representante =  'PROPIETARIO';
     $("#nombreApellidoRepresentante").val(`${_propietario.nombre} , ${_propietario.apellido}`);
     $("#dniRepresentante").val(_propietario.dni);  
     $("#domicilioRepresentante").val(_propietarioDomicilio);
     $("#vinculoRepresentante").val('PROPIETARIO');

 };
   
  
    /**
      * Evento correspondiente a generar comprobante
      * de licencia
     **/
var generar = function(){
        if(validarComprobanteLicencia('form-comprobante-licencia')){
          console.log(informe);
          informe.nombre_apellido_representante = $("#nombreApellidoRepresentante").val();
          informe.dni_representante =$("#dniRepresentante").val();
          informe.vinculo_representante =$("#vinculoRepresentante").val();
          informe.domicilio_representante =$("#domicilioRepresentante").val();
          informe.texto = $('#descripcionRepresentante').val();

          if($('#pedido_dni').prop("checked")){
            informe.pedido_dni = 1;
          }else{
            informe.pedido_dni = 0;
          }

          if($("#pedido_licencia").prop("checked")){
            informe.pedido_licencia  = 1;
          }else{
            informe.pedido_licencia = 0;
          }

          if($("#pedido_cedula").prop("checked")){
            informe.pedido_cedula = 1;
          }else{
            informe.pedido_cedula = 0;
          }

          if($("#pedido_otro").prop("checked")){
            informe.pedido_otro = 1;
          }else{
            informe.pedido_otro = 0;
          } 


          $.post('<?php echo base_url(); ?>/informes/generarComprobanteLicencia/', 
          JSON.stringify(informe),
          function(response) {
          if(response.status=='OK'){
                console.log("aqui ingreso");
                $("#btnCerrarModalPago").click();
                 if(response.data.url_comprobante!=null && response.data.url_comprobante!=""){
                   window.open(response.data.url_comprobante,'_blank');   
                 }
                 
          }else{
             
          }
       }, 'json');
  
    
     }
   }

  return {
    showModal,
    generar,
    copiarDatosPropietario,
    copiarDatosConductor
  };

  }());

 

   
</script>