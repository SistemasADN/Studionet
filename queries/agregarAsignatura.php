<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['nombreAsignatura'] = ['r' => true , 	't' => "alphnum"];
  $rules['disciplinaSearch'] = ['r' => true , 	't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	if(insert_query($con, "INSERT INTO asignaturas (nombreAsignatura, idDisciplina)
	VALUES (?,?)", 'si', $_POST)){
		echo "s|Agregar Asignatura|Asignatura agregada correctamente. ";
	}else{
		echo "e|Agregar Asignatura|No se pudo agregar la Asignatura. ";
	}
?>
