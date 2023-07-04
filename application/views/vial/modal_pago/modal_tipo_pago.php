<div id="modal_pago" class="modal fade" tabindex="-1" data-width="1000">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Datos de Pago</h4>
</div>
<div class="modal-body">
  
 <input type="hidden" id="idInfraccion"/>
<div class="row ">

<div class="col-sm-3">
<div class="form-group form-md-line-input has-feedback">    
<label class="control-label">Fecha</label>   
<div class="input-group ">
<input type="date" class="form-control requerido" id="fecha_ingreso"  name="fecha_ingreso"
  value="<?php  if(isset($infraccion)) echo date('Y-m-d',strtotime($infraccion->fecha_ingreso)); ?>">
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

<div class="col-sm-3">
<div class="form-group form-md-line-input has-feedback"><label class="control-label">Hora</label>
<div class="input-group">
<input type="time" class="form-control requerido timepicker timepicker-24" id="hora_hecho" name="hora_hecho"
 value="<?php if (isset($infraccion->hora_hecho)) echo $infraccion->hora_hecho; ?>">
<span class="input-group-btn">
<button class="btn default" type="button">
 <i class="fa fa-clock-o"></i>
</button>
</span>
</div>
</div>
</div>


<div class="col-sm-3">
<div class="form-group">
<label class="control-label">Tipo de Pago(*)</label>
<select class="form-control"  data-toggle="tooltip" id="tipo_pago"  name="tipo_pago">
<option value="">-- Seleccionar --</option>
<option value="TIPO_PAGO_CONTADO">CONTADO</option>
<option value="TIPO_PAGO_CUOTAS">CUOTAS</option>
</select>
<span class="help-block"> Tipo Pago </span>
</div>
</div>

<div class="col-sm-3">
<div class="form-group" >
<label class="control-label">Cantidad de cuotas(*)</label>
<select class="form-control"  data-toggle="tooltip" id="cant_cuotas"  name="cant_cuotas" disabled>
<option value="0">-- Seleccionar --</option>
<option value="1">1 Cuota</option>
<option value="2">2 Cuota</option>
<option value="3">3 Cuota</option>
<option value="4">4 Cuota</option>
<option value="5">5 Cuota</option>
<option value="6">6 Cuota</option>
<option value="7">7 Cuota</option>

</select>
<span class="help-block"> Cantida de Cuotas </span>
</div>
</div>


</div>


<!-- Total Alcoholemia -->
<h3><strong> Total Alcoholemia</strong></h3>
<hr/>

<div class="row">
<div class="col-sm-3">
<div class="form-group">
  <label class="control-label">Importe Total(100%)</label>
  <input  type="text" id="importe_alcoholemia" name="importe_alcoholemia" class="form-control"   onchange="" />
  </div> 
</div>

<div class="col-sm-3">
 <div class="form-group">
 <label class="control-label">Porcentaje Descuento</label>
 <select class="form-control select2" required data-toggle="tooltip" id="porcentajeDescuentoAlcoholemia"  name="porcentajeDescuentoAlcoholemia" > 
   <option value="-1">Seleccionar</option>
   <option value="0">0 % </option>
   <option value="10">10 % </option>
   <option value="20">20 % </option>
   <option value="30">30 % </option>
   <option value="40">40 % </option>
   <option value="50">50 % </option> 
  </select>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group">
<label class="control-label"> Acción</label>
<button class="btn btn-success form-control" onclick="module_pago.aplicarPorcentaje('ALCOHOLEMIA')" id="btnCalcularPorcentaje">Aplicar Porcentaje</button>
</div>
</div>

<div class="col-sm-3">
<div class="form-group">
  <label class="control-label">Importe con Descuento</label>
  <input  type="text" id="importe_total_alcoholemia" name="importe_total_alcoholemia" class="form-control"   onchange="" />
  </div> 
</div>
</div>

<!-- ################################################################ -->

<h3> <strong>Total Leyes Generales</strong></h3>
<hr/>

