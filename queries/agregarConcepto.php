<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['nombreConcepto'] = ['r' => true , 	't' => "alphnum"];
    $rules['precioUnitario'] = ['r' => true , 	't' => "dec"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include "getIdSede.php";
	$_POST['idSede'] = $idSede;
	if(insert_query($con, "INSERT INTO conceptos (nombreConcepto, precioUnitario, idSede) VALUES (?,?,?)", 'ssi', $_POST)){
		echo "s|Agregar Concepto|Concepto agregado correctamente. ";
	}else{
		echo "e|Agregar Concepto|No se pudo agregar el concepto. ";
	}
?>
