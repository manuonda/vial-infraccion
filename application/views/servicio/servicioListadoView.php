<style type="text/css">
    .tooltip-inner {
        white-space: pre-wrap;
    }
    table.dataTable thead > tr > th {
        padding: 8px 0px;
    }
    table{
        font-size: 12px;
    }
    .btn-box-tool {
        color: #fff;
    }
    .btn-box-tool {
        font-size: 15px;
    }
</style>

<article>
    <div id="confirm" class="modal fade bs-example-modal-sm bs-example-modal-md bs-example-modal-lg in" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">Atenci&oacute;n</h4>
                </div>
                <div class="modal-body">
                    <p id="modalMsje"></p>
                    <hr />
                    <p style="text-align: center">
                        <button name="botonOk" id="botonOk" type="button" data-dismiss="modal" class="btn btn-outline" id="botonOk"><i id="btnAccion" class="fa txt-info"></i></button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline">Cancelar</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php
    $attributes = array('class' => 'form-horizontal', 'id' => 'servicioFormListado');
    echo form_open(base_url('servicio/servicioListadoAccion'), $attributes);
    ?>
    <div class="col-xs-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="col-lg-6">
                    <div class="col-lg-2">
                        Ver Servicios: 
                    </div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('servicio/servicioListadoTodos/'); ?>" class="btn btn-block btn-primary btn-flat btn-xs">Todos</a>
                    </div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('servicio/servicioListadoTodos/0'); ?>" class="btn btn-block btn-warning btn-flat btn-xs">Pendientes</a>
                    </div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('servicio/servicioListadoTodos/1'); ?>"  class="btn btn-block btn-success btn-flat btn-xs">Publicado</a>
                    </div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('servicio/servicioListadoTodos/2'); ?>"  class="btn btn-block btn-info btn-flat btn-xs">Asignado</a>
                    </div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('servicio/servicioListadoTodos/3'); ?>"  class="btn btn-block btn-danger btn-flat btn-xs">Realizado</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-lg-2">
                        Ver Listado: 
                    </div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('servicio/servicioListadoPostulados'); ?>" class="btn btn-block btn-info btn-flat btn-xs">Postulantes</a>
                    </div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('servicio/servicioListadoPostulados'); ?>" class="btn btn-block btn-primary btn-flat btn-xs">Asignados</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="x_content" >
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <?php
                        if ($tipo != null):
                            switch ($tipo) {
                                case 'danger': $icono = 'fa-minus-circle';
                                    break;
                                case 'warning': $icono = 'fa-warning';
                                    break;
                                case 'success': $icono = 'fa-thumbs-up';
                                    break;
                            }
                            ?>
                            <div class="row"><br>
                                <p class="col-xs-offset-1 col-xs-10 col-md-offset-1 col-md-10 alert alert-<?php echo $tipo; ?>" style="text-align: center"> 
                                    <i class="fa <?php echo $icono; ?>"></i>
                                    <?php echo $mensaje; ?></p>
                            </div>
                            <?php
                        endif;
                        if (validation_errors() != ''):
                            ?>
                            <div class="row">
                                <p class="col-xs-offset-1 col-xs-10 col-md-offset-1 col-md-10 alert alert-warning" style="text-align: center"> <i class="fa fa-warning"></i><?php echo validation_errors(); ?></p>
                            </div>
                        <?php endif; ?>
                        <div id="no-more-tables" class="table-responsive">
                            <?php if (!empty($listado)) { ?>
                                <table id="example" class="table table-bordered table-striped table-condensed table-hover cf" width="100%">
                                    <thead class="cf">
                                        <tr>
                                            <th rowspan="2"  style="text-align: center;vertical-align: middle">#</th>
                                            <th rowspan="2"  style="text-align: center;vertical-align: middle">Fecha<br>Solicitud</th>
                                            <th rowspan="2"  style="text-align: center;vertical-align: middle">Comercio<br>Raz&oacute;n Social</th>
                                            <th rowspan="2" style="text-align: center;vertical-align: middle">Solicitante</th>
                                            <th colspan="3" style="text-align: center;vertical-align: middle">D&iacute;as Servicio</th>
                                            <th colspan="3" style="text-align: center;vertical-align: middle">Otros Cuerpos</th>
                                            <th rowspan="2" style="text-align: center;vertical-align: middle">Estado</th>
                                            <th rowspan="2"><div style="text-align: center;vertical-align: middle; float: right"><a class="btn btn-warning" id="imprimeListado"><i class="fa fa-print txt-primary"></i> Imprimir</a></div></th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center;">Fecha Servicio</th>
                                            <th style="text-align: center;">Masc.</th>
                                            <th style="text-align: center;">Fem.</th>
                                            <th style="text-align: center;">Mont.</th>
                                            <th style="text-align: center;">Espc.</th>
                                            <th style="text-align: center;">Otros</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($listado as $serv) {
                                            switch ($serv['servicio']['solicitante']) {
                                                case 'P': $car = 'Propietario';
                                                    break;
                                                case 'S': $car = 'Socio';
                                                    break;
                                                case 'G': $car = 'Encargado/Gestor';
                                                    break;
                                            }
                                            $tCom = 'cuit:' . $serv['comercio']['cuit'] . '&#10;Respons:' . $serv['comercio']['responsable'] . '&#10;Domic:' . $serv['comercio']['domicilio'] . '&#10;Descrip:' . $serv['comercio']['descripcion'];
                                            $tSolic = 'cuil:' . $serv['servicio']['cuil_ciudadano'] . '&#10;Caracter:' . $car . '&#10;Tel&eacute;fono Fijo:' . $serv['servicio']['telFijo'] . '&#10;Tel&eacute;fono Cel.:' . $serv['servicio']['telCelular'];
                                            $lineas = sizeof($serv['dias']);
                                            echo '<tr>
                                    <td rowspan="' . $lineas . '">' . $i++ . '</td>
                                    <td rowspan="' . $lineas . '">' . $serv['servicio']['fechaSolicitud'] . '</td>
                                    <td rowspan="' . $lineas . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $tCom . '">' . $serv['comercio']['comercio'] . '</td>
                                    <td rowspan="' . $lineas . '" data-toggle="tooltip" data-placement="top" data-original-title="' . $tSolic . '">' . $serv['servicio']['apellido'] . ', ' . $serv['servicio']['nombre'] . '</td>';
                                            echo'<td>' . $serv['dias'][0]['diaFecha'] . ' ' . substr($serv['dias'][0]['desde'], 0, 5) . ' - ' . substr($serv['dias'][0]['hasta'], 0, 5) . '</td>
                                    <td>' . $serv['dias'][0]['persMasculino'] . '</td>
                                    <td>' . $serv['dias'][0]['persFemenino'] . '</td>';
                                            echo '<td rowspan="' . $lineas . '" >' . $serv['servicio']['montado'] . '</td>';
                                            echo '<td rowspan="' . $lineas . '" >' . $serv['servicio']['especial'] . '</td>';
                                            echo '<td rowspan="' . $lineas . '" >' . $serv['servicio']['otros'] . '</td>';
                                            switch ($serv['servicio']['estado']) {
                                                case 0: $estado = 'warning';
                                                    $estadoTxt = 'Pendiente';
                                                    break;
                                                case 1: $estado = 'success';
                                                    $estadoTxt = 'Publicado';
                                                    break;
                                                case 2: $estado = 'info';
                                                    $estadoTxt = 'Asignado';
                                                    break;
                                                case 3: $estado = 'primary';
                                                    $estadoTxt = 'Realizado';
                                                    break;
                                                default :
                                                    $estado = 'danger';
                                                    $estadoTxt = 'Error';
                                                    break;
                                            }
                                            echo '<td rowspan="' . $lineas . '" ><span class="label label-' . $estado . '">' . $estadoTxt . '</span>'
                                            . '<i class="fa ' . $cupo[$serv['servicio']['id']] . '" style="font-size:15px" data-toggle="tooltip" data-placement="top" data-original-title="Cupo Incompleto!"></i>'
                                            . '</td>';
                                            echo '<td rowspan="' . $lineas . '" >
                                    <a onclick="imprimir(' . $serv['servicio']['id'] . ')" name ="imprimir" id="imprimir" value="' . $serv['servicio']['id'] . '" style="width:38px" title="Ver/Imprimir Servicio" class="btn btn-box-tool btn-info">
                                        <i class="fa fa-print txt-primary"></i>
                                    </a> ';
                                            if ($serv['servicio']['estado'] == 0) {
                                                echo '<a onclick="editar(' . $serv['servicio']['id'] . ')" name ="editar" id="editar" value="' . $serv['servicio']['id'] . '" style="width:38px"  data-toggle="tooltip" data-placement="top" data-original-title="Editar Servicio"              class="btn btn-box-tool btn-primary">
                                        <i class="fa fa-pencil txt-primary"></i>
                                    </a> 
                                    <a onclick="eliminar(' . $serv['servicio']['id'] . ')" name ="eliminar" id ="eliminar" value="' . $serv['servicio']['id'] . '" style="width:38px"  data-toggle="tooltip" data-placement="top" data-original-title="Eliminar Servicio"       class="btn btn-box-tool btn-danger">
                                        <i class="fa  fa-trash-o txt-warning"></i>
                                    </a> 
                                    <a onclick="publicar(' . $serv['servicio']['id'] . ')" name ="publicar"  id ="publicar" value="' . $serv['servicio']['id'] . '" style="width:38px"  data-toggle="tooltip" data-placement="top" data-original-title="Publicar Servicio" class="btn btn-box-tool btn-success">
                                        <i class="fa fa-check txt-info"></i>
                                    </a>';
                                            } else {
                                                echo ' <a onclick="ver(' . $serv['servicio']['id'] . ')" name ="ver" id="ver" value="' . $serv['servicio']['id'] . '" style="width:38px"  data-toggle="tooltip" data-placement="top" data-original-title="Ver Postulados al Servicio"              class="btn btn-box-tool btn-primary">
                                        <i class="fa fa-television txt-primary"></i>
                                    </a>';
                                                echo ' <a onclick="realizado(' . $serv['servicio']['id'] . ')" name ="realizado" id ="realizado" value="' . $serv['servicio']['id'] . '" style="width:38px"  data-toggle="tooltip" data-placement="top" data-original-title="Servicio Realizado"       class="btn btn-box-tool btn-danger">
                                        <i class="fa fa-check-square-o txt-danger"></i>
                                    </a>';
                                            }
                                            echo '</td></tr> ';
                                            unset($serv['dias'][0]);
                                            foreach ($serv['dias'] as $dia) {
                                                echo'<tr><td style="display: none;"></td><td style="display: none;"><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td>' . $dia['diaFecha'] . ' ' . substr($dia['desde'], 0, 5) . ' - ' . substr($dia['hasta'], 0, 5) . '</td>
                                        <td>' . $dia['persMasculino'] . '</td>
                                        <td>' . $dia['persFemenino'] . '</td><td style="display: none;"><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td></tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                        <input type="hidden" name="idServicio" id="idServicio">
                        <input type="hidden" name="accion" id="accion">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($listado)) { ?>
    <div id="imprimir" style="display:none">
    <table id="paraImpresion" style="font-size: 11px; border: 2px solid #333131;" width="100%">
            <thead>
                <tr style="border-bottom:  2px solid #2f2f33;">
                    <th rowspan="2"  style="text-align: center;vertical-align: middle">#</th>
                    <th rowspan="2"  style="text-align: center;vertical-align: middle">Fecha<br>Solicitud</th>
                    <th rowspan="2"  style="text-align: center;vertical-align: middle">Comercio<br>Raz&oacute;n Social</th>
                    <th rowspan="2" style="text-align: center;vertical-align: middle">Solicitante</th>
                    <th colspan="3" style="text-align: center;vertical-align: middle">D&iacute;as Servicio</th>
                    <th colspan="3" style="text-align: center;vertical-align: middle">Otros Cuerpos</th>
                    <th rowspan="2" style="text-align: center;vertical-align: middle">Estado</th>
                </tr>
                <tr style="border-bottom:  2px solid #2f2f33;">
                    <th style="text-align: center;">Fecha Servicio</th>
                    <th style="text-align: center;">Masc.</th>
                    <th style="text-align: center;">Fem.</th>
                    <th style="text-align: center;">Mont.</th>
                    <th style="text-align: center;">Espc.</th>
                    <th style="text-align: center;">Otros</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($listado as $serv) {
                    switch ($serv['servicio']['solicitante']) {
                        case 'P': $car = 'Propietario';
                            break;
                        case 'S': $car = 'Socio';
                            break;
                        case 'G': $car = 'Encargado/Gestor';
                            break;
                    }
                    $lineas = sizeof($serv['dias']);
                    echo '<tr style="border-bottom:  1px solid #2f2f33;">
                                    <td style="text-align: center;" rowspan="' . $lineas . '">' . $i++ . '</td>
                                    <td style="text-align: center;" rowspan="' . $lineas . '">' . $serv['servicio']['fechaSolicitud'] . '</td>
                                    <td style="text-align: center;" rowspan="' . $lineas . '">' . $serv['comercio']['comercio'] . '</td>
                                    <td style="text-align: center;" rowspan="' . $lineas . '">' . $serv['servicio']['apellido'] . ', ' . $serv['servicio']['nombre'] . '</td>';
                    echo'<td  style="text-align: center;">' . $serv['dias'][0]['diaFecha'] . ' ' . substr($serv['dias'][0]['desde'], 0, 5) . ' - ' . substr($serv['dias'][0]['hasta'], 0, 5) . '</td>
                                    <td style="text-align: center;">' . $serv['dias'][0]['persMasculino'] . '</td>
                                    <td style="text-align: center;">' . $serv['dias'][0]['persFemenino'] . '</td>';
                    echo '<td style="text-align: center;" rowspan="' . $lineas . '" >' . $serv['servicio']['montado'] . '</td>';
                    echo '<td style="text-align: center;" rowspan="' . $lineas . '" >' . $serv['servicio']['especial'] . '</td>';
                    echo '<td style="text-align: center;" rowspan="' . $lineas . '" >' . $serv['servicio']['otros'] . '</td>';
                    switch ($serv['servicio']['estado']) {
                        case 0: $estado = 'warning';
                            $estadoTxt = 'Pendiente';
                            break;
                        case 1: $estado = 'success';
                            $estadoTxt = 'Publicado';
                            break;
                        case 2: $estado = 'info';
                            $estadoTxt = 'Asignado';
                            break;
                        case 3: $estado = 'primary';
                            $estadoTxt = 'Realizado';
                            break;
                        default :
                            $estado = 'danger';
                            $estadoTxt = 'Error';
                            break;
                    }
                    echo '<td style="text-align: center;" rowspan="' . $lineas . '" ><i><span style="font-style: italic;">' . $estadoTxt . '</span></i>'
                    . '<i class="fa ' . $cupo[$serv['servicio']['id']] . '" style="font-size:12px"></i>'
                    . '</td></tr> ';
                    unset($serv['dias'][0]);
                    foreach ($serv['dias'] as $dia) {
                        echo'<tr  style="border-bottom:  1px solid #2f2f33;">'
                        . '             <td style="display: none;"></td><td style="display: none;"><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="text-align: center;">' . $dia['diaFecha'] . ' ' . substr($dia['desde'], 0, 5) . ' - ' . substr($dia['hasta'], 0, 5) . '</td>
                                        <td style="text-align: center;">' . $dia['persMasculino'] . '</td>
                                        <td style="text-align: center;">' . $dia['persFemenino'] . '</td><td style="display: none;"><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td></tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <?php echo form_close(); ?>
</article>
