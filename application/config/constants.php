<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/*** Se define constantes del sistemas **/
define('PERSONA_FISICA',1);
define('PERSONA_JURIDICA',2);

define('TIPO_INFRACCION_COMERCIAL',1);
define('TIPO_INFRACCION_VIAL',2);
define('TIPO_INFRACCION_OTRA',3);

define('ESTADO_ARCHIVAR',2);
define('ESTADO_ARCHIVAR_NOMBRE','ARCHIVAR');


//Tipo de infraccion
define('TIPO_INFRACCION_VIAL_C','V');
define('TIPO_INFRACCION_COMERCIAL_C','C');


//Referencia a estado de PAGO DE CUOTAS 
define('CUOTA_PAGADA','CUOTA_PAGADA');
define('CUOTA_NO_PAGADA','CUOTA_NO_PAGADA');

//Tipo de Pago 
define('TIPO_PAGO_CONTADO','TIPO_PAGO_CONTADO');
define('TIPO_PAGO_CUOTAS','TIPO_PAGO_CUOTAS');
define('TIPO_PAGO_TARJETA','TIPO_PAGO_TARJETA');

//Estado de infraccion Vial 
define('INFRACCION_PAGO_NO_GENERADO','INFRACCION_PAGO_NO_GENERADO');
define('INFRACCION_PAGO_COMPLETO','PAGO_COMPLETO');
define('INFRACCION_PAGO_INCOMPLETO','PAGO_INCOMPLETO');
define('INFRACCION_PAGO_EXHIMIDO','EXHIMIDO');

// Se define para el tipo de PAGO 
define('FES', 'FES');
define('BANCO','BANCO');
define('TARJETA_DEBITO','TARJETA_DEBITO');
define('TARJETA_CREDITO','TARJETA_CREDITO');


//Se define para configuracion 
define('CONFIGURACION','CONFIGURACION');
define('LEY_ALCOHOLEMIA','LEY_ALCOHOLEMIA');
define('LEY_GENERAL','LEY_GENERAL');



define('RUTA_PRINCIPAL', "http://" . $_SERVER['HTTP_HOST'] . "/contravenciones/");
/* End of file constants.php */
/* Location: ./application/config/constants.php */