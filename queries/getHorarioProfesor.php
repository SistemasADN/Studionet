<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	//getDebuggingInfo(true);
	if(isset($_POST['idSede'])){
		$rules['idSede'] = ["r"=>true, "t"=>"num"];
	}else{
		$rules['idProfesor'] = ["r"=>true, "t"=>"num"];
	}
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	if(!isset($_POST['idSede'])){
			$respuesta = select_query($con,
			"SELECT
				s.idSalonGrupo,
				s.idGrupo,
				g.nombreGrupo,
			  CONCAT(pc.nombre, ' (',a.nombreAsignatura, ' - ', n.nombreNivel, ')') as detallesGrupo,
			  CONCAT(sl.nombreSalon, ' (', e.nombreSede, ')') as nombreSalon,
				e.nombreSede
				FROM grupos as g
		   	LEFT JOIN salon_grupo as s ON s.idGrupo = g.idGrupo
				LEFT JOIN grupohorario as gh ON s.idSalonGrupo = gh.idSalonGrupo
				LEFT JOIN asignaturas AS a ON g.idAsignatura = a.idAsignatura
				LEFT JOIN niveles AS n ON g.idNivel = n.idNivel
				LEFT JOIN grupo_profesor as gp ON g.idGrupo = gp.idGrupo
				LEFT JOIN grupo_profesor as gpp ON g.idGrupo = gpp.idGrupo AND gpp.fechaBaja IS NULL AND gpp.principal = 1
				LEFT JOIN personal as p ON p.idPersonal = gp.idProfesor
				LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
				LEFT JOIN salones as sl ON s.idSalon = sl.idSalon
				LEFT JOIN sedes as e ON g.idSede = e.idSede
			WHERE gh.horarios <> 0 AND gp.idProfesor = ? AND gp.fechaBaja IS NULL",'i', [$_POST['idProfesor']]);
	}else{
		session_start();
		$idProfesor = select_query($con, "SELECT idPersonal FROM profesorcompleto WHERE idUsuario = ?", 'i', [$_SESSION['idUsuario']]);
		$idProfesor = $idProfesor[0]['idPersonal'];
		$respuesta = select_query($con,
		"SELECT
			s.idSalonGrupo,
			s.idGrupo,
			g.nombreGrupo,
			CONCAT(pc.nombre, ' (',a.nombreAsignatura, ' - ', n.nombreNivel, ') (', s.idGrupo,')') as detallesGrupo,
			CONCAT(sl.nombreSalon, ' (', e.nombreSede, ')') as nombreSalon,
			e.nombreSede
		FROM grupos as g
			LEFT JOIN salon_grupo as s ON s.idGrupo = g.idGrupo
			LEFT JOIN grupohorario as gh ON s.idSalonGrupo = gh.idSalonGrupo
			LEFT JOIN asignaturas AS a ON g.idAsignatura = a.idAsignatura
			LEFT JOIN niveles AS n ON g.idNivel = n.idNivel
			LEFT JOIN grupo_profesor as gp ON g.idGrupo = gp.idGrupo
			LEFT JOIN grupo_profesor as gpp ON g.idGrupo = gpp.idGrupo AND gpp.fechaBaja IS NULL AND gpp.principal = 1
			LEFT JOIN personal as p ON p.idPersonal = gp.idProfesor
			LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
			LEFT JOIN salones as sl ON s.idSalon = sl.idSalon
			LEFT JOIN sedes as e ON g.idSede = e.idSede
		WHERE gh.horarios <> 0 AND gp.idProfesor = ? AND g.idSede = ? AND gp.fechaBaja IS NULL",'ii', [$idProfesor, $_POST['idSede']]);
	}
	foreach($respuesta as $k=>$v){

		$insert = array($v['idSalonGrupo']);
		//var_dump($insert);var_dump($v['nombreGrupo']);
		$respuesta[$k]['horarios'] = select_query($con, "SELECT idHorario, dia, horaInicio, duracion FROM horario WHERE idSalonGrupo = ?", 'i', $insert);
		//var_dump($respuesta[$k]['horarios']);
	}
	//var_dump($respuesta);exit;
	json_echo($respuesta);
?>
