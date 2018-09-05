<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con, "SELECT idModalidadPago as id, modalidad as value FROM modalidad_pago ORDER BY modalidad ASC")));
?>
