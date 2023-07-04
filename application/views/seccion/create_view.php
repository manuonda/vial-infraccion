<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-file-text-o"></i><?php echo $subtitulo ?> </div>
    </div>

    
    <div class="portlet-body form">
        <!-- BEGIN FORM-->

        <?php echo form_open_multipart('rol/guardar', ' id="form-perfil" class="horizontal-form"'); ?>
        <div class="form-body">                    
            <h3 class="form-section">Seccion
            </h3>

            <input type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $id; ?>" />
    
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group" id="nombre-div">
                        <label class="control-label">Nombre(*):</label>
                        <input class="form-control requerido" id="numero" placeholder="Nombre" name="nombre" 
                               value="<?php if (isset($rol)) echo $rol->name; ?>"
                               type="text" required="required"> 
                        <span class="span_none" id="nombre-error">Ingrese Nombre </span>
                    </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group" id="grupo-div">
                   <label class="control-label">Grupo (*):</label>
                    <select class="form-control requerido"  data-toggle="tooltip" id="grupo"  name="grupo">
                            <option value="">-- Seleccionar --</option>
                            <?php foreach ($grupos as $grupo): ?>                                                                        
                                <option value="<?php echo $grupo->id_grupo ?>"    
                                        <?php if (isset($id_grupo) && $id_grupo == $grupo->id_grupo) echo 'selected="selected"'; ?>>
                                    <?php echo $grupo->nombre ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block" id="grupo-error"> Seleccione Grupo</span>
                  </div>
                </div>
            </div>

           
            <h3 class="form-section">Descripción</h3>
            <div class="row">

              
              <div class="col-md-12">
                <textarea class="form-control" name="descripcion" id="descripcion" 
                  
                ><?php if(isset($seccion)) echo $seccion->description; ?></textarea>
              </div>  
            </div>

            <br></br>


             <div id="div_message" class="custom-alerts alert alert-danger fade in">
                <div id="message_alert">
                </div> 
            </div>



            <!-- Acciones -->
            <div class="form-actions right">

              
                
                <a href="<?php echo base_url(); ?>seccion/" class="btn default"> Cerrar</a>
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
         }); //end Document Ready Function
              

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
