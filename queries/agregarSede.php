<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["nombreSede"] = 		['r' => true,  't' => "alphnum"];
	//Direccion
	$rules = setDireccionRules($rules, "Sum");
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$_POST['idDireccion'] = insert_direccion($con, $_POST);
	$idSede = insert_id_query($con, "INSERT INTO sedes (nombreSede, idDireccion) VALUES (?,?)", 'si',
	[$_POST['nombreSede'], $_POST['idDireccion']], "e|Agregar Sede|No se pudo agregar el sede. ");

	if(execute_query($con, "INSERT INTO conceptos (nombreConcepto, precioUnitario, idSede) VALUES ('Recargo',1.00,?)", 'i',
		[$idSede], false)) {
		echo "s|Agregar Sede|Sede agregada correctamente. ";
		mysqli_commit($con);
	}else{
		echo "e|Agregar Sede|No se pudo agregar el sede. ";
	}
?>
