<!-- modal correspondiente a leyes -->
<div id="modal_add_involucrado" class="modal container fade" tabindex="-1" > 
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Búsqueda de Personas</h4>
    </div>
<div class="modal-body"> 
  
      <form> 
        <!-- hidden si es una identificador de contravecion a eliminar -->
        <input type="hidden" id="idContArtInciso" value="null"/>  
        <h5 class="caption-subject bold uppercase sub-titulo">
            Opciones de Búsqueda
        </h5>
          
         

         <div class="row">
          <div class="col-md-3">
          <div class="form-group">
          <div class="mt-radio-list">
          
          <label class="mt-radio mt-radio-outline"> Dni/Cuil
           <input value="dni" name="type" id="dniCheck" checked type="radio">
             
          <span></span>
          </label>
          <label class="mt-radio mt-radio-outline"> Nombre y Apellido
          <input value="nombreApellido" name="type" type="radio">
          <span></span>
          </label>
          </div>
          </div>
          
         </div> 
        </div> 
         
         <h5 class="bold">Búsqueda</h5>     
         <!--busqueda dni -->
         <div class="row divBusqueda" id="divdni">
          <div class="col-md-3">
          <div class="form-group">
          <label for="">Dni</label>
          <input class="form-control" id="cuilBuscar" placeholder="Ingrese numero" type="number" type="number" > 
          </div>
          </div>
          <div class="col-md-3">
          <div class="form-group">
          <label ></label>  
           <button type="button"  onclick=module_buscar_persona.actionFilterPersona('dni') class="form-control btn btn-primary">
                      Buscar <i class="fa fa-search"></i>
             </button>
          </div>
          </div>
          </div>
          <!-- end busqueda dni --> 
          
          <!-- busqueda nombre apellido-->
          <div class="row divBusqueda" id="divnombreApellido">
          <div class="col-md-3">
          <div class="form-group">
          <label for="dni">Nombre:</label>
           <input class="form-control" id="nombreBuscar" name="involucrado" type="text" type="number" >
          </div>
          </div>
          

          <div class="col-md-3">
          <div class="form-group">
          <label for="dni">Apellido:</label>
          <input class="form-control" id="apellidoBuscar" name="involucrado" type="text" type="number" >
          </div>
          </div> 

           <div class="col-md-3">
            <div class="form-group">
            <label ></label>
             <button type="button" id="btnFilterPersona"  class="form-control btn btn-primary" 
                  onclick=module_buscar_persona.actionFilterPersona('nombreApellido')>
                      Buscar <i class="fa fa-search"></i>
             </button>
           </div> 
          </div> 

          </div>

          <!-- div message filter -->
         <div class="row"> 
         <div class="col-md-6">
         <div id="div_message_filter" class="custom-alerts alert alert-danger fade in">
                <div id="message_filter">
         </div> 
         </div> 
         </div>
         </div>
         <!-- end message filter -->
         
         <hr/>
         <h5 class="caption-subject bold uppercase sub-titulo">
           Listado
         </h5>

         <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tableFiltroPersona">
          <thead>
          <tr>
          <th width="20%">Dni</th>
          <th width="30%">Nombre y Apellido</th>
          <th width="50%">Domicilio</th>
          </tr>
          </thead>
          <tbody id="tableBodyFilterPersona">
       
          </tbody>
          </table> 
          
         
         
        <div class="modal-footer">
           <button type="button" class="btn btn-default" id="btnModalInvolucradoClose" data-dismiss="modal">Cerrar</button>
           <button type="button" class="btn btn-primary" id="btnGuardarInvolucrado" onclick=agregarPersona()>Agregar Involucrado</button>
        </div>
    </form>
    </div>
    <!-- end modal comercio -->
    
    <script type="text/javascript">
     
     var module_buscar_persona = ( function () {
       
        var _prefijo = "";
        var _tipoPersona = "";

          /**
          * Funcion que permite realizar 
          * la busqueda de persona
         **/ 
       function showModalBuscar(prefijo,estadoUsuario){
          //table_=$("#tableFiltroPersona").DataTable({"pagingType": "full_numbers"});

           console.log("btnBuscarPersona223");
          $("#dniCheck").prop("checked",true);
          $("#divdni").show();
          $("#divnombreApellido").hide();
          $("#btnGuardarInvolucrado").prop("disabled",true);
          $("#modal_add_involucrado").modal('show');
          $("#cuilBuscar").val(0);
          $("#nombreBuscar").val("");
          $("#apellidoBuscar").val("");
           var rows = $("#tbodyDomicilio" + prefijo);
           //clear rows
           rows.empty();

           $("#tableBodyFilterPersona").empty();

           $("#btnGuardarInvolucrado").prop("disabled",true);
       
           //Establezco el tipo de persona para cargar los input
           //registros
           _tipoPersona=prefijo;
           $("#pTipoPersona").val(prefijo);
           $("#estadoUsuario").val(estadoUsuario); //Nuevo o Editar
          $("#div_message_filter").hide();
       }

  

        // Funcion que permite realizar la busqueda de datos 
        var  actionFilterPersona = function(type){
          console.log("filter persona");
          //elimino los registros de la tabla de domicilios
          var rows = $("#tableBodyFilterPersona");
          rows.empty();
          
          var dni=$("#cuilBuscar").val();
          var nombre=$("#nombreBuscar").val();
          var apellido=$("#apellidoBuscar").val();
          var type=type; 
          var msg="";
          var bandDni=false;
          var bandNombreApellido=false;

          //verification tipo dni
          if(type=='dni'){
             if(dni!="" && dni.length >=5){
               bandDni=true;
             }else{
                bandDni=false;
                msg="Debe ingresar numero de DNI con mas de 5 caracteres";
                $("#div_message_filter").show();
                $("#message_filter").empty();
                $("#message_filter").append(msg);
            }
          }

          //verificacion de nombre y apellido   
          if(type=='nombreApellido'){
              
             if((nombre!="" && nombre.length >=4) &&  (apellido!="" && apellido.length>=4)){
                bandNombreApellido=true;
             }else{
             msg="Debe ingresar Nombre y Apellido";
             bandNombreApellido=false;
             $("#div_message_filter").show();
             $("#message_filter").empty();
             $("#message_filter").append(msg);
            } 
          }

          if(bandDni || bandNombreApellido){
              var data = {'dni':dni,'nombre': nombre,'apellido':apellido,'type':type};
              getObtenerDatos(data);
          }
         
      }

      function getObtenerDatos(data){

         $.post('<?php echo base_url(); ?>/request_json/buscarFilterModal/', 
          JSON.stringify(data),
          function(response) {
             if(response.status=='OK') {
                var table = $("#tableFiltroPersona").DataTable();
                table.destroy(); 
                $("#tableFiltroPersona > tbody").empty();
                var listado=response.personas;
                var cont=0;
                console.log('listado de personas : ', listado );
                if(listado.length > 0 ){
                 
                   for(var i=0;i<listado.length;i++){
                   console.log(" i =>"+i+ "person = >"+listado[i].persona);
                   var persona= listado[i].persona;
                   var domicilios=listado[i].domicilios;

                  personas[persona.dni]=listado[i];
                  //var tableDomicilio=getTableDomicilios(domicilios);
                  var row="<tr>"+
                           "<td class='text-center'><div class='form-group'><div class='mt-radio-list'><label class='mt-radio mt-radio-outline'>"+persona.dni+
                           "<input type='radio' name='dniopcion[]' onchange=selectPersona("+persona.dni+") id='"+persona.dni+"' />"+
                           "<span></span></label>"+  
                           "</td>" +
                           "<td class='text-center'>"+ persona.nombre + ","+persona.apellido+"</td>"+
                           "<td class='text-center'>"+getDomiciliosHTML(domicilios)+"</td></tr>";
              
                    $("#tableFiltroPersona").append(row);

                  }
                 
          
                } else {
                  // No existen registros a insertar
                 
                               var row="<tr>"+
                           "<td class='text-center'><div class='form-group'>"+
                           "<div class='mt-radio-list'><label class='mt-radio mt-radio-outline'>0"+
                           "<input type='radio' name='dniopcion[]' onchange=selectPersona(0) id='establecer'/>"+
                           "<span></span></label>"+  
                           "</td>" +
                           "<td class='text-center'> Persona a Establecer</td>"+
                           "<td class='text-center'> No hay Domicilios </td></tr>";

                 $("#tableFiltroPersona").append(row);
              }
             $("#tableFiltroPersona").DataTable();
             }else{
                $("#btnCerrar").click();
                 alert("Se produjo un error al realizar el descargo");
              }
           }, 'json');                      

      }

     
      /**
       * Funcion que devuelve los domicilios 
       * 
       **/ 
       function getDomiciliosHTML(domicilios){
         var html="";
         if(domicilios!="" && domicilios!=null && domicilios.length>0){


           html=html+"<div class='container'><form>";
           for(i=0;i<domicilios.length;i++){
               var domicilio=domicilios[i];
                if(domicilio.actual=="t"){
                    html=html+"<div class='radio'><label><strong><h4 class='uppercase'><input type='radio' name='optradio' checked><u>BARRIO : "+domicilio.barrio+", CALLE: "+domicilio.calle+", N°: "+domicilio.numero+"</u></h4></strong></label></div><br>";                   
                 }else{
                      html=html+"<div class='radio'><label><h4 class='uppercase'><input type='radio' name='optradio'>BARRIO :"+domicilio.barrio+",CALLE: "+domicilio.calle+", N°: "+domicilio.numero+"</h4></label></div><br>";
                   }
                 }
                   html=html+"</form></div>";
                   
                   
         }else{
                    html="<label>No Hay Domicilios Asociados</label>"
         }

            return html;
      }

        return {
          showModalBuscar : showModalBuscar, 
          actionFilterPersona : actionFilterPersona
        }  

     }());

      var personas=[];
      var table_;
     
      
  
      
      

      //radio event 
      $("input[name='type']").change(function(){
          //oculto los div 
          $(".divBusqueda").hide();
          var valor=$(this).val();
          $("#div"+valor).show();
          $("#div_message_filter").hide();
          $("#message_filter").empty();
          $("#message_filter").append("");
      });   


      /**
        * Funcion que permite seleccionar una 
        * persona de la tabla de personas para cargar 
        * en el registro correspondiente
      **/
      function selectPersona(dni){
           console.log("dni => "+dni); 
           $("#btnGuardarInvolucrado").prop("disabled",false);
           personaSelectedDni=personas[dni];
           $("#dniSelected").val(dni);
      }
     
             
    /**
      * Funcion delete involucrado
    **/
    function deleteInvolucrado(cuil){
        var resultado=confirm('Desea eliminar al involucrado');
        if(resultado){
          $('table#tableInvolucrado tr#'+cuil).remove();
        }
    }



  
    </script>