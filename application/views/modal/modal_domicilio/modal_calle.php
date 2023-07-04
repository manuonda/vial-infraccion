
<div id="modal_calle" class="modal fade in" tabindex="-1" data-width="360">
<div class="modal-header  modal-header-sucess">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title ">Calle</h4>
</div>
<div class="modal-body">


<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="control-label">Nombre(*):</label>
<textarea id="nombreCalle" class="form-control col-md-12" name="nombreCalle" rows="3"> </textarea> 
</div>
</div>
</div>


 <div id="div_add_message_calle" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_calle">
</div> 
</div>

<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnModalCalleCerrar" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnGuardarCalleDomicilio">Guardar</button>
</div>
</div>






<script type="text/javascript">

 $("#message_alert_calle").empty();
 $("#div_add_message_calle").hide();
 $("#nombreCalle").empty();

/**
 * Funcion que permite agregar un 
 * barrio
**/
function addCalleDomicilio(){
  $("#message_alert_calle").empty();
  $("#div_add_message_calle").hide();
  $("#nombreCalle").empty();
  $("#nombreCalle").val("");
  $("#modal_calle").modal('show');
 }


 $("#btnGuardarCalleDomicilio").click(function(ev){
     
       var nombreCalle=$("#nombreCalle").val();
       var idBarrio = $("#domicilioBarrio").val();
       
       if (idBarrio!= null && idBarrio != "" && idBarrio !="-1") {
           if(nombreDepartamento !=""){
             var data = {'nombre': nombreCalle, 'id': idBarrio};
             $.ajax({
                 type: "POST",
                 url: '<?php echo base_url(); ?>domicilio/postCalle',
                 data: JSON.stringify(data),
                 dataType: "JSON",
                 success: function (data) {
                   if (data.status == 'OK') {
                      $("select[name=domicilioCalle]").empty();
                      $("select[name=domicilioCalle]").append("<option value=''>Seleccionar</option>");  
                         
                      var option = [];
                      $.each(data.list, function (i, obj) {
                         
                         option[i] = document.createElement('option');
                         $(option[i]).attr({value: obj.id_calle});
                         $(option[i]).append(obj.calle);
                         //Seteamos el valor default
                         if (obj.id_calle == data.id) {
                             $(option[i]).attr("selected", true);
                          }
                           $("select[name=domicilioCalle]").append(option[i]);
                       });

                      $("#message_alert_calle").empty();
                      $("#div_add_message_calle").hide();
                      $("#nombreCalle").empty();
                      $("#modal_calle").hide();
                      $("#btnModalCalleCerrar").click();
 
                    } else {
                       $("#btnModalCalleCerrar").click();
                       alert(data.message);
                   }
                  },
                error: function (data) {
                  $("#btnModalCalleCerrar").click();
                  alert("error => " + data);
               }
              });
           }else{
        
             $("#message_alert_calle").empty();
             $("#message_alert_calle").append("Debe ingresar un nombre Calle");
             $("#div_add_message_calle").show();
           }

           

          }else{
              $("#message_alert_calle").empty();
              $("#message_alert_calle").append("Debe Seleccionar Barrio");
              $("#div_add_message_calle").show();
          }
          
                  

    });

</script>