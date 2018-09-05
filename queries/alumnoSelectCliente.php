<?php
	//$_POST['idCliente'] = 12;
    session_start();
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con, 
	'SELECT a.idAlumno as id, pc.nombre as value FROM alumnos as a LEFT JOIN personacompleta as pc ON a.idPersona = pc.idPersona 
	WHERE a.activo = 1 AND a.idTutor = ?', 'i', reorder_array($_SESSION, ['idUsuario']))));
?>