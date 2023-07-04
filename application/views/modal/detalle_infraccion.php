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
                    <select class="form-control select2-anexo "  id="ley" name="ley"
                     onclick="moduleDetalleLey.selectLey(this)">
                        <option value="-1">--Seleccionar--</option>
                        <?php foreach ($leyes as $ley): ?>
                            <option value="<?php echo $ley->id ?>">    
                                <?php echo $ley->nombre ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="form_control_1">Ley </label>
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
                    <select class="form-control select2-leyes"  id="articulo" name="articulo"
                    onclick="moduleDetalleLey.selectArticulo(this)" 
                    >
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
                    <select class="form-control select2-articulos"  id="inciso" name="inciso"
                      onclick="moduleDetalleLey.selectInciso(this)">
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



    </div>
    <div class="modal-footer">

        <button type="button" data-dismiss="modal" id="btnCerrarModalLeyes" class="btn dark btn-outline">Cerrar</button>
        <button type="button" class="btn red" id="btnAddLeyContravencion">Guardar</button>
    </div>
</div>
<!-- end modal -->


<script type="text/javascript">

    var moduleDetalleLey = (function() { 
       
       //Variables globales
      var inciso = null;
      var ley = null;
      var articulo = null;
      var articulos = [];
      var id_ley = null ;
      var id_articulo = null ;
      var id_inciso = null;

       
      var agregarRow =  function( tableID) {
         
         $.ajax({
           type:"GET",
           url:'<?php echo base_url();?>ley/get_json_leyes/',
           cache: false,
           contentType: false,
           processData: false,
           dataType: "JSON",
           success:function(data){
              var table = document.getElementById(tableID);
              var rowCount = table.rows.length; // cantidad de Rows
              var row   = table.insertRow(rowCount) ;
              row.setAttribute('id',rowCount);
   
              // ley   
              var rowHtml = ' <tr id="'+rowCount+'" name="valores['+rowCount+']">'+
                        '      <td width="220">'+
                        '      <select id="selectLey'+rowCount+'" class="form-control select2" row="'+rowCount+
                        ' "    name="leyes['+rowCount+']" onclick="moduleDetalleLey.selectLey(this)"> '+
                        '      <option value="">Seleccionar</option>'; 
                        
                         if( data != null && data.length > 0 ){
                           //Create and append the options
                         for (var i = 0; i < data.length; i++) {
                             var unidadFija = data[i].unidad ;
                             if ( unidadFija == null ) {
                                 unidadFija = 0 ;
                             }

                             rowHtml = rowHtml + '<option value="'+data[i].id+'"  unidad="'+unidadFija+'">'+data[i].name+'</option>"';
                          }
                         }
                         rowHtml = rowHtml + '</select>';

                           //Create append de los valores de unidad

                         rowHtml = rowHtml + '</td>';
              // articulo 
               rowHtml =  rowHtml + '<td width="220">'; 
               rowHtml =  rowHtml + '<select id="selectArticulo'+rowCount+'" onchange=moduleDetalleLey.selectArticulo(this) ' 
                                  + 'class="form-control select2" row="'+rowCount+'"  name="articulos['+rowCount+']">'+
                                    '<option value="">Seleccionar</option>'+
                                    '</select>'+
                                    '</td>';
               // inciso
               rowHtml =  rowHtml + '<td width="220">';
               rowHtml =  rowHtml + '<select id="selectInciso'+rowCount+'" class="form-control select2" '
                                  + ' row="'+rowCount+'" onchange=moduleDetalleLey.selectInciso(this)'
                                  + ' name="incisos['+rowCount+']">'+
                                    ' <option value="">Seleccionar</option>'+
                                    ' </select>'+
                                    ' </td>';
                
               // unidades 
                rowHtml = rowHtml + '<td>'+
                                    '<input type="text" readonly="true" class="form-control" name="unidades['+rowCount+']" value="0.00" id="unidad_'+rowCount+'" oninput="moduleDetalleLey.validateNumber(this);"></td>';

               // descripcion de ley
               rowHtml = rowHtml + '<td width="220">'
                                 + '<input type="text" readonly="true" class="form-control" '
                                 + ' name="descripcionley['+rowCount+']" value="" id="descripcionley_'+rowCount+'">'; 
                  

               // button de observaciones exhimido 
               rowHtml =  rowHtml + '<td width="50" class="text-center">'
                                  + '<button type="button" id="action_exhimir_'+rowCount+'" onclick=moduleDetalleLey.exhimido('+rowCount+') class="btn  default btn-xs blue"><strong>NO EXHIMIDO</strong></button></td>';

              // estado exhimido 
              rowHtml = rowHtml + ' <input type="hidden" readonly="true"  name="estado_eximido['+rowCount+']"' 
                               +  ' class="form-control" name="estado_eximido['+rowCount+']" value="NO" '
                               +  ' id="estado_eximido_'+rowCount+'">';
                
              // texto exhimido  
              rowHtml = rowHtml + ' <input type="hidden" readonly="true" class="form-control" '
                                + ' name="texto_eximido['+rowCount+']" value="" id="texto_exhimido_'+rowCount+'">';

               // acciones 
              rowHtml =  rowHtml + '<td width="220"><div class="text-center">'+
                                    '<button type="button" onclick=moduleDetalleLey.eliminarRow("tbodyDetalleInfraccion",'+rowCount+') '+
                                    ' class="btn default btn-xs red"><i class="fa fa-times"></i></button></div></td>'+
                                    '</tr>';  

              row.innerHTML =  rowHtml;

           },
           error:function(data){
            console.log("error : ",data);
           }
        })  
      }  

      /**
       * Funcion que permite eliminar un row 
       * del detalle de la Ley
      **/
      var eliminarRow = function(tableId,row){
        var resultado = confirm('Desea eliminar este registro?');
        if ( resultado ) {
         document.getElementById(tableId).deleteRow(row);
         } 
      }

      /**
        * Funcion que permite agregar options 
        * a un elemento Select
        */
      var agregarOption = function( element, data ){
         var option = document.createElement("option");
                 option.value = "";
                 option.text ="Seleccionar";  
          element.appendChild(option);
          if( data != null && data.length > 0 ){
             //Create and append the options
             for (var i = 0; i < data.length; i++) {
                      var option = document.createElement("option");
                          option.value = data[i].id;
                          option.text  = data[i].name;
                          var unidadFija = 0;

                          if(data[i].unidad != undefined && data[i].unidad != null ){
                            unidadFija = data[i].unidad; 
                          }
                          option.setAttribute('unidad' , unidadFija);
                          element.appendChild(option);
           }
        }
     }

      // ---------------------------------
      // Select Ley
      var selectLey =  function (e) {
        id_ley = e.value;
        row    = e.getAttribute('row').trim();
        var unidadFija = 0;
        if (id_ley === '')
            return false;

         if ( e.selectedIndex != null && e.selectedIndex > 0 ) {
            unidadFija = e.options[e.selectedIndex].getAttribute('unidad');
         }
        removeOption('selectArticulo'+row);
        removeOption('selectInciso'+row);
         
        // Seteamos el valor de unidad fija 
        document.getElementById('unidad_'+row).value = unidadFija;
          
         
        $.getJSON('<?php echo base_url(); ?>articulo/get_json_articulos/' + id_ley, function (data) {
            var element = document.getElementById('selectArticulo'+row);
            console.log("element  al change ley : ", element);
            agregarOption( element, data);
        });

        agregarOption(document.getElementById("selectInciso"+row), []);
      }; 


    // ------------------------------------------------
    //articulo 
    var selectArticulo = function(e) {
        var id_articulo = e.value;
        var row    = e.getAttribute('row').trim();

        if (id_articulo === '')
            return false;
         
         var unidadFija = 0;
         if ( e.selectedIndex != null && e.selectedIndex > 0 ) {
            unidadFija = e.options[e.selectedIndex].getAttribute('unidad');
         } 
         if ( unidadFija != 0 ) {
            document.getElementById('unidad_'+row).value = unidadFija;
         }
         
        console.log('incisos unidad fija : ', unidadFija);
        removeOption('selectInciso'+row);
        $("#incisoDescripcion").val();
        $("#articuloDescripcion").val();
        
        $.getJSON('<?php echo base_url(); ?>inciso/get_json_incisos/' + id_articulo, function (data) {
            var element = document.getElementById('selectInciso'+row);
            agregarOption( element, data);
        });


           
    };
   
    // -----------------------------------------
    // inciso
    var selectInciso = function(e) {
        var id_inciso = e.value;
        var row    = e.getAttribute('row').trim();

        if (id_inciso === '')
            return false;
         
         var unidadFija = 0;
         if ( e.selectedIndex != null && e.selectedIndex > 0 ) {
            unidadFija = e.options[e.selectedIndex].getAttribute('unidad');
         } 
         if ( unidadFija != 0 ) {
            document.getElementById('unidad_'+row).value = unidadFija;
         }
           
    };

    // Remove options of select 
    var removeOption = function( id ) {
      var select = document.getElementById(id);
      if ( select != null ) {
          select.length = 0;
      }
    }
      
    // Funcion de Validation of input      
    var validNumber = new RegExp(/^\d*\.?\d*$/);
    var validateNumber = function(elem) {
       elem.value = elem.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
   }


   var exhimido = function( idRow ){
     console.log('exhimido idRow : '+ id);
     $("#modal_exhimido_articulo").modal('show'); 
     var estadoArticuloExhimido = $("#estado_eximido_"+idRow).val();
     var textExhimidoArticulo   = $("#texto_eximido_"+idRow).val();
     $("#descripcionExhimido").val(textExhimidoArticulo);
     $("#idRowArticuloExhimido").val(idRow);
       
   }

    return {

        agregarRow : agregarRow,
        selectLey : selectLey ,
        selectArticulo : selectArticulo,
        eliminarRow : eliminarRow,
        selectInciso: selectInciso,
        validateNumber: validateNumber,
        exhimido : exhimido
    }

 }());
</script>