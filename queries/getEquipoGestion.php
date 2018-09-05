<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include "getIdSede.php";
	if($idSede==-1){
		$respuesta = select_query($con,
	      "SELECT
			e.idEquipo,
			e.nombreEquipo,
			es.nombreSede,
			pc.nombre as nombreProfesor
	      FROM equipos as e
		  LEFT JOIN sedes as es ON es.idSede = e.idSede
		  LEFT JOIN personal as p ON p.idPersonal = e.idProfesor
		  LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
		  WHERE e.activo = 1");
	}else{
		$respuesta = select_query($con,
	      "SELECT
			e.idEquipo,
			e.nombreEquipo,
			es.nombreSede,
			pc.nombre as nombreProfesor
	      FROM equipos as e
		  LEFT JOIN sedes as es ON es.idSede = e.idSede
		  LEFT JOIN personal as p ON p.idPersonal = e.idProfesor
		  LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
		  WHERE e.activo = 1 AND e.idSede = ?", 'i', [$idSede]);
	}
	json_echo($respuesta);
?>
