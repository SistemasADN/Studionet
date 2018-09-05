<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con,
      "SELECT
        c.idClase,
        c.idAsignatura,
        c.idNivel,
		c.precioEstandard,
        c.activo,
        a.nombreAsignatura,
        n.nombreNivel
      FROM clases AS c
        LEFT JOIN asignaturas AS a
          ON c.idAsignatura = a.idAsignatura
        LEFT JOIN niveles AS n
          ON c.idNivel = n.idNivel"));
?>
