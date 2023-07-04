<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i><?php echo $subtitulo ?> </div>
    </div>


    <div class="portlet-body form">
        <!-- BEGIN FORM-->

        <?php echo form_open_multipart('DepContravencional/guardarContravencionOtro', '  id="form-otros"  class="horizontal-form"'); ?>
        <div class="form-body">                         
            <h3 class="form-section">Expedientes</h3>

            <input type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $id; ?>" />
            <input type="hidden" name="tipocontravencion" id="tipocontravencion" value="<?php if (isset($tipoContravencion)) echo $tipoContravencion; ?>" /> 

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group" id="num_exp_cont-div">
                        <label class="control-label">Número Expediente</label>
                        <input id="num_exp_cont" name="num_exp_cont" class="form-control requerido" placeholder="Numero Expediente" type="text"
                               value="<?php if (isset($num_exp_cont)) echo $num_exp_cont; ?>">
                        <span class="span_none" id="num_exp_cont-error">Ingresar Número Expediente </span>
                    </div>

                </div>
                <!--span -->
                <div class="col-md-3">
                    <div class="form-group" id="fecha_ingreso-div">
                        <label class="control-label">Fecha de Ingreso(*)</label>
                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                            <input type="text" class="form-control requerido" id="fecha_ingreso" readonly="" name="fecha_ingreso"
                                   value="<?php if (isset($fecha_ingreso)) echo $fecha_ingreso; ?>">
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
                    <div class="form-group" id="num_acta_cont-div">
                        <label class="control-label">Nro. de Acta Contravencional</label>
                        <input id="num_acta_cont" class="form-control requerido" placeholder="Numero de Acta" type="text" name="num_acta_cont" 
                               value="<?php if (isset($num_act_cont)) echo $num_act_cont; ?> "> 
                        <span class="span_none" id="num_acta_cont-error">Ingrese Nro. de Acta Contravencional</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="regional-div">
                        <label class="control-label"> Regional</label>
                        <div class=" input-group bootstrap-touchspin">
                            <select 
                                class="form-control select2  requerido" id="regional" name="regional">
                                <option value="">Seleccionar</option>
                                <?php foreach ($regionales as $regional): ?>
                                    <option value="<?php echo $regional->id_regional ?>"
                                            <?php if (isset($contravencional) && $contravencional->id_regional == $regional->id_regional) echo 'selected="selected"'; ?>>
                                        <?php echo $regional->regional ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="span_none" id="regional-error">Seleccione Regional</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-2" id="num_exp_ent-div">
                    <label class="control-label">Nro. Expediente Entrante</label>
                    <input class="form-control requerido" placeholder="Numero de Expediente Entrante" type="text" name="num_exp_ent"
                           id="num_exp_ent"
                           value="<?php if (isset($numero_expediente_entrante)) echo $numero_expediente_entrante; ?>"/>
                    <span class="span_none" id="num_exp_ent-error">Ingrese Nro. Expediente Entrante</span> 
                </div>



                <div class="row">
                    <div class="col-md-3 ">
                        <div class="form-group" id="dependencia-div">
                            <label class="control-label">Dependencia (*)</label>
                            <div class=" input-group bootstrap-touchspin">
                                <select class="form-control select2 select2-tipodependencia requerido" id="dependencia" name="dependencia">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($dependencias as $dependencia): ?>
                                        <option value="<?php echo $dependencia->id_dependencia ?>"
                                                <?php if (isset($id_dependencia) && $id_dependencia == $dependencia->id_dependencia) echo 'selected="selected"'; ?>>
                                            <?php echo $dependencia->dependencia ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="span_none" id="importe-error">Seleccione la Dependencia </span>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group" id="movimiento-div">
                            <label class="control-label"> Ultimo Movimiento</label>
                            <div class=" input-group bootstrap-touchspin">
                                <select class="form-control select2 select2-tipodependencia requerido" id="movimiento" name="movimiento">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($movimientos as $movimiento): ?>
                                        <option value="<?php echo $movimiento->id_contravencion_movimiento ?>"
                                                <?php if (isset($contravencional) && $contravencional->id_contravencion_movimiento == $movimiento->id_contravencion_movimiento) echo 'selected="selected"'; ?>>
                                            <?php echo $movimiento->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="span_none" id="movimiento-error">Seleccione Movimiento</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="contravencionseccion-div">
                            <label class="control-label"> Sección</label>
                            <div class=" input-group bootstrap-touchspin">
                                <select class="form-control select2 requerido" id="contravencionseccion" name="contravencionseccion">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($secciones as $seccion): ?>
                                        <option value="<?php echo $seccion->id_contravencion_seccion ?>"
                                                <?php if (isset($contravencion) && $contravencion->id_contravencion_seccion == $seccion->id_contravencion_seccion) echo 'selected="selected"'; ?>>
                                            <?php echo $seccion->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="span_none" id="contravencionseccion-error">Seleccione Sección </span>
                            </div>
                        </div>
                    </div>   

                </div>

                <h3 class="form-section">Lugar del Hecho</h3>


                <!--/row-->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">    
                            <label class="control-label">Fecha</label>   
                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                <input type="text" class="form-control" readonly="" name="fecha_hecho"
                                       value="<?php if (isset($fecha_hecho)) echo $fecha_hecho; ?>">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                        </div>


                        <!-- /input-group -->
                        <span class="help-block"> Select date </span>

                    </div>
                    <!--</div>-->
                    <div class="col-md-3">
                        <div class="form-group"><label class="control-label">Hora</label>
                            <div class="input-group">
                                <input type="text" class="form-control timepicker timepicker-24" name="hora_hecho"
                                       value="<?php if (isset($hora_hecho)) echo $hora_hecho; ?>"
                                       >
                                <span class="input-group-btn">
                                    <button class="btn default" type="button">
                                        <i class="fa fa-clock-o"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!--/span-->
                </div>
            </div>
            <!--/row-->
            <div class="row">
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label class="control-label">Departamento(*)</label>
                        <select class="form-control" required data-toggle="tooltip" id="departamento"  name="departamento">
                            <option value="">-- Seleccionar --</option>
                            <?php foreach ($departamentos as $departamento): ?>                                                                        
                                <option value="<?php echo $departamento->id_departamento ?>"    
                                        <?php if (isset($id_departamento) && $id_departamento == $departamento->id_departamento) echo 'selected="selected"'; ?>>
                                    <?php echo $departamento->depto ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block"> Departamento </span>
                    </div>
                </div>

                <!-- localidad -->
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label class="control-label">Localidad(*)</label>
                        <select class="form-control" required data-toggle="tooltip"  id="localidad" name="localidad">
                            <option value="">-- Seleccionar --</option>
                            <?php foreach ($localidades as $localidad): ?>                                                                        
                                <option value="<?php echo $localidad->id_localidad ?>"    
                                        <?php if (isset($id_localidad) && $id_localidad == $localidad->id_localidad) echo 'selected="selected"'; ?>>
                                    <?php echo $localidad->localidad ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block"> Localidad </span>
                    </div>
                </div>

                <!-- barrios -->
                <div class="col-md-3 ">

                    <div class="form-group">
                        <label class="control-label">Barrio(*)</label>
                        <select class="form-control" required data-toggle="tooltip"  id="barrio" name="barrio">
                            <option value="">-- Seleccionar --</option>
                            <?php foreach ($barrios as $barrio): ?>                                                                        
                                <option value="<?php echo $barrio->id_barrio ?>"    
                                        <?php if (isset($id_barrio) && $id_barrio == $barrio->id_barrio) echo 'selected="selected"'; ?>>
                                    <?php echo $barrio->barrio ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block"> Barrio </span>
                    </div>
                </div>

                <!-- calles -->
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label class="control-label">Calle(*)</label>
                        <select class="form-control" required data-toggle="tooltip"  id="calle" name="calle">
                            <option value="">-- Seleccionar --</option>
                            <?php foreach ($calles as $calle): ?>                                                                        
                                <option value="<?php echo $barrio->id_barrio ?>"    
                                        <?php if (isset($id_calle) && $id_calle == $calle->id_calle) echo 'selected="selected"'; ?>>
                                    <?php echo $calle->calle ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block">Calle </span>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Número(*):</label>
                        <input class="form-control" placeholder="Numero" name="numero" 
                               value="<?php if (isset($numero)) echo $numero; ?>"
                               type="numero"> 
                    </div>
                </div>

            </div>
        </div>

    </div>





    <h3 class="form-section">Detalle de la Infracción </h3>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        Listado</div>
                    <div class="actions">
                        <button  type="button" id="btnAgregarLeyes"  class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Agregar
                        </button>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tableDetalle">
                        <thead>


                        <th> Ley </th>
                        <th> Artículo</th>
                        <th> Inciso</th>
                        <th> Acciones</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyDetalleInfraccion">
                            <?php if ($detalleInfracciones != null): ?>
                                <?php foreach ($detalleInfracciones as $ley): ?>

                                    <tr class="odd gradeX"
                                        id="<?php echo $ley->id . "-" . $ley->idLey . "-" . $ley->idArticulo . "-" . $ley->idInciso; ?>"
                                        >
                                <input type="hidden" name="leyes[]" 
                                       value="<?php echo $ley->id . "-" . $ley->idLey . "-" . $ley->idArticulo . "-" . $ley->idInciso . "-" . $ley->tipoUnidad . "-" . $ley->unidad; ?>"
                                       >
                                <td> <?php echo $ley->descripcionley; ?> </td>
                                <td> <?php echo $ley->descripcionarticulo; ?> </td>
                                <td><?php echo $ley->descripcioninciso; ?></td>

                                <td>
                                    <div class="text-center">
                                    <!--<button class="btn default btn-xs yellow"> <i class="fa fa-pencil"></i> </button>
                                        -->
                                        <button onclick="eliminarDetalleLey('<?php echo $ley->id . "-" . $ley->idLey . "-" . $ley->idArticulo . "-" . $ley->idInciso; ?>'); return false;" type="button" class="btn default btn-xs red" ><i class="fa fa-times"></i></button>

                                    </div>
                                </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>  
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- end detalle de la infraccion -->


    <!-- Datos del Infractor -->
    <h3 class="form-section">Datos del Involucrado/s</h3>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="dni">Cuil/Dni(*):</label>
                <div class="form-inline">
                    <input class="form-control" id="cuilInfractor" name="infractor" type="text" 

                           value="<?php if (isset($infractor)) echo $infractor->cuil; ?>" type="number" >
                    <a href="javascript:;" class="btn red" onclick="buscarPorTipo('Infractor');return false;">
                        <i class="fa fa-search"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_persona_conductor" data-toggle="tab"> Datos </a>
        </li>
        <li>
            <a href="#tab_conductor_domicilio" data-toggle="tab"> Domicilio</a>
        </li>
    </ul>
    <!-- tabs propietarios -->
    <div class="tab-content">
        <div class="tab-pane active" id="tab_persona_conductor">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Nombre:</label>
                        <input class="form-control" 
                               value="<?php if (isset($infractor)) echo $infractor->nombre; ?>" id="nombreInfractor" placeholder="Nombre"  type="text"
                               readonly="true"> 
                    </div>   
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Apellido:</label>
                        <input class="form-control" value="" id="apellidoInfractor" placeholder="Numero"
                               value="<?php if (isset($infractor)) echo $infractor->apellido; ?>" type="text" 
                               readonly="true"> 
                    </div>   
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Tipo Documento:</label>
                        <input class="form-control" 
                               value="<?php if (isset($infractor)) echo $infractor->tipoDocumento; ?>" id="tipoDocumentoInfractor" placeholder="Numero" type="text" 
                               readonly="true"> 
                    </div>   
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Nro:</label>
                        <input class="form-control" 
                               value="<?php if (isset($infractor)) echo $infractor->dni; ?>" id="numeroDocumentoInfractor" placeholder="Numero" " type="text" 
                               readonly="true"> 
                    </div>   
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Fecha Nacimiento:</label>
                        <input class="form-control" value="<?php if (isset($infractor)) echo $infractor->fechaNacimiento; ?>" id="fechaNacimientoInfractor" placeholder="Fecha Nacimiento" type="text" 
                               readonly="true"> 
                    </div>   
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Nacionalidad:</label>
                        <input class="form-control" value="<?php if (isset($infractor)) echo $infractor->nacionalidad; ?>" id="nacionalidadInfractor" placeholder="Nacionalidad"  type="text" 
                               readonly="true"> 
                    </div>   
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Sexo:</label>
                        <input class="form-control" 
                               value="<?php if (isset($infractor)) echo $infractor->sexo; ?>" id="sexoInfractor" placeholder="Sexo"  type="text" 
                               readonly="true"> 
                    </div>   
                </div>      

            </div>
        </div>
        <div class="tab-pane" id="tab_conductor_domicilio">
            <p>Datos del Domicilio</p>
            <table class="table table-striped table-bordered table-hover table-checkable order-column" 
                   id="tableDomicilioInfractor">
                <thead>
                    <tr>
                        <th width="45%">Actual</th>
                        <th>Domicilio </th>
                    </tr>
                </thead>
                <tbody id="tbodyDomicilioInfractor">
                </tbody>
            </table>


        </div>
    </div> 

    <!-- End Datos del Infractor -->

    <h3>Sentencia</h3>

    <div class="row">
        <div class="col-md-12">
            <textarea class="form-control" value="<?php if (isset($dictamen)) echo $dictamen; ?>" rows="5" id="dictamen"></textarea>
        </div>
    </div>

    <div id="div_message" class="custom-alerts alert alert-danger fade in">
        <div id="message_alert">
        </div> 
    </div>

    <!-- Acciones -->
    <div class="form-actions right">
        <a href="<?php echo base_url(); ?>depcontravencional/" class="btn default"> Cerrar</a>
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
<!-- include leyes modal detalle_infraccion -->
<?php $this->load->view('modal/detalle_infraccion'); ?>
</div> 
<!-- modal correspondiente archiva observacion -->

