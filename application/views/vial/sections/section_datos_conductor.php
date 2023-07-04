<!-- Datos del propietario -->
            <h3 class="form-section">Datos del Conductor</h3>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group" id="cuilInvolucrado-div">
                        <label for="dni">Dni(*):</label>
                         <div class="form-inline">
                              
                                <input class="form-control" id="cuilInvolucrado" name="involucrado" type="text" 
                                  value="<?php if (isset($involucrado) &&  isset($involucrado->cuil)) echo $involucrado->cuil; ?>" type="number" readonly="true" >
                            

                                <?php if(!isset($involucrado)) { ?>
                                <button type="button" id="btnBuscarInvolucradoNuevo" data-button="Involucrado" onclick=module_buscar_persona.showModalBuscar('Involucrado','Nuevo') class="btn blue">
                                    Agregar <i class="fa fa-search"></i>
                                </button>
                                
                                 <button type="button" id="btnBorrarInvolucradoNuevo" onclick="borraDataPersona('Involucrado','Nuevo')" data-button="Involucrado" class="btn blue hide">
                                  Borrar<i class="fa fa-trash"></i>
                                 </button> 

                                <?php }else{ ?>
                                 <button type="button" id="btnBuscarInvolucradoEditar" data-button="Involucrado" 
                                 onclick=module_buscar_persona.showModalBuscar('Involucrado','Editar') class="btn blue hide">
                                Agregar <i class="fa fa-search"></i>
                                </button>
                                
                                 <button type="button" id="btnBorrarInvolucradoEditar" onclick="borraDataPersona('Involucrado','Editar')" data-button="Involucrado" class="btn blue">
                                  Borrar<i class="fa fa-trash"></i>
                                 </button>
                                

                                <?php } ?>
                            </div>
                        <span class="span_none" id="cuilInfractor-error">Ingrese Cuil Conductor</span>
                    </div>
                </div>
                   <div class="col-md-3">
                    <div class="form-group">
                     <div class="form-inline" style="margin-top: 30px;">
                     <input type="hidden" name="idInvolucrado" value="<?php if( isset($involucrado) && isset($involucrado->id)) echo $involucrado->id ?>">
                   
                    <?php 
                        
                       if ( isset($infraccion) && $infraccion->persona_establecer_involucrado == '1' ) 
                                        echo "<label class='btn default btn-xs red' id='personaEstablecerInvolucrado'>PERSONA ESTABLECIDA</label>
                                             <input type='hidden' name='personaEstablecerInvolucradoValor' id='personaEstablecerInvolucradoValor' value='1'>";
                                     else
                                        echo "<label  class='btn default btn-xs red' id='personaEstablecerInvolucrado'></label>
                                              <input type='hidden' name='personaEstablecerInvolucradoValor' id='personaEstablecerInvolucradoValor' value='0'>"; 
                   ?>
                   </div>   
                 </div>  
                </div>
             
            </div>

            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_persona_involucrado" data-toggle="tab"> Datos Personales </a>
                </li>
                <li>
                    <a href="#tab_involucrado_domicilio" data-toggle="tab"> Domicilio</a>
                </li>
            </ul>
           

            <!-- tabs propietarios -->
            <div class="tab-content">
                <div class="tab-pane active" id="tab_persona_involucrado">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" id="nombreInvolucrado-div">
                                <label class="control-label">Nombre:</label>
                                <input class="form-control requerido"  id="nombreInvolucrado" name="nombreInvolucrado" type="text" 
                                       maxlength="100"
                                       value="<?php if (isset($involucrado)) echo $involucrado->nombre;echo ''; ?>" 
                                       <?php if(isset($infraccion) && $infraccion->persona_establecer_involucrado == '1') echo ''; else  echo'readonly'?>
                                       placeholder="NOMBRE" >
                                <span class="span_none" id="nombreInvolucrado-error">Ingrese Nombre</span>   

                            </div>   
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" id="apellidoInvolucrado-div">
                                <label class="control-label">Apellido:</label>
                                <input class="form-control requerido"  id="apellidoInvolucrado" 
                                       name="apellidoInvolucrado" maxlength="100"
                                       value="<?php if (isset($involucrado)) echo $involucrado->apellido; ?>" 
                                       placeholder="Numero"  type="text" 
                                        <?php if(isset($infraccion) && $infraccion->persona_establecer_involucrado == '1') echo ''; else  echo'readonly'?>
                                       > 
                                    <span class="span_none" id="apellidoInvolucrado-error">Ingrese Apellido</span>   
                            </div>   
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tipo Documento:</label>
                                <input class="form-control" id="tipoDocumentoInvolucrado" 
                                       name="tipoDocumentoInvolucrado"
                                       maxlength="10"
                                       placeholder="Numero"  type="text" 
                                       value="<?php if (isset($involucrado)) echo $involucrado->tipoDocumento; ?>"
                                        <?php if(isset($infraccion) && $infraccion->persona_establecer_involucrado == '1') echo ''; else  echo'readonly'?>
                                       > 
                            </div>   
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" id="numeroDocumentoInvolucrado-div">
                                <label class="control-label">Nro:</label>
                                <input class="form-control requerido" name="numeroDocumentoInvolucrado" 
                                       id="numeroDocumentoInvolucrado"  placeholder="Numero"  type="text" 
                                       maxlength="11" max="11"
                                       value="<?php if (isset($involucrado)) echo $involucrado->dni; ?>"
                                        <?php if(isset($infraccion) && $infraccion->persona_establecer_involucrado == '1') echo ''; else  echo'readonly'?>> 
                                 <span class="span_none" id="numeroDocumentoInvolucrado-error">Ingrese Documento</span> 
                            </div>   
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" id="fechaNacimientoInvolucrado-div">
                                <label class="control-label">Fecha Nacimiento:</label>
                                <input type="date" class="form-control requerido"  id="fechaNacimientoInvolucrado" 
                                        name="fechaNacimientoInvolucrado"   
                                        placeholder="Fecha Nacimiento" type="text" value="<?php if (isset($involucrado)) echo $involucrado->fechaNacimiento; ?>"
                                        <?php if(isset($infraccion) && $infraccion->persona_establecer_involucrado == '1') echo ''; else  echo'readonly'?>
                                       >
                                <span class="span_none" id="fechaNacimientoInvolucrado-error">Ingrese Fecha Nacimiento</span>  
                            </div>   
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" id="nacionalidadInvolucrado-div">
                                <label class="control-label">Nacionalidad:</label>
                                <input class="form-control requerido"  id="nacionalidadInvolucrado" 
                                       name="nacionalidadInvolucrado" 
                                       maxlength="100"
                                       placeholder="Nacionalidad"  type="text" 
                                       value="<?php if (isset($involucrado)) echo $involucrado->nacionalidad; ?>"
                                        <?php if(isset($infraccion) && $infraccion->persona_establecer_involucrado == '1') echo ''; else  echo'readonly'?>
                                       > 
                                 <span class="span_none" id="nacionalidadInvolucrado-error">Ingrese Nacionalidad</span>  
                            </div>   
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" id="sexoInvolucrado-div">
                                <label class="control-label">Sexo:</label>
                                <input class="form-control requerido"  
                                       name="sexoInvolucrado"
                                       maxlength="10" 
                                       id="sexoInvolucrado" placeholder="Sexo"  type="text" 
                                       value="<?php if (isset($involucrado)) echo $involucrado->sexo; ?>"
                                        <?php if(isset($infraccion) && $infraccion->persona_establecer_involucrado == '1') echo ''; else  echo'readonly'?>
                                       > 
                                  <span class="span_none" id="sexoInvolucrado-error">Ingrese Sexo</span>  
                            </div>   
                        </div>      

                    </div>
                </div>
                <div class="tab-pane" id="tab_involucrado_domicilio">
                    
                    <!-- panel de domicilios -->
                    <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                          Domicilios
                        </div>
                        <div class="actions">

                        <?php if(isset($involucrado)) :?>
                        <button type="button" id="btnAddDomicilioInvolucrado" onclick="moduleDomicilioModal.addDomicilio('Involucrado');" class="btn btn-default btn-sm"> 
                         <i class="fa fa-plus"></i> Agregar</button>
                         <?php endif; ?>
                         
                          <?php if(empty($involucrado)) :?>
                          <button type="button" id="btnAddDomicilioInvolucrado" onclick="moduleDomicilioModal.addDomicilio('Involucrado');" class="btn btn-default btn-sm"
                          disabled="false"><i class="fa fa-plus"></i> Agregar</button>
                         <?php endif; ?>
                       
                            
                         </div>
                    </div>
                    <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" 
                           id="tableDomicilioInvolucrado">
                        <thead>
                            <tr>
                                <th width="45%">Actual</th>
                                <th>Domicilio </th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyDomicilioInvolucrado">
                            <?php 
                              if($domiciliosInvolucrado!=null && $domiciliosInvolucrado!=""):
                                echo $domiciliosInvolucrado;
                               endif;
                            ?>  
                        </tbody>

                    </table>
                    </div>
                   </div>
                   <!-- end domicilios -->


                </div>
            </div> 