<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include "getIdSede.php";
	if($idSede===null){	json_echo([]);exit;	}
	if($idSede==-1){
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
				WHERE g.fechaBaja IS NULL GROUP BY (g.idGrupo) ORDER BY value ASC")));
	}else{
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
			WHERE g.fechaBaja IS NULL AND g.idSede = ? GROUP BY (g.idGrupo) ORDER BY value ASC", 'i', [$idSede])));
	}
?>
