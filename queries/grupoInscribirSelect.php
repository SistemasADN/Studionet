<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
      "SELECT g.idGrupo as id,
			g.nombreGrupo as value,
			CONCAT(cg.alumnosInscritos, '/', g.numMaxAlumnos) as subtext,
			cg.cupo
      FROM grupos as g
	  	LEFT JOIN cupogrupo as cg ON cg.idGrupo = g.idGrupo
	  	WHERE g.fechaBaja IS NULL AND cg.cupo>0")));
?>
