<tr>
<td><strong> Alcoholemia</strong></td>
<td> 
  <div class="text-center">
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
  <input type="number" id="porcentajeInteresAlcoholemia" value="0" disabled="true" />
</td>  
<td>
    <input type="number" id="interesAplicadoAlcoholemia" value="0" disabled="true" />
 </td> 
<td>
  <button   type="button" class="btn btn-primary" onclick="module_pago.aplicarPorcentaje('ALCOHOLEMIA')" id="btnCalcularPorcentaje">Aplicar
  </button>
</td>
<td>
  <input  type="text" id="importe_descuento_alcoholemia" name="importe_descuento_alcoholemia" class="form-control" 
  readonly="true"
  value="<?php echo $importe_alcoholemia;?>"/>
</td>
</tr>