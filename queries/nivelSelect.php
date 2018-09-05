<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
    include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,"SELECT idNivel as id, nombreNivel as value FROM niveles WHERE activo = 1 ORDER BY nombreNivel ASC")));

?>
