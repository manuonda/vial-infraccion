        <?php 
             $tipoPersona = '';
             if( isset($infraccion) && $infraccion->tipo_persona == 'PJ')  {
                  $tipoPersona = '';   
             } else {
                  $tipoPersona = 'none';
             }
        ?> 
       
        <div id="section_persona_juridica" style="display: <?php echo $tipoPersona;?>" class="section">
        


            

            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_persona_juridica" data-toggle="tab"> Persona Juridica </a>
                </li>
            </ul>
            <!-- tabs propietarios -->
            <div class="tab-content">
                <div class="tab-pane active" id="tab_persona_juridica">
                <div class="tab-pane active" id="tab_comercio_involucrado">
                 <h5 class="caption-subject bold uppercase sub-titulo">
                    Informacion
                 </h5>
                 <div class="row">
                
                <div class="col-md-3 ">
                <div class="form-group" id="cuitComercio">
                    <label class="control-label">CUIT(*):</label>
                    <input id="cuitPersonaJuridica" class="form-control" placeholder="CUIT" type="text" name="cuitPersonaJuridica" 
                     value="<?php if (isset($personaJuridica)) echo $personaJuridica->cuit; ?>"
                    >
                </div>
                </div>

                 <div class="col-md-3">
                 <div class="form-group">
                 <label class="control-label">Nombre(*):</label>
                 <input class="form-control" id="nombrePersonaJuridica" name="nombrePersonaJuridica" type="text" 
                        value="<?php if (isset($personaJuridica)) echo $personaJuridica->nombre; ?>"
                        placeholder="NOMBRE" >
                 </div>           
                 </div>
        </div>    
                                                                        
         <h3>Direccion</h3> 
            <div class="row">
            <div class="col-md-12">
                <textarea class="form-control" name="direccionPersonaJuridica" id="direccionPersonaJuridica" >
                  <?php if(isset($personaJuridica)) echo $personaJuridica->direccion; ?></textarea>
              </div>  
            </div>      
         
       </div>
    </div>
  </div>
  </div>

    <script type="text/javascript">
        var module_persona_juridica = (function() {
           
           var selectDepartamento = function() {
                 id_departamento = document.getElementById('departamentoPersonaJuridica').value;
                    if (id_departamento === '')
                        return false;
                    resetaCombo('localidadPersonaJuridica');

                    $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_localidad/' + id_departamento, function (data) {

                        
                        var option = new Array();
                        $.each(data, function (i, obj) {
                            option[i] = document.createElement('option');
                            $(option[i]).attr({value: obj.id_localidad});
                            $(option[i]).append(obj.localidad);

                            $("select[name=localidadPersonaJuridica]").append(option[i]);
                        });
                    });
           }

           var selectLocalidad = function() {
               id_localidad = document.getElementById('localidadPersonaJuridica').value;
                    if (id_localidad === '')
                        return false;

                    resetaCombo('barrioPersonaJuridica');

                    $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_barrio/' + id_localidad, function (data) {
                        var option = new Array();
                        $.each(data, function (i, obj) {
                            option[i] = document.createElement('option');
                            $(option[i]).attr({value: obj.id_barrio});
                            $(option[i]).append(obj.barrio);

                            $("select[name=barrioPersonaJuridica]").append(option[i]);
                        });
                    });
           }

           var selectBarrio = function () {
              id_barrio = document.getElementById('barrioPersonaJuridica').value;
                    if (id_barrio === '')
                        return false;

                    resetaCombo('callePersonaJuridica');

                    $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_calle/' + id_barrio, function (data) {
                        var option = new Array();
                        $.each(data, function (i, obj) {
                            option[i] = document.createElement('option');
                            $(option[i]).attr({value: obj.id_calle});
                            $(option[i]).append(obj.calle);

                            $("select[name=callePersonaJuridica]").append(option[i]);
                        });
                    });
           }

           return {
             selectDepartamento : selectDepartamento,
             selectLocalidad : selectLocalidad,
             selectBarrio: selectBarrio
            }



        }());

    </script>
            