<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con, "
      SELECT
        e.idEquipo,
        e.nombreEquipo,
        e.idSede,
        e.idProfesor,
        es.nombreSede,
        pc.nombre,
      FROM equipos AS e
        LEFT JOIN sedes AS es
          ON e.idSede = es.idSede
        LEFT JOIN personal AS pe
          ON e.idProfesor = pe.idPersonal
        LEFT JOIN personacompleta AS p
          ON pe.idPersona = p.idPersona"));
?>
