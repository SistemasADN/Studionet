<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con, 
			"SELECT 
              sc.idSalonClase as id,
              c.nombreClase as value,
              CONCAT(a.nombreAsignatura, ' ',s.nombreSalon) as subtext
            FROM salon_clase as sc 
              LEFT JOIN clases as c
                ON sc.idClase = c.idClase
              LEFT JOIN asignaturas as a
                ON a.idAsignatura = c.idAsignatura
              LEFT JOIN salones AS s
                ON sc.idSalon = s.idSalon
             WHERE c.activo = 1")));
?>