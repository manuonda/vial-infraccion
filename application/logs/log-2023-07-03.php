<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-07-03 13:04:11 --> The session cookie data did not match what was expected. This could be a possible hacking attempt.
ERROR - 2023-07-03 13:04:20 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;fecha_desde&quot; does not exist
LINE 1: ...&quot;password&quot;, &quot;active&quot;, &quot;last_login&quot;, &quot;read_write&quot;, &quot;fecha_des...
                                                             ^ C:\xampp\htdocs\vial\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2023-07-03 13:04:20 --> Query error: ERROR:  column "fecha_desde" does not exist
LINE 1: ..."password", "active", "last_login", "read_write", "fecha_des...
                                                             ^ - Invalid query: SELECT "username", "id_dependencia", "per"."legajo", "j"."nombre" AS "jerarquia", "p"."apellido", "p"."nombre", "p"."cuil", "p"."email", "id", "password", "active", "last_login", "read_write", "fecha_desde", "fecha_hasta"
FROM "public"."usuarios"
LEFT JOIN "personas" "p" ON "public"."usuarios"."cuil"="p"."cuil"
LEFT JOIN "personal" "per" ON "p"."cuil"="per"."cuil"
LEFT JOIN "jerarquias" "j" ON "per"."id_jerarquia"="j"."id_jerarquia"
WHERE "username" = 'vial'
 LIMIT 1
ERROR - 2023-07-03 13:05:17 --> 404 Page Not Found: Faviconico/index
ERROR - 2023-07-03 13:05:47 --> 404 Page Not Found: Configuraciones/favicon.ico
ERROR - 2023-07-03 08:35:57 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:35:57 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:35:57 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 08:35:57 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 08:35:58 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 08:35:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 08:35:59 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:35:59 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 08:36:02 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 08:36:02 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:36:02 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:36:17 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:36:17 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:36:17 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:36:17 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 08:36:21 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 08:36:21 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:36:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:36:31 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:36:31 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:36:31 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:36:31 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:36:31 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:36:31 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:36:31 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:36:31 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:36:31 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 08:36:58 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 08:36:58 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:36:58 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:37:15 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:15 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:15 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:15 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:16 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:16 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:16 --> Severity: Notice --> Trying to get property 'nombre' of non-object C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 304
ERROR - 2023-07-03 08:37:16 --> Severity: Notice --> Trying to get property 'apellido' of non-object C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 304
ERROR - 2023-07-03 08:37:16 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:16 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:16 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:16 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 08:37:19 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 08:37:19 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:37:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:37:31 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:31 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:32 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:32 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:32 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:32 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:32 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:32 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:32 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:32 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 08:37:39 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 08:37:39 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:37:39 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:37:47 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:47 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:47 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:47 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:47 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:47 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:47 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:37:47 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:37:47 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 08:38:23 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 08:38:23 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:38:23 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:38:33 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:38:33 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:38:33 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:38:33 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:38:33 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:38:33 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:38:33 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:38:33 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:38:33 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 08:38:45 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 08:38:45 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:38:45 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:38:55 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:38:55 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:38:55 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:38:55 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:38:55 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:38:55 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:39:01 --> Severity: Compile Error --> Redefinition of parameter $configuracion C:\xampp\htdocs\vial\application\libraries\Comprobante.php 368
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 08:39:11 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 08:39:11 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:39:11 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 08:39:12 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 08:39:12 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 08:39:12 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 08:39:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 08:39:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:39:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 08:39:20 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:39:20 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 08:39:20 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 08:39:20 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 09:26:25 --> Severity: Warning --> pg_query(): Query failed: ERROR:  value &quot;20335507992&quot; is out of range for type integer
LINE 4: WHERE &quot;dni&quot; = '20335507992'
                      ^ C:\xampp\htdocs\vial\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2023-07-03 09:26:25 --> Query error: ERROR:  value "20335507992" is out of range for type integer
LINE 4: WHERE "dni" = '20335507992'
                      ^ - Invalid query: SELECT "public"."personas"."nombre" as "nombre", "public"."personas"."apellido" as "apellido", "public"."personas"."dni" as "dni", "public"."personas"."cuil" as "cuil", "public"."personas"."fecha_nacimiento" as "fechaNacimiento", "public"."personas"."sexo" as "sexo", "public"."personas"."nacionalidad", "public"."tipo_documentos"."tipo_documento" as "tipoDocumento"
