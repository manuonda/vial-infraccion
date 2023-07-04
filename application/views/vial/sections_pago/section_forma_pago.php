<h4 class="modal-title">Datos de Pago</h4>
<hr/>
<div class="row ">
<div class="col-sm-3">
<div class="form-group form-md-line-input has-feedback">    
<label class="control-label">Fecha</label>   
<div class="input-group " id="fecha_ingreso-div">
<input type="date" class="form-control requerido" id="fecha_ingreso"  name="fecha_ingreso"
  value="<?php  if(isset($infraccion)) echo date('Y-m-d',strtotime($infraccion->fecha_ingreso)); ?>">
<span class="input-group-btn">
<button class="btn default" type="button">
<i class="fa fa-calendar"></i>
</button>
</span>
</div>
<span class="span_none" id="fecha_ingreso-error"> Requerido</span>
</div>
</div>

<div class="col-sm-3">
<div class="form-group form-md-line-input has-feedback" id="hora_hecho-div"><label class="control-label">Hora</label>
<div class="input-group">
<input type="time" class="form-control requerido timepicker timepicker-24" id="hora_hecho" name="hora_hecho"
 value="<?php if (isset($infraccion->hora_hecho)) echo $infraccion->hora_hecho; ?>">
<span class="input-group-btn">
<button class="btn default" type="button">
 <i class="fa fa-clock-o"></i>
</button>
</span>
</div>
<span class="span_none" id="hora_hecho-error">Requerido</span>
</div>
</div>

<div class="col-md-6">
<div class="form-group" id="valor-div">
<label class="control-label">Valores</label>
<div class=" input-group bootstrap-touchspin">
<select class="form-control requerido"  data-toggle="tooltip" id="valor_unidad"  name="valor_unidad"
 onchange="module_pago.aplicarValorUnidad()" 
>
<option value="">-- Seleccionar --</option>
<?php foreach ($valores as $valor): ?>                                                                        
<option value="<?php echo $valor->valor ?>"    
<?php if (isset($valor) && $valor->estado == 1) echo 'selected="selected"'; ?>>
<?php echo $valor->valor; ?></option>
<?php endforeach; ?>
 </select>
 </div>
 <span class="span_none" id="valor-error"> Seleccione </span>
 </div>
 </div>

</div>

<div class="row">
<div class="col-sm-3">
<div class="form-group" id="tipo_pago-div">
<label class="control-label">Tipo de Pago(*)</label>
<select class="form-control requerido "  data-toggle="tooltip" id="tipo_pago"  name="tipo_pago"
 onclick="module_pago.selectTipoPago(this);" 
>
<option value="">-- Seleccionar --</option>
<option value="TIPO_PAGO_CONTADO">CONTADO</option>
<option value="TIPO_PAGO_CUOTAS">CUOTAS</option>
<option value="TIPO_PAGO_TARJETA">TARJETA</option>

</select>
<span class="span_none" id="tipo_pago-error">Seleccionar</span>
</div>
</div>

<div class="col-sm-3">
<div class="form-group" id="cant_cuotas-div">
<label class="control-label">Cantidad de cuotas(*)</label>
<select class="form-control"  data-toggle="tooltip" id="cant_cuotas"  name="cant_cuotas" disabled>
<option value="">-- Seleccionar --</option>
<option value="1">1 Cuota</option>
<option value="2">2 Cuota</option>
<option value="3">3 Cuota</option>
<option value="4">4 Cuota</option>
<option value="5">5 Cuota</option>
<option value="6">6 Cuota</option>
<option value="7">7 Cuota</option>

</select>
<span class="span_none" id="cant_cuotas-error">Seleccionar</span>
</div>
</div>

</div>


<!-- ################################ -->
<!-- TABLES PAGOS ----->
<!-- table Pago -->
<div class="portlet box blue" id="box_pagos">
<div class="portlet-title">
 <div class="caption">Pago</div>  
