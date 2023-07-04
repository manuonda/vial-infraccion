
  <?php echo form_open_multipart('configuraciones/guardar', ' id="formulario" class="horizontal-form"'); ?>
 <div class="row"> 
 <div class="col-md-12">
 <!-- BEGIN EXAMPLE TABLE PORTLET-->
 <div class="portlet light bordered">
 <div class="portlet-title">
 <div class="caption font-dark">
 <i class="icon-settings font-dark"></i>
 <span class="caption-subject bold uppercase"> Configuracion de Valores </span>
 </div>
 </div>
 
<?php  if($this->session->flashdata('message')) { ?>
<div class="row">
 <div class="col-md-3">
 <div class="alert alert-info">
  
    <strong>
     <?php  echo $this->session->flashdata('message'); ?>
     </strong> 
    </div>
 </div>
</div>

    
 <?php } ?>

 <div class="portlet-body">
  <input type="hidden" name="id" id="id" value="<?php if (isset($configuracion)) echo $configuracion->id_configuracion; ?>" />
        

    
 <div class="row">
 <div class="col-md-3">
 <div class="form-group" id="numero_acta-div">
 <label class="control-label">VALOR UNIDAD FIJA (*)</label>
 <input class="form-control requerido" id="valor" type="text" name="valor"
        oninput="moduleConfiguracion.validateNumber(this)"
        value="<?php if (isset($configuracion)) echo $configuracion->valor; ?> "> 
 <span class="span_none" id="numero_acta-error">Ingrese Valor Unidad Fija</span>    
 </div>
 </div>

   <div class="col-md-3">
                    <label class="control-label">Serie</label>
                    <input class="form-control" placeholder="" type="text" name="serie"
                           value="<?php if (isset($configuracion)) echo $configuracion->serie; ?>"/>
                </div> 
 </div>
 

<!-- Acciones -->
<div class="form-actions right">
<button type="submit" class="btn green">
<i class="fa fa-save"></i> Guardar
</button>
</div>
 </div>
 </div>
 </div>
</div>
 </form>
          

                     
     