<!-- modal correspondiente a leyes -->
<div id="modal_domicilio" class="modal container" tabindex="-1" > 
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title" id="title">Domicilio</h4>
    </div>
    <div class="modal-body"> 
         <form id="form-domicilio" name="form-domicilio">

       
        <!-- hidden si es una identificador de contravecion a eliminar -->
        <input type="hidden" id="idDomicilio" value=""/>  
        <input type="hidden" id="cuilDomicilio"  value=""/>
        <input type="hidden" id="prefijoDomicilio" value=""/>
        
        <div class="row">
    
            <div class="col-md-3" id="domicilioPais-div">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2 requerido-domicilio"  id="domicilioPais" name="domicilioPais">
                        <option value="0">--Seleccionar--</option>
                         
                          <?php foreach ($paises as $pais): ?>                                                                        
                                <option value="<?php echo $pais->id_pais ?>">    
                                   <?php echo $pais->pais; ?>
                                </option>
                            <?php endforeach; ?>
                    </select>
                    <label for="form_control_1">Pais</label>
                   
                </div>
            </div> 
        
       
            <div class="col-md-3"  id="domicilioProvincia-div">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2 requerido-domicilio"  id="domicilioProvincia" name="domicilioProvincia">
                      <option value="">Seleccionar</option>
                     </select>
                    <label for="form_control_1">Provincia</label>
                  
                </div>
            </div>
        
         
              
            <div class="col-md-3" id="domicilioDepartamento-div">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2-departamento-domicilio requerido-domicilio"  id="domicilioDepartamento" name="domicilioDepartamento">
                      <option value="">Seleccionar</option>
                    </select>
                    <label for="form_control_1">Departamento</label>
                </div>
           </div>
       </div>


         <div class="row">
        
          
          <div class="col-md-3"  id="domicilioLocalidad-div"> 
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2-localidad-domicilio requerido-domicilio"  id="domicilioLocalidad" name="domicilioLocalidad">
                         <option value="">Seleccionar</option>
                    </select>
                    <label>Localidad</label>
                </div>
            </div> 
        

            <div class="col-md-3" id="domicilioBarrio-div">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2-barrio-domicilio requerido-domicilio"  id="domicilioBarrio" name="domicilioBarrio">
                    <option value="">Seleccionar</option>
                    </select>
                    <label for="form_control_1">Barrio</label>
                </div>
            </div> 
        

        
            <div class="col-md-3" id="domicilioCalle-div">
                <div class="form-group form-md-line-input has-feedback">
                    <select class="form-control select2-calle-domicilio requerido-domicilio"  id="domicilioCalle" name="domicilioCalle">
                    </select>
                    <label for="form_control_1">Calle</label>
                </div>
            </div> 
        </div>
        
        <div class="row">
          <div class="col-md-3">
          <div class="m-checkbox-list">
          
           <input type="checkbox" id="domicilioActual" name="domicilioActual"> Domicilio Actual ?
           <span></span>
           </div>
          </div>  
        </div>


        <div class="row">
          <div class="col-md-3">
          <div class="form-group form-md-line-input has-feedback">
          <label>Número</label>
          <input type="text" class="form-control" id="domicilioNumero"/>
          </div> 
          </div>  

          <div class="col-md-3">
            <div class="form-group form-md-line-input has-feedback">
            <label>Manzana</label>
            <input type="text" class="form-control" id="domicilioManzana"/>
            </div>
          </div>

          <div class="col-md-3">
             <div class="form-group form-md-line-input has-feedback">
             <label>Lote</label>
             <input type="text" class="form-control" id="domicilioLote"/>
             </div>
          </div>

        

        </div>

        <div class="row">
           <div class="col-md-3">
             <div class="form-group form-md-line-input has-feedback">
              <label>Sector</label>
              <input type="text" class="form-control" id="domicilioSector"/>
             </div>   
          </div>

           <div class="col-md-3">
            <div class="form-group form-md-line-input has-feedbackp">
            <label>Departamento</label>
            <input type="text" class="form-control" id="domicilioNumeroDepartamento"/>  
            </div> 
           </div>

           <div class="col-md-3">
            <div class="form-group form-md-line-input has-feedback">
            <label>Piso</label>
            <input type="text" class="form-control" id="domicilioPiso"/>
            </div>
           </div>

       
       </div>

       <div class="row">
      
           <div class="col-md-3">
             <div class="form-group form-md-line-input has-feedback">
             <label>Monoblock</label>
             <input type="text" class="form-control" id="domicilioMonoblock"/>  
             </div>
           </div>
       
       </div>


        <div class="row">
          <div class="col-md-12">
             <div class="form-group form-md-line-input has-feedback">
             <label>Observacion</label>
             <input type="text" class="form-control" id="domicilioObservacion"/>  
             </div>
           </div>
        </div>

         

  
     </form>
    </div>
    <div class="modal-footer">

        <button type="button" data-dismiss="modal" id="btnCerrarDomicilio" class="btn dark btn-outline">Cerrar</button>
        <button type="submit" class="btn red" onclick="moduleDomicilioModal.guardarDomicilio()">Guardar</button>
    </div>
