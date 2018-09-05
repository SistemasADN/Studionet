<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  include "getIdSede.php";
	json_echo(format_respuesta_select(select_query($con, "SELECT idGrupo as id, nombreGrupo as value FROM grupos WHERE idSede = ? AND activo = 1", 'i', [$idSede])));
?>
