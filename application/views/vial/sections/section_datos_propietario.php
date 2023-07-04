<!--  end tabs-->  
            <!-- end datos del Propietario-->
            <h3> Datos Propietario </h3> 
            <hr/>
            <h4> Tipo Persona</h4>

            <?php 
             $tipoPersonaFisica = '';
             $tipoPersonaJuridica = ''; 
             if( isset($infraccion) &&  ( $infraccion->tipo_persona == 'PF' || $infraccion->tipo_persona == 'PE')) {
                  $tipoPersonaFisica = 'checked';   
             } else {
                  $tipoPersonaFisica = '';
             }

             if( isset($infraccion) && $infraccion->tipo_persona == 'PJ') {
                $tipoPersonaJuridica ='checked';
             }

             ?>
            <div class="row">
                <div class="col-md-3">
                <div class="radio">
                <label>
                <input type="radio" name="tipo_persona" value="PF"   onclick="module_infraccion_vial.mostrarSection('PF')"
                 <?php echo $tipoPersonaFisica;?>>
                 Persona Fisica
                </label>
                </div>
                </div>   
                <div class="col-md-3">
                <div class="radio">
                <label>
                <input type="radio" name="tipo_persona" value="PJ" onclick="module_infraccion_vial.mostrarSection('PJ')" 
                 <?php echo $tipoPersonaJuridica;?> >
                Persona Juridica
                </label>
                </div>
                </div>
            </div>    

              
            <!-- modal correspondiente archiva observacion -->
            <?php $this->load->view('vial/sections/section_persona_fisica');?>

             <!-- modal correspondiente archiva observacion -->
            <?php $this->load->view('vial/sections/section_persona_juridica');?>  