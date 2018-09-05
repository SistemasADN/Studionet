<?php
	//$_POST['idCliente'] = 12;
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
	'SELECT p.idPersonal as id, pc.nombre as value FROM personal as p LEFT JOIN personacompleta as pc ON p.idPersona = pc.idPersona LEFT JOIN tipo_personal as tp
	ON tp.idTipoPersonal = p.idTipoPersonal WHERE tp.tipo = "Profesor" AND p.activo = 1')));//
?>
