<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$r  = format_respuesta_select(select_query($con, "SELECT idTipoUsuario as id, nombreTipo as value FROM tipo_usuario WHERE nombreTipo <> 'Profesor' AND nombreTipo <> 'Soporte' ORDER BY idTipoUsuario ASC"));
	//var_dump($r);exit;
	json_echo($r);
?>
