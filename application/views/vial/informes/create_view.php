<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-file-text-o"></i><?php echo $subtitulo ?></div>
    </div>

    
    <div class="portlet-body form">
        <!-- BEGIN FORM-->

        <?php echo form_open_multipart('/informes/guardar', ' id="form" class="horizontal-form"'); ?>
        <div class="form-body">                    
            <h3 class="form-section"></h3>

            <input type="hidden" name="id" id="id" value="<?php if (isset($informe)) echo $informe->id_informe; ?>" />
            <input type="hidden" name="idInfraccion" value="<?php if(isset($idInfraccion)) echo $idInfraccion;?>" />
            

            <div class="row">
               
                <div class="col-md-3">
                    <div class="form-group" id="numero_acta-div">
                        <label class="control-label">Descripción(*)</label>
                        <input class="form-control requerido" placeholder="Nombre" id="numero_acta" type="text" name="descripcion"
                               value="<?php if (isset($informe)) echo $informe->descripcion; ?> "> 
                    <span class="span_none" id="numero_acta-error">Ingrese Descripción</span>    
                    </div>
                </div>

                 <div class="col-md-3">
                    <div class="form-group" id="fecha_hecho-div">    
                        <label class="control-label">Fecha Alta(*)</label>   
                        <div class="input-group" >
                             <input type="date" class="form-control requerido" id="fecha_ingreso"  name="fecha_ingreso"
                                   value="<?php  if(isset($informe)) echo date('Y-m-d',strtotime($informe->fecha_ingreso)); ?>">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                        <span class="span_none" id="fecha_hecho-error">Ingrese fecha de Alta</span>

                    </div>
                </div>
            </div>

          

            <!-- Lugar del hecho  -->
            <h3 class="form-section">Descripción</h3>
            
            <div class="row">
               <div class="col-md-10">
                 <div name="texto" id="summernote">
                  <?php if(isset($informe)) echo $informe->texto; ?> 
                 </div>
               </div>
            </div>

             <div id="div_message" class="custom-alerts alert alert-danger fade in">
                <div id="message_alert">
                </div> 
            </div>



            <!-- Acciones -->
            <div class="form-actions right">
 
                <a  href="<?php echo base_url().'informes/index/'.$idInfraccion?>" class="btn default"> Cerrar</a>
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
        var cuilPropietarioEncontrado=false;

        //Si ingreso alguna para habilitar
        var cantLey=0;

        $(document).ready(function (){
              
            $("#div_message").hide();    
           
               
                $("#form").submit(function(eve){
                   eve.preventDefault();

                    
                   if(validarForm('#form-vial')){
          
                      var data=new FormData(this);
                      data.append("texto",$("#summernote").summernote('code'));
                     
                      $.ajax({
                       type: "POST",
                       url: '<?php echo base_url(); ?>informes/guardar',
                       data: data,
                       cache: false,
                       contentType: false,
                       processData: false,
                       dataType: "JSON",
                       success: function (data) {
                          if (data.status == 'OK') {
                              window.location="<?php echo base_url();?>"+data.url;
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
         }); 
        </script>

    </div>
