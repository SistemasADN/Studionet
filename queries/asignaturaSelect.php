<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
    include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
			"SELECT
              a.idAsignatura as id,
              a.nombreAsignatura as value,
              d.nombreDisciplina as subtext
            FROM asignaturas as a
              LEFT JOIN disciplinas as d
                ON a.idDisciplina = d.idDisciplina
              WHERE a.activo = 1 ORDER BY a.nombreAsignatura ASC")));

?>