<div class="row">
<div class="col-sm-3">
<div class="form-group">
  <label class="control-label">Importe Total(100%)</label>
  <input  type="text" id="importe_general" name="importe_general" class="form-control"   onchange="" />
  </div> 
</div>

<div class="col-sm-3">
 <div class="form-group">
 <label class="control-label">Porcentaje Descuento</label>
 <select class="form-control" required data-toggle="tooltip" id="porcentajeDescuentoGeneral"  name="porcentajeDescuentoGeneral" > 
   <option value="-1">Seleccionar</option>
   <option value="0">0 % </option>
   <option value="10">10 % </option>
   <option value="20">20 % </option>
   <option value="30">30 % </option>
   <option value="40">40 % </option>
   <option value="50">50 % </option> 
  </select>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group">
<label class="control-label"> Acción</label>
<button type="button" class="btn btn-success form-control" onclick="module_pago.aplicarPorcentaje('GENERAL')">Aplicar Porcentaje</button>
</div>
</div>

<div class="col-sm-3">
<div class="form-group">
  <label class="control-label">Importe Descuento</label>
  <input  type="text" id="importe_total_general" name="importe_total_general" class="form-control"   onchange="" />
  </div> 
</div>
</div>


<div class="row">
 <div class="col-sm-6">
 <div class="form-group">
  <label class="control-label">IMPORTE TOTAL</label>
  <input id="importe_descuento" name="importe_descuento" class="form-control" placeholder="0.00" type="text"  />

 </div>
</div>

</div>


 <div id="div_message_pago" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_pago">
</div> 
</div>

<div class="modal-footer">
<button type="button" class="btn red rigth" onclick="module_pago.exhimir()"> EXHIMIR</button>

<button type="button" data-dismiss="modal" id="btnCerrarModalPago" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnGuardarPago">Guardar</button>
</div>
</div>

