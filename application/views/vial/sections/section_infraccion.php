 <h3 class="form-section">Infracción</h3>

            <div class="row">
    
                <!--span -->
                <div class="col-md-3">
                    <div class="form-group" id="fecha_ingreso-div">
                        <label class="control-label">Fecha de Ingreso(*)</label>
                        <div class="input-group ">
                            <input type="date" class="form-control requerido" id="fecha_ingreso"  name="fecha_ingreso"
                                   value="<?php  if(isset($infraccion)) echo date('Y-m-d',strtotime($infraccion->fecha_ingreso)); ?>">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                        <span class="span_none" id="fecha_ingreso-error">Ingrese Fecha de Ingreso </span>
                    </div>
                </div>
                
                <div class="col-md-3">
                <div class="form-group" >  
                <label class="control-label">Serie</label>
                <input type="text" class="form-control requerido"  name="serie" readonly="true"
                    value="<?php  if(isset($infraccion)) echo $infraccion->serie; else echo $configuracion->serie; ?>">
                </div>
                </div>    
 

               <div class="col-md-3">
                    <div class="form-group" id="numero_acta-div">
                        <label class="control-label">Nro. de Acta de Comprobación(*)</label>
                        <input class="form-control requerido" placeholder="Numero de Acta" id="numero_acta" name="numero_acta" 
                               value="<?php if (isset($numero_acta)) echo $numero_acta; ?> " 
                                <?php if($edicion == false) echo 'readonly'; ?>> 
                    <span class="span_none" id="numero_acta-error">Ingrese número de Acta</span>    
                    </div>
                </div>
            </div>

          

            <!-- Lugar del hecho  -->
            <h3 class="form-section">Lugar del Hecho </h3>


            <!--/row-->
            <div class="row ">
                <div class="col-md-3">
                    <div class="form-group" id="fecha_hecho-div">    
                        <label class="control-label">Fecha(*)</label>   
                        <div class="input-group  " data-date-format="dd-mm-yyyy" >
                            <input type="date" class="form-control requerido" id="fecha_hecho" name="fecha_hecho"
                                   value="<?php if (isset($infraccion)) echo $infraccion->fecha_hecho ?>">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                        <span class="span_none" id="fecha_hecho-error">Ingrese fecha de Hecho </span>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"  id="hora_hecho-div">
                        <label class="control-label">Hora(*)</label>
                        <div class="input-group">
                            <input type="time" class="form-control requerido timepicker timepicker-24" id="hora_hecho" name="hora_hecho"
                                   value="<?php if (isset($infraccion->hora_hecho)) echo $infraccion->hora_hecho; ?>"
                                   >
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-clock-o"></i>
                                </button>
                            </span>
                        </div>
                         <span class="span_none" id="hora_hecho-error">Ingrese Hora de Hecho </span>


                    </div>
                </div>
            </div>

             <div class="row">
                   <div class="col-md-3 ">
                    <div class="form-group" id="departamento-div">
                        <label class="control-label">Provincia</label>
                        <div class=" input-group bootstrap-touchspin">
                        <select class="form-control select2"  data-toggle="tooltip" id="provincia"  name="provincia">
                            <option value="">-- Seleccionar --</option>
                            <?php foreach ($provincias as $provincia): ?>                                                                        
                                <option value="<?php echo $provincia->id_provincia ?>"    
                                        <?php if (isset($infraccion) && $infraccion->id_provincia == $provincia->id_provincia) echo 'selected="selected"'; ?>>
                                    <?php echo $provincia->provincia; ?></option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                        <span class="help-block" id="departamento-error"> Seleccione Departamento </span>
                    </div>
                </div>
                  <div class="col-md-3 ">
                    <div class="form-group" id="departamento-div">
                        <label class="control-label">Departamento</label>
                        <div class=" input-group bootstrap-touchspin">
                        <select class="form-control select2"  data-toggle="tooltip" id="departamento"  name="departamento">
                            <option value="">-- Seleccionar --</option>
                            <?php 
                             if($departamentos!=null){   
                             foreach ($departamentos as $departamento): ?>                                                                        
                                <option value="<?php echo $departamento->id_departamento ?>"    
                                        <?php if (isset($infraccion) && $infraccion->id_departamento == $departamento->id_departamento) echo 'selected="selected"'; ?>>
                                    <?php echo $departamento->depto ?></option>
                              <?php endforeach; 
                            } 
                            ?>
                        </select>
                        </div>
                        <span class="help-block" id="departamento-error"> Seleccione Departamento </span>
                    </div>
                </div>

                <!-- localidad -->
                <div class="col-md-3 ">
                    <div class="form-group" id="localidad-div">
                        <label class="control-label">Localidad</label>
                         <div class=" input-group bootstrap-touchspin">
                        <select class="form-control select2"  data-toggle="tooltip"  id="localidad" name="localidad">
                            <option value="">-- Seleccionar --</option>
                            <?php 
                            if ($localidades!=null){  
                            foreach ($localidades as $localidad): ?>                                                                        
                                <option value="<?php echo $localidad->id_localidad ?>"    
                                        <?php if (isset($infraccion) && $infraccion->id_localidad == $localidad->id_localidad) echo 'selected="selected"'; ?>>
                                    <?php echo $localidad->localidad ?></option>
                            <?php endforeach; 
                             }
                            ?>
                        </select>
                    </div>
                        <span class="help-block" id="localidad-error">Seleccione Localidad </span>
                    </div>
                </div>

                <!--/span-->
            </div>
              <div class="row">
                 
                <!-- destacamento -->
                <div class="col-md-3 ">
                    <div class="form-group" id="destacamento-div">
                        <label class="control-label">Destacamento </label>
                         <div class=" input-group bootstrap-touchspin">
                        <select class="form-control  select2-destacamento"  data-toggle="tooltip"  id="destacamento" name="destacamento">
                            <option value="">-- Seleccionar --</option>
                            <?php foreach ($destacamentos as $destacamento): ?>                                                                        
                                <option value="<?php echo $destacamento->id_destacamento ?>"    
                                        <?php if (isset($infraccion) && $infraccion->id_destacamento == $destacamento->id_destacamento) echo 'selected="selected"'; ?>>
                                    <?php echo $destacamento->nombre ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                        <span class="help-block" >Seleccione Destacamento </span>
                    </div>
                </div> 

                  <div class="col-md-6"> 
                  <div class="form-group"  id="hora_hecho-div">
                        <label class="control-label">Lugar </label>
                        <div class="input-group">
                          <textarea class="form-control" name="lugar_hecho" id="lugar_hecho" rows="4" cols="120">
                            <?php if(isset($infraccion)) echo $infraccion->lugar_hecho; ?></textarea>

                            
                         </div>
                    </div>
                </div>

              </div>
              
      <h3 class="form-section">Datos del Vehículo</h3>


            <div class="row">    
                <div class="col-md-3 ">
                    <div class="form-group" id="tipovehiculo-div">
                        <label class="control-label">Tipo Vehículo(*)</label>
                        <div class=" input-group bootstrap-touchspin">
                            <select class="form-control select2-tipovehiculo requerido" id="tipovehiculo" name="tipovehiculo">
                                <option value="">Seleccionar</option>
                                <?php foreach ($tipovehiculos as $tipovehiculo): ?>
                                    <option value="<?php echo $tipovehiculo->id_tipovehiculo ?>"    
                                            <?php if (isset($id_tipovehiculo) && $id_tipovehiculo == $tipovehiculo->id_tipovehiculo) echo 'selected="selected"'; ?>>
                                        <?php echo $tipovehiculo->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                      <span class="span_none" id="importe-error">Seleccione Tipo Vehículo </span>
                    </div>
                </div>

               


                <div class="col-md-3 ">
                    <div class="form-group" id="marca-div">
                        <label class="control-label">Marca(*)</label>
                        <div class=" input-group bootstrap-touchspin">
                            <select class="form-control select2-marca requerido"  id="marca" name="marca">
                               <option value="">Seleccionar</option>

                                <?php 
                                 if(isset($marcas) && $marcas!="")
                                 foreach ($marcas as $marca): ?>
                                    <option value="<?php echo $marca->id_marca; ?>"    
                                    <?php if (isset($id_marca) && $id_marca == $marca->id_marca) echo 'selected="selected"'; ?>>
                                            <?php echo $marca->nombre ?></option>
                                        <?php endforeach; ?>
                            </select>

                        </div>
                     <span class="span_none" id="marca-error">Seleccione Marca </span>
                    </div>
                </div>

                <div class="col-md-3 ">

                  

                    <div class="form-group" id="modelo-div">
                        <label class="control-label">Modelo(*)</label>
                        <div class=" input-group bootstrap-touchspin">
                            <select class="form-control select2-modelo requerido" id="modelo" name="modelo">
                                 <option value="">Seleccionar</option>
                                  <?php if(isset($modelos))
                                    foreach ($modelos as $modelo): ?>
                                    <option value="<?php echo $modelo->id_modelo ?>"    
                                    <?php if (isset($id_modelo) && $modelo->id_modelo==$id_modelo) echo 'selected="selected"'; ?>
                                    >
                                            <?php echo $modelo->nombre ?>
                                        
                                   </option>
                                   <?php endforeach; 
                                ?> 
                            </select>
                            
                        </div>
                        <span class="span_none" id="modelo-error"> Modelo</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group" id="dominio-div">
                        <label class="control-label">Dominio(*):</label>
                        <input class="form-control" onkeyup="module_util.changeToUpper(this)"   id="dominio" value="<?php if (isset($dominio)) echo $dominio; ?>" placeholder="Numero" name="dominio" type="text"> 
                        <span class="span_none" id="modelo-error"> Dominio</span>
                    </div>
                </div>


            </div> 

             