<?php
	//$_POST['idCliente'] = 12;
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  include_once "getidSede.php";
	$respuesta = select_query($con,
	'SELECT a.idAlumno as id, pc.nombre as value, pcc.nombre as subtext, ag.idGrupo, g.nombreGrupo, ag.fechaAlta, ag.fechaBaja
	FROM alumnos as a
  LEFT JOIN alumnos_grupos as ag ON ag.idAlumno = a.idAlumno
	LEFT JOIN clientes as c ON a.idTutor = c.idCliente
	LEFT JOIN personacompleta as pc ON a.idPersona = pc.idPersona
	LEFT JOIN personacompleta as pcc ON c.idPersona = pcc.idPersona
  LEFT JOIN grupos as g ON g.idGrupo = ag.idGrupo
	WHERE a.activo = 1 GROUP BY (id)');
  json_echo(format_respuesta_select($respuesta));
?>
