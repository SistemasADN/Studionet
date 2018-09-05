<?php
	include "../validation/classValidator.php";

	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["idAlumno"] =		 		['r' => true,  't' => "num"];
    $rules["idEquipo"] = 		['r' => true,  't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";

	//VER SI ALUMNO ESTÁ EN EQIPO
	
	$respuesta = select_query($con, "SELECT COUNT(*) as inscrito FROM alumnos_equipos WHERE idAlumno = ? AND idEquipo = ? AND fechaBaja IS NULL", 'ii', $_POST);
	$respuesta = $respuesta[0]['inscrito'];

	if($respuesta==1){
		echo "e|Inscribir alumno|Este alumno ya está inscrito en este equipo. ";
		exit;
	}
	/**/


	$_POST['fechaAlta'] = date("Y-m-d");

	if(insert_query($con, "INSERT INTO alumnos_equipos (idAlumno, idEquipo, fechaAlta) VALUES (?,?,?)", 'iis', $_POST)){
		echo "s|Inscribir alumno|Alumno inscrito correctamente.|".$_POST['fechaAlta'];
	}else{
		echo "e|Inscribir alumno|No se pudo inscribir al alumno. ";
	}
?>
