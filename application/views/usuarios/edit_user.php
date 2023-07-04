<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-file-text-o"></i><?php echo $subtitulo ?> </div>
    </div>

    
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
           

           <div class="form-body">                    
           <div class="row">
            <div class="col-md-3">
             <table class="table table-bordered table-striped">
             <tbody><tr>
             <td>DNI</td>
             <td>
             <div id="pulsate-once-target" style="padding:5px;"> 
              <strong><?php if (isset($usuario)) echo $usuario->dni; ?>
              </strong> 
             </div>
             </td>
             </tr>
             <tr>
             <td>
              Nombre y Apellido
              </td>
              <td>
               <div id="pulsate-once-target" style="padding:5px;"> 
               <strong><?php if (isset($usuario)) echo $usuario->nombre.",".$usuario->apellido; ?> </strong> 
               </div>
               </td>
              </tr>
              <tr>
              <td>
               Username
              </td>
              <td>
               <div id="pulsate-crazy-target" style="padding:5px;">
               <strong>
               <?php if(isset($usuario)) echo $usuario->username; ?>
               </strong>
               </div>
               </td>
               </tr>
              </tbody></table>
            </div>
           </div>
            

          <?php echo form_open_multipart('usuario/actualizarUsuario', ' id="formulario" class="horizontal-form"'); ?>
            <input type="hidden" name="id" id="id" value="<?php if (isset($usuario)) echo $usuario->id; ?>" />
            <input type="hidden" name="identity" id="identity" value="<?php if(isset($usuario)) echo $usuario->username; ?>">
           
           
         <div class="row">
           <div class="col-md-3">
                    <div class="form-group" id="passwordactual-div">
                        <label class="control-label">Contraseña Actual(*)</label>
                        <div class="input-group ">
                            <input type="password" class="form-control requerido" id="passwordactual"  name="passwordactual">
                        </div>
                        <span class="span_none" id="passwordactual-error">Ingrese contraseña actual </span>
                    </div>
                </div>
          </div>
          
         <h3>Cambiar Contraseña</h3>


         <div class="row">
           <div class="col-md-3">
                    <div class="form-group" id="password-div">
                        <label class="control-label">Contraseña(*)</label>
                        <div class="input-group ">
                            <input type="password" class="form-control requerido" id="password"  name="password">
                        </div>
                        <span class="span_none" id="password-error">Ingrese contraseña </span>
                    </div>
                </div>
          </div>

          <div class="row">  
             <div class="col-md-3">
                    <div class="form-group" id="repetirpassword-div">
                        <label class="control-label">Repetir Contraseña(*)</label>
                        <div class="input-group ">
                            <input type="password" class="form-control requerido" id="repetirpassword"  name="repetirpassword">
                        </div>
                        <span class="span_none" id="repetirpassword-error">Ingrese contraseña </span>
                    </div>
                </div>

           </div>         

            </div>

            <div id="div_message_success" class="custom-alerts alert alert-info fade in">
              
                <div id="message_success">
                </div> 
            </div>
          
             <div id="div_message" class="custom-alerts alert alert-danger fade in">
                <div id="message_alert">
                </div> 
            </div>



            <!-- Acciones -->
            <div class="form-actions right">
                
                <a href="<?php echo base_url();?>infraccionvial" class="btn default"> Cerrar</a>
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
            $("#div_message_success").hide();
                 
            

                //Formulario Vial 
                $("#formulario").submit(function(eve){
                   eve.preventDefault();

                   console.log("formulario vial");

                   if(validarCreateView()){
                     
                      var data=new FormData(this);
                      //var form = document.getElementById('form-vial');
                      console.log("data : "+data);
                      //console.log("form : "+form);
                      //var formData = new FormData(form);
                      console.log("formData : "+JSON.stringify(data));
                      $.ajax({
                       type: "POST",
                       url: '<?php echo base_url(); ?>usuario/actualizarPassword',
                       data: data,
                       cache: false,
                       contentType: false,
                       processData: false,
                       dataType: "JSON",
                       success: function (data) {
                          if (data.status == 'OK') {
                              $("#div_message").hide();
                              $("#div_message_success").show();
                              $("#message_success").empty();
                              $("#message_success").append(data.mensage);
                           } else {
                             $("#div_message_success").hide();
                             $("#div_message").show();
                             $("#message_alert").empty();
                             $("#message_alert").append(data.mensage);
                             
                          }
                        },
                         error: function (data) {
                          alert("Error => ",data);
                        }
                    });  

                   }
                });
         }); //end Document Ready Function
              
           //Funcion que permite verificar si 
         //el dni es correcto y valida si tiene leyes 
         //asociadas
         function validarCreateView(){
         
            var msg="";

            var bandForm=true;
            var bandIguales = true;
            var bandCuilInvolucrado=true;
            var bandCuilPropietario=true;
            var bandCantidad=true;
            var password=$("#password").val();
            var repetirpassword=$("#repetirpassword").val();

            if(validarForm('#formulario')){
                console.log("validar Form");
                bandForm=true;
            }else{
                 msg=msg + "<strong>Debe Completar los campos requeridos.</strong>";
                 bandForm=false;
            }

           
            if(bandForm){
               if(password === repetirpassword){
                 return true;
               }else{
                msg = msg + "<strong>Las contraseñas no son iguales";
                $("#div_message").show();
                $("#message_alert").empty();
                $("#message_alert").append(msg);
                return false;
               }
            }else{
               
                $("#div_message").show();
                $("#message_alert").empty();
                $("#message_alert").append(msg);
                return false;
            }
             
         } 


       
        </script>
    </div>
