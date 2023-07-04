	<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//$config['collections']['users']          = 'users';

/*
| -------------------------------------------------------------------------
| Tables.
| -------------------------------------------------------------------------
| Database table names.
*/
$config['tables']['personas']           = 'personas';
$config['tables']['persona_fotos']      = 'persona_fotos';
$config['tables']['caracteristica_personas']      = 'caracteristica_personas';
$config['tables']['tramites']           = 'tramites';
$config['tables']['tdoc']               = 'tipo_documentos';
$config['tables']['tipo_tramites']      = 'tipo_tramites';
$config['tables']['domicilios']         = 'domicilios';
$config['tables']['persona_domicilios'] = 'persona_domicilios';
$config['tables']['calles']             = 'calles';
$config['tables']['barrios']            = 'barrios';
$config['tables']['localidades']        = 'localidades';
$config['tables']['departamentos']      = 'departamentos';
$config['tables']['parentescos']        = 'parentescos';
$config['tables']['tramites']           = 'tramites';
$config['tables']['detalle_tramites']   = 'detalle_tramites';
$config['tables']['tipo_parentescos']   = 'tipo_parentescos';
$config['tables']['dependencias']       = 'dependencias';
$config['tables']['lote_estampillas']   = 'lote_estampillas';
$config['tables']['tipo_estampillas']   = 'tipo_estampillas';
$config['tables']['pais']               = 'paises';
$config['tables']['provi']              = 'provincias';
$config['tables']['depa']               = 'departamentos';
$config['tables']['estado']             = 'estado_civil';
$config['tables']['comercio']           = 'comercios';
$config['tables']['juridicas']          = 'juridicas';
$config['tables']['rubros']             = 'rubros';
$config['tables']['grupo_rubros']       = 'grupo_rubros';
$config['tables']['actividades']        = 'actividades';
$config['tables']['dependencias']       = 'dependencias';
$config['tables']['jerarquias']         = 'jerarquias';
$config['tables']['banda']              = 'banda';
$config['tables']['emptel']             = 'empresa_telefonicas';
$config['tables']['ttel']               = 'tipo_telefonos';
$config['tables']['tel']                = 'telefonos';
$config['tables']['tipdom']             = 'tipo_domicilios';
$config['tables']['categ']              = 'categoria_calles';
$config['tables']['estudio']            = 'escolaridades';
$config['tables']['mil']                = 'servicio_militar';
$config['tables']['involucrados']       = 'involucrados';
$config['tables']['hechos']             = 'hechos';
$config['tables']['delitos']            = 'delitos';
$config['tables']['denuncias']          = 'denuncias';
$config['tables']['personas_nn']        = 'personas_nn';
$config['tables']['capturas']           = 'capturas';
$config['tables']['captura_solicitudes']= 'captura_solicitudes';
$config['tables']['tipo_capturas']      = 'tipo_capturas';
$config['tables']['acumulados']         = 'acumulados';
$config['tables']['denuncias']          = 'denuncias';
$config['tables']['sumarios']           = 'sumarios';
$config['tables']['caratulas']          = 'caratulas';
$config['tables']['expedientes']        = 'expedientes';
$config['tables']['oficios']            = 'oficios';
$config['tables']['resoluciones']       = 'resoluciones';
$config['tables']['tipo_resoluciones']  = 'tipo_resoluciones';
$config['tables']['causas']             = 'causas';
$config['tables']['tipo_causas']        = 'tipo_causas';
$config['tables']['inculpados']         = 'inculpados';
$config['tables']['inculpado_capturas'] = 'inculpado_capturas';
$config['tables']['inculpado_resoluciones'] = 'inculpado_resoluciones';
$config['tables']['turno_personas']     = 'turno_personas';
$config['tables']['turnos']             = 'turnos';
$config['tables']['persona_firmas']     = 'persona_firmas';
$config['tables']['captura_archivos']   = 'captura_archivos';
$config['tables']['orden_dias']         = 'orden_dias';
$config['tables']['nuevos_prontuarios'] = 'nuevos_prontuarios';
$config['tables']['tipo_delitos']       = 'tipo_delitos';
$config['tables']['cambio_sexo']        = 'cambio_sexo';
$config['tables']['personal']           = 'personal';
$config['tables']['domhist']           = 'domicilio_historiales';

$config['tables']['usuarios']           = 'usuarios';
$config['tables']['turno_personas'] = 'turnos_planilla_web.turno_personas';
$config['tables']['turnos']                = 'turnos_planilla_web.turnos';
$config['tables']['parametros']        = 'turnos_planilla_web.turno_parametros';
$config['tables']['feriados']        = 'turnos_planilla_web.turno_feriados';

/*
 | Users table column and Group table column you want to join WITH.
 |
 */

$config['join']['personas']    = 'id_persona';
$config['join']['tramites']    = 'id_tramite';

// CONSTANTES

/*
$config['cte']['convivencia']   = 2;
$config['cte']['residencia']    = 1;
$config['cte']['bailes']        = 3;
*/

?>
