<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	//$_POST['idGrupo'] = 5;
	$rules['idGrupo'] = ["t"=>"num","r"=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con,
  "SELECT a.idAlumno, vp.nombre
	 FROM alumnos AS a
  LEFT JOIN alumnos_grupos AS ag ON a.idAlumno = ag.idAlumno
  LEFT JOIN personas AS p ON p.idPersona = a.idPersona
  LEFT JOIN personacompleta AS vp ON vp.idPersona = p.idPersona
  WHERE ag.idGrupo = ? GROUP BY (a.idAlumno)", "i", $_POST));

?>
