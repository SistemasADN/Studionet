<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['nombreNivel'] = 				['r' => true , 	't' => "alphnum"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	if(insert_query($con, "INSERT INTO niveles (nombreNivel) VALUES (?)", 's', $_POST)){
		echo "s|Agregar Nivel|Nivel agregada correctamente. ";
	}else{
		echo "e|Agregar Nivel|No se pudo agregar el nivel. ";
	}
?>
