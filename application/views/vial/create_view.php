<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-file-text-o"></i><?php echo $subtitulo ?></div>
    </div>

    
    <div class="portlet-body form">
        <!-- BEGIN FORM-->

        <?php echo form_open_multipart('infraccionvial/guardar', ' id="form-vial" class="horizontal-form"'); ?>
        <div class="form-body">                    
           

            <input type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $id; ?>" />
            <input type="hidden" name="idPersonaJuridica" name="idPersonaJuridica" value="<?php if (isset($personaJuridica)) echo $personaJuridica->id_persona_juridica; ?>"/>
            <input type="hidden" name="pTipoPersona" id="pTipoPersona" />
            <input type="hidden" name="dniSelected" id="dniSelected"/>
            <input type="hidden" id="estadoUsuario"/>
                

            <div id="div_message" class="custom-alerts alert alert-danger fade in">
                <div id="message_alert">
                </div> 
            </div>


              <div class="tabbable-line">
                 <ul class="nav nav-tabs ">
                 <li class="active">
                 <a href="#tab_1" data-toggle="tab" aria-expanded="true">Datos Infraccion </a>
                 </li>
                 <li class="">
                 <a href="#tab_2" data-toggle="tab" aria-expanded="false"> Leyes </a>
                 </li>
                 <li>
                 <a href="#tab_3" data-toggle="tab">Datos del Conductor y Propietario </a>
                 </li>
                 <li>
                 <a href="#tab_4" data-toggle="tab">Informacion</a>
                 </li>
                 </ul>
                 <div class="tab-content">
                 <div class="tab-pane active" id="tab_1">
                    <?php $this->load->view('vial/sections/section_infraccion');?>
                 </div>
                 <div class="tab-pane" id="tab_2">
                   <?php $this->load->view('vial/sections/section_leyes');?>
                 </div>
                 <div class="tab-pane" id="tab_3">
                    <?php $this->load->view('vial/sections/section_datos_conductor');?>
                     <?php $this->load->view('vial/sections/section_datos_propietario');?>
                 </div>
                 <div class="tab-pane" id="tab_4">
                    <?php $this->load->view('vial/sections/section_datos_informacion');?>
                 </div>
                 
                 </div>
           





            <!-- Acciones -->
            <div class="form-actions right">
                <a href="<?php echo base_url(); ?>infraccionvial/" class="btn default"> Cerrar</a>
                <?php if (!isset($id)) : ?>
                    <button type="submit" class="btn green">
                        <i class="fa fa-plus"></i> Guardar
                    </button>
                <?php else: ?>
                   
                    <button type="submit" class="btn blue">
                        <i class="fa fa-save"></i> Actualizar
                    </button>
                <?php endif; ?>
            </div>


            </form>
            <!-- END FORM-->
            <!- /**********************************************/ -->
            
            <!-- include leyes modal detalle_infraccion -->
            <?php $this->load->view('modal/detalle_infraccion'); ?>

            <!-- modal de tipovehiculo , marca , modelo -->
            <?php $this->load->view('modal/modal_vehiculo/modal_tipovehiculo');?>
            
            <?php $this->load->view('modal/modal_vehiculo/modal_marca');?>

            <?php $this->load->view('modal/modal_vehiculo/modal_modelo');?> 

            <?php $this->load->view('modal/modal_destacamento'); ?>

            <!-- modal correspondiente archiva observacion -->
            <?php $this->load->view('vial/modal/modal_archivar_expediente');?>

            <!-- modal buscar persona -->
            <?php $this->load->view('vial/modal_buscar_persona');?>

            <!-- modal add domicilio o edit domicilio -->
            <?php $this->load->view('modal/modal_domicilio/modal_domicilio');?>

            <!-- modal de estado de articulo exhimido -->
            <?php $this->load->view('vial/modal/modal_exhimido_articulo');?>

             
             <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
             </div>
             <!-- /.modal -->
            <!-- end modal -->
        </div>




      
       
        <!--load js -->  
        <?php $this->load->view('js/combosVial');?>
        <?php $this->load->view('js/combosDomicilio');?>

        <script type="text/javascript">
        //Para realizar la validacion del Cuil ingresado es correcto 
        var cuilInfractorEncontrado=false;
        var cuilPropietarioEncontrado=false;

        //Si ingreso alguna para habilitar
        var cantLey=0;


      

        $(document).ready(function (){

        $("#div_message").hide();   
           
        //Formulario Vial 
        $("#form-vial").submit(function(eve){
                   eve.preventDefault();

                   if(validarCreateView()){
                     $.blockUI({ message: '<h1><img src="<?php echo base_url();?>/assets/global/img/loading.gif" /> Guardando</h1>' });
                     //App.unblockUI("#blockui_sample_3_2_element");
                      var data=new FormData(this);
                    
                      $.ajax({
                       type: "POST",
                       url: '<?php echo base_url(); ?>infraccionvial/guardar',
                       data: data,
                       cache: false,
                       contentType: false,
                       processData: false,
                       dataType: "JSON",
                       success: function (data) {
                       
                          if (data.status == 'OK') {
                             window.location="<?php echo base_url();?>infraccionvial";
                           } else {
                             $.unblockUI();
                             alert(data.message);
                          }
                        },
                         error: function (data) {
                         $.unblockUI();
                         alert("Se produjo un error al Guardar : ", JSON.stringify(error)); 
                        }
                    });  

                   }
                });
         }); //end Document Ready Function
              

       


        function resetaCombo(el) {
                    $("select[name='" + el + "']").empty();
                    var option = document.createElement('option');
                    $(option).attr({value: ''});
                    $(option).append('-- Seleccionar --');
                    $("select[name='" + el + "']").append(option);
         }
             
             


            
   /**
     ******************************
     * Agrego el metodo del modal 
     * correspondiente agregar involucrado 
   **/
   var personaSelectedDni="";
   var pTipoPersona=""; 
   function agregarPersona() {
                        
    var pTipoPersona=$("#pTipoPersona").val();
    var personaSelectedDni=$("#dniSelected").val();
    var estadoPersona=$("#estadoUsuario").val();
    var parameter = personaSelectedDni + "-"+pTipoPersona;

    console.log("tipoPersona : "+pTipoPersona + " personaSelectedDni : "+personaSelectedDni);
    if ( personaSelectedDni !== '0' ) {

    $.getJSON('<?php echo base_url(); ?>/request_json/get_informacionPersona/' + parameter, function (datos) {

         if (datos != null) {
           if (datos.status == "OK") {
               loadDataPersona(datos.persona, pTipoPersona,estadoPersona);
                $("#btnModalInvolucradoClose").click();
               
            } else {
                alert(datos.message)
            }
         }

       });  
        $("#personaEstablecer"+pTipoPersona).removeClass("btn default btn-xs green");
        $("#personaEstablecer"+pTipoPersona).empty();
        $("#personaEstablecer"+pTipoPersona+"Valor").val(0);
     } else {
        // indica la persona a establecer
        borraDataPersona(pTipoPersona,"Nuevo");
        $("#cuil"+ pTipoPersona).val('0');
        $("#btnModalInvolucradoClose").click();
        $("#personaEstablecer"+pTipoPersona).addClass("btn default btn-xs green");
        $("#personaEstablecer"+pTipoPersona).append("Persona a Establecer");
        // Asigno el valor de 1 para indicar la persona a establecer 
        // por propietaroio o involucrado
        $("#personaEstablecer"+pTipoPersona+"Valor").val(1);
         // Habilito para permitir guardar datos de la persona 
        // porque es una persona a establecer
        $("#nombre"+pTipoPersona).prop("readonly",false);
        $("#apellido"+pTipoPersona).prop("readonly",false);
        $("#cuil" + pTipoPersona).prop("readonly", false);
        $("#nombre" + pTipoPersona).prop("readonly", false);
        $("#apellido" + pTipoPersona).prop("readonly", false);
        $("#tipoDocumento" + pTipoPersona).prop("readonly", false);
        $("#numeroDocumento" + pTipoPersona).prop("readonly", false);
        $("#fechaNacimiento" + pTipoPersona).prop("readonly", false);
        $("#nacionalidad" + pTipoPersona).prop("readonly", false);
        $("#sexo"+ pTipoPersona).prop("readonly", false);
        // Botones para persona a establecer
        $("#btnBorrar"+pTipoPersona+"Editar").addClass('show');//hide();
        $("#btnBuscar"+pTipoPersona+"Editar").removeClass('hide');//.show();


     } 
   }



   function borraDataPersona(prefijo,estadoPersona){
         console.log("borrarData Persona : "+prefijo);
        $("#cuil" + prefijo).val('');
        $("#nombre" + prefijo).val('');
        $("#apellido" + prefijo).val('');
        $("#tipoDocumento" + prefijo).val('');
        $("#numeroDocumento" + prefijo).val('');
        $("#fechaNacimiento" + prefijo).val('');
        $("#nacionalidad" + prefijo).val('');
        $("#sexo" + prefijo).val('');
        $("#tbodyDomicilio" + prefijo).empty();
        $("#btnAddDomicilio"+ prefijo).prop("disabled",true); 
        // Deshabilito los input
        $("#nombre"+prefijo).prop("readonly",true);
        $("#apellido"+prefijo).prop("readonly",true);
        $("#cuil" + prefijo).prop("readonly", true);
        $("#nombre" + prefijo).prop("readonly", true);
        $("#apellido" + prefijo).prop("readonly", true);
        $("#tipoDocumento" + prefijo).prop("readonly", true);
        $("#numeroDocumento" + prefijo).prop("readonly", true);
        $("#fechaNacimiento" + prefijo).prop("readonly", true);
        $("#nacionalidad" + prefijo).prop("readonly", true);
        $("#sexo"+ prefijo).prop("readonly", true);
        $("#personaEstablecer"+ prefijo +"Valor").val("0");
        
       
       
       if(estadoPersona=="Nuevo"){
          $("#tbodyDomicilio" + prefijo).empty();
          $("#btnAddDomicilio"+ prefijo).prop("disabled",true);    
          $("#btnBuscar"+prefijo+"Nuevo").removeClass('hide'); //.hide();
        }else{
            console.log('estado persona editar');
            $("#btnBuscar"+prefijo+"Editar").removeClass('hide');//.show();
            $("#btnBorrar"+prefijo+"Editar").addClass('hide');//hide();
        }
   } 


   /** Funcion que permite cargar los datos 
     * de la persona e indicar a que seccion es 
     * con el prefijo
    */
         
   function loadDataPersona(datos, prefijo,estado) {
        var persona = datos.datos;
        var domicilios = datos.domicilios;
        $("#cuil" + prefijo).val(persona.cuil);
        $("#nombre" + prefijo).val(persona.nombre);
        $("#apellido" + prefijo).val(persona.apellido);
        $("#tipoDocumento" + prefijo).val(persona.tipoDocumento);
        $("#numeroDocumento" + prefijo).val(persona.dni);
        $("#fechaNacimiento" + prefijo).val(persona.fechaNacimiento);
        $("#nacionalidad" + prefijo).val(persona.nacionalidad);
        console.log("load Data persona");
        $("#btnAddDomicilio"+prefijo).prop("disabled",false);

        if (persona.sexo == 'M') {
            $("#sexo" + prefijo).val('M');
        } else {
            $("#sexo" + prefijo).val('F');
        }

        var rows = $("#tbodyDomicilio" + prefijo);
        //clear rows
        rows.empty();

        $("#tbodyDomicilio"+prefijo).append(domicilios);
        $("#tableDomicilio" + prefijo).dataTable();
        if(estado=="Nuevo"){
            $("#btnBuscar"+prefijo+"Nuevo").addClass('hide'); //.hide();
            $("#btnBorrar"+prefijo+"Nuevo").removeClass('hide');//show();
            console.log("load Data persona");
        
        }else{
            $("#btnBuscar"+prefijo+"Editar").addClass('hide');//.hide();
            $("#btnBorrar"+prefijo+"Editar").removeClass('hide');//show();
        }
    }
    </script>

