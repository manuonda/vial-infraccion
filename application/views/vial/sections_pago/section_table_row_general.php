<tr>
<td><strong> Leyes Generales </strong></td>
<td>
  <div class="text-center"><strong>$ <?php echo $importe_general;?></strong>
  </div> 
  <input  type="hidden" id="importe_general" 
  name="importe_general" class="form-control" 
  readonly="true"  value="<?php echo $importe_general;?>" />
</td>
<td>
 <div class="form-group" id="porcentajeDescuentoGeneral-div">
 <select class="form-control select2 requerido"  
 data-toggle="tooltip" id="porcentajeDescuentoGeneral"  
 name="porcentajeDescuentoGeneral" 
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
<input type="number" id="porcentajeInteresGeneral" value="0" disabled="true" />
</td> 
<td>
<input type="number" id="interesAplicadoGeneral" value="0"  disabled="true" />
</td> 
<td>
  <button type="button" class="btn btn-primary" onclick="module_pago.aplicarPorcentaje('GENERAL')" id="btnCalcularPorcentaje">
   Aplicar 
  </button>
</td>
<td width="30%">
  <input  type="text" id="importe_descuento_general" name="importe_descuento_general" class="form-control"
   readonly="true"
   value="<?php echo $importe_general;?>" />
</td>
</tr>