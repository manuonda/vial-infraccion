<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-file-text-o"></i><?php echo $subtitulo ?> </div>
    </div>

    
    <div class="portlet-body form">
        <!-- BEGIN FORM-->

        <?php echo form_open_multipart('funciones/guardar', ' id="formulario" class="horizontal-form"'); ?>
           <div class="form-body">                    
            <h3 class="form-section">Función</h3>

            <input type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $id; ?>" />
        
            

            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">Nombre</label>
                    <input class="form-control" placeholder="Nombre" type="text" name="nombre"
                           value="<?php if (isset($usuario)) echo $usuario->first_name; ?>"/>
                </div>

                <div class="col-md-3">
                    <label class="control-label">Apellido</label>
                    <input class="form-control" placeholder="Apellido" type="text" name="apellido"
                           value="<?php if (isset($usuario)) echo $usuario->last_name; ?>"/>
                </div>

            </div>

            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">Username</label>
                    <input class="form-control" placeholder="Usuario del sistema" type="text" name="username"
                           value="<?php if (isset($usuario)) echo $usuario->username; ?>"/>
                </div>

                <div class="col-md-3">
                    <label class="control-label">Contraseña</label>
                    <input class="form-control" placeholder="Contraseña" type="text" name="password"
                           value="<?php if (isset($usuario)) echo $usuario->password; ?>"/>
                </div>

                <div class="col-md-3">
                    <label class="control-label">Contraseña</label>
                    <input class="form-control" placeholder="Contraseña" type="text" name="password"
                           value="<?php if (isset($usuario)) echo $usuario->password; ?>"/>
                </div>

            </div>

          
             <div id="div_message" class="custom-alerts alert alert-danger fade in">
                <div id="message_alert">
                </div> 
            </div>



            <!-- Acciones -->
            <div class="form-actions right">
                
                <a href="<?php echo base_url();?>usuario/" class="btn default"> Cerrar</a>
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
           
           
             <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
             </div>
             <!-- /.modal -->
            <!-- end modal -->
        </div>





        <script type="text/javascript">
        //Para realizar la validacion del Cuil ingresado es correcto 
        var cuilInfractorEncontrado=false;
        //Si ingreso alguna para habilitar
        var cantLey=0;

        $(document).ready(function (){
              
            $("#div_message").hide();    
                 
            

                //Formulario Vial 
                $("#formulario").submit(function(eve){
                   eve.preventDefault();

                   console.log("formulario vial");

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
              


       
        </script>
    </div>
