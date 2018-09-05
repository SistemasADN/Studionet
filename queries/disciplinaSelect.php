<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con, "SELECT idDisciplina as id, nombreDisciplina as value FROM disciplinas WHERE activo = 1 ORDER BY nombreDisciplina ASC")));
?>