</div>
<div class="portlet-body">
<table  id="tabla-totales" class="table table-striped table-bordered table-hover table-checkable order-column" id=" tableDetalle">
<thead>
  <th width="20%"># Tipo de Leyes</th>
  <th width="30%"><div class="text-center"> Valor Unidad x Total Unidades</div></th>
  <th width="30%"> Porcentaje Descuento</th>
  <th width="30%"> Accion</th>
  <th width="30%"> Importe con Descuento</th>
</thead>
<tbody id ="tbody_importe">
<tr>
<td><strong> Alcoholemia</strong></td>
<td> <div class="text-center">
     <strong>$<?php echo $importe_alcoholemia ;?></strong>
     </div>
     <input  type="hidden" id="importe_alcoholemia" name="importe_alcoholemia" class="form-control" 
             readonly="true"
             value="<?php echo $importe_alcoholemia;?>" />
</td>
<td>
 <div class="form-group" id="porcentajeDescuentoAlcoholemia-div">
 <select class="form-control select2 requerido"  data-toggle="tooltip" id="porcentajeDescuentoAlcoholemia"  name="porcentajeDescuentoAlcoholemia" 
          onchange="module_pago.aplicarPorcentaje('ALCOHOLEMIA')"> 
   <option value="">Seleccionar</option>
   <option value="0">0 % </option>
   <option value="50">50 % </option> 
    <option value="75">75 % </option> 
  </select>  
  <span class="span_none" id="porcentajeDescuentoAlcoholemia-error">Seleccionar</span>
 </div>
</td>
<td>
  <button type="button" class="btn btn-success form-control" onclick="module_pago.aplicarPorcentaje('ALCOHOLEMIA')" id="btnCalcularPorcentaje">Aplicar Porcentaje
  </button>
</td>
<td><input  type="text" id="importe_descuento_alcoholemia" name="importe_descuento_alcoholemia" class="form-control" 
          readonly="true"
          value="<?php echo $importe_alcoholemia;?>"/>
</td>
</tr>
<!-- leyes generales -->
<tr>
<td><strong> Leyes Generales </strong></td>
<td><div class="text-center"><strong>$ <?php echo $importe_general;?></strong></div> 
  <input  type="hidden" id="importe_general" name="importe_general" class="form-control" 
             readonly="true"  value="<?php echo $importe_general;?>" />
</td>
<td>
 <div class="form-group" id="porcentajeDescuentoGeneral-div">
 <select class="form-control select2 requerido"  data-toggle="tooltip" id="porcentajeDescuentoGeneral"  name="porcentajeDescuentoGeneral" 
         onchange="module_pago.aplicarPorcentaje('GENERAL')"> 
   <option value="">Seleccionar</option>
   <option value="0">0 % </option>
   <option value="50">50 % </option> 
    <option value="75">75 % </option> 
  </select>  
 <span class="span_none" id="porcentajeDescuentoGeneral-error">Seleccionar</span>
</div>
</td>
<td>
  <button type="button" class="btn btn-success form-control" onclick="module_pago.aplicarPorcentaje('GENERAL')" id="btnCalcularPorcentaje">
   Aplicar  Porcentaje
  </button>
</td>
<td>
  <input  type="text" id="importe_descuento_general" name="importe_descuento_general" class="form-control"
   readonly="true"
   value="<?php echo $importe_general;?>" />
</td>
</tr>


</tbody>
<tfoot id="tfoot_total">
  <tr>
    <th>Totales</th>
    <th><div class="text-center"><strong>$<?php echo $importe_total; ?></strong></div>
       <input type="hidden" id="importe_total" name="importe_total" readonly="true" 
        value="<?php echo $importe_total;?>"/></th>
    <th></th>
    <th>Totales</th>
    <th><div class="text-center">
        <strong>
        <input type="text" id="importe_descuento_total" name="importe_descuento_total" 
               readonly="true" 
               value="<?php echo $importe_total;?>">
        </strong>
      </div>
       
  </tr>  

</tfoot>
</table>

</div>
</div>


