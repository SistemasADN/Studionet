<?php
	session_start();
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$r = select_query($con, 'SELECT a.idAgenda, a.nombreEvento as evento, DATE_FORMAT(a.fecha, "%Y-%m-%d") as fechaText, a.idEquipo, CONCAT("EQUIPO: ", e.nombreEquipo) as equipo FROM agenda as a LEFT JOIN equipos as e ON e.idEquipo = a.idEquipo LEFT JOIN alumnos_equipos AS ae ON a.idEquipo = ae.idEquipo LEFT JOIN alumnos AS al ON ae.idAlumno = al.idAlumno WHERE al.idTutor = ? GROUP BY a.idAgenda', 'i', reorder_array($_SESSION, ['idUsuario']));
	json_echo($r);
?>