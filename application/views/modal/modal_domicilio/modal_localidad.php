
<div id="modal_localidad" class="modal fade in" tabindex="-1" data-width="360">
<div class="modal-header  modal-header-sucess">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title ">Localidad</h4>
</div>
<div class="modal-body">


<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="control-label">Nombre(*):</label>
<textarea id="nombreLocalidad" class="form-control col-md-12" name="nombreLocalidad" rows="3"> </textarea> 
</div>
</div>
</div>


 <div id="div_add_message_localidad" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_localidad">
</div> 
</div>

<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnModalLocalidadCerrar" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnGuardarLocalidadDomicilio">Guardar</button>
</div>
</div>






<script type="text/javascript">

 $("#message_alert_localidad").empty();
 $("#div_add_message_localidad").hide();
 $("#nombreLocalidad").empty();

/**
 * Funcion que permite agregar un 
 * tipo de vehiculo
**/
function addLocalidadDomicilio(nombreCombo){
  $("#message_alert_localidad").empty();
  $("#div_add_message_localidad").hide();
  $("#nombreLocalidad").empty();
  $("#nombreLocalidad").val("");
  $("#nombreComboLocalidad").val(nombreCombo);
  $("#modal_localidad").modal('show');

 }


 $("#btnGuardarLocalidadDomicilio").click(function(ev){
     
       var nombreLocalidad=$("#nombreLocalidad").val();
       var idDepartamento = $("#domicilioDepartamento").val();
       
       if (idDepartamento!= null && idDepartamento != "" && idDepartamento !="-1") {
           if(nombreDepartamento !=""){
             var data = {'nombre': nombreLocalidad, 'id': idDepartamento};
             $.ajax({
                 type: "POST",
                 url: '<?php echo base_url(); ?>domicilio/postLocalidad',
                 data: JSON.stringify(data),
                 dataType: "JSON",
                 success: function (data) {
                   if (data.status == 'OK') {
                      $("select[name=domicilioLocalidad]").empty();
                      $("select[name=domicilioLocalidad]").append("<option value=''>Seleccionar</option>");  
                         
                      var option = [];
                      $.each(data.list, function (i, obj) {
                         
                         option[i] = document.createElement('option');
                         $(option[i]).attr({value: obj.id_localidad});
                         $(option[i]).append(obj.localidad);
                         //Seteamos el valor default
                         if (obj.id_localidad == data.id) {
                             $(option[i]).attr("selected", true);
                          }
                           $("select[name=domicilioLocalidad]").append(option[i]);
                       });

                      $("#message_alert_localidad").empty();
                      $("#div_add_message_localidad").hide();
                      $("#nombreLocalidad").empty();
                      $("#modal_localidad").hide();
                      $("#btnModalLocalidadCerrar").click();
 
                    } else {
                       $("#btnModalLocalidadCerrar").click();
                       alert(data.message);
                   }
                  },
                error: function (data) {
                  $("#btnModalLocalidadCerrar").click();
                  alert("error => " + data);
               }
              });
           }else{
        
             $("#message_alert_localidad").empty();
             $("#message_alert_localidad").append("Debe ingresar un nombre de Marca");
             $("#div_add_message_localidad").show();
           }

           

          }else{
              $("#message_alert_localidad").empty();
              $("#message_alert_localidad").append("Debe Seleccionar Departamento");
              $("#div_add_message_localidad").show();
          }
          
                  

    });

</script>