<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
	"SELECT
	eq.idEquipo as id,
	CONCAT(eq.nombreEquipo, ' - ', COUNT(ae.idAlumno)) as value,
	e.nombreSede as subtext,
	COUNT(ae.idAlumno) as numAlumnos
	FROM equipos as eq
	LEFT JOIN alumnos_equipos as ae ON ae.idEquipo = eq.idEquipo AND ae.fechaBaja IS NULL
	LEFT JOIN sedes as e ON e.idSede = eq.idSede
    WHERE eq.activo = 1
    GROUP BY (eq.idEquipo)
		HAVING numAlumnos>0")));
?>
