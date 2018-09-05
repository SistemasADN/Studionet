<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$r = select_query($con, 'SELECT a.idAgenda, a.nombreEvento as evento, DATE_FORMAT(a.fecha, "%Y-%m-%d") as fecha,
	 	TIME_FORMAT(a.tiempoInicial, "%H:%i") as tiempoInicial, TIME_FORmAT(a.tiempoFinal, "%H:%i") as tiempoFinal FROM agenda as a'
	 	);
		foreach($r as $k=>$v){
			$r[$k]['listaEquipos'] = select_query($con, 'SELECT ae.idEquipo, e.nombreEquipo as equipo FROM equipos as e
			 LEFT JOIN agenda_equipos as ae ON ae.idEquipo = e.idEquipo WHERE idAgenda = ?', 'i', [$v['idAgenda']]);
		}
	//$r2 = select_query($con, 'SELECT 0 as idAgenda, p.nombre as evento, p.fechaNacimiento as fecha, "Cumpleaños" as equipo FROM personacompleta as p LEFT JOIN clientes as c ON p.idPersona = c.idPersona WHERE c.activo = 1 AND CONCAT(DATE_FORMAT(p.fechaNacimiento, "%Y-%M"), "-01")<= DATE_ADD(CURDATE(), INTERVAL 2 MONTH)');
	//$r3 = select_query($con, 'SELECT 0 as idAgenda, p.nombre as evento, p.fechaNacimiento as fecha, "Cumpleaños" as equipo FROM personacompleta as p LEFT JOIN alumnos as c ON p.idPersona = c.idPersona WHERE c.activo = 1 AND CONCAT(DATE_FORMAT(p.fechaNacimiento, "%Y-%M"), "-01")<= DATE_ADD(CURDATE(), INTERVAL 2 MONTH)');
	//$m = array_merge($r, $r2, $r3);
	$m = $r;
	json_echo($m);
?>
