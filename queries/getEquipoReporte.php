<?php
	
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$respuesta = select_query($con, 
              "SELECT e.idEquipo, e.nombreEquipo, pc.nombre as nombreProfesor FROM equipos as e LEFT JOIN personal as p ON e.idProfesor = p.idPersonal LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona WHERE e.activo = 1");
			  
	foreach($respuesta as $k=>$v){
		$insert = array($v['idEquipo']);
		$respuesta[$k]['alumnos'] = 
		select_query($con, 
		"SELECT 
			pc.nombre as nombreAlumno,
			ae.fechaAlta
		FROM alumnos_equipos as ae
		LEFT JOIN alumnos as a ON a.idAlumno = ae.idAlumno
		LEFT JOIN personacompleta as pc ON a.idPersona = pc.idPersona
		WHERE ae.idEquipo = ? AND fechaBaja IS NULL", 'i', $insert);
	}
	json_echo($respuesta);
?>