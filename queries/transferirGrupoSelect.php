<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['idGrupo'] = ['t'=>'num', 'r'=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
      "SELECT g.idGrupo as id,
				g.nombreGrupo as value,
				CONCAT(pc.nombre, ' (',a.nombreAsignatura, ' - ', n.nombreNivel, ') (',g.numMaxAlumnos,')') as subtext,
				g.precio
      FROM grupos as g
			LEFT JOIN asignaturas as a ON a.idAsignatura = g.idAsignatura
			LEFT JOIN niveles as n ON n.idNivel = g.idNivel
			LEFT JOIN grupo_profesor as gp ON g.idGrupo = gp.idGrupo AND gp.fechaBaja IS NULL AND gp.principal = 1
			LEFT JOIN personal as p ON p.idPersonal = gp.idProfesor
	  	LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
			LEFT JOIN grupohoras as h ON h.idGrupo = g.idGrupo
			WHERE g.fechaBaja IS NULL AND g.idGrupo <> ? AND h.horas>0 AND h.horas IS NOT NULL GROUP BY (g.idGrupo)", 'i', $_POST)));
?>
