<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-file-text-o"></i><?php echo $subtitulo ?> </div>
    </div>

    
    <div class="portlet-body form">
       
       
        <div class="form-body">                    
            <h3 class="form-section"> Detalles de la Infracción</h3>

            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">Número de Acta</label>
                    <input class="form-control" placeholder="Seccion" type="text" name="seccion" readonly="true"
                           value="<?php if (isset($infraccion)) echo $infraccion->numero_acta; ?>"/>
                </div>

           </div>

            <h3 class="form-section">Datos del Involucrado</h3>
             <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Nombre</label>
                        <input class="form-control" placeholder="Numero" name="numero" 
                               value="<?php if (isset($involucrado)) echo $involucrado->nombre; ?>"
                               readonly="true"> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Apellido</label>
                        <input class="form-control" placeholder="Numero" name="numero" 
                               value="<?php if (isset($involucrado)) echo $involucrado->apellido; ?>"
                               readonly="true"> 
                    </div>
                </div>

                 <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Dni</label>
                        <input class="form-control" placeholder="Numero" name="numero" 
                               value="<?php if (isset($involucrado)) echo $involucrado->dni; ?>"
                               readonly="true"> 
                    </div>
                </div>
            </div> 
           
                <h3 class="form-section">Datos del Propietario</h3>
             <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Nombre</label>
                        <input class="form-control" placeholder="Numero" name="numero" 
                               value="<?php if (isset($propietario)) echo $propietario->nombre; ?>"
                               readonly="true"> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Apellido</label>
                        <input class="form-control" placeholder="Numero" name="numero" 
                               value="<?php if (isset($propietario)) echo $propietario->apellido; ?>"
                               readonly="true"> 
                    </div>
                </div>

                 <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Dni</label>
                        <input class="form-control" placeholder="Numero" name="numero" 
                               value="<?php if (isset($propietario)) echo $propietario->dni; ?>"
                               readonly="true"> 
                    </div>
                </div>
            </div> 
            
            <h3 class="form-section">Datos del vehículo </h3>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Tipo de Vehículo:</label>
                        <input class="form-control" placeholder="Numero" name="numero" 
                               value="<?php if (isset($tipovehiculo)) echo $tipovehiculo->nombre; ?>"
                               readonly="true"> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Marca:</label>
                        <input class="form-control" placeholder="Numero" name="numero" 
                               value="<?php if (isset($marca)) echo $marca->nombre; ?>"
                               readonly="true"> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Modelo:</label>
                        <input class="form-control" placeholder="Numero" name="numero" 
                               value="<?php if (isset($modelo)) echo $modelo->nombre; ?>"
                               readonly="true"> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Dominio:</label>
                        <input class="form-control" placeholder="Numero" name="numero" 
                               value="<?php if (isset($infraccion)) echo $infraccion->dominio; ?>"
                               readonly="true"> 
                    </div>
                </div>
            </div>
            <!-- end detalle de la infraccion -->
            

            <h3>Informes </h3>
            <hr/>
         

            <div class="portlet light bordered">
            <div class="portlet-title">
            <div class="caption font-dark">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject bold uppercase"> Listado de Infracciones</span>
            </div>
            </div>
            
            <div class="portlet-body">
            <div class="table-toolbar">
            <div class="row">
            <div class="col-md-6">
            <div class="btn-group">
            <a href="<?php echo base_url().'informes/agregar/'.$infraccion->id_infraccion;?>" id="sample_editable_1_new" class="btn sbold green"> Agregar
            <i class="fa fa-plus"></i>
            </a>
            </div>
            </div>
            </div>
            </div>
           
             <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table_expediente">
                <thead>
                <tr>
                <th> ID </th>
                <th> Nombre</th>
                <th> Fecha</th>
                <th> Informe</th>
                <th> Acciones </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($informes as $informe): ?>
                  <tr class="odd gradeX">
                  <td> <?php echo $informe->id_informe ;?></td> 
                  <td> <?php echo $informe->descripcion;?></td>
                  <td> <?php echo $informe->fecha_ingreso ;?></td>
                  <td>  <a title="Informes" 
                        href='<?php echo base_url().'informes/get_licencia/'.$informe->id_informe;?>'
                        class="btn default btn-xs blue"
                        target="_blank"
                        >
                      Descargar
                  </a>
                  <td>
                  <div class="text-center">
                  <a title="Editar"  href='<?php echo base_url().'informes/editar/'.$informe->id_informe;?>'
                     class="btn default btn-xs yellow"> 
                  <i class="fa fa-pencil"></i> 
                  </a>
                  <a title="Eliminar"  onclick=eliminar('<?php echo base_url().'informes/delete/'.$informe->id_informe;?>') href='#'
                     class="btn default btn-xs red"> 
                  <i class="fa fa-trash"></i> 
                  </a>
                                                    
                </div>
            </td>                                          
            </tr>
            <?php endforeach;?>
           
           </tbody>
           </table>  



           </div>
           </div>        
                            
            
            <!-- Acciones -->
            <div class="form-actions right">
                <a href="<?php echo base_url(); ?>infraccionvial/" class="btn blue"> Cerrar</a>
            </div>


      </div>
    </div>
  </div>

  <script type="text/javascript">
    function eliminar($rutaDelete){
      alert("eliminar");
       
       var result=confirm("Desea eliminar el informe");
       if(result){
         window.location.href=$rutaDelete;
       }
    }

  </script>
