<div id="modal_comprobante_cuota" class="modal fade" tabindex="-1" data-width="860">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Comprobante de Cuota</h4>
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


<!--
<div class="col-sm-4">
 <div class="form-group" id="precioUF-div">
  <label class="control-label">Precio UF (*)</label>
  <input type="text" id="precioUF" name="precioUF" class="form-control requerido-comprobante"/>
 </div>
 </div>

 <div class="col-sm-4">
 <div class="form-group" id="valorUF-div">
  <label class="control-label">Valor UF (*)</label>
  <input type="text" id="valorUF" name="valorUF" class="form-control requerido-comprobante"/>
 </div>
 </div>
</div>
-->



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



