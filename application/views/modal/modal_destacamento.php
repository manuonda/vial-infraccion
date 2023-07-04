
<div id="modal_destacamento" class="modal fade in" tabindex="-1" data-width="360">
<div class="modal-header  modal-header-sucess">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title ">Modal Destacamento</h4>
</div>
<div class="modal-body">
  

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="control-label">Nombre(*):</label>
<textarea id="nombreDestacamento" class="form-control col-md-12" name="nombreDestacamento" rows="3"> </textarea> 
</div>
</div>
</div>


 <div id="div_add_message_destacamento" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_marca">
</div> 
</div>

<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnModalDestacamentoCerrar" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnGuardarDestacamento">Guardar</button>
</div>
</div>






<script type="text/javascript">

 $("#message_alert_destacamento").empty();
 $("#div_add_message_destacamento").hide();
 $("#nombreDestacamento").empty();

/**
 * Funcion que permite agregar un 
 * tipo de vehiculo
**/
function agregarDestacamento(){
  $("#message_alert_destacamento").empty();
 $("#div_add_message_destacamento").hide();
 $("#nombreDestacamento").empty();
  $("#modal_destacamento").modal('show');
}

$("#btnGuardarDestacamento").click(function(ev){
     
       var nombreDestacamento=$("#nombreDestacamento").val();
       
       if(nombreDestacamento !=""){
          var data = {'nombre': nombreDestacamento};
          $.ajax({
                 type: "POST",
                 url: '<?php echo base_url(); ?>destacamento/postDestacamento',
                 data: JSON.stringify(data),
                 dataType: "JSON",
                 success: function (data) {
                   if (data.status == 'OK') {
                      $(".select2-destacamento").empty();
                      var option = [];
                      $.each(data.list, function (i, obj) {
                         console.log("id => " + JSON.stringify(obj));
                         option[i] = document.createElement('option');
                         $(option[i]).attr({value: obj.id_destacamento});
                         $(option[i]).append(obj.nombre);
                         //Seteamos el valor default
                         if (obj.id_marca == data.id) {
                             $(option[i]).attr("selected", true);
                          }
                          $(".select2-destacamento").append(option[i]);
                       });

                      $("#message_alert_destacamento").empty();
                      $("#div_add_message_destacamento").hide();
                      $("#nombreDestacamento").empty();
                      $("#modal_destacamento").hide();
                      $("#btnModalDestacamentoCerrar").click();
 
                    } else {
                       $("#btnModalDestacamentoCerrar").click();
                       alert(data.message);
                   }
                  },
                error: function (data) {
                  $("#btnModalDestacamentoCerrar").click();
                  alert("error => " + data);
               }
              });
           }else{
        
             $("#message_alert_destacamento").empty();
             $("#message_alert_destacamento").append("Debe ingresar un nombre de Destacamento");
             $("#div_add_message_destacamento").show();
           }

           

    });

</script>