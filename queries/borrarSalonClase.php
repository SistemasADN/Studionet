<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['idSalonGrupo'] =['r' => true , 	't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	if(execute_query($con, "DELETE FROM horario WHERE idSalonGrupo = ?", 'i', $_POST, false)){
		if(execute_query($con, "DELETE FROM salon_grupo WHERE idSalonGrupo = ?", 'i', $_POST, true)){
			echo "s|Borrar clase de salón|Salón borrado exitosamente.";
		}else{
			echo "e|Borrar clase de salón|No se pudo borrar el salón. ";
		}
	}else{
		echo "e|Borrar clase de salón|No se pudo borrar los horarios del salón.";
	}

?>
