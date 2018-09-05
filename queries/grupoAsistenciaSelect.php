<?php
	include "../validation/classValidator.php";

	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	session_start();
	$_POST['idProfesor'] = $_SESSION['idPersonal']; //var_dump($_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
		"SELECT g.idGrupo as id, g.nombreGrupo as value,
		 CONCAT('(',a.nombreAsignatura, ' - ', n.nombreNivel, ') (',s.nombreSede,')') as subtext
		FROM  grupo_profesor as gp
		LEFT JOIN grupos as g ON gp.idGrupo = g.idGrupo
		LEFT JOIN asignaturas as a ON a.idAsignatura = g.idAsignatura
		LEFT JOIN niveles as n ON n.idNivel = g.idNivel
		LEFT JOIN sedes as s ON s.idSede = g.idSede
		WHERE gp.fechaBaja IS NULL AND g.fechaBaja IS NULL AND gp.idProfesor = ?
		ORDER BY g.nombreGrupo ASC", 'i', $_POST)));
?>