<script type="text/javascript">
  /** Funcion que muestra el modal 
    * de Generar el Pago 
    **/

 var module_pago = ( function () {
    
    // Funcion que permite exhimir una infraccion
    var exhimir = function(){
      let id_infraccion = document.getElementById("idInfraccion").value;
      console.log("id infraccion "+ id_infraccion );
      let result = confirm("Desea el exhimir la infraccion ?");
      if ( result ){

      }
    }


    // porcentaje  a aplicar a importe
    var aplicarPorcentaje = function(tipo){
        
        switch( tipo ) {

          case 'ALCOHOLEMIA': {  

              console.log('aplicar porcentaje a Alcholemia');

          }; break;
          case 'GENERAL': {
             console.log('aplicar porcentaje general');
          }
        } 

    }

    return {
      aplicarPorcentaje : aplicarPorcentaje
    }


 }());


  $("#div_message_pago").hide();

 function showModalGenerarPago(idInfraccion){
 
   //asignamos el valor de identificador de infraccion 
   $("#div_message_pago").hide();
   $("#message_alert_pago").empty();
   $("#idInfraccion").val(idInfraccion);
   $("#importe").val(0);
   $("#importe_descuento").val(0);
   $("#modal_pago").modal('show'); 
    
 }



  //select tipo_pago en cuotas o de contado
  $("select[name=tipo_pago]").change(function () {
    console.log("tipo pago selected");
    id_pago = $(this).val();
    if (id_pago === '')
    return false;
 
     console.log("id_pago : "+id_pago);
     //
     if(id_pago=='TIPO_PAGO_CUOTAS'){
      $("#cant_cuotas").prop('disabled',false);
     }else{
      $("#cant_cuotas").val(0);
      $("#cant_cuotas").prop('disabled',true); 
     }

   });

  //select  porcentaje de descuento 
  //se establece al seleccionar
  $("select[name=porcentajeDescuento]").change(function () {
    console.log("tipo pago selected");
    let valor_porcentaje = $(this).val();
    let importe=$("#importe").val();
    let importe_descuento=importe - (importe * valor_porcentaje)/100;

    //asignamos el valor del importe con descuento 
     $("#importe_descuento").val("0");  
     $("#importe_descuento").val(importe_descuento);
     $("#div_message_pago").hide();
   });

  $("#btnCalcularPorcentaje").click(function(ev){
     let valor_porcentaje = $("#porcentajeDescuento").val();
     let importe=$("#importe").val();
     let importe_descuento=importe - (importe * valor_porcentaje)/100;

    //asignamos el valor del importe con descuento 
     $("#importe_descuento").val("0");  
     $("#importe_descuento").val(importe_descuento);
  });


  //Funcion que permite guardar la informacion
  //del pago 
  $("#btnGuardarPago").click(function(ev){
     console.log("btnGuardarPago");
   
    var idInfraccion=$("#idInfraccion").val();
    var fecha=$("#fecha").val();
    var hora=$("#hora").val();
    var tipo_pago=$("#tipo_pago").val();
    var cant_cuotas=$("#cant_cuotas").val();
    var importe=$("#importe").val();
    var porcentaje_descuento=$("#porcentajeDescuento").val();

    if(validarCreatePago()){
     var data = {'idInfraccion': idInfraccion,'fecha':fecha,'hora':hora,'tipo_pago':tipo_pago,'cant_cuotas':cant_cuotas,'importe':importe,'porcentaje_descuento':porcentaje_descuento};

      console.log("Data = >",data);

      $.post('<?php echo base_url(); ?>/infraccionpago/post_generarpago/', 
          JSON.stringify(data),
          function(response) {
             console.log("response=> "+JSON.stringify(response));
          if(response.status=='OK'){
                console.log("aqui ingreso");
                $("#btnCerrarModalPago").click();
                 window.location.href=response.url;
          }else{
                $("#btnCerrarModalPago").click();
          }
      }, 'json');
    }


  });


     /**
        * Funcion que permite realizar 
        * la validacion del pago correspondiente
        * Tipo de Pago :  en contado y cuotas.
       */

      function validarCreatePago(){

            let msg="";

            let bandForm=true;
            let bandTipoPago=false;
            let bandCuota=true;
            let bandImporteTotal=true;
            let bandPorcentajeDescuento = true;


            let tipoPago=$("#tipo_pago").val();
            let cantCuotas=$("#cant_cuotas").val();
            let importeTotal=$("#importe").val();
            let porcentajeDescuento =$("#porcentajeDescuento").val();


            //tipo pago 
            if(tipoPago!=""){
               bandTipoPago=true;
            }else{
              bandTipoPago=false;
              msg="Debe seleccionar un Tipo de Pago<br>";
            }


            //cant cuotas 
            if(tipoPago !="" ){
               if( tipoPago=='TIPO_PAGO_CUOTAS' && cantCuotas>0){
                 bandCuota=true; 
               }else if( tipoPago=="TIPO_PAGO_CONTADO"){
                  bandCuota=true; 
               }else{
                   bandCuota=false;
                   msg=msg+"Debe Seleccionar la Cantidad de Cuotas<br>";
            
               }
            }



            //importe total 
            if(importeTotal!="" && importeTotal>0){
               bandImporteTotal=true;
            }else{
               bandImporteTotal=false;
               msg=msg + " Debe ingresar un importe total <br>"; 
            }

            //porcentaje descuento 
            if(porcentajeDescuento!="" && porcentajeDescuento!=-1){
                bandPorcentajeDescuento =  true ;
            }else{
               bandPorcentajeDescuento = false;
               msg = msg + " Debe Seleccionar porcentaje descuento <br>";
            }
               


            if(bandTipoPago && bandCuota && bandImporteTotal && bandPorcentajeDescuento){
                $("#div_message_pago").hide();
                return true;
            }else{
                $("#div_message_pago").show();
                $("#message_alert_pago").empty();
                $("#message_alert_pago").append(msg);
                return false;
            }
             
         }
        

</script>