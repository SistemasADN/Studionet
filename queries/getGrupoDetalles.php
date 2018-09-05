<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	//$_POST['idGrupo'] = 1;
	$rules = array ();
	$rules['idGrupo'] = ["r"=>true, 't'=>"num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con,
      "SELECT
		ag.idAlumno,
		p.nombre as nombreAlumno,
		ag.fechaAlta
		FROM alumnos_grupos as ag
		LEFT JOIN alumnos as a ON a.idAlumno = ag.idAlumno
		LEFT JOIN personacompleta as p ON a.idPersona = p.idPersona
		WHERE ag.fechaBaja IS NULL AND ag.idGrupo = ?",'i', $_POST));
?>
