
<div id="modal_modelo" class="modal fade in" tabindex="-1" data-width="360">
<div class="modal-header  modal-header-sucess">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title ">Modal Modelo</h4>
</div>
<div class="modal-body">
  

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="control-label">Nombre(*):</label>
<textarea id="nombreModelo" class="form-control col-md-12" name="nombreMarca" rows="3"> </textarea> 
</div>
</div>
</div>

<hr/>


 <div id="div_add_message_modelo" class="custom-alerts alert alert-danger fade in">
<div id="message_alert_modelo">
</div> 
</div>

<div class="modal-footer">
<button type="button" data-dismiss="modal" id="btnModalModelCerrar" class="btn btn-outline dark">Cerrar</button>
<button type="button" class="btn green" id="btnGuardarModelo">Guardar</button>
</div>
</div>



<script type="text/javascript">

    $("#message_alert_modelo").empty();
    $("#div_add_message_modelo").hide();
    $("#nombreModelo").empty();


    function agregarModelo() {
      
    $("#message_alert_modelo").empty();
    $("#div_add_message_modelo").hide();
    $("#nombreModelo").empty();
    $("#modal_modelo").modal('show');
    $('#modelo').select2("close").parent();
    $("#nombreModelo").empty();
    }


    $("#btnGuardarModelo").click(function(ev){
     
        var idTipoVehiculo = $(".select2-tipovehiculo").val();
        var idMarca = $(".select2-marca").val();
        var nombre=$("#nombreModelo").val();
        console.log("idMarca ", idMarca);
        console.log("idTipoVehiculo" , idTipoVehiculo);

        if (idTipoVehiculo != "" && idMarca != "") {
           if(nombre!=null && nombre!="" && nombre.length >1){
                var data = {'nombre': nombre, 'id': idMarca};
                $.ajax({
                 type: "POST",
                 url: '<?php echo base_url(); ?>modelo/postModelo',
                 data: JSON.stringify(data),
                 dataType: "JSON",
                 success: function (data) {
                 if (data.status == 'OK') {
                    $(".select2-modelo").empty();
                     var option = [];
                     $.each(data.list, function (i, obj) {
                     console.log("id => " + JSON.stringify(obj));
                     option[i] = document.createElement('option');
                     $(option[i]).attr({value: obj.id_modelo});
                     $(option[i]).append(obj.nombre);
                     //Seteamos el valor default
                     if (obj.id_tipovehiculo == data.id) {
                        $(option[i]).attr("selected", true);
                      }
                     $(".select2-modelo").append(option[i]);
                  });

                     $("#message_alert_modelo").empty();
                     $("#div_add_message_modelo").hide();
                     $("#nombreModelo").empty();   
                     $("#btnModalModelCerrar").click();   

                } else if( data.status == "ERROR_EXISTE"){
                     $("#btnModalModelCerrar").click();
                     alert(data.message);
                     $("#modelo").val(data.id);
                     $("#modelo").val(data.id).trigger('change');   
                } else {
                    
                    $("#modal_model").hide();
                    $("#btnModalModelCerrar").click();   
                    alert(data.message);
                }
             },
              error: function (data) {
                    $("#modal_model").hide();
                    alert("Error : "+error);
                 }
            });

           }else{
               $("#message_alert_modelo").empty();
               $("#message_alert_modelo").append("Debe ingresar Modelo");     
               $("#div_add_message_modelo").show();
          }

      }  else{
              $("#message_alert_modelo").empty();
              $("#message_alert_modelo").append("Debe seleccionar Tipo Vehiculo y Marca");
              $("#div_add_message_modelo").show();
          }
          
                  

    });

  



</script>