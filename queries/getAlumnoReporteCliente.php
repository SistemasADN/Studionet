<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
    $rules['idCliente'] = ['r' => true,  't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$respuesta = select_query($con,
              "SELECT
                a.idAlumno,
                pc.nombre as nombreAlumno,
				tp.nombre as nombreCliente,
				e.nombreEquipo,
				c.idPersona,
                (SELECT idPersona FROM clientesalumnos WHERE idPersona = a.idPersona) AS ca
	          FROM alumnos as a
			  LEFT JOIN personacompleta as pc ON pc.idPersona = a.idPersona
			  LEFT JOIN clientes as c ON c.idCliente = a.idTutor
			  LEFT JOIN personacompleta as tp ON tp.idPersona = c.idPersona
			  LEFT JOIN alumnos_equipos as ae ON ae.idAlumno = a.idAlumno AND ae.fechaBaja IS NULL
			  LEFT JOIN equipos as e ON e.idEquipo = ae.idEquipo
			  WHERE a.activo = 1 AND a.idTutor = ?",'i', reorder_array($_POST, ['idCliente']));

	foreach($respuesta as $k=>$v){
		$insert = array($v['idAlumno']);
		$respuesta[$k]['grupos'] =
		select_query($con,
		"SELECT
			ag.idGrupo,
			g.precio,
			pc.nombre as nombreProfesor,
			CONCAT(a.nombreAsignatura, ' - ', n.nombreNivel) as nombreClase,
			g.nombreGrupo,
			ag.fechaAlta,
			ag.fechaBaja
		FROM alumnos_grupos as ag
		LEFT JOIN grupos as g ON ag.idGrupo = g.idGrupo
		LEFT JOIN asignaturas as a ON a.idAsignatura = g.idAsignatura
		LEFT JOIN niveles as n ON n.idNivel = g.idNivel
		LEFT JOIN grupo_profesor as gp ON gp.idGrupo = g.idGrupo AND gp.principal = 1
		LEFT JOIN personal as p ON p.idPersonal = gp.idProfesor
		LEFT JOIN personacompleta as pc ON p.idPersona = pc.idPersona
		WHERE ag.idAlumno = ?", 'i', $insert);
	}
	json_echo($respuesta);
?>
