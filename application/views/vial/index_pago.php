<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-file-text-o"></i><?php echo $subtitulo ?> </div>
    </div>

    
    <div class="portlet-body form">
        <!-- BEGIN FORM-->

        <?php echo form_open_multipart('infraccionpago/guardar', 'class="horizontal-form" id="form-pago"'); ?>
        <div class="form-body">                    
           

            <input type="hidden" name="idInfraccion" id="id" value="<?php if (isset($idInfraccion)) echo $infraccion->id_infraccion; ?>" />
             

             <div class="row">
            <div class="col-md-12">
              <h3 class="form-section"> Detalles de la Infracción e Infractor</h3>
             <table class="table table-bordered table-striped">
             <tbody><tr>
             <td>Número de Acta</td>
             <td>
             <div id="pulsate-once-target" style="padding:5px;"> 
              <strong><?php if (isset($infraccion)) echo $infraccion->numero_acta; ?>
              </strong> 
             </div>
             </td><td>Nombre y Apellido del Infractor</td>
             <td>
               <div id="pulsate-once-target" style="padding:5px;"> 
               <strong><?php if (isset($infractor)) echo $infractor->nombre.",".$infractor->apellido; ?>  
               </div>
              </td>
             </tr>
             <tr>
             </tr>
             <tr><td>Dni</td>
             <td>
             <div id="pulsate-crazy-target" style="padding:5px;">
             <strong>
             <?php if(isset($infractor)) echo $infractor->dni; ?>
             </strong>
             </div>
             </td>
             <td>Observaciones</td>
             <td><div id="pulsate-crazy-target" style="padding:5px;">
             <span class="btn default btn-xs <?php if(isset($reincidente) && $reincidente) echo 'red'; else  echo 'yellow';?>">
             <strong><?php if(isset($observacionesInfractor)) echo $observacionesInfractor; ?></strong>
             </div>
             </td>
             </tr>
               </tbody></table>
            </div> 
          </div>
      
          <hr/>
          <div class="row">
              <?php $this->load->view('vial/sections_pago/section_table_alcoholemia');?>
              <?php $this->load->view('vial/sections_pago/section_table_general');?>
          </div> 

          <!-- forma de pago -->
          <?php $this->load->view('vial/sections_pago/section_forma_pago'); ?>

          <!-- Acciones -->
            <div class="form-actions right">
               <a href="<?php echo base_url(); ?>infraccionvial/" class="btn default"> Cerrar</a>
               <button type="button" onclick="module_pago.guardarPago(this)"  class="btn blue">
                        <i class="fa fa-save"></i> Generar Pago 
                </button>
            </div> 


            </form>
            <!-- END FORM-->
            <!- /**********************************************/ -->
            

              
             <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
             </div>
             <!-- /.modal -->
            <!-- end modal -->
        </div>





        <script type="text/javascript">
       // init pago 
       

        
      var module_pago = ( function () {

      //$.blockUI({ message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Cargando..</h1>' }); 
      /*$('#blox_pagos').block({
       message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Cargando..</h1>' 
       });
       */ 
      // valor pago unidad
      var aplicarValorUnidad = function() {
        
         var idInfraccion = $("#id").val();
         var valorUnidad  = $("#valor_unidad").val();
         console.log('idInfraccion : ' + idInfraccion);
         console.log('valorUnidad : '  + valorUnidad);
         if ( valorUnidad != "" && valorUnidad !== -1 ) {
           $('#box_pagos').block({
             message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Cargando..</h1>' 
            });
          var data = {
                          'idInfraccion': idInfraccion,
                          'valorUnidad': valorUnidad
                         };

          $.post('<?php echo base_url(); ?>/infraccionpago/post_tabla/', 
          JSON.stringify(data),
          function(response) {
                console.log(response);
                $("#tbody_importe").empty();
                $("#tbody_importe > tbody").html("");
                $("#tbody_importe").append(response.importe);
                $("#tfoot_total").empty();
                $("#tfoot_total").append(response.total); 
                $("#box_pagos").unblock();


            }, 'json');
         } 
      }

      // porcentaje  a aplicar a importe
       var aplicarPorcentaje = function(tipo){
          switch( tipo ) {
            case 'ALCOHOLEMIA': {  
               var importe = document.getElementById("importe_alcoholemia").value;
               var porcentaje = document.getElementById("porcentajeDescuentoAlcoholemia").value;
               if (  porcentaje == "" || porcentaje == null ) {
                  alert("Debe seleccionar un porcentaje de Descuento para el total de Alcoholemia");
               } else{
                   let importe=$("#importe_alcoholemia").val();
                   let importe_descuento=importe - (importe * porcentaje)/100;
                   importe_descuento = parseFloat( Math.round(importe_descuento.toFixed(2)));


                   document.getElementById("importe_descuento_alcoholemia").value =  importe_descuento;
               }

               calcularTotalPorcentaje();    
              
          }; break;
          case 'GENERAL': {
               var importe = document.getElementById("importe_general").value;
               var porcentaje = document.getElementById("porcentajeDescuentoGeneral").value;
               console.log("importe_general  :"+importe);
               console.log("porcentaje : "+porcentaje);
                
               if (  porcentaje == "" || porcentaje == null ) {
                  alert("Debe seleccionar un porcentaje de Descuento para el total de Leyes Generales");
               } else{
                   let importe=$("#importe_general").val();
                   let importe_descuento= importe - (importe * porcentaje)/100;
                   importe_descuento = parseFloat( Math.round(importe_descuento.toFixed( 2 )));
                   document.getElementById("importe_descuento_general").value =  importe_descuento;
               }

               calcularTotalPorcentaje();  
          }
        } 

    }

   var selectTipoPago = function(ev) {
    if( ev.value != '' && ev.value != "") {
       if( ev.value == 'TIPO_PAGO_CUOTAS') {
          $("#cant_cuotas").attr("disabled", false); 
          $("#cant_cuotas").addClass("requerido");
       }
     }else {
        $("#cant_cuotas").attr("disabled",true);
        $("#cant_cuotas").removeClass("requerido");
     }
   }


    var calcularTotalPorcentaje = function() {
      var importeAlcoholemia = document.getElementById("importe_descuento_alcoholemia").value;
      var importeGeneral  = document.getElementById("importe_descuento_general").value;
    
      var total = parseInt(importeAlcoholemia) + parseInt(importeGeneral);
      document.getElementById("importe_descuento_total").value = total;
    }

    var  checkDecimal = function(el){
        var ex = /^[0-9]+\.?[0-9]*$/;
         if(ex.test(el.value)==false){
         el.value = el.value.substring(0,el.value.length - 1);
         }
    }

    var guardarPago =  function(e) {
      $.blockUI({
             message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Guardando..</h1>' 
        });
      if ( validarForm('#form-pago')) {
        $("#form-pago").submit();  
      } else {
         alert("Existen errores en el formulario");  
         $.unblockUI();
      }
    }

    var init = function() {
       $(".span_none").hide();
    }



    return {
      aplicarPorcentaje : aplicarPorcentaje ,
      checkDecimal: checkDecimal ,
      guardarPago : guardarPago ,
      init : init ,
      selectTipoPago: selectTipoPago ,
      aplicarValorUnidad : aplicarValorUnidad
    }


 }());

 module_pago.init();

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
        



       /**
         * Funcion que permite eliminar la infraccion 
           de Pago
        **/ 
       function eliminarPago(idInfraccionPago){
         
          $.get('<?php echo base_url(); ?>/infraccionpago/delete_pago/'+idInfraccionPago, 
          function(response) {
             console.log("response=> "+JSON.stringify(response));
             if(response.status=='OK'){
               
                window.location .href="<?php echo base_url(); ?>infraccionvial/";
             }
           }, 'json');
       }

        //Funcion que permite guardar la informacion
        //del pago 
       function eliminarPagoCuota(idInfraccionPagoCuota){
        
        $.get('<?php echo base_url(); ?>/infraccionpagocuota/delete_pagoCuota/'+idInfraccionPagoCuota, 
          
          function(response) {
             console.log("response=> "+JSON.stringify(response));
          if(response.status=='OK'){
                console.log("aqui ingreso");
               $("#btnCerrar").click();
                window.location.reload();
          }else{
                $("#btnCerrar").click();
               alert("Se produjo un error al realizar el descargo");
          }
      }, 'json');
    
    }

                
        </script>
    </div>
