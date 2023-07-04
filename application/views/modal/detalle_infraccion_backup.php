<!-- modal correspondiente a leyes -->
<div id="modal_leyes" class="modal container fade" tabindex="-1" > 
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Leyes</h4>
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
                    <select class="form-control select2-anexo "  id="ley" name="ley">
                        <option value="-1">--Seleccionar--</option>
                        <?php foreach ($leyes as $ley): ?>
                            <option value="<?php echo $ley->id_ley ?>">    
                                <?php echo $ley->nombre ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="form_control_1">Artículo </label>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <textarea class="form-control" value="" rows="5" id="leyDescripcion" 
                              style="width: 545px; height: 79px;"
                              readonly="true"></textarea>
                    <label for="form_control_1">Descripción</label>
                </div>
            </div>
        </div>

        <h5 class="caption-subject bold uppercase sub-titulo">
            Articulo
        </h5>
     
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2-leyes"  id="articulo" name="articulo">
                        <option>--Seleccionar--</option>
                    </select>
                    <label for="form_control_1">Artículo </label>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <textarea class="form-control" value="" rows="5" id="articuloDescripcion" readonly="true"
                              style="width: 545px; height: 79px;" 
                              ></textarea>
                    <label for="form_control_1">Descripción</label>
                </div>
            </div>
        </div>


        <h5 class="caption-subject bold uppercase sub-titulo">
            Inciso
        </h5>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2-articulos"  id="inciso" name="inciso">
                        <option>--Seleccionar--</option>
                    </select>
                    <label for="form_control_1">Inciso </label>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <textarea class="form-control" value="" rows="5" id="incisoDescripcion" readonly="true"
                              style="width: 545px; height: 79px;"
                              ></textarea>
                    <label for="form_control_1">Descripción</label>
                </div>
            </div>
        </div>

        <h5 class="caption-subject bold uppercase sub-titulo">
            Valores 
        </h5>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <p class="form-control input-sm font-blue" id="unidad_minima"></p>
                    <label for="form_control_1">Unidad mínima</label>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <p class="form-control input-sm font-blue" id="unidad_maxima"></p>
                    <label for="form_control_1">Unidad máxima</label>
                </div>
            </div>
        </div>


        <!-- Valores  -->
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group form-md-line-input has-feedback">
                    <input type="number" class="form-control input-sm font-blue" id="unidad_ingreso"/>
                    <label for="form_control_1">Ingrese Valor</label>
                </div>
            </div>
        </div>


    </div>
    <div class="modal-footer">

        <button type="button" data-dismiss="modal" id="btnCerrarModalLeyes" class="btn dark btn-outline">Cerrar</button>
        <button type="button" class="btn red" id="btnAddLeyContravencion">Guardar</button>
    </div>
</div>
<!-- end modal -->


