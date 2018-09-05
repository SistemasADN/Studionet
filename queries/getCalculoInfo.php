<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$respuesta['calculo'] = select_query($con, "SELECT idCalculoPagos, formaCalculo FROM forma_calculos WHERE activo = 1");
	$respuesta['detalles'] = select_query($con, "SELECT idDisciplina, veceshorasdias, cuota FROM forma_calculos_detalle");
	$respuesta['disciplinas'] = select_query($con, "SELECT idDisciplina, nombreDisciplina FROM disciplinas");
	$respuesta['cuotaMensual'] = select_query($con, "SELECT cuota FROM forma_calculos_detalle");
	json_echo($respuesta);
?>
