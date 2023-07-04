
<div id="modal_marca" class="modal fade in" tabindex="-1" data-width="360">
<div class="modal-header  modal-header-sucess">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title ">Modal Marca</h4>
</div>
<div class="modal-body">
  

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="control-label">Nombre(*):</label>
<textarea id="nombreMarca" class="form-control col-md-12" name="nombreMarca" rows="3"> </textarea> 
</div>
</div>
</div>


 <div id="div_add_message_marca" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_marca">
</div> 
</div>

<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnModalMarcaCerrar" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnGuardarMarca">Guardar</button>
</div>
</div>






<script type="text/javascript">

 $("#message_alert_marca").empty();
 $("#div_add_message_marca").hide();
 $("#nombreMarca").empty();

/**
 * Funcion que permite agregar un 
 * tipo de vehiculo
**/
function agregarMarca(){
  console.log("agregar Marca");
  $("#marca").val("").trigger('change');
  $("#marca").trigger('change'); 

  $('#marca').trigger('select2:close'); // Notify only Select2 of changes
  $("#marca").addClass("select2-marca");
  $("#marca").trigger("select2:closing");
  $("#message_alert_marca").empty();
  $("#div_add_message_marca").hide();
 // $(".select2-container--open").hide();
 $('#marca').select2("close").parent();
  $("#nombreMarca").empty();

  $("#modal_marca").modal('show');
  $("#nombreMarca").focus();
  $("#nombreMarca").click();
}


$("#btnGuardarMarca").click(function(ev){
     
       var nombreMarca=$("#nombreMarca").val();
       var idTipoVehiculo = $(".select2-tipovehiculo").val();
       //verifico el tipo de vehiculo si esta seleccionado

       if (idTipoVehiculo != null && idTipoVehiculo != "") {
           if(nombreMarca !=""){
             var data = {'nombre': nombreMarca, 'id': idTipoVehiculo};
             $.ajax({
                 type: "POST",
                 url: '<?php echo base_url(); ?>marca/postMarca',
                 data: JSON.stringify(data),
                 dataType: "JSON",
                 success: function (data) {
                   if (data.status == 'OK') {
                      $(".select2-marca").empty();
                      var option = [];
                      $.each(data.list, function (i, obj) {
                         option[i] = document.createElement('option');
                         $(option[i]).attr({value: obj.id_marca});
                         $(option[i]).append(obj.nombre);
                         //Seteamos el valor default
                         if (obj.id_marca == data.id) {
                             $(option[i]).attr("selected", true);
                          }
                          $(".select2-marca").append(option[i]);
                       });
 
                      $("#message_alert_marca").empty();
                      $("#div_add_message_marca").hide();
                      $("#nombreMarca").empty();
                      $("#modal_marca").hide();
                      $("#btnModalMarcaCerrar").click();
                      $("#marca").val(data.id);
                      $("#marca").val(data.id).trigger('change');
 
                    } else if( data.status == "ERROR_EXISTE") {
                       $("#btnModalMarcaCerrar").click();
                       alert(data.message);
                       $("#marca").val(data.id);
                        $("#marca").val(data.id).trigger('change');
                   } else {
                       $("#btnModalMarcaCerrar").click();
                       alert(data.message);  
                   }
                  },
                error: function (data) {
                  $("#btnModalMarcaCerrar").click();
                  alert("error => " + data);
               }
              });
           }else{
        
             $("#message_alert_marca").empty();
             $("#message_alert_marca").append("Debe ingresar un nombre de Marca");
             $("#div_add_message_marca").show();
           }

           

          }else{
              $("#message_alert_marca").empty();
              $("#message_alert_marca").append("Debe Seleccionar Tipo Vehiculo");
              $("#div_add_message_marca").show();
          }
          
                  

    });

</script>