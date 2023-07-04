          <?php 
             $tipoPersona = '';
             if( isset($infraccion) && ( $infraccion->tipo_persona == 'PF' || $infraccion->tipo_persona == 'PE'))  {
                  $tipoPersona = '';   
             } else {
                  $tipoPersona = 'none';
             }
             ?>

          <div id="section_persona_fisica" style="display: <?php echo $tipoPersona;?>" class="section">
            <hr/>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="dni">Dni(*):</label>
                        <div class="form-inline">
                              

                                    
                                <input class="form-control" id="cuilPropietario" name="propietario" type="text" 
                                  value="<?php if (isset($propietario) && isset($propietario->cuil)) echo $propietario->cuil; ?>" type="number" readonly="true" >
                                  
                                <?php if(!isset($propietario)) { ?>
                                     
                                    <button type="button" id="btnBuscarPropietarioNuevo" data-button="Involucrado" 
                                    onclick=module_buscar_persona.showModalBuscar('Propietario','Nuevo') class="btn blue"
                                    >
                                    Agregar <i class="fa fa-search"></i>
                                   </button>
                                    <button type="button" id="btnBorrarPropietarioNuevo" onclick="borraDataPersona('Propietario','Nuevo')" data-button="Involucrado" class="btn blue hide">
                                        Borrar<i class="fa fa-trash"></i>
                                    </button>
                                <?php }else{ ?>
                                
                                    <button type="button" id="btnBuscarPropietarioEditar" data-button="Involucrado" onclick=module_buscar_persona.showModalBuscar('Propietario','Editar') class="btn blue hide">
                                     Agregar <i class="fa fa-search"></i>
                                    </button>
                                
                                     <button type="button" id="btnBorrarPropietarioEditar" onclick="borraDataPersona('Propietario','Editar')" data-button="Involucrado" class="btn blue">
                                        Borrar<i class="fa fa-trash"></i>
                                    </button>
                                

                                <?php } ?>
                            </div> 
                           

                    </div>
                </div>
                  <div class="col-md-3">
                    <div class="form-group">
                     <div class="form-inline" style="margin-top: 30px">
                     <input type="hidden" name="idPropietario" value="<?php if( isset($propietario) && isset($propietario->id)) echo $propietario->id ?>">
                     <?php 
                              if ( isset($infraccion) && $infraccion->persona_establecer_propietario == '1' ) 
                                        echo "<label class='btn default btn-xs red'  id='personaEstablecerPropietario'>PERSONA A ESTABLECER</label>
                                              <input type='hidden' name='personaEstablecerPropietarioValor' id='personaEstablecerPropietarioValor' value='1'>"; 
                              else
                                        echo "<label class='btn default btn-xs red' id='personaEstablecerPropietario'>
                                              <input type='hidden' name='personaEstablecerPropietarioValor' id='personaEstablecerPropietarioValor' value='0'>  
                                              </label>"; 


                      ?>
                  </div>  
                 </div>
               </div>
            </div>
            
   
  

            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_persona_propietario" data-toggle="tab"> Propietario </a>
                </li>
                <li>
                    <a href="#tab_propietario_domicilio" data-toggle="tab"> Domicilio</a>
                </li>
            </ul>
            <!-- tabs propietarios -->
            <div class="tab-content">
                <div class="tab-pane active" id="tab_persona_propietario">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nombre:</label>
                                <input class="form-control" id="nombrePropietario" name="nombrePropietario" type="text" 
                                       maxlength="100" 
                                       value="<?php if (isset($propietario)) echo $propietario->nombre; ?>" 
                                       <?php if(isset($infraccion) && $infraccion->persona_establecer_propietario == '1') echo ''; else  echo'readonly'?>
                                       placeholder="NOMBRE" >

                            </div>   
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Apellido:</label>
                                <input class="form-control"  id="apellidoPropietario"
                                       name="apellidoPropietario" maxlength="100"   
                                       value="<?php if (isset($propietario)) echo $propietario->apellido; ?>" 
                                       placeholder="Numero"  type="text" 
                                       <?php if(isset($infraccion) && $infraccion->persona_establecer_propietario == '1') echo ''; else  echo'readonly'?>
                                       > 
                            </div>   
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tipo Documento:</label>
                                <input class="form-control" id="tipoDocumentoPropietario"
                                       name="tipoDocumentoPropietario"  maxlength="10"
                                       placeholder="Numero"  type="text" 
                                       value="<?php if (isset($propietario)) echo $propietario->tipoDocumento; ?>"
                                        <?php if(isset($infraccion) && $infraccion->persona_establecer_propietario == '1') echo ''; else  echo'readonly'?>
                                        > 
                            </div>   
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nro:</label>
                                <input class="form-control" name="numeroDocumentoPropietario" 
                                       id="numeroDocumentoPropietario" placeholder="Numero"  type="number"
                                        maxlength="12" 
                                       value="<?php if (isset($propietario)) echo $propietario->dni; ?>"
                                        <?php if(isset($infraccion) && $infraccion->persona_establecer_propietario == '1') echo ''; else  echo'readonly'?> 
                                        > 
                            </div>   
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Fecha Nacimiento:</label>
                                <input type="date" class="form-control"  id="fechaNacimientoPropietario"
                                       name="fechaNacimientoPropietario" maxlength="100"  
                                       placeholder="Fecha Nacimiento" type="text" value="<?php if (isset($propietario)) echo $propietario->fechaNacimiento; ?>"
                                        <?php if(isset($infraccion) && $infraccion->persona_establecer_propietario == '1') echo ''; else  echo'readonly'?>
                                        > 
                            </div>   
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nacionalidad:</label>
                                <input class="form-control"  id="nacionalidadPropietario" 
                                       name="nacionalidadPropietario"  maxlength="100"
                                       placeholder="Nacionalidad"  type="text" 
                                       value="<?php if (isset($propietario)) echo $propietario->nacionalidad; ?>"
                                       <?php if(isset($infraccion) && $infraccion->persona_establecer_propietario == '1') echo ''; else  echo'readonly'?>
                                         > 
                            </div>   
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Sexo:</label>
                                <input class="form-control"  id="sexoPropietario" 
                                       name="sexoPropietario" maxlength="10"
                                       placeholder="Sexo"  type="text" 
                                       value="<?php if (isset($propietario)) echo $propietario->sexo; ?>"
                                       <?php if(isset($infraccion) && $infraccion->persona_establecer_propietario == '1') echo ''; else  echo'readonly'?>
                                         > 
                            </div>   
                        </div>      

                    </div>
                </div>
                <div class="tab-pane" id="tab_propietario_domicilio">
                       <!-- panel de domicilios -->
                    <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                          Domicilios
                        </div>
                        <div class="actions">

                        <?php if(isset($propietario)) :?>
                        <button type="button" id="btnAddDomicilioPropietario" onclick="moduleDomicilioModal.addDomicilio('Propietario');" class="btn btn-default btn-sm"
                        >
                         <i class="fa fa-plus"></i> Agregar
                         </button>
                        <?php endif;?>

                        <?php if(empty($propietario)) :?>
                        <button type="button" id="btnAddDomicilioPropietario" onclick="moduleDomicilioModal.addDomicilio('Propietario');" class="btn btn-default btn-sm"
                         disabled="false">
                         <i class="fa fa-plus"></i> Agregar
                         </button>
                        <?php endif;?>


                        

                        </div>
                    </div>
                    <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" 
                           id="tableDomicilioPropietario">
                       <thead>
                            <tr>
                                <th width="45%">Actual</th>
                                <th>Domicilio </th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyDomicilioPropietario">
                             <?php 
                              if($domiciliosPropietario!=null && $domiciliosPropietario!=""):
                              echo $domiciliosPropietario;
                              endif; 
                              ?>  
                        </tbody>
                    </table>
                  </div>
                 </div>
             </div>

           </div>
         </div>
            