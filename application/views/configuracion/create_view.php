<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-file-text-o"></i><?php echo $subtitulo ?> </div>
    </div>

    
    <div class="portlet-body form">
        <!-- BEGIN FORM-->

         <?php if(isset($message)) {
              echo $message
         } ?>

        <?php echo form_open_multipart('configuraciones/guardar', ' id="formulario" class="horizontal-form"'); ?>
           <div class="form-body">                    
            <h3 class="form-section">Valores Globales</h3>

            <input type="hidden" name="id" id="id" value="<?php if (isset($configuracion)) echo $configuracion->id_configuracion; ?>" />
        
          
            <div class="row">
               <div class="col-md-3">
                    <label class="control-label">Valor UF</label>
                    <input class="form-control" placeholder="0.00" type="text" name="valor"
                           value="<?php if (isset($configuracion)) echo $configuracion->valor; ?>"/>
                </div>
                 
                 <div class="col-md-3">
                    <label class="control-label">Serie</label>
                    <input class="form-control" placeholder="0.00" type="text" name="valor"
                           value="<?php if (isset($configuracion)) echo $configuracion->serie; ?>"/>
                </div> 
            
            </div>


            <!-- Acciones -->
            <div class="form-actions right">
                
                <a href="<?php echo base_url();?>inicio" class="btn default"> Cerrar</a>
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



    </div>
