<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
		"SELECT idSede  as id, nombreSede as value FROM sedes
		WHERE activo = 1 ORDER BY nombreSede ASC")));
?>
