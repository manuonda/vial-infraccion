<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-file-text-o"></i><?php echo $subtitulo ?> </div>
    </div>

    
    <div class="portlet-body form">
        <!-- BEGIN FORM-->

        <?php echo form_open_multipart('inciso/guardar', ' id="form-inciso" class="horizontal-form"'); ?>
        <div class="form-body">                    
          

            <input type="hidden" name="id" id="id" value="<?php if (isset($inciso)) echo $inciso->id_inciso; ?>" />
    
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group" id="nombre-div">
                        <label class="control-label">Nombre(*):</label>
                        <input class="form-control requerido" id="numero" placeholder="Nombre" name="nombre" 
                               value="<?php if (isset($inciso)) echo $inciso->nombre; ?>"
                               type="text" required="required"> 
                        <span class="span_none" id="nombre-error">Ingrese Nombre </span>
                    </div>
                </div>
                </div>   

                <div class="row">
                    <div class="col-md-3">

                     <div class="form-group" id="grupo-div">
                     <label class="control-label" for="ley">Ley(*):</label>
                     <div class=" input-group bootstrap-touchspin">
                     <select class="form-control requerido select2"  data-toggle="tooltip" id="ley"  name="ley">
                            <option value="">-- Seleccionar --</option>
                            <?php foreach ($leyes as $ley): ?>                                                                        
                                <option value="<?php echo $ley->id ?>"    
                                        <?php if (isset($ley) && $ley->id == $id_ley) echo 'selected="selected"'; ?>>
                                    <?php echo $ley->nombre ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block" id="grupo-error"> Seleccione Ley</span>
                 </div>   
                 </div>
                 </div>

                   <div class="col-md-3 ">

                    <div class="form-group" id="modelo-div">
                        <label class="control-label">Articulo(*)</label>
                        <div class=" input-group bootstrap-touchspin">
                            <select class="form-control select2 requerido" id="articulo" name="articulo">
                                 <option value="">Seleccionar</option>
                                <?php foreach ($articulos as $articulo): ?>
                                    <option value="<?php echo $articulo->id_articulo ?>"    
                                    <?php if (isset($id_articulo) && $id_articulo == $articulo->id_articulo) echo 'selected="selected"'; ?>>
                                            <?php echo $articulo->nombre ?></option>
                                        <?php endforeach; ?> 
                            </select>
                            
                        </div>
                        <span class="span_none" id="modelo-error"> Modelo</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="nombre-div">
                        <label class="control-label">Unidad Fija:</label>
                        <input type="number" class="form-control requerido" id="unidad_fija" placeholder="Nombre" name="unidad_fija" 
                               value="<?php if (isset($inciso)) echo $inciso->unidad_fija; ?>"
                               type="text" required="required"> 
                    </div>
                </div>


                </div>
                <!-- 
                <div class="row">
                 <div class="col-md-3">
                  <div class="form-group" id="grupo-div">
                   <label class="control-label">Tipo Unidad (*):</label>
                    <select class="form-control requerido"  data-toggle="tooltip" id="tipounidad"  name="tipounidad">
                            <option value="">-- Seleccionar --</option>
                            <?php foreach ($tipoUnidades as $key => $value): ?>                                                                        
                                <option value="<?php echo $key ?>"    
                                        <?php if (isset($inciso) && $key == $inciso->tipo_unidad) echo 'selected="selected"'; ?>>
                                    <?php echo $value ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block" id="grupo-error"> Seleccione Tipo Unidad</span>
                  </div>
                </div>

                 
                </div>
            -->
               
                <h3 class="form-section">Descripción</h3>
            <div class="row">

              
              <div class="col-md-12">
                <textarea class="form-control" name="descripcion" id="descripcion" 
                  
                ><?php if(isset($inciso)) echo $inciso->descripcion; ?></textarea>
              </div>  
            </div>

                
            </div>

           
           

            <br></br>


             <div id="div_message" class="custom-alerts alert alert-danger fade in">
                <div id="message_alert">
                </div> 
            </div>



            <!-- Acciones -->
            <div class="form-actions right">

              
                
                <a href="<?php echo base_url(); ?>ley/" class="btn default"> Volver</a>
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


           
           
        </div>
         </form>
            <!-- END FORM-->





        <script type="text/javascript">
     

        $(document).ready(function (){
              
            $("#div_message").hide();    
              
                //Formulario Perfil 
                $("#form-perfil").submit(function(eve){
                   eve.preventDefault();

                   console.log("formulario perfil");

                   if(validarCreateView()){
                      console.log("formulario validado");
                     
                       var data=new FormData(this);
                      //var form = document.getElementById('form-vial');
                      console.log("data : "+data);
                      //console.log("form : "+form);
                      //var formData = new FormData(form);
                      console.log("formData : "+JSON.stringify(data));
                      $.ajax({
                       type: "POST",
                       url: '<?php echo base_url(); ?>perfil/guardar',
                       data: data,
                       cache: false,
                       contentType: false,
                       processData: false,
                       dataType: "JSON",
                       success: function (data) {
                          if (data.status == 'OK') {
                             window.location="<?php echo base_url();?>perfil";
                           } else {
                             alert(data.message);
                          }
                        },
                         error: function (data) {
                        console.log("error => " + data);
                        }
                    });  

                   }
                });
              /////////////////////////////////////
              //select ley
                $("select[name=ley]").change(function () {
                    id_ley = $(this).val();
                    if (id_ley === '')
                        return false;

                    resetaCombo('modelo');

                    $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_articulos/' + id_ley, function (data) {

                        var option = new Array();
                        $("select[name=articulo]").append("<option>--Seleccionar--</option>");
                        $.each(data, function (i, obj) {
                            option[i] = document.createElement('option');
                            $(option[i]).attr({value: obj.id_articulo});
                            $(option[i]).append(obj.nombre);

                            $("select[name=articulo]").append(option[i]);
                        });
                    });
                });    
               



         }); //end Document Ready Function
              

            function resetaCombo(el) {
                    $("select[name='" + el + "']").empty();
                    var option = document.createElement('option');
                    $(option).attr({value: ''});
                    $(option).append('-- Seleccionar --');
                    $("select[name='" + el + "']").append(option);
                }

         //Funcion que permite verificar si 
         //el dni es correcto y valida si tiene leyes 
         //asociadas
         function validarCreateView(){
            console.log("validarCreateView");
            var msg="";

            var bandForm=true;
            var bandCuilInfractor=true;
            var bandCuilPropietario=true;
            var bandCantidad=true;

            if(validarForm('form-perfil')){
                bandForm=true;
            }else{
                bandForm=false;
            }
           

            if(bandForm){
                return true;
            }else{
                console.log("msg =>"+msg);
                //alert(msg);
                $("#div_message").show();
                $("#message_alert").empty();
                $("#message_alert").append(msg);
                return false;
            }
             
         }
        


       
        </script>
    </div>
