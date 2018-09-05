<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$respuesta = select_query($con,
	"SELECT a.idAsignatura, a.nombreAsignatura, a.idDisciplina, a.activo, d.idDisciplina, d.nombreDisciplina
	 FROM asignaturas AS a LEFT JOIN disciplinas AS d ON a.idDisciplina = d.idDisciplina");
	json_echo($respuesta);
?>
