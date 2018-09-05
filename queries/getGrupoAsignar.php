<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con,
      "SELECT
		g.idGrupo,
		g.idNivel,
		g.idAsignatura,
		g.numMaxAlumnos,
		g.fechaAlta,
		g.fechaBaja,
		g.precio,
		CONCAT(a.nombreAsignatura, ' - ', n.nombreNivel, ' - ', pc.nombre) as nombreGrupo
    FROM grupos as g
    LEFT JOIN asignaturas AS a ON g.idAsignatura = a.idAsignatura
	  LEFT JOIN niveles AS n ON g.idNivel = n.idNivel
		LEFT JOIN
	  LEFT JOIN personal as p ON p.idPersonal = c.idProfesor
	  LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona WHERE g.fechaBaja IS NOT NULL"));
?>