FROM "public"."personas"
LEFT JOIN "public"."tipo_documentos" ON "public"."personas"."id_tipo_documento" = "public"."tipo_documentos"."id_tipo_documento"
WHERE "dni" = '20335507992'
ERROR - 2023-07-03 15:32:17 --> 404 Page Not Found: Faviconico/index
ERROR - 2023-07-03 10:32:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 10:32:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 10:32:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 10:32:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 10:32:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 10:32:19 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 10:32:19 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 10:32:19 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 10:32:20 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 10:32:20 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 10:32:20 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 10:32:20 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 10:32:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 10:32:32 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:32:32 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:32:33 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:32:33 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 10:35:01 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 10:35:01 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 10:35:01 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 10:35:11 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:35:11 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:35:11 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:35:11 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:35:11 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:35:11 --> Severity: Notice --> Trying to get property 'nombre' of non-object C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 304
ERROR - 2023-07-03 10:35:11 --> Severity: Notice --> Trying to get property 'apellido' of non-object C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 304
ERROR - 2023-07-03 10:35:11 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:35:11 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:35:11 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:35:11 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 10:36:13 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 10:36:13 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 10:36:13 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 10:36:24 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:36:24 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:36:24 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:36:24 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:36:25 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:36:25 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:36:25 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:36:25 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:36:25 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 10:37:00 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 10:37:00 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 10:37:00 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 10:37:11 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:37:11 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:37:12 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:37:12 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:37:12 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:37:12 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:37:12 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 10:37:12 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 329
ERROR - 2023-07-03 10:37:12 --> Severity: Notice --> Undefined property: stdClass::$dni_involucrado C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 336
ERROR - 2023-07-03 15:39:04 --> 404 Page Not Found: Faviconico/index
ERROR - 2023-07-03 15:41:48 --> Unable to connect to the database
ERROR - 2023-07-03 15:41:48 --> Severity: Notice --> Unknown: Cannot set connection to blocking mode Unknown 0
ERROR - 2023-07-03 15:42:28 --> Severity: Warning --> pg_pconnect(): Unable to connect to PostgreSQL server: could not connect to server: No route to host (0x00002751/10065)
	Is the server running on host &quot;192.168.0.81&quot; and accepting
	TCP/IP connections on port 5432? C:\xampp\htdocs\vial\system\database\drivers\postgre\postgre_driver.php 153
ERROR - 2023-07-03 15:42:28 --> Unable to connect to the database
ERROR - 2023-07-03 11:05:12 --> Severity: Notice --> Undefined variable: titulo C:\xampp\htdocs\vial\application\views\template.php 153
ERROR - 2023-07-03 16:05:12 --> 404 Page Not Found: Faviconico/index
ERROR - 2023-07-03 16:05:48 --> 404 Page Not Found: Configuraciones/favicon.ico
ERROR - 2023-07-03 16:10:48 --> The session cookie data did not match what was expected. This could be a possible hacking attempt.
ERROR - 2023-07-03 16:10:48 --> The session cookie data did not match what was expected. This could be a possible hacking attempt.
ERROR - 2023-07-03 16:12:19 --> 404 Page Not Found: Faviconico/index
ERROR - 2023-07-03 16:12:28 --> 404 Page Not Found: Configuraciones/favicon.ico
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 11:14:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 11:14:53 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 11:14:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 11:14:53 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:14:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:15:06 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for integer: &quot;favicon.ico&quot;
LINE 3: WHERE &quot;id_infraccion&quot; = 'favicon.ico'
                                ^ C:\xampp\htdocs\vial\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2023-07-03 11:15:06 --> Query error: ERROR:  invalid input syntax for integer: "favicon.ico"
LINE 3: WHERE "id_infraccion" = 'favicon.ico'
                                ^ - Invalid query: SELECT *
