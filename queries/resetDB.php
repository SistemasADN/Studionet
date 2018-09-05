<?php
  include "../validation/classValidator.php";
  $validator = new Validator();
  exit;
  $rules = array();
  $rules['pollo'] = ['t'=>'num', 'r'=>true];
  $validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";
  mysqli_autocommit($con, FALSE);
  $tablas = ['admin_sede', 'agenda', 'agenda_equipos', 'alumnos', 'alumnos_equipos', 'alumnos_grupos', 'asignaturas', 'asistencia', 'asistencia_alumno',
  'clases', 'clientes', 'colegios', 'conceptos', 'contacto', 'cuentas', 'cuentas_sedes', 'direccion', 'disciplinas', 'egresos', 'egresos_personal', 'equipos',
  'equipos_grupo', 'equipos_historico', 'facturacion', 'grados', 'grupos', 'grupo_profesor', 'horario', 'ingresos', 'mensaje', 'mensaje_lista_envio', 'niveles',
  'pagos_aplicados', 'pagos_recibidos', 'personal', 'personal_usuario', 'personas', 'recibo_pago', 'recibo_pago_lista', 'salones', 'salon_grupo', 'sedes',
   'usuarios'];
   execute_query($con, 'SET FOREIGN_KEY_CHECKS = 0;', false);
  foreach($tablas as $table){
    execute_query($con, "TRUNCATE $table;");
    execute_query($con, "ALTER TABLE $table AUTO_INCREMENT = 1;", '', [], false) or die ("Error en tabla: $table ".mysqli_error($con));
  }
  execute_query($con, 'SET FOREIGN_KEY_CHECKS = 1;', false);
  echo "All good";
  mysqli_commit($con);
?>
