<?php
	
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
    //var_dump($_POST);
	$rules['nombreNivel'] =      ['r' => true , 	't' => "alphnum"];
	$rules['estatus'] =          ['r' => true , 	't' => "bool"];
	$rules['idNivel'] =          ['r' => true , 	't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	if(execute_query($con, "UPDATE niveles SET nombreNivel = ?, activo = ? WHERE idNivel = ?", 'sii', reorder_array_keys($_POST, ['nombreNivel', 'estatus', 'idNivel']))){
		echo "s|Editar Nivel|Nivel editado correctamente. ";
	}else{
		echo "e|Editar Nivel|No se pudo editar el nivel. ";
	}
?>