<?php
	
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['nombreGrado'] = 				['r' => true , 	't' => "alphnum"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	if(insert_query($con, "INSERT INTO grados (nombreGrado) VALUES (?)", 's', $_POST)){
		echo "s|Agregar Grado|Grado agregado correctamente. ";
	}else{
		echo "e|Agregar Grado|No se pudo agregar el Grado. ";
	}
?>