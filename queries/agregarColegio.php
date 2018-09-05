<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
    strtolower($_POST['correo']);
	$rules["nombreColegio"] = 		['r' => true,  't' => "alphnum"];
    $rules["nombreContacto"] =      ['r' => false, 't' => "alphnum"];
    $rules["correo"] =              ['r' => false, 't' => "email"];
    $rules["puesto"] =              ['r' => false, 't' => "alphnum"];
    $rules["telefono"] =            ['r' => false, 't' => "tel"];
    $rules["telefonoOtro"] =        ['r' => false, 't' => "tel"];
	//Direccion
	$rules = setDireccionRules($rules, "Sum");
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$_POST['idDireccion'] = insert_direccion($con, $_POST);
	if(insert_query($con, "
      INSERT INTO colegios (colegio, idDireccion, nombreContacto, correo, puesto, telefono, telefonoOtro) VALUES (?,?,?,?,?,?,?)", 'sisssss', reorder_array_keys($_POST, ['nombreColegio', 'idDireccion', 'nombreContacto', 'correo', 'puesto', 'telefono', 'telefonoOtro']))){
		echo "s|Agregar Colegio|Colegio agregada correctamente. ";
	}else{
		echo "e|Agregar Colegio|No se pudo agregar el colegio. ";
	}
	
?>