</div>

 <?php $this->load->view('modal/modal_domicilio/modal_departamento');?>
 <?php $this->load->view('modal/modal_domicilio/modal_localidad');?>
 <?php $this->load->view('modal/modal_domicilio/modal_barrio');?>
 <?php $this->load->view('modal/modal_domicilio/modal_calle');?>


<!-- end modal -->


<script type="text/javascript">
 
  var moduleDomicilioModal = (function() {
    

    var addDomicilio = function(prefijo){
            
            limpiarModalDomicilio();

            let cuil= $("#cuil"+prefijo).val();
            $("#prefijoDomicilio").val(prefijo);
            $("#idDomicilio").val();
            $("#cuilDomicilio").val(cuil);
            $("#modal_domicilio").modal('show');    
     }   


   function limpiarModalDomicilio(){
        console.log("limpari domicilio");
        
        $("#domicilioPais").val("-1");
        $("select[name=domicilioPais]").val("-1");
        $("#domicilioPais").val("-1");
        resetaCombo('domicilioProvincia');
        resetaCombo('domcilioDepartamento');
        resetaCombo('domicilioLocalidad');
        resetaCombo('domicilioBarrio');
        resetaCombo('domicilioCalle'); 

        $("#idDomicilio").val("");
        $("#cuilDomicilio").val("");
        $("#prefijoDomicilio").val("");
        $("#domicilioPais").val(0);
        $("#domicilioNumero").val("0");
        $("#domicilioManzana").val("");
        $("#domicilioLote").val("");
        $("#domicilioSector").val("");
        $("#domicilioNumeroDepartamento").val("");
        $("#domicilioPiso").val("");
        $("#domicilioMonoblock").val("");
        $("#domicilioObservacion").val("");
        $("#domicilioActual").prop('checked',false);

        console.log("domicilio apis ,",$("#domicilioPais").val());

        $.getJSON('<?php echo base_url(); ?>/combo_dinamico/get_paises', function (data) {

            var option = new Array();
            $("select[name=domicilioPais]").empty();
            $("select[name=domicilioPais]").append("<option value=''>Seleccionar</option>");  
            $.each(data, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_pais});
                $(option[i]).append(obj.pais);

                $("select[name=domicilioPais]").append(option[i]);
            });
        });


    }

    /**
     * Funcion que permite actualizar 
     * el domicilio
    **/
    function actualizarDomicilio(datos){
        console.log("dat = ",datos);
         let elements =datos.split("-");
         let idDomicilio = elements[0];
         let cuit        = elements[1];
 
        var data = {
                 'idDomicilio':idDomicilio,
                 'cuilDomicilio':cuit
        };

       
         $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>domicilio/actualizar',
                    data: JSON.stringify(data),
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function (data) {
                        console.log(data)
                        if (data.status == "OK") {
                            alert(data.message);

                        } else {
                            alert(data.message);
                        }
                    },
                    error: function (data) {
                        alert("Error al actaulizar el domicilio");
                    }
                }); 
    }

    /**
     * Btn agregar Ley de Contravencion
     **/

     function guardarDomicilio(){

        if(validarFormDomicilio('#form-domicilio')){
             
            var idDomicilio=$("#idDomicilio").val();
            var cuilDomicilio=$("#cuilDomicilio").val();
            var prefijoDomicilio =$("#prefijoDomicilio").val();
           
            var pais=$("#domicilioPais").val();
            var provincia=$("#domicilioProvincia").val();
            var departamento=$("#domicilioDepartamento").val();
            var localidad=$("#domicilioLocalidad").val();
            var barrio=$("#domicilioBarrio").val();
            var calle=$("#domicilioCalle").val();
            var numero=$("#domicilioNumero").val();
            var manzana=$("#domicilioManzana").val();
            var lote=$("#domicilioLote").val();
            var sector=$("#domicilioSector").val();
            var numeroDepartamento=$("#domicilioNumeroDepartamento").val();
            var piso=$("#domicilioPiso").val();
            var monoblock=$("#domicilioMonoblock").val();
            var domicilioActual=$("#domicilioActual").prop('checked');
            var observacion =$("#domicilioObservacion").val(); 
            var data = {
                 'idDomicilio':idDomicilio,
                 'cuilDomicilio':cuilDomicilio, 
                 'prefijoDomicilio':prefijoDomicilio,
                 'pais':pais,
                 'provincia':provincia,
                 'departamento':departamento,
                 'localidad':localidad,
                 'barrio':barrio,
                 'calle':calle,
                 'numero':numero,
                 'manzana':manzana,
                 'lote':lote,
                 'sector':sector,
                 'numeroDepartamento':numeroDepartamento,
                 'piso':piso,
                 'monoblock':monoblock,
                 'domicilioActual':domicilioActual,
                 'observacion' : observacion
            };

             $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>domicilio/guardar',
                    data: JSON.stringify(data),
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function (data) {
                        console.log(data)
                        if (data.status == "OK") {
                            $("#tbodyDomicilio"+prefijoDomicilio).empty();
                            $("#tbodyDomicilio"+prefijoDomicilio).append(data.domicilios);
                            $("#btnCerrarDomicilio").click();
                            
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function (data) {
                        alert("Error al guardar el domicilio");
                        console.log("error => " + data);
                    }
                });   
        
        }            
 
    }


    
    function editarDomicilio(datos){
      let elements =datos.split("-");
      let idDomicilio = elements[0];
      let cuit        = elements[1];
      let tipoPersona = elements[2];

          $.ajax({
           type:"GET",
           url:'<?php echo base_url();?>domicilio/editar/'+idDomicilio,
           cache: false,
           contentType: false,
           processData: false,
           dataType: "JSON",
           success:function(data){
              if(data.status=="OK"){

                //seteamos los valores  
                $("#idDomicilio").val(idDomicilio);
                $("#cuilDomicilio").val(cuit);
                $("#prefijoDomicilio").val(tipoPersona);

               //load datos del domicilio  
               loadDataDomicilio(data,tipoPersona);
               $("#modal_domicilio").modal('show');
              }else{
                alert("No se pudo obtener el domicilio");
              }
           },
           error:function(data){
            alert("Se produjo un error al obtener el domicilio");
            console.log("error : ",data);
           }
        })  
     }



     function loadDataDomicilio(datos){

        
        if(datos.paises != null && datos.paises !=""){
          
           $("select[name=domicilioPais]").empty();
           $("select[name=domicilioPais]").append("<option value='-1'>Seleccionar</option>"); 
            var option = new Array();
            $.each(datos.paises, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_pais});
                $(option[i]).append(obj.pais);
                $("select[name=domicilioPais]").append(option[i]);
            });

            $("select[name=domicilioPais]").val(datos.pais.id_pais);
        
        }

        if(datos.provincias != null && datos.provincias !=""){

            $("select[name=domicilioProvincia]").empty();
            $("select[name=domicilioProvincia]").append("<option value=''>Seleccionar</option>"); 
            var option = new Array();
            $.each(datos.provincias, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_provincia});
                $(option[i]).append(obj.provincia);
                $("select[name=domicilioProvincia]").append(option[i]);
            });

             $("select[name=domicilioProvincia]").val(datos.provincia.id_provincia);

        }

        if(datos.departamentos != null && datos.departamentos != undefined ){
              var option = new Array();
              $("select[name=domicilioDepartamento]").empty();
              $("select[name=domicilioDepartamento]").append("<option value=''>Seleccionar</option>");  
              $.each(datos.departamentos, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_departamento});
                $(option[i]).append(obj.depto);

                $("select[name=domicilioDepartamento]").append(option[i]);
             });
           
            $("select[name=domicilioDepartamento]").val(datos.departamento.id_departamento);
        }

        if(datos.localidades !=null && datos.localidades!=""){
            var option = new Array();
            $("select[name=domicilioLocalidad]").empty();
            $("select[name=domicilioLocalidad]").append("<option value=''>Seleccionar</option>");  
            $.each(datos.localidades, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_localidad});
                $(option[i]).append(obj.localidad);

                $("select[name=domicilioLocalidad]").append(option[i]);
            });

             $("select[name=domicilioLocalidad]").val(datos.localidad.id_localidad);
        }

        if(datos.barrios != null && datos.barrios !=""){
            var option = new Array();
            $("select[name=domicilioBarrio]").empty();
            $("select[name=domicilioBarrio]").append("<option value=''>Seleccionar</option>");  

            $.each(datos.barrios, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_barrio});
                $(option[i]).append(obj.barrio);

                $("select[name=domicilioBarrio]").append(option[i]);
            });

            $("select[name=domicilioBarrio]").val(datos.barrio.id_barrio);

        }

        if(datos.calles != null && datos.calles){
            var option = new Array();
            $("select[name=domicilioCalle]").empty();
            $("select[name=domicilioCalle]").append("<option value=''>Seleccionar</option>");  


            $.each(datos.calles, function (i, obj) {
                option[i] = document.createElement('option');
                $(option[i]).attr({value: obj.id_calle});
                $(option[i]).append(obj.calle);

                $("select[name=domicilioCalle]").append(option[i]);
            });
             $("select[name=domicilioCalle]").val(datos.calle.id_calle);
        }



     
       //aquie el resto de valores y domciilios    

       $("#domicilioNumero").val(datos.domicilio.numero);
       $("#domicilioManzana").val(datos.domicilio.manzana);
       $("#domicilioLote").val(datos.domicilio.lote);
       $("#domicilioSector").val(datos.domicilio.sector);
       $("#domicilioPiso").val(datos.domicilio.piso);
       $("#domicilioMonoblock").val(datos.domicilio.monoblock);
       $("#domicilioNumeroDepartamento").val(datos.domicilio.departamento);
       $("#domicilioActual").prop('checked');
       $("#domicilioObservacion").val(datos.domicilio.descripcion);

       if(datos.actual =='t'){
          console.log("ingreso aca");
        $("#domicilioActual").prop('checked',true);
       }else{
        $("#domicilioActual").prop('checked',false);
       }


     }
 


    




    /**
     * Eliminar Domicilio
    */ 
    function eliminarDomicilio(datos){
     let elements =datos.split("-");
     let idDomicilio = elements[0];
     let cuit        = elements[1];
     let tipoPersona = elements[2];

     console.log("elemtnos ",elements);
     var request =  confirm('Desea eliminar el Domicilio ? ');
     
     if(request){
        $.ajax({
           type:"GET",
           url:'<?php echo base_url();?>domicilio/eliminar/'+idDomicilio,
           cache: false,
           contentType: false,
           processData: false,
           dataType: "JSON",
           success:function(data){
              console.log(data);
              console.log(data.status);
              if(data.status=="OK"){
                alert("Se elimino el domicilio Correctamente");
                let tablaDdomicilio = 'tbodyDomicilio'+tipoPersona;
                $('#'+tablaDdomicilio+' tr#'+datos).remove();

              }else{
                alert("No se pudo eliminar el domicilio");
              }
           },
           error:function(data){
            console.log("error : ",data);
           }
        })  
     }
    }

    return {
        addDomicilio : addDomicilio ,
        guardarDomicilio : guardarDomicilio ,
        editarDomicilio : editarDomicilio ,
        eliminarDomicilio : eliminarDomicilio ,
        loadDataDomicilio : loadDataDomicilio ,
        actualizarDomicilio : actualizarDomicilio
    }
   
   
  }());
     
    
     
   


</script>