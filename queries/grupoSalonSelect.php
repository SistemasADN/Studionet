<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
  $_POST['idSalon'] = 1;
  $rules['idSalon'] = ["r"=>true, 't'=>'num'];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include "getIdSede.php";
	json_echo(format_respuesta_select(select_query($con,
      "SELECT g.idGrupo as id,
				g.nombreGrupo as value,
				CONCAT(IF(COUNT(*)>1, CONCAT(COUNT(*), ' profesores'), pc.nombre),
				'(',a.nombreAsignatura, ' - ', n.nombreNivel, ') (',g.numMaxAlumnos,')') as subtext,
				g.precio
      FROM grupos as g
      LEFT JOIN salon_grupo as sg ON sg.idGrupo = g.idGrupo
			LEFT JOIN asignaturas as a ON a.idAsignatura = g.idAsignatura
			LEFT JOIN niveles as n ON n.idNivel = g.idNivel
			LEFT JOIN grupo_profesor as gp ON g.idGrupo = gp.idGrupo AND gp.fechaBaja IS NULL
			LEFT JOIN personal as p ON p.idPersonal = gp.idProfesor
	  	LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
			WHERE g.fechaBaja IS NULL AND g.idSede = ? AND (sg.idSalonGrupo IS NULL OR sg.idSalon <> ?) GROUP BY (g.idGrupo) ", 'ii', [$idSede, $_POST['idSalon']])));
?>
