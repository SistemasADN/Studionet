<?php
	include "../validation/classValidator.php";
	include "getIdSede.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con,
      "SELECT
		g.idGrupo,
		g.nombreGrupo,
		g.idNivel,
		g.idAsignatura,
		g.numMaxAlumnos,
		g.fechaAlta,
		g.fechaBaja,
		g.precio,
		a.nombreAsignatura,
		n.nombreNivel
      FROM grupos as g
      LEFT JOIN asignaturas AS a ON g.idAsignatura = a.idAsignatura
	  LEFT JOIN niveles AS n ON g.idNivel = n.idNivel WHERE g.idSede = ?",
		 'i', [$idSede]));
?>