<script type="text/javascript">


   function agregarLeyes(){
    $("#leyDescripcion").empty();
    $("#leyDescripcion").val();
    $("#articuloDescripcion").empty();
    $("#articuloDescripcion").val();
    $("#incisoDescripcion").val();
     resetaCombo('articulo');
     resetaCombo('inciso');

     //Seteamos las leyes en la primera posicion
     $("#ley").val(0);
     $("#modal_leyes").show();
   }

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



    //Valores de unidad 
    var unidad_minima = 0;
    var unidad_maxima = 0;
    var unidad_valor = 0;
    var articulo_tiene_unidad = "";
    var inciso = null;
    var ley = null;
    var articulo = null;

    //************************************
    // Dialog de agrega leyes 
    //ley 
    $("select[name=ley]").change(function () {
        id_ley = $(this).val();
        if (id_ley === '')
            return false;

        resetaCombo('articulo');
        resetaCombo('inciso');
        $("#unidad_minima").empty();
        $("#unidad_maxima").empty();
        $("#unidad_valor").val(0);

        $("#leyDescripcion").empty();
        $("#leyDescripcion").val();
        $("#articuloDescripcion").empty();
        $("#articuloDescripcion").val();
        $("#incisoDescripcion").val();

        $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_articulos/' + id_ley, function (data) {
            console.log("cargar combo de articulos");
            console.log("data = > " + data);
            $("select[name=articulo]").empty();
            $("select[name=articulo]").append("<option value=''>Seleccionar</option>"); 
            var option = new Array();
            $.each(data, function (i, obj) {
                console.log(" i : "+i);
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_articulo});
                $(option[i]).append(obj.nombre);

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
        $("#unidad_minima").empty();
        $("#unidad_maxima").empty();
        $("#unidad_valor").val(0);

        console.log("modificacion de articulos ");
        
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
            console.log("ley articulo : " + JSON.stringify(datos));
            if (datos != null) {
                $("#articuloDescripcion").val(datos.descripcion);
                //Verifico si el articulo tiene 
                /*if (datos.tiene_unidad == 'SI') {
                    console.log("articulo si ");
                    unidad_minima = datos.unidad_minima;
                    unidad_maxima = datos.unidad_maxima;
                    articulo_tiene_unidad = 'SI';
                    $("#unidad_minima").empty();
                    $("#unidad_minima").append(unidad_minima);
                    $("#unidad_maxima").empty();
                    $("#unidad_maxima").append(unidad_maxima);

                } else {
                    articulo_tiene_unidad = 'NO';
                }
                */

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
            console.log("ley inciso : " + JSON.stringify(datos));
            if (datos != null) {
                console.log("inciso");
                $("#incisoDescripcion").val(datos.descripcion);
                unidad_minima = datos.unidad_minima;
                unidad_maxima = datos.unidad_maxima;
                $("#unidad_minima").append(unidad_minima);
                $("#unidad_maxima").append(unidad_maxima);

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



        console.log("idContravnecion: " + id);
        console.log("idContArtInciso: " + idContArtInciso);
        console.log("idLey : " + idLey);
        console.log("idArticulo : " + idArticulo);
        console.log("idInciso : " + idInciso);


        var unidad_valor = $("#unidad_ingreso").val();

        //verifico 
        var band = true;


        if (idLey == null || idLey == undefined) {
            alert("Debe seleccionar ley");
            return false;
        }

        if (idArticulo == null || idArticulo == undefined) {
            alert("Debe seleccionar Articulo");
            return false;
        }

        if (idInciso == "" && idArticulo != null && articulo_tiene_unidad == 'NO') {
            band = false;
            alert("Debe seleccionar un inciso");
            return false;
        }else{
             //Asignamos el valor null al inciso debido 
             //a que no tiene valor  
             idInciso=0;
        }

        console.log("unidad_valor :" + unidad_valor);
        console.log("unidad_minima  : " + unidad_minima);
        console.log("unidad_maxima  : " + unidad_maxima);


        if (Number(unidad_valor) != "" && Number(unidad_minima) <= Number(unidad_valor) && Number(unidad_maxima) >= Number(unidad_valor)) {
            band = true;
        } else {

            band = false;
            alert("Debe ingresar un valor de unidad y tiene que estar en el rango de valores");
            return false;
        }


        //de la ley obtenemos el tipo de unidad 
        var tipo_unidad =ley.tipo_unidad;
        //establecemos los textos
         if (ley != null) {
            textLey = ley.nombre;
        }

        if (articulo != null) {
            textArticulo = articulo.descripcion;
        }

        if (inciso != null) {
            textInciso = inciso.descripcion;
        }else{
            textInciso = "no tiene";
        }

        //El boton de eliminar
         var html = "<button  class='btn default btn-xs red'" +
                    " onclick=eliminarDetalleLey('0-" +
                    idLey +
                    "-" + idArticulo +
                    "-" + idInciso +
                    "')>" +
                    "<i class='fa fa-times'></i></button>";
        
        if (articulo_tiene_unidad == 'SI') {


                      console.log("html => "+html);
                       //se agrega los elementos 
                      var row="<tr id='0-"+idLey+"-"+idArticulo+"-"+idInciso+"' >"+
                              "<input type='hidden' name='leyes[]'"+ 
                              "value='0-"+idLey+"-"+idArticulo+"-"+idInciso+"-"+tipo_unidad+"-"+unidad_valor+"' />"+
                               "<td>"+textLey+"</td>"+
                               "<td>"+textArticulo+"</td>"+
                               "<td>"+textInciso+"</td>"+ 
                               "<td>"+tipo_unidad+"</td>"+     
                               "<td>"+unidad_valor+"</td>"+         
                               "<td><div class='text-center'>"+html+"</div>"+
                               "</td>"+
                               "</tr>";
                      
                      console.log("row add =>"+row);
                      //agregamos a la tabla 
                      $("#tbodyDetalleInfraccion").append(row);
                      //modal leyes hide
                      
                      $("#modal_leyes").hide();


        }else{


       

        //no tiene id de contravencion
        //entonces se agrega al 
       // if (id == null || id == "") {
            console.log("no tiene id de contravencion");

           

            console.log("html => " + html);
            //se agrega los elementos 
            var row = "<tr id='0-" + idLey + "-" + idArticulo + "-" + idInciso + "' >" +
                    "<input type='hidden' name='leyes[]'" +
                    "value='0-" + idLey + "-" + idArticulo + "-" + idInciso + "-" + tipo_unidad + "-" + unidad_valor + "' />" +
                    "<td>" + textLey + "</td>" +
                    "<td>" + textArticulo + "</td>" +
                    "<td>" + textInciso + "</td>" +
                    "<td>" + tipo_unidad + "</td>" +
                    "<td>" + unidad_valor + "</td>" +
                    "<td><div class='text-center'>" + html + "</div>" +
                    "</td>" +
                    "</tr>";

            console.log("row add =>" + row);
            //agregamos a la tabla 
            $("#tbodyDetalleInfraccion").append(row);
            //modal leyes hide

            $("#modal_leyes").hide();

        }

       


        $("#btnCerrarModalLeyes").click();
        
        //funcion que permite calcular el importe total 
        calcularImporteTotal();
        
    });

    //Funcion que permite calcular la cantidad de VALOR UF
     //Calculo la cantidad de valor de UF
    function getCantidadUF(){
      var cantidadUF=0; 
      $('#tableDetalle tr').each(function (i, row){
          console.log("i :"+i);
          if(i>0){
            var $tds = $(this).find('td');
            var valorUF=$tds.eq(4).text();
            cantidadUF=cantidadUF+valorUF;   
          } 
                 
      });
       console.log("cantidad UF : "+cantidadUF);
       return cantidadUF;
    }

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


    /*
    *  Funcion que permite calcular el importe 
    *  total de valor de unidad uf por cantidad
    */
    function calcularImporteTotal(){
        var valorUnidadUF=$("#valor_unidad_uf").val();
        var cantidadUF=getCantidadUF();
        $("#total_uf").val(cantidadUF);

        var totalImporte=valorUnidadUF *  cantidadUF;
        console.log("totalImporte : "+totalImporte);
        $("#importe_total").val(totalImporte);
    }



</script>