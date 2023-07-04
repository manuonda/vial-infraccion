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
                    <input class="form-control" placeholder="Nombre" type="text" name="seccion"
                           value="<?php if (isset($funcion)) echo $funcion->nombre; ?>"/>
                </div>

                <div class="col-md-3">
                    <label class="control-label">Descripcion</label>
                    <input class="form-control" placeholder="Descripcion" type="text" name="descripcion"
                           value="<?php if (isset($funcion)) echo $funcion->descripcion; ?>"/>
                </div>

            </div>

          
             <div id="div_message" class="custom-alerts alert alert-danger fade in">
                <div id="message_alert">
                </div> 
            </div>



            <!-- Acciones -->
            <div class="form-actions right">

                <?php if(isset($id)): ?>
                 <a data-toggle="modal" href="#modal_archivar_expediente" class="btn purple"> 
                    <i class="fa fa-save"></i>
                    Archivar
                 </a>
                <?php endif;?>
                
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

            <!-- modal correspondiente archiva observacion -->
             
             <div id="modal_archivar_expediente" class="modal fade" tabindex="-1" data-width="860">    
             <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
             <h4 class="modal-title">Archivar Expediente</h4>
             </div>
             <div class="modal-body"> 
             <h3>Observación</h3>
             <div class="row">
                <div class="col-md-12">
                    <textarea class="form-control" value="" rows="5" id="observacionEstado"></textarea>
                </div>
             </div>
             </div>
             <div class="modal-footer">
             <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cerrar</button>
             <button type="button" id="btnArchivarContravencion" class="btn green">Guardar</button>
             </div>
             </div>
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
