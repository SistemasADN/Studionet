<?php
	include "../validation/classValidator.php";

	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["idAlumno"] =		 		['r' => true,  't' => "num"];
	$rules["idGrupo"] =			 		['r' => true,  't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";

	$_POST['fechaBaja'] = date("Y-m-d");

	if(execute_query($con, "UPDATE alumnos_grupos SET fechaBaja = ?, transferenciaBaja = 0 WHERE idAlumno = ? AND idGrupo = ?", 'sii', reorder_array($_POST, ['fechaBaja', 'idAlumno', 'idGrupo']))){
		echo "s|Baja alumno|Se ha dado de baja el alumno de este grupo correctamente. ";
	}else{
		echo "e|Baja alumno|No se pudo dar de baja al alumno del grupo. ";
	}
?>
