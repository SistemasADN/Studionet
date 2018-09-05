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
	 	s.idGrupo,
	 	g.nombreGrupo,
	 	CONCAT(pc.nombre, ' (',a.nombreAsignatura, ' - ', n.nombreNivel, ')') as detallesGrupo,
	 	g.precio
	FROM salon_grupo as s
      LEFT JOIN grupos as g ON s.idGrupo = g.idGrupo
			LEFT JOIN grupo_profesor as gp ON g.idGrupo = gp.idGrupo AND gp.fechaBaja IS NULL AND gp.principal = 1
			LEFT JOIN personal as p ON p.idPersonal = gp.idProfesor
			LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
	  LEFT JOIN grupohorario as gh ON s.idSalonGrupo = gh.idSalonGrupo
      LEFT JOIN asignaturas AS a ON g.idAsignatura = a.idAsignatura
	  LEFT JOIN niveles AS n ON g.idNivel = n.idNivel
	WHERE s.idSalon = ? AND gh.horarios <> 0",'i', $_POST);

	foreach($respuesta as $k=>$v){
		$insert = array($v['idSalonGrupo']);
		$respuesta[$k]['horarios'] = select_query($con, "SELECT idHorario, dia, horaInicio, duracion FROM horario WHERE idSalonGrupo = ?", 'i', $insert);
	}
	json_echo($respuesta);
?>