<script type="text/javascript">
     
     //Funcion que permite verificar si 
     //el dni es correcto y valida si tiene leyes 
     //asociadas
     function validarCreateView(){
     
        var msg="";

        var bandForm=true;
        var bandCuilInvolucrado=true;
        var bandCuilPropietario=true;
        var bandCantidad=true;
        var bandTipoPersona = false;
        var tipoPersona = '';
        var numeroDocumentoPropietario=$("#numeroDocumentoPropietario").val();
        var numeroDocumentoInvolucrado=$("#numeroDocumentoInvolucrado").val();
        document.querySelectorAll('input[name="tipo_persona"]:checked')
                .forEach( element =>  {  
                    if ( element.checked ) {
                        tipoPersona = element.value;
                        bandTipoPersona = true;
                    }
                });




        if(validarForm('#form-vial')){
            console.log("validar Form");
            bandForm=true;
        }else{
             msg=msg + "<strong>Debe Completar los campos requeridos.</strong>";
            bandForm=false;
        }
        
        var table = document.getElementById('tbodyDetalleInfraccion');
        var rowCount = table.rows.length; // cantidad de Rows
        if(rowCount == 0 ) {
            msg=msg + "<br><strong>Debe ingresar una ley para esta infracción</strong>";
            bandCantidad=false;
        }


        if ( ( numeroDocumentoPropietario=="" || numeroDocumentoPropietario.length==0) && tipoPersona == 'PF'){
             msg=msg + " <br><strong>Debe ingresar un cuil/dni de Propietario</strong>";
            bandCuilPropietario=false;
        }

        console.log( bandTipoPersona );
        if (!bandTipoPersona){

            msg =  msg + "<br><strong> Debe Seleccionar un Tipo Persona Juridica </strong>";
        }

        if(bandForm && bandCuilPropietario && bandCantidad && bandTipoPersona){
            return true;
        }else{
           
            $("#div_message").show();
            $("#message_alert").empty();
            $("#message_alert").append(msg);
            return false;
        }
         
     }


    var module_infraccion_vial = ( function () {
       var mostrarSection = function(tipo) {
          var elements = document.querySelectorAll('.section');
          if( elements != null && elements.length > 0 ) {
              elements.forEach( element => {
                  element.style.display = 'none';
              }); 
          }
          console.log(elements);

          if ( tipo == 'PF') {
             console.log('PF')
             $("#section_persona_fisica").css('display','');
          } else if ( tipo == 'PJ'){
             console.log('PJ');
             $("#section_persona_juridica").css('display','');   
          } else {
             $("#section_persona_juridica").css('display', 'none');
             $("#section_persona_juridica").css('display', 'none');
          }
       }

       return {
         mostrarSection : mostrarSection
       }
    }());

 </script>

