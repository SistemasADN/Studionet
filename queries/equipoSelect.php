<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include "getIdSede.php";
	json_echo(format_respuesta_select(select_query($con,
		"SELECT eq.idEquipo as id,
			eq.nombreEquipo as value,
			e.nombreSede as subtext
				FROM equipos as eq
				LEFT JOIN sedes as e ON e.idSede = eq.idSede
				WHERE eq.activo = 1 AND e.idSede = ?", 'i', [$idSede])));
?>
