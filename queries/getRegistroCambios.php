<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
  $rules['fechaInicial'] = 		["t"=>"date", "r"=>true];
  $rules['fechaFinal'] = 			["t"=>"date", "r"=>true];
  //$_POST['fechaInicial'] = "2017-12-01"; $_POST['fechaFinal'] = "2017-12-31";
	$validator->setRulesValidateArrayEcho($rules, $_POST);
  //$_POST['idProfesor'] = 6;
	include "dbcon.php";
  $respuestaAlumnos = select_query($con,
  "SELECT ac.fecha, ac.motivo, ac.asistenciaOriginal,
  g.nombreGrupo, CONCAT(asig.nombreAsignatura, ' - ', n.nombreNivel) as nombreClase,
  ac.asistenciaActual, pc.nombre, 'Alumno' as tipo, pcu.nombre as usuario
  FROM asistencia_cambio as ac
  LEFT JOIN asistencia_alumno as aa ON aa.idAsistenciaAlumno = ac.idAsistenciaAlumno
  LEFT JOIN asistencia as a ON a.idAsistencia = aa.idAsistencia
  LEFT JOIN alumnos as al ON al.idAlumno = aa.idAlumno
  LEFT JOIN personacompleta as pc ON pc.idPersona = al.idPersona
  LEFT JOIN grupos as g ON g.idGrupo = a.idGrupo
  LEFT JOIN asignaturas as asig ON asig.idAsignatura = g.idAsignatura
  LEFT JOIN niveles as n ON g.idNivel = n.idNivel
  LEFT JOIN usuarios as u ON u.idUsuario = ac.idUsuario
  LEFT JOIn personacompleta as pcu ON pcu.idPersona = u.idPersona
  WHERE ac.idAsistenciaProfesor IS NULL
  AND ac.fecha BETWEEN ? AND ?",
   'ss', $_POST);


   $respuestaProfesor = select_query($con,
   "SELECT ac.fecha, ac.motivo, ac.asistenciaOriginal,
   g.nombreGrupo, CONCAT(asig.nombreAsignatura, ' - ', n.nombreNivel) as nombreClase,
   ac.asistenciaActual, pc.nombre,
    'Profesor' as tipo, pcu.nombre as usuario
   FROM asistencia_cambio as ac
   LEFT JOIN asistencia_profesor as aa ON aa.idAsistenciaProfesor = ac.idAsistenciaProfesor
   LEFT JOIN asistencia as a ON a.idAsistencia = aa.idAsistencia
   LEFT JOIN personal as p ON aa.idProfesor = p.idPersonal
   LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
   LEFT JOIN grupos as g ON g.idGrupo = a.idGrupo
   LEFT JOIN asignaturas as asig ON asig.idAsignatura = g.idAsignatura
   LEFT JOIN niveles as n ON g.idNivel = n.idNivel
   LEFT JOIN usuarios as u ON u.idUsuario = ac.idUsuario
   LEFT JOIn personacompleta as pcu ON pcu.idPersona = u.idPersona
   WHERE ac.idAsistenciaProfesor IS NOT NULL
   AND ac.fecha BETWEEN ? AND ?",
    'ss', $_POST);


  json_echo(array_merge($respuestaAlumnos, $respuestaProfesor));
  //'fecha', 'nombreGrupo', 'nombreClase', 'nombre', 'tipo', 'asistenciaOriginal', 'asistenciaCambio', 'motivo', 'usuario'
?>
