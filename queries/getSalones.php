<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	session_start();
	json_echo(select_query($con, "SELECT s.idSalon, s.nombreSalon, s.idSede, s.activo FROM
		 salones AS s WHERE s.idSede = ?", 'i', [$_SESSION['idSede']]));
?>
