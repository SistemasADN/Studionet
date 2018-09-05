<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include "getIdSede.php";
	$_POST['idSede'] = $idSede;
	json_echo(select_query($con, "SELECT * FROM conceptos WHERE idSede = ? AND nombreConcepto <> 'recargo'", 'i', $_POST));
?>
