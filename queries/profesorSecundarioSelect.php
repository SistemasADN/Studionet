<?php
	//$_POST['idCliente'] = 12;
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$rules['idProfesor'] = ["r"=>true, 't'=>'num'];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$r = format_respuesta_select(select_query($con,
	'SELECT p.idPersonal as id, pc.nombre as value FROM personal as p LEFT JOIN personacompleta as pc ON p.idPersona = pc.idPersona LEFT JOIN tipo_personal as tp
	ON tp.idTipoPersonal = p.idTipoPersonal WHERE tp.tipo = "Profesor" AND p.activo = 1 AND p.idPersonal <> ?', 'i', $_POST));
	json_echo($r);

?>
