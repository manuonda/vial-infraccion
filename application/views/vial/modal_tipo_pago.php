<div id="modal_pago" class="modal fade" tabindex="-1" data-width="860">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Datos de Pago</h4>
</div>
<div class="modal-body">
  
 <input type="hidden" id="idInfraccion"/>
<div class="row ">

<div class="col-sm-6">
<div class="form-group form-md-line-input has-feedback">    
<label class="control-label">Fecha</label>   
<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" >
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
<label class="control-label">Tipo de Pago(*)</label>
<select class="form-control"  data-toggle="tooltip" id="tipo_pago"  name="tipo_pago">
<option value="">-- Seleccionar --</option>
<option value="TIPO_PAGO_CONTADO">CONTADO</option>
<option value="TIPO_PAGO_CUOTAS">CUOTAS</option>
</select>
<span class="help-block"> Tipo Pago </span>
</div>
</div>

<div class="col-sm-6">
<div class="form-group" >
<label class="control-label">Cantidad de cuotas(*)</label>
<select class="form-control"  data-toggle="tooltip" id="cant_cuotas"  name="cant_cuotas" disabled>
<option value="0">-- Seleccionar --</option>
<option value="1">1 Cuota</option>
<option value="2">2 Cuota</option>
<option value="3">3 Cuota</option>
</select>
<span class="help-block"> Cantida de Cuotas </span>
</div>
</div>


</div>

<div class="row">
<div class="col-sm-4">
<div class="form-group">
  <label class="control-label">Importe Total</label>
  <input id="importe" name="importe" class="form-control" placeholder="0.00" type="text"/>
  </div> 
</div>

<div class="col-sm-4">
 <div class="form-group">
 <label class="control-label">Porcentaje Descuento</label>
 <select class="form-control" required data-toggle="tooltip" id="porcentaje_descuento"  name="porcentaje_descuento" > 
   <option value="0">0 % </option>
   <option value="10">10 % </option>
   <option value="20">20 % </option>
   <option value="30">30 % </option>
   <option value="40">40 % </option>
   <option value="50">50 % </option> 
  </select>
 </div>
</div>

<div class="col-md-4">
  <div class="form-group">
<label class="control-label"> Acción</label>
<button class="btn btn-success form-control" id="calcularPorcentaje">Aplicar Porcentaje</button>
</div>
</div>

</div>

<div class="row">
 <div class="col-sm-6">
 <div class="form-group">
  <label class="control-label">Importe Total con Descuento</label>
  <input id="importe_descuento" name="importe_descuento" class="form-control" placeholder="0.00" type="text" readonly="true" />

 </div>
</div>

</div>


 <div id="div_message_pago" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_pago">
</div> 
</div>

<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnCerrarModalPago" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnGuardarPago">Guardar</button>
</div>
</div>

<script type="text/javascript">
  /** Funcion que muestra el modal 
    * de Generar el Pago 
    **/

  $("#div_message_pago").hide();

 function showModalGenerarPago(idInfraccion,importe){
   console.log("showModalGenerarPago");
   //asignamos el valor de identificador de infraccion 
   $("#idInfraccion").val(idInfraccion);
   $("#importe").val(importe);
   $("#importe_descuento").val(importe);
   $("#modal_pago").modal('show'); 
     console.log("modal_view");
 }



  //select tipo_pago
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
      $("#cant_cuotas").prop('disabled',true); 
     }

   });

  //select generar descuento
  $("select[name=porcentaje_descuento]").change(function () {
    console.log("tipo pago selected");
    valor_porcentaje = $(this).val();
    if (valor_porcentaje === '' || valor_porcentaje==0)
    return false;
 
    console.log("valor_porcentaje : "+valor_porcentaje);

    var importe=$("#importe").val();
    var importe_descuento=importe - (importe * valor_porcentaje)/100;

    //asignamos el valor del importe con descuento 
    $("#importe_descuento").val("");  
     $("#importe_descuento").val(importe_descuento);
     $("#div_message_pago").hide();
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
    var porcentaje_descuento=$("#porcentaje_descuento").val();

    if(validarCreatePago()){
     var data = {'idInfraccion': idInfraccion,'fecha':fecha,'hora':hora,'tipo_pago':tipo_pago,'cant_cuotas':cant_cuotas,'importe':importe,'porcentaje_descuento':porcentaje_descuento};
      $.post('<?php echo base_url(); ?>/infraccionvial/post_pago/', 
          JSON.stringify(data),
          function(response) {
             console.log("response=> "+JSON.stringify(response));
          if(response.status=='OK'){
                console.log("aqui ingreso");
                $("#btnCerrarModalPago").click();
                window.location.href=response.url;
          }else{

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
         console.log("---------------------------");
         console.log(" Funcion validarCreate Pago");
            var msg="";

            var bandForm=true;
            var bandTipoPago=false;
            var bandCuota=true;
            var bandImporteTotal=true;

            var tipoPago=$("#tipo_pago").val();
            var cantCuotas=$("#cant_cuotas").val();
            var importeTotal=$("#importe").val();


            
            console.log("TipoPago : "+tipoPago);
            console.log("Cant Cuotas : "+cantCuotas);
            console.log("Importe Total : "+importeTotal);

            //tipo pago 
            if(tipoPago!=""){
               bandTipoPago=true;
            }else{
              bandTipoPago=false;
              msg="Debe seleccionar un Tipo de Pago";
            }


            //cant cuotas 
            if(tipoPago !="" ){
               if( tipoPago=='TIPO_PAGO_CUOTAS' && cantCuotas>0){
                 console.log("aqui 1"); 
                 bandCuota=true; 
               }else if( tipoPago=="TIPO_PAGO_CONTADO"){
                  console.log("aqui 2");
                  bandCuota=true; 
               }else{
                   console.log("aqui 3");
                   bandCuota=false;
                   msg=msg+".Debe Seleccionar la Cantidad de Cuotas";
            
               }
            }

            //importe total 
            if(importeTotal!="" && importeTotal>0){
               bandImporteTotal=true;
            }else{
               bandImporteTotal=false;
               msg=msg+". Debe ingresar un importe total"; 
            }
               


            console.log("bandTipoPago : "+bandTipoPago + " bandCuota : "+bandCuota);
         
            if(bandTipoPago && bandCuota && bandImporteTotal){
                $("#div_message_pago").hide();

                return true;
            }else{
                console.log("msg =>"+msg);
                //alert(msg);
                $("#div_message_pago").show();
                $("#message_alert_pago").empty();
                $("#message_alert_pago").append(msg);
                return false;
            }
             
         }
        







</script>