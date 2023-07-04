
<div id="modal_departamento" class="modal fade in" tabindex="-1" data-width="360">
<div class="modal-header  modal-header-sucess">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title ">Departamento</h4>
</div>
<div class="modal-body">
  

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="control-label">Nombre(*):</label>
<textarea id="nombreDepartamento" class="form-control col-md-12" name="nombreDepartamento" rows="3"> </textarea> 
</div>
</div>
</div>


 <div id="div_add_message_departamento" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_departamento">
</div> 
</div>

<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnModalDepartamentoCerrar" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnGuardarDepartamentoDomcilio">Guardar</button>
</div>
</div>






<script type="text/javascript">

 $("#message_alert_departamento").empty();
 $("#div_add_message_departamento").hide();
 $("#nombreDepartamento").empty();

/**
 * Funcion que permite agregar un 
 * tipo de vehiculo
**/
function addDepartamentoDomicilio(nombreCombo){
  $("#message_alert_departamento").empty();
  $("#div_add_message_departamento").hide();
  $("#nombreDepartamento").empty();
  $("#nombreDepartamento").val("");
  $("#modal_departamento").modal('show');
}


    $("#btnGuardarDepartamentoDomcilio").click(function(ev){
     
       var nombreDepartamento=$("#nombreDepartamento").val();
       var idProvincia = $("#domicilioProvincia").val();
      
       //verifico el tipo de vehiculo si esta seleccionado

       if (idProvincia != null && idProvincia != "" && idProvincia !="-1") {
           if(nombreDepartamento !=""){
             var data = {'nombre': nombreDepartamento, 'id': idProvincia};
             $.ajax({
                 type: "POST",
                 url: '<?php echo base_url(); ?>domicilio/postDepartamento',
                 data: JSON.stringify(data),
                 dataType: "JSON",
                 success: function (data) {
                   if (data.status == 'OK') {
                      $("select[name=domicilioDepartamento]").empty();
                      $("select[name=domicilioDepartamento]").append("<option value=''>Seleccionar</option>");  
                         
                      var option = [];
                      $.each(data.list, function (i, obj) {
                         
                         option[i] = document.createElement('option');
                         $(option[i]).attr({value: obj.id_departamento});
                         $(option[i]).append(obj.depto);
                         //Seteamos el valor default
                         if (obj.id_departamento == data.id) {
                             $(option[i]).attr("selected", true);
                          }
                           $("select[name=domicilioDepartamento]").append(option[i]);
                       });

                      $("#message_alert_departamento").empty();
                      $("#div_add_message_departamento").hide();
                      $("#nombreDepartamento").empty();
                      $("#modal_departamento").hide();
                      $("#btnModalDepartamentoCerrar").click();
 
                    } else {
                       $("#btnModalDepartamentoCerrar").click();
                       alert(data.message);
                   }
                  },
                error: function (data) {
                  $("#btnModalDepartamentoCerrar").click();
                  alert("error => " + data);
               }
              });
           }else{
        
             $("#message_alert_departamento").empty();
             $("#message_alert_departamento").append("Debe ingresar un nombre de Marca");
             $("#div_add_message_departamento").show();
           }

           

          }else{
              $("#message_alert_departamento").empty();
              $("#message_alert_departamento").append("Debe Seleccionar Provincia");
              $("#div_add_message_departamento").show();
          }
          
                  

    });

</script>