FROM "infracciones"."infracciones"
WHERE "id_infraccion" = 'favicon.ico'
ERROR - 2023-07-03 11:21:54 --> Severity: Notice --> Undefined variable: titulo C:\xampp\htdocs\vial\application\views\template.php 153
ERROR - 2023-07-03 11:30:31 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:30:31 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:30:31 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 11:30:31 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 11:30:32 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:30:32 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 11:30:33 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 11:30:33 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:30:33 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:30:52 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:30:52 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:30:52 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 11:30:53 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 11:30:53 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:30:53 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:31:01 --> Severity: Notice --> Trying to get property 'nombre' of non-object C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 481
ERROR - 2023-07-03 11:31:01 --> Severity: Notice --> Trying to get property 'apellido' of non-object C:\xampp\htdocs\vial\application\controllers\Infraccionvial.php 481
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 11:31:04 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 11:31:04 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:31:04 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:37:12 --> Severity: error --> Exception: Too few arguments to function Infraccionpago::index(), 0 passed in C:\xampp\htdocs\vial\system\core\CodeIgniter.php on line 532 and exactly 1 expected C:\xampp\htdocs\vial\application\controllers\InfraccionPago.php 62
ERROR - 2023-07-03 11:37:20 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:37:20 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:37:20 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 11:37:20 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 11:37:21 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 16:37:21 --> 404 Page Not Found: Faviconico/index
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16893
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 16896
ERROR - 2023-07-03 11:37:21 --> Severity: Warning --> "continue" targeting switch is equivalent to "break". Did you mean to use "continue 2"? C:\xampp\htdocs\vial\application\libraries\tcpdf\tcpdf.php 17778
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_images.php 318
ERROR - 2023-07-03 11:37:21 --> Severity: Warning --> chr() expects parameter 1 to be int, string given C:\xampp\htdocs\vial\application\libraries\tcpdf\include\tcpdf_fonts.php 1671
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 526
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 527
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 538
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 539
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 541
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Shared\String.php 542
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2551
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2672
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2676
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2764
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2768
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 2780
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3034
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3166
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3168
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3169
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3457
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3460
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3461
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3891
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3936
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3942
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 3998
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Calculation.php 4001
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 11:37:21 --> Severity: 8192 --> Array and string offset access syntax with curly braces is deprecated C:\xampp\htdocs\vial\application\libraries\PHPExcel\PHPExcel\Worksheet\AutoFilter.php 720
ERROR - 2023-07-03 17:10:09 --> 404 Page Not Found: Configuraciones/favicon.ico
ERROR - 2023-07-03 12:22:50 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for integer: &quot;favicon.ico&quot;
LINE 3: WHERE &quot;id_infraccion&quot; = 'favicon.ico'
                                ^ C:\xampp\htdocs\vial\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2023-07-03 12:22:50 --> Query error: ERROR:  invalid input syntax for integer: "favicon.ico"
LINE 3: WHERE "id_infraccion" = 'favicon.ico'
                                ^ - Invalid query: SELECT *
FROM "infracciones"."infracciones"
WHERE "id_infraccion" = 'favicon.ico'
ERROR - 2023-07-03 17:22:50 --> 404 Page Not Found: Configuraciones/favicon.ico
ERROR - 2023-07-03 17:22:53 --> 404 Page Not Found: Faviconico/index
ERROR - 2023-07-03 17:30:35 --> 404 Page Not Found: Configuraciones/favicon.ico
ERROR - 2023-07-03 17:31:53 --> 404 Page Not Found: Configuraciones/create%C3%A7
ERROR - 2023-07-03 12:31:56 --> Severity: Notice --> Undefined variable: tipoInfracciones C:\xampp\htdocs\vial\application\controllers\Configuraciones.php 47
ERROR - 2023-07-03 12:31:56 --> Severity: Notice --> Undefined variable: tipoUnidades C:\xampp\htdocs\vial\application\controllers\Configuraciones.php 48
ERROR - 2023-07-03 12:31:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\vial\application\views\leyes\create_view.php 33
ERROR - 2023-07-03 12:31:56 --> Severity: Notice --> Undefined variable: tipoTramites C:\xampp\htdocs\vial\application\views\leyes\create_view.php 49
ERROR - 2023-07-03 12:31:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\vial\application\views\leyes\create_view.php 49
ERROR - 2023-07-03 12:31:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\vial\application\views\leyes\create_view.php 69
ERROR - 2023-07-03 17:31:56 --> 404 Page Not Found: Configuraciones/favicon.ico
ERROR - 2023-07-03 12:32:23 --> Severity: error --> Exception: Too few arguments to function Configuraciones::editar(), 0 passed in C:\xampp\htdocs\vial\system\core\CodeIgniter.php on line 532 and exactly 1 expected C:\xampp\htdocs\vial\application\controllers\Configuraciones.php 57
ERROR - 2023-07-03 12:32:31 --> Severity: Notice --> Undefined variable: titulo C:\xampp\htdocs\vial\application\views\template.php 153
ERROR - 2023-07-03 17:32:32 --> 404 Page Not Found: Faviconico/index
ERROR - 2023-07-03 17:32:36 --> 404 Page Not Found: Configuraciones/favicon.ico
ERROR - 2023-07-03 12:59:52 --> Severity: Notice --> Undefined variable: tipoInfracciones C:\xampp\htdocs\vial\application\controllers\Configuraciones.php 47
ERROR - 2023-07-03 12:59:52 --> Severity: Notice --> Undefined variable: tipoUnidades C:\xampp\htdocs\vial\application\controllers\Configuraciones.php 48
ERROR - 2023-07-03 12:59:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\vial\application\views\leyes\create_view.php 33
ERROR - 2023-07-03 12:59:52 --> Severity: Notice --> Undefined variable: tipoTramites C:\xampp\htdocs\vial\application\views\leyes\create_view.php 49
ERROR - 2023-07-03 12:59:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\vial\application\views\leyes\create_view.php 49
ERROR - 2023-07-03 12:59:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\vial\application\views\leyes\create_view.php 69
ERROR - 2023-07-03 17:59:53 --> 404 Page Not Found: Configuraciones/favicon.ico
