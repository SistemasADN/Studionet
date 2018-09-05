<?php
	include "../validation/classValidator.php";

	$validator = new Validator();
	//Reglas
	$validator->enableEchos();
	$rules = array ();
	$rules["idGrupo"] =			 				['r' => true,  't' => "num"];
	$alumnos = $_POST['alumnos'];
	unset($_POST['alumnos']);
	//vde();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	$rules = array ();
	$rules["idAlumno"] =		 		['r' => true,  't' => "num"];
	foreach($alumnos as $k=>$alumno){
		$validator->setRulesValidateArrayEcho($rules, $alumno);
	}
	include "dbcon.php";

	$fecha = date("Y-m-d");
	foreach($alumnos as $k=>$alumno){
			$alumno = $alumno['idAlumno'];
			if(!execute_query($con, "UPDATE alumnos_grupos SET fechaBaja = ?, transferenciaBaja = 0 WHERE idAlumno = ? AND idGrupo = ?", 'sii', [$fecha, $alumno, $_POST['idGrupo']], false)){
					echo "e|Baja alumnos|No se pudo dar de baja los alumnos del grupo. ";exit;
			}
	}
	echo "s|Baja alumnos|Alumnos dados de baja correctamente.";
	mysqli_commit($con);
?>
