<!-- modal correspondiente a leyes -->
<div id="modal_domicilio" class="modal fade" tabindex="-1" > 
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title" id="title">Domicilio</h4>
    </div>
    <div class="modal-body"> 
        <!-- hidden si es una identificador de contravecion a eliminar -->
        <input type="hidden" id="idContArtInciso" value="null"/>  
        <h5 class="caption-subject bold uppercase sub-titulo">
            Ley
        </h5>
  <!--      <?php ($leyes)?> -->
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2-anexo "  id="modal" name="pais">
                        <option value="-1">--Seleccionar--</option>
                        <?php foreach ($pais as $pais): ?>
                            <option value="<?php echo $ley->id ?>">    
                                <?php echo $ley->nombre ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="form_control_1">Pais</label>
                </div>
            </div> 
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2-anexo "  id="modalProvincia" name="provincia">
                    </select>
                    <label for="form_control_1">Provincia</label>
                </div>
            </div> 
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2-anexo "  id="modalProvincia" name="provincia">
                    </select>
                    <label for="form_control_1">Departamento</label>
                </div>
            </div> 
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2-anexo "  id="modalProvincia" name="provincia">
                    </select>
                    <label for="form_control_1">Localidad</label>
                </div>
            </div> 
        </div>

         <div class="row">
            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2-anexo "  id="modalProvincia" name="provincia">
                    </select>
                    <label for="form_control_1">Barrio</label>
                </div>
            </div> 
        </div>

         <div class="row">
            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2-anexo "  id="modalProvincia" name="provincia">
                    </select>
                    <label for="form_control_1">Localidad</label>
                </div>
            </div> 
        </div>



        <h5 class="caption-subject bold uppercase sub-titulo">
            Articulo
        </h5>
     
        
        <h5 class="caption-subject bold uppercase sub-titulo">
            Inciso
        </h5>

    </div>
    <div class="modal-footer">

        <button type="button" data-dismiss="modal" id="btnCerrarModalLeyes" class="btn dark btn-outline">Cerrar</button>
        <button type="button" class="btn red" id="btnAddLeyContravencion">Guardar</button>
    </div>
</div>
<!-- end modal -->


