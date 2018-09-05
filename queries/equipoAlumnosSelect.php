<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  $respuesta = format_respuesta_select(select_query($con, "SELECT eq.idEquipo as id,
		eq.nombreEquipo as value,
		e.nombreSede as subtext
	FROM equipos as eq
	LEFT JOIN sedes as e ON e.idSede = eq.idSede WHERE eq.activo = 1"));
  foreach($respuesta as $k=>$equipo) {
      $respuesta[$k]['data-alumnos'] = select_query($con, "SELECT idAlumno FROM
        alumnos_equipos WHERE idEquipo = ? AND fechaBaja IS NULL", 'i', [$equipo['id']]);
  }
  json_echo($respuesta);
?>
