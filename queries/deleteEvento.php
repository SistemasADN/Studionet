<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['idAgenda'] = ["t"=>'num', "r"=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	if(execute_query($con, 'DELETE FROM agenda WHERE idAgenda = ?', 'i', $_POST)){
		echo "s|Borrar Evento|Evento borrado correctamente. ";
	}else{
		echo "e|Borrar Evento|No se pudo borrar el evento. ";
	}
?>
