<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['nombreGrado'] =      ['r' => true , 	't' => "alphnum"];
	$rules['estatus'] =          ['r' => true , 	't' => "bool"];
	$rules['idGrado'] =          ['r' => true , 	't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	if(execute_query($con, "UPDATE grados SET nombreGrado = ?, activo = ? WHERE idGrado = ?", 'sii', reorder_array_keys($_POST, ['nombreGrado', 'estatus', 'idGrado']))){
		echo "s|Editar Grado Escolar|Grado editado correctamente. ";
	}else{
		echo "e|Editar Grado Escolar|No se pudo editar el grado. ";
	}
?>
