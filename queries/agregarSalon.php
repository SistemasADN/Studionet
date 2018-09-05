<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['nombreSalon'] = ['r' => true , 	't' => "alphnum"];
  $rules['idSede'] = ['r' => true , 	't' => "num"];
	session_start();
	$_POST['idSede'] = $_SESSION['idSede'];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	if(insert_query($con, "INSERT INTO salones (nombreSalon, idSede) VALUES (?,?)", 'si', $_POST)){
		echo "s|Agregar Salon|Salon agregado correctamente. ";
	}else{
		echo "e|Agregar Salon|No se pudo agregar el salon. ";
	}
?>
