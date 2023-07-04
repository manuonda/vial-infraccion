
<div id="modal_tipovehiculo" class="modal fade in" tabindex="-1" data-width="360">
<div class="modal-header  modal-header-sucess">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title ">Modal Tipo Vehiculo</h4>
</div>
<div class="modal-body">
  
<div class="row">
 <div class="col-md-12">
 <div class="form-group">
  <label class="control-label">Nombre(*):</label>
 
  <textarea id="descripcionTipoVehiculo" class="form-control col-md-12 requerido" name="descripcion" rows="3"> </textarea> 

</div>
</div>

</div>
<hr/>


 <div id="div_message_modal_tipovehiculo" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_tipovehiculo">
</div> 
</div>

<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnModalTipoVehiculoCerrar" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnGuardarTipoVehiculo">Guardar</button>
</div>
</div>

<script type="text/javascript">

 $("#message_alert_tipovehiculo").empty();
 $("#div_message_modal_tipovehiculo").hide();
 $("#descripcionTipoVehiculo").empty();

/**
 * Funcion que permite agregar un 
 * tipo de vehiculo
**/
function agregarTipoVehiculo(){
  $("#message_alert_marca").empty();
 $("#div_add_message_marca").hide();
 $("#nombreMarca").empty();
  $("#modal_tipovehiculo").modal('show');
}


$("#btnGuardarTipoVehiculo").click(function(ev){
    
     var nombre=$("#descripcionTipoVehiculo").val();
    
     if(nombre!=null && nombre!="" && nombre.length>1){
        
        var data = {'nombre': nombre};

        $.ajax({
          type: "POST",
          url: '<?php echo base_url(); ?>tipo_vehiculo/postTipoVehiculo',
          data: JSON.stringify(data),
          dataType: "JSON",
          success: function (data) {
          if (data.status == 'OK') {
             $(".select2-tipovehiculo").empty();
             var option = [];
             $(".select2-tipovehiculo").append("<option value=''>Seleccionar</option>");
             $.each(data.list, function (i, obj) {
               console.log("id => " + JSON.stringify(obj));
               option[i] = document.createElement('option');
               $(option[i]).attr({value: obj.id_tipovehiculo});
               $(option[i]).append(obj.nombre);
               //Seteamos el valor default
               if (obj.id_tipovehiculo == data.id) {
                  $(option[i]).attr("selected", true);
                }
                $(".select2-tipovehiculo").append(option[i]);
               });
                $("#message_alert_tipovehiculo").empty();
                $("#div_message_modal_tipovehiculo").hide();
                $("#descripcionTipoVehiculo").empty();
                $("#btnModalTipoVehiculoCerrar").click();
               
          
          } else {
              alert(data.message);
         }
        },
        error: function (data) {
           alert("error => " + data);
         }
    });
    }else{
        $("#message_alert_tipovehiculo").empty();
        $("#message_alert_tipovehiculo").append("Debe ingresar un nombre");
        $("#div_message_modal_tipovehiculo").show();
        
  }
    
});

</script>
