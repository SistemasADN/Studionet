<?php
	//$_POST['idCliente'] = 12;
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
	'SELECT a.idAlumno as id, pc.nombre as value FROM alumnos as a
	LEFT JOIN personacompleta as pc ON a.idPersona = pc.idPersona
	WHERE a.activo = 1 ORDER BY value ASC')));//
?>
