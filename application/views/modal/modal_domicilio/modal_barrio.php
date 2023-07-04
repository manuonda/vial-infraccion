
<div id="modal_barrio" class="modal fade in" tabindex="-1" data-width="360">
<div class="modal-header  modal-header-sucess">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title ">Barrio</h4>
</div>
<div class="modal-body">


<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="control-label">Nombre(*):</label>
<textarea id="nombreBarrio" class="form-control col-md-12" name="nombreBarrio" rows="3"> </textarea> 
</div>
</div>
</div>


 <div id="div_add_message_barrio" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_barrio">
</div> 
</div>

<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnModalBarrioCerrar" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnGuardarBarrioDomicilio">Guardar</button>
</div>
</div>






<script type="text/javascript">

 $("#message_alert_barrio").empty();
 $("#div_add_message_barrio").hide();
 $("#nombreBarrio").empty();
 $("#nombreBarrio").val("");

/**
 * Funcion que permite agregar un 
 * barrio
**/
function addBarrioDomicilio(){
  $("#message_alert_barrio").empty();
  $("#div_add_message_barrio").hide();
  $("#nombreBarrio").empty();
  $("#nombreBarrio").val("");
  $("#modal_barrio").modal('show');
 }


 $("#btnGuardarBarrioDomicilio").click(function(ev){
     
       let nombreBarrio=$("#nombreBarrio").val();
       let idLocalidad = $("#domicilioLocalidad").val();
       
       if (idLocalidad!= null && idLocalidad != "" && idLocalidad !="-1") {
           if(nombreDepartamento !=""){
             let data = {'nombre': nombreBarrio, 'id': idLocalidad};
             $.ajax({
                 type: "POST",
                 url: '<?php echo base_url(); ?>domicilio/postBarrio',
                 data: JSON.stringify(data),
                 dataType: "JSON",
                 success: function (data) {
                   if (data.status == 'OK') {
                      $("select[name=domicilioBarrio]").empty();
                      $("select[name=domicilioBarrio]").append("<option value=''>Seleccionar</option>");  
                         
                      let option = [];
                      $.each(data.list, function (i, obj) {
                         
                         option[i] = document.createElement('option');
                         $(option[i]).attr({value: obj.id_barrio});
                         $(option[i]).append(obj.barrio);
                         //Seteamos el valor default
                         if (obj.id_barrio == data.id) {
                             $(option[i]).attr("selected", true);
                          }
                           $("select[name=domicilioBarrio]").append(option[i]);
                       });

                      $("#message_alert_barrio").empty();
                      $("#div_add_message_barrio").hide();
                      $("#nombreBarrio").empty();
                      $("#modal_barrio").hide();
                      $("#btnModalBarrioCerrar").click();
 
                    } else {
                       $("#btnModalBarrioCerrar").click();
                       alert(data.message);
                   }
                  },
                error: function (data) {
                  $("#btnModalBarrioCerrar").click();
                  alert("error => " + data);
               }
              });
           }else{
        
             $("#message_alert_barrio").empty();
             $("#message_alert_barrio").append("Debe ingresar un nombre de Barrio");
             $("#div_add_message_barrio").show();
           }

           

          }else{
              $("#message_alert_barrio").empty();
              $("#message_alert_barrio").append("Debe Seleccionar Localidad");
              $("#div_add_message_barrio").show();
          }
          
                  

    });

</script>