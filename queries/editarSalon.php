<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
    //var_dump($_POST);exit;
	$rules['nombreSalon'] =      ['r' => true , 	't' => "alphnum"];
	$rules['estatus'] =          ['r' => true , 	't' => "bool"];
    $rules['idSalon'] =          ['r' => true , 	't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	if(execute_query($con, "UPDATE salones SET nombreSalon = ?, activo = ? WHERE idSalon = ?", 'sii', reorder_array_keys($_POST, ['nombreSalon', 'estatus', 'idSalon']))){
		echo "s|Editar Salon|Salon editado correctamente. ";
	}else{
		echo "e|Editar Salon|No se pudo editar el salon. ";
	}
?>