<div id="modal_archivar_expediente" class="modal fade" tabindex="-1" data-width="860">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Archivar Expediente</h4>
    </div>
    <div class="modal-body"> 
        <h3>Observación</h3>
        <div class="row">
            <div class="col-md-12">
                <textarea class="form-control" value="" rows="5" id="observacionEstado"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnArchivarContravencion" class="btn green">Guardar</button>
    </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- end modal -->
</div>



<script type="text/javascript">
    $(document).ready(function () {
        //Formulario Otros
        $("#form-otros").submit(function (eve) {
            eve.preventDefault();

            console.log("formulario otros");

            if (validarCreateView()) {
                console.log("formulario validado");

                var data = new FormData(this);
                //var form = document.getElementById('form-otros');
                console.log("data : " + data);
                //console.log("form : "+form);
                //var formData = new FormData(form);
                console.log("formData : " + JSON.stringify(data));
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>DepContravencional/guardarContravencionOtro',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status == 'OK') {
                            window.location = "<?php echo base_url(); ?>DepContravencional";
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


<script type="text/javascript">


    $(document).ready(function () {

        //departamento
        $("select[name=departamento]").change(function () {
            id_departamento = $(this).val();
            if (id_departamento === '')
                return false;

            resetaCombo('localidad');

            $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_localidad/' + id_departamento, function (data) {

                console.log("data = > " + data);
                var option = new Array();
                $.each(data, function (i, obj) {
                    option[i] = document.createElement('option');
                    $(option[i]).attr({value: obj.id_localidad});
                    $(option[i]).append(obj.localidad);

                    $("select[name=localidad]").append(option[i]);
                });
            });
        });

        //localidad 
        $("select[name=localidad]").change(function () {
            id_localidad = $(this).val();
            if (id_localidad === '')
                return false;

            resetaCombo('barrio');

            $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_barrio/' + id_localidad, function (data) {

                console.log("data = > " + data);
                var option = new Array();
                $.each(data, function (i, obj) {
                    option[i] = document.createElement('option');
                    $(option[i]).attr({value: obj.id_barrio});
                    $(option[i]).append(obj.barrio);

                    $("select[name=barrio]").append(option[i]);
                });
            });
        });

        //barrio 
        $("select[name=barrio]").change(function () {
            id_barrio = $(this).val();
            if (id_barrio === '')
                return false;

            resetaCombo('calle');

            $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_calle/' + id_barrio, function (data) {

                console.log("data = > " + data);
                var option = new Array();
                $.each(data, function (i, obj) {
                    option[i] = document.createElement('option');
                    $(option[i]).attr({value: obj.id_calle});
                    $(option[i]).append(obj.calle);

                    $("select[name=calle]").append(option[i]);
                });
            });
        });




        //select anexos
        $("select[name=anexo]").change(function () {
            id_anexo = $(this).val();
            if (id_anexo === '')
                return false;

            resetaCombo('anexo');

            $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_articulo/' + id_marca, function (data) {

                console.log("data = > " + data);
                var option = new Array();
                $.each(data, function (i, obj) {
                    option[i] = document.createElement('option');
                    $(option[i]).attr({value: obj.id_modelo});
                    $(option[i]).append(obj.nombre);

                    $("select[name=modelo]").append(option[i]);
                });
            });
        });





        //************************************}
        // Dialog de agrega leyes 
        //ley 
        $("select[name=ley]").change(function () {
            id_ley = $(this).val();
            if (id_ley === '')
                return false;

            resetaCombo('articulo');

            $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_articulos/' + id_ley, function (data) {

                console.log("data = > " + data);
                var option = new Array();
                $.each(data, function (i, obj) {
                    option[i] = document.createElement('option');
                    $(option[i]).attr({value: obj.id_articulo});
                    $(option[i]).append(obj.nombre);

                    $("select[name=articulo]").append(option[i]);
                });
            });
        });

        //articulo 
        $("select[name=articulo]").change(function () {
            id_articulo = $(this).val();
            if (id_articulo === '')
                return false;

            resetaCombo('inciso');

            $.getJSON('<?php echo base_url(); ?>combo_dinamico/get_incisos/' + id_articulo, function (data) {

                console.log("data = > " + data);
                var option = new Array();

                $.each(data, function (i, obj) {
                    option[i] = document.createElement('option');
                    $(option[i]).attr({value: obj.id_inciso});
                    $(option[i]).append(obj.nombre);

                    $("select[name=inciso]").append(option[i]);
                });
            });
        });



        /**
         * Btn agregar Ley de Contravencion
         **/
        $("#btnAddLeyContravencion").click(function (ev) {

            var id = $("#id").val();
            var idContArtInciso = $("#idContArtInciso").val();
            var idLey = $("#ley").val();
            var idArticulo = $("#articulo").val();
            var idInciso = $("#inciso").val();

            var textLey = "";
            var textArticulo = "";
            var textInciso = "";

            if (idLey != null && idLey != 0) {
                $.getJSON('<?php echo base_url(); ?>/ley/get_ley/' + idLey, function (datos) {
                    console.log("datos : " + JSON.stringify(datos));
                    if (datos != null) {

                    }

                });
            }


            if (idArticulo != null && idArticulo != 0) {
                $.getJSON('<?php echo base_url(); ?>/ley/get_articulo/' + idArticulo, function (datos) {
                    console.log("datos : " + JSON.stringify(datos));
                    if (datos != null) {

                    }

                });
            }

            if (idInciso != null && idInciso != 0) {
                $.getJSON('<?php echo base_url(); ?>/ley/get_articulo/' + idArticulo, function (datos) {
                    console.log("datos : " + JSON.stringify(datos));
                    if (datos != null) {

                    }

                });
            }

            console.log("idContravnecion: " + id);
            console.log("idContArtInciso :" + idContArtInciso);
            console.log("idLey : " + idLey);
            console.log("idArticulo : " + idArticulo);
            console.log("idInciso : " + idInciso);


            //no tiene id de contravencion
            if (id == null || id == "") {
                console.log("no tiene id de contravencion");
                //se agrega los elementos 
                var row = "<tr>" +
                        "<input type='hidden' name='ley[]'" +
                        "value='0-" + idLey + "'-'" + idArticulo + "'-'" + idInciso + "' />" +
                        "<td>" + textLey + "</td>" +
                        "<td>" + textArticulo + "</td>" +
                        "<td>" + textInciso + "</td>" +
                        "</tr>";

                //agregamos a la tabla 
                $("#tbodyDetalleInfraccion").append(row);

            } else {
                //es una contravencion a editar
                var data = {'id': idContArtInciso, 'id_contravencion': id, 'ley': idLey,
                    'articulo': idArticulo, 'inciso': idInciso};

                $.post('<?php echo base_url(); ?>/contravencionarticuloinciso/post_addLeyContravencion/',
                        JSON.stringify(data),
                        function (response) {
                            console.log("response=> " + JSON.stringify(response));
                            if (response.status == 'OK') {

                                $("#tbodyDetalleInfraccion").empty();

                                $.each(data.list, function (i, obj) {
                                    console.log("id => " + JSON.stringify(obj));
                                    var row = "<tr>" +
                                            "<input type='hidden' name='ley[]'" +
                                            "value='" + obj.id + "'-'" + obj.idLey + "'-'" + obj.idArticulo + "'-'" + obj.idInciso + " />" +
                                            "<td>" + obj.descripcionLey + "</td>" +
                                            "<td>" + obj.descripcionArticulo + "</td>" +
                                            "<td>" + obj.descripcionInciso + "</td>" +
                                            "</tr>";

                                    //agregamos a la tabla 
                                    $("#tbodyDetalleInfraccion").append(row);
                                });

                                $("#modal_leyes").hide();
                            }

                        }, 'json');


            }


        });


        //************************************************
        //************************************************


        /** Funciones de archivar expediente **/
        /** Cambio de estado el informe **/
        $("#btnArchivarContravencion").click(function (ev) {

            var observacionEstado = $("#observacionEstado").val();
            var idContravencion = $("#id").val();
            var data = {'id_contravencion': idContravencion, 'observacion': observacionEstado};

            $.post('<?php echo base_url(); ?>/contravencionestado/post_estadoArchivar/',
                    JSON.stringify(data),
                    function (response) {
                        console.log("response=> " + JSON.stringify(response));
                        if (response.status == 'OK') {


                            $("#modal_archivar_expediente").hide();

                        }

                    }, 'json');

        });



        function resetaCombo(el) {
            $("select[name='" + el + "']").empty();
            var option = document.createElement('option');
            $(option).attr({value: ''});
            $(option).append('-- Seleccionar --');
            $("select[name='" + el + "']").append(option);
        }





    });

    /** Funcion que permite poder buscar
     * un determinado dni/cuil
     * @param : propietario o conductor
     */
    function buscarPorTipo(pTipoPersona) {

        var prefijo = "";

        //Obtenemos el valor
        var dniCuit = $("#cuil" + pTipoPersona).val();

        if (dniCuit != undefined && dniCuit.length > 0) {
            //  var datos=buscarPersona(dniCuit);

            //ver como arreglo esto
            $.getJSON('<?php echo base_url(); ?>/request_json/get_informacionPersona/' + dniCuit, function (datos) {
                console.log("datos : " + JSON.stringify(datos));
                if (datos != null) {
                    console.log("datos.status : " + datos.status);
                    if (datos.status == "OK" && datos.persona != null) {
                        loadDataPersona(datos.persona, pTipoPersona);
                    } else {
                        alert(datos.message)
                    }
                }

            });


        } else {
            alert("Debe ingresar Dni/Cuil de " + pTipoPersona);
        }
    }

    /** Funcion que permite buscar 
     * una persona por cuil/cuit
     * @param : dni/cuil
     */
    function buscarPersona(dniCuil) {
        var data = "";
        $.getJSON('<?php echo base_url(); ?>/request_json/get_informacionPersona/' + dniCuil, function (data) {
            data = data;
        });

        return data;

    }



    /** Funcion que permite cargar los datos 
     * de la persona e indicar a que seccion es 
     * con el prefijo
     */
    function loadDataPersona(datos, prefijo) {
        var persona = datos.datos;
        var domicilios = datos.domicilios;

        $("#cuil" + prefijo).val(persona.cuil);
        $("#nombre" + prefijo).val(persona.nombre);
        $("#apellido" + prefijo).val(persona.apellido);
        $("#tipoDocumento" + prefijo).val(persona.tipoDocumento);
        $("#numeroDocumento" + prefijo).val(persona.dni);
        $("#fechaNacimiento" + prefijo).val(persona.fechaNacimiento);
        $("#nacionalidad" + prefijo).val(persona.nacionalidad);
        if (persona.sexo == 'M') {
            $("#sexo" + prefijo).val('M');
        } else {
            $("#sexo" + prefijo).val('F');
        }

        //Cargamos los domicilios del propietario 
        console.log("domicilios : " + JSON.stringify(domicilios));
        var rows = $("#tbodyDomicilio" + prefijo);
        //clear rows
        rows.empty();

        if (domicilios != null && domicilios.length > 0) {
            for (i = 0; i < domicilios.length; i++) {
                var domicilio = domicilios[i];
                var tr = "<tr>";

                if (domicilio.actual == 't') {
                    tr = tr + "<td><span><input type='radio' checked></input></span></td>"
                } else {
                    tr = tr + "<td></td>"
                }

                tr = tr + "<td>" + domicilio.barrio + "," + domicilio.calle + "," + domicilio.numero + "</td></tr>";
                rows.append(tr);


            }
        }


        $("#tableDomicilio" + prefijo).dataTable();

        //btn guardar leyes
        $("#btn-guardar-leyes").click(function (ev) {

            //obtenemos la ley a guardar
            var ley = $("#select-ley").val();

        });

    }


</script>


<!--</div>-->

<!--</div>-->
<!--</div>-->
<!--</div>-->




