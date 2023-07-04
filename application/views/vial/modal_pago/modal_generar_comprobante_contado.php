<div id="modal_comprobante_contado" class="modal fade" tabindex="-1" data-width="860">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Comprobante de Contado</h4>
</div>
<div class="modal-body" id="form-comprobante-contado">


<input type="hidden" id="idInfraccionPagoComprobanteContado"/>
<input type="hidden" id="idInfraccionPagoCuotaComprobanteContado"/>
<input type="hidden" id="estadoPagoComprobanteContado"/>
<input type="hidden" id="dniInfractorComprobante"/>



<!-- Datos representante  -->
<div class="row">
 <div class="col-sm-6">
 <button type="button" class="btn btn yellow" id="btnCopiarDatos" >Copiar datos del infractor</button>
 </div>
</div>

<br>


<div class="row">
<div class="col-sm-6">
  <div class="form-group" id="nombreApellidoRepresentante-div">
  <label class="control-label">Nombre, Apellido Representante (*)</label>
  <input id="nombreApellidoRepresentante"  class="form-control requerido-comprobante-contado" type="text"/>
  </div>
</div>

<div class="col-sm-6">
<div class="form-group" id="dniRepresentante-div">
 <label class="control-label">DNI (*)</label>
 <input type="number" id="dniRepresentante" class="form-control requerido-comprobante-contado"/> 
</div>  
</div>

</div>

<div class="row">
 <div class="col-sm-12">
 <div class="form-group" id="domicilioRepresentante-div">
  <label class="control-label">Domicilio Representante (*)</label>
  <input type="text" id="domicilioRepresentante" name="domicilioRepresentante" class="form-control requerido-comprobante-contado"/>
 </div>
 </div> 
</div>

<div class="row">
 <div class="col-sm-4">
 <div class="form-group" id="vinculoRepresentante-div">
  <label class="control-label">Vínculo Representante (*)</label>
  <input type="text" id="vinculoRepresentante" name="vinculoRepresentante" class="form-control requerido-comprobante-contado"/>
 </div>
 </div> 

</div>



<div class="row">

<div class="col-sm-3">
<div class="form-group" id="numeroCuotaComprobante-div">
  <label class="control-label">Numero de Cuota : </label>
  <input id="numeroCuotaComprobanteContado" name="numeroCuotaComprobante" class="form-control" type="text" readonly="true" />
  </div> 
</div>

<div class="col-sm-3">
<div class="form-group" id="importeGeneral-div">
  <label class="control-label">Importe General (*) : </label>
  <input id="importeGeneral" name="importeGeneral" class="form-control requerido-comprobante-contado" type="text"  />
  </div> 
</div>

<div class="col-sm-3">
<div class="form-group" id="importeAlcoholemia-div">
  <label class="control-label">Importe Alcoholemia (*) : </label>
  <input id="importeAlcoholemia" name="importeAlcoholemia" class="form-control requerido-comprobante-contado" type="text"  />
  </div> 
</div>


</div>



 <div id="div_message_comprobante_contado" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_comprobante_contado">
</div> 
</div>

</div>


<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnCerrarModalPagoContado" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn btn blue" onclick="module_detalle_pago.generarPagoContado()" >Generar Comprobante</button>

</div>
</div>