<script type="text/javascript">

    $("#btnAgregarLeyes").click(function(ev){

       console.log("agregar leyes");
       $("#leyDescripcion").empty();
       $("#leyDescripcion").val("");
       //$("#articuloDescripcion").remove();
       $("#articuloDescripcion").empty();
       $("#articuloDescripcion").val("");
       $("#incisoDescripcion").val("");
       //$("#incisoDescripcion").remove();
       resetaCombo('articulo');
       resetaCombo('inciso');

        //Seteamos las leyes en la primera posicion
        $("#ley").val(-1);
         $("#modal_leyes").modal('show');
   
    });
   


    $("select[name=anexo]").change(function () {
        id_anexo = $(this).val();
        if (id_anexo === '')
            return false;

        resetaCombo('anexo');

        $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_articulo/' + id_marca, function (data) {

            console.log("data = > " + data);
            var option = new Array();
            $.each(data, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_modelo});
                $(option[i]).append(obj.nombre);

                $("select[name=modelo]").append(option[i]);
            });
        });
    });


    //Variables globales
    var inciso = null;
    var ley = null;
    var articulo = null;
    var articulos = [];

    //************************************
    // Dialog de agrega leyes 
    //ley 
    $("select[name=pais]").change(function () {
        id_ley = $(this).val();
        if (id_ley === '')
            return false;

        resetaCombo('provincia');
        resetaCombo('departamento');
        resetaCombo('localidad');
        resetaCombo('barrio');
        resetaCombo('calle');
        

        $("#leyDescripcion").empty();
        $("#leyDescripcion").val();
        $("#articuloDescripcion").empty();
        $("#articuloDescripcion").val();
        $("#incisoDescripcion").val();

        $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_articulos/' + id_ley, function (data) {
            $("select[name=articulo]").empty();
            $("select[name=articulo]").append("<option value=''>Seleccionar</option>"); 
            var option = new Array();
            articulos=[];
            $.each(data, function (i, obj) {
                console.log(" i : "+i);
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_articulo});
                $(option[i]).append(obj.nombre);
                articulos.push(obj.id_articulo);


                $("select[name=articulo]").append(option[i]);
            });
        });

        $.getJSON('<?php echo base_url(); ?>/ley/get_ley/' + id_ley, function (datos) {
            console.log("ley Datos : " + JSON.stringify(datos));
            if (datos != null) {
                $("#leyDescripcion").val(datos.descripcion);
                ley = datos;


            }

        });
    });



    //articulo 
    $("select[name=articulo]").change(function () {
        console.log("name_articulos ");
        id_articulo = $(this).val();
        if (id_articulo === '')
            return false;

        resetaCombo('inciso');
        $("#incisoDescripcion").val();
        $("#articuloDescripcion").val();
        
        $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_incisos/' + id_articulo, function (data) {

            console.log("data = > " + data);
            var option = new Array();

            $.each(data, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_inciso});
                $(option[i]).append(obj.nombre);

                $("select[name=inciso]").append(option[i]);
            });
        });


        $.getJSON('<?php echo base_url(); ?>/articulo/get_articulo/' + id_articulo, function (datos) {
            if (datos != null) {
                console.log("datos articulo : "+JSON.stringify(datos));
                $("#articuloDescripcion").val(datos.descripcion);
                //seteo los valores del iniciso
                articulo = datos;
            }

        });
    });


    //select name inciso
    $("select[name=inciso]").change(function () {
        id_inciso = $(this).val();
        if (id_inciso === '')
            return false;

        $("#incisoDescripcion").empty();

        $.getJSON('<?php echo base_url(); ?>/inciso/get_inciso/' + id_inciso, function (datos) {
            //console.log("ley inciso : " + JSON.stringify(datos));
            if (datos != null) {
                $("#incisoDescripcion").val(datos.descripcion);
                 inciso = datos;
            }

        });
    });



    /**
     * Btn agregar Ley de Contravencion
     **/
    $("#btnAddLeyContravencion").click(function (ev) {

        var id = $("#id").val();
        var idContArtInciso = $("#idContArtInciso").val();

        var idLey = $("#ley").val();
        var idArticulo = $("#articulo").val();
        var idInciso = $("#inciso").val();


        var textLey = "";
        var textArticulo = "";
        var textInciso = "";

        console.log($("#ley").text());
        console.log($("#articulo").text());



        
        console.log("idContArtInciso: " + idContArtInciso);
        console.log("idLey : " + idLey);
        console.log("idArticulo : " + idArticulo);
        console.log("idInciso : " + idInciso);


       

        //verifico 
        var band = true;


        if (idLey == null || idLey == undefined || ley ==null) {
            alert("Debe seleccionar ley");
            return false;
        }else{
            textLey = ley.nombre;
        }

        if(articulos!=null && articulos.length > 0) {
            if (idArticulo == null || idArticulo == undefined || articulo ==null) {
               alert("Debe seleccionar Articulo");
               return false;
           }else{
              textArticulo=articulo.nombre;  
           }    
       }
        

       //Puede tener o no incisos

       if (idInciso == "" && idInciso != null ) {
           idInciso=0;
           textInciso="";
        }else{
           textInciso=inciso.nombre;
        }
        


        //El boton de eliminar
         var html = "<button  type='button' class='btn default btn-xs red'" +
                    " onclick=eliminarDetalleLey('0-" +
                    idLey +
                    "-" + idArticulo +
                    "-" + idInciso +
                    "')>" +
                    "<i class='fa fa-times'></i></button>";

            console.log("html => " + html);
            //se agrega los elementos 
            var row = "<tr id='0-" + idLey + "-" + idArticulo + "-" + idInciso + "' >" +
                    "<input type='hidden' name='leyes[]'" +
                    "value='0-" + idLey + "-" + idArticulo + "-" + idInciso + "' />" +
                    "<td>" + textLey + "</td>" +
                    "<td>" + textArticulo + "</td>" +
                    "<td>" + textInciso + "</td>" +
                    "<td><div class='text-center'>" + html + "</div>" +
                    "</td>" +
                    "</tr>";

            console.log("row add =>" + row);
            //agregamos a la tabla 
            $("#tbodyDetalleInfraccion").append(row);
            //modal leyes hide
             $("#btnCerrarModalLeyes").click();
        
        });

     
       /**
          * Funcion que elimina un registro de la tabla 
          * de detalles de infraccion 
          * Este id esta formado por valores : id-idley-idarticulo-idinciso-
          **/
         function eliminarDetalleLey(idDetalle){

                 console.log("eliminarDetalleLey : "+idDetalle);
                 if(idDetalle!=null && idDetalle!=""){
                    $('table#tableDetalle tr#'+idDetalle).remove();
                     
                    var array=idDetalle.split('-');
                    console.log("detalle : "+JSON.stringify(array))
                     
                    var id=array[0];
                    console.log("id de fila : "+id);

                   

                    //si el id es >0 entonces es un registro de 
                    //base de datos 
                    if(id!=0 && id!="" && id!=null){

                     console.log("delete: "+id);
                     var data={'id':id};
                    
                     $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>request_json/post_deleteLeyInfraccion',
                        data: JSON.stringify(data),
                        dataType: "JSON",
                        success: function (data) {
                        console.log("informacion :"+JSON.stringify(data));
                         if (data.status == 'OK') {
                            console.log("data.status : "+data.status);
                            console.log("idDetalle : "+idDetalle);
                            //lo elimino del registro de detalles 
                            $('table#tableDetalle tr#'+idDetalle).remove();

                         } else {
                             alert(data.message);
                         }
                        },
                         error: function (data) {
                         console.log("error => " + data);
                         }
                        });
                     
                    }else{
                        console.log("remove onlye");
                       $('table#tableDetalle tr#'+idDetalle).remove();
                    }
 
                 }

            }//end eliminarDetalleLey   

 
      /**
         * Funcion de verificar de validacion si tiene mas de una ley ingresada
       **/
      function isRowCount(){
            var rowCount = $('#tableDetalle tr').length;
            console.log("rowCount : "+rowCount);
            if(rowCount >1 ){ //debido a que toma el header como una fila por eso desde 1
                  return true;
             }else{
                return false;
             }
    }


</script>