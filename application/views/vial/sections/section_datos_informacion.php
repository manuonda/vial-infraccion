 <h3 class="form-section">Datos de Información</h3>
            
            <div class="row">
                
                  <div class="col-md-3">
                    <div class="form-group" id="numero_licencia-div">
                        <label class="control-label">Número de Licencia</label>
                        <input class="form-control" placeholder="Numero de Licencia" id="numero_licencia" type="text" name="numero_licencia"
                               value="<?php if (isset($infraccion->numero_licencia)) echo $infraccion->numero_licencia; ?> "> 
                   
                    </div>
                </div>

                 <div class="col-md-3">
                    <div class="form-group" id="categoria-div">
                        <label class="control-label">Categoría</label>
                        <input class="form-control" placeholder="Categoría" id="categoria" type="text" name="categoria"
                               value="<?php if (isset($infraccion->categoria)) echo $infraccion->categoria; ?> "> 
                   
                    </div>
                </div>

                 <div class="col-md-3">
                    <div class="form-group" id="numero_licencia-div">
                        <label class="control-label">Autoridad que Expidio</label>
                        <input class="form-control" placeholder="Autoridad que Expidio" id="autoridad" type="text" name="autoridad"
                               value="<?php if (isset($infraccion->autoridad)) echo $infraccion->autoridad; ?> "> 
                   
                    </div>
                </div>
            </div>


             <div class="row">  

               <div class="col-md-3">
                    <div class="form-group" id="fecha_expedicion-div">    
                        <label class="control-label">Fecha de Expedición : </label>   
                        <div class="input-group">
                            <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion"
                                   value="<?php if (isset($infraccion->fecha_expedicion)) 
                                   echo date('Y-m-d',strtotime($infraccion->fecha_expedicion)); ?>">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                        

                    </div>
               </div>

               <div class="col-md-3">
                    <div class="form-group" id="fecha_vencimiento-div">    
                        <label class="control-label">Fecha de Vencimiento : </label>   
                        <div class="input-group" >
                            <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento"
                                   value="<?php if (isset($infraccion->fecha_vencimiento)) 
                                    echo date('Y-m-d',strtotime($infraccion->fecha_vencimiento)); ?>">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                       

                    </div>
                </div>
 
                 

            </div>
            
            

            <hr/>
            <h3>Observaciones</h3> 
            <div class="row">
            <div class="col-md-12">
                <textarea class="form-control" name="descripcionInformacion" id="descripcion" 
                  
                ><?php if(isset($infraccion)) echo $infraccion->descripcion; ?></textarea>
              </div>  
            </div>