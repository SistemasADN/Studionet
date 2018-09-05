<?php
	include "../validation/classValidator.php";

	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["idAlumno"] =		 		['r' => true,  't' => "num"];
	$rules["idEquipo"] =			 		['r' => true,  't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	
	$_POST['fechaBaja'] = date("Y-m-d");
	
	if(execute_query($con, "UPDATE alumnos_equipos SET fechaBaja = ? WHERE idAlumno = ? AND idEquipo = ?", 'sii', reorder_array($_POST, ['fechaBaja', 'idAlumno', 'idEquipo']))){
		echo "s|Baja alumno|Se ha dado de baja el alumno de este equipo correctamente. ";
	}else{
		echo "e|Baja alumno|No se pudo dar de baja al alumno del equipo. ";
	}
?>