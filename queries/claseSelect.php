<?php
	//$_POST['idCliente'] = 12;
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
	'SELECT c.idClase as id, CONCAT(a.nombreAsignatura, " - ", n.nombreNivel) as value, c.precioEstandard
	FROM clases as c
	LEFT JOIN asignaturas as a ON c.idAsignatura = a.idAsignatura
	LEFT JOIN niveles as n ON n.idNivel = c.idNivel
	WHERE c.activo = 1')));
?>
