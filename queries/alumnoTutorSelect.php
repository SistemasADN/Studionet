<?php
	//$_POST['idCliente'] = 12;
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
	'SELECT a.idAlumno as id, pc.nombre as value, pcc.nombre as subtext
	FROM alumnos as a
	LEFT JOIN clientes as c ON a.idTutor = c.idCliente
	LEFT JOIN personacompleta as pc ON a.idPersona = pc.idPersona
	LEFT JOIN personacompleta as pcc ON c.idPersona = pcc.idPersona
	WHERE a.activo = 1')));//
?>
