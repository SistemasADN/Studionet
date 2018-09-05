<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
  $rules['idAsistencia'] = 		["t"=>"num", "r"=>true];

	$validator->setRulesValidateArrayEcho($rules, $_POST);
  //$_POST['idProfesor'] = 6;
	include "dbcon.php";

	$data['alumnos'] = select_query($con,
      "SELECT aa.idAsistenciaAlumno, pc.nombre as nombreAlumno, aa.asistencia FROM asistencia_alumno as aa
      LEFT JOIN alumnos as a ON a.idAlumno = aa.idAlumno
      LEFT JOIN personacompleta as pc ON pc.idPersona = a.idPersona WHERE aa.idAsistencia = ?", "i", $_POST);

	$data['profesores'] = select_query($con,
		      "SELECT ap.idAsistenciaProfesor, pc.nombreProfesor, ap.asistencia FROM asistencia_profesor as ap
		      LEFT JOIN profesorcompleto as pc ON ap.idProfesor = pc.idPersonal
		      WHERE ap.idAsistencia = ?", "i", $_POST);
	json_echo($data);
  /*
	json_echo(select_query($con,
      "SELECT pc.nombre as alumno, a.asistencia FROM asistencia_alumno as a
      LEFT JOIN alumnos as al ON al.idAlumno = a.idAlumno
      LEFT JOIN personacompleta as pc ON pc.idPersona = al.idPersona WHERE a.idGrupo"));
      */
?>
