<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['precioEstandard'] =     ['r' => true , 	't' => "coin"];
    $rules['asignaturaSearch'] = 	['r' => true , 	't' => "num"];
    $rules['nivelSearch'] =      	['r' => true , 	't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	if(insert_query($con, "INSERT INTO clases (idAsignatura, idNivel, precioEstandard) VALUES (?,?,?)", 'iid', $_POST)){
		echo "s|Agregar Clase|Clase agregada correctamente. ";
	}else{
		echo "e|Agregar Clase|No se pudo agregar la clase. ";
	}
?>
