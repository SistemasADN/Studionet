<?php
	
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	//$_POST['idGrupo'] = 1;
	$rules = array ();
	$rules['idEquipo'] = ["r"=>true, 't'=>"num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con, 	
      "SELECT 
		eg.idAlumno,
		p.nombre as nombreAlumno,
		eg.fechaAlta
		FROM alumnos_equipos as eg
		LEFT JOIN alumnos as a ON a.idAlumno = eg.idAlumno
		LEFT JOIN personacompleta as p ON a.idPersona = p.idPersona
		WHERE eg.fechaBaja IS NULL AND eg.idEquipo = ?",'i', $_POST));
?>