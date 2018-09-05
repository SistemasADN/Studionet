<?php
	include "../validation/classValidator.php";
	//vde();
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["idAlumno"] =		 		['r' => true,  't' => "num"];
    $rules["idGrupo"] = 		['r' => true,  't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";

	//VER SI ALUMNO ESTÁ EN GRUPO
	$respuesta = select_query($con, "SELECT COUNT(*) as inscrito FROM alumnos_grupos WHERE idAlumno = ? AND idGrupo = ? AND fechaBaja IS NULL", 'ii', $_POST);
	$respuesta = $respuesta[0]['inscrito'];

	if($respuesta==1){
		echo "e|Inscribir alumno|Este alumno ya está inscrito en este grupo. ";
		exit;
	}
	//VER SI EL GRUPO TIENE CUPO
	$respuesta = select_query($con, "SELECT cupo FROM cupogrupo WHERE idGrupo = ?", 'i', reorder_array($_POST, ['idGrupo']));
	$respuesta = $respuesta[0]['cupo'];
	if($respuesta==0){
		echo "e|Inscribir alumno|Este grupo ha llegado a su máximo de alumnos. ";
		exit;
	}
	//VER SI EL ALUMNO NO TIENE UN HORARIO QUE SE EMPALME
	//SELECCIONAR EL HORARIO DEL GRUPO
	$horarioGrupo = select_query($con, "SELECT dia, horaInicio, duracion
	FROM horario as h LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
	WHERE sg.idGrupo = ?", 'i', reorder_array($_POST, ['idGrupo']));
	//SELECCIONAR EL HORARIO DEL ALUMNO
	$horarioAlumno = select_query($con, "SELECT dia, horaInicio, duracion
	FROM horario as h
	LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
	LEFT JOIN alumnos_grupos as ag ON ag.idGrupo = sg.idGrupo
	WHERE ag.idAlumno= ? AND ag.fechaBaja IS NULL", 'i', reorder_array($_POST, ['idAlumno']));

	if(empalme_horario($horarioGrupo, $horarioAlumno)){
		echo "e|Inscribir alumno|No se puede inscribir al alumno ya que hay un empalme en su horario. ";
		exit;
	}

	$equipo = select_query($con, "SELECT nombreEquipo FROM alumnoequipo WHERE idAlumno = ?", 'i', reorder_array($_POST, ['idAlumno']));
	$equipo = $equipo[0]['nombreEquipo'];
	if($equipo===null){
		$equipo = "N/A";
	}
	$_POST['fechaAlta'] = date("Y-m-d");

	if(insert_query($con, "INSERT INTO alumnos_grupos (idAlumno, idGrupo, fechaAlta) VALUES (?,?,?)", 'iis', $_POST)){
		echo "s|Inscribir alumno|Alumno inscrito correctamente.|".$_POST['fechaAlta']."|".$equipo;
	}else{
		echo "e|Inscribir alumno|No se pudo inscribir al alumno. ";
	}
?>
