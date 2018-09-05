<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	//$_POST['idSalon'] = 1;
	$rules['idAlumno'] = ["r"=>true, "t"=>"num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);

	include "dbcon.php";
	$respuesta = select_query($con,
	"SELECT
	s.idSalonGrupo,
	g.nombreGrupo,
	CONCAT(pc.nombreProfesor, ' (',a.nombreAsignatura, ' - ', n.nombreNivel, ')') as detallesGrupo,
	CONCAT(sl.nombreSalon, ' (', e.nombreSede, ')') as nombreSalon
	FROM alumnos_grupos as al
	LEFT JOIN salon_grupo as s ON s.idGrupo = al.idGrupo
	    LEFT JOIN grupohorario as gh ON s.idSalonGrupo = gh.idSalonGrupo
			LEFT JOIN grupo_profesor as gp ON gp.idGrupo = al.idGrupo AND gp.fechaBaja IS NULL and gp.principal = 1
			LEFT JOIN profesorcompleto as pc ON gp.idProfesor = pc.idPersonal
		LEFT JOIN salones as sl ON s.idSalon = sl.idSalon
		LEFT JOIN sedes as e ON sl.idSede = e.idSede
      LEFT JOIN grupos as g ON s.idGrupo = g.idGrupo
      LEFT JOIN asignaturas AS a ON g.idAsignatura = a.idAsignatura
	  LEFT JOIN niveles AS n ON g.idNivel = n.idNivel
	WHERE al.idAlumno = ? AND gh.horarios <>0 AND al.fechaBaja IS NULL",'i', $_POST);

	foreach($respuesta as $k=>$v){
		$insert = array($v['idSalonGrupo']);
		$respuesta[$k]['horarios'] = select_query($con, "SELECT idHorario, dia, horaInicio, duracion FROM horario WHERE idSalonGrupo = ?", 'i', $insert);
	}
	json_echo($respuesta);
?>
