<?php
	//$_POST['idCliente'] = 12;
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include "getIdSede.php";
	json_echo(format_respuesta_select(select_query($con,
	'SELECT idConcepto as id, nombreConcepto as value, precioUnitario as subtext
	FROM conceptos WHERE activo = 1 AND idSede = ?', 'i', [$idSede])));
?>
