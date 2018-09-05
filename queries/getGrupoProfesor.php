<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	//$_POST['idGrupo'] = 2;
	$rules['idGrupo'] = ["t"=>"num","r"=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con,
  "SELECT pc.idPersonal as idProfesor, pc.nombreProfesor as nombre
	 FROM profesorcompleto AS pc
  LEFT JOIN grupo_profesor AS gp ON gp.idProfesor = pc.idPersonal AND gp.fechaBaja IS NULL
  WHERE gp.idGrupo = ?", "i", $_POST));
?>
