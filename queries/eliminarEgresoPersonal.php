<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["idEgreso"] =		 		['r' => true,  't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);

	include "dbcon.php";
	if(execute_query($con, "DELETE FROM egresos_personal WHERE idEgresoPersonal = ?", 'i', $_POST)){
		echo "s|Baja egreso|Egreso eliminado correctamente. ";
	}else{
		echo "e|Baja egreso|No se pudo eliminar el egreso. ";
	}
?>
