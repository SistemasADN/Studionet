<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$validator->setRulesValidateArrayEcho(array(), $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
	'SELECT idTipoEgreso as id, nombre as value FROM egresos_tipo ORDER BY nombre ASC')));
?>
