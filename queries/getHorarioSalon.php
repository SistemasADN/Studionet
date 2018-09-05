<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	//$_POST['idSalon'] = 1;
	$rules['idSalon'] = ["r"=>true, "t"=>"num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$respuesta = select_query($con,
	"SELECT s.idSalonGrupo,
		s.idSalon,
		g.nombreGrupo,
		CONCAT(pc.nombre, ' (',a.nombreAsignatura, ' - ', n.nombreNivel, ')') as detallesGrupo,
		g.numMaxAlumnos,
		g.precio,
		g.idGrupo
	FROM grupos as g
	LEFT JOIN salon_grupo as s ON s.idGrupo = g.idGrupo
	LEFT JOIN asignaturas as a ON a.idAsignatura = g.idAsignatura
	LEFT JOIN niveles as n ON n.idNivel = g.idNivel
	LEFT JOIN grupo_profesor as gp ON g.idGrupo = gp.idGrupo AND gp.fechaBaja IS NULL AND gp.principal = 1
	LEFT JOIN personal as p ON p.idPersonal = gp.idProfesor
	LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
	WHERE s.idSalon = ? GROUP BY (g.idGrupo) ORDER BY s.idSalonGrupo ASC",'i', $_POST);

	foreach($respuesta as $k=>$v){
		$insert = array($v['idSalonGrupo']);
		$respuesta[$k]['horarios'] = select_query($con, "SELECT idHorario, dia, horaInicio, duracion FROM horario WHERE idSalonGrupo = ?", 'i', $insert);
	}
	json_echo($respuesta);
?